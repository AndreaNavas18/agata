@extends('layouts.app')
@section('title', 'Permisos')
@push('css')
	<style>
		a.link-tabla { text-decoration: none; border-bottom: 2px dotted; }
	</style>
@endpush
@push('script')
	<script>
		$('form.frmDestroy').submit(function(e) {
			if (!confirm('¿Está seguro de que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
		$('.submodule').on('change', function() {
			var initials = $('option:selected', $(this)).attr('data-initials')+'_';
			$('.prefijo').text(initials);
		});
	</script>
@endpush
    @section('content')
        @component('componentes.card', [
            'shadow' => true,
            'title' => 'Permisos',
            'breadcrumb' => 'permissions'])

            <!-- Acciones -->
            @slot('header')
                @can('permissions.index')
                    <a class="btn btn-primary btn-sm loading"
                        href="{{ route('permissions.index') }}">
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
                {{-- @can('permissions.create')
                    <button class="btn btn-success btn-sm"
                        type="button"
                        data-toggle="modal"
                        data-target="#modalCreate">
                        <i class="fas fa-plus"></i> Crear
                    </button>
                @endcan --}}
            @endslot

            <!-- Filtros -->
            @can('permissions.search')
                <div class="collapse card-border" id="search">
                    <form
                        action="{{ route('permissions.search') }}"
                        method="GET">

                        <div class="row">
                            <div class="col-md-3 col-sm-12 mb-4">
                                <input class="form-control mr-2"
                                    type="text"
                                    name="name"
                                    placeholder="Permiso"
                                    value="{{ (isset($data['name'])) ? $data['name'] : '' }}">
                            </div>
                            <div class="col-md-3 col-sm-12 mb-4">
                                <select class="form-control
                                    selectpicker"
                                    name="submodule"
                                    title="Submodule">
                                    <option>--Submodulo--</option>
                                    @foreach($submodules as $submodule)
                                        <option value="{{ $submodule->id }}"
                                            {{ (isset($data['submodule']) && $data['submodule'] == $submodule->id) ? 'selected' : '' }}>
                                            {{ $submodule->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 mt-2">
                                <button class="btn btn-primary btn-sm loading" type="submit">
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
                            <th class="w-25">Nombre</th>
                            <th class="w-50">Descripción</th>
                            <th></th>
                        @endslot
                        @slot('tbody')
                            @foreach($permissions as $perm)
                                <tr>
                                    <td>
                                        @can('permissions.index')
                                            {{-- <a class="link-tabla"
                                                href="#"
                                                data-toggle="modal"
                                                data-target="#modalEdit{{ $perm->id }}">
                                                {{ $perm->name }}
                                            </a> --}}
                                            {{ $perm->name }}
                                        @endcan
                                        @cannot('permissions.index')
                                            {{ $perm->name }}
                                        @endcannot
                                    </td>
                                    <td>{{ $perm->description }}</td>
                                    <td>
                                        @can('permissions.index')
                                            <form action="{{ route('permissions.update', $perm->id) }}"
                                                method="POST"
                                                id="formUpdate{{ $perm->id }}">
                                                @csrf
                                                @method('PUT')

                                                @component('componentes.modal', [
                                                    'id' => 'modalEdit'. $perm->id,
                                                    'title' => 'Edit permiso',
                                                    'btnCancel' => true])

                                                    @slot('body')
                                                        <div class="form-group mb-3">
                                                            @component('componentes.label', [
                                                                'title' => 'Submodulo',
                                                                'id' => 'submodule',
                                                                'required' => true])
                                                            @endcomponent
                                                            <select class="form-control
                                                                selectpicker"
                                                                name="submodule"
                                                                required>
                                                                <option value="">--Seleccione--</option>
                                                                @foreach($submodules as $submodule)
                                                                    <option value="{{ $submodule->id }}"
                                                                        data-initials="{{ $submodule->initials }}"
                                                                        {{ ($perm->submodule_id == $submodule->id) ? 'selected' : '' }}>
                                                                        {{ $submodule->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            @component('componentes.label', [
                                                                'title' => 'Permit name',
                                                                'id' => 'name',
                                                                'required' => true])
                                                            @endcomponent
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text prefijo">
                                                                        {{ $perm->submodule->initials.'_' }}
                                                                    </span>
                                                                </div>
                                                                @php
                                                                    $perm->name = str_replace($perm->submodule->initials.'_', '', $perm->name);
                                                                @endphp
                                                                <input class="form-control"
                                                                    type="text"
                                                                    name="name"
                                                                    value="{{ $perm->name }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            @component('componentes.label', [
                                                                'title' => 'Descripción',
                                                                'id' => 'description',
                                                                'required' => false])
                                                            @endcomponent
                                                            <textarea class="form-control"
                                                                name="description"
                                                                rows="5">{{ $perm->description }}</textarea>
                                                        </div>
                                                    @endslot
                                                    @slot('footer')
                                                        <button class="btn btn-primary btn-sm"
                                                            type="submit">
                                                            <i class="fas fa-save"></i> Guardar
                                                        </button>
                                                    @endslot
                                                @endcomponent
                                            </form>
                                        @endcan

                                        @can('permissions.destroy')
                                            <form class="d-inline frmDestroy"
                                                action="{{ route('permissions.destroy', $perm->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    type="submit"
                                                    data-bs-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endslot

                        @if(!isset($data))
                            {{ $permissions->links() }}
                        @else
                            {{ $permissions->appends($data)->links() }}
                        @endif
                    @endcomponent
                </div>
            </div>
        @endcomponent

        <!-- Modal -->
        @can('permissions.create')
            <form action="{{ route('permissions.store') }}"
                method="POST"
                id="formStore">
                @csrf

                @component('componentes.modal', [
                    'id' => 'modalCreate',
                    'title' => 'Crear permiso',
                    'btnCancel' => true])

                    @slot('body')
                        <div class="row">
                            <div class="col-12 mb-3">
                                @component('componentes.label', [
                                    'title' => 'Submodulo',
                                    'id' => 'submodule',
                                    'required' => true])
                                @endcomponent
                                <select class="submodule
                                    form-control
                                    selectpicker"
                                    name="submodule"
                                    id="submodule"
                                    required>
                                    <option value="">--Seleccione--</option>
                                    @foreach($submodules as $submodule)
                                        <option value="{{ $submodule->id }}"
                                            data-initials="{{ $submodule->initials }}">
                                            {{ $submodule->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                @component('componentes.label', [
                                    'title' => 'Nombre',
                                    'id' => 'name',
                                    'required' => true])
                                @endcomponent
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text prefijo">...</span>
                                    </div>
                                    <input class="form-control"
                                        type="text"
                                        name="name"
                                        id="name"
                                        required>
                                </div>
                            </div>
                            <div class="col-12">
                                @component('componentes.label', [
                                    'title' => 'Descripción',
                                    'id' => 'description',
                                    'required' => false])
                                @endcomponent
                                <textarea class="form-control"
                                    name="description"
                                    id="description"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    @endslot
                    @slot('footer')
                        <button class="btn btn-primary btn-sm"
                            type="submit"><i class="fas fa-save"></i>
                            Guardar
                        </button>
                    @endslot
                @endcomponent
            </form>
        @endcan
    @endsection