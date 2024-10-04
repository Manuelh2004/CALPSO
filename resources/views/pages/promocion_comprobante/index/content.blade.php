@extends('layouts.app')

@section('titulo','promocion_comprobante')

@include("pages.promocion_comprobante.index.script")
@include("pages.promocion_comprobante.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Promocion_Comprobante</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <TH>ID_PROMOCION</TH>
                                    <TH>ID_COMPROBANTE_PAGO</TH>
                                    <TH>MONTO_DESCUENTO</TH>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.promocion_comprobante.componentes.modal");

@endsection
