@extends('layouts.app')
@section('title', 'Usuarios Clientes')
@section('content')
	@component('componentes.card',
	['shadow' => true,
	'title' => 'Usuarios Clientes',
	'breadcrumb' => 'services'])

        <div class="card-border">
            <div>
                <a class="btn btn-primary btn-sm loading"
                    href="">
                    <i class="fas fa-sync-alt"></i> Refrescar
                </a>
                {{-- <button class="btn btn-success btn-sm addService"
                    type="button"
                    dataUrl="{{ route('customers.services.store') }}">
                    <i class="fas fa-plus"></i> Crear
                </button> --}}
            </div>

            @include('modules.Shared.Users.usersList', [
                'users'             => $users,
                'showActions'       => true,
            ])
        </div>
    @endcomponent

    {{-- modal --}}
    @include('modules.Shared.Users.usersForm')
@endsection

