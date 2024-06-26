@extends('layouts.app')
@section('title', 'Editar cotización')

    @push('script')
        {{-- validación form --}}
        {{-- <script src="{{asset('assets/js/modules/Commercial/commercial.js')}}"></script> --}}
        <script src="{{ asset('assets/js/modules/Commercial/quote_edit.js') }}"></script>
    @endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar cotización',
	    'breadcrumb' => 'quotes/edit',
        'dataBreadcrumb' => ['id' => $quote->id] ])

        <form method="POST"
            action="{{ route('commercial.quotes.update', $quote->id) }}">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            @include('modules.commercial.quotes.partials.formEdit', [ 'quote' => $quote])

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>

     @endcomponent
@endsection
