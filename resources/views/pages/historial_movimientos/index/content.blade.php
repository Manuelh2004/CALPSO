@extends('layouts.app')

@section('titulo','historial_movimientos')

@include("pages.historial_movimientos.index.script")
@include("pages.historial_movimientos.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Historial_Movimientos</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <TH>ID_HISTORIAL_MOVIMIENTOS</TH>
                                    <TH>ID_COMPROBANTE_PAGO</TH>
                                    <TH>DESCRIPCION</TH>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.historial_movimientos.componentes.modal");

@endsection
