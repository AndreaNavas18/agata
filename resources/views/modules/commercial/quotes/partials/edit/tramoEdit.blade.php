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
            @foreach ($quote->sections as $index => $section)
                <tr class="detail-row2" id="filaTramo{{ $index }}">
                    <td>
                        <select class="form-control selectpicker" id="service_id_{{ $index }}" name="service_id[{{ $index }}]">
                            <option value="">--Seleccione--</option>
                            @foreach ($servicios as $servicioRow)
                                <option value="{{ $servicioRow->id }}" {{ $servicioRow->id == $section->service_id ? 'selected' : '' }}>
                                    {{ $servicioRow->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="tramo[{{ $index }}]" class="form-control" value="{{ $section->tramo }}" style="width:130px">
                    </td>
                    <td>
                        <input type="text" name="trayecto[{{ $index }}]" class="form-control" id="trayecto_{{ $index }}" style="width:130px" value="{{ $section->trayecto }}">
                    </td>
                    <td>
                        <input type="number" name="hilos[{{ $index }}]" class="form-control" id="hilos_{{ $index }}" style="width:130px" value="{{ $section->hilos }}">
                    </td>
                    <td>
                        <input type="text" name="extremo_a[{{ $index }}]" class="form-control" id="extremo_a_{{ $index }}" style="width:130px" value="{{ $section->extremo_a }}">
                    </td>
                    <td>
                        <input type="text" name="extremo_b[{{ $index }}]" class="form-control" id="extremo_b_{{ $index }}" style="width:130px" value="{{ $section->extremo_b }}">
                    </td>
                    <td>
                        <input type="number" name="kms[{{ $index }}]" class="form-control" id="kms_{{ $index }}" style="width:130px" value="{{ $section->kms }}">
                    </td>
                    <td>
                        <input type="number" name="recurrente_mes[{{ $index }}]" class="form-control" id="recurrente_mes_{{ $index }}" style="width:130px" value="{{ $section->recurrente_mes }}">
                    </td>
                    <td>
                        <input type="number" name="recurrente_12[{{ $index }}]" class="form-control" id="recurrente_12_{{ $index }}" style="width:130px" value="{{ $section->recurrente_12 }}">
                    </td>
                    <td>
                        <input type="number" name="recurrente_24[{{ $index }}]" class="form-control" id="recurrente_24_{{ $index }}" style="width:130px" value="{{ $section->recurrente_24 }}">
                    </td>
                    <td>
                        <input type="number" name="recurrente_36[{{ $index }}]" class="form-control" id="recurrente_36_{{ $index }}" style="width:130px" value="{{ $section->recurrente_36 }}">
                    </td>
                    <td>
                        <input type="text" name="tiempo[{{ $index }}]" class="form-control" id="tiempo_{{ $index }}" style="width:130px" value="{{ $section->tiempo }}">
                    </td>
                    <td>
                        <input type="number" name="valor_km_usd[{{ $index }}]" class="form-control" id="valor_km_usd_{{ $index }}" style="width:130px" value="{{ $section->valor_km_usd }}">
                    </td>
                    <td>
                        <input type="number" name="valor_total_iru_usd[{{ $index }}]" class="form-control" id="valor_total_iru_usd_{{ $index }}" style="width:130px" value="{{ $section->valor_total_iru_usd }}">
                    </td>
                    <td>
                        <input type="number" name="valor_km_cop[{{ $index }}]" class="form-control" id="valor_km_cop_{{ $index }}" style="width:130px" value="{{ $section->valor_km_cop }}">
                    </td>
                    <td>
                        <input type="number" name="valor_total[{{ $index }}]" class="form-control" id="valor_total_{{ $index }}" style="width:130px" value="{{ $section->valor_total }}">
                    </td>
                    <td>
                        <textarea type="text" name="observation[{{ $index }}]" class="form-control" id="observation_{{ $index }}" style="width:250px;height:100px">
                        @if ($section->observation)
                            {{ $section->observation }}
                        @else
                        Los valores no incluyen IVA.
                        Pre viabilidad sujeta a visita en sitio.
                        En caso de requerir obra civil no se incluye.
                        Medio de entrega radio enlace.
                        No incluye servicios de colocación.
                        Tiempo de implementación 45 días calendario.
                        @endif

                        </textarea>
                    </td>
                    <td>
                        <button class="btn btn-danger eliminar-fila2" type="button">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @endslot
    @endcomponent

    <!-- Botón para agregar nueva fila -->
    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
        <div id="agregarFila2" class="btn btn-secondary" style="font-size: 20px; width: 30px; height: 30px; display: flex; align-items: center; font-weight: bold; cursor: pointer;">+</div>
    </div>
</div>

<script>
    var servicios = @json($servicios);
</script>