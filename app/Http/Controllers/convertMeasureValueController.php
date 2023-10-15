<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class convertMeasureValueController extends Controller
{

	/**
	 * Procesa la configuracion para la conversion de una medicion a otro valor
	 * dependiendo de la configuracion establecida 
	 * @param float $value valor de medicion que se desea procesar
	 * @param string $configuration Cadena que contiene codificada la configuracion
	 * @return float retorna el valor de la medicion procesada
	 * @author Juan Basilio Flores
	 * @version v0.02.1
	 */
	static public function procesa($value, $configuration){
		// $value = (float)$value;
		if($configuration == null || $configuration == ''){
			return $value;
		} else {
			$datos = explode("%", $configuration);
			$funcion = $datos[0];
			if(count($datos)>1){
				$parametros = $datos[1];
				return convertMeasureValueController::procesarFuncion ($value, $funcion, $parametros);
			} else {
				return convertMeasureValueController::procesarFuncion ($value, $funcion);
			}
		}
	}

	/**
	 * Busca entre todas las funciones existentes registradas y llama a la funcion
	 * ingresandoles los parametros obtenidos de la configuracion
	 * @param float $value valor de la medicion
	 * @param string $funcionName nombre de la funcion que va a utilizar
	 * @param string $parametrosText cadena con los parametros separados por |
	 * @return float valor de la medicion procesado
	 */
	static public function procesarFuncion ($value, $funcionName, $parametrosText=""){
		$parametros = explode("|", $parametrosText);
		Log::info("Procesando parametros");
		Log::info($parametros);
		switch ($funcionName) {
			case "levelRiverConvertion":
					return convertMeasureValueController::levelRiverConvertion($value, $parametros[0]);
				break;
			case "levelCompensation":
					return convertMeasureValueController::levelCompensation($value, $parametros[0], $parametros[1]);
				break;
			case "psiToMca":
					return convertMeasureValueController::psiToMca($value);
				break;
			case "polinomica4ta":
					return convertMeasureValueController::polinomica4ta($value, $parametros);
				break;
			case "cmToM":
					return convertMeasureValueController::psiToMca($value);
				break;
			case "processDTUDataFloat32":
					return convertMeasureValueController::processDTUDataFloat32($value, $parametros);
				break;
			case "convertDecimalsDTU":
					return convertMeasureValueController::convertDecimalsDTU($value, $parametros);
				break;
			default:
					return $value; //si no encontramos la funcion, retornamos el mismo valor
				break;
		}
	}

	/**
	 * Calcula el nivel del rio a partir de la distacia al desde el sensor
	 * @param float $value valor de la medicion
	 * @param string $alturaSensor distancia del sensor al suelo
	 * @return float valor de la medicion procesado
	 */
	static public function levelRiverConvertion ($value, $alturaSensor){
		$value = (float)$alturaSensor - $value;
		return $value;
	}

	/**
	 * Hace una compesacion para un sensor de nivel por presion
	 * @param float $value valor de la medicion
	 * @param string $a compensador geometrico
	 * @param string $b compensador aritmetico
	 * @return float valor de la medicion procesado
	 */
	static public function levelCompensation ($value, $a, $b){
		$value = (float)$a*$value+(float)$b;
		return $value;
	}

	/**
	 * Convierte la medición de psi a columna de agua
	 * @param float $value valor de la medicion
	 * @return float valor de la medicion procesado
	 */
	static public function psiToMca ($value){
		//1 PSI = 0,704 mca
		$value = (float)$value*0.70203;
		return $value;
	}

	/**
	 * Convierte la medición de cm a mertros
	 * @param float $value valor de la medicion
	 * @return float valor de la medicion procesado
	 */
	static public function cmToM ($value){
		//1 PSI = 0,704 mca
		$value = (float)$value/100.0;
		return $value;
	}

	static public function polinomica4ta($value, $parametros){
		$valor = (float)$parametros[0]+$value*(float)$parametros[1]+pow($value, 2)*(float)$parametros[2]+pow($value, 3)*(float)$parametros[3]+pow($value, 4)*(float)$parametros[4];
		return $valor;
	}

	static public function getEquivalentToPSI($unit){
		$equivalencia = 1;
		$unit = strtoupper($unit);
		switch($unit){
			case "KPA" :
				$equivalencia = 6.8947358;
			break;
			case "MBAR" :
				$equivalencia = 68.947358;
			break;
			default:
				$equivalencia = 1;
		}
		return $equivalencia;
	}

	static public function processDTUDataFloat32 ($data, $parametros){

		$int1 = $data[$parametros[0]];
        $int2 = $data[$parametros[1]];
		$binary = pack('ss', $int1, $int2);
        $float = unpack('f', $binary)[1];
		Log::info("Valor convertido");
		Log::info($float);
		return ($float > 0)? $float: 0;
	}

	static public function convertDecimalsDTU ($data, $parametros): float {
		$int1 = floatval($data[$parametros[0]]);
		$decimales = floatval(pow(10, intval($parametros[1])));
		$resultado = $int1/$decimales;
		return ($resultado > 0)? $resultado: 0;
	}

	static public function hexfloat(string $hex): float
    {
        $dec = hexdec($hex);
    
        if ($dec === 0) {
            return 0;
        }
    
        $sup = 1 << 23;
        $x = ($dec & ($sup - 1)) + $sup * ($dec >> 31 | 1);
        $exp = ($dec >> 23 & 0xFF) - 127;
        $sign = ($dec & 0x80000000) ? -1 : 1;
    
        return $sign * $x * pow(2, $exp - 23);
    }
}
