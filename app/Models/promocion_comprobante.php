<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class promocion_comprobante extends Model
{
    use HasFactory;

    protected $table = 'promocion_comprobante';
    protected $fillable = [
        'id_comprobante_pago', 
        'monto_descuento'
    ];

    static public function listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage)
    {
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
                promocion_comprobante_datos as (
                    select
                        p.id_promocion
                        ,p.id_comprobante_pago
                        ,p.monto_descuento
                        ,count(p.id_promocion) over() as totalrecords
                    from promocion_comprobante p
                ),
                promocion_comprobante_busqueda as (
                    select p.* , count(id_promocion) over() as totalrecordswithfilter
                    from promocion_comprobante_datos p
                    cross join datos_input di
                    where id_comprobante_pago::varchar(50) ilike '%'||di.palabra||'%'
                ),
                promocion_comprobante_paginado as (
                    select
                    *
                    from promocion_comprobante_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from promocion_comprobante_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=>$start, "rowperpage"=>$rowperpage]
        );
    }

    static public function actualizar($id_promocion, $data)
    {
        if(empty($id_promocion) || empty($data)){
            return respuesta::error("Datos no válidos para realizar el cambio de información.");
        }

        $res = self::where("id_promocion", $id_promocion)
                ->update($data);

        return $res ? respuesta::ok() : respuesta::error("No se ha logrado hacer el cambio de información.");
    }

    static public function crear($data)
    {
        $res = self::create($data);
        return $res ? respuesta::ok($res) : respuesta::error("No se ha podido registrar.");
    }

    static public function get($id_promocion)
    {
        $res = self::where("id_promocion", $id_promocion)->first();
        return $res ? respuesta::ok($res) : respuesta::error("No se ha encontrado data relacionada.");
    }
}
