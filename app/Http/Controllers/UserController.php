<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\respuesta;
use App\Models\User;
use App\Models\TipoEmpleado;
use App\Models\CargoSubarid;
use App\Models\areaUsuario;
use App\Models\Sucursal;
use App\Models\ParameterSystem;

class UserController extends Controller
{
    public function index() {
        return View::make('pages.usuarios.index.content');
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

        $lista = User::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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

    public function data (Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $usuario_id = $request->input("usuario_id", 0);

        return User::get($usuario_id);
    }

    public function create (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        $data_request = $request->only(['nombre_empleado','name','password']);
        $data_request["estado"] = 1;

        $data_request["name"] = strtolower($data_request['name']);
        $data_request["password"] = Hash::make($request->input("password"));

        return user::crear($data_request);
    }

}
