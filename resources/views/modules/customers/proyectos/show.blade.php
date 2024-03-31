@extends('layouts.app')
@section('title', 'Proyectos')
@push('script')
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

	@component('componentes.card',[
            'shadow' => true,
            'title' => 'Ver Proyecto '.$proyecto->name,
            'breadcrumb' => 'proyectos/show',
            'dataBreadcrumb' => ['id' =>$proyecto->id ]
        ])

        {{-- contactos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Nombre proyecto'])
        @endcomponent
		<div class="card-border">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Nombre proyecto',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $proyecto->name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Descripcion proyecto',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $proyecto->description }}

                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Cliente',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $proyecto->customer ? $proyecto->customer->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Fecha de creacion proyecto',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $proyecto->created_at }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tipo de servicio',
                        'required' => false])
                    @endcomponent
                    <div>
                            {{ $proyecto->customerServices->first()->service->name }}
                    </div>
                </div>
            </div>
        </div>
    {{-- Si el proyecto tiene asignados servicios, que los muestre --}}
    @if($proyecto->customerServices->count() > 0)
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Servicios asignados'])
        @endcomponent
        <div class="card-border">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th>Tipo de servicio</th>
                                <th>Fecha</th>
                                <th>Crear ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proyecto->customerServices as $service)
                                <tr>
                                    <td>{{ $service->description }}</td>
                                    <td>{{ $service->service->name }}</td>
                                    <td>{{ $service->created_at }}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm loading mb-1 createforservice"
                                            href="{{ route('tickets.create') }}"
                                            data-id="{{ $service->id }}"
                                            @if(isset($newTab) && $newTab)
                                                target="'_blank"
                                            @endif
                                            bs-toggle="tooltip"
                                            bs-placement="top"
                                            title="Crear ticket para este servicio">
                                            <i class="fas fa-regular fa-land-mine-on"></i>
                                            @php
                                                echo $service->id;
                                            @endphp
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
     @endcomponent
@endsection
