@extends('layouts.app')

@section('titulo','LOG')

@include("pages.log.index.script")
@include("pages.log.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Log</h5>
                        <button class="btn btn-success mb-2 mr-2 btn-actualizar"><i data-feather="refresh-cw"></i> Actualizar</button>
                    </div>
                    <div class="widget-content">
                        <div class="col-12" id="table-ventas-lote">
                            <table id="tabla_lista" class="table table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th>Sender Serial</th>
                                    <th>Fecha</th>
                                    <th>Request</th>
                                </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
