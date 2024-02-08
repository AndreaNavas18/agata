@extends('layouts.app')
@section('title', 'Servicios Clientes')
@push('script')
    {{-- validación form --}}
    <script src="{{asset('assets/js/modules/Shared/contact.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/services.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/cities.js')}}"></script>
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
	'title' => 'Servicios Clientes',
	'breadcrumb' => 'services'])

        <div class="card-border">
            <div>
                <a class="btn btn-primary btn-sm loading"
                    href="">
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

                <button class="btn btn-success btn-sm addService"
                    type="button"
                    dataUrl="{{ route('customers.services.store') }}">
                    <i class="fas fa-plus"></i> Crear
                </button>
            </div>

            <!-- Filtros -->
            <div class="collapse card-border" id="buscar">
                <form method="GET" id="frmBuscar" action="">
                    @include('modules.customers.partials.formFilter', [
                        'provider' =>true,
                        'customer' => true,
                    ])
                </form>
            </div>

            @include('modules.shared.servicesList', [
                'services'          => $customerServices,
                'module'            => 'customers',
                'provider'          => true,
                'customer'          => true,
                'showActions'       => true,
                'viewShowService'   => true
            ])
        </div>
    @endcomponent

    {{-- modal servicio--}}
    @include('modules.shared.serviceForm', [
        'module' => 'customers',
        'customer' => true
    ])
@endsection

