@extends('layouts.auth')

@section('titulo','Ingreso')

@include("pages.login.index.script")
@include("pages.login.index.head")

@section('content')    

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Administrador <span class="brand-name">Waposat</span></h1>
                        <p class="signup-link">¿Eres nuevo? <a href="/registro">Crear una cuenta</a></p>
                        <form id="formulario-autenticacion" class="text-left" >
                            @csrf
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Usuario" required>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" required>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Mostrar Contraseña</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" id="boton-login" class="btn btn-primary" value="">Ingresar</button>
                                    </div>
                                    
                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" class="new-control-input" id="remember_me" name="remember_me" >
                                          <span class="new-control-indicator"></span>Mantenerme logueado
                                        </label>
                                    </div>
                                </div>

                                <div class="field-wrapper">
                                    <a href="/" class="forgot-pass-link">¿Olvidaste tu contraseña?</a>
                                </div>

                            </div>
                        </form>                        
                        <p class="terms-conditions">© {{ date('Y') }} Todos los derechos reservados. Producto diseñado por <a href="index.html">Waposat Negocios</a>.</p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

@endsection