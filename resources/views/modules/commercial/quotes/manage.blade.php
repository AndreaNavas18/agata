@extends('layouts.app')
@section('title', 'Quotes')
@push('script')
@endpush

@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver Quote'. ' - ' .($quote->consecutive),
	    'breadcrumb' => 'quotes/manage',
        'dataBreadcrumb' => ['id' =>$quote->id ] ])

        <div class="card-border">
            <h4><strong>Información cotización</strong></h4>
            <div class="card-border">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Consecutivo',])
                        @endcomponent
                        <div>
                            {{ $quote->consecutive }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Asunto',])
                        @endcomponent
                        <div>
                            {{ $quote->issue }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Nombre',])
                        @endcomponent
                        <div>
                            {{ $quote->name }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Tipo de documento',])
                        @endcomponent
                        <div>
                            {{ $quote->typeDocument->name ?? 'No se especificó' }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Identificación',])
                        @endcomponent
                        <div>
                            {{ $quote->identification }}
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Correo electronico',])
                        @endcomponent
                        <div>
                            {{ $quote->email }}
                        </div>
                    </div>  
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Teléfono',])
                        @endcomponent
                        <div>
                            {{ $quote->phone }}
                        </div>
                    </div>                               
                </div>
            </div>
                    @foreach ($tariff as $tariffItem)
                    <div class="card-border">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Nombre del servicio',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->tariff->comercialTypeService->name ?? 'No se especificó' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Departamento',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->tariff->bandwidth->department->name ?? 'No se especificó' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Ciudad',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->tariff->bandwidth->city->name ?? 'No se especificó' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Dirección | Coordenadas',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->address ?? 'No se especificó' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Velocidad (Mbps)',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->tariff->bandwidth->name ?? 'No se especificó' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'NRC 12 Meses',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->nrc_12 ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'NRC 24 Meses',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->nrc_24 ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                @component('componentes.label', [
                                    'title' => 'NRC 36 Meses',])
                                @endcomponent
                                <div>
                                    {{ $tariffItem->nrc_36 ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                @component('componentes.label', [
                                    'title' => 'Condiciones',
                                    'required' => false])
                                @endcomponent
                                <textarea disabled class="form-control">
                                    {{  $tariffItem->observation }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($section->isNotEmpty())
                        @foreach ($section as $sectionItem)
                        <div class="card-border">
                            <div class="row">
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Servicio',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->typeService->name ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Tramo',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->tramo ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Trayecto',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->trayecto ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Hilos',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->hilos ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Extremo A',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->extremo_a ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Extremo B',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->extremo_b ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Kms',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->kms ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Recurrente mensual',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->recurrente_mes ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Recurrente 12 meses',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->recurrente_12 ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Recurrente 24 meses',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->recurrente_24 ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Recurrente 36 meses',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->recurrente_36 ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Tiempo',])
                                    @endcomponent
                                    <div>
                                        {{ $sectionItem->tiempo ?? 'No se especificó' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Vr KM/par USD',])
                                    @endcomponent
                                    <div>
                                       $ {{ $sectionItem->valor_km_usd ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Vr total IRU USD',])
                                    @endcomponent
                                    <div>
                                       $ {{ $sectionItem->valor_total_iru_usd ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Vr Km/par COP',])
                                    @endcomponent
                                    <div>
                                       $ {{ $sectionItem->valor_km_cop ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Valor total',])
                                    @endcomponent
                                    <div>
                                       $ {{ $sectionItem->valor_total ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    @component('componentes.label', [
                                        'title' => 'Condiciones',
                                        'required' => false])
                                    @endcomponent
                                    <textarea disabled class="form-control">
                                        {{  $sectionItem->observation }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
        </div>
     @endcomponent
@endsection
