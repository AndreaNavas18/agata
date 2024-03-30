@extends('layouts.app')
@section('title', 'Parameters')

@section('content')
   	@component('componentes.card', [
        'shadow' => true,
        'title' => 'Parámetros ( General )',
        'breadcrumb' => 'parameters/general'])

        <div class="row">

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-secondary loading"
                    href="{{ route('params.general.countries') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-globe h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Paises</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-success loading"
                    href="{{ route('params.general.departments') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-map-location-dot h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Departamentos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-info loading"
                    href="{{ route('params.general.cities') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-city h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Ciudades</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-warning loading"
                    href="{{ route('params.general.services') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fab fa-sellsy h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Servicios</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-primary loading"
                    href="{{ route('params.general.types_contact') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-regular fa-address-book h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Tipos contactos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-secondary loading"
                    href="{{ route('params.general.types_documents') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-id-card-clip h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Tipos documentos</h5>
                        </div>
                    </div>
                </a>
            </div>
    @can('parametros.general.soporte')
            <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-success loading"
                    href="{{ route('params.general.types_priorities') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-list h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Motivos de solicitud</h5>
                        </div>
                    </div>
                </a>
            </div>
    @endcan
            {{-- <div class="col-md-4 col-lg-3 mb-3">
                <a class="font-weight-bold text-center py-3 h-100 w-100 btn btn-info loading"
                    href="{{ route('params.general.proyectos') }}">
                    <div class="row">
                        <div class="col-12">
                            <i class="fa-solid fa-network-wired h2 text-white"></i>
                        </div>
                        <div class="col-12">
                            <h5 class="text-white">Proyectos - Contratos </br> - Subclientes</h5>
                        </div>
                    </div>
                </a>
            </div> --}}

        </div>
    @endcomponent

@endsection
