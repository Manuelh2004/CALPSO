<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuesta;
use App\Models\WebhookHistorical;
use App\Models\WebhookReport;
use App\Models\WebhookService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


use DateTime;
use DateTimeZone;

class WebhookController extends Controller
{
    static public function obtener_token_webhook ($ws_id){
        $webhook_service = WebhookService::get_byId($ws_id);
        if(!$webhook_service["estado"]){
            return $webhook_service;
        }

        $webhook_service = $webhook_service["payload"];
        if(!empty($webhook_service["ws_token_expire"])){
            $token_expire = Carbon::parse($webhook_service["ws_token_expire"]);
            if ($token_expire->greaterThan(Carbon::now())){
                return respuesta::ok([
                    "url" => $webhook_service->ws_url,
                    "token" => $webhook_service->ws_token
                ]);
            }
        }

        // validar informacion para usar el token
        try {
            $response = Http::post($webhook_service->ws_auth_url, json_decode($webhook_service->ws_auth_parameters, true));
            if ($response->successful()) {
                // La solicitud fue exitosa (código de respuesta en el rango 2xx)
                $payload = $response->json();
                
                // $token_expire = Carbon::parse($payload["expires"]);
                $token_expire = Carbon::createFromFormat('d/m/Y H:i:s', $payload["expires"]);
                $token = $payload["token"];

                $res = WebhookService::actualizar($ws_id, [
                    "ws_token" => $token,
                    "ws_token_expire" =>  $token_expire
                ]);

                if(!$res["estado"]){
                    Log::error("No se ha logrado actualizar el token.", $payload);
                }

                return respuesta::ok([
                    "url" => $webhook_service->ws_url,
                    "token" => $token
                ]);
            } else {
                Log::error("No se ha logrado iniciar sesion.", ["webhook_service" => $ws_id, "http_status" => $response->status()]);
                return respuesta::error("No se ha logrado iniciar sesión");
            }
        } catch (\Exception $e) {
            Log::error("WebhookController - Error autenticacion: " . $e->getMessage());
            return respuesta::error("No se ha podido realizar la consulta de autenticación");
        }
    }

    static public function ejecutar_webhook($data){

        $webhook_report = WebhookReport::get_bySender($data["sender_id"]);
        if(!$webhook_report["estado"]){
            return $webhook_report;
        }
        $webhook_report = $webhook_report["payload"];

        if($webhook_report->wr_status != 1){
            Log::info("Reporte no habilitado para sender_id: ".$data["sender_id"]);
            return respuesta::error("El reporte no esta habilitado");
        }

        $next_report_date = Carbon::parse($webhook_report["wr_next_report"]);
        
        if (Carbon::now()->greaterThan($next_report_date)){
            $period_report = ($webhook_report["wr_period_report"] > 1)? $webhook_report["wr_period_report"] - 1 : $webhook_report["wr_period_report"];

            WebhookReport::actualizar_next_report($webhook_report["wr_id"], Carbon::now()->addMinutes($period_report));
            return self::enviar_reporte($data, $webhook_report);
        } else {
            $new_data = [
                "sender_id" => $data["sender_id"],
                "datetime" => $data["datetime"],
                "detalle" => []
            ];

            if(!isset($data["last_report"])){
                return self::enviar_reporte($data, $webhook_report);
            }

            foreach($data["last_report"] as $channel => $last_date){
                $last = Carbon::parse($last_date);
                $last_period_date = Carbon::parse($webhook_report["wr_next_report"])->subMinutes($webhook_report["wr_period_report"]);
                if ($last_period_date->greaterThan($last)){
                    $new_data["detalle"][$channel] = $new_data["detalle"][$channel];
                }
            }

            if(count($new_data["detalle"]) == 0){
                Log::info("No se reportara porque aun no se cumple el tiempo de reporte");
                return respuesta::error("No hay registro que reportar al webhook");
            }

            Log::info("Nueva data para reporte", $new_data);

            return self::enviar_reporte($new_data, $webhook_report);
        }
    }

    static public function enviar_reporte($data, $webhook_report){
        $parameters_report = json_decode($webhook_report->wr_config_parameters, true);
        
        $body_report = self::procesar_funcion_reporte($data, $webhook_report->wr_function_report ,$parameters_report);

        $servicio_externo = self::obtener_token_webhook($webhook_report->ws_id);

        if(!$servicio_externo["estado"]){
            return $servicio_externo;
        }
        $servicio_externo = $servicio_externo["payload"];

        try {
            $response = Http::withHeaders([
                'Authorization' => $servicio_externo["token"]
            ])->post($servicio_externo["url"], $body_report);
            if ($response->successful()) {
                // La solicitud fue exitosa (código de respuesta en el rango 2xx)
                WebhookHistorical::create([
                    'wr_id' => $webhook_report->wr_id,
                    'sender_id' => $webhook_report->sender_id,
                    'wh_http_status' => $response->getStatusCode(),
                    'wh_http_response' => json_encode($response->json()),
                    'wh_status' => 1
                ]);

                Log::info("Data registrada servicio externo", $body_report);

                return respuesta::ok($response->json());
            } else {
                Log::error("No se ha registrado la data correctamente.", $body_report);
                WebhookHistorical::create([
                    'wr_id' => $webhook_report->wr_id,
                    'sender_id' => $webhook_report->sender_id,
                    'wh_http_status' => $response->getStatusCode(),
                    'wh_http_response' => json_encode($response->json()),
                    'wh_status' => 0
                ]);
                return respuesta::error("Error registrando servicio");
            }
        } catch (\Exception $e) {
            Log::error("WebhookController - Error Reporte: " . $e->getMessage());
            return respuesta::error("No se ha podido realizar la consulta de registro de reporte");
        }
    }

