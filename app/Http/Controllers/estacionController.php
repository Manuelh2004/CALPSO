<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuesta;
use Response;
use App\Models\Block;
use App\Models\Measurement;
use App\Models\Slot;
use DateTime;
use DateTimeZone;

class estacionController extends Controller
{
    public function listar(){
    	$usuario_id = auth()->user()->user_id;
        return Block::listar_estaciones($usuario_id);
    }

    public function ver($id){
    	$usuario_id = auth()->user()->user_id;
    	return Block::ver_estacion($id, 1);
    }

    public function detalle($block_id){
        $usuario_id = auth()->user()->user_id;
        $estacion = Block::detalle_estacion($block_id, 1);
        if(!$estacion["estado"]){
            return $estacion;
        }
        $estacion = $estacion["payload"];
        
        $lista_sensores = Slot::listarEstacion($block_id);
        if(!$lista_sensores["estado"]){
            return $lista_sensores;
        }
        
        $detalle_sensores = [];
        
        foreach ($lista_sensores["payload"] as $key => $sensor) {
            $medicion = Measurement::ultimas_mediciones($sensor->id, $sensor->updated_at);
            if($medicion["estado"]){
                $medicion = $medicion["payload"];
                $data = [
                    "value" => [],
                    "date" => []
                ];
                
                foreach ($medicion as $medida) {
                    array_push($data["value"], $medida["measurement_value"]);
                    array_push($data["date"], $medida["measurement_date"]);
                }
                
                $sensor->data = $data;
                $last = (count($medicion) > 0)? $medicion[(count($medicion)-1)] : [];
                if(!empty($last)){
                    $sensor->last = [
                        "id_measurement" => $last->measurement_id,
                        "date" => $last->measurement_date,
                        "value" => $last->measurement_value,
                    ];
                }
                array_push($detalle_sensores, $sensor);
            }
        }
        $estacion["sensores"] = $detalle_sensores;
        
        return respuesta::ok($estacion);
    }

    public function historico ($block_id, Request $request){
        $usuario_id = auth()->user()->user_id;
        $fecha_inicio = $request->input('fecha_inicio', "");
        $fecha_fin = $request->input('fecha_fin', "");

        $estacion = Block::detalle_estacion($block_id, 1);
        if(!$estacion["estado"]){
            return $estacion;
        }
        $estacion = $estacion["payload"];
        
        $lista_sensores = Slot::listarEstacion($block_id);
        if(!$lista_sensores["estado"]){
            return $lista_sensores;
        }
        
        $detalle_sensores = [];
        
        foreach ($lista_sensores["payload"] as $key => $sensor) {
            if(empty($fecha_inicio) || empty($fecha_fin)){
                $medicion = Measurement::ultimas_mediciones($sensor->id, $sensor->updated_at);
            } else {
                $medicion = Measurement::historico_mediciones($sensor->id, $fecha_inicio, $fecha_fin);
            }
            if($medicion["estado"]){
                $medicion = $medicion["payload"];
                $data = [
                    "value" => [],
                    "date" => []
                ];
                
                foreach ($medicion as $medida) {
                    array_push($data["value"], $medida["measurement_value"]);
                    array_push($data["date"], $medida["measurement_date"]);
                }
                
                $sensor->data = $data;
                $last = (count($medicion) > 0)? $medicion[(count($medicion)-1)] : [];
                if(!empty($last)){
                    $sensor->last = [
                        "id_measurement" => $last->measurement_id,
                        "date" => $last->measurement_date,
                        "value" => $last->measurement_value,
                    ];
                }
                array_push($detalle_sensores, $sensor);
            }
        }


        $estacion["sensores"] = $detalle_sensores;

        return respuesta::ok($estacion);
    }

    public function comparaciones_parametro ( Request $request){
        $usuario_id = auth()->user()->user_id;
        $sensor_modelo = $request->input('sensor_modelo', 3);
        $fecha_inicio = $request->input('fecha_inicio', "");
        $fecha_fin = $request->input('fecha_fin', "");

        if(empty($fecha_fin) || empty($fecha_inicio)){
            $fecha_fin = date("Y-m-d");
            $fecha_inicio = (new DateTime($fecha_fin, new DateTimeZone('America/Lima')))->modify('-'.intval(7).' Days')->format("Y-m-d");
        }
        

        $data = Block::listar_medicion_por_sensor($usuario_id, $sensor_modelo, $fecha_inicio, $fecha_fin);
        return $data;
    }

