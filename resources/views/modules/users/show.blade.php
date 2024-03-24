@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
	@component('componentes.card', [
		'shadow' => true,
		'title' => 'Usuario ( '.$user->name .' )',
		'breadcrumb' => 'users/show',
		'dataBreadcrumb' => ['id' => $user->id]])

        @component('componentes.table')
            @slot('thead')
                <th class="w-25">Nombre</th>
                <th class="w-25">Correo</th>
                <th class="w-25">Estado</th>
            @endslot
            @slot('tbody')
                <tr>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge badge-pill {{ ($user->status == 'Activo') ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->status }}
                        </span>
                    </td>
                </tr>
            @endslot
        @endcomponent

        @component('componentes.table')
            @slot('thead')
            @if(!(Auth()->user()->role_id == 3 || Auth()->user()->role_id == 8 || Auth()->user()->role_id == 10))
                <th class="w-50">Roles</th>
            @endif
                <th class="w-50">Usuario desde</th>
            @endslot
            @slot('tbody')
                <tr>
                    @if(!(Auth()->user()->role_id == 3 || Auth()->user()->role_id == 8 || Auth()->user()->role_id == 10))
                    <td>
                        <ul>
                            @forelse($user->getRoleNames() as $rol)
                                <li>{{ $rol }}</li>
                            @empty
                                <li>No se encontraron roles asignados.</li>
                            @endforelse
                        </ul>
                    </td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                </tr>
            @endslot
        @endcomponent

	@endcomponent
@endsection
