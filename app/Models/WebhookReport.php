<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;


class WebhookReport extends Model
{
    protected $primaryKey = "wr_id";
    protected $table = "webhook_report";
    protected $fillable = [
        'ws_id',
        'sender_id',
        'wr_period_report',
        'wr_function_report',
        'wr_config_parameters',
        'wr_next_report',
        'wr_status',
    ];

    static public function get_bySender ($sender_id){
        if(empty($sender_id)){
            return respuesta::error("Parametros no validos");
        }

        $res = self::where("sender_id", $sender_id)->first();

        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("Registro no valido.");
        }
    }

    static public function actualizar($wr_id, $data){
        if(empty($wr_id) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("wr_id", $wr_id)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }

    static public function actualizar_next_report ($wr_id, $nueva_fecha){
        return self::actualizar($wr_id, [
            "wr_next_report" => $nueva_fecha
        ]);
    }
}
