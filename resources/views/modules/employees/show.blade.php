@extends('layouts.app')
@section('title', 'Empleados')
@push('script')
@endpush
@section('content')

	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Ver empleado '.$employee->short_name,
	    'breadcrumb' => 'employees/show',
        'dataBreadcrumb' => ['id' =>$employee->id ] ])
         
        
        @can('employees.edit')

            <div class="d-flex justify-content-end" style="height: 20px; align-items:center;">
                <!-- Boton de editar los tickets -->
                <div>
                    <a class="btn btn-success btn-sm mb-1 loading"
                        href="{{ route('employees.edit', $employee->id) }}"
                        bd-toggle="tooltip"
                        bd-placement="top"
                        title="Editar empleado">
                        <i class="fas fa-edit"> Editar</i>
                    </a>
                </div>
            </div>
        @endcan

        {{-- contactos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Información personal'])
        @endcomponent
		<div class="card-border">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tipo documento',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->typeDocument->name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Identificación',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->identification }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Primer nombre',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->first_name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Segundo nombre',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->second_name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Primer apellido',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->surname }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Segundo apellido',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->second_surname }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Nombre completo',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->full_name }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Fecha nacimiento',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->birth_date }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Email',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->email }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Dirección',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->address }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Telefono fijo',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->home_phone }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Celular',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{  $employee->cell_phone }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'ARL',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{   $employee->arl ? $employee->arl->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Pensión',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{   $employee->pension ? $employee->pension->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Cesantias',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $employee->cesantias ? $employee->cesantias->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Eps',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $employee->eps ? $employee->eps->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Departamento cargo',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $employee->position ? $employee->position->department->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Cargo',
                        'required' => false])
                    @endcomponent
                    <div>
                        {{ $employee->position ? $employee->position->name : '' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Estado',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span class="badge bg-{{ $employee->state_id== 1 ? 'success' : 'danger' }}">
                            {{ $employee->state ? $employee->state->name : '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @if($employee->name_contact_emergency !=null )
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-user',
            'title' => 'Contacto de emergencia'])
        @endcomponent
        <div class="card-border">
            <div class="row">
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Nombre',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span >
                            {{ $employee->name_contact_emergency }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Apellido',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span >
                            {{ $employee->last_name_contact_emergency }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Parentezco',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span >
                            {{ $employee->parentesque_contact_emergency }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    @component('componentes.label', [
                        'title' => 'Telefono',
                        'required' => false])
                    @endcomponent
                    <div>
                        <span >
                            {{ $employee->phone_contact_emergency }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif
        {{-- documentos--}}
        @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-file',
            'title' => 'Documentos'])
        @endcomponent
		<div class="card-border">
            @include('modules.employees.partials.documentsList', ['employee' => $employee])
        </div>
     @endcomponent
@endsection

@include('componentes.modalFiles')

