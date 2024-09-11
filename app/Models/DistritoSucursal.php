<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class DistritoSucursal extends Model
{
    use HasFactory;
    protected $table = 'distrito_sucursal';
    protected $primaryKey = 'id_distrito';

    protected $fillable = [
        'nombre_distrito'
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
                             distrito_sucursal_datos as (
                    select
                        ds.id_distrito
                        ,ds.nombre_distrito
                        ,count(ds.id_distrito) over() as totalrecords
                        from distrito_sucursal ds
                ),
                distrito_sucursal_busqueda as (
                    select p.* , count(id_distrito) over() as totalrecordswithfilter
                    from distrito_sucursal_datos p
                    cross join datos_input di
                    where nombre_distrito ilike  '%'||di.palabra||'%'
                ),
                distrito_sucursal_paginado as (
                    select
                    *
                    from distrito_sucursal_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from distrito_sucursal_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_distrito, $data){
        if(empty($id_distrito) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_distrito", $id_distrito)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }
    static public function crear($data){
        $res = self::create($data);
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha podido registrar");
        }
    }

    static public function get($id_distrito){
        if(empty($id_distrito)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_distrito", $id_distrito)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }



}
