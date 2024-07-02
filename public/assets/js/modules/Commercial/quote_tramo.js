document.addEventListener('DOMContentLoaded', function () {
    const agregarFilaBtn2 = document.getElementById('agregarFila2');
    $('.selectpicker').selectpicker('refresh');

    agregarFilaBtn2.addEventListener('click', function () {
        const tbody2 = document.querySelector('#tbody-tramos');
        const rowIndex2 = tbody2.querySelectorAll('tr').length;
        const newRow2 = document.createElement('tr');

        newRow2.innerHTML = `
            <td>
                <select id="service_id_${rowIndex2}" name="service_id[${rowIndex2}]" class="form-control selectpicker">
                    <option value="">--Seleccione--</option>
                     ${servicios.map(servicio => `<option value="${servicio.id}">${servicio.name}</option>`).join('')}
                </select>
            </td>
            <td>
                <input type="text" name="tramo[${rowIndex2}]" class="form-control" id="tramo_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="text" name="trayecto[${rowIndex2}]" class="form-control" id="trayecto_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="hilos[${rowIndex2}]" class="form-control" id="hilos_${rowIndex2}" style="width:130px">
            </td>
            <td>
            <input type="text" name="extremo_a[${rowIndex2}]" class="form-control" id="extremo_a_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="text" name="extremo_b[${rowIndex2}]" class="form-control" id="extremo_b_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="kms[${rowIndex2}]" class="form-control" id="kms_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_mes[${rowIndex2}]" class="form-control" id="recurrente_mes_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_12[${rowIndex2}]" class="form-control" id="recurrente_12_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_24[${rowIndex2}]" class="form-control" id="recurrente_24_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="recurrente_36[${rowIndex2}]" class="form-control" id="recurrente_36_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="text" name="tiempo[${rowIndex2}]" class="form-control" id="tiempo_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_km_usd[${rowIndex2}]" class="form-control" id="valor_km_usd_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_total_iru_usd[${rowIndex2}]" class="form-control" id="valor_total_iru_usd_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_km_cop[${rowIndex2}]" class="form-control" id="valor_km_cop_${rowIndex2}" style="width:130px">
            </td>
            <td>
                <input type="number" name="valor_total[${rowIndex2}]" class="form-control" id="valor_total_${rowIndex2}" style="width:130px">
            </td>
           
            <td>
                <textarea type="text" name="observation[${rowIndex2}]" class="form-control" id="observation_${rowIndex2}" style="width:250px;height:100px" >
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
        `;

        tbody2.appendChild(newRow2);

        $('.selectpicker').selectpicker('refresh');

        addEventListenersToRow(newRow2, rowIndex2);

        $(newRow2).find('.selectpicker').selectpicker('refresh');
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('eliminar-fila2')) {
            eliminarFila2(event.target);
        }
    });
    
    function eliminarFila2(btnEliminar2) {
        const fila2 = btnEliminar2.closest('tr');
        fila2.remove();
    }
    const firstRow2 = document.querySelector('#tbody-tramos tr');
    addEventListenersToRow(firstRow2, 0);


});
