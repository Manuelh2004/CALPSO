<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use App\Http\Controllers\respuesta;

class AuthController extends Controller
{
    protected $TTL_default = 4320;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['name', 'password']);

        if (! $token = auth()->setTTL($this->TTL_default)->attempt($credentials)) {
            return respuesta::error("Unauthorized", 401);
        }

        return respuesta::ok($this->respondWithToken($token)->original);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $usuario = auth()->user();
        $user_info = [
            "id" => $usuario->usuario_id,
            "name" => $usuario->name,
            "email" => $usuario->usuario_email,
            "roles" => $usuario->psis_rol_usuario
        ];
        return respuesta::ok($user_info);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
            return respuesta::ok(NULL, "Se ha cerrado la sesion exitosamente.");
        }
        catch (TokenExpiredException $e) {
            return respuesta::ok(NULL, "La sesion del token ya habia expirado previamente.");
        }
        return respuesta::error("El token enviado no es valido para realizar el logout.", 401);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return respuesta::ok($this->respondWithToken(auth()->setTTL($this->TTL_default)->refresh())->original);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function payload(){
        return auth()->payload();
    }
}
