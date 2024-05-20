@extends('layouts.app')
@section('title', 'Tarifa')
@push('script')
@endpush
@section('content')

	@component('componentes.card',[
            'shadow' => true,
            'title' => 'Ver Tarifa '.$tariff->id,
            'breadcrumb' => 'commercial/tariff/show',
            'dataBreadcrumb' => ['id' =>$tariff->id ]
        ])

         {{-- tabs--}}
         {{-- @include('modules.customers.services.partials.tab',[
            'urlnfo' => route('customers.services.show.service', $service->id),
            'urlConfig' => route('customers.services.show.config', ['id' => $service->id] )
        ]) --}}

        <!-- Boton de editar la Tarifa -->
        <div>
            <a class="btn btn-success btn-sm mb-1 loading"
                href="{{ route('tariff.edit', $tariff->id) }}"
                bd-toggle="tooltip"
                bd-placement="top"
                title="Editar Servicio">
                <i class="fas fa-edit"> Editar</i>
            </a>
        </div>

        {{-- contactos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Información Tarifa'])
        @endcomponent
		<div class="card-border">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tipo de Servicio',
                        'required' => false])
                    @endcomponent
                    <div>
                    </div>
                    {{  $tariff->comercialTypeService ? $tariff->comercialTypeService->name : 'No se especifico'}}
                </div>

                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'BW',
                        'required' => false])
                    @endcomponent
                    <div>
                    </div>
                    {{  $tariff->bandwidth ? $tariff->bandwidth->name : 'No se especifico'}}
                </div>

                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Valor Recurrente',
                        'required' => false])
                    @endcomponent
                    <div>
                    </div>
                    {{  $tariff->recurring_value ? $tariff->recurring_value : 'No se especifico'}}
                </div>

                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Meses',
                        'required' => false])
                    @endcomponent
                    <div>
                    </div>
                    {{  $tariff->months ? $tariff->months : 'No se especifico'}}
                </div>

                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Valor Mbps',
                        'required' => false])
                    @endcomponent
                    <div>
                    </div>
                    {{  $tariff->value_Mbps ? $tariff->value_Mbps : 'No se especifico'}}
                </div>
            </div>
        </div> 
     @endcomponent
@endsection

{{-- inputs ocultos --}}
{{-- <input type="hidden"
id="cities"
value="{{$cities}}"> --}}