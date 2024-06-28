@component('componentes.table')
    @slot('thead')
            <th>SERVICIO</th>
            <th>TRAMO</th>
            <th>TRAYECTO</th>
            <th>HILOS</th>
            <th>EXTREMO A</th>
            <th>EXTREMO B</th>
            <th>KMS</th>
            <th>RECURRENTE MES</th>
            <th>RECURRENTE 12 MESES</th>
            <th>RECURRENTE 24 MESES</th>
            <th>RECURRENTE 36 MESES</th>
            <th>TIEMPO</th>
            <th>VALOR KM/USD</th>
            <th>VALOR TOTAL IRU/USD</th>
            <th>VALOR KM/COP</th>
            <th>VALOR TOTAL</th>
            <th>CONDICIONES</th>
            <th></th>
    @endslot
    @slot('tbody')
    <tbody id="tbody-tramos">
        <tr class="detail-row2" id="filaModelo2">
            <td>
                <select class="form-control selectpicker" id="service_id_0" name="service_id[0]" >
                    <option value="">--Seleccione--</option>
                    @foreach ($servicios as $servicioRow)
                        <option value="{{ $servicioRow->id }}">
                            {{ $servicioRow->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" name="tramo[0]" class="form-control" id="tramo_0" style="width:130px">
            </td>
            <td>
                <input type="text" name="trayecto[0]" class="form-control" id="trayecto_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="hilos[0]" class="form-control" id="hilos_0" style="width:130px">
            </td>
            <td>
                <input type="text" name="extremo_a[0]" class="form-control" id="extremo_a_0" style="width:130px">
            </td>
            <td>
                <input type="text" name="extremo_b[0]" class="form-control" id="extremo_b_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="kms[0]" class="form-control" id="kms_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_mes[0]" class="form-control" id="recurrente_mes_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_12[0]" class="form-control" id="recurrente_12_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_24[0]" class="form-control" id="recurrente_24_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_36[0]" class="form-control" id="recurrente_36_0" style="width:130px">
            </td>
            <td>
                <input type="text" name="tiempo[0]" class="form-control" id="tiempo_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_km_usd[0]" class="form-control" id="valor_km_usd_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_total_iru_usd[0]" class="form-control" id="valor_total_iru_usd_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_km_cop[0]" class="form-control" id="valor_km_cop_0" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_total[0]" class="form-control" id="valor_total_0" style="width:130px">
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
                <button class="btn btn-danger eliminar-fila2" type="button">Eliminar</button>
            </td>
        </tr>
    </tbody>
    @endslot
@endcomponent

<!-- Botón para agregar nueva fila -->
<div style="display: flex;margin-top:20px;justify-content:flex-end">
    <div id="agregarFila2" class="btn btn-secondary" style="font-size:20px;width:30px;height:30px;display:flex;align-items:center;font-weight:bold;cursor:pointer;">+</div>
</div>

<script>
    var servicios = @json($servicios);
</script>