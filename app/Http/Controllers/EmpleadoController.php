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

class EmpleadoController extends Controller
{
    public function index()
    {
        // Obtener todos los empleados
        $empleados = Empleado::with(['area', 'cargo', 'sucursal'])->get();
        // Pasar los empleados a una vista
        return view('empleados.index', ['empleados' => $empleados]);
    }

    public function show($id)
    {
        // Obtener un empleado por su ID
        $empleado = Empleado::with(['area', 'cargo', 'sucursal'])->findOrFail($id);
        // Pasar el empleado a una vista
        return view('empleados.show', ['empleado' => $empleado]);
    }

    public function create()
    {
        // Mostrar el formulario para crear un nuevo empleado
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        // Validación y creación de un nuevo empleado
        $data = $request->validate([
            'id_area' => 'required|exists:areas,id_area',
            'id_cargo' => 'required|exists:cargos,id_cargo',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'nombre_empleado' => 'required|string',
            'edad' => 'required|integer',
            'correo_electronico' => 'required|email|unique:empleados',
            'password' => 'required|string',
        ]);

        $empleado = Empleado::create($data);
        // Redirigir a la lista de empleados con un mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito');
    }

    public function edit($id)
    {
        // Obtener el empleado y mostrar el formulario de edición
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', ['empleado' => $empleado]);
    }

    public function update(Request $request, $id)
    {
        // Actualizar empleado
        $empleado = Empleado::findOrFail($id);
        $data = $request->validate([
            'nombre_empleado' => 'string',
            'edad' => 'integer',
            'correo_electronico' => 'email|unique:empleados,correo_electronico,' . $id . ',id_empleado',
            'password' => 'string',
        ]);

        $empleado->update($data);
        // Redirigir a la lista de empleados con un mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito');
    }

    public function destroy($id)
    {
        // Eliminar empleado
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        // Redirigir a la lista de empleados con un mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito');
    }
}
