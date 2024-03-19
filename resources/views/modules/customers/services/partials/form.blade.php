<div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Stratecsa ID',
                'required' => true])
            @endcomponent
            <input type="text"
                name="stratecsa_id"
                id="stratecsa_id"
                value="{{ $service->stratecsa_id ? $service->stratecsa_id : '' }}"
                class="form-control"
                required>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'OTP',
                'required' => true])
            @endcomponent
            <input type="text"
                name="otp"
                id="otp"
                value="{{ $service->otp ? $service->otp : '' }}"
                class="form-control">
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'ID Servicio Cliente',
                'required' => true])
            @endcomponent
            <input type="text"
                name="id_serviciocliente"
                id="id_serviciocliente"
                class="form-control"
                value="{{ $service->id_serviciocliente ? $service->id_serviciocliente : '' }}"
                required>
        </div>

        @if(isset($customer) && $customer)
            <div class="col-md-4 col-sm-12 mb-3">
                @component('componentes.label', [
                    'title' => 'Cliente',
                    'required' => true])
                @endcomponent
                <select class="form-control selectpicker"
                    name="customer_id"
                    id="customer_id"
                    required>
                    <option value="">--Seleccione--</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ ($customer->id == $service->customer_id) ? 'selected' : ''}}
                            >
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Nombre del servicio general',
                'required' => true])
            @endcomponent
            <select class="form-control selectpicker"
                name="service_id"
                id="service_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($servicesList as $serviceRow)
                    <option value="{{ $serviceRow->id }}"
                        {{ ($serviceRow->id == $service->service_id) ? 'selected' : ''}}
                        >
                        {{ $serviceRow->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Proyecto',
                'required' => true])
            @endcomponent
            <select class="form-control selectpicker"
                name="proyecto_id"
                id="proyecto_id">
                <option value="">--Seleccione--</option>
                @foreach($proyectos as $proyectoRow)
                    <option value="{{ $proyectoRow->id }}"
                        {{ ($proyectoRow->id == $service->proyecto_id) ? 'selected' : ''}}
                        >
                        {{ $proyectoRow->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Ciudad',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                data-width="100%"
                name="city_id"
                id="city_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ ($city->id == $service->city_id) ? 'selected' : ''}}
                        >
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Coordenadas Latitud',
                'required' => true])
            @endcomponent
            <input type="text"
                name="latitude_coordinates"
                id="latitude_coordinates"
                class="form-control"
                value="{{ $service->latitude_coordinates ? $service->latitude_coordinates : '' }}"
                required>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Coordenadas Longitud',
                'required' => true])
            @endcomponent
            <input type="text"
                name="longitude_coordinates"
                id="longitude_coordinates"
                class="form-control"
                value="{{ $service->longitude_coordinates ? $service->longitude_coordinates : '' }}"
                required>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Tipo de instalación',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="installation_type"
                id="installation_type"
                data-width="100%"
                required>
                <option value="">--Seleccione--</option>
                @foreach($typesInstalations as $keyTypeInstaltionRow => $typeInstaltionRow)
                    <option value="{{ $keyTypeInstaltionRow }}"
                    {{ ($keyTypeInstaltionRow == $service->installation_type) ? 'selected' : ''}}
                    >
                        {{ $typeInstaltionRow }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Proveedor',
                'required' => false])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="provider_id"
                id="provider_id"
                data-width="100%"
                disabled>
                <option value="">--Seleccione--</option>
                @foreach($providers as $providerRow)
                    <option value="{{ $providerRow->id }}"
                        {{ ($providerRow->id == $service->provider_id) ? 'selected' : ''}}
                        >
                        {{ $providerRow->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- @if($module=='providers') --}}
            <div class="col-md-4 col-sm-12 mb-3">
                @component('componentes.label', [
                    'title' => 'Cliente',
                    'required' => true])
                @endcomponent
                <select class="form-control
                    selectpicker"
                    name="customer_id"
                    data-width="100%"
                    id="customer_id">
                    <option value="">--Seleccione--</option>
                    @foreach($customersList as $customerRow)
                        <option value="{{ $customerRow->id }}"
                            {{ ($customerRow->id == $service->customer_id) ? 'selected' : ''}}
                            >
                            {{ $customerRow->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        {{-- @endif --}}

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'Fecha del servicio',
                'required' => true])
            @endcomponent
            <input type="text"
                class="form-control
                fecha"
                name="date_service"
                id="date_service"
                value="{{ $service->date_service ? $service->date_service : '' }}"
                required="">
        </div>

        <div class="col-12 mb-4">
            @component('componentes.label', [
                'title' => 'Descripción del servicio',
                'required' => true])
            @endcomponent
            <textarea type="text"
                name="description"
                id="description"
                class="form-control"></textarea>
        </div>
                
</div>

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-cities="{{ route('general.cities') }}">

<input type="hidden"
    id="rutaAjaxDepartments"
    value="{{ route('general.departments') }}">
