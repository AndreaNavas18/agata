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
<div class="row">
    @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Area PQR'])
    @endcomponent

    <div class="col-md-4 mb-3">
        <div class="form-group">
            @component('componentes.label', [
                'title' => 'Área',
                'id' => 'department_id',
                'required' => true])
            @endcomponent
            <select class="form-control
                selectpicker"
                name="department_id"
                id="department_id"
                required>
                <option value="">--Seleccione--</option>
                @foreach($departmentList as $department)
                    <option value="{{ $department->id }}"
                        {{ isset($objeto) &&
                            $objeto->department_id == $department->id
                            ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Tema',
            'id' => 'tema_id',
            'required' => true,
        ])
        @endcomponent
        <select class="form-control
            selectpicker" name="tema_id" id="tema_id" required>
            <option value="">--Seleccione--</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Personal',
            'id' => 'employee_id',
        ])
        @endcomponent
        <select class="form-control
            selectpicker" name="employee_id" id="employee_id">
            <option value="">--Seleccione--</option>
        </select>
    </div>
</div>
<div class="row">

    @component('componentes.cardTitle',[
        'shadow' => true,
        'icono'  => 'fas fa-info-circle',
        'title' => 'Indexes'])
    @endcomponent

    <div class="col-md-4 mb-3" id="show_indexes_container">
        <label for="show_indexes">¿Desea agregar algún index?</label>
        <select class="form-control selectpicker" id="show_indexes" name="show_indexes">
            <option value="">--Seleccione--</option>
            <option value="yes">Sí</option>
            <option value="no">No</option>
        </select>
    </div>
    
</div>
<div class="row" id="indexes_component" style="display: none;">
    @include('modules.pqrs.partials.indexes')
</div>

{{-- inputs ocultos --}}
<input type="hidden" id="rutaAjax" data-url-temas="{{ route('pqrs.temas.departments') }}">
<input type="hidden" id="rutaAjax" data-url-employee="{{ route('pqrs.employees.departments') }}">



<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('show_indexes').addEventListener('change', function () {
        var selectedValue = this.value;
        var indexesComponent = document.getElementById('indexes_component');
        var showIndexesContainer = document.getElementById('show_indexes_container');

        if (selectedValue === 'yes') {
            indexesComponent.style.display = 'block';
            showIndexesContainer.style.display = 'none';
        } else {
            indexesComponent.style.display = 'none';
        }
    });
});

</script>