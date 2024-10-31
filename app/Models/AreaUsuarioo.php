<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class AreaUsuarioo extends Model
{
    use HasFactory;
    protected $table = 'area_usuario';
    protected $primaryKey = 'id_area';

    protected $fillable = [
        'nombre_area',
        'descripcion'
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
                area_usuario_datos as (
                    select
                        ae.id_area
                        ,ae.nombre_area
                        ,ae.descripcion
                        ,count(ae.id_area) over() as totalrecords
                        from area_usuario ae
                ),
                area_usuario_busqueda as (
                    select p.* , count(id_area) over() as totalrecordswithfilter
                    from area_usuario p
                    cross join datos_input di
                    where nombre_area ilike  '%'||di.palabra||'%'
                ),
               area_usuario_paginado as (
                    select
                    *
                    from area_usuario_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from area_usuario_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function actualizar($id_area, $data){
        if(empty($id_area) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_area", $id_area)
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
    static public function get($id_area){
        if(empty($id_area)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_area", $id_area)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function listar_area_empleado (){
        return DB::select(
            DB::raw("
            SELECT
                    ae.id_area
                    ,ae.nombre_area
                FROM area_empleado ae
            "),
            [ ]
        );
    }
}
