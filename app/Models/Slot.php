<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;


class Slot extends Model
{
    protected $primaryKey = "slot_id";
    protected $table = "slot";

    protected $fillable = [
        'parameter_id',
        'block_id',
        'sensor_id',
        'up_danger_limit',
        'up_risk_limit',
        'down_risk_limit',
        'down_danger_limit',
        'slot_last_value',
        'slot_average_limit_state',
        'slot_average_value',
        'slot_config',
        'slot_status',
        'slot_visible',
        'slot_supervise',
    ];    

    static public function get_detalle($slot_id){
        if(empty($slot_id)){
            return respuesta::error("Parametros no validos.");
        }

        $res = DB::select( 
            DB::raw('
                select 
                    sl.slot_id as id
                    ,sl.block_id as id_block
                    ,sl.sensor_id as id_sensor
                    ,sl.up_danger_limit as "LMP"
                    ,sl.up_risk_limit as "LMR"
                    ,sl.down_risk_limit as "LIR"
                    ,sl.down_danger_limit as "LIP"
                    ,sl.slot_config as config
                    ,s.sensor_codename as codename
                    ,p.parameter_name
                    ,mu.mu_code as unit
                    ,sm.sm_max_limit as max_limit
                    ,sm.sm_min_limit as min_limit
                    ,sl.updated_at
                from slot sl
                left join sensor s
                on sl.sensor_id = s.sensor_id
                left join sensor_model sm 
                on sm.sm_id = s.sm_id
                left join measurement_unit mu
                on mu.mu_id = sm.mu_id
                left join parameter p
				on p.parameter_id = sl.parameter_id
                where slot_id = :slot_id
                and slot_status = 1
                limit 1
            '),
            ["slot_id" => $slot_id ]
        );

        if(isset($res)){
            return respuesta::ok($res[0]);
        } else {
            return respuesta::error("No se puede obtener la informacion");
        }
    }

    static public function listarEstacion($block_id){
        if(empty($block_id)){
            return respuesta::error("Parametros no validos.");
        }

        $res = DB::select( 
            DB::raw('
                select 
                    sl.slot_id as id
                    ,sl.block_id as id_block
                    ,sl.sensor_id as id_sensor
                    ,sl.up_danger_limit as "LMP"
                    ,sl.up_risk_limit as "LMR"
                    ,sl.down_risk_limit as "LIR"
                    ,sl.down_danger_limit as "LIP"
                    ,sl.slot_config as config
                    ,sl.slot_average_value as average_value
                    ,sl.slot_supervise as supervise
                    ,s.sensor_codename as codename
                    ,p.parameter_name
                    ,mu.mu_code as unit
                    ,sm.sm_max_limit as max_limit
                    ,sm.sm_min_limit as min_limit
                    ,sl.updated_at
                from slot sl
                left join sensor s
                on sl.sensor_id = s.sensor_id
                left join sensor_model sm 
                on sm.sm_id = s.sm_id
                left join measurement_unit mu
                on mu.mu_id = sm.mu_id
                left join parameter p
				on p.parameter_id = sl.parameter_id
                where block_id = :block_id
                and sl.slot_status = 1
                and sl.slot_visible = 1
            '),
            ["block_id" => $block_id ]
        );

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se puede obtener la informacion");
        }
    }

    static public function get($sensor_id)
    {
        if (empty($sensor_id)) {
            return respuesta::error("Parametros incompletos");
        }

        $bs = self::where("block_sensors.id_sensor", $sensor_id)
            ->first();
        if (isset($bs)) {
            return respuesta::ok($bs);
        } else {
            return respuesta::error("Hubo un problema en la consulta.");
        }
    }

    static public function update_last_value_sensor($slot_id, $value, $date = null)
    {
        if (empty($slot_id) || !isset($value)) {
            return respuesta::error("Parametros invalidos.");
        }

        if(empty($date)){
            $date = date("Y-m-d H:i:s");
        }

        $bs = self::where("slot_id", $slot_id)
            ->update(["slot_last_value" => $value, "updated_at" => $date]);
        if (isset($bs)) {
            return respuesta::ok($bs);
        } else {
            return respuesta::error("Hubo problemas en la consulta.");
        }
    }

    static public function update_average($id_block_sensor, $value)
    {
        if (empty($id_block_sensor) || !isset($value)) {
            return respuesta::error("Parametros invalidos.");
        }
        $bs = self::where("id", $id_block_sensor)
            ->update(["average_value" => $value, 'updated_at' => DB::raw('updated_at')]);
        if (isset($bs)) {
            return respuesta::ok($bs);
        } else {
            return respuesta::error("Hubo problemas en la consulta.");
        }
    }

    static public function get_sensor_information($id_sensor)
    {
        $result = DB::select(
            "
            select
                bs.*,
                sm.max_limit,
                sm.min_limit
            from block_sensors bs
                left join sensors s
                on s.id_sensor = bs.id_sensor
                left join sensor_models sm
                on sm.id_sensor_model = s.id_sensor_model
                where s.id_sensor = :id_sensor;
            ",
            ["id_sensor" => $id_sensor]
        );

        if (isset($result)) {
            return respuesta::ok($result[0]);
        } else {
            return respuesta::error("No se encontro el sensor.");
        }
    }


    static public function list_superviced()
    {
        $result = DB::select(
            "
            with
            sensor_supervice as (
                select
                bs.id,
                bs.id_sensor,
                bs.average_value,
                bs.updated_at
                from block_sensors bs
                where bs.supervise = 1
                and bs.active = 1
            )
            select * from sensor_supervice
            ",
            []
        );

        if (isset($result)) {
            return respuesta::ok($result);
        } else {
            return respuesta::error("No se encontro el sensor.");
        }
    }

    

}
