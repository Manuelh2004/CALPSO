<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\DetalleOrden;
use App\Models\ItemMenu;
use App\Models\Cliente;
use App\Models\Empleado;

class DetalleOrdenController extends Controller
{
    public function index() {
        $lista_cliente = Cliente::listar_cliente();
        $lista_item_menu = ItemMenu::listar_item_menu();

        return View::make('pages.detalle_orden.index.content')
            ->with("lista_cliente", $lista_cliente)
            ->with("lista_item_menu", $lista_item_menu);
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

        $lista = DetalleOrden::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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
        $id_detalle_orden = $request->input("id_detalle_orden", 0);

        return DetalleOrden::get($id_detalle_orden);
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_detalle_orden = $request->input("id_detalle_orden", 0);
        $data_request = $request->only(['id_orden', 'id_item_menu', 'cantidad','sub_total_orden']);

        return DetalleOrden::actualizar($id_detalle_orden, $data_request);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $data_request = $request->only(['id_orden', 'id_item_menu', 'cantidad','sub_total_orden']);
        return DetalleOrden::crear($data_request);
    }
}
