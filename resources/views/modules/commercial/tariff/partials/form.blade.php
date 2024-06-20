<div class="container" style="margin-bottom: 20px">
    <div class="row">
    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'Tipo de Servicio',
            'id' => 'commercial_type_service_id',
            'required' => true])
        @endcomponent
        <select class="form-control
            selectpicker"
            name="commercial_type_service_id[]"
            id="commercial_type_service_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($typeServices as $typeService)
                <option value="{{ $typeService->id }}"
                    {{ isset($tariff) &&
                        $tariff->comercialTypeService->id  == $typeService->id
                        ? 'selected' : '' }}
                        >
                    {{ $typeService->name }}
                </option>
            @endforeach
        </select>
    </div>

        <div class="col-md-4 col-sm-12 mb-3">
            @component('componentes.label', [
                'title' => 'BW',
                'id' => 'bandwidth_id',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="bandwidth_id[]"
                id="bandwidth_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($bandwidths as $bandwidth)
                    <option value="{{ $bandwidth->id }}"
                        {{ isset($tariff) &&
                            $tariff->bandwidth->id  == $bandwidth->id
                            ? 'selected' : '' }}
                            >
                        {{ $bandwidth->name . ' ' . '-' . ' ' . $bandwidth->city->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="row">
    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Valor Recurrente 12M',
            'id' => 'recurring_value_12',
            'required' => true])
        @endcomponent
        <input type="number"
            name="recurring_value_12[]"
            id="recurring_value"
            class="form-control"
            value="{{ isset($tariff) ? $tariff->recurring_value_12 : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Valor Recurrente 24M',
            'id' => 'recurring_value_24',
            'required' => true])
        @endcomponent
        <input type="number"
            name="recurring_value_24[]"
            id="recurring_value"
            class="form-control"
            value="{{ isset($tariff) ? $tariff->recurring_value_24 : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Valor Recurrente 36M',
            'id' => 'recurring_value_36',
            'required' => true])
        @endcomponent
        <input type="number"
            name="recurring_value_36[]"
            id="recurring_value_36"
            class="form-control"
            value="{{ isset($tariff) ? $tariff->recurring_value_36 : '' }}"
            required>
    </div>
</div>
<div class="row">
        <div class="col-md-4 col-sm-12  mb-3">
            @component('componentes.label', [
                'title' => 'Valor Mbps 12M',
                'id' => 'value_mbps_12',
                'required' => true])
            @endcomponent
            <input type="number"
                name="value_mbps_12[]"
                id="value_mbps_12"
                class="form-control"
                value="{{ isset($tariff) ? $tariff->value_mbps_12 : '' }}"
                required>
        </div>

        <div class="col-md-4 col-sm-12  mb-3">
            @component('componentes.label', [
                'title' => 'Valor Mbps 24M',
                'id' => 'value_mbps_24',
                'required' => true])
            @endcomponent
            <input type="number"
                name="value_mbps_24[]"
                id="value_mbps_24"
                class="form-control"
                value="{{ isset($tariff) ? $tariff->value_mbps_24 : '' }}"
                required>
        </div>

        <div class="col-md-4 col-sm-12  mb-3">
            @component('componentes.label', [
                'title' => 'Valor Mbps 36M',
                'id' => 'value_mbps_36',
                'required' => true])
            @endcomponent
            <input type="number"
                name="value_mbps_36[]"
                id="value_mbps_36"
                class="form-control"
                value="{{ isset($tariff) ? $tariff->value_mbps_36 : '' }}"
                required>
        </div>

