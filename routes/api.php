 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\estacionController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\WebhookController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OrdenController;

Route::group([
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});


Route::group([
    'prefix' => 'estacion',
    'middleware' => 'jwt'
], function () {
    
    Route::post('listar', [estacionController::class, 'listar']);
    Route::post('ver/{id}', [estacionController::class, 'ver']);
    Route::post('detalle/{block_id}', [estacionController::class, 'detalle']);
    Route::post('historico/{block_id}', [estacionController::class, 'historico']);
    Route::post('comparaciones_parametro', [estacionController::class, 'comparaciones_parametro']);
    Route::post('test', [estacionController::class, 'test']);
});