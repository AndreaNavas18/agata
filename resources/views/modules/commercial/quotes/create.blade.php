@extends('layouts.app')
@section('title', 'Nueva cotizacion')
    @push('script')
        <script src="{{asset('assets/js/modules/Commercial/commercial.js')}}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nueva cotización',
	    'breadcrumb' => 'quotes/crear'])


        <form method="POST"
            action="{{ route('commercial.quotes.store') }}">
            @csrf()

            {{-- formulario--}}
            @include('modules.commercial.quotes.partials.form')

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>

     @endcomponent
@endsection
