@extends('layouts.app')
@section('title', 'Parámetros')

@section('content')
   	@component('componentes.card', [
        'shadow' => true,
        'title' => 'Parámetros ( Tarificador )',
        'breadcrumb' => 'tariff/params'])

        <div class="row">

            <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-primary loading"
                    href="{{ route('tariff.params.service.index') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-globe h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">TIPO DE SERVICIO</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-success loading"
                    href="{{ route('tariff.params.bandwidth.index') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-wifi h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">BANDA ANCHA</h5>
                        </div>
                    </div>
                </a>
            </div>

            {{-- <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-success loading"
                    href="{{  route('params.employees.positions') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-users-line h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Cargos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-warning loading"
                    href="{{  route('params.employees.departments') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-diagram-project h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Departamentos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-primary loading"
                    href="{{  route('params.employees.eps') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-hospital h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">EPS</h5>
                        </div>
                    </div>
                </a>
            </div> --}}

            {{-- nueva fila--}}
            {{-- <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-primary loading"
                    href="{{  route('params.employees.severance') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-file-invoice-dollar h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Cesantias</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-3">
                <a class="font-weight-bold text-center py-3  w-100 btn btn-warning loading"
                    href="{{  route('params.employees.pensions') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-folder-open h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Pensiones</h5>
                        </div>
                    </div>
                </a>
            </div> --}}

        </div>

    @endcomponent

@endsection
