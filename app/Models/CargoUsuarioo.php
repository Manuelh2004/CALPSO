<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class CargoUsuarioo extends Model
{
    use HasFactory;
    protected $table = 'cargo_usuario';
    protected $primaryKey = 'id_cargo';

    protected $fillable = [
        'nombre_cargo',
        'descripcion',
        'salario_base'
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
              	             	cargo_empleado_datos as (
				select
					c.id_cargo
					,c.nombre_cargo
					,c.descripcion
					,salario_base
					,count(c.id_cargo) over() as totalrecords
					from cargo_usuario c
                ),
                cargo_empleado_busqueda as (
                    select p.* , count(id_cargo) over() as totalrecordswithfilter
                    from cargo_empleado_datos p
                    cross join datos_input di
                    where nombre_cargo ilike  '%'||di.palabra||'%'
                ),
                cargo_empleado_paginado as (
                    select
                    *
                    from cargo_empleado_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from cargo_empleado_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function actualizar($id_cargo, $data){
        if(empty($id_cargo) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("id_cargo", $id_cargo)
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

    static public function get($id_cargo){
        if(empty($id_cargo)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_cargo", $id_cargo)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }

    static public function listar_cargo_empleado (){
        return DB::select(
            DB::raw("
            SELECT
                    ce.id_cargo
                    , ce.nombre_cargo
                FROM cargo_empleado ce
            "),
            [ ]
        );
    }
}
