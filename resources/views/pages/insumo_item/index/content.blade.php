@extends('layouts.app')

@section('titulo','INSUMO_ITEM')

@include("pages.insumo_item.index.script")
@include("pages.insumo_item.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Insumo_Item</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID_INSUMO_ITEM</th>
                                    <th>ID_ITEM_MENU</th>
                                    <th>ID_INSUMO</th>
                                    <th>CANTIDAD</th>
                                </tr>
                            </thead>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include("pages.insumo_item.componentes.modal");

@endsection
