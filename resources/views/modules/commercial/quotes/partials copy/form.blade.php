<div class="row">
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Asunto de la cotización',
            'id' => 'issue',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="issue" class="form-control" value="{{ isset($quote) ? $quote->issue : '' }}">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre',
            'id' => 'name',
            'required' => true,
        ])
        @endcomponent
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Tipo de identificación',
            'id' => 'type_document_id',
        ])
        @endcomponent
        <select class="form-control
                selectpicker" name="type_document_id" id="type_document_id">
                <option value="">--Seleccione--</option>
                @foreach ($typeDocuments as $typeDocumentRow)
                <option value="{{ $typeDocumentRow->id }}">
                    {{ $typeDocumentRow->name }}
                </option>
                @endforeach
            </select>
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Identificación',
            'id' => 'identification',
        ])
        @endcomponent
        <input type="text" name="identification" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Correo electrónico',
            'id' => 'email',
        ])
        @endcomponent
        <input type="text" name="email" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Teléfono',
            'id' => 'phone',
        ])
        @endcomponent
        <input type="text" name="phone" class="form-control">
    </div>

    <div class="col-md-12 mb-3">
        <button type="button" id="add-service" class="btn btn-primary">Añadir servicio</button>
    </div>

    <div id="services-container"></div>

    <template id="service-template">
        <div class="service-group">
            <div class="col-md-12 mb-3">
                @component('componentes.label', [
                    'title' => 'Nombre del servicio',
                    'id' => 'name_service_template',
                ])
                @endcomponent
                <select class="form-control selectpicker name_service" id="name_service_template" name="name_service[]" required>
                    <option value="">--Seleccione--</option>
                    @foreach ($servicios as $servicioRow)
                    <option value="{{ $servicioRow->id }}">
                        {{ $servicioRow->name }}
                    </option>
                    @endforeach
                </select>
            </div>
    
            <div class="col-md-12 mb-3">
                @component('componentes.label', [
                    'title' => 'Condiciones',
                    'id' => 'observation_template',
                ])
                @endcomponent
                <textarea class="form-control observation" id="observation_template" name="observation[]" rows="7">
                Los valores no incluyen IVA.
                Pre viabilidad sujeta a visita en sitio.
                En caso de requerir obra civil no se incluye.
                Medio de entrega radio enlace.
                No incluye servicios de colocación.
                Tiempo de implementación 45 días calendario.
                </textarea>
            </div>
    
            <div class="velocidades-container" id="velocidades-container-template"></div>
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-primary add-velocidad">Añadir velocidad (Mbps)</button>
            </div>
            @include('modules.commercial.quotes.partials.velocidad')
    
            <div class="tramos-container" id="tramos-container-template"></div>
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-primary add-tramo">Añadir otras opciones</button>
            </div>
    
            @include('modules.commercial.quotes.partials.tramo')
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-danger remove-service">Eliminar servicio</button>
            </div>
            
            <div class="col-md-12 mb-3">
                <button type="button" class="btn btn-secondary add-service">Añadir servicio</button>
            </div>
        </div>
    </template>


    



    {{-- Details quotes tariffs --}}
    {{-- <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Nombre del servicio',
            'id' => 'name_service',
        ])
        @endcomponent
        <select class="form-control
                selectpicker" name="name_service" id="name_service" required>
                <option value="">--Seleccione--</option>
                @foreach ($servicios as $servicioRow)
                <option value="{{ $servicioRow->id }}">
                    {{ $servicioRow->name }}
                </option>
                @endforeach
            </select>
    </div>

    <div class="col-md-12 mb-3">
        @component('componentes.label', [
            'title' => 'Condiciones',
            'id' => 'observation',
        ])
        @endcomponent
        <textarea class="form-control" name="observation" id="observation" rows="7">
        Los valores no incluyen IVA.
        Pre viabilidad sujeta a visita en sitio.
        En caso de requerir obra civil no se incluye.
        Medio de entrega radio enlace.
        No incluye servicios de colocación.
        Tiempo de implementación 45 días calendario.
        </textarea>
    </div>

    <div id="velocidades-container">
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-velocidad" class="btn btn-primary">Añadir velocidad (Mbps)</button>
    </div>

    @include('modules.commercial.quotes.partials.velocidad') --}}

    {{-- Details quotes section --}}
    {{-- <div id="tramos-container">
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-tramo" class="btn btn-primary">Añadir otras opciones</button>
    </div>

    @include('modules.commercial.quotes.partials.tramo')
         --}}
</div>
