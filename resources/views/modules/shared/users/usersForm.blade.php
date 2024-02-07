
<form action=""
    method="POST"
    id="formCustomerUser">
    @csrf
    @component('componentes.modal', [
        'id' => 'modalCustomerUser',
        'title' => 'usuario',
        'size' => 'modal-lg',
        'btnCancel' => true])

        @slot('body')
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
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        @component('componentes.label', [
                            'title' => 'Apellidos',
                            'id' => 'last_name',
                            'required' => true])
                        @endcomponent
                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            value="{{ old('last_name') }}"
                            class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        @component('componentes.label', [
                            'title' => 'Email',
                            'id' => 'email',
                            'required' => true])
                        @endcomponent
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        @component('componentes.label', [
                            'title' => 'Contraseña',
                            'id' => 'password',
                            'required' => true])
                        @endcomponent
                        <input
                            type="password"
                            name="password"
                            id="password"
                            value="{{ old('password') }}"
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                    </div>
                </div>
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
