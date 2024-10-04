@extends('layouts.app')

@section('titulo','detalle_entrega')

@include("pages.detalle_entrega.index.script")
@include("pages.detalle_entrega.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Detalle_Entrega</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <TH>ID_DETALLE_ENTREGA</TH>
                                    <TH>ID_METODO_ENTREGA</TH>
                                    <TH>DIRECCION_ENTREGA</TH>
                                    <TH>ESTADO_ENTREGA</TH>
                                    <TH>COMENTARIOS</TH>
                                    <TH>FECHA</TH>
                                    <TH>HORA</TH>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.detalle_entrega.componentes.modal");

@endsection
