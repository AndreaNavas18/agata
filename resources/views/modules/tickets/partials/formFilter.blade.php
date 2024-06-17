@if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
<div class="row">


    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="consecutive"
        placeholder="Consecutivo"
        value="{{ (isset($data['consecutive'])) ? $data['consecutive'] : '' }}">
    </div>


    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text"
            class="form-control fecha"
            name="start_date"
            id="start_date"
            placeholder="Fecha inicio"
            value="{{ (isset($data['start_date'])) ? $data['start_date'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <input type="text"
            class="form-control fecha"
            name="final_date"
            id="final_date"
            placeholder="Fecha fin"
            value="{{ (isset($data['final_date'])) ? $data['final_date'] : '' }}">
    </div>
@endif
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="ticket_issue"
        placeholder="Asunto"
        value="{{ (isset($data['ticket_issue'])) ? $data['ticket_issue'] : '' }}">
    </div>

@if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="priority_id"
            id="priority_id">
            <option value="">--Prioridad--</option>
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

    @if($provider && !in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
    
    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="time_clock"
        placeholder="TIEMPO - HH:MM:SS"
        pattern="\d+:[0-5][0-9]:[0-5][0-9]"
        title="Formato: HH:MM:SS"
        value="{{ (isset($data['time_clock'])) ? $data['time_clock'] : '' }}">
    </div>
    
    
    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="state_clock"
            id="state_clock">
            <option value="">--Estado Tiempo--</option>
            @php
            $estados = ['Corriendo', 'Detenido',];
            @endphp
            @foreach($estados as $estado)
                <option value="{{ $estado }}"
                    {{ isset($data['state_clock']) &&
                        $data['state_clock'] == $estado
                        ? 'selected' : '' }}>
                    {{ $estado }}
                </option>
            @endforeach
        </select>
    </div>
    

    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="send_email"
            id="send_email">
            <option value="">--Email enviado--</option>
            @php
            $enviados = ['Si', 'No',];
            @endphp
            @foreach($enviados as $enviado)
                <option value="{{ $enviado }}"
                    {{ isset($data['send_email']) &&
                        $data['send_email'] == $enviado
                        ? 'selected' : '' }}>
                    {{ $enviado }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="text"
        name="email_notification"
        placeholder="Email de Notificaciones"
        value="{{ (isset($data['email_notification'])) ? $data['email_notification'] : '' }}">
    </div>


    
    @endif

    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
</div>
