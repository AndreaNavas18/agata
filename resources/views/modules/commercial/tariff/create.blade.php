@extends('layouts.app')
@section('title', 'Nuevo Tarifa')
    @push('script')
    <script src="{{ asset('assets/js/modules/Commercial/commercial.js') }}"></script>

    @endpush
@section('content')

    @component('componentes.card', [
        'shadow' => true,
        'title' => 'Nueva Tarifa',
        'breadcrumb' => 'commercial/tariff/crear',
    ])


        <form method="POST" action="{{ route('tariff.store') }}">
            @csrf()

            {{-- formulario --}}
            @include('modules.commercial.tariff.partials.form')

            {{-- contenedor para campos adicionales --}}
            <div id="additionalFieldsContainer"></div>

            {{-- acciones --}}
            @component('componentes.add')
            @endcomponent


        </form>

        {{-- inputs ocultos --}}
        <input type="hidden" id="rutaAjax" data-url-form="{{ route('tariff.addFields') }}">
    @endcomponent
@endsection
