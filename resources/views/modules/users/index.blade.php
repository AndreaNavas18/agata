@extends('layouts.app')
@section('title', 'Users')
@push('script')
	<script>
		$('form.frmDestroy').submit(function(e) {
			if (!confirm('¿Está seguro de que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
@endpush
@section('content')
	@component('componentes.card',[
        'shadow' => true,
        'title' => 'Usuarios',
        'breadcrumb' => 'users'])

        <!-- Acciones -->
        @slot('header')
            
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('users.index') }}">
                    <i class="fas fa-sync-alt"></i>
                    Refrescar
                </a>
                <a class="btn btn-info btn-sm"
                    data-toggle="collapse"
                    href="#buscar"
                    role="button"
                    aria-expanded="false"
                    aria-controls="buscar">
                    <i class="fas fa-search"></i>
                    Buscar
                </a>

                <a class="btn btn-success
                    btn-sm loading"
                    href="{{ route('users.create') }}">
                    <i class="fas fa-plus"></i>
                    Crear
                </a>

        @endslot

        <!-- Filtros -->
            <div class="collapse card-border" id="buscar">
                <form
                    action="{{ route('users.search') }}"
                    method="GET">

                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-4">
                            <input class="form-control mr-2"
                                type="text"
                                name="name"
                                placeholder="Usuario"
                                value="{{ (isset($data['name'])) ? $data['name'] : '' }}">
                        </div>
                        <div class="col-md-3 col-sm-12 mb-4">
                            <select class="form-control
                                form-select
                                choices-single-default"
                                name="status"
                                title="Status">
                                <option value="">--Seleccione--</option>
                                <option value="Activo" selected
                                    {{ (isset($data['status']) && $data['status'] == 'Activo') ? 'selected' : '' }}>
                                    Activo
                                </option>
                                <option value="Inactivo"
                                    {{ (isset($data['status']) && $data['status'] == 'Inactivo') ? 'selected' : '' }}>
                                    Inactivo
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 mt-2">
                            <button class="btn btn-primary btn-sm loading"
                                type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <!-- Datos -->
        @component('componentes.table')
            @slot('thead')
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                @if(Auth()->user()->role_id != 3)
                    <th>Rol</th>
                @endif
                <th>Estado</th>
                <th></th>
            @endslot
            @slot('tbody')
                @foreach($users as $usu)
                    <tr>
                        <td>{{ $usu->name }}</td>
                        <td>{{ $usu->last_name }}</td>
                        <td>{{ $usu->email }}</td>
                        @if(Auth()->user()->role_id != 3)
                            <td>
                            @forelse($usu->getRoleNames() as $role)
                                    {{ $role }}
                                @unless($loop->last)
                                    ,
                                @endunless
                                @empty
                                    No se han asignado roles a este usuario.
                                @endforelse
                            </td>
                        @endif
                        <td>
                            <span class="badge {{ ($usu->status == 'Activo') ? 'badge-success' : 'badge-danger' }}">
                                {{ $usu->status }}
                            </span>
                        </td>
                        <td>
                            @can('users_ver')
                                <a class="btn btn-info btn-sm mb-1 loading"
                                    href="{{ route('users.show', $usu->id) }}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @if (!$usu->hasRole(2))
                                @can('users_asignar_permisos')
                                    <a class="btn btn-warning btn-sm mb-1 loading"
                                        href="{{ route('users.assignment_permissions', $usu->id) }}"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Asignar permisos">
                                        <i class="fas fa-key"></i>
                                    </a>
                                @endcan
                                @can('users_editar')
                                    <a class="btn btn-success btn-sm mb-1 loading"
                                        href="{{ route('users.edit', $usu->id) }}"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                            title="Editar y asignar rol">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan

                                    <form class="d-inline frmDestroy"
                                        action="{{ route('users.destroy', $usu->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm mb-1"
                                            type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endslot

            @if(!isset($data))
                {{ $users->links() }}
            @else
                {{ $users->appends($data)->links() }}
            @endif
        @endcomponent

	@endcomponent
@endsection
