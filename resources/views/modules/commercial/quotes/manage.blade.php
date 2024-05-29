@extends('layouts.app')
@section('title', 'Quotes')
@push('script')
@endpush

@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver Quote'. ' - ' .($quote->id),
	    'breadcrumb' => 'quotes/manage',
        'dataBreadcrumb' => ['id' =>$quote->id ] ])

        <div class="card-border">
            <h4><strong>Información cotización</strong></h4>
            <div class="card-border">
                <div class="row">
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
                            'title' => 'Identificación',])
                        @endcomponent
                        <div>
                            {{ $quote->identification }}
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
                    <div class="col-md-3 mb-4">
                        @component('componentes.label', [
                            'title' => 'Dirección',])
                        @endcomponent
                        <div>
                            {{ $quote->direction }}
                        </div>
                    </div>


                    <div class="col-md-12 mb-4">
                        @component('componentes.label', [
                            'title' => 'Observacion',
                            'required' => false])
                        @endcomponent
                        <textarea disabled class="form-control">{{  $quote->observation }}</textarea>
                    </div>
                   
                </div>
            </div>
        </div>
     @endcomponent
@endsection
