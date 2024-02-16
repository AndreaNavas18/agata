<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto del ticket',
            'id' => 'ticket_issue',
            'required' => true])
        @endcomponent
        <input type="text"
            name="ticket_issue"
            class="form-control"
            value="{{ isset($ticket) ? $ticket->ticket_issue : '' }}"
            required>
    </div>
    @if(Auth()->user()->role_id!=2)
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Prioridad',
            'id' => 'priority_id ',
            'required' => true])
        @endcomponent
        <select class="form-control"
            name="priority_id"
            id="priority_id"
            required>
            <option value="">--Seleccione--</option>
            @foreach($prioritiesList as $priorityRow)
                <option value="{{ $priorityRow->id }}"
                    {{ isset($ticket) &&
                        $ticket->priority_id  == $priorityRow->id
                        ? 'selected' : '' }}>
                    {{ $priorityRow->name }}
                </option>
            @endforeach
        </select>
    </div>
    @elseif(Auth()->user()->role_id==2)
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Motivo de solicitud',
                'id' => 'priority_id ',
                'required' => true])
            @endcomponent
            <select class="form-control"
                name="priority_id"
                id="priority_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($prioritiesList as $priorityRow)
                    <option value="{{ $priorityRow->id }}"
                        {{ isset($ticket) &&
                            $ticket->priority_id  == $priorityRow->id
                            ? 'selected' : '' }}>
                        {{ $priorityRow->name }}
                    </option>
                @endforeach
            </select>
        </div>
        

    @endif


    @if(Auth()->user()->role_id!=2)
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Departamento',
                'id' => 'employee_position_department_id',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="employee_position_department_id"
                id="employee_position_department_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($positionsDepartmanets as $positionDepartmanetList)
                    <option value="{{ $positionDepartmanetList->id }}"
                        {{ isset($ticket) &&
                            $ticket->employee_position_department_id == $positionDepartmanetList->id
                            ? 'selected' : '' }}>
                        {{ $positionDepartmanetList->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Agente',
                'id' => 'employee_id ',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="employee_id"
                id="employee_id"
                required>
                <option value="">--Seleccione--</option>
                @isset($ticket)
                    @foreach($employeesList as $employeeRow)
                        <option value="{{ $employeeRow->id }}"
                            {{ isset($ticket) &&
                                $ticket->employee_id == $employeeRow->id
                                ? 'selected' : '' }}>
                            {{ $employeeRow->full_name }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Cliente',
                'id' => 'customer_id ',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="customer_id"
                id="customer_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($customersList as $customerRow)
                    <option value="{{ $customerRow->id }}"
                        {{ isset($ticket) &&
                            $ticket->customer_id == $customerRow->id
                            ? 'selected' : ( request()->query('customerId') &&
                            request()->query('customerId') ==  $customerRow->id ? 'selected' : '')    }}>
                        {{ $customerRow->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Servicio',
            'id' => 'customer_service_id',
            'required' => true])
        @endcomponent

        <select class="form-control
            selectpicker"
            name="customer_service_id"
            id="customer_service_id"
            required>
            <option value="">--Seleccione--</option>
            @if(isset($ticket) || Auth()->user()->role_id==2)
                @foreach($serviceList as $serviceRow)
                    <option value="{{ $serviceRow->id }}"
                        {{ isset($ticket) &&
                            $ticket->customer_service_id == $serviceRow->id
                            ? 'selected' : '' }}>
                        {{ $serviceRow->description }}
                    </option>
                @endforeach
            @endif
            
        </select>

        
    </div>

    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Fecha',
            'required' => true])
        @endcomponent
        <input type="text"
            class="form-control
            fecha"
            name="date"
            id="date"
            value="{{ $date }}"
            required="">
    </div>

    @if(Auth()->user()->role_id!=2 || Auth()->user()->role_id!=2 && isset($ticket))
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Enviar email ?',
                'id' => 'send_email',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="send_email"
                id="send_email"
                required>
                <option value="">--Seleccione--</option>
                <option value="Si"
                    {{ isset($ticket) &&
                        $ticket->send_email == 'Si'
                        ? 'selected' : '' }}>
                    Si
                </option>
                <option value="No"
                    {{ isset($ticket) &&
                        $ticket->send_email == 'No'
                        ? 'selected' : '' }}>
                    No
                </option>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            @component('componentes.label', [
                'title' => 'Correos separados con ;',
                'id' => 'emails_notification',
                'required' => false])
            @endcomponent
            <input type="text"
                name="emails_notification"
                class="form-control"
                value="{{ isset($ticket) ? $ticket->emails_notification : '' }}">
        </div>
    @endif


    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Descripción',
            'id' => 'description ',
            'required' => true])
        @endcomponent
        <textarea class="form-control"
            name="description"
            id="description"
            rows="5">{{ isset($ticket) ? $ticket->description : '' }}</textarea>
    </div>
</div>

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-employees="{{ route('tickets.employees.positions.departments') }}"
    data-url-services="{{ route('tickets.customers.services') }}">

