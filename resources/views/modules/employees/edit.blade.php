@extends('layouts.app')
@section('title', 'Empleados')
@push('script')
	<script>
		$('form.frmEliminar').submit(function(e) {
			if (!confirm('¿Está seguro que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
@endpush
@section('content')


	@component('componentes.card',[
        'shadow' => true,
	    'title' => 'Editar empleado',
	    'breadcrumb' => 'employees/edit',
        'dataBreadcrumb' => ['id' => $employee->id] ])

        {{-- datos personales--}}
        {{-- @component('componentes.cardTitle',[
            'shadow' => true,
            'icono'  => 'fas fa-info-circle',
            'title' => 'Datos personales'])
        @endcomponent --}}
        <h4><strong>Datos personales</strong></h4>

        <form method="POST"
            action="{{ route('employees.update', $employee->id) }}"
            enctype="multipart/form-data"
            id="formUpdate">
            @csrf()
            @method('PUT')

            {{-- formulario--}}
            <div class="card-border">
                @include('modules.employees.partials.form', ['employee' => $employee])
            </div>

            {{-- documentos--}}
            {{-- @component('componentes.cardTitle',[
                'shadow' => true,
                'icono'  => 'fas fa-file',
                'title' => 'Documentos'])
            @endcomponent --}}
            <h4><strong>Documentos</strong></h4>
            <div class="card-border">
                @include('modules.employees.partials.documentsList', ['employee' => $employee])
            </div>

            {{-- acciones--}}
            @component('componentes.acciones')
            @endcomponent

        </form>
    @endcomponent
@endsection
