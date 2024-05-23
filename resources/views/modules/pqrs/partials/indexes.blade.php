@foreach($indexKeys as $key => $label)
    <div class="col-md-6 mb-4 inputCampoAdicional" id="{{ $key }}Input" style="display: none;">
        @component('componentes.label', [
            'title' => $label,
            'required' => false
        ])
        @endcomponent
        <select class="form-control selectpicker selectCampoAdicional" id="{{ $key }}Select" name="{{ rtrim($key, 's') }}_id" data-width="100%">
            <option value="">--Seleccione--</option>
            @foreach($indexes[$key] as $item)
            @php
                switch($key) {
                    case 'tickets':
                        $displayName ='Consecutivo ' . $item->consecutive . ' - ' . ' Asunto ' . $item->ticket_issue;
                        break;
                    case 'services':
                        $displayName = 'Otp ' . $item->otp . ' - ' . 'Id Stratecsa ' . $item->stratecsa_id . ' - ' . 'Id cliente ' . $item->id_serviciocliente . ' - ' . 'Nombre ' . $item->name;
                        break;
                    case 'customers':
                        $displayName = 'Identificación ' . $item->identification . ' - ' . 'Nombre ' . $item->name;
                        break;
                    case 'providers':
                        $displayName = 'Identificación ' . $item->identification . ' - ' . 'Nombre ' . $item->name;
                        break;
                    default:
                        $displayName = $item->name ?? 'Sin nombre';
                }
            @endphp
            <option value="{{ $item->id }}">{{ $displayName }}</option>
        @endforeach
        </select>
    </div>
@endforeach

<div class="col-12 mb-4">
    <button type="button" id="agregarCampo" class="btn btn-teal">Agregar index adicional</button>
</div>

<div class="col-12 mb-4" id="selectContenedor" style="display: none;">
    @component('componentes.label', [
        'title' => 'Añadir index',
        'required' => true
    ])
    @endcomponent
    <select class="form-control selectpicker" name="indexes[]" data-width="100%" id="indexes">
        <option value="">--Seleccione--</option>
        @foreach($indexKeys as $key => $label)
            <option value="{{ $key }}" data-input="{{ $key }}">{{ $label }}</option>
        @endforeach
    </select>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("indexes").addEventListener("change", function() {
        var selectedOption = this.options[this.selectedIndex];
        var inputId = selectedOption.getAttribute("data-input");
        
        document.getElementById(inputId + "Input").style.display = "block";

        setTimeout(() => {
            this.value = "";
            $(this).selectpicker('refresh');
        }, 100);
    });
    document.getElementById("agregarCampo").addEventListener("click", function() {
        document.getElementById("selectContenedor").style.display = "block";
        document.getElementById("agregarCampo").style.display = "none";


    });
});
</script>