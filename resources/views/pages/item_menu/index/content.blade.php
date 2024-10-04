@extends('layouts.app')

@section('titulo','ITEM_MENU')

@include("pages.item_menu.index.script")
@include("pages.item_menu.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Item_Menu</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-registrar"><i data-feather="plus-circle"></i> Crear</button>

                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="tabla_lista" class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>ID_ITEM_MENU</th>
                                    <th>ID_CATEGORIA</th>
                                    <th>NOMBRE_ITEM</th>
                                    <th>DESCRIPCION</th>
                                    <th>PRECIO_ITEM</th>
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

    @include("pages.item_menu.componentes.modal");

@endsection
