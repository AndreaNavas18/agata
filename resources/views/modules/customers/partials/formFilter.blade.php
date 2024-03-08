<div class="row">
    <div class="col-md-3 col-sm-12 mb-4">
        <input type="text"
            class="form-control
            fecha"
            name="start_date"
            id="start_date"
            placeholder="Fecha inicio inst."
            value="{{ (isset($data['start_date'])) ? $data['start_date'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-4">
        <input type="text"
            class="form-control
            fecha"
            name="final_date"
            id="final_date"
            placeholder="Fecha fin inst."
            value="{{ (isset($data['final_date'])) ? $data['final_date'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12  mb-4 filtro-proyecto">
        <select class="form-control
            selectpicker"
            name="proyecto_id"
            id="proyecto_filter_id">
            <option value="">--Proyecto--</option>
            @foreach($proyectos as $proyectoRow)
                <option value="{{ $proyectoRow->id }}"
                    {{ isset($data['proyecto_id']) &&
                        $data['proyecto_id'] == $proyectoRow->id
                        ? 'selected' : '' }}>
                    {{ $proyectoRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-4">
        <input class="form-control"
        type="text"
        name="description"
        placeholder="Descripción servicio"
        value="{{ (isset($data['description'])) ? $data['description'] : '' }}">
    </div>
    

    <div class="col-md-3 col-sm-12 mb-4">
        <select class="form-control
            selectpicker"
            name="service_id"
            id="service_id_filter">
            <option value="">--Tipo servicio--</option>
            @foreach($typesServices as $typeService)
                <option value="{{ $typeService->id }}">
                    {{ $typeService->name }}
                </option>
            @endforeach
        </select>
    </div>
    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="col-md-3 col-sm-12 mb-4">
            <select class="form-control
                selectpicker"
                name="installation_type"
                id="installation_type_filter">
                <option value="">--Tipo instalación--</option>
                @foreach($typesInstalations as $typeInstalation)
                    <option value="{{ $typeInstalation }}"
                        {{ isset($data['installation_type']) &&
                            $data['installation_type'] == $typeInstalation
                            ? 'selected' : '' }}>
                        {{ $typeInstalation }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <select class="form-control
                selectpicker"
                name="provider_id"
                id="provider_id_filter">
                <option value="">--Proveedor--</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}"
                        {{ isset($data['provider_id']) &&
                            $data['provider_id'] == $provider->id
                            ? 'selected' : '' }}>
                        {{ $provider->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="col-md-3 col-sm-12 mb-4">
            <select class="form-control
                selectpicker"
                name="customer_id"
                id="customer_id_filter">
                <option value="">--Cliente--</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ isset($data['customer_id']) &&
                            $data['customer_id'] == $customer->id
                            ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    @if (!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="col-md-3 col-sm-12 mb-4">
            <select class="form-control
                selectpicker"
                name="country_id"
                id="country_id_filter">
                <option value="">--Pais--</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 col-sm-12 mb-4">
            <select class="form-control
                selectpicker"
                name="department_id"
                id="department_id_filter">
                <option value="">--Departamento--</option>
            </select>
        </div>
    @endif
    <div class="col-md-3 col-sm-12 mb-4">
        <select class="form-control
            selectpicker"
            name="city_id"
            id="city_id_filter">
            <option value="">--Ciudad--</option>
        </select>
    </div>
    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
    {{-- inputs ocultos--}}
    <input type="hidden"
        id="rutaAjax"
        data-url-cities="{{ route('general.cities') }}">
</div>
