<template id="tramo-template" >
    <div class="tramo-group row">
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Tramo',
                'id' => 'tramo',
            ])
            @endcomponent
            <input type="text" name="tramo[]" class="form-control tramo">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Trayecto',
                'id' => 'trayecto',
            ])
            @endcomponent
            <input type="text" name="trayecto[]" class="form-control trayecto">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Número de hilos',
                'id' => 'hilos',
            ])
            @endcomponent
            <input type="number" name="hilos[]" class="form-control hilos">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Kms',
                'id' => 'kms',
            ])
            @endcomponent
            <input type="number" name="kms[]" class="form-control kms">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Extremo A',
                'id' => 'extremo_a',
            ])
            @endcomponent
            <input type="text" name="extremo_a[]" class="form-control extremo_a">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Extremo B',
                'id' => 'extremo_b',
            ])
            @endcomponent
            <input type="text" name="extremo_b[]" class="form-control extremo_b">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Tiempo',
                'id' => 'tiempo',
            ])
            @endcomponent
            <input type="text" name="tiempo[]" class="form-control tiempo">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Recurrente mensual',
                'id' => 'recurrente_mes',
            ])
            @endcomponent
            <input type="number" name="recurrente_mes[]" class="form-control recurrente_mes" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Recurrente 12 meses',
                'id' => 'recurrente_12',
            ])
            @endcomponent
            <input type="number" name="recurrente_12[]" class="form-control recurrente_12" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Recurrente 24 meses',
                'id' => 'recurrente_24',
            ])
            @endcomponent
            <input type="number" name="recurrente_24[]" class="form-control recurrente_24" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Recurrente 36 meses',
                'id' => 'recurrente_36',
            ])
            @endcomponent
            <input type="number" name="recurrente_36[]" class="form-control recurrente_36" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Vr Km/par USD',
                'id' => 'valor_km_usd',
            ])
            @endcomponent
            <input type="number" name="valor_km_usd[]" class="form-control valor_km_usd" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Vr total IRU USD',
                'id' => 'valor_total_iru_usd',
            ])
            @endcomponent
            <input type="number" name="valor_total_iru_usd[]" class="form-control valor_total_iru_usd" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Vr Km/par COP',
                'id' => 'valor_km_cop',
            ])
            @endcomponent
            <input type="number" name="valor_km_cop[]" class="form-control valor_km_cop" step="0.01" min="0">
        </div>
        <div class="col-md-6 mb-3">
            @component('componentes.label', [
                'title' => 'Valor total',
                'id' => 'valor_total',
            ])
            @endcomponent
            <input type="number" name="valor_total[]" class="form-control valor_total" step="0.01" min="0">
        </div>
        <button type="button" class="btn btn-danger remove-tramo">Eliminar</button>
        <hr>
    </div>
</template>
