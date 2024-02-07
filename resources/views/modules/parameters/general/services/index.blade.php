@extends('layouts.app')
@section('title', 'Servicios Stratecsa')
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
        'title' => 'Servicios Stratecsa',
        'breadcrumb' => 'parameters/general/services'])

        <!-- Acciones -->
        @slot('header')

            <a class="btn btn-primary btn-sm loading"
                href="{{ route('params.general.services') }}">
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
                action="{{ route('params.general.services.search') }}">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <input class="form-control mr-2"
                        type="text"
                        name="name"
                        placeholder="Nombre"
                        value="{{ (isset($data['name'])) ? $data['name'] : '' }}"
                        required>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-4 mt-2">
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
                        <th></th>
                    @endslot
                    @slot('tbody')
                        @foreach($datos as $key=> $row)
                            <tr>
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
                                        action="{{ route('params.general.services.destroy', $row->id) }}"
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
                                    <form action="{{ route('params.general.services.update', $row->id) }}"
                                        method="POST"
                                        id="formUpdate">
                                        @csrf
                                        @method('PUT')
                                        @component('componentes.modal', [
                                            'id' => 'modalEditar'. $row->id,
                                            'title' => 'Editar servicio',
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
    <form action="{{ route('params.general.services.store') }}"
        method="POST"
        id="formStore">
        @csrf

        @component('componentes.modal', [
            'id' => 'modalCrear',
            'title' => 'Nuevo servicio',
            'btnCancel' => true])
            @slot('body')
                <div class="form-group">
                    <label class="form-label">
                        Nombre
                    </label>
                    <input type="text"
                        name="name"
                        class="form-control"
                        required="">
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
