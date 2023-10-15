@extends('layouts.app')

@section('titulo','INICIO')

@include("pages.inicio.index.script")
@include("pages.inicio.index.head")

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Revenue</h5>
                    </div>
                    <div class="widget-content">
                        
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
