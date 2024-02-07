@extends('layouts.app')
@section('title', 'Nuevo ticket')
    @push('script')
        <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nuevo ticket',
	    'breadcrumb' => 'tickets/crear'])


        <form method="POST"
            action="{{ route('tickets.store') }}">
            @csrf()

            {{-- formulario--}}
            @include('modules.tickets.partials.form')

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>

     @endcomponent
@endsection
