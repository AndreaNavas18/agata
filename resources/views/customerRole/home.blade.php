@extends('layouts.app')

@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
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
    @include('notificaciones')

@endsection
