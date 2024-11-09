<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComprobantePagoController extends Controller
{
    public function index() {
        return view('pages.tipo_usuario.index.content');
    }
}
