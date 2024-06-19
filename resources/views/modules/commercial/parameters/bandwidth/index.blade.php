@extends('layouts.app')
@section('title', 'ANCHOS DE BANDA')
@push('script')
	<script>
		$('form.frmEliminar').submit(function(e) {
			if (!confirm('¿Está seguro que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
    <script src="{{asset('assets/js/modules/Commercial/cities.js')}}"></script>

@endpush
@section('content')
	@component('componentes.card', [
        'shadow' => true,
        'title' => 'Anchos de banda',
        'breadcrumb' => 'tariff/params/bandwidth'])

        <!-- Acciones -->
        @slot('header')

            <a class="btn btn-primary btn-sm loading"
                href="{{ route('tariff.params.bandwidth.index') }}">
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
            <form
                method="GET"
                id="formSearch"
                action="{{ route('tariff.params.bandwidth.search') }}">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <input class="form-control"
                            type="text"
                            name="name"
                            placeholder="Nombre"
                            value="{{ (isset($data['name'])) ? $data['name'] : '' }}"
                            required>
                    </div>
                    <div class="col-md-4 col-sm-12 mt-2">
                        <button class="btn btn-primary btn-sm"
                            type="submit">
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
                        <th>Nombre</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th></th>
                    @endslot
                    @slot('tbody')
                        @foreach($bandwidths as $key=> $row)
                            <tr>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ $row->department->name }}
                                </td>
                                <td>
                                    {{ $row->city->name }}
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
                                        action="{{ route('tariff.params.bandwidth.destroy', $row->id) }}"
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
                                    <form action="{{ route('tariff.params.bandwidth.update', $row->id) }}"
                                        method="POST">
                                        {{-- id="formUpdate"> --}}
                                        @csrf
                                        @method('PUT')

                                        @component('componentes.modal', [
                                            'id' => 'modalEditar'. $row->id,
                                            'title' => 'Editar Ancho de banda',
                                            'btnCancel' => true])

                                            @slot('body')

                                                <div class="form-group">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text"
                                                        name="name"
                                                        class="form-control"
                                                        value="{{ $row->name }}"
                                                        required="">
                                                </div>

                                                <div class="form-group mb-3">
                                                    @component('componentes.label', [
                                                        'title' => 'Departmento',
                                                        'id' => 'department_id_{{ $row->id }}',
                                                        'required' => false])
                                                    @endcomponent
                                                    <select class="form-control
                                                        selectpicker"
                                                        name="department_id"
                                                        id="department_id_{{ $row->id }}"
                                                        data-city-select-id="city_id_{{ $row->id }}"
                                                        data-container="body"
                                                        data-title="--Seleccione--"
                                                        required>
                                                        <option value="">--Seleccione--</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}"  
                                                                {{ $row->department_id == $department->id ? 'selected' : ''  }}>
                                                                {{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                
                                                <div class="form-group mb-3">
                                                    @component('componentes.label', [
                                                        'title' => 'Ciudad',
                                                        'required' => false])
                                                    @endcomponent
                                                    <select class="form-control
                                                        selectpicker"
                                                        data-width="100%"
                                                        data-container="body"
                                                        name="city_id"
                                                        data-selected-city-id="{{ $row->city_id }}"
                                                        id="city_id_{{ $row->id }}"
                                                        required>
                                                        <option value="">--Seleccione--</option>
                                                        @foreach($cities as $city)
                                                        <option value="{{ $city->id }}"  
                                                            {{ $row->city_id == $city->id ? 'selected' : ''  }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                    </select>
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
                        {{ $bandwidths->links() }}
                    @else
                        {{ $bandwidths->appends($data)->links() }}
                    @endif
                @endcomponent
            </div>
        </div>

	@endcomponent


	<!-- Modal -->
    <form action="{{ route('tariff.params.bandwidth.store') }}"
        method="POST"
        id="formStore">
        @csrf

        @component('componentes.modal', [
            'id' => 'modalCrear',
            'title' => 'Nuevo Ancho de Banda',
            'btnCancel' => true])

            @slot('body')

                {{-- <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                        name="name"
                        class="form-control"
                        id="validationCustom01"
                        required>
                </div> --}}

                <div class="form-group">
                    <label class="form-label">Velocidad</label>
                    <div class="input-group">
                        <input type="number"
                            name="name"
                            class="form-control"
                            id="validationCustom01"
                            inputmode="numeric"
                            required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2" disabled>Mbps</span>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    @component('componentes.label', [
                        'title' => 'Departmento',
                        'id' => 'department_id_create',
                        'required' => false])
                    @endcomponent
                    <select class="form-control
                        selectpicker"
                        name="department_id"
                        id="department_id_create"
                        data-container="body"
                        data-title="--Seleccione--"
                        required>
                        <option value="">--Seleccione--</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    @component('componentes.label', [
                        'title' => 'Ciudad',
                        'required' => false])
                    @endcomponent
                    <select class="form-control
                        selectpicker"
                        data-width="100%"
                        data-container="body"
                        name="city_id"
                        id="city_id_create"
                        required>
                        <option value="">--Seleccione--</option>
                    </select>
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