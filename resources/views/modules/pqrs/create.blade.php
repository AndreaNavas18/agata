@extends('layouts.app')
@section('title', 'Nuevo Pqr')
    @push('script')
        <script src="{{asset('assets/js/modules/Pqrs/pqrs.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nuevo Pqr',
	    'breadcrumb' => 'pqrs/crear'])


        <form method="POST"
            action="{{ route('pqrs.store') }}">
            @csrf()

            {{-- formulario--}}
            @include('modules.pqrs.partials.pqrForm')

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>

     @endcomponent
@endsection
