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
    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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
            {{-- <option value="">--Seleccione--</option> --}}
            @foreach($prioritiesList as $priorityRow)
                <option value="{{ $priorityRow->id }}"
                    {{ isset($ticket) &&
                        $ticket->priority_id  == $priorityRow->id
                        || ($priorityRow->name == 'Alta')
                        ? 'selected' : '' }}>
                    {{ $priorityRow->name }}
                </option>
            @endforeach
        </select>
    </div>
    @elseif(in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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
                <option value="other">Otro motivo</option>
            </select>
        </div>
        <div id="otherPriorityDiv" class="col-md-6 mb-3" style="display: none">
            @component('componentes.label', [
                'title' => 'Otro motivo',
                'id' => 'other_priority',
                'required' => false])
            @endcomponent
            <input type="text" class="form-control" name="other_priority" id="other_priority">
        </div>
    @endif


    @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
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

    {{-- Proyectos del Cliente --}}

    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Proyecto',
            'id' => 'project_id',
            'required' => true])
        @endcomponent

        <select class="form-control
            selectpicker"
            name="project_id"
            id="project_id"
            required>
            <option value="">--Seleccione--</option>
            @if(isset($ticket) || in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
            <option value="Null" {{ (!isset($ticket) || $ticket->service->proyecto_id == null) ? 'selected' : '' }}>Sin proyecto</option>
            @foreach($projectsList as $projectRow)
                <option value="{{ $projectRow->id }}"
                    {{ (isset($ticket) && $ticket->service->proyecto_id == $projectRow->id) ? 'selected' : '' }}>
                        {{ $projectRow->name }}
                    </option>

                        {{-- {{ isset($ticket) &&
                            $ticket->customer_service_id == $serviceRow->id
                            ? 'selected' : '' }}>
                        {{ $serviceRow->description }} --}}
                    
                @endforeach
                
            @endif
            
        </select>

    </div>

    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Servicio',
            'id' => 'customer_service_project_id',
            'required' => true])
        @endcomponent

        <select class="form-control
            selectpicker"
            name="customer_service_id"
            id="customer_service_id"
            required>
            <option value="">--Seleccione--</option>
            {{-- CAMBIAR LA VARIABLE PORQUE TRAE TODOS LOS SERVICIOS DEL CLIENTE NO FILTRADOS POR PROYECTOS --}}
            @if(isset($ticket) || in_array(Auth()->user()->role_id, [2, 3, 7, 8]))
                @foreach($serviceList as $serviceRow)
                    <option value="{{ $serviceRow->id }}"
                        @if(isset($ticket) && $ticket->customer_service_id == $serviceRow->id)
                            selected
                        @elseif(in_array(Auth()->user()->role_id, [2, 3, 7, 8]) && isset($serviceId) && $serviceId == $serviceRow->id)
                            selected 
                        @endif>
                
                        {{ $serviceRow->name }}
                    </option>

                        {{-- {{ isset($ticket) &&
                            $ticket->customer_service_id == $serviceRow->id
                            ? 'selected' : '' }}>
                        {{ $serviceRow->description }} --}}
                    
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

    {{-- @if(Auth()->user()->role_id==2 || Auth()->user()->role_id==2 && isset($ticket)) --}}
        @if(Auth()->user()->role_id==000)
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
                        {{-- <option value="">--Seleccione--</option> --}}
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
        @endif
        <div class="col-md-12 mb-3">
            @component('componentes.label', [
                'title' => 'Ingrese el/los correo(s) para notificaciones',
                'id' => 'emails_notification',
                'required' => false])
            @endcomponent
            <input type="text"
                name="emails_notification"
                class="form-control"
                placeholder="Separados por ;"
                value="{{ isset($ticket) ? $ticket->emails_notification : '' }}">
        </div>
    {{-- @endif --}}


    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Descripción',
            'id' => 'description ',
            'required' => true])
        @endcomponent
        <textarea class="form-control"
            name="description"
            id="description"
            rows="7">{{ isset($ticket) ? $ticket->description : '' }}</textarea>
    </div>
</div>

{{-- inputs ocultos--}}
<input type="hidden"
    id="rutaAjax"
    data-url-employees="{{ route('tickets.employees.positions.departments') }}"
    {{-- data-url-services="{{ route('tickets.customers.services') }}" --}}
    data-url-projects="{{ route('customers.ruta_para_obtener_proyectos') }}"
    data-url-services-project="{{ route('tickets.customers.servicesProject') }}">
    {{-- Scripts para tener formatos en las text areas de las descripciones de los tickets --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    height: '500px',
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    {{-- Script para mostrar el input de otro motivo de solicitud --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectPriority = document.getElementById('priority_id');
            var otherPriorityDiv = document.getElementById('otherPriorityDiv');
            var otherPriorityInput = document.getElementById('other_priority');

            selectPriority.addEventListener('change', function() {
                if (this.value === 'other') {
                    otherPriorityDiv.style.display = 'block';
                    otherPriorityInput.required = true;
                } else {
                    otherPriorityDiv.style.display = 'none';
                    otherPriorityInput.required = false;
                }
            });
        });
    </script>

    