</div>
</div>


    {{-- <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Primer nombre',
            'id' => 'first_name',
            'required' => true])
        @endcomponent
        <input type="text"
            name="first_name"
            class="form-control"
            value="{{ isset($employee) ? $employee->first_name : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Segundo nombre',
            'id' => 'second_name',
            'required' => false])
        @endcomponent
        <input type="text"
            name="second_name"
            class="form-control"
            value="{{ isset($employee) ? $employee->second_name : '' }}">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Primer apellido',
            'id' => 'surname',
            'required' => true])
        @endcomponent
        <input type="text"
            name="surname"
            class="form-control"
            value="{{ isset($employee) ? $employee->surname : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Segundo apellido',
            'id' => 'second_surname',
            'required' => false])
        @endcomponent
        <input type="text"
            name="second_surname"
            class="form-control"
            value="{{ isset($employee) ? $employee->second_surname : '' }}">
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'Fecha de nacimiento',
            'required' => true])
        @endcomponent
        <input type="text"
            class="form-control
            fecha"
            name="birth_date"
            value="{{ isset($employee) ? $employee->birth_date : '' }}"
            id="birth_date">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Correo electronico',
            'id' => 'email',
            'required' => true])
        @endcomponent
        <input type="text"
            name="email"
            class="form-control"
            value="{{ isset($employee) ? $employee->email : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Telefono fijo',
            'id' => 'home_phone',
            'required' => false])
        @endcomponent
        <input type="number"
            name="home_phone"
            class="form-control"
            value="{{ isset($employee) ? $employee->home_phone : '' }}">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Telefono movil',
            'id' => 'cell_phone',
            'required' => true])
        @endcomponent
        <input type="number"
            name="cell_phone"
            class="form-control"
            value="{{ isset($employee) ? $employee->cell_phone : '' }}"
            required>
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Dirección',
            'id' => 'address',
            'required' => false])
        @endcomponent
        <input type="text"
            name="address"
            class="form-control"
            value="{{ isset($employee) ? $employee->address : '' }}">
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'Cargo',
            'id' => 'position_id',
            'required' => true])
        @endcomponent
        <select class="form-control
            selectpicker"
            name="position_id"
            id="position_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($positionsList as $positionRow)
                <option value="{{ $positionRow->id }}"
                    {{ isset($employee) &&
                        $employee->position_id   == $positionRow->id
                        ? 'selected' : '' }}>
                    {{ $positionRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'ARL',
            'id' => 'arl_id',
            'required' => true])
        @endcomponent
        <select class="form-control
            selectpicker"
            name="arl_id"
            id="arl_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($arlsList as $arlRow)
                <option value="{{ $arlRow->id }}"
                    {{ isset($employee) &&
                        $employee->arl_id   == $arlRow->id
                        ? 'selected' : '' }}>
                    {{ $arlRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'Fondo de pensiones',
            'id' => 'fund_pension_id',
            'required' => true])
        @endcomponent
        <select class="form-control
            selectpicker"
            name="fund_pension_id"
            id="fund_pension_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($pensionsList as $pensionRow)
                <option value="{{ $pensionRow->id }}"
                    {{ isset($employee) &&
                        $employee->fund_pension_id == $pensionRow->id
                        ? 'selected' : '' }}>
                    {{ $pensionRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        @component('componentes.label', [
            'title' => 'Cesantias',
            'id' => 'severance_fund_id',
            'required' => true])
        @endcomponent
        <select class="form-control
            selectpicker"
            name="severance_fund_id"
            id="severance_fund_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($severanceList as $severanceRow)
                <option value="{{ $severanceRow->id }}"
                    {{ isset($employee) &&
                        $employee->severance_fund_id == $severanceRow->id
                        ? 'selected' : '' }}>
                    {{ $severanceRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'EPS',
                'id' => 'eps_id',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="eps_id"
                id="eps_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($epsList as $epsRow)
                    <option value="{{ $epsRow->id }}"
                        {{ isset($employee) &&
                            $employee->eps_id == $epsRow->id
                            ? 'selected' : '' }}>
                        {{ $epsRow->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4><strong>Contacto de emergencia</strong></h4>
    </div>
    <hr>
    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'id' => 'name_contact_emergency',
            'required' => false])
        @endcomponent
        <input type="text"
            name="name_contact_emergency"
            class="form-control"
            value="{{ isset($employee) ? $employee->name_contact_emergency : '' }}">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Apellido',
            'id' => 'last_name_contact_emergency',
            'required' => false])
        @endcomponent
        <input type="text"
            name="last_namee_contact_emergency"
            class="form-control"
            value="{{ isset($employee) ? $employee->last_name_contact_emergency : '' }}">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Parentezco',
            'id' => 'parentesque_contact_emergency',
            'required' => false])
        @endcomponent
        <input type="text"
            name="parentesque_contact_emergency"
            class="form-control"
            value="{{ isset($employee) ? $employee->parentesque_contact_emergency : '' }}">
    </div>

    <div class="col-md-4 col-sm-12  mb-3">
        @component('componentes.label', [
            'title' => 'Telefono',
            'id' => 'phone_contact_emergency',
            'required' => false])
        @endcomponent
        <input type="text"
            name="phone_contact_emergency"
            class="form-control"
            value="{{ isset($employee) ? $employee->phone_contact_emergency : '' }}">
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4><strong>Documentos</strong></h4>
    </div>
    <hr>
    <div class="col-md-6 col-sm-12 mb-3">
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
</div> --}}

