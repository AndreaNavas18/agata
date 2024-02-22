@extends('layouts.app')

@section('content')
@if(Auth()->user()->role_id != 2)
    <div class="page-header">
        <ol class="breadcrumb"><!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        </ol>
    </div>

    <div class="notificaciones">
        @include('componentes.alerts')
    </div>

    <div class="row row-cards">
        <div class="col-md-4 col-sm-12">
            <div class="card card-counter bg-gradient-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mt-4 mb-0 text-white">
                                <h3 class="mb-0">{{$ticketsOpen}}</h3>
                                <p class="text-white mt-1">Tickets abiertos </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-line-chart mt-3 mb-0 text-white-transparent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col end -->
        <div class="col-md-4 col-sm-12">
            <div class="card card-counter bg-gradient-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mt-4 mb-0 text-white">
                                <h3 class="mb-0">{{$ticketsClosed}}</h3>
                                <p class="text-white mt-1">Tickets cerrados </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-sign-out mt-3 mb-0 text-white-transparent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col end -->
        <div class="col-md-4 col-sm-12">
            <div class="card card-counter bg-gradient-purple">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mt-4 mb-0 text-white">
                                <h3 class="mb-0">{{$ticketsPending}}</h3>
                                <p class="text-white mt-1 ">Tickets pendientes</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fa fa-reply-all mt-3 mb-0 text-white-transparent"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col end -->
    </div>
    <div class="row row-cards">
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body text-center list-icons">
                    <i class="fas fa-wifi text-secondary"></i>
                    <p class="card-text mt-3 mb-3">Servicios internet</p>
                    <p class="h1 text-center  text-secondary">{{$totalServicesInternet}}</p>
                </div>
            </div>
        </div><!-- col end -->
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body text-center list-icons">
                    <i class="far fa-user text-warning"></i>
                    <p class="card-text mt-3 mb-3">Empleados</p>
                    <p class="h1 text-center  text-warning">{{$tottalEmployees}}</p>
                </div>
            </div>
        </div><!-- col end -->
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body text-center list-icons">
                    <i class="far fa-user-circle text-success"></i>
                    <p class="card-text mt-3 mb-3">Clientes</p>
                    <p class="h1 text-center text-success">{{$totalCustomers}}</p>
                </div>
            </div>
        </div><!-- col end -->
        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-body text-center list-icons">
                    <i class="fas fa-broadcast-tower text-primary"></i>
                    <p class="card-text mt-3 mb-3">Proveedores</p>
                    <p class="h1 text-center  text-primary">{{$totalProviders}}</p>
                </div>
            </div>
        </div><!-- col end -->
    </div>
    @else
    {{-- Contenido específico para el rol_id = 2 --}}
    @include('customerRole.home')
    @endif

@endsection
