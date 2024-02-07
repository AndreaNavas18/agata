@extends('layouts.app')
@section('title', 'Clientes')
@push('script')
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Clientes',
	    'breadcrumb' => 'users'])

		@component('componentes.card')
        @endcomponent

     @endcomponent
@endsection
