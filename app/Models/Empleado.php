<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\respuesta;

class Empleado extends Model
{
    use HasFactory;
    protected $table ='empleado';
    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'id_area',
        'id_cargo',
        'id_tipo',
        'id_sucursal',
        'nombre_empleado',
        'edad',
        'correo_electronico',
        'genero',
        'estado',
        'password'
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
              	empleado_datos as (
				select
					e.id_empleado
					,e.nombre_empleado
					,ae.nombre_area
					,ce.nombre_cargo
					,tp.nombre_tipo
					,ds.nombre_distrito
					,u.name
					,u.password
					,e.correo_electronico
					,e.edad
					,e.genero
					,e.estado
					,count(e.id_empleado) over() as totalrecords
					from empleado e
					JOIN tipo_empleado tp ON e.id_tipo = tp.id_tipo
					JOIN area_empleado ae ON e.id_area = ae.id_area
					JOIN cargo_empleado ce ON e.id_cargo = ce.id_cargo
					JOIN sucursal s ON s.id_sucursal = e.id_sucursal
					JOIN distrito_sucursal ds ON ds.id_distrito = s.id_distrito
					JOIN usuario u ON u.usuario_id = e.usuario_id
                ),
                empleado_busqueda as (
                    select p.* , count(id_empleado) over() as totalrecordswithfilter
                    from empleado_datos p
                    cross join datos_input di
                    where nombre_empleado ilike  '%'||di.palabra||'%'
                ),
                empleado_paginado as (
                    select
                    *
                    from empleado_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from empleado_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function actualizar($id_empleado, $data){
        if(empty($id_empleado) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }
        $res = self::where("id_empleado", $id_empleado)
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
            return respuesta::error("Nel perro, brazo de 35 xd");
        }
    }

    static public function get($id_empleado){
        if(empty($id_cliente)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("id_empleado", $id_empleado)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado ninguna informacion.");
        }
    }

    static public function cambiar_estado($id_empleado, $estado){
        return self::actualizar($id_empleado,[
            "estado" => $estado
        ]);
    }

    static public function dar_baja ($id_empleado){
        return self::cambiar_estado($id_empleado, 0);
    }

    static public function dar_alta ($id_empleado){
        return self::cambiar_estado($id_empleado, 1);
    }
}
