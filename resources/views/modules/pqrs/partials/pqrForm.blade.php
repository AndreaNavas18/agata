<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto del PQR',
            'id' => 'issue',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="issue" class="form-control"
            value="" required>
    </div>

        {{-- <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Departamento',
                'id' => 'employee_position_department_id',
                'required' => true,
            ])
            @endcomponent
            <select class="form-control
                selectpicker" name="employee_position_department_id"
                id="employee_position_department_id" required>
                <option value="">--Seleccione--</option>
                @foreach ($positionsDepartmanets as $positionDepartmanetList)
                    <option value="{{ $positionDepartmanetList->id }}"
                        {{ isset($ticket) && $ticket->employee_position_department_id == $positionDepartmanetList->id ? 'selected' : '' }}>
                        {{ $positionDepartmanetList->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}


    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Descripción',
            'id' => 'description ',
            'required' => true,
        ])
        @endcomponent
        <textarea class="form-control" name="description" id="description" rows="7"></textarea>
    </div>
</div>

{{-- inputs ocultos --}}
<input type="hidden" id="rutaAjax" data-url-employees="{{ route('tickets.employees.positions.departments') }}"
    {{-- data-url-services="{{ route('tickets.customers.services') }}" --}}
    data-url-projects="{{ route('customers.ruta_para_obtener_proyectos') }}"
    data-url-services-project="{{ route('tickets.customers.servicesProject') }}">
