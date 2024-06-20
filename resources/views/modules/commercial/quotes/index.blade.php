@extends('layouts.app')
@section('title', 'Cotizaciones')
@push('script')
    <script src="{{asset('assets/js/modules/Commercial/commercial.js')}}"></script>
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
	'title' => 'Cotizaciones',
	'breadcrumb' => 'quotes'])
        <!-- Acciones -->
        @slot('header')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('commercial.quotes.index') }}">
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

                <a class="btn btn-success btn-sm loading"
                    href="{{ route('commercial.quotes.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>
        @endslot

            <div class="collapse card-border" id="buscar">
                <form class="form-inline"
                    action="{{ route('commercial.quotes.search') }}"
                    method="GET"
                    id="formSearch">
                    @include('modules.commercial.quotes.partials.formFilter')
                    {{-- Input oculto para mandar la accion de buscar --}}
                    <input type="hidden" name="action" value="buscar">
                </form>
            </div>
        <!-- Datos -->
        @include('modules.commercial.quotes.partials.quotesList', [
            'showActions' =>true,
        ])
	@endcomponent
@endsection
