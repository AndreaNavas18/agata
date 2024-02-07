@extends('layouts.app')
@section('title', 'Editar ticket')

    @push('script')
        {{-- validación form --}}
        <script src="{{asset('assets/js/modules/Tickets/tickets.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar ticket',
	    'breadcrumb' => 'tickets/edit',
        'dataBreadcrumb' => ['id' => $ticket->id] ])

        <form method="POST"
            action="{{ route('tickets.update', $ticket->id) }}">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            @include('modules.tickets.partials.form', [ 'ticket' => $ticket])

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>

     @endcomponent
@endsection
