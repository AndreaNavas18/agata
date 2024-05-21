@extends('layouts.app')
@section('title', 'Editar Tarifa')

    @push('script')
        {{-- validación form --}}
        <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar Tarifa',
	    'breadcrumb' => 'commercial/tariff/edit',
        'dataBreadcrumb' => ['id' => $tariff->id] ])

        <form method="POST"
            {{-- action=""> --}}
            action="{{ route('tariff.update', $tariff->id) }}">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            @include('modules/commercial/tariff/partials/form', [ 'tariff' => $tariff])

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>

     @endcomponent
@endsection
