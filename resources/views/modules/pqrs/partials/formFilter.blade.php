
<div class="row">
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="issue"
        placeholder="Asunto"
        value="{{ (isset($data['issue'])) ? $data['issue'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="priority_id"
            id="priority_id">
            <option value="">--Tema--</option>
            {{-- @if(request('action') == 'buscar') --}}
            {{-- @else --}}
            @foreach($prioritiesAll as $priority)
                <option value="{{ $priority->id }}"
                    {{ isset($data['priority_id']) &&
                        $data['priority_id'] == $priority->id
                        ? 'selected' : '' }}>
                    {{ $priority->name }}
                </option>
            {{-- @endif --}}
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="employee_id"
            id="employee_id">
            <option value="">--Agente--</option>
            @foreach($employeesAll as $employee)
                <option value="{{ $employee->id }}"
                    {{ isset($data['employee_id']) &&
                        $data['employee_id'] == $employee->id
                        ? 'selected' : '' }}>
                    {{ $employee->short_name }}
                </option>
            @endforeach
        </select>
    </div>

    @if($provider && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="col-md-3 col-sm-12 mb-3">
            <select class="form-control
                selectpicker"
                data-width="100%"
                name="provider_id"
                id="provider_id">
                <option value="">--Proveedor--</option>
                @foreach($providersAll as $provider)
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

    @if($customer && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
        <div class="col-md-3 col-sm-12 mb-3">
            <select class="form-control
                selectpicker"
                data-width="100%"
                name="customer_id"
                id="customer_id">
                <option value="">--Cliente--</option>
                @foreach($customersAll as $customer)
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
@endif
    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="customer_service_id"
            id="customer_service_id">
            <option value="">--Servicio--</option>
            @if(!is_null($customerServices))
                @foreach($customerServices as $service)
                    <option value="{{ $service->id }}"
                        {{ isset($data['customer_service_id']) &&
                        $data['customer_service_id'] == $service->id
                        ? 'selected' : '' }}>
                        {{ 'ID '. $service->stratecsa_id . '- OTP'. $service->otp .' - '. $service->name }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="state"
            id="state">
            <option value="">--Estado--</option>
            @foreach($states as $state)
                <option value="{{ $state }}"
                    {{ isset($data['state']) &&
                        $data['state'] == $state
                        ? 'selected' : '' }}>
                    {{ $state}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
</div>
