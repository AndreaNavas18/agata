<div class="row">

    <div class="col-md-3 col-sm-12  mb-4 filtro-proyecto">
        <select class="form-control
            selectpicker"
            name="proyecto_id"
            id="proyecto_filter_id">
            <option value="">--Proyecto--</option>
            @foreach($proyectos as $proyectoRow)
                <option value="{{ $proyectoRow->id }}"
                    {{ isset($data['proyecto_id']) &&
                        $data['proyecto_id'] == $proyectoRow->id
                        ? 'selected' : '' }}>
                    {{ $proyectoRow->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
    {{-- inputs ocultos--}}
    <input type="hidden"
        id="rutaAjax"
        data-url-cities="{{ route('general.cities') }}">
</div>
