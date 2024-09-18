<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;


class areaEmpleado extends Model
{
    use HasFactory;
    protected $table = 'area_empleado';
    protected $primaryKey = 'id_area';

    protected $fillable = [
        'nombre_area',
        'descripcion', 
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
              	    nombre_area_datos as (
                    select
                        c.id_area
                        ,tp.nombre_area
                        ,c.descripcion
                        ,count(c.id_area) over() as totalrecords
                        from cliente c
                        JOIN tipo_empleado tp ON c.id_tipo_empleado = tp.id_tipo_empleado
                ),
                area_busqueda as (
                    select p.* , count(id_area) over() as totalrecordswithfilter
                    from id_
                    cross join datos_input di
                    where area_empleado ilike  '%'||di.palabra||'%'
                ),
                area_empleado_paginado as (
                    select
                    *
                    from cliente_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from area_empleado_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    
    static public function actualizar($id_area, $data){
        if(empty($id_area) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_area", $id_tipo)
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
                    tc.id_area
                    , tc.nombre_area
                FROM area_empleado tc
            "),
            [ ]
        );
    }


}    