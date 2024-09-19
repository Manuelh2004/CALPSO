<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\ItemMenu;
use App\Models\Insumo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;
use App\Models\InsumoItem;

class InsumoItemController extends Controller
{
    public function index() {
        $lista_item_menu = ItemMenu::listar_item_menu();
        $lista_insumo = Insumo::listar_insumo();

        return View::make('pages.insumo_item.index.content')
            ->with("lista_item_menu", $lista_item_menu)
            ->with("lista_insumo", $lista_insumo);
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

        $lista = InsumoItem::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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
        $id_insumo_item = $request->input("id_insumo_item", 0);

        return InsumoItem::get($id_insumo_item);
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_insumo_item = $request->input("id_insumo_item", 0);
        $data_request = $request->only(['id_item_menu', 'id_insumo', 'cantidad']);

        return InsumoItem::actualizar($id_insumo_item, $data_request);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $data_request = $request->only(['id_item_menu', 'id_insumo', 'cantidad']);

        return InsumoItem::crear($data_request);
    }
}
