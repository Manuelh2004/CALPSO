<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\AreaUsuarioo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;
use Illuminate\Support\Facades\DB;

class AreaEmpleadoController extends Controller
{
    public function index() {
        return view('pages.area_usuario.index.content');
    }
    public function lista_ajax (Request $request): bool|string{
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

        $lista = AreaUsuarioo::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

        $totalRecords = (count($lista) > 0 && isset($lista[0]->totalrecords)) ? $lista[0]->totalrecords : 0;
        $totalRecordswithFilter = (count($lista) > 0 && isset($lista[0]->totalrecordswithfilter)) ? $lista[0]->totalrecordswithfilter : 0;

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
        $id_area = $request->input("id_area", 0);

        return AreaUsuarioo::get($id_area);
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();

        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $id_area = $request->input("id_area", 0);
        $data_request = $request->only(['nombre_area','descripcion']);

        return AreaUsuarioo::actualizar($id_area, $data_request);
    }
    public function create(Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_rol_usuario"] != '000002' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        $data_request = $request->only(['nombre_area','descripcion']);

        return AreaUsuarioo::crear($data_request);
    }
}
