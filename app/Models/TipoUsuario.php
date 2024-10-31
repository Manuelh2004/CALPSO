<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class TipoUsuario extends Model
{
    use HasFactory;
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'id_tipo';
    protected $fillable = [
        'nombre_tipo',
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
		        tipo_empleado_datos as (
                    select
                        te.id_tipo
                        ,te.nombre_tipo
                        ,te.descripcion
                        ,count(te.id_tipo) over() as totalrecords
                        from tipo_usuario te
                ),
                tipo_empleado_busqueda as (
                    select p.* , count(id_tipo) over() as totalrecordswithfilter
                    from tipo_empleado_datos p
                    cross join datos_input di
                    where nombre_tipo ilike  '%'||di.palabra||'%'
                ),
                tipo_empleado_paginado as (
                    select
                    *
                    from tipo_empleado_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from tipo_empleado_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function actualizar($id_tipo, $data){
        if(empty($id_tipo) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_tipo", $id_tipo)
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

    static public function get($id_tipo){
        if(empty($id_tipo)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_tipo", $id_tipo)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }

    static public function listar_tipo_empleado (){
        return DB::select(
            DB::raw("
            SELECT
                    tc.id_tipo
                    , tc.nombre_tipo
                FROM tipo_empleado tc
            "),
            [ ]
        );
    }
}
