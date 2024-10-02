@extends('layouts.app')

@section('titulo','CLIENTE')

@include("pages.cliente.index.script")
@include("pages.cliente.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">CLIENTE</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>
                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TIPO CLIENTE</th>
                                    <th>NOMBRE</th>
                                    <th>GENERO</th>
                                    <th>EDAD</th>
                                    <th>TELEFONO</th>
                                    <th>ESTADO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("pages.cliente.componentes.modal");

@endsection
