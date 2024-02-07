@extends('layouts.app')
@section('title', 'Users edit')
@section('content')

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    @component('componentes.card', [
    'shadow' => true,
    'title' => 'Editar Usuario ( '.$user->name.' )',
    'breadcrumb' => 'users/edit',
    'dataBreadcrumb' => ['id' => $user->id] ])

    <div class="row">
        <div class="col">
            @component('componentes.alerts')
            @endcomponent
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                @component('componentes.label', [
                'title' => 'Nombres',
                'id' => 'name',
                'required' => true])
                @endcomponent
                <input type="text" name="name" id="name" value="{{ old('name') ? old('name') : $user->name }}"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                @component('componentes.label', [
                'title' => 'Apellidos',
                'id' => 'last_name',
                'required' => true])
                @endcomponent
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}"
                    class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" required>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                @component('componentes.label', [
                'title' => 'Email',
                'id' => 'email',
                'required' => true])
                @endcomponent
                <input type="email" name="email" id="email" value="{{ old('email') ? old('email') : $user->email }}"
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" required>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                @component('componentes.label', [
                'title' => 'Rol',
                'id' => 'role',
                'required' => true])
                @endcomponent
                <select class="form-control selectpicker
                {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id" id="roles" required>
                    <option value="">--Seleccione--</option>
                    @foreach($roles as $rol)
                    <option value="{{ $rol->id }}" {{ old('role_id') && old('role_id') == $rol->id ? 'selected' : ($user->hasRole($rol->name) ? 'selected' : '')  }}>
                        {{ $rol->name }}
                    </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                @component('componentes.label', [
                'title' => 'Contraseña',
                'id' => 'password',
                'required' => true])
                @endcomponent
                <input type="password" name="password" id="password" value="{{ old('password') }}"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col">
            <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-save"></i>
                Guardar
            </button>
        </div>
    </div>

    @endcomponent
</form>
@endsection
