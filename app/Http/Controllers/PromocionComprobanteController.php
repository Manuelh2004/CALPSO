<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\promocion_conmprobante;

class PromocionComprobanteController extends Controller
{
    public function index() {
        // Renderiza la vista de la lista de promociones
        return view('pages.cliente.index.content');
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

        $lista = PromocionComprobante::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage);

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
        $id_promocion = $request->input("id_promocion", 0);
        return PromocionComprobante::get($id_promocion);
    }

    public function update(Request $request) {
        // Actualizar un registro
        $id_promocion = $request->input("id_promocion", 0);
        $data_request = $request->only(['id_comprobante_pago', 'monto_descuento']);

        return PromocionComprobante::actualizar($id_promocion, $data_request);
    }

    public function create(Request $request) {
        // Crear un nuevo registro
        $data_request = $request->only(['id_comprobante_pago', 'monto_descuento']);
        return PromocionComprobante::crear($data_request);
    }

    public function dar_baja(Request $request) {
        // Dar de baja un registro, aquí podrías modificar el estado de la promoción si tuviera un campo de estado
        $id_promocion = $request->input("id_promocion", 0);
        $data_request = ['estado' => 0];  // Asumimos que hay un campo 'estado'

        return PromocionComprobante::actualizar($id_promocion, $data_request);
    }

    public function dar_alta(Request $request) {
        // Dar de alta un registro, si tuviera un campo de estado
        $id_promocion = $request->input("id_promocion", 0);
        $data_request = ['estado' => 1];

        return PromocionComprobante::actualizar($id_promocion, $data_request);
    }
}