    public function test (){
        // $binarydata32 = pack('H*','B3DD3E35');
        // $binarydata32 = pack('H*','3E35B3DD');
        // $binarydata32 = pack('H*','831a3e47');
        // $binarydata32 = pack('H*','bd8b28a7');
        // return self::hexfloat('3db4'.'464c');
        $MDR1 = dechex(-13420); // 6816
        $MDR2 = dechex(16289.00); // 16047
        
        $int1 = '20363.0000';
        $int2 = '15627.0000';
        $binary = pack('ss', $int1, $int2);
        $float = unpack('f', $binary)[1];
        return $float; // Output: 5.3048236007695E-34

        $binary_num_1 = pack("s", -16684);
        $binary_num_2 = pack("s", 16031);

        // Concatenar las dos cadenas binarias de 16 bits en una cadena binaria de 32 bits
        $binary_num_32 = pack("a4a4", $binary_num_1, $binary_num_2);

        // Convertir la cadena de bytes en un número de punto flotante de 32 bits
        return unpack("f", $binary_num_32)[1];



        return self::int16To2sSignedHex4Dig(-13420);
        $binarydata32 = pack('L',16289);

        $hexdata = unpack('H*',$binarydata32);
        return $hexdata;
        return self::hexfloat($MDR2.$MDR1);
		

        $binarydata32 = pack('f*','-0.0679486');
        $float32 = unpack("H*", $binarydata32);
        return respuesta::ok($float32);
        
        $float32 = pack("f", 1.770);
        $binarydata32 =unpack('H*',$float32); //"0EC0A14A"
        return respuesta::ok(var_dump($binarydata32));
        // "{""IMEI"":""862708044739956"",""SIMN"":null,""DID"":""jot00036"",""TIME"":""00\/00\/00 19:30:02"",""auth"":""00001429"",""group"":null,""PID"":""41"",""PTYPE"":""DUMP"",""CHAN"":""0,4"",""MDR0"":""0.0000"",""MDS0"":""2"",""MDT0"":""1"",""MDR1"":""-31974.0000"",""MDS1"":""0"",""MDT1"":""1"",""MDR2"":""15943.0000"",""MDS2"":""0"",""MDT2"":""1"",""MDR3"":""95.0000"",""MDS3"":""0"",""MDT3"":""1""}"
        // 83 1A 3E 47
        // 831A3E47
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

    static public function int16Hex ($num_decimal){
        // $num_decimal = -123; // número decimal con signo

        // Convertir el valor decimal a hexadecimal
        $num_hex = dechex(abs($num_decimal));

        // Agregar un prefijo de signo al inicio
        if ($num_decimal < 0) {
            $num_hex = str_pad($num_hex, 2, "0", STR_PAD_LEFT);
            $num_hex = "-0x".$num_hex;
        } else {
            $num_hex = "0x".$num_hex;
        }

        return $num_hex; // Imprimir el número hexadecimal con signo
    }

    static public function int16SignedHex ($num_decimal){
        // $num_decimal = -123; // número decimal con signo

        // Convertir el número decimal a su representación hexadecimal
        $num_hex = dechex(abs($num_decimal));

        // Asegurarnos de que el número hexadecimal tenga una longitud par
        if (strlen($num_hex) % 2 != 0) {
            $num_hex = "0".$num_hex;
        }

        // Convertir el número hexadecimal a binario
        $num_bin = base_convert($num_hex, 16, 2);

        // Asegurarnos de que el número binario tenga una longitud de 16 bits
        $num_bin = str_pad($num_bin, 16, "0", STR_PAD_LEFT);

        // Agregar un prefijo de signo al inicio del número binario
        if ($num_decimal < 0) {
            $num_bin = "1".$num_bin;
        } else {
            $num_bin = "0".$num_bin;
        }

        // Convertir el número binario a su representación hexadecimal
        $num_hex_signed = base_convert($num_bin, 2, 16);

        return $num_hex_signed; // Imprimir el número decimal con signo en hexadecimal con signo
    }

    static public function int162sSignedHex ($num_decimal){
        // $num_decimal = -123; // número decimal con signo

        // Convertir el número decimal a su representación binaria en complemento a dos
        $num_bin = decbin(abs($num_decimal));
        $num_bin = sprintf("%016d", $num_bin ^ 0b1111111111111111);

        // Convertir el número binario a su representación hexadecimal
        $num_hex = base_convert($num_bin, 2, 16);

        return $num_hex; // Imprimir el número decimal con signo en hexadecimal en formato de complemento a dos
    }

    static public function int16To2sSignedHex4Dig($num_decimal){
        // $num_decimal = -123; // número decimal con signo

        // Convertir el número decimal a su representación binaria en complemento a dos
        $num_bin = decbin(abs($num_decimal));
        $num_bin = sprintf("%016d", $num_bin ^ 0b1111111111111111);

        // Obtener la representación hexadecimal de los primeros 4 bits del número binario
        $first_nibble = dechex(bindec(substr($num_bin, 0, 4)));

        // Obtener la representación hexadecimal del resto del número binario
        $rest_of_num = base_convert(substr($num_bin, 4), 2, 16);

        // Concatenar los dos valores hexadecimales obtenidos
        $num_hex = $first_nibble.$rest_of_num;

        // Asegurarnos de que el número hexadecimal tenga una longitud de 4 dígitos
        $num_hex = str_pad($num_hex, 4, "0", STR_PAD_LEFT);

        // Convertir el número hexadecimal a mayúsculas
        $num_hex = strtoupper($num_hex);

        return $num_hex; // Imprimir el número decimal con signo en hexadecimal en formato de complemento a dos con 4 dígitos
    }

    
    
}
