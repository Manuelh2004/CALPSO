<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\ExceptionsJWT;
use Exception;

class Handler extends ExceptionHandler
{
    use ExceptionsJWT;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(Exception $exception, $request) {
            $excepcionJWT = $this->excepcionesJWT($request, $exception);
            if(!$excepcionJWT["estado"]){
                return response()->json($excepcionJWT, 200);
            }
        });
    }

}
