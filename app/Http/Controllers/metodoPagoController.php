<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\metodo_pago;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;

class MetodoPagoController extends Controller
{
    // Listado de métodos de pago con soporte para datatables
    public function listado(Request $request)
    {
        $columnName = $request->get('columnName', 'id_metodo_pago');
        $columnSortOrder = $request->get('columnSortOrder', 'asc');
        $searchValue = $request->get('searchValue', '');
        $start = $request->get('start', 0);
        $rowperpage = $request->get('rowperpage', 10);

        $metodos = MetodoPago::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage);
        return response()->json($metodos);
    }

    // Crear nuevo método de pago
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_metodo_pago' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['nombre_metodo_pago', 'descripcion']);

        $result = MetodoPago::crear($data);

        if ($result['status'] === 'ok') {
            return response()->json(['success' => 'Método de pago creado exitosamente.'], 201);
        } else {
            return response()->json(['error' => 'No se pudo crear el método de pago.'], 500);
        }
    }

    // Actualizar un método de pago existente
    public function actualizar(Request $request, $id_metodo_pago)
    {
        $validator = Validator::make($request->all(), [
            'nombre_metodo_pago' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only(['nombre_metodo_pago', 'descripcion']);

        $result = MetodoPago::actualizar($id_metodo_pago, $data);

        if ($result['status'] === 'ok') {
            return response()->json(['success' => 'Método de pago actualizado correctamente.']);
        } else {
            return response()->json(['error' => 'No se pudo actualizar el método de pago.'], 500);
        }
    }

    // Obtener detalles de un método de pago específico
    public function obtener($id_metodo_pago)
    {
        $result = MetodoPago::get($id_metodo_pago);

        if ($result['status'] === 'ok') {
            return response()->json($result['data']);
        } else {
            return response()->json(['error' => 'Método de pago no encontrado.'], 404);
        }
    }

    // Eliminar un método de pago
    public function eliminar($id_metodo_pago)
    {
        $metodo = MetodoPago::find($id_metodo_pago);
        if (!$metodo) {
            return response()->json(['error' => 'Método de pago no encontrado.'], 404);
        }

        $metodo->delete();
        return response()->json(['success' => 'Método de pago eliminado correctamente.']);
    }
}