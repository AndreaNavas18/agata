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
        <tr class="detail-row" data-index="0">
            <td>
                <select class="form-control selectpicker" id="service_id_0" name="service_id[]" >
                    <option value="">--Seleccione--</option>
                    @foreach ($servicios as $servicioRow)
                        <option value="{{ $servicioRow->id }}">
                            {{ $servicioRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="department_id_0" name="department_id[]">
                    <option value="">--Seleccione--</option>
                    @foreach ($departamentos as $departamentoRow)
                        <option value="{{ $departamentoRow->id }}">
                            {{ $departamentoRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="city_id_0" name="city_id[]">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="bandwidth_id_0" name="bandwidth_id[]">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <input type="text" name="address[]" class="form-control" id="address_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_12[]" class="form-control" id="nrc_12_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_24[]" class="form-control" id="nrc_24_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_36[]" class="form-control" id="nrc_36_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_12[]" class="form-control" id="mrc_12_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_24[]" class="form-control" id="mrc_24_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_36[]" class="form-control" id="mrc_36_0" style="width:130px">
            </td>
            <td>
                <textarea type="text" name="observation[]" class="form-control" id="observation_0" style="width:250px;height:100px">
                Los valores no incluyen IVA.
                Pre viabilidad sujeta a visita en sitio.
                En caso de requerir obra civil no se incluye.
                Medio de entrega radio enlace.
                No incluye servicios de colocación.
                Tiempo de implementación 45 días calendario.
                </textarea>
            </td>
        </tr>
    @endslot
@endcomponent

<!-- Botón para agregar nueva fila -->
<div style="display: flex;margin-top:20px;justify-content:flex-end">
    <button id="agregarFila" class="btn btn-secondary" style="font-size:20px;width:30px;height:30px;display:flex;align-items:center;font-weight:bold">+</button>
</div>
