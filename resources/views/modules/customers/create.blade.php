@extends('layouts.app')
@section('title', 'Clientes')
@push('script')
    {{-- validación form --}}
    <script src="{{asset('assets/js/modules/Shared/contact.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/services.js')}}"></script>
    <script src="{{asset('assets/js/modules/Shared/cities.js')}}"></script>
@endpush
@section('content')
	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nuevo cliente',
	    'breadcrumb' => 'customers/crear'])

        <form action="{{  route('customers.create') }}"
            method="POST"
            id="formStore">
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

            <div class="card-border">
                @include('modules.shared.infoPersonalForm')
            </div>

            {{-- contactos--}}
            @component('componentes.cardTitle',[
                'shadow' => true,
                'icono'  => 'fas fa-info-circle',
                'title' => 'Contactos'])
            @endcomponent
            <div class="card-border">
                @include('modules.shared.contacsForm', [
                    'showButtons' => true,
                    'numeroContacto' => 1
                ])
            </div>

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent
        </form>
     @endcomponent
@endsection
