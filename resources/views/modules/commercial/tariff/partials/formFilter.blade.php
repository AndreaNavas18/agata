@can('commercial.search')
<div class="row">
{{-- @if(!in_array(Auth()->user()->role_id, [2, 3, 7, 8])) --}}
    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="commercial_type_servicesId"
            id="commercial_type_servicesId">
            <option value="">--Tipo Servicio--</option>
            @foreach($typeServices as $typeService)
                <option value="{{ $typeService->id }}"
                    {{ isset($data['commercial_type_servicesId']) &&
                        $data['commercial_type_servicesId'] == $typeService->id
                        ? 'selected' : '' }}>
                    {{ $typeService->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <select class="form-control
            selectpicker"
            data-width="100%"
            name="bandwidth_id"
            id="bandwidth_id">
            <option value="">--Banda Ancha--</option>
            @foreach($bandwidths as $bandwidth)
                <option value="{{ $bandwidth->id }}"
                    {{ isset($data['bandwidth_id']) &&
                        $data['bandwidth_id'] == $bandwidth->id
                        ? 'selected' : '' }}>
                    {{ $bandwidth->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="number"
        name="recurring_value"
        placeholder="Valor Recurrente"
        value="{{ (isset($data['recurring_value'])) ? $data['recurring_value'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="number"
        name="months"
        placeholder="Meses"
        value="{{ (isset($data['months'])) ? $data['months'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-3">
        <input class="form-control mr-2"
        type="number"
        name="value_Mbps"
        placeholder="Valor Mbps"
        value="{{ (isset($data['value_Mbps'])) ? $data['value_Mbps'] : '' }}">
    </div>

    <div class="col-md-3 col-sm-12 mb-4 mt-2">
        @component('componentes.actions_filter')
        @endcomponent
    </div>
</div>
@endcan

