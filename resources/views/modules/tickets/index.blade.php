@extends('layouts.app')
@section('title', 'Tickets')
@push('script')
    <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script>
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
	'title' => 'Tickets',
	'breadcrumb' => 'tickets'])

        <!-- Acciones -->
        @slot('header')
            @can('tickets_ver')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('tickets.index') }}">
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

            @can('tickets_crear')
                <a class="btn btn-success btn-sm loading"
                    href="{{ route('tickets.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>
            @endcan

        @endslot

        <!-- Filtros -->
        @can('tickets_ver')
            <!-- ocultos -->
            <input type="hidden"
                id="rutaAjax"
                data-url-employees="{{ route('tickets.employees.positions.departments') }}"
                data-url-services="{{ route('tickets.customers.services') }}">

            <div class="collapse card-border" id="buscar">
                <form class="form-inline"
                    action="{{ route('tickets.search') }}"
                    method="GET">
                    @include('modules.tickets.partials.formFilter', [
                        'customer' => true,
                        'provider' => true,
                    ])
                </form>
            </div>
        @endcan
        <!-- Datos -->
        @include('modules.tickets.partials.ticketsList', [
            'customer' => true,
            'provider' => true,
            'showActions' =>true,
        ])
	@endcomponent
@endsection
