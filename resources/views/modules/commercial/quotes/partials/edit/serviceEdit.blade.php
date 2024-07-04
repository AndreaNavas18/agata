    @component('componentes.table')
        @slot('thead')
            <th>SERVICIO</th>
            <th>DEPARTAMENTO</th>
            <th>CIUDAD</th>
            <th>BW</th>
            <th>DIRECCIÓN|COORDENADAS</th>
            <th>NRC 12 MESES</th>
            <th>NRC 24 MESES</th>
            <th>NRC 36 MESES</th>
            <th>MRC 12 MESES</th>
            <th>MRC 24 MESES</th>
            <th>MRC 36 MESES</th>
            <th>CONDICIONES</th>
            <th></th>
        @endslot
        @slot('tbody')
            @foreach ($quote->tariffs as $index => $tariff)
                <tr class="detail-row" id="filaTarifa{{ $index }}">
                    <td>
                        <select class="form-control selectpicker" id="commercial_type_service_id_{{ $index }}" name="commercial_type_service_id[{{ $index }}]">
                            <option value="">--Seleccione--</option>
                            @foreach ($servicios as $servicioRow)
                                <option value="{{ $servicioRow->id }}" {{ $servicioRow->id == $tariff->commercial_type_service_id ? 'selected' : '' }}>
                                    {{ $servicioRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control selectpicker" id="department_id_{{ $index }}" name="department_id[{{ $index }}]">
                            <option value="">--Seleccione--</option>
                            @foreach ($departamentos as $departamentoRow)
                                <option value="{{ $departamentoRow->id }}" {{ $departamentoRow->id == optional($tariff->bandwidth)->department_id ? 'selected' : '' }}>
                                    {{ $departamentoRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control selectpicker" id="city_id_{{ $index }}" name="city_id[{{ $index }}]">
                            <option value="">--Seleccione--</option>
                            @foreach ($cities as $cityRow)
                                <option value="{{ $cityRow->id }}" {{ $cityRow->id == optional($tariff->bandwidth)->city_id ? 'selected' : '' }}>
                                    {{ $cityRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control selectpicker" id="bandwidth_id_{{ $index }}" name="bandwidth_id[{{ $index }}]">
                            <option value="">--Seleccione--</option>
                            @foreach ($bandwidths as $bandwidthRow)
                                <option value="{{ $bandwidthRow->id }}" {{ $bandwidthRow->id == $tariff->bandwidth_id ? 'selected' : '' }}>
                                    {{ $bandwidthRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    {{-- {{ dd($tariff->details) }} --}}
                    <td>
                        <input type="text" name="address[{{ $index }}]" class="form-control" value="{{ optional($tariff->details)->address }}">
                    </td>
                    <td>
                        <input type="number" name="nrc_12[{{ $index }}]" class="form-control" id="nrc_12_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->nrc_12 }}">
                    </td>
                    <td>
                        <input type="number" name="nrc_24[{{ $index }}]" class="form-control" id="nrc_24_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->nrc_24 }}">
                    </td>
                    <td>
                        <input type="number" name="nrc_36[{{ $index }}]" class="form-control" id="nrc_36_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->nrc_36 }}">
                    </td>
                    <td>
                        <input type="number" name="mrc_12[{{ $index }}]" class="form-control" id="mrc_12_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->mrc_12 }}">
                    </td>
                    <td>
                        <input type="number" name="mrc_24[{{ $index }}]" class="form-control" id="mrc_24_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->mrc_24 }}">
                    </td>
                    <td>
                        <input type="number" name="mrc_36[{{ $index }}]" class="form-control" id="mrc_36_{{ $index }}" style="width:130px" value="{{ optional($tariff->details)->mrc_36 }}">
                    </td>
                    <td>
                        <textarea type="text" name="observation[{{ $index }}]" class="form-control" id="observation_{{ $index }}" style="width:250px;height:100px">
                            {{ optional($tariff->details)->observation }}
                        </textarea>
                    </td>

                    <td>
                        <button class="btn btn-danger eliminar-fila" type="button">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

    <!-- Botón para agregar nueva fila -->
    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
        <div id="agregarFila" class="btn btn-secondary" style="font-size: 20px; width: 30px; height: 30px; display: flex; align-items: center; font-weight: bold; cursor: pointer;">+</div>
    </div>