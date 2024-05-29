<div class="row">
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
    <div class="col-md-6 mb-3">
        @component('componentes.label', [
            'title' => 'Dirección',
            'id' => 'direction',
        ])
        @endcomponent
        <input type="text" name="direction" class="form-control">
    </div>

    {{-- Details quotes tariffs --}}
    <div class="col-md-6 mb-3">
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
            'title' => 'Observaciones',
            'id' => 'observation',
        ])
        @endcomponent
        <textarea class="form-control" name="observation" id="observation" rows="7"></textarea>
    </div>

    <div id="velocidades-container">
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-velocidad" class="btn btn-primary">Añadir velocidad (Mbps)</button>
    </div>

    @include('modules.commercial.quotes.partials.velocidad')

    {{-- Details quotes section --}}
    <div id="tramos-container">
    </div>
    
    <div class="col-md-12 mb-3">
        <button type="button" id="add-tramo" class="btn btn-primary">Añadir otras opciones</button>
    </div>

    @include('modules.commercial.quotes.partials.tramo')
    


    
  
     
</div>
