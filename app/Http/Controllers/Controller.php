<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Crea un inventario verificando los datos obligatorios
     * @param array $data Array asociativo de la informacion del inventario
     * @return respuesta Se retorna una respuesta {estado, mensaje, status, payload*}
     * @author Juan Ignacio Basilio Flores
     * @version v1.00.2
     */

    public static function verificar_elementos($elementos, $array)
    {
        if (is_array($array)) {
            if (is_array($elementos)) {
                foreach ($elementos as $i => $elemento) {
                    if (empty($array[$elemento])) {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
        return true;
    }
  
}
