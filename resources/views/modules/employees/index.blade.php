@extends('layouts.app')
@section('title', 'Empleados')
@section('content')
	@component('componentes.card',
	['shadow' => true,
	'title' => 'Empleados',
	'breadcrumb' => 'employees'])

        <!-- Acciones -->
        @slot('header')
            @can('employees.index')
                <a class="btn btn-primary btn-sm loading mb-2"
                    href="{{ route('employees.index') }}">
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

            @can('employees.create')
                <a class="btn btn-success btn-sm loading mb-2"
                    href="{{ route('employees.create') }}">
                    <i class="fas fa-plus"></i> Crear
                </a>
            @endcan

        @endslot

        <!-- Filtros -->
        @can('employees.index')
            <div class="collapse card-border" id="buscar">
                <form
                    action="{{ route('employees.search') }}"
                    method="GET">
                    @csrf

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

                        <div class="col-md-3 col-sm-12 mb-3 mt-2">
                            @component('componentes.actions_filter')
                            @endcomponent
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
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Cargo</th>
                <th>Estado</th>
                <th></th>
            @endslot
            @slot('tbody')
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->full_name }}</td>
                        <td>{{ $employee->identification }}</td>
                        <td>{{ $employee->cell_phone }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->position->name }}</td>
                        <td>
                            <span class="badge {{ ($employee->state_id  == 1) ? 'bg-success' : 'bg-danger' }}">
                                {{ $employee->state->name }}
                            </span>
                        </td>
                        <td>
                            @can('employees.show')
                                <a class="btn btn-info btn-sm  mb-1  loading"
                                    href="{{ route('employees.show', $employee->id) }}"
                                    bs-bs-toggle="tooltip"
                                    bs-bs-placement="top"
                                    title="Ver">
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan

                            @can('employees.edit')
                                <a class="btn btn-success btn-sm  mb-1  loading"
                                    href="{{ route('employees.edit',$employee->id)
                                    }}"
                                    bs-toggle="tooltip"
                                    bs-placement="top"
                                        title="Edit and Assign Role">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan

                            @can('employees.destroy')
                                <form class="d-inline frmDestroy"
                                    action="{{ route('employees.destroy', $employee->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm mb-1"
                                        type="submit"
                                        bs-toggle="tooltip"
                                        bs-placement="top"
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
                {{ $employees->links() }}
            @else
                {{ $employees->appends($data)->links() }}
            @endif
        @endcomponent

	@endcomponent
@endsection
