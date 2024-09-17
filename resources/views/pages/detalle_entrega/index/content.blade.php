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
                                    <th>ID_Detalle_Entrega</th>
                                    <th>ID_Metodo_Entrega</th>
                                    <th>Direccion_Entrega</th>
                                    <th>Estado_Entrega</th>
                                    <th>Comentarios</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
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
