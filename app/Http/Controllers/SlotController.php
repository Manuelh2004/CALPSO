<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuesta;
use App\Models\Slot;
use App\Models\Measurement;
use Response;
use App\Models\Block;
use DateTime;
use DateTimeZone;

class SlotController extends Controller
{
    public function ver($slot_id){
    	$slot = Slot::get_detalle($slot_id);
		if(!$slot["estado"]){
			return $slot;
		}

		$slot = $slot["payload"];
		$medicion = Measurement::ultimas_mediciones($slot_id, $slot->updated_at);
		if($medicion["estado"]){
			$medicion = $medicion["payload"];
			$data = [
				"value" => [],
				"date" => [],
				"timestamp" => [],
			];

			foreach ($medicion as $medida) {
				$fecha = new DateTime($medida["measurement_date"], new DateTimeZone('America/Lima'));
				array_push($data["value"], $medida["measurement_value"]);
				array_push($data["date"], $medida["measurement_date"]);
				array_push($data["timestamp"], $fecha->getTimestamp());
			}

			$slot->data = $data;
			$slot->last = (count($medicion) > 0)? $medicion[(count($medicion)-1)] : [];
			return respuesta::ok($slot);
		} else {
			return $medicion;
		}
    }

	public function historico($slot_id, Request $request){
        $fecha_inicio = $request->input('fecha_inicio', "");
        $fecha_fin = $request->input('fecha_fin', "");
        $slot_id = intval($slot_id);

        $slot = Slot::get_detalle($slot_id);
		if(!$slot["estado"]){
			return $slot;
		}

        $slot = $slot["payload"];
		$medicion = Measurement::historico_mediciones($slot_id, $fecha_inicio, $fecha_fin);
		if($medicion["estado"]){
			$medicion = $medicion["payload"];
			$data = [
				"value" => [],
				"date" => [],
				"timestamp" => [],
			];

			foreach ($medicion as $medida) {
				$fecha = new DateTime($medida["measurement_date"], new DateTimeZone('America/Lima'));
				array_push($data["value"], $medida["measurement_value"]);
				array_push($data["date"], $medida["measurement_date"]);
				array_push($data["timestamp"], $fecha->getTimestamp());
			}

			$slot->data = $data;
			$slot->last = (count($medicion) > 0)? $medicion[(count($medicion)-1)] : [];
			return respuesta::ok($slot);
		} else {
			return $medicion;
		}
        
    }
}
