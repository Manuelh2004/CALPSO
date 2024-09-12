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

class OrdenController extends Controller
{
    public function index()
    {
        // Listar todas las órdenes
        $ordenes = Orden::with(['cliente', 'empleado', 'sucursal', 'detalles'])->get();
        return response()->json($ordenes);
    }

    public function show($id)
    {
        // Mostrar una orden por su ID
        $orden = Orden::with(['cliente', 'empleado', 'sucursal', 'detalles'])->findOrFail($id);
        return response()->json($orden);
    }

    public function store(Request $request)
    {
        // Validar y crear una nueva orden
        $data = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'fecha_orden' => 'required|date',
            'total_orden' => 'required|numeric',
            'detalles' => 'required|array', // Detalle de la orden
        ]);

        $orden = Orden::create($data);

        // Crear detalles de la orden
        foreach ($request->detalles as $detalle) {
            DetalleOrden::create([
                'id_orden' => $orden->id_orden,
                'id_item_menu' => $detalle['id_item_menu'],
                'cantidad' => $detalle['cantidad'],
                'sub_total_orden' => $detalle['sub_total_orden'],
            ]);
        }

        return response()->json($orden, 201);
    }

    public function update(Request $request, $id)
    {
        // Actualizar una orden
        $orden = Orden::findOrFail($id);
        $data = $request->validate([
            'fecha_orden' => 'date',
            'total_orden' => 'numeric',
        ]);

        $orden->update($data);
        return response()->json($orden);
    }

    public function destroy($id)
    {
        // Eliminar una orden
        $orden = Orden::findOrFail($id);
        $orden->delete();
        return response()->json(null, 204);
    }
}
