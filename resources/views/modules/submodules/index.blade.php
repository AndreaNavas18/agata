@extends('layouts.app')
@section('title', 'Submodulos')
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
	</script>
@endpush
@section('content')
	@component('componentes.card', [
		'shadow' => true,
		'title' => 'Submodulos',
		'breadcrumb' => 'submodules'])

        <!-- Acciones -->
        @slot('header')
            @can('submodules.index')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('submodules.index') }}">
                    <i class="fas fa-sync-alt"></i>
                    Refrescar
                </a>
                <a class="btn btn-info btn-sm"
                    data-toggle="collapse"
                    href="#search"
                    role="button"
                    aria-expanded="false"
                    aria-controls="search">
                    <i class="fas fa-search"></i>
                    Buscar
                </a>
            @endcan
            @can('submodules.create')
                <button class="btn btn-success
                    btn-sm"
                    type="button"
                    data-toggle="modal"
                    data-target="#modalCreate">
                    <i class="fas fa-plus"></i> Crear
                </button>
            @endcan
        @endslot

        <!-- Filtros -->
        @can('submodules.search')
            <div class="collapse card-border" id="search">
                <form
                    action="{{ route('submodules.search') }}"
                    method="GET"
                    id="formSearch">
                    @csrf

                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-4">
                            <input class="form-control mr-2"
                                type="text"
                                name="name"
                                placeholder="Submódulo"
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
            <div class="col-sm-12 col-md-8 col-lg-6">
                @component('componentes.table')
                    @slot('thead')
                        <th>Nombre</th>
                        <th>Inicial</th>
                        <th></th>
                    @endslot
                    @slot('tbody')
                        @foreach($submodules as $submodule)
                            <tr>
                                <td>
                                    @can('submodules.edit')
                                        <a class="link-tabla" href="#"
                                            data-toggle="modal"
                                            data-target="#modalEdit{{ $submodule->id }}">
                                            {{ $submodule->name }}
                                        </a>
                                    @endcan
                                    @cannot('submodules.edit')
                                        {{ $submodule->name }}
                                    @endcannot
                                </td>
                                <td>{{ $submodule->initials }}</td>
                                <td>
                                    <form action="{{ route('submodules.update', $submodule->id) }}"
                                        method="POST"
                                        id="formUpdate{{ $submodule->id }}">
                                        @csrf
                                        @method('PUT')

                                        @component('componentes.modal', [
                                            'id' => 'modalEdit'. $submodule->id,
                                            'title' => 'Editar Submodulo',
                                            'btnCancel' => true])

                                            @slot('body')
                                                <div class="form-group mb-3">
                                                    @component('componentes.label', [
                                                        'title' => 'Nombre submodulo',
                                                        'id' => 'name',
                                                        'required' => true])
                                                    @endcomponent
                                                    <input class="form-control"
                                                        type="text"
                                                        name="name"
                                                        value="{{ $submodule->name }}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    @component('componentes.label', [
                                                        'title' => 'Inicial',
                                                        'id' => 'inicial',
                                                        'required' => true])
                                                    @endcomponent
                                                    <input class="form-control"
                                                        type="text"
                                                        value="{{ $submodule->initials }}"
                                                        disabled>
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

                                    @can('submodules.destroy')
                                        <form class="d-inline frmDestroy"
                                            action="{{ route('submodules.destroy', $submodule->id) }}"
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
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endslot

                    @if(!isset($data))
                        {{ $submodules->links() }}
                    @else
                        {{ $submodules->appends($data)->links() }}
                    @endif
                @endcomponent
            </div>
        </div>
	@endcomponent

	<!-- Modal -->
	@can('submodules.create')
		<form action="{{ route('submodules.store') }}"
            method="POST"
            id="formStore">
			@csrf

			@component('componentes.modal', [
				'id' => 'modalCreate',
				'title' => 'Crear Submodulo',
				'btnCancel' => true])

				@slot('body')
	        		<div class="form-group mb-3">
						@component('componentes.label', [
							'title' => 'Nombre submodulo',
							'id' => 'name',
							'required' => true])
						@endcomponent
        				<input class="form-control"
                            type="text"
                            name="name"
                            id="name"
                            required>
	        		</div>
	        		<div class="form-group">
                        @component('componentes.label', [
							'title' => 'Inicial',
							'id' => 'name',
							'required' => true])
						@endcomponent
	        			<input class="form-control"
                            type="text"
                            name="initials"
                            id="initials"
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
