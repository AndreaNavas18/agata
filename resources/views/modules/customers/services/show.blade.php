@extends('layouts.app')
@section('title', 'Servicios')
@push('script')
@endpush
@section('content')

	@component('componentes.card',[
            'shadow' => true,
            'title' => 'Ver servicio '.$service->description,
            'breadcrumb' => 'services/show',
            'dataBreadcrumb' => ['id' =>$service->id ]
        ])

         {{-- tabs--}}
         @include('modules.customers.services.partials.tab',[
            'urlnfo' => route('customers.services.show.service', $service->id),
            'urlConfig' => route('customers.services.show.config', ['id' => $service->id] )
        ])

        {{-- contactos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Información servicio'])
        @endcomponent
		<div class="card-border">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Stratecsa Id',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->stratecsa_id ? $service->stratecsa_id : 'No se especifico'}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Id servicio cliente',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->id_serviciocliente ? $service->id_serviciocliente : 'No se especifico'}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Otp',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->otp ? $service->otp : 'No se especifico'}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Nombre servicio',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->name ? $service->name : 'No se especifico'}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Cliente',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->customer->name}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Proyecto',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->proyecto?->name ? $service->proyecto->name : 'No se especifico'}}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tipo servicio',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->service->name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Ciudad',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->city->name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Fecha servicio',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->date_service }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Coordenadas Latitud',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->latitude_coordinates }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Coordenadas Longitud',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->longitude_coordinates }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tipo instalación',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $service->installation_type }}
                    </div>
                </div>
                @if($service->installation_type=='Terceros')
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Proveedor',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->provider && $service->provider->name ? $service->provider->name : 'Sin proveedor' }}
                        </div>
                    </div>
                @endif

                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Estado',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span class="badge bg-{{ $service->state== 'Activo' ? 'success' : 'danger' }}">
                            {{ $service->state }}
                        </span>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    @component('componentes.label', [
                        'title' => 'Descripción',
                        'required' => false])
                    @endcomponent
                    <textarea disabled class="form-control">{{  $service->description }}</textarea>
                </div>
            </div>
        </div>
     @endcomponent
@endsection

{{-- inputs ocultos --}}
{{-- <input type="hidden"
id="cities"
value="{{$cities}}"> --}}