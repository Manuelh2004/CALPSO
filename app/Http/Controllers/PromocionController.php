<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\respuesta;
use App\Models\promocion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\ParameterSystem;

class PromocionController extends Controller
{
    
    public function listado(Request $request)
    {
        $columnName = $request->get('columnName', 'id_promocion');
        $columnSortOrder = $request->get('columnSortOrder', 'asc');
        $searchValue = $request->get('searchValue', '');
        $start = $request->get('start', 0);
        $rowperpage = $request->get('rowperpage', 10);

        $promociones = Promocion::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage);
        return response()->json($promociones);
    }

    // Crear nueva promoción
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_promocion' => 'required|string|max:255',
            'descripcion_promocion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado_promocion' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only([
            'nombre_promocion', 
            'descripcion_promocion', 
            'fecha_inicio', 
            'fecha_fin', 
            'estado_promocion'
        ]);

        $result = Promocion::crear($data);

        if ($result['status'] === 'ok') {
            return response()->json(['success' => 'Promoción creada exitosamente.'], 201);
        } else {
            return response()->json(['error' => 'No se pudo crear la promoción.'], 500);
        }
    }

    // Actualizar una promoción existente
    public function actualizar(Request $request, $id_promocion)
    {
        $validator = Validator::make($request->all(), [
            'nombre_promocion' => 'required|string|max:255',
            'descripcion_promocion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado_promocion' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->only([
            'nombre_promocion', 
            'descripcion_promocion', 
            'fecha_inicio', 
            'fecha_fin', 
            'estado_promocion'
        ]);

        $result = Promocion::actualizar($id_promocion, $data);

        if ($result['status'] === 'ok') {
            return response()->json(['success' => 'Promoción actualizada correctamente.']);
        } else {
            return response()->json(['error' => 'No se pudo actualizar la promoción.'], 500);
        }
    }

    // Obtener detalles de una promoción específica
    public function obtener($id_promocion)
    {
        $result = Promocion::get($id_promocion);

        if ($result['status'] === 'ok') {
            return response()->json($result['data']);
        } else {
            return response()->json(['error' => 'Promoción no encontrada.'], 404);
        }
    }

    // Eliminar una promoción
    public function eliminar($id_promocion)
    {
        $promocion = Promocion::find($id_promocion);
        if (!$promocion) {
            return response()->json(['error' => 'Promoción no encontrada.'], 404);
        }

        $promocion->delete();
        return response()->json(['success' => 'Promoción eliminada correctamente.']);
    }
}
