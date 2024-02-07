@extends('layouts.app')
@section('title', 'Proveedores')

@push('script')
    <script src="{{asset('assets/js/modules/Shared/contact.js')}}"></script>
@endpush

@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nuevo proveedor',
	    'breadcrumb' => 'providers/crear'])

        <form action="{{  route('providers.store') }}"
            method="POST">
            @csrf


            {{-- inputs ocultos --}}
            <input type="hidden"
                id="typesContacts"
                value="{{$typesContacts}}">

            <input type="hidden"
                id="cities"
                value="{{$cities}}">

            {{-- datos personales--}}
            @component('componentes.cardTitle',[
                'shadow' => true,
                'icono'  => 'fas fa-info-circle',
                'title' => 'Datos personales'])
            @endcomponent
            @include('modules.shared.infoPersonalForm')

            {{-- contactos--}}
            @component('componentes.cardTitle',[
                'shadow' => true,
                'icono'  => 'fas fa-info-circle',
                'title' => 'Contactos'])
            @endcomponent
            @include('modules.shared.contacsForm', [
                'showButtons' => true,
                'numeroContacto' => 1
            ])


            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>
     @endcomponent
@endsection
