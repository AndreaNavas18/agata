@extends('layouts.app')
@section('title', 'Proyectos')
@push('script')
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
     @endcomponent
@endsection
