@extends('layouts.app')
@section('title', 'Pqrs')
@push('script')
    <script src="{{asset('assets/js/modules/Pqrs/pqrs.js')}}"></script>
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
	'title' => 'Pqrs',
	'breadcrumb' => 'pqrs'])
        <!-- Acciones -->
        @slot('header')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('pqrs.index') }}">
                    <i class="fas fa-sync-alt"></i> Refrescar
                </a>
                {{-- <a class="btn btn-info btn-sm"
                    data-toggle="collapse"
                    href="#buscar"
                    role="button"
                    aria-expanded="false"
                    aria-controls="buscar">
                    <i class="fas fa-search"></i> Buscar
                </a> --}}

                <a class="btn btn-success btn-sm loading"
                href="{{ route('pqrs.create') }}">
                <i class="fas fa-plus"></i> Crear
            </a>
            </button>

        @endslot

        <!-- Filtros -->
            <!-- ocultos -->
            {{-- <input type="hidden"
                id="rutaAjax"
                data-url-employees="{{ route('tickets.employees.positions.departments') }}"
                data-url-services="{{ route('tickets.customers.services') }}"> --}}

            <div class="collapse card-border" id="buscar">
                <form class="form-inline"
                    action="{{ route('pqrs.search') }}"
                    method="GET"
                    id="formSearch">
                    @include('modules.pqrs.partials.formFilter', [
                        // 'customer' => true,
                    ])
                    {{-- Input oculto para mandar la accion de buscar --}}
                    <input type="hidden" name="action" value="buscar">
                </form>
            </div>
     <!-- Datos -->
     @include('modules.pqrs.partials.pqrsList', [
        'module' => 'pqrs',
        'pqr' => true
    ])
	@endcomponent
@endsection
