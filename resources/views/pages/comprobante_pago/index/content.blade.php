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
                                    <th>ID_Comprobante_Pago</th>
                                    <th>ID_Empleado</th>
                                    <th>ID_Sucursal</th>
                                    <th>ID_Metodo_Entrega</th>
                                    <th>ID_Promocion</th>
                                    <th>ID_Cliente</th>
                                    <th>ID_Tipo_Comprobante</th>
                                    <th>ID_Orden</th>
                                    <th>Fecha_Comprobante</th>
                                    <th>Total</th>
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
