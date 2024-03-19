@extends('layouts.app')
@section('title', 'Configuración de servicio')
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar configuración del servicio',
	    'breadcrumb' => 'services/show',
        'dataBreadcrumb' => ['id' => $service->id] ])

        {{-- datos personales--}}
        {{-- @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Datos personales'])
        @endcomponent --}}
        <h4><strong>Información servicio</strong></h4>

        <form method="POST"
            action="{{ route('customers.services.update', $service->id) }}"
            id="formUpdate">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            <div class="card-border">
                @include('modules.customers.services.partials.form', ['service' => $service])
            </div>

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>
    @endcomponent
@endsection
