<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Block extends Model
{
    protected $primaryKey = "block_id";
    protected $table = "block";

    protected $fillable = ['psis_block_type', 'block_codename', 'block_name', 'block_serial', 'parent_block_id', 'block_canvas_order', 'block_longitude', 'block_latitude', 'block_altitude', 'block_description', 'codigo_ubigeo', 'file_id_logo', 'file_id_image', 'block_max_time_offline', 'block_reporting_period', 'block_config', 'block_status'];

    static public function listar_estaciones($user_id){
        if(empty($user_id)){
            return respuesta::error("Parametros no validos.");
        }
        
        $res = DB::select( 
            DB::raw("
                select 
                    b.block_id as id
                    ,b.block_codename
                    ,b.block_name
                    ,b.block_serial
                    ,b.parent_block_id as id_parent_block
                    ,b.block_longitude as longitude
                    ,b.block_latitude as latitude
                    ,b.block_altitude as altitude
                    ,b.block_description as description
                    ,b.block_config as config
                    ,to_char(b.updated_at, 'YYYY-MM-DD HH24:MI:SS') as updated_at
                from  block b
                join user_block ub
                on ub.block_id = b.block_id
                where ub.user_id = :user_id
                and b.psis_block_type = '000001'
                and b.block_status > 0
                order by b.block_id asc
            "),
            ["user_id" => $user_id ]
        );

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se puede obtener la informacion");
        }
    }

    static public function ver_estacion($estacion_id, $estado=NULL){
        if(isset($estado)){
            $estacion = self::where('block_id', $estacion_id)
                            ->where('psis_block_type', '000001')
                            ->where('block_status', $estado)
                            ->select(
                                "block_id as id",
                                "block_codename",
                                "block_name",
                                "parent_block_id as id_parent_block",
                                "block_longitude as longitude",
                                "block_latitude as latitude",
                                "block_altitude as altitude",
                                "block_description as description",
                                "block_config as config"
                            )->first();
        } else {
            $estacion = self::where('block_id', $estacion_id)
                            ->where('psis_block_type', '000001')
                            ->select(
                                "block_id as id",
                                "block_codename",
                                "block_name",
                                "parent_block_id as id_parent_block",
                                "block_longitude as longitude",
                                "block_latitude as latitude",
                                "block_altitude as altitude",
                                "block_description as description",
                                "block_config as config"
                            )->first();
        }
        
        if(isset($estacion)){
            $sensores = Slot::where("block_id", $estacion_id)
                        ->where('slot_status', 1)
                        ->where('slot_visible', 1)
                        ->select(
                            "slot_id"
                        )->get();

            if(isset($sensores)){
                $s = [];
                foreach ($sensores as $sensor) {
                    array_push($s, $sensor["slot_id"]);
                }
                $estacion["sensores"] = $s;
                return respuesta::ok($estacion);

            } else {
                return respuesta::error("Ha ocurrido un error mientras se procesaba la consulta");
            }
        } else {
            return respuesta::error("Ha ocurrido un error mientras se procesaba la consulta");
        }
    }

    static public function detalle_estacion($block_id, $estado=null){
        if(empty($block_id)){
            return respuesta::error("Parametros no suficientes");
        }

        $estacion = self::where('block_id', $block_id)
                        ->where('psis_block_type', '000001');

        if(isset($estado)){
            $estacion = $estacion->where('block_status', $estado);
        }

        $estacion = $estacion->select(
                                "block_id as id",
                                "block_codename",
                                "block_name",
                                "parent_block_id as id_parent_block",
                                "block_longitude as longitude",
                                "block_latitude as latitude",
                                "block_altitude as altitude",
                                "block_description as description",
                                "block_config as config"
                            )->first();

        if(isset($estacion)){
            return respuesta::ok($estacion);
        } else {
            return respuesta::error("Ha ocurrido un error mientras se procesaba la consulta");
        }
    }

    static public function update_last_connection($sender_id){
        if(empty($sender_id)){
         return respuesta::error("Parametros no validos.");   
        }
        
        $res = self::leftJoin("sender_block as sb", "sb.block_id", "block.block_id" )
                ->where("sb.sender_id", $sender_id)
                ->where("sb.sb_status", 1)
                ->update(["updated_at" => Carbon::now()]);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha podido realizar la accion.");
        }
    }

    static public function listar_medicion_por_sensor($user_id, $sm_id, $fecha_inicio, $fecha_fin){
        if(empty($user_id) || empty($sm_id) || empty($fecha_inicio) || empty($fecha_fin)){
            return respuesta::error("Parametros no validos.");
        }
        
        $res = DB::select( 
            DB::raw("
                with
                datos_input as (
                    select 
                        :fecha_inicio::date as fecha_inicio
                        ,:fecha_fin::date as fecha_fin
                        ,:user_id::int as user_id
                        ,:sm_id::int as sm_id
                ),
                fechas as(
                    select 
                        t.dia
                    from datos_input di
                    ,generate_series(di.fecha_inicio,di.fecha_fin,'1 day') as t(dia)
                ),
                data_slot as(
                    select distinct
                        
                        sl.slot_id
                        
                    from datos_input di
                    left join user_block ub
                    on ub.user_id = di.user_id
                    left join slot sl
                    on sl.block_id = ub.block_id --and sl.slot_status = 1
                    left join sensor s
                    on s.sensor_id = sl.sensor_id
                        --and s.sm_id = di.sm_id
                    --where ub.user_id = 1 -- variable :user_id
                    --and sl.slot_status = 1
                    --and s.sm_id = 3
                    where sl.slot_status = 1
                    and s.sm_id = 3
                ),
                mediciones as(
                    select distinct
                        f.dia
                        ,ds.slot_id
                        ,avg(m.measurement_value) over(partition by ds.slot_id,f.dia)::numeric(12,3) as valor
                    from fechas f
                    left join data_slot ds on true
                    left join measurement m
                        on f.dia=(m.measurement_date::date)
                        and m.slot_id = ds.slot_id--45
                
                ),
                datos_agrupados as(
                    select distinct
                        slot_id
                        ,array_agg(coalesce(m.valor,0)) over(partition by slot_id order by dia rows BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING
                                                            ) as ary_valores
                        ,f.d as dias
                    from mediciones m
                    cross join (select array_agg(to_char(dia,'DD-MM'))from fechas ) as f(d)
                )
                select * from datos_agrupados;
            "),
            ["user_id" => $user_id, "sm_id" => $sm_id, "fecha_inicio" => $fecha_inicio, "fecha_fin" => $fecha_fin ]
        );

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se puede obtener la informacion");
        }
    }


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
                block_datos as (
                    select
                    b.block_id
                    ,b.psis_block_type
                    ,b.block_codename
                    ,b.block_name
                    ,b.block_serial
                    ,b.parent_block_id
                    ,b.block_canvas_order
                    ,b.block_longitude
                    ,b.block_latitude
                    ,b.block_description
                    ,b.block_max_time_offline
                    ,b.block_reporting_period
                    ,b.block_status
                    ,count(b.block_id) over() as totalrecords
                    from block b
                ),
                block_busqueda as (
                    select b.* , count(block_id) over() as totalrecordswithfilter
                    from block_datos b
                    cross join datos_input di
                    where block_codename ilike  '%'||di.palabra||'%'
                    or block_name ilike  '%'||di.palabra||'%'
                    or block_serial ilike  '%'||di.palabra||'%'
                    or block_description ilike  '%'||di.palabra||'%'
                ),
                block_paginado as (
                    select
                    *
                    from block_busqueda
                    order by ".$columnName." ".$columnSortOrder."
                    offset (select start from datos_input)
                    limit (select rowperpage from datos_input)
                )
                select * from block_paginado
            "),
            ["searchvalue"=>$searchValue, "skip"=> $start, "rowperpage"=>$rowperpage ]
        );
    }

    static public function get($block_id){
        if(empty($block_id)){
            return respuesta::error("Datos no validos para la busqueda.");
        }

        $res = self::where("block_id", $block_id)
                ->first();
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado data relacionada.");
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

    static public function cambiar_estado($block_id, $estado){
        

        return self::actualizar($block_id,[
            "block_status" => $estado
        ]);
    }

    static public function dar_baja ($block_id){
        return self::cambiar_estado($block_id, 0);
    }

    static public function dar_alta ($block_id){
        return self::cambiar_estado($block_id, 1);
    }

    static public function actualizar($block_id, $data){
        if(empty($block_id) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("block_id", $block_id)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }
}
