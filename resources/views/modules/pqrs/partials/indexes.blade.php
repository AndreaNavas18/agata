@foreach($indexes as $key => $index)
    <div class="col-md-6 mb-4 inputCampoAdicional" id="{{ $key }}Input" style="display: none;">
        @component('componentes.label', [
            'title' => ucfirst($index),
            'required' => false])
        @endcomponent
        @if(in_array($key, ['tickets', 'providers', 'employees', 'customers', 'projects', 'services']))
        <select class="form-control selectCampoAdicional" id="{{ $key }}Input" name="{{ $key }}" data-width="100%">
            <option value="">--Seleccione--</option>
            @foreach($index as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @else
            {{-- Aquí puedes manejar otros tipos de campos adicionales --}}
            <input type="text" name="{{ $key }}" class="form-control">
        @endif
    </div>
@endforeach

<div class="col-12 mb-4">
    <!-- Botón para agregar campo adicional -->
    <button type="button" 
    id="agregarCampo" 
    class="btn btn-teal" 
    >
        Agregar index adicional
    </button>
</div>

<div class="col-12 mb-4" id="selectContenedor" style="display: none;">
    @component('componentes.label', [
        'title' => 'Añadir index',
        'required' => true])
    @endcomponent
    <select class="form-control
        selectpicker"
        name="indexes[]"
        data-width="100%"
        id="indexes">
        <option value="">--Seleccione--</option>
        @foreach($indexes as $key => $index)
            <option value="{{ $index }}" data-input="{{ $key }}">
                {{-- Mostrar los campos con la primer letra en mayuscula --}}
                {{ ucfirst($index) }}
            </option>
        @endforeach
    </select>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento de cambio en el select de campos disponibles
    document.getElementById("indexes").addEventListener("change", function() {
        // Obtener el valor seleccionado del select
        var selectedOption = this.options[this.selectedIndex];
        var inputId = selectedOption.getAttribute("data-input");
        // Mostrar el input correspondiente al valor seleccionado
        document.getElementById(inputId + "Input").style.display = "block";
    });

    // Escuchar el evento de clic en el botón "Agregar Campo"
    document.getElementById("agregarCampo").addEventListener("click", function() {
            // Mostrar el select de campos disponibles
            document.getElementById("selectContenedor").style.display = "block";
        });
    });
</script>