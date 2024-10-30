@extends('layouts.app')

@section('titulo','EMPLEADO')

@include("pages.empleado.index.script")
@include("pages.empleado.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">EMPLEADO</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE EMPLEADO</th>
                                    <th>AREA</th>
                                    <th>CARGO</th>
                                    <th>TIPO</th>
                                    <th>SUCURSAL</th>
                                    <th>NAME</th>
                                    <th>PASSWORD</th>
                                    <th>EMAIL</th>
                                    <th>EDAD</th>
                                    <th>GENERO</th>
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

    @include("pages.empleado.componentes.modal");

@endsection
