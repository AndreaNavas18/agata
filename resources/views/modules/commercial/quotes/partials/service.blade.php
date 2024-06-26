<div class="service-group" id="service_GROUP_INDEX">
    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre del servicio',
            'id' => 'name_service_GROUP_INDEX',
        ])
        @endcomponent
        <select class="form-control selectpicker" id="name_service_GROUP_INDEX" name="name_service[]">
            <option value="">--Seleccione--</option>
            @foreach ($servicios as $servicioRow)
                <option value="{{ $servicioRow->id }}" {{ $tariff->name_service == $servicioRow->id ? 'selected' : '' }}>
                    {{ $servicioRow->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Condiciones',
            'id' => 'observation_GROUP_INDEX',
        ])
        @endcomponent
        <textarea class="form-control" id="observation_GROUP_INDEX" name="observation[]" rows="7">
            {{ $tariff->observation }}
        </textarea>
    </div>
    {{-- @dump($tariff->bandwidth) --}}
    <div id="velocidades-container_GROUP_INDEX" class="velocidades-container">
        <div class="velocidad-group row" style="margin-left:10px">
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'Ancho de banda (Mbps)',
                    'id' => 'bandwidth',
                ])
                @endcomponent
                <select class="form-control selectpicker" name="bandwidth[]" id="bandwidth">
                    <option value="">--Seleccione--</option>
                    @foreach ($bandwidths as $bandRow)
                        <option value="{{ $bandRow->id }}" {{ $tariff->bandwidth == $bandRow->id ? 'selected' : '' }}>
                            {{ $bandRow->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'Dirección | Coordenadas',
                    'id' => 'address',
                ])
                @endcomponent
                <input type="text" name="address[]" class="form-control address" value="{{ $tariff->address }}" id="address">
            </div>
    
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'NRC 12 Meses',
                    'id' => 'nrc_12',
                ])
                @endcomponent
                <input type="number" name="nrc_12[]" class="form-control nrc_12 decimal" value="{{ $tariff->nrc_12 }}" id="nrc_12">
            </div>
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'NRC 24 Meses',
                    'id' => 'nrc_24',
                ])
                @endcomponent
                <input type="number" name="nrc_24[]" class="form-control nrc_24 decimal" value="{{ $tariff->nrc_24 }}" id="nrc_24">
            </div>
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'NRC 36 Meses',
                    'id' => 'nrc_36',
                ])
                @endcomponent
                <input type="number" name="nrc_36[]" class="form-control nrc_36 decimal" value="{{ $tariff->nrc_36 }}" id="nrc_36">
            </div>
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'MRC 12 Meses',
                    'id' => 'mrc_12',
                ])
                @endcomponent
                <input type="number" name="mrc_12[]" class="form-control mrc_12 decimal" value="{{ $tariff->mrc_12 }}" id="mrc_12">
            </div>
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'MRC 24 Meses',
                    'id' => 'mrc_24',
                ])
                @endcomponent
                <input type="number" name="mrc_24[]" class="form-control mrc_24 decimal" value="{{ $tariff->mrc_24 }}" id="mrc_24">
            </div>
            <div class="col-md-6 mb-3">
                @component('componentes.label', [
                    'title' => 'MRC 36 Meses',
                    'id' => 'mrc_36',
                ])
                @endcomponent
                <input type="number" name="mrc_36[]" class="form-control mrc_36 decimal" value="{{ $tariff->mrc_36 }}" id="mrc_36">
            </div>
            <button type="button" class="btn btn-danger remove-velocidad" style="margin-left:10px;margin-bottom:30px">Eliminar</button>
            <hr>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-primary add-velocidad" data-index="GROUP_INDEX">Añadir velocidad (Mbps)</button>
    </div>
    @include('modules.commercial.quotes.partials.velocidad')


    @if(!empty($tariff->sections) && $tariff->sections->isNotEmpty())
        <div id="tramos-container_GROUP_INDEX" class="tramos-container">
            @foreach($quote->sections as $section)
            <div class="tramo-group row" style="margin-left:10px">
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tramo',
                        'id' => 'tramo',
                    ])
                    @endcomponent
                    <input type="text" name="tramo[]" class="form-control tramo" value="{{ $section->tramo }}" id="tramo">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Trayecto',
                        'id' => 'trayecto',
                    ])
                    @endcomponent
                    <input type="text" name="trayecto[]" class="form-control trayecto" value="{{ $section->trayecto }}" id="trayecto">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Número de hilos',
                        'id' => 'hilos',
                    ])
                    @endcomponent
                    <input type="number" name="hilos[]" class="form-control hilos" value="{{ $section->hilos }}" id="hilos">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Kms',
                        'id' => 'kms',
                    ])
                    @endcomponent
                    <input type="number" name="kms[]" class="form-control kms" value="{{ $section->kms }}" id="kms">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Extremo A',
                        'id' => 'extremo_a',
                    ])
                    @endcomponent
                    <input type="text" name="extremo_a[]" class="form-control extremo_a" value="{{ $section->extremo_a }}" id="extremo_a">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Extremo B',
                        'id' => 'extremo_b',
                    ])
                    @endcomponent
                    <input type="text" name="extremo_b[]" class="form-control extremo_b" value="{{ $section->extremo_b }}" id="extremo_b">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Tiempo',
                        'id' => 'tiempo',
                    ])
                    @endcomponent
                    <input type="text" name="tiempo[]" class="form-control tiempo" value="{{ $section->tiempo }}" id="tiempo">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente mensual',
                        'id' => 'recurrente_mes',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_mes[]" class="form-control recurrente_mes" value="{{ $section->recurrente_mes }}" id="recurrente_mes">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 12 meses',
                        'id' => 'recurrente_12',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_12[]" class="form-control recurrente_12" value="{{ $section->recurrente_12 }}" id="recurrente_12">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 24 meses',
                        'id' => 'recurrente_24',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_24[]" class="form-control recurrente_24" value="{{ $section->recurrente_24 }}" id="recurrente_24">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Recurrente 36 meses',
                        'id' => 'recurrente_36',
                    ])
                    @endcomponent
                    <input type="number" name="recurrente_36[]" class="form-control recurrente_36" value="{{ $section->recurrente_36 }}" id="recurrente_36">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr Km/par USD',
                        'id' => 'valor_km_usd',
                    ])
                    @endcomponent
                    <input type="number" name="valor_km_usd[]" class="form-control valor_km_usd" value="{{ $section->valor_km_usd }}" id="valor_km_usd">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr total IRU USD',
                        'id' => 'valor_total_iru_usd',
                    ])
                    @endcomponent
                    <input type="number" name="valor_total_iru_usd[]" class="form-control valor_total_iru_usd" value="{{ $section->valor_total_iru_usd }}" id="valor_total_iru_usd" >
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Vr Km/par COP',
                        'id' => 'valor_km_cop',
                    ])
                    @endcomponent
                    <input type="number" name="valor_km_cop[]" class="form-control valor_km_cop" value="{{ $section->valor_km_cop }}" id="valor_km_cop">
                </div>
                <div class="col-md-6 mb-3">
                    @component('componentes.label', [
                        'title' => 'Valor total',
                        'id' => 'valor_total',
                    ])
                    @endcomponent
                    <input type="number" name="valor_total[]" class="form-control valor_total" value="{{ $section->valor_total }}" id="valor_total">
                </div>
                <button type="button" class="btn btn-danger remove-tramo" style="margin-left:10px;margin-bottom:30px">Eliminar</button>
                <hr>
            </div>
        @endforeach
        </div>
    @endif
    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-primary add-tramo" data-index="GROUP_INDEX">Añadir otras opciones</button>
    </div>
    @include('modules.commercial.quotes.partials.tramo')
    
    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-danger remove-service" data-index="GROUP_INDEX">Eliminar servicio</button>
    </div>

    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-secondary" id="add-service">Añadir servicio</button>
    </div>
    <hr>
</div>
