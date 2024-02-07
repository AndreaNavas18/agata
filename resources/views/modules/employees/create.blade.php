@extends('layouts.app')
@section('title', 'Empleados')
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Nuevo empleado',
	    'breadcrumb' => 'employees/create'])

        {{-- datos personales--}}
        {{-- @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Datos personales'])
        @endcomponent --}}

        <form method="POST"
            action="{{ route('employees.store') }}"
            enctype="multipart/form-data"
            id="formStore">
            @csrf()

            {{-- formulario--}}
            @include('modules.employees.partials.form')

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>
    @endcomponent
@endsection
