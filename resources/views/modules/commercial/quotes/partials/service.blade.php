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

    @endslot
    @slot('tbody')
        <tr>
            <td>
                <select class="form-control selectpicker" id="service_id">
                    <option value="">--Seleccione--</option>
                    @foreach ($servicios as $servicioRow)
                        <option value="{{ $servicioRow->id }}">
                            {{ $servicioRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="department_id">
                    <option value="">--Seleccione--</option>
                    @foreach ($departamentos as $departamentoRow)
                        <option value="{{ $departamentoRow->id }}">
                            {{ $departamentoRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="city_id">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="bandwidth_id">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <input type="text" name="address[]" class="form-control" id="address" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_12[]" class="form-control" id="nrc_12" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_24[]" class="form-control" id="nrc_24" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_36[]" class="form-control" id="nrc_36" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_12[]" class="form-control" id="mrc_12" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_24[]" class="form-control" id="mrc_24" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_36[]" class="form-control" id="mrc_36" style="width:130px">
            </td>
            <td>
                <input type="text" name="observation[]" class="form-control" id="observation" style="width:250px">
            </td>
        </tr>
    @endslot
@endcomponent