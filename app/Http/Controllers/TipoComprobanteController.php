<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\tipo_comprobante;

class TipoComprobanteController extends Controller
{
    public function index() {
        return View::make('pages.cliente.index.content');
    }

    public function lista_ajax(Request $request) {
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

        $lista = TipoComprobante::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage);

        $totalRecords = (count($lista) > 0) ? $lista[0]->totalrecords : 0;
        $totalRecordswithFilter = (count($lista) > 0) ? $lista[0]->totalrecordswithfilter : 0;

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $lista
        ];

        return json_encode($response);
    }

    public function data(Request $request) {
        $id_tipo_comprobante = $request->input("id_tipo_comprobante", 0);

        return TipoComprobante::get($id_tipo_comprobante);
    }

    public function update(Request $request) {
        $id_tipo_comprobante = $request->input("id_tipo_comprobante", 0);
        $data_request = $request->only(['nombre_comprobante', 'descripcion']);

        return TipoComprobante::actualizar($id_tipo_comprobante, $data_request);
    }

    public function create(Request $request) {
        $data_request = $request->only(['nombre_comprobante', 'descripcion']);
        return TipoComprobante::crear($data_request);
    }

    public function dar_baja(Request $request) {
        $id_tipo_comprobante = $request->input("id_tipo_comprobante", 0);
        $data_request = ['estado' => 0];

        return TipoComprobante::actualizar($id_tipo_comprobante, $data_request);
    }

    public function dar_alta(Request $request) {
        $id_tipo_comprobante = $request->input("id_tipo_comprobante", 0);
        $data_request = ['estado' => 1];

        return TipoComprobante::actualizar($id_tipo_comprobante, $data_request);
    }
}
