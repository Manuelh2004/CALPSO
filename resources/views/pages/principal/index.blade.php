@extends('layouts.app')

@section('titulo','PRINCIPAL')

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-md-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">PRINCIPAL</h5>
                    </div>
                    <div class="container mt-5">
                        <h2 class="text-center mb-4">Menú del Restaurante</h2>
                        <div class="row">
                            <!-- Plato 1 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="/assets/img/img_1.png" class="card-img-top" alt="Plato 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Pollo a la Brasa</h5>
                                        <p class="card-text">Delicioso pollo a la brasa acompañado de papas fritas y ensalada fresca.</p>
                                        <p class="text-primary">$12.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Plato 2 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Plato 2">
                                    <div class="card-body">
                                        <h5 class="card-title">Lomo Saltado</h5>
                                        <p class="card-text">Carne salteada con cebolla, tomate y papas fritas, acompañado de arroz.</p>
                                        <p class="text-primary">$14.50</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Plato 3 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Plato 3">
                                    <div class="card-body">
                                        <h5 class="card-title">Ceviche Mixto</h5>
                                        <p class="card-text">Fresco ceviche de pescado y mariscos, servido con camote y cancha.</p>
                                        <p class="text-primary">$18.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Plato 4 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Plato 4">
                                    <div class="card-body">
                                        <h5 class="card-title">Tallarines Verdes</h5>
                                        <p class="card-text">Tallarines con salsa de albahaca, espinacas y queso parmesano.</p>
                                        <p class="text-primary">$10.00</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Plato 5 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Plato 5">
                                    <div class="card-body">
                                        <h5 class="card-title">Ají de Gallina</h5>
                                        <p class="card-text">Tradicional plato peruano a base de gallina deshilachada en crema de ají.</p>
                                        <p class="text-primary">$11.50</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Plato 6 -->
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Plato 6">
                                    <div class="card-body">
                                        <h5 class="card-title">Chaufa de Pollo</h5>
                                        <p class="card-text">Arroz chaufa estilo chino-peruano con trozos de pollo y vegetales.</p>
                                        <p class="text-primary">$13.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
