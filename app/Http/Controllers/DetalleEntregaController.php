<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\detalle_entrega;

class DetalleEntregaController extends Controller
{
    public function index() {
        // Renderiza la vista de la lista de entregas
        return View::make('pages.cliente.index.content');
    }

    public function lista_ajax(Request $request) {
        ## Leer los valores del request
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Filas por página

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Índice de la columna
        $columnName = $columnName_arr[$columnIndex]['data']; // Nombre de la columna
        $columnSortOrder = $order_arr[0]['dir']; // asc o desc
        $searchValue = (is_null($search_arr['value'])) ? '' : $search_arr['value']; // Valor de búsqueda

        $lista = DetalleEntrega::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage);

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
        // Obtener la data de un registro específico
        $id_detalle_entrega = $request->input("id_detalle_entrega", 0);
        return DetalleEntrega::get($id_detalle_entrega);
    }

    public function update(Request $request) {
        // Actualizar un registro
        $id_detalle_entrega = $request->input("id_detalle_entrega", 0);
        $data_request = $request->only(['id_metodo_entrega', 'direccion_entrega', 'estado_entrega', 'comentario', 'fecha', 'hora']);

        return DetalleEntrega::actualizar($id_detalle_entrega, $data_request);
    }

    public function create(Request $request) {
        // Crear un nuevo registro
        $data_request = $request->only(['id_metodo_entrega', 'direccion_entrega', 'estado_entrega', 'comentario', 'fecha', 'hora']);
        return DetalleEntrega::crear($data_request);
    }

    public function dar_baja(Request $request) {
        // Dar de baja un registro, estableciendo el estado de entrega a 0
        $id_detalle_entrega = $request->input("id_detalle_entrega", 0);
        $data_request = ['estado_entrega' => 0];

        return DetalleEntrega::actualizar($id_detalle_entrega, $data_request);
    }

    public function dar_alta(Request $request) {
        // Dar de alta un registro, estableciendo el estado de entrega a 1
        $id_detalle_entrega = $request->input("id_detalle_entrega", 0);
        $data_request = ['estado_entrega' => 1];

        return DetalleEntrega::actualizar($id_detalle_entrega, $data_request);
    }
}
