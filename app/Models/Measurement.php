<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

use Models\Slot;

use DateTime;
use DateTimeZone;

class Measurement extends Model
{
    protected $primaryKey = "measurement_id";
    protected $table = "measurement";

    protected $fillable = [
        'sensor_id',
        'slot_id',
        'measurement_date',
        'measurement_value'
    ];

    static public function ultimas_mediciones($slot_id, $last_date, $days=9){
        if(empty($slot_id) || empty($last_date)){
            return respuesta::error("Parametros insuficientes");
        }

    	$last_measure = (new DateTime($last_date, new DateTimeZone('America/Lima')))->modify('-'.intval($days).' Days');
        $m = self::where("slot_id", $slot_id)
            ->where("measurement_date", '>=', $last_measure->format("Y-m-d").' 00:00:00')
            ->select(
                "measurement_id",
                "measurement_date",
                "measurement_value"
            )
            ->orderBy('measurement_date', 'asc')
            ->get();

        if(isset($m)){
            return respuesta::ok($m);
        } else {
            return respuesta::error("Hubo un error mientras se buscaba la información.");
        }
    }

    static public function historico_mediciones($slot_id, $fecha_inicio, $fecha_final){
        if(empty($fecha_inicio) || empty($fecha_final)){
            return respuesta::error("Parametros incorrectos.", 401);
        }
        
        $inicio = new DateTime($fecha_inicio." 00:00:00", new DateTimeZone('America/Lima'));
        $final = new DateTime($fecha_final." 23:59:59", new DateTimeZone('America/Lima'));

        if($inicio > $final){
            return respuesta::error("Rango de fechas invalido.", 401);
        }

        $mediciones = self::where("slot_id", $slot_id)
                ->where("measurement_date", '>=', $inicio->format("Y-m-d").' 00:00:00')
                ->where("measurement_date", '<=', $final->format("Y-m-d").' 23:59:59')
                ->orderBy('measurement_date', 'asc')
                ->get();
        
        if(isset($mediciones)){
            return respuesta::ok($mediciones);
        } else {
            return respuesta::error("Hubo un error mientras se buscaba la información.");
        }
    }
}
