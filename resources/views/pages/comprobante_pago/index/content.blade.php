@extends('layouts.app')

@section('titulo','comprobante_pago')

@include("pages.comprobante_pago.index.script")
@include("pages.comprobante_pago.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Comprobante_Pago</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <TH>ID_COMPROBANTE_PAGO</TH>
                                    <TH>ID_EMPLEADO</TH>
                                    <TH>ID_SUCURSAL</TH>
                                    <TH>ID_METODO_ENTREGA</TH>
                                    <TH>ID_PROMOCION</TH>
                                    <TH>ID_CLIENTE</TH>
                                    <TH>ID_TIPO_COMPROBANTE</TH>
                                    <TH>ID_ORDEN</TH>
                                    <TH>FECHA_COMPROBANTE</TH>
                                    <TH>TOTAL</TH>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.comprobante_pago.componentes.modal");

@endsection
