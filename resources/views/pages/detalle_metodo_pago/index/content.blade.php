@extends('layouts.app')

@section('titulo','detalle_metodo_pago')

@include("pages.detalle_metodo_pago.index.script")
@include("pages.detalle_metodo_pago.index.head")

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
                                    <th>ID DETALLE METODO DE PAGO</th>
                                    <th>ID METODO PAGO</th>
                                    <th>ID COMPROBANTE DE PAGO</th>
                                    <th>MONTO</th>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.detalle_metodo_pago.componentes.modal");

@endsection
