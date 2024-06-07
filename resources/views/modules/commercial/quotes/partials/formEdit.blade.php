<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto de la cotización',
            'id' => 'issue',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="issue" class="form-control" value="{{ $quote->issue }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'id' => 'name',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="name" class="form-control" value="{{ $quote->name }}" required>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Identificación',
            'id' => 'identification',
        ])
        @endcomponent
        <input type="text" name="identification" class="form-control" value="{{ $quote->identification }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Correo electrónico',
            'id' => 'email',
        ])
        @endcomponent
        <input type="text" name="email" class="form-control" value="{{ $quote->email }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Teléfono',
            'id' => 'phone',
        ])
        @endcomponent
        <input type="text" name="phone" class="form-control" value="{{ $quote->phone }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Dirección',
            'id' => 'direction',
        ])
        @endcomponent
        <input type="text" name="direction" class="form-control" value="{{ $quote->direction }}">
    </div>

    {{-- Details quotes tariffs --}}
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre del servicio',
            'id' => 'name_service',
        ])
        @endcomponent
        <select class="form-control
            selectpicker" name="name_service" id="name_service" disabled>
            <option value="">--Seleccione--</option>
            @foreach ($servicios as $servicioRow)
            <option value="{{ $servicioRow->id }}" {{ $quote->tariffs->isNotEmpty() && $servicioRow->id == $quote->tariffs->first()->tariff->commercial_type_service_id ? 'selected' : '' }}>
                {{ $servicioRow->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Observaciones',
            'id' => 'observation',
        ])
        @endcomponent
        <textarea class="form-control" name="observation" id="observation" rows="7" value="{{ $quote->observation }}"></textarea>
    </div>

    <div id="velocidades-container">
                    {{-- @php
                        dd($bandwidths);
                    @endphp --}}
        @foreach($quote->tariffs as $tariff)
            <div class="velocidad-group row">
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Ancho de banda (Mbps)',
                        'id' => 'bandwidth',
                    ])
                    @endcomponent
                    <select class="form-control
                    selectpicker bandwidth" name="bandwidth[]">
                        <option value="">--Seleccione--</option>
                        @foreach ($bandwidths as $bandRow)
                            <option value="{{ $bandRow->id }}" {{ $tariff->tariff->bandwidth_id == $bandRow->id ? 'selected' : '' }}>
                                {{ $bandRow->name }}
                            </option>
                        @endforeach
                    </select>
                   
                </div>
        
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'NRC 12 Meses',
                        'id' => 'nrc_12',
                    ])
                    @endcomponent
                    <input type="number" name="nrc_12[]" class="form-control nrc_12 decimal" value="{{ $tariff->nrc_12 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'NRC 24 Meses',
                        'id' => 'nrc_24',
                    ])
                    @endcomponent
                    <input type="number" name="nrc_24[]" class="form-control nrc_24 decimal" value="{{ $tariff->nrc_24 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'NRC 36 Meses',
                        'id' => 'nrc_36',
                    ])
                    @endcomponent
                    <input type="number" name="nrc_36[]" class="form-control nrc_36 decimal" value="{{ $tariff->nrc_36 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'MRC 12 Meses',
                        'id' => 'mrc_12',
                    ])
                    @endcomponent
                    <input type="number" name="mrc_12[]" class="form-control mrc_12 decimal" value="{{ $tariff->mrc_12 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'MRC 24 Meses',
                        'id' => 'mrc_24',
                    ])
                    @endcomponent
                    <input type="number" name="mrc_24[]" class="form-control mrc_24 decimal" value="{{ $tariff->mrc_24 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'MRC 36 Meses',
                        'id' => 'mrc_36',
                    ])
                    @endcomponent
                    <input type="number" name="mrc_36[]" class="form-control mrc_36 decimal" value="{{ $tariff->mrc_36 }}">
                </div>
                <button type="button" class="btn btn-danger remove-velocidad">Eliminar</button>
                <hr>
            </div>
        @endforeach
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-velocidad" class="btn btn-primary">Añadir velocidad (Mbps)</button>
    </div>

    @include('modules.commercial.quotes.partials.velocidad')

    {{-- Details quotes section --}}
    <div id="tramos-container">
        @foreach($quote->sections as $section)
            <div class="tramo-group row">
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tramo',
                        'id' => 'tramo',
                    ])
                    @endcomponent
                    <input type="text" name="tramo[]" class="form-control tramo" value="{{ $section->tramo }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Trayecto',
                        'id' => 'trayecto',
                    ])
                    @endcomponent
                    <input type="text" name="trayecto[]" class="form-control trayecto" value="{{ $section->trayecto }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Número de hilos',
                        'id' => 'hilos',
                    ])
                    @endcomponent
                    <input type="number" name="hilos[]" class="form-control hilos" value="{{ $section->hilos }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Kms',
                        'id' => 'kms',
                    ])
                    @endcomponent
                    <input type="number" name="kms[]" class="form-control kms" value="{{ $section->kms }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Extremo A',
                        'id' => 'extremo_a',
                    ])
                    @endcomponent
                    <input type="text" name="extremo_a[]" class="form-control extremo_a" value="{{ $section->extremo_a }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Extremo B',
                        'id' => 'extremo_b',
                    ])
                    @endcomponent
                    <input type="text" name="extremo_b[]" class="form-control extremo_b" value="{{ $section->extremo_b }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tiempo',
                        'id' => 'tiempo',
                    ])
                    @endcomponent
                    <input type="text" name="tiempo[]" class="form-control tiempo" value="{{ $section->tiempo }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente mensual',
                        'id' => 'recurrente_mes',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_mes[]" class="form-control recurrente_mes" value="{{ $section->recurrente_mes }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 12 meses',
                        'id' => 'recurrente_12',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_12[]" class="form-control recurrente_12" value="{{ $section->recurrente_12 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 24 meses',
                        'id' => 'recurrente_24',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_24[]" class="form-control recurrente_24" value="{{ $section->recurrente_24 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 36 meses',
                        'id' => 'recurrente_36',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_36[]" class="form-control recurrente_36" value="{{ $section->recurrente_36 }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr Km/par USD',
                        'id' => 'valor_km_usd',
                    ])
                    @endcomponent
                    <input type="number" name="valor_km_usd[]" class="form-control valor_km_usd" value="{{ $section->valor_km_usd }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr total IRU USD',
                        'id' => 'valor_total_iru_usd',
                    ])
                    @endcomponent
                    <input type="number" name="valor_total_iru_usd[]" class="form-control valor_total_iru_usd" value="{{ $section->valor_total_iru_usd }}" >
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr Km/par COP',
                        'id' => 'valor_km_cop',
                    ])
                    @endcomponent
                    <input type="number" name="valor_km_cop[]" class="form-control valor_km_cop" value="{{ $section->valor_km_cop }}">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Valor total',
                        'id' => 'valor_total',
                    ])
                    @endcomponent
                    <input type="number" name="valor_total[]" class="form-control valor_total" value="{{ $section->valor_total }}">
                </div>
                <button type="button" class="btn btn-danger remove-tramo">Eliminar</button>
                <hr>
            </div>
        @endforeach
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-tramo" class="btn btn-primary">Añadir otras opciones</button>
    </div>

    @include('modules.commercial.quotes.partials.tramo')
        
</div>

{{-- <script>
    $(document).ready(function () {
        // Añadir velocidad
        $('#add-velocidad').click(function () {
            var velocidadTemplate = $('#velocidad-template').html();
            $('#velocidades-container').append(velocidadTemplate);
        });

        // Añadir tramo
        $('#add-tramo').click(function () {
            var tramoTemplate = $('#tramo-template').html();
            $('#tramos-container').append(tramoTemplate);
        });

        // Eliminar velocidad
        $(document).on('click', '.remove-velocidad', function () {
            $(this).closest('.velocidad-group').remove();
        });
    });
</script> --}}