@extends('layouts.app')
@section('title', 'Nuevo Tarifa')
    @push('script')
        <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nueva Tarifa',
	    'breadcrumb' => 'commercial/tariff/crear'])


        <form method="POST">
            {{-- action="{{ route('tickets.store') }}"> --}}
            {{-- @csrf() --}}

            {{-- formulario--}}
            {{-- @include('modules.commercial.tariff.partials.form') --}}

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>

     @endcomponent
@endsection
