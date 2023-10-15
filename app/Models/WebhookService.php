<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\respuesta;

class WebhookService extends Model
{
    protected $primaryKey = "ws_id";
    protected $table = "webhook_service";
    protected $fillable = [
        'ws_url',
        'ws_token',
        'ws_auth_parameters',
        'ws_auth_url',
        'ws_token_expire',
        'ws_status',
    ];

    static public function get_byId ($ws_id){
        if(empty($ws_id)){
            return respuesta::error("Parametros no validos");
        }

        $res = self::where("ws_id", $ws_id)->first();
        if(isset($res)){
            return respuesta::ok($res);
        } else {
            return respuesta::error("Registro no valido.");
        }
    }

    static public function actualizar($ws_id, $data){
        if(empty($ws_id) || empty($data)){
            return respuesta::error("Datos no validos para realizar el cambio de informacion.");
        }

        $res = self::where("ws_id", $ws_id)
                ->update($data);

        if(isset($res)){
            return respuesta::ok();
        } else {
            return respuesta::error("No se ha logrado hacer el cambio de informacion.");
        }
    }
}
