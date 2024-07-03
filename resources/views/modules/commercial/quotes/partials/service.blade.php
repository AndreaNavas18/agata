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
        <tr class="detail-row" id="filaModelo">
            <td>
                <select class="form-control selectpicker" id="commercial_type_service_id_0" name="commercial_type_service_id[0]" >
                    <option value="">--Seleccione--</option>
                    @foreach ($servicios as $servicioRow)
                        <option value="{{ $servicioRow->id }}">
                            {{ $servicioRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="department_id_0" name="department_id[0]">
                    <option value="">--Seleccione--</option>
                    @foreach ($departamentos as $departamentoRow)
                        <option value="{{ $departamentoRow->id }}">
                            {{ $departamentoRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="city_id_0" name="city_id[0]">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <select class="form-control selectpicker" id="bandwidth_id_0" name="bandwidth_id[0]">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <input type="text" name="address[0]" class="form-control" id="address_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_12[0]" class="form-control" id="nrc_12_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_24[0]" class="form-control" id="nrc_24_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="nrc_36[0]" class="form-control" id="nrc_36_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_12[0]" class="form-control" id="mrc_12_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_24[0]" class="form-control" id="mrc_24_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="mrc_36[0]" class="form-control" id="mrc_36_0" style="width:130px">
            </td>
            <td>
                <textarea type="text" name="observation[0]" class="form-control" id="observation_0" style="width:250px;height:100px">
                Los valores no incluyen IVA.
                Pre viabilidad sujeta a visita en sitio.
                En caso de requerir obra civil no se incluye.
                Medio de entrega radio enlace.
                No incluye servicios de colocación.
                Tiempo de implementación 45 días calendario.
                </textarea>
            </td>
            <td>
                <button class="btn btn-danger eliminar-fila" type="button">Eliminar</button>
            </td>
        </tr>
    @endslot
@endcomponent

<!-- Botón para agregar nueva fila -->
<div style="display: flex;margin-top:20px;justify-content:flex-end">
    <div id="agregarFila" class="btn btn-secondary" style="font-size:20px;width:30px;height:30px;display:flex;align-items:center;font-weight:bold;cursor:pointer;">+</div>
</div>

<script>
    var servicios = @json($servicios);
    var departamentos = @json($departamentos);
</script>