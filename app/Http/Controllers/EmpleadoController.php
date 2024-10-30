<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;
use App\Models\TipoEmpleado;
use App\Models\cargoEmpleado;
use App\Models\areaEmpleado;
use App\Models\User;

class EmpleadoController extends Controller
{
    public function index() {
        $lista_tipo_empleado = TipoEmpleado::listar_tipo_empleado();
        $lista_cargo_empleado = cargoEmpleado::listar_cargo_empleado();
        $lista_area_empleado = areaEmpleado::listar_area_empleado();

        return View::make('pages.empleado.index.content')
            ->with("lista_tipo_empleado", $lista_tipo_empleado)
            ->with("lista_cargo_empleado", $lista_cargo_empleado)
            ->with("lista_area_empleado", $lista_area_empleado);
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

        $lista = Empleado::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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

        $id_empleado = $request->input("id_empleado", 0);

        return Empleado::get($id_empleado);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $data_request = $request->only(['nombre_empleado','nombre_area', 'nombre_cargo','nombre_tipo','nombre_distrito','name','correo_electronico','edad','genero']);
        $data_request["estado"] = 1;

        //$usuario_id = $request->input("usuario_id");
        //$name = User::


        $data_request_user = [''];

        //User::crear($data_request_user);


        return Empleado::crear($data_request);
    }


    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_empleado = $request->input("id_empleado", 0);
        $data_request = $request->only(['id_area', 'id_cargo','id_tipo','id_sucursal','usuario_id','nombre_empleado','edad','correo_electronico','genero']);

        return Empleado::actualizar($id_empleado, $data_request);
    }
    public function dar_baja (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_empleado = $request->input("id_empleado", 0);

        return Empleado::dar_baja($id_empleado);
    }
    public function dar_alta (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_empleado = $request->input("id_empleado", 0);

        return Empleado::dar_alta($id_empleado);
    }

}
