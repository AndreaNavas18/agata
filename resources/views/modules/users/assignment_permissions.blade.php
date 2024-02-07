@extends('layouts.app')
@section('title', 'Usuarios')
@push('css')
	<style>
		.custom-control-label { cursor: pointer; }
		.table-responsive, #containerPills { max-height: 700px; }
	</style>
@endpush
@section('content')
	@component('componentes.card', [
		'shadow' => true,
		'title' => 'Asignar permisos ( '.$user->name.' )',
		'breadcrumb' => 'users/assignment-permissions',
		'dataBreadcrumb' => ['id' => $user->id]
	])
		<form action="{{ route('users.assignment_permissions_update', $user->id) }}"
            method="POST">
			@csrf
			@method('PUT')

            <div class="row">
                <div class="col-sm-12 col-lg-10">
                    @component('componentes.alert_informativa', [
                        'tipo' => 'info',
                        'mensaje' => 'Recuerda que puedes añadir permisos al usuario pero no quitar los asociados al rol.'
                    ])
                    @endcomponent
                    <div class="card-border">
                        <div class="row">
                            <div class="col-4">
                                <div class="overflow-auto" id="containerPills">
                                    <div class="nav flex-column nav-pills">
                                        @foreach($submodules as $k => $submodule)
                                            <a class="nav-link {{ ($k == 0) ? 'active' : '' }}" id="v-{{ $submodule->id }}-tab"
                                                data-toggle="pill" href="#v-{{ $submodule->id }}">
                                                {{ $submodule->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content">
                                    @foreach($submodules as $k => $submodule)
                                        <div class="tab-pane fade {{ ($k == 0) ? 'show active' : '' }}" id="v-{{ $submodule->id }}">
                                            @component('componentes.table')
                                                @slot('thead')
                                                    <th>Nombre permiso</th>
                                                    <th>Asignar permisos</th>
                                                @endslot
                                                @slot('tbody')
                                                    @php
                                                        $permissionsSub = $permissions->filter(function ($value, $key) use ($submodule) {
                                                            return $value->submodule_id == $submodule->id;
                                                        });
                                                    @endphp
                                                    @foreach($permissionsSub as $perm)
                                                        <tr>
                                                            <td>{{ $perm->name }}</td>
                                                            <td>
                                                                <label class="custom-switch">
                                                                    <input class="custom-switch-input"
                                                                        type="checkbox"
                                                                        name="permissions[{{ $perm->id }}]"
                                                                        id="{{ $perm->id }}"
                                                                        {{ ($user->hasPermissionTo($perm->name)) ? 'checked' : '' }}>
                                                                        <span class="custom-switch-indicator"  for="{{ $perm->id }}"></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-success btn-sm loading"
                                    type="submit">
                                    <i class="fas fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		</form>
	@endcomponent
@endsection
