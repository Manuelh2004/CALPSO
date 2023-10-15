<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use View;
use PHPMailer;
use App\Http\Controllers\respuesta;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        return view('pages.login.index.content');

    }

    public function login (Request $request)
    {
        $name = strtolower($request->input('name',""));
        $password = $request->input('password',"");
        $remember_me = $request->input("remember_me", false);
        $remember_me = ($remember_me)? true : false;

        if (Auth::guard('web')->attempt(["name"=> $name, "password" => $password], $remember_me)){
            $usuario = Auth::guard('web')->user();
            return respuesta::ok($usuario);
            // return redirect('inicio');
        }
        return respuesta::error("Datos no validos para ingresar.");
        // return redirect('login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        header("Cache-Control: no-store, no-cache, must-revalidate");

        return redirect('login');
    }
}
