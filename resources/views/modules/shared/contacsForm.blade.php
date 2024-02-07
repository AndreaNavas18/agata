
<div class="data-contacts">
    <div class="row">
        <div class="col-12 mb-2 mt-3">
            <h5>
                <b class="font-weight-bold">Contacto {{ $numeroContacto }}</b>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Tipo de contacto',
                    'id' => 'type_contact_id',
                    'required' => true])
                @endcomponent
                <select class="form-control
                    selectpicker"
                    name="type_contact_id[]"
                    id="type_contact_id"
                    required>
                    <option value="">--Seleccione--</option>
                    @foreach($typesContacts as $typeContact)
                        <option value="{{ $typeContact->id }}"
                            {{ isset($contact) &&
                                $contact->type_contact_id  == $typeContact->id
                                ? 'selected' : '' }}>
                            {{ $typeContact->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Ciudad',
                    'id' => 'city_contact_id',
                    'required' => true])
                @endcomponent
                <select class="form-control
                    selectpicker"
                    name="city_contact_id[]"
                    id="city_contact_id"
                    required>
                    <option value="">--Seleccione--</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ isset($contact) &&
                                $contact->city_id  == $city->id
                                ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Nombre',
                    'id' => 'name_contact',
                    'required' => true])
                @endcomponent
            <input type="text"
                    name="name_contact[]"
                    class="form-control"
                    value="{{ isset($contact) ? $contact->name : '' }}"
                    required>
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Telefono fijo',
                    'id' => 'home_phone_contact',
                    'required' => false])
                @endcomponent
            <input type="number"
                    name="home_phone_contact[]"
                    class="form-control"
                    value="{{ isset($contact) ? $contact->home_phone : '' }}">
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Telefono movil',
                    'id' => 'cell_phone_contact',
                    'required' => true])
                @endcomponent
            <input type="number"
                    name="cell_phone_contact[]"
                    class="form-control"
                    value="{{ isset($contact) ? $contact->cell_phone : '' }}"
                    required>
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Correo Electronico',
                    'id' => 'email_contact',
                    'required' => true])
                @endcomponent
            <input type="email"
                    name="email_contact[]"
                    class="form-control"
                    value="{{ isset($contact) ? $contact->email : '' }}"
                    required>
            </div>
        </div>
    </div>
    @if(isset($contact))
        <div class="row">
            <div class="col-12">
                <a href="{{ route($route, ['id' => $contact->id]) }}"
                class="btn btn-danger btn-sm"
                data-toggle="tooltip"
                data-placement="top"
                onclick="return confirm('¿Estás seguro que deseas eliminar este registro?');"
                title="Eliminar">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </a>
            </div>
        </div>
    @endif

    @if($showButtons)
        @component('componentes.newContent')
        @endcomponent
    @endif
</div>
