<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\respuesta;

use App\Models\User;
use App\Models\ParameterSystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParameterController extends Controller
{
    public function index() {
        $user_roles = ParameterSystem::list_byType('000002');

        return View::make('pages.usuarios.index.content')
            ->with("psis_user_roles", $user_roles);
    }

    public function lista_user_ajax (Request $request){
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
        
        $lista = User::listado_datatable($columnName, $columnSortOrder, $searchValue, $start, $rowperpage );

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

    public function data (Request $request)
    {
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_user_role"] != '000023' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        
        $user_id = $request->input("user_id", 0);

        return User::get($user_id);

    }

    public function create (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_user_role"] != '000023' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }
        
        try {
            $validatedData = $request->validate([
                'name' => 'required|min:4',
                'user_email' => 'required|email:rfc|min:4',
                // 'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/', // Mayuscula, minuscula, número, caracter [#?!@$%^&*-_]
                'password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z]).*$/', // Mayuscula, minuscula, número, caracter [#?!@$%^&*-_]
            ],[
                'name.required' => "El usuario es obligatorio",
                'name.min' => "El nombre de usuario debe ser almenos :min catacteres.",
                'user_email.required' => "El correo electrónico es obligatorio",
                'user_email.min' => "El correo electrónico debe tener almenos :min caracteres.",
                'user_email.email' => "El correo electrónico no es valido.",
                'password.required' => "La contraseña es obligatorio.",
                'password.min' => "La contraseña debe tener almenos :min caracteres.",
                // 'password.regex' => "La contraseña no es suficientemente segura (Mayuscula, minuscula, número, caracter especial).",
                'password.regex' => "La contraseña no es suficientemente segura (Mayuscula, minuscula).",
            ]);

        } catch (ValidationException $e) {
            return respuesta::error($e->getMessage());
        }

        $data_request = $request->only(['name', 'user_email', 'psis_user_role']);
        
        $data_request["name"] = strtolower($data_request['name']);
        $data_request["user_email"] = strtolower($data_request['user_email']);
        
        $data_request["password"] = Hash::make($request->input("password"));

        return respuesta::ok($data_request);    
    }

    public function update (Request $request){
        $user_request = Auth::guard('web')->user();
        
        if( $user_request["psis_user_role"] != '000023' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|min:4',
                'user_email' => 'required|email:rfc|min:4',
            ],[
                'name.required' => "El usuario es obligatorio",
                'name.min' => "El nombre de usuario debe ser almenos :min catacteres.",
                'user_email.required' => "El correo electrónico es obligatorio",
                'user_email.min' => "El correo electrónico debe tener almenos :min caracteres.",
                'user_email.email' => "El correo electrónico no es valido.",
            ]);

        } catch (ValidationException $e) {
            return respuesta::error($e->getMessage());
        }

        $user_id = $request->input("user_id", 0);
        $data_request = $request->only(['name', 'user_email', 'psis_user_role']);

        $data_request["name"] = strtolower($data_request['name']);
        $data_request["user_email"] = strtolower($data_request['user_email']);

        if ($request->filled('password')) {
            $data_request["password"] = Hash::make($request->input("password"));
        }

        return User::actualizar($user_id, $data_request);
    }

    public function dar_baja (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_user_role"] != '000023' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        $user_id = $request->input("user_id", 0);
        
        return User::dar_baja($user_id);
    }

    public function dar_alta (Request $request){
        $user_request = Auth::guard('web')->user();
        if( $user_request["psis_user_role"] != '000023' ){
            return respuesta::error("No cuenta con permisos para realizar la acción.");
        }

        $user_id = $request->input("user_id", 0);
        
        return User::dar_alta($user_id);
    }
}
