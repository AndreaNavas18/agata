@extends('layouts.app')
@section('title', 'Proyectos Clientes')
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
    {{-- <script>
        // Espera a que el DOM esté completamente cargado
        document.addEventListener("DOMContentLoaded", function() {
            var buttons = document.querySelectorAll('.createforproyecto');
            
            // Iterar sobre cada botón
            buttons.forEach(function(button) {
                // Agregar un event listener para el clic en cada botón
                button.addEventListener('click', function(event) {
                    // Prevenir el comportamiento predeterminado del enlace
                    event.preventDefault();
                    
                    // Obtener el data-id del botón clicado
                    var proyectoId = button.getAttribute('data-id');
                    
                    // Obtener la URL base del enlace
                    var url = button.getAttribute('href');
                    
                    // Concatenar el data-id a la URL base
                    var newUrl = url + '/' + proyectoId;
                    
                    // Redirigir a la nueva URL
                    window.location.href = newUrl;
                });
            });
        });
</script> --}}

@endpush
@section('content')
	@component('componentes.card',
	['shadow' => true,
	'title' => 'Proyectos - Contratos - Sub clientes',
	'breadcrumb' => 'proyectos'])

        <div class="card-border">
            <div>
                <a class="btn btn-primary btn-sm loading"
                    href="{{route('customers.proyectos.index.all')}}">
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

            <!-- Filtros -->
            <div class="collapse card-border" id="buscar">
                <form method="GET" id="frmBuscar" action="{{route('customers.proyectos.search')}}">
                    @include('modules.customers.partials.formFilter2', [
                        'provider' =>true,
                        'customer' => true,
                    ])
                </form>
            </div>

            @include('modules.shared.proyectosList', [
                'proyectos'          => $proyectos,
                'module'            => 'customers',
                'provider'          => true,
                'customer'          => true,
                'showActions'       => false,
                'viewShowProyecto'   => true,
            ])
        </div>
    @endcomponent

    {{-- modal proyecto --}}
    @include('modules.shared.proyectoForm', [
        'module' => 'customers',
        'customer' => true
    ])
@endsection

