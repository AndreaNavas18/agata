@extends('layouts.app')
@section('title', 'Departamentos')
@push('script')
	<script>
		$('form.frmEliminar').submit(function(e) {
			if (!confirm('¿Está seguro que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
@endpush
@section('content')
	@component('componentes.card', [
        'shadow' => true,
        'title' => 'Departamentos',
        'breadcrumb' => 'parameters/general/departments'])

        <!-- Acciones -->
        @slot('header')

            <a class="btn btn-primary btn-sm loading"
                href="{{ route('params.general.departments') }}">
                <i class="fas fa-sync-alt"></i> Refrescar
            </a>

            <a class="btn btn-info btn-sm"
                data-toggle="collapse"
                href="#buscar"
                role="button"
                aria-expanded="false"
                aria-controls="buscar">
                <i class="fas fa-search"></i> Buscar
            </a>

            <button class="btn btn-success btn-sm"
                type="button"
                data-toggle="modal"
                data-target="#modalCrear">
                <i class="fas fa-plus"></i> Crear
            </button>

        @endslot

        <!-- Filtros -->
        <div class="collapse card-border" id="buscar">
            <form method="GET"
                id="formSearch"
                action="{{ route('params.general.departments.search') }}">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <input class="form-control mr-2"
                        type="text"
                        name="name"
                        placeholder="Nombre"
                        value="{{ (isset($data['name'])) ? $data['name'] : '' }}"
                        required>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4">
                        <button class="btn btn-primary btn-sm"
                            type="bubmit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Datos -->
        <div class="row">
            <div class="col-12">
                @component('componentes.table')
                    @slot('thead')
                    <th>Pais</th>
                        <th>Nombre</th>
                        <th></th>
                    @endslot
                    @slot('tbody')
                        @foreach($datos as $key=> $row)
                            <tr>
                                <td> {{ $row->country ? $row->country->name : '' }}</td>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>

                                    {{-- acciones --}}
                                    <button class="btn btn-success btn-sm"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#modalEditar{{$row->id}}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form class="d-inline frmDestroy"
                                        action="{{ route('params.general.departments.destroy', $row->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    {{-- editar --}}
                                    <form action="{{ route('params.general.departments.update', $row->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        @component('componentes.modal', [
                                            'id' => 'modalEditar'. $row->id,
                                            'title' => 'Editar departamento',
                                            'btnCancel' => true])
                                            @slot('body')
                                                <div class="form-group mb-3">
                                                    @component('componentes.label', [
                                                        'title' => 'Pais',
                                                        'id' => 'country_id',
                                                        'required' => true])
                                                    @endcomponent
                                                    <select class="form-control
                                                        selectpicker"
                                                        name="country_id"
                                                        id="country_id"
                                                        required>
                                                        <option value="">--Seleccione--</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ $row->country_id == $country->id ? 'selected' : ''  }}>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    @component('componentes.label', [
                                                        'title' => 'Nombre',
                                                        'id' => 'name',
                                                        'required' => true])
                                                    @endcomponent
                                                    <input type="text"
                                                        name="name"
                                                        class="form-control"
                                                        value="{{ $row->name }}"
                                                        required="">
                                                </div>
                                            @endslot
                                            @slot('footer')
                                                <button class="btn btn-primary btn-sm"
                                                    type="submit">
                                                    <i class="fas fa-save"></i>
                                                    Actualizar
                                                </button>
                                            @endslot
                                        @endcomponent
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endslot

                    @if(!isset($data))
                        {{ $datos->links() }}
                    @else
                        {{ $datos->appends($data)->links() }}
                    @endif
                @endcomponent
            </div>
        </div>
	@endcomponent

	<!-- Modal -->
    <form action="{{ route('params.general.departments.store') }}"
        method="POST"
        id="formStore">
        @csrf

        @component('componentes.modal', [
            'id' => 'modalCrear',
            'title' => 'Nuevo departamento',
            'btnCancel' => true])
            @slot('body')
                <div class="form-group mb-3">
                    @component('componentes.label', [
                        'title' => 'Departmento',
                        'id' => 'country_id',
                        'required' => true])
                    @endcomponent
                    <select class="form-control
                        selectpicker"
                        name="country_id"
                        id="country_id"
                        required>
                        <option value="">--Seleccione--</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @component('componentes.label', [
                        'title' => 'Nombre',
                        'id' => 'name',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="name"
                        class="form-control"
                        required>
                </div>
            @endslot
            @slot('footer')
                <button class="btn btn-primary btn-sm"
                    type="submit">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            @endslot
        @endcomponent
    </form>

@endsection
