@extends('layouts.app')
@section('title', 'Proveedores')
@push('script')
	<script>
		$('form.frmDestroy').submit(function(e) {
			if (!confirm('¿Está seguro de que desea eliminar este registro?')) { e.preventDefault(); }
			else { openLoader(); }
		});
	</script>
@endpush
@section('content')
	@component('componentes.card',
	['shadow' => true,
	'title' => 'Proveedores',
	'breadcrumb' => 'providers'])

        <!-- Acciones -->
        @slot('header')
        <div>
            @can('providers.index')
                <a class="btn btn-primary btn-sm loading mb-2"
                    href="{{ route('providers.index') }}">
                    <i class="fas fa-sync-alt"></i> Refrescar
                </a>
                <a class="btn btn-info btn-sm mb-2"
                    data-toggle="collapse"
                    href="#buscar"
                    role="button"
                    aria-expanded="false"
                    aria-controls="buscar">
                    <i class="fas fa-search"></i> Buscar
                </a>
            @endcan

            @can('providers.create')
                <a class="btn btn-success btn-sm loading mb-2"
                    href="{{ route('providers.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>

                <a class="btn btn-info btn-sm mb-2"
                    data-toggle="collapse"
                    href="#importar"
                    role="button"
                    aria-expanded="false"
                    aria-controls="importar">
                    <i class="fas fa-light fa-file"></i> Importar
                </a>

                <a class="btn btn-orange btn-sm mb-2"
                    data-toggle="collapse"
                    href="#importarcontactos"
                    role="button"
                    aria-expanded="false"
                    aria-controls="importarcontactos">
                    <i class="fas fa-light fa-file"></i> Importar Contactos
                </a>
            @endcan
        </div>
        @endslot

        <!-- Filtros -->
        @can('providers.search')
            <div class="collapse card-border" id="buscar">
                <form
                    action="{{ route('providers.search') }}"
                    method="GET">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-3">
                            <input class="form-control mr-2"
                            type="text"
                            name="name"
                            placeholder="Nombre"
                            value="{{ (isset($data['name'])) ? $data['name'] : '' }}">
                        </div>

                        <div class="col-md-3 col-sm-12 mb-3">
                            <input class="form-control mr-2"
                            type="text"
                            name="identification"
                            placeholder="Identificación"
                            value="{{ (isset($data['Identificación'])) ? $data['Identificación'] : '' }}">
                        </div>

                        <div class="col-md-3 col-sm-12 mt-2">
                            @component('componentes.actions_filter')
                            @endcomponent
                        </div>
                    </div>
                </form>
            </div>

            <div class="collapse card-border" id="importar">
                <form method="POST" id="frmImport" action="{{ route('providers.import') }}" enctype="multipart/form-data" >
                    @csrf
                    @include('modules.providers.partials.importProviders', [
                        'provider' =>true,
                        'customer' => true,
                    ])
                </form>
            </div>

            <div class="collapse card-border" id="importarcontactos">
                <form method="POST" id="frmImport" action="{{ route('providers.import.contact') }}" enctype="multipart/form-data" >
                    @csrf
                    @include('modules.providers.partials.importContacts', [
                        'provider' =>true,
                        'customer' => true,
                    ])
                </form>
            </div>
        @endcan

        <!-- Datos -->
        @component('componentes.table')
            @slot('thead')
                <th>Nombre</th>
                <th>Identificación</th>
                <th>Ciudad</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th></th>
            @endslot
            @slot('tbody')
                @foreach($providers as $provider)
                    <tr>
                        <td>
                            <a href="{{ route('providers.show', $provider->id) }}" style="color: #2e384d" >
                            {{ $provider->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('providers.show', $provider->id) }}" style="color: #2e384d" >
                            {{ $provider->identification }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('providers.show', $provider->id) }}" style="color: #2e384d" >
                            {{ $provider->city->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('providers.show', $provider->id) }}" style="color: #2e384d" >
                            {{ $provider->phone }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('providers.show', $provider->id) }}" style="color: #2e384d" >
                                {{ $provider->address }}</td>
                            </a>
                        <td>
                            <span class="badge {{ ($provider->state_id  == 1) ? 'bg-success' : 'bg-danger' }}">
                                {{ $provider->state->name }}
                            </span>
                        </td>
                        <td>
                            @can('providers.show')
                                {{-- <a class="btn btn-info btn-sm loading mb-1"
                                    href="{{ route('providers.show', $provider->id) }}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a> --}}
                            @endcan

                            @can('providers.edit')
                                <a class="btn btn-success btn-sm loading mb-1"
                                    href="{{ route('providers.edit',[ 'providerId'=>$provider->id ]) }}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('providers.destroy')
                                <form class="d-inline frmDestroy mb-1"
                                    action="{{ route('providers.destroy', $provider->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        type="submit"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Destroy">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endslot

            @if(!isset($data))
                {{ $providers->links() }}
            @else
                {{ $providers->appends($data)->links() }}
            @endif
        @endcomponent

	@endcomponent
@endsection
