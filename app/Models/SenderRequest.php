<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

class SenderRequest extends Model
{
    use HasFactory;
    
    protected $primaryKey = "sr_id";
    protected $table = "sender_request";
    protected $fillable = [
        'sender_serial',
        'sender_id',
        'sr_content_request',
        'sr_user_agent',
        'sr_auth',
        'sr_datetime_sender',
        'sr_header',
        'psis_sr_status',
    ];


    static public function listado_datatable ($columnName, $columnSortOrder, $searchValue, $start, $rowperpage){
        if($rowperpage < 0){
            $rowperpage = null;
        }

        return DB::select( 
            DB::raw("
                with
                datos_input as (
                    select
                    :skip::int as start,
                    :rowperpage::int as rowperpage,
                    :searchvalue::varchar(50) as palabra
                ),
                conteo as(
                    select count(sr.sr_id) as totalrecords from sender_request sr
                ),
                request_busqueda as (
                    select sr.* 
                    , count(sr_id) over() as totalrecordswithfilter
                    from sender_request sr
                    cross join datos_input di
                    where 
                    sender_serial ilike  '%'||di.palabra||'%'
                    or
                    sr_content_request ilike '%'||di.palabra||'%'
                ),
                request_paginado as (
                    select
                    *
                    from request_busqueda
                    cross join conteo
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from request_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

}
