
<form action=""
    method="POST"
    id="formService"
    enctype="multipart/form-data">
    @csrf
    <div class="put d-none">
        @method('PUT')
    </div>
    @component('componentes.modal', [
        'id' => 'modalService',
        'title' => 'servicio',
        'size' => 'modal-lg',
        'btnCancel' => true])

        @slot('body')
            <div class="row">

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Stratecsa ID',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="stratecsa_id"
                        id="stratecsa_id"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'OTP',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="otp"
                        id="otp"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'ID Servicio Cliente',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="id_serviciocliente"
                        id="id_serviciocliente"
                        class="form-control"
                        required>
                </div>

                @if(isset($customer) && $customer)
                    <div class="col-md-6 mb-4">
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
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="col-md-6 mb-4">
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
                            <option value="{{ $serviceRow->id }}">
                                {{ $serviceRow->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Proyecto - Contrato - Subcliente',
                        'required' => true])
                    @endcomponent
                    <select class="form-control selectpicker"
                        name="proyecto_id"
                        id="proyecto_id">
                        <option value="">--Seleccione--</option>
                        @foreach($proyectos as $proyectoRow)
                            <option value="{{ $proyectoRow->id }}">
                                {{ $proyectoRow->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Nombre',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="nombre"
                        id="nombre"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 col-sm-12 mb-4">
                    @component('componentes.label', [
                        'title' => 'Pais',
                        'required' => true])
                    @endcomponent
                    <select class="form-control
                        selectpicker"
                        name="country_id"
                        id="country_id"
                        required>
                        <option value="">--Seleccione--</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Departamento',
                        'required' => true])
                    @endcomponent
                    <select class="form-control
                        selectpicker
                        department_id_form"
                        data-width="100%"
                        name="department_id"
                        id="department_id"
                        required>
                        <option value="">--Seleccione--</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
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
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Coordenadas Latitud',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="latitude_coordinates"
                        id="latitude_coordinates"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Coordenadas Longitud',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        name="longitude_coordinates"
                        id="longitude_coordinates"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-6 mb-4">
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
                            <option value="{{ $keyTypeInstaltionRow }}">
                                {{ $typeInstaltionRow }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
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
                            <option value="{{ $providerRow->id }}">
                                {{ $providerRow->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($module=='providers')
                    <div class="col-md-6 mb-4">
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
                                <option value="{{ $customerRow->id }}">
                                    {{ $customerRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="col-md-6 mb-4">
                    @component('componentes.label', [
                        'title' => 'Fecha del servicio',
                        'required' => true])
                    @endcomponent
                    <input type="text"
                        class="form-control
                        fecha"
                        name="date_service"
                        id="date_service"
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
                <div class="col-12 mb-4">
                    @component('componentes.label', [
                        'title' => 'Documentos',
                        'id' => 'files[]',
                        'required' => false])
                    @endcomponent
                    <input type="file"
                        class="form-control"
                        name="files[]"
                        id="files"
                        multiple>
                </div>

                {{-- <div class="col-md-6 mb-4" style="display: none">
                    @component('componentes.label', [
                        'title' => 'Ip',
                        'required' => false])
                    @endcomponent
                    <input type="text"
                        name="ip"
                        id="ip"
                        class="form-control">
                </div>
                <div class="col-md-6 mb-4" style="display: none">
                    @component('componentes.label', [
                        'title' => 'Vlan',
                        'required' => false])
                    @endcomponent
                    <input type="text"
                        name="vlan"
                        id="vlan"
                        class="form-control">
                </div>
                <div class="col-md-6 mb-4" style="display: none">
                    @component('componentes.label', [
                        'title' => 'Mascara',
                        'required' => false])
                    @endcomponent
                    <input type="text"
                        name="mascara"
                        id="mascara"
                        class="form-control">
                </div> --}}

                {{-- @foreach($camposAdicionales as $key => $campoAdicional)
                    <div class="col-md-6 mb-4 inputCampoAdicional" id="{{ $key }}Input" style="display: none;">
                        @component('componentes.label', [
                            'title' => ucfirst($campoAdicional),
                            'required' => false])
                        @endcomponent
                        @if($campoAdicional == 'ancho_de_banda')
                            <select class="form-control
                                selectpicker selectCampoAdicional"
                                name="{{ $campoAdicional }}"  
                                data-width="100%">
                                <option value="">--Seleccione--</option>
                                <option value="1">Carga</option>
                                <option value="2">Descarga</option>
                            </select>
                        @elseif($campoAdicional == 'tecnologia')
                            <select class="form-control
                                selectpicker selectCampoAdicional"
                                name="{{ $campoAdicional }}"  
                                data-width="100%">
                                <option value="">--Seleccione--</option>
                                <option value="1">Radio</option>
                                <option value="2">Fibra</option>
                                <option value="3">Satelital</option>
                            </select>
                        @else
                            <input type="text" name="{{ $campoAdicional }}" class="form-control">
                        @endif
                    </div>
                @endforeach --}}
                @foreach($camposAdicionales as $key => $campoAdicional)
                    <div class="col-md-6 mb-4 inputCampoAdicional" id="{{ $key }}Input" style="display: none;">
                        @component('componentes.label', [
                            'title' => ucfirst($campoAdicional),
                            'required' => false])
                        @endcomponent
                        @if($campoAdicional == 'ancho_de_banda')
                            <select class="form-control selectCampoAdicional" id="{{ $key }}Input" name="{{ $campoAdicional }}" data-width="100%">
                                <option value="">--Seleccione--</option>
                                <option value="1">Carga</option>
                                <option value="2">Descarga</option>
                            </select>
                        @elseif($campoAdicional == 'tecnologia')
                            <select class="form-control selectCampoAdicional" id="{{ $key }}Input" name="{{ $campoAdicional }}" data-width="100%">
                                <option value="">--Seleccione--</option>
                                <option value="1">Radio</option>
                                <option value="2">Fibra</option>
                                <option value="3">Satelital</option>
                            </select>
                        @else
                            <input type="text" name="{{ $campoAdicional }}" class="form-control">
                        @endif
                    </div>
                @endforeach

                <div class="col-12 mb-4">
                    <!-- Botón para agregar campo adicional -->
                    <button type="button" 
                    id="agregarCampo" 
                    class="btn btn-teal" 
                    >
                        Agregar configuracion adicional
                    </button>
                </div>

                <div class="col-12 mb-4" id="selectContenedor" style="display: none;">
                    @component('componentes.label', [
                        'title' => 'Añadir campo',
                        'required' => true])
                    @endcomponent
                    <select class="form-control
                        selectpicker"
                        name="camposDisponibles[]"
                        data-width="100%"
                        id="camposDisponibles">
                        <option value="">--Seleccione--</option>
                        @foreach($camposAdicionales as $key => $campoAdicional)
                            <option value="{{ $campoAdicional }}" data-input="{{ $key }}">
                                {{-- Mostrar los campos con la primer letra en mayuscula --}}
                                {{ ucfirst($campoAdicional) }}
                            </option>
                        @endforeach
                    </select>
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

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-cities="{{ route('general.cities') }}">

<input type="hidden"
    id="rutaAjaxDepartments"
    value="{{ route('general.departments') }}">


{{-- el que mejor funciona, agrega los campos sin eliminar los otros pero no tiene selects --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento de cambio en el select de campos disponibles
    document.getElementById("camposDisponibles").addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        var selectedOption = this.options[this.selectedIndex];
        var inputId = selectedOption.getAttribute("data-input");
        // Mostrar el input correspondiente al valor seleccionado
        document.getElementById(inputId + "Input").style.display = "block";
    });

    // Escuchar el evento de clic en el botón "Agregar Campo"
    document.getElementById("agregarCampo").addEventListener("click", function() {
            // Mostrar el select de campos disponibles
            document.getElementById("selectContenedor").style.display = "block";
        });
    });
</script>



