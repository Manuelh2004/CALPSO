<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\TipoCliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TipoClienteController extends Controller
{
    public function index() {
        $lista_personas = TipoCliente::listar_personas_sin_horario();

        return View::make('pages.tipo_cliente.index.content')
            ->with("lista_personas", $lista_personas);
    }
    public function lista_ajax (Request $request){
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = (is_null($search_arr['value'])) ? '' : $search_arr['value']; // Search value

        $lista = TipoCliente::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

        $totalRecords = (count($lista)>0)? $lista[0]->totalrecords: 0;
        $totalRecordswithFilter = (count($lista)>0)? $lista[0]->totalrecordswithfilter: 0;

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $lista
        ];

        return json_encode($response);
    }
    public function data (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        $horario_id = $request->input("horario_id", 0);

        return Horario::get($horario_id);
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        try {
            // Definir reglas de validación para los horarios de cada día de la semana
            $reglasHorarios = [
                'horario_lunes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_martes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_miercoles' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_jueves' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_viernes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_sabado' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_domingo' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
            ];

            // Agregar regla personalizada para validar el rango (0-24) y el segundo horario
        Validator::extend('max_horario', function ($attribute, $value, $parameters, $validator) {
            // Dividir los horarios por la coma
            $horarios = explode(',', $value);

            // Verificar el segundo horario si existe
            if (count($horarios) > 1) {
                $segundoHorario = trim($horarios[1]);

                // Dividir el segundo horario en partes
                $partesSegundoHorario = explode('-', $segundoHorario);
                $horaInicioSegundo = (int) explode(':', $partesSegundoHorario[0])[0];
                $horaFinSegundo = (int) explode(':', $partesSegundoHorario[1])[0];

                // Verificar si el segundo horario es válido (inicio menor que fin)
                if ($horaInicioSegundo >= $horaFinSegundo) {
                    return false;
                }
            }

            // Validar el formato y rango del primer horario
            $partes = explode('-', $horarios[0]);
            $horaInicio = (int) explode(':', $partes[0])[0];
            $horaFin = (int) explode(':', $partes[1])[0];

            return ($horaInicio < $horaFin);
        });

        // Validar los datos del request utilizando las reglas definidas
        $validatedData = $request->validate($reglasHorarios, [
            'regex' => 'Formato de horario no válido en el campo :attribute',
            'max_horario' => 'El horario no tiene el formato adecuado en el campo :attribute',
        ]);

        } catch (ValidationException $e) {
            // En caso de error de validación, devuelve un error con el mensaje de validación
            return respuesta::error($e->getMessage());
        }

        $horario_id = $request->input("horario_id", 0);

        $data_request = $request->only(['horario_lunes', 'horario_martes', 'horario_miercoles', 'horario_jueves', 'horario_viernes', 'horario_sabado', 'horario_domingo']);


        return Horario::actualizar($horario_id, $data_request);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if ($user_request["psis_rol_usuario"] != '000002') {
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        try {
            // Definir reglas de validación para los horarios de cada día de la semana
            $reglasHorarios = [
                'usuario_id' => 'required',  // Agregamos la regla 'required' para usuario_id
                'horario_lunes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_martes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_miercoles' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_jueves' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_viernes' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_sabado' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
                'horario_domingo' => ['nullable', 'regex:/^(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?)(,(\d{1,2}(:\d{2})?)-(\d{1,2}(:\d{2})?))*$/', 'max_horario:23'],
            ];

        // Agregar regla personalizada para validar el rango (0-24) y el segundo horario
        Validator::extend('max_horario', function ($attribute, $value, $parameters, $validator) {
            // Dividir los horarios por la coma
            $horarios = explode(',', $value);

            // Verificar el segundo horario si existe
            if (count($horarios) > 1) {
                $segundoHorario = trim($horarios[1]);

                // Dividir el segundo horario en partes
                $partesSegundoHorario = explode('-', $segundoHorario);
                $horaInicioSegundo = (int) explode(':', $partesSegundoHorario[0])[0];
                $horaFinSegundo = (int) explode(':', $partesSegundoHorario[1])[0];

                // Verificar si el segundo horario es válido (inicio menor que fin)
                if ($horaInicioSegundo >= $horaFinSegundo) {
                    return false;
                }
            }

            // Validar el formato y rango del primer horario
            $partes = explode('-', $horarios[0]);
            $horaInicio = (int) explode(':', $partes[0])[0];
            $horaFin = (int) explode(':', $partes[1])[0];

            return ($horaInicio < $horaFin);
        });

        // Validar los datos del request utilizando las reglas definidas
        $validatedData = $request->validate($reglasHorarios, [
            'required' => 'Usuario no seleccionado, es de caracter obligatorio',
            'regex' => 'Formato de horario no válido en el campo :attribute',
            'max_horario' => 'El horario no tiene el formato adecuado en el campo :attribute',
        ]);

        } catch (ValidationException $e) {
            // En caso de error de validación, devuelve un error con el mensaje de validación
            return respuesta::error($e->getMessage());
        }

        $data_request = $request->only(['usuario_id', 'horario_lunes', 'horario_martes', 'horario_miercoles', 'horario_jueves', 'horario_viernes', 'horario_sabado', 'horario_domingo']);
        $data_request["horario_estado"] = 1;

        return Horario::crear_si_no_existe_usuario($data_request);
    }



}
