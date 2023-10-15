<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;
use Illuminate\Support\Carbon;

class Sender extends Model
{
    protected $table = 'sender';
    protected $primaryKey = 'sender_id';
    protected $fillable = [
        'st_id',
        'sender_serial',
        'sender_energy_level',
        'sender_sim_number',
        'sender_config',
        'sender_status',
        'sender_last_heart_beat',
        'sender_max_time_offline',
    ];

    static public function get_bySerial($serial){
        if(empty($serial)){
            return respuesta::error("Parametro no valido");
        }

        $res = self::where("sender_serial", $serial)
                ->first();
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("No se ha encontrado el registro");
        }
    }

    static public function update_heart_beat($sender_id){
        if(empty($sender_id)){
         return respuesta::error("Parametros no validos.");   
        }
        
        $res = self::where("sender_id", $sender_id)
                    ->update(["sender_last_heart_beat" => Carbon::now()]);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha podido realizar la accion.");
        }
    }

}
