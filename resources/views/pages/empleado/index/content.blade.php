@extends('layouts.app')

@section('titulo','empleado')

@include("pages.empleado.index.script")
@include("pages.empleado.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Unidades de Medición</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID EMPLEADO</th>
                                    <th>ID AREA</th>
                                    <th>ID CARGO</th>
                                    <th>ID TIPO</th>
                                    <th>ID SUCURSAL</th>
                                    <th>NOMBRE EMPLEADO</th>
                                    <th>EDAD</th>
                                    <th>CORREO ELECTRONICO</th>
                                    <th>GENERO</th>
                                    <th>ESTADO</th>
                                    <th>PASSWORD</th>
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
