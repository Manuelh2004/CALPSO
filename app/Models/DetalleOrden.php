<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

class DetalleOrden extends Model
{
    use HasFactory;
    protected $table = 'detalle_orden';
    protected $primaryKey = 'id_detalle_orden';

    protected $fillable = [
        'id_orden',
        'id_item_menu',
        'cantidad',
        'sub_total_orden'
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
                              detalle_orden_datos as (
                    select
                        deo.id_detalle_orden
                        ,e.nombre_empleado
					  	,c.nombre_cliente
                        ,im.nombre_item
                        ,deo.cantidad
						,deo.sub_total_orden
                        ,count(deo.id_detalle_orden) over() as totalrecords
                        from detalle_orden deo
						JOIN orden o ON o.id_orden = deo.id_orden
						JOIN empleado e ON e.id_empleado = o.id_empleado
						JOIN cliente c ON c.id_cliente = o.id_cliente
						JOIN item_menu im ON im.id_item_menu = deo.id_item_menu
                    ),
                    detalle_orden_busqueda as (
                        select p.* , count(id_detalle_orden) over() as totalrecordswithfilter
                        from detalle_orden_datos p
                        cross join datos_input di
                        where nombre_item ilike  '%'||di.palabra||'%'
                    ),
                    detalle_orden_paginado as (
                        select
                        *
                        from detalle_orden_busqueda
                        order by ".$columnName." ".$columnSortOrder."
                        offset (select start from datos_input)
                        limit (select rowperpage from datos_input)
                    )
                    select * from detalle_orden_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }
    static public function actualizar($id_detalle_orden, $data){
        if(empty($id_detalle_orden) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }
        $res = self::where("id_detalle_orden", $id_detalle_orden)
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

    static public function get($id_detalle_orden){
        if(empty($id_detalle_orden)){
            return respuesta::error("Datos no validos para la busqueda.");
        }
        $res = self::where("id_detalle_orden", $id_detalle_orden)
                ->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
        }
    }





}
