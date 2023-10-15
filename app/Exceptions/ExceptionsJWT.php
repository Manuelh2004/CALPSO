<?php

namespace App\Exceptions;


use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\respuesta;


trait ExceptionsJWT{
	public function excepcionesJWT($request, $exception){
		$respuesta = respuesta::ok();
		if ($exception instanceof TokenInvalidException){
			$respuesta = respuesta::error("El token enviado no es valido.", 401);
			//return response()->json(['error'=> "El token es invalido"], 401);
        }else if ($exception instanceof TokenExpiredException){
            $respuesta = respuesta::error("El token enviado ha expirado.", 401);
			//return response()->json(['error'=> "El token ha expirado"], 401);
        }else if ($exception instanceof JWTException){
            $respuesta = respuesta::error("Existe un problema con el token.", 401);
			//return response()->json(['error'=> "Existe un problema con tu token"], 401);
        }
        $registro_log = [
        	"REDIRECT_HTTP_AUTHORIZATION" => $_SERVER["REDIRECT_HTTP_AUTHORIZATION"] ?? null,
        	"HTTP_HOST" => $_SERVER["HTTP_HOST"] ?? null,
        	"REDIRECT_URL" => $_SERVER["REDIRECT_URL"] ?? null,
        	"REQUEST_URI" => $_SERVER["REQUEST_URI"] ?? null,
        	"REQUEST_TIME" => $_SERVER["REQUEST_TIME"] ?? null,
        	"REDIRECT_STATUS" => $_SERVER["REDIRECT_STATUS"] ?? null
        ];

        Log::error("Exception Token: ".$respuesta["mensaje"]);
        Log::error($registro_log);
        return $respuesta;
	}
}
