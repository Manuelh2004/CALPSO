<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;

class ClienteController extends Controller
{
    public function index() {
        $lista_cliente = ParameterSystem::list_byType('000001');

        return View::make('pages.cliente.index.content')
            ->with("psis_user_roles", $lista_cliente);
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

        $lista = Cliente::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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

        $id_cliente = $request->input("id_cliente", 0);

        return Cliente::get($id_cliente);
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_cliente = $request->input("id_cliente", 0);
        $data_request = $request->only(['nombre_tipo', 'nombre_cliente', 'genero','edad','telefono','estado']);

        return Cliente::actualizar($id_cliente, $data_request);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $data_request = $request->only(['nombre_tipo', 'nombre_cliente', 'genero','edad','telefono','estado']);

        return Cliente::crear($data_request);
    }
    public function dar_baja (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_cliente = $request->input("id_cliente", 0);

        return Cliente::dar_baja($id_cliente);
    }

    public function dar_alta (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_cliente = $request->input("id_cliente", 0);

        return Cliente::dar_alta($id_cliente);
    }
}
