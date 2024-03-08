@extends('layouts.app')
@section('title', 'Roles')
@push('script')
	<script>
		$('form.frmEliminar').submit(function(e) {
			if (!confirm('¿Está seguro de que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
@endpush
@section('content')
	@component('componentes.card', [
		'shadow' => true,
		'title' => 'Roles',
		'breadcrumb' => 'roles'])

        <!-- Acciones -->
        @slot('header')
            @can('roles.index')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('roles.index') }}">
                    <i class="fas fa-sync-alt"></i> Refrescar
                </a>
                <a class="btn btn-info btn-sm"
                    data-toggle="collapse"
                    href="#search"
                    role="button"
                    aria-expanded="false"
                    aria-controls="search">
                    <i class="fas fa-search"></i> Buscar
                </a>
            @endcan
            @can('roles.create')
                <button class="btn btn-success btn-sm"
                    type="button"
                    data-toggle="modal"
                    data-target="#modalCrear">
                    <i class="fas fa-plus"></i> Crear
                </button>
            @endcan
        @endslot

        <!-- Filtros -->
        @can('roles.search')
            <div class="collapse card-border" id="search">
                <form
                    action="{{ route('roles.search') }}"
                    method="GET"
                    id="formSearch">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-4">
                            <input class="form-control mr-2"
                                type="text"
                                name="name"
                                placeholder="Rol"
                                value="{{ (isset($data['name'])) ? $data['name'] : '' }}"
                                required>
                        </div>
                        <div class="col-md-3 col-sm-12 mt-2">
                            <button class="btn btn-primary btn-sm"
                                type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endcan

        <!-- Datos -->
        <div class="row">
            <div class="col-sm-12">
                @component('componentes.table')
                    @slot('thead')
                        <th>ID</th>
                        <th>Nombre rol</th>
                        <th></th>
                    @endslot
                    @slot('tbody')
                        @foreach($roles as $rol)
                            <tr>
                                <td>{{ $rol->id }}</td>
                                <td>{{ $rol->name }}</td>
                                <td>
                                    @can('permission.index')
                                        @if($rol->id != 1)
                                            <a class="btn btn-info btn-sm loading mb-3"
                                                href="{{ route('roles.edit', $rol->id) }}"
                                                data-toggle="tooltip"
                                                data-plabs-cement="top"
                                                title="Editar y Asignar Permisos">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endcan

                                    @can('roles.destroy')
                                        @if($rol->id != 1 && $rol->id != 2)
                                            <form class="d-inline
                                                frmEliminar"
                                                action="{{ route('roles.destroy', $rol->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm mb-3"
                                                    type="submit"
                                                    data-toggle="tooltip"
                                                    data-plabs-cement="top"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endslot

                    @if(!isset($data))
                        {{ $roles->links() }}
                    @else
                        {{ $roles->appends($data)->links() }}
                    @endif
                @endcomponent
            </div>
        </div>

	@endcomponent

	<!-- Modal -->
	@can('roles.create')
		<form action="{{ route('roles.store') }}"
            method="POST"
            id="formStore">
			@csrf

			@component('componentes.modal', [
				'id' => 'modalCrear',
				 'title' => 'Nuevo rol',
				 'btnCancel' => true])
				@slot('body')
	        		<div class="form-group">
						@component('componentes.label', [
							'title' => 'Nombre rol',
							'id' => 'name',
							'required' => true])
						@endcomponent
	        			<input class="form-control"
                            type="text"
                            name="name"
                            id="name"
                            required>
	        		</div>
				@endslot
				@slot('footer')
					<button class="btn btn-primary
                        btn-sm"
                        type="submit">
						<i class="fas fa-save"></i>
                        Guardar
					</button>
				@endslot
			@endcomponent
		</form>
	@endcan
@endsection
