<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuesta;
use App\Http\Controllers\convertMeasureValueController;
use App\Http\Controllers\WebhookController;
use App\Models\SenderRequest;
use App\Models\Sender;
use App\Models\SensorSender;
use App\Models\Block;
use App\Models\Measurement;
use App\Models\Slot;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CWTController extends Controller
{
    public function receive (Request $request){
        Log::info("Request sender");
        Log::info($request->all());
        $content_request = $request->all();
        if(empty($content_request["DID"])){
            SenderRequest::create([
                "sr_content_request" => json_encode($content_request),
                "psis_sr_status" => "000020" // NO VALIDO
            ]);
            return respuesta::error("Request no valido");
        }

        $sender_serie = $content_request["DID"];
        $sender = Sender::get_bySerial($sender_serie);
        if(!$sender["estado"]){
            SenderRequest::create([
                "sr_content_request" => json_encode($content_request),
                "sender_serial" => $sender_serie,
                "psis_sr_status" => "000018" // NO ENCONTRADO
            ]);
            return $sender;
        }

        $sender = $sender["payload"];
        if($sender->sender_status != 1){
            SenderRequest::create([
                "sr_content_request" => json_encode($content_request),
                "sender_serial" => $sender_serie,
                "sender_id" => $sender->sender_id,
                "psis_sr_status" => "000019" // NO HABILITADO
            ]);
            return respuesta::error("NO HABILITADO");
        }

        $sender_request = SenderRequest::create([
            "sr_content_request" => json_encode($content_request),
            "sender_serial" => $sender_serie,
            "sender_id" => $sender->sender_id,
            "psis_sr_status" => "000017" // NO HABILITADO
        ]);

        Log::info("guardando heart beat");
        Sender::update_heart_beat($sender->sender_id);
        Block::update_last_connection($sender->sender_id);

        $tipo_request = $content_request["PID"];

        switch ($tipo_request) {
            case "41":
                return self::proceso_request_tipo_41($content_request, $sender);
                break;
            case "22":
                return self::proceso_request_tipo_22($content_request, $sender);
                break;
            default:
               Log::info("No se ha considerado el registro de este PID aun ".$tipo_request);
               return respuesta::ok();
        }
    }

    // Proceso PID 41 => All Modbus Register
    static public function proceso_request_tipo_41 ($content_request, $sender){
        if($content_request["PID"] != 41){
            return respuesta::error("Proceso no valido");
        }
        $datetime_now = Carbon::now();
        
        $data_report = [
            "sender_id" => $sender->sender_id,
            "datetime" => $datetime_now->format('d/m/Y H:i:s'),
            "detalle" => [],
            "last_report" => []
        ];

        $channels = array_map('intval', explode(",", $content_request["CHAN"]));
        for($i = $channels[0]; $i < ($channels[0] + $channels[1]); $i++){
            $MDR_N = $content_request["MDR".$i]; // Modbus register => Valor del registro
            $MDS_N = $content_request["MDS".$i]; // Modbus register status => 0: Normal, 1: Alarm, 2: Disconnect, 3: Out of range
            $MDT_N = $content_request["MDT".$i]; // Modbus register type => 0: Coil,1: Integer

            if($MDS_N != 0 && $MDS_N != 1){
                Log::info("No se registra el MDR".$i." de ".$content_request["DID"]." estado ".$MDS_N);
                continue;
            }

            $channel_N = "MDR".$i;

            $sensor_sender = SensorSender::get_byChannel($channel_N, $sender->sender_id);
            if(!$sensor_sender["estado"]){
                Log::info("No se encuentra el MDR".$i." de ".$content_request["DID"]." estado ".$MDS_N);
                continue;
            }
            $sensor_sender = $sensor_sender["payload"];

            if(!empty($sensor_sender->ss_config)){
                Log::info("Se va a procesar la configuracion ".$sensor_sender->ss_config);
                $MDR_N_tmp = convertMeasureValueController::procesa($content_request, $sensor_sender->ss_config);
                $MDR_N = (is_array($MDR_N_tmp))? $MDR_N : $MDR_N_tmp;
            }

            $data_report["detalle"][$channel_N] = $MDR_N;
            $data_report["last_report"][$channel_N] = $sensor_sender->slot_updated_at;

            Measurement::create([
                "sensor_id" => $sensor_sender->sensor_id,
                "slot_id" => $sensor_sender->slot_id,
                "measurement_value" => $MDR_N,
                "measurement_date" => $datetime_now
            ]);

            Slot::update_last_value_sensor($sensor_sender->slot_id, $MDR_N);
            Log::info("Registrando MDR".$i." de ".$content_request["DID"]." estado ".$MDS_N);
        }

        WebhookController::ejecutar_webhook($data_report);
        
        return respuesta::ok($data_report);
    }

    // Proceso PID 22 => All Analog Inputs
    static public function proceso_request_tipo_22 ($content_request, $sender){
        if($content_request["PID"] != 22){
            return respuesta::error("Proceso no valido");
        }
        $channels = intval($content_request["CHAN"]);
        for($i = 0; $i < $channels; $i++){
            $AI_N = $content_request["AI".$i]; // Analog input => Valor del registro
            $AIS_N = $content_request["AIS".$i]; // Analog input status => 0: Normal, 1: Alarm, 2: Disconnect, 3: Out of range

            if($AIS_N != 0 && $AIS_N != 1 && $AIS_N != 3){
                Log::info("No se registra el AI".$i." de ".$content_request["DID"]." estado ".$AIS_N);
                continue;
            }

            $channel_N = "AI".$i;

            $sensor_sender = SensorSender::get_byChannel($channel_N, $sender->sender_id);
            if(!$sensor_sender["estado"]){
                Log::info("No se encuentra el AI".$i." de ".$content_request["DID"]." estado ".$AIS_N);
                continue;
            }
            $sensor_sender = $sensor_sender["payload"];

            Measurement::create([
                "sensor_id" => $sensor_sender->sensor_id,
                "slot_id" => $sensor_sender->slot_id,
                "measurement_value" => $AI_N
            ]);
            Slot::update_last_value_sensor($sensor_sender->slot_id, $AI_N);
            Log::info("Registrando AI".$i." de ".$content_request["DID"]." estado ".$AIS_N);
        }
        
        return respuesta::ok();

    }
}
