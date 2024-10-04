@extends('layouts.app')

@section('titulo','CATEGORIA')

@include("pages.categoria.index.script")
@include("pages.categoria.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Categoria</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID_CATEGORIA</th>
                                    <th>NOMBRE_CATEGORIA</th>
                                
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.metodo_pago.componentes.modal");

@endsection
