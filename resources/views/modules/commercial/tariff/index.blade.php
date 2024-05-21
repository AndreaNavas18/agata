@extends('layouts.app')
@section('title', 'Tarificador')
@push('script')
    {{-- <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script> --}}
	<script>
		$('form.frmDestroy').submit(function(e) {
			if (!confirm('¿Está seguro de que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
   
@endpush
@section('content')
	@component('componentes.card',
	['shadow' => true,
	'title' => 'Tarificador',
	'breadcrumb' => 'comercial/tariff'])
        <!-- Acciones -->
        @slot('header')
            @can('commercial.show')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('tariff.index') }}">
                    <i class="fas fa-sync-alt"></i> Refrescar
                </a>
                <a class="btn btn-info btn-sm"
                    data-toggle="collapse"
                    href="#buscar"
                    role="button"
                    aria-expanded="false"
                    aria-controls="buscar">
                    <i class="fas fa-search"></i> Buscar
                </a>
            @endcan

            @can('commercial.create')
                <a class="btn btn-success btn-sm loading"
                    href="{{ route('tariff.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>
            @endcan 

        @endslot

        <!-- Filtros -->
        @can('commercial.search')
            <!-- ocultos -->
            {{-- <input type="hidden"
                id="rutaAjax"
                data-url-employees="{{ route('tickets.employees.positions.departments') }}"
                data-url-services="{{ route('tickets.customers.services') }}"> --}}

            <div class="collapse card-border" id="buscar">
                <form class="form-inline"
                    action="{{ route('tariff.search') }}"
                    method="GET"
                    id="formSearch">
                    @include('modules/commercial/tariff/partials/formFilter', [
                        'customer' => true,
                        'provider' => true,
                    ])
                    {{-- Input oculto para mandar la accion de buscar --}}
                    <input type="hidden" name="action" value="buscar">
                </form>
            </div>
        @endcan
        <!-- Datos -->
        @include('modules.commercial.tariff.partials.tariffsList', [
            'customer' => true,
            'provider' => true,
            'showActions' =>true,
        ])
	@endcomponent
@endsection
