<div class="row">
    @if (Auth()->user()->role_id!=5)
        <div class="col-md-4 mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Tipo de documento',
                    'id' => 'type_document_id',
                    'required' => true])
                @endcomponent
                <select class="form-control
                    selectpicker"
                    name="type_document_id"
                    id="type_document_id"
                    required>
                    <option value="">--Seleccione--</option>
                    @foreach($typesDocuments as $typeDocument)
                        <option value="{{ $typeDocument->id }}"
                            {{ isset($objeto) &&
                                $objeto->type_document_id == $typeDocument->id
                                ? 'selected' : '' }}>
                            {{ $typeDocument->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Identificación',
                    'id' => 'identification',
                    'required' => true])
                @endcomponent
            <input type="text"
                    name="identification"
                    class="form-control"
                    value="{{ isset($objeto) ? $objeto->identification : '' }}"
                    required>
            </div>
        </div>

        <div class="col-md-4  mb-3">
            <div class="form-group">
                @component('componentes.label', [
                    'title' => 'Nombre',
                    'id' => 'name',
                    'required' => true])
                @endcomponent
            <input type="text"
                    name="name"
                    class="form-control"
                    value="{{ isset($objeto) ? $objeto->name : '' }}"
                    required>
            </div>
        </div>
    @endif
    
    <div class="col-md-4  mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'Dirección',
                'id' => 'address',
                'required' => true])
            @endcomponent
           <input type="text"
                name="address"
                class="form-control"
                value="{{ isset($objeto) ? $objeto->address : '' }}"
                required>
        </div>
    </div>

    <div class="col-md-4  mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'Telefono',
                'id' => 'phone',
                'required' => true])
            @endcomponent
           <input type="number"
                name="phone"
                class="form-control"
                value="{{ isset($objeto) ? $objeto->phone : '' }}"
                required>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'Ciudad',
                'id' => 'city_id',
                'required' => true])
            @endcomponent
            <select class="form-select
                selectpicker"
                name="city_id"
                id="city_id"
                data-width="100%"
                required>
                <option value="">--Seleccione--</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ isset($objeto) &&
                            $objeto->city_id  == $city->id
                            ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'Observaciones',
                'id' => 'observations',
                'required' => false])
            @endcomponent
           <textarea type="text"
                name="observations"
                class="form-control">{{ isset($objeto) ? $objeto->observations : '' }}</textarea>
        </div>
    </div>
</div>
