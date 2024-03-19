@extends('layouts.app')
@section('title', 'Configuración de servicios')

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
            'urlConfig' => route('customers.services.show.config', $service->id )
        ])

        {{-- contactos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Información de la configuración del servicio'])
        @endcomponent
		<div class="card-border">
            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Ip',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->ip ? $service->ip : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Vlan',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->vlan ? $service->vlan : 'No se especifico' }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Mascara',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->mascara ? $service->mascara : 'No se especifico' }}
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Gateway',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->gateway ? $service->gateway : 'No se especifico' }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Mac',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->mac ? $service->mac : 'No se especifico' }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Ancho de banda',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{  $service->ancho_de_banda ? $service->ancho_de_banda : 'No se especifico' }}
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Ip vpn',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->ip_vpn ? $service->ip_vpn : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Tipo vpn',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->tipo_vpn ? $service->tipo_vpn : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'User vpn',
                            'required' => false])
                        @endcomponent
                        <div>
                                {{ $service->user_vpn ? $service->user_vpn : 'No se especifico'}}
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Password vpn',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->password_vpn ? $service->password_vpn : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'User tunel',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->user_tunel ? $service->user_tunel : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Id tunel',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->id_tunel ? $service->id_tunel : 'No se especifico'}}
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Tecnología',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->tecnologia ? $service->tecnologia : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Equipo',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->equipo ? $service->equipo : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Modelo',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->modelo ? $service->modelo : 'No se especifico'}}
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Serial',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->serial ? $service->serial : 'No se especifico'}}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        @component('componentes.label', [
                            'title' => 'Activo fijo',
                            'required' => false])
                        @endcomponent
                        <div>
                            {{ $service->activo_fijo ? $service->activo_fijo : 'No se especifico'}}
                        </div>
                    </div>
            </div>
        </div>
            {{-- documentos--}}
            @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-file',
            'title' => 'Archivos de configuración del servicio'])
            @endcomponent
                <div class="card-border">
                    @include('modules.customers.services.partials.documentsList', ['service' => $service])
                </div>
    @endcomponent

@endsection