    static public function procesar_funcion_reporte ($data, $function_report, $parameters){
        switch ($function_report) {
			case "wf14_es22_datass":
					return self::function_report__wf14_es22_datass($data, $parameters);
				break;
			default:
					return $parameters; //si no encontramos la funcion, retornamos el mismo valor
				break;
		}
    }

    static public function function_report__wf14_es22_datass ($data, $parameters){
        $body_report = [
            "idProveedor" => $parameters["idProveedor"],
            "idCentroPoblado" => $parameters["idCentroPoblado"],
            "idSAP" => $parameters["idSAP"],
            "idDevice" => $parameters["idDevice"],
            "detalle" => []
        ];

        $datetime = Carbon::createFromFormat('d/m/Y H:i:s', $data["datetime"]);

        $valores = $data["detalle"];

        foreach($parameters["detalle"] as $parametro) {
            if(isset($valores[$parametro["channel"]])){
                array_push($body_report["detalle"], [
                    "idTipoMedida" => $parametro["idTipoMedida"],
                    "fechaRecoleccion" => $datetime->format('Y-m-d\TH:i:s'),
                    "valor" => $valores[$parametro["channel"]]
                ]);
            }
        }

        return $body_report;

    }

    public function test(){
        //return self::obtener_token_webhook(1);


        $data_1 = [
            "sender_id" => 19,
            "datetime" => '20/06/2023 11:44:21',
            "detalle" => [
                "MDR1" => round(2 * (1 + (mt_rand(-5, 5) / 100)), 4), // Turbiedad
                "MDR4" => round(20 * (1 + (mt_rand(-5, 5) / 100)), 4), // Caudal
                "MDR8" => round(7 * (1 + (mt_rand(-5, 5) / 100)), 4), // PH
                "MDR9" => round(15 * (1 + (mt_rand(-5, 5) / 100)), 4), // Temperatura
                "MDR10" => round(0.5 * (1 + (mt_rand(-5, 5) / 100)), 4) // Cloro
            ]
        ];

        $data_2 = [
            "sender_id" => 20,
            "detalle" => [
                "MDR1" => round(2 * (1 + (mt_rand(-5, 5) / 100)), 4), // Turbiedad
                "MDR4" => round(20 * (1 + (mt_rand(-5, 5) / 100)), 4), // Caudal
                "MDR8" => round(7 * (1 + (mt_rand(-5, 5) / 100)), 4), // PH
                "MDR9" => round(15 * (1 + (mt_rand(-5, 5) / 100)), 4), // Temperatura
                "MDR10" => round(0.5 * (1 + (mt_rand(-5, 5) / 100)), 4) // Cloro
            ]
        ];

        $data_3 = [
            "sender_id" => 21,
            "detalle" => [
                "MDR1" => round(2 * (1 + (mt_rand(-5, 5) / 100)), 4), // Turbiedad
                "MDR4" => round(20 * (1 + (mt_rand(-5, 5) / 100)), 4), // Caudal
                "MDR8" => round(7 * (1 + (mt_rand(-5, 5) / 100)), 4), // PH
                "MDR9" => round(15 * (1 + (mt_rand(-5, 5) / 100)), 4), // Temperatura
                "MDR10" => round(0.5 * (1 + (mt_rand(-5, 5) / 100)), 4) // Cloro
            ]
        ];

        $data_4 = [
            "sender_id" => 22,
            "detalle" => [
                "MDR1" => round(2 * (1 + (mt_rand(-5, 5) / 100)), 4), // Turbiedad
                "MDR4" => round(20 * (1 + (mt_rand(-5, 5) / 100)), 4), // Caudal
                "MDR8" => round(7 * (1 + (mt_rand(-5, 5) / 100)), 4), // PH
                "MDR9" => round(15 * (1 + (mt_rand(-5, 5) / 100)), 4), // Temperatura
                "MDR10" => round(0.5 * (1 + (mt_rand(-5, 5) / 100)), 4) // Cloro
            ]
        ];

        $data_5 = [
            "sender_id" => 23,
            "detalle" => [
                "MDR1" => round(2 * (1 + (mt_rand(-5, 5) / 100)), 4), // Turbiedad
                "MDR4" => round(20 * (1 + (mt_rand(-5, 5) / 100)), 4), // Caudal
                "MDR8" => round(7 * (1 + (mt_rand(-5, 5) / 100)), 4), // PH
                "MDR9" => round(15 * (1 + (mt_rand(-5, 5) / 100)), 4), // Temperatura
                "MDR10" => round(0.5 * (1 + (mt_rand(-5, 5) / 100)), 4) // Cloro
            ]
        ];

        self::ejecutar_webhook($data_1);
        //self::ejecutar_webhook($data_2);
        //self::ejecutar_webhook($data_3);
        //self::ejecutar_webhook($data_4);
        //self::ejecutar_webhook($data_5);
        return respuesta::ok();
    }
}
