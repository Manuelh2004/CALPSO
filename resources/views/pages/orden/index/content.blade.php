@extends('layouts.app')

@section('titulo','ORDEN')

@include("pages.orden.index.script")
@include("pages.orden.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Orden</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID_ORDEN</th>
                                    <th>ID_CLIENTE</th>
                                    <th>ID_SUCURSAL</th>
                                    <th>ID_EMPLEADO</th>
                                    <th>FECHA_ORDEN</th>
                                    <th>TOTAL_ORDEN</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.orden.componentes.modal");

@endsection
