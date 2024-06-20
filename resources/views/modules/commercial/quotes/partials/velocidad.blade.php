<template id="velocidad-template" >
    <div class="velocidad-group row">
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Ancho de banda (Mbps)',
                'id' => 'bandwidth',
            ])
            @endcomponent
            <select class="form-control
            selectpicker bandwidth" name="bandwidth[]" id="bandwidth" required>
                <option value="">--Seleccione--</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Dirección | Coordenadas',
                'id' => 'address',
            ])
            @endcomponent
            <input type="text" name="address[]" class="form-control address">
        </div>

        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'NRC 12 Meses',
                'id' => 'nrc_12',
            ])
            @endcomponent
            <input type="number" name="nrc_12[]" class="form-control nrc_12 decimal">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'NRC 24 Meses',
                'id' => 'nrc_24',
            ])
            @endcomponent
            <input type="number" name="nrc_24[]" class="form-control nrc_24 decimal">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'NRC 36 Meses',
                'id' => 'nrc_36',
            ])
            @endcomponent
            <input type="number" name="nrc_36[]" class="form-control nrc_36 decimal">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'MRC 12 Meses',
                'id' => 'mrc_12',
            ])
            @endcomponent
            <input type="number" name="mrc_12[]" class="form-control mrc_12 decimal">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'MRC 24 Meses',
                'id' => 'mrc_24',
            ])
            @endcomponent
            <input type="number" name="mrc_24[]" class="form-control mrc_24 decimal">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'MRC 36 Meses',
                'id' => 'mrc_36',
            ])
            @endcomponent
            <input type="number" name="mrc_36[]" class="form-control mrc_36 decimal">
        </div>
        <button type="button" class="btn btn-danger remove-velocidad">Eliminar</button>
        <hr>
    </div>
</template>
