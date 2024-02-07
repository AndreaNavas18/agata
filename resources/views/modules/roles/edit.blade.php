@extends('layouts.app')
@section('title', 'Roles')
@push('css')
	<style>
		.custom-control-label { cursor: pointer; }
		.table-responsive, #containerPills { max-height: 700px; }
	</style>
@endpush
@section('content')
	@component('componentes.card', [
		'shadow' => true,
		'title' => 'Editar Rol ( '.$rol->name.' )',
		'breadcrumb' => 'roles/edit',
		'dataBreadcrumb' => ['id' => $rol->id]])

		<form action="{{ route('roles.update', $rol->id) }}"
            method="POST"
            id="formUpdate">
			@csrf
			@method('PUT')

				<div class="row">
					<div class="col-sm-12 col-md-8 col-lg-6">
						<div class="form-group mb-4">
							@component('componentes.label', [
								'title' => 'Nombre rol',
								'id' => 'name',
								'required' => true])
							@endcomponent
							<input class="form-control"
                                type="text"
                                name="name"
                                id="name"
                                value="{{ $rol->name }}"
                                required>
						</div>
					</div>
				</div>


                <div class="card-border">
                    <div class="row">
                        <div class="col-sm-12 col-lg-10">
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
                                            <div class="tab-pane fade
                                                {{ ($k == 0) ? 'show active' : '' }}"
                                                id="v-{{ $submodule->id }}">

                                                @component('componentes.table')
                                                    @slot('thead')
                                                        <th>Nombre rol</th>
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
                                                                            name="to_assign[{{ $perm->id }}]"
                                                                            id="{{ $perm->id }}"
                                                                            {{ ($rol->hasPermissionTo($perm->name)) ? 'checked' : '' }}>
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
                                    <button class="btn btn-success btn-sm"
                                        type="submit"><i class="fas fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		</form>
	@endcomponent
@endsection
