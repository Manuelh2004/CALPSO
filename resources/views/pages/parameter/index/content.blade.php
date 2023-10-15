@extends('layouts.app')

@section('titulo','USUARIOS')

@include("pages.usuarios.index.script")
@include("pages.usuarios.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Parametros </h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.usuarios.componentes.modal");

@endsection
