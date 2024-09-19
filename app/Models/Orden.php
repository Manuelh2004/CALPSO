<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;


class Orden extends Model
{
    use HasFactory;
    protected $table = 'orden';
    protected $primaryKey = 'id_orden';

    protected $fillable = [
        'id_cliente',
        'id_sucursal',
        'id_empleado',
        'fecha_orden',
        'total_orden',
        'estado',
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
                    orden_datos as (
                    select
                        o.id_orden
                        ,e.nombre_empleado
					  	,c.nombre_cliente
                        ,ds.nombre_distrito
                        ,o.fecha_orden
						,o.total_orden
						,o.estado
                        ,count(o.id_orden) over() as totalrecords
                        from orden o
						JOIN empleado e ON e.id_empleado = o.id_empleado
						JOIN cliente c ON c.id_cliente = o.id_cliente
						JOIN sucursal s ON s.id_sucursal = o.id_sucursal
						JOIN distrito_sucursal ds ON ds.id_distrito = s.id_distrito
                    ),
                   orden_busqueda as (
                        select p.* , count(id_orden) over() as totalrecordswithfilter
                        from orden_datos p
                        cross join datos_input di
                        where nombre_cliente ilike  '%'||di.palabra||'%'
                    ),
                    orden_paginado as (
                        select
                        *
                        from orden_busqueda
                        order by ".$columnName." ".$columnSortOrder."
                        offset (select start from datos_input)
                        limit (select rowperpage from datos_input)
                    )
                    select * from orden_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_orden, $data){
        if(empty($id_orden) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }
        $res = self::where("id_orden", $id_orden)
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

    static public function get($id_orden){
        if(empty($id_orden)){
            return respuesta::error("Datos no validos para la busqueda.");
        }
        $res = self::where("id_orden", $id_orden)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }
    static public function cambiar_estado($id_orden, $estado){
        return self::actualizar($id_orden,[
            "estado" => $estado
        ]);
    }

    static public function dar_baja ($id_orden){
        return self::cambiar_estado($id_orden, 0);
    }

    static public function dar_alta ($id_orden){
        return self::cambiar_estado($id_orden, 1);
    }


}
