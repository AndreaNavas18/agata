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
    <script>
        // Espera a que el DOM esté completamente cargado
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener todos los botones con la clase createforservice
            var buttons = document.querySelectorAll('.createforservice');
            
            // Iterar sobre cada botón
            buttons.forEach(function(button) {
                // Agregar un event listener para el clic en cada botón
                button.addEventListener('click', function(event) {
                    // Prevenir el comportamiento predeterminado del enlace
                    event.preventDefault();
                    
                    // Obtener el data-id del botón clicado
                    var serviceId = button.getAttribute('data-id');
                    
                    // Obtener la URL base del enlace
                    var url = button.getAttribute('href');
                    
                    // Concatenar el data-id a la URL base
                    var newUrl = url + '/' + serviceId;
                    
                    // Redirigir a la nueva URL
                    window.location.href = newUrl;
                });
            });
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
                    href="{{ route('customers.services.index.all') }}">
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

                @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                    <button class="btn btn-success btn-sm addService"
                        type="button"
                        dataUrl="{{ route('customers.services.store') }}">
                        <i class="fas fa-plus"></i> Crear
                    </button>

                     <a class="btn btn-info btn-sm"
                        data-toggle="collapse"
                        href="#importar"
                        role="button"
                        aria-expanded="false"
                        aria-controls="importar">
                        <i class="fas fa-light fa-file"></i> Importar
                    </a>
                @endif
                </div>
                
                <!-- Filtros -->
            <div class="collapse card-border" id="buscar">
                <form method="GET" id="frmBuscar" 
                action="{{route('customers.services.index.buscar')}}">
                    
                    @include('modules.customers.partials.formFilter', [
                        'provider' =>true,
                        'customer' => true,
                    ])
                </form>
            </div>

            <div class="collapse card-border" id="importar">
                <form method="POST" id="frmImport" action="{{ route('customers.services.import') }}" enctype="multipart/form-data" >
                    @csrf
                    @include('modules.customers.partials.importServices', [
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

