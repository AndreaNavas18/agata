@extends('layouts.app')
@section('title', 'Clientes')
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
	'title' => 'Clientes',
	'breadcrumb' => 'customers'])

        <!-- Acciones -->
        @slot('header')
            @can('users_ver')
                <a class="btn btn-primary btn-sm loading"
                    href="{{ route('customers.index') }}">
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
            @endcan

            @can('users_crear')
                <a class="btn btn-success btn-sm loading"
                    href="{{ route('customers.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>
            @endcan

        @endslot

        <!-- Filtros -->
        @can('users_ver')
            <div class="collapse card-border" id="buscar">
                <form
                    action="{{ route('customers.search') }}"
                    method="GET">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 mb-4">
                            <input class="form-control"
                            type="text"
                            name="name"
                            placeholder="Nombre"
                            value="{{ (isset($data['name'])) ? $data['name'] : '' }}">
                        </div>

                        <div class="col-md-3 col-sm-12 mb-4">
                            <input class="form-control"
                            type="text"
                            name="identification"
                            placeholder="Identificación"
                            value="{{ (isset($data['Identificación'])) ? $data['Identificación'] : '' }}">
                        </div>

                        <div class="col-md-6 mb-4 mt-2">
                            <button class="btn btn-primary btn-sm loading"
                                name="action"
                                type="submit"
                                value="buscar">
                                <i class="fas fa-search"></i> Buscar
                            </button>

                            <button class="btn btn-primary btn-sm"
                                type="submit"
                                name="action"
                                value="exportar">
                                <i class="fas fa-download"></i> Exportar
                            </button>
                        </div>
                    </div>
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
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->identification }}</td>
                        <td>{{ $customer->city->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>


                        <td>
                            <span class="badge {{ ($customer->state_id  == 1) ? 'bg-success' : 'bg-danger' }}">
                                {{ $customer->state->name }}
                            </span>
                        </td>
                        <td>
                            @can('users_ver')
                                <a class="btn btn-info btn-sm mb-1 loading"
                                    href="{{ route('customers.show', $customer->id) }}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan

                            @can('users_editar')
                                <a class="btn btn-success btn-sm  mb-1 loading"
                                    href="{{ route('customers.edit',$customer->id)
                                    }}"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('users_eliminar')
                                <form class="d-inline frmDestroy"
                                    action="{{ route('customers.destroy', $customer->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm mb-1"
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
                {{ $customers->links() }}
            @else
                {{ $customers->appends($data)->links() }}
            @endif
        @endcomponent

	@endcomponent
@endsection
