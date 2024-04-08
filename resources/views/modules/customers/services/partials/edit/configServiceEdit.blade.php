@extends('layouts.app')
@section('title', 'Configuración de servicio')
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar configuración del servicio ' . $service->name,
	    'breadcrumb' => 'services/show/config',
        'dataBreadcrumb' => ['id' => $service->id] ])

        {{-- datos personales--}}
        {{-- @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Datos personales'])
        @endcomponent --}}
        <h4><strong>Configuración del servicio</strong></h4>

        <form method="POST"
            action="{{ route('customers.services.updateConfig', $service->id) }}"
            enctype="multipart/form-data"
            id="formUpdate">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            <div class="card-border">
                @include('modules.customers.services.partials.formConfig', ['service' => $service])
            </div>

            <h4><strong>Documentos</strong></h4>
            <div class="card-border">
                @include('modules.customers.services.partials.documentsList', ['service' => $service])
            </div>

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>
    @endcomponent
@endsection
