<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Facades\DB;

class SensorSender extends Model
{
    protected $primaryKey = "ss_id";
    protected $table = "sensor_sender";

    protected $fillable = [
        'sensor_id',
        'sender_id',
        'slot_id',
        'ss_channel',
        'ss_config',
        'ss_status',
    ];

    static public function get_byChannel ($channel, $sender_id){
        if(empty($sender_id) || empty($channel)){
            return respuesta::error("Parametros no validos");
        }

        $res = DB::select( 
            DB::raw('
            select 
                ss.*
                ,s.slot_last_value
                ,s.slot_average_value
                ,s.updated_at as slot_updated_at
            from sensor_sender ss 
            left join slot s on
            s.slot_id = ss.slot_id
            where ss.sender_id = :sender_id
            and ss.ss_channel = :channel        
            '),
            ["channel" => $channel, "sender_id" => $sender_id ]
        );
        
        if(isset($res)){
            if(count($res) > 0){
                return respuesta::ok($res[0]);
            } else {
                return respuesta::error("No se encuentra registros relacionados");
            }
        } else {
            return respuesta::error("Registro no encontrado");
        }
    }
}
