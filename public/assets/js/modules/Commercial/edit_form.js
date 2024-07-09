document.addEventListener('DOMContentLoaded', function () {
    const agregarFilaBtn = document.getElementById('agregarFila'); 
    const agregarFilaBtn2 = document.getElementById('agregarFila2');

    // Función para agregar event listeners a una fila de servicio
    function addEventListenersToRow(row, index) {
        const departmentSelect = row.querySelector(`select[id^="department_id"]`);
        const citySelect = row.querySelector(`select[id^="city_id"]`);
        const serviceSelect = row.querySelector(`select[id^="commercial_type_service_id"]`);
        const bandwidthSelect = row.querySelector(`select[id^="bandwidth_id"]`);
        const nrc12Input = row.querySelector(`input[id^="nrc_12"]`);
        const nrc24Input = row.querySelector(`input[id^="nrc_24"]`);
        const nrc36Input = row.querySelector(`input[id^="nrc_36"]`);
        const mrc12Input = row.querySelector(`input[id^="mrc_12"]`);
        const mrc24Input = row.querySelector(`input[id^="mrc_24"]`);
        const mrc36Input = row.querySelector(`input[id^="mrc_36"]`);
        const observationInput = row.querySelector(`textarea[id^="observation"]`);
        const observationHiddenInput = row.querySelector(`input[name="observation_hidden[${index}]"]`);

        // Event listeners para los selects y inputs relevantes

        observationInput.addEventListener('input', () => {
            observationHiddenInput.value = observationInput.value;
        });

        departmentSelect.addEventListener('change', () => {
            fetchCities(departmentSelect, citySelect, index);
            fetchBandwidths(departmentSelect, citySelect, serviceSelect, bandwidthSelect, index);
        });

        citySelect.addEventListener('change', () => {
            fetchBandwidths(departmentSelect, citySelect, serviceSelect, bandwidthSelect, index);
        });

        serviceSelect.addEventListener('change', () => {
            fetchBandwidths(departmentSelect, citySelect, serviceSelect, bandwidthSelect, index);
        });

        bandwidthSelect.addEventListener('change', () => {
            fetchBandwidthDetails(bandwidthSelect, serviceSelect, nrc12Input, nrc24Input, nrc36Input, mrc12Input, mrc24Input, mrc36Input, observationInput);
        });
    }

    // Función para obtener ciudades según departamento seleccionado
    function fetchCities(departmentSelect, citySelect, index) {
        const departmentId = departmentSelect.value;

        citySelect.innerHTML = '<option value="">--Seleccione--</option>';

        if (departmentId) {
            fetch(`/obtener-ciudades/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                    $('.selectpicker').selectpicker('refresh');
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Función para obtener anchos de banda según departamento, ciudad y servicio seleccionados
    function fetchBandwidths(departmentSelect, citySelect, serviceSelect, bandwidthSelect, index) {
        const departmentId = departmentSelect.value;
        const cityId = citySelect.value;
        const serviceId = serviceSelect.value;

        bandwidthSelect.innerHTML = '<option value="">--Seleccione--</option>';

        if (serviceId && departmentId && cityId) {
            fetch(`/obtener-anchos-de-banda?servicio_id=${serviceId}&department_id=${departmentId}&city_id=${cityId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(bandwidth => {
                        const option = document.createElement('option');
                        option.value = bandwidth.bandwidth.id;
                        option.textContent = `${bandwidth.bandwidth.name}`;
                        bandwidthSelect.appendChild(option);
                    });
                    $('.selectpicker').selectpicker('refresh');
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Función para obtener detalles de tarifa según ancho de banda y servicio seleccionados
    function fetchBandwidthDetails(bandwidthSelect, serviceSelect, nrc12Input, nrc24Input, nrc36Input, mrc12Input, mrc24Input, mrc36Input, observationInput) {
        console.log('Función EN EDICION fetchBandwidthDetails llamada.');
        const bandwidthId = bandwidthSelect.value;
        const serviceId = serviceSelect.value;

        if (bandwidthId && serviceId) {
            $.ajax({
                url: '/obtener-detalles-tarifa',
                method: 'GET',
                dataType: 'json',
                data: {
                    bandwidth_id: bandwidthId,
                    service_id: serviceId,
                },
                success: function(data) {
                    console.log('Detalles de la tarifa recibidos EN EDICION:', data);
                    nrc12Input.value = data.recurring_value_12 || '';
                    nrc24Input.value = data.recurring_value_24 || '';
                    nrc36Input.value = data.recurring_value_36 || '';
                    mrc12Input.value = data.value_mbps_12 || '';
                    mrc24Input.value = data.value_mbps_24 || '';
                    mrc36Input.value = data.value_mbps_36 || '';
                    observationInput.value = data.observation || '';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error EN EDICION:', errorThrown);
                }
            });
        }
    }

    // Event listener para agregar nueva fila en el formulario de creación
    agregarFilaBtn.addEventListener('click', function () {
        const tbody = document.querySelector('tbody');
        const rowIndex = tbody.querySelectorAll('tr').length;
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <select id="commercial_type_service_id_${rowIndex}" name="commercial_type_service_id[${rowIndex}]" class="form-control selectpicker">
                    <option value="">--Seleccione--</option>
                    ${servicios.map(servicio => `<option value="${servicio.id}">${servicio.name}</option>`).join('')}
                </select>
            </td>
            <td>
                <select id="department_id_${rowIndex}" name="department_id[${rowIndex}]" class="form-control selectpicker">
                    <option value="">--Seleccione--</option>
                    ${departamentos.map(departamento => `<option value="${departamento.id}">${departamento.name}</option>`).join('')}
                </select>
            </td>
            <td>
                <select id="city_id_${rowIndex}" name="city_id[${rowIndex}]" class="form-control selectpicker">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <select id="bandwidth_id_${rowIndex}" name="bandwidth_id[${rowIndex}]" class="form-control selectpicker">
                    <option value="">--Seleccione--</option>
                </select>
            </td>
            <td>
                <input id="address_${rowIndex}" name="address[${rowIndex}]" type="text" class="form-control">
            </td>
            <td>
                <input id="nrc_12_${rowIndex}" name="nrc_12[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <input id="nrc_24_${rowIndex}" name="nrc_24[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <input id="nrc_36_${rowIndex}" name="nrc_36[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <input id="mrc_12_${rowIndex}" name="mrc_12[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <input id="mrc_24_${rowIndex}" name="mrc_24[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <input id="mrc_36_${rowIndex}" name="mrc_36[${rowIndex}]" type="number" class="form-control">
            </td>
            <td>
                <textarea type="text" name="observation[${rowIndex}]" class="form-control" id="observation_${rowIndex}" style="width:250px;height:100px">
                    Los valores no incluyen IVA.
                    Pre viabilidad sujeta a visita en sitio.
                    En caso de requerir obra civil no se incluye.
                    Medio de entrega radio enlace.
                    No incluye servicios de colocación.
                    Tiempo de implementación 45 días calendario.
                </textarea>
                <input type="hidden" name="observation_hidden[${rowIndex}]" id="observation_hidden_${rowIndex}">
            </td>
            <td>
                <button class="btn btn-danger eliminar-fila" type="button">Eliminar</button>
            </td>
        `;

        tbody.appendChild(newRow);

        $('#observation_hidden_' + rowIndex).val($('#observation_' + rowIndex).val());

        // Añadir event listeners a la nueva fila
        addEventListenersToRow(newRow, rowIndex);

        $('.selectpicker').selectpicker('refresh');

        // Refrescar selectpicker
        // $(newRow).find('.selectpicker').selectpicker('refresh');
    });
    

    $('.selectpicker').selectpicker('refresh');


    // Event listener para agregar nueva fila en el formulario de edición
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
                <textarea type="text" name="observation[${rowIndex2}]" class="form-control" id="observation_${rowIndex2}" style="width:250px;height:100px">
                Los valores no incluyen IVA.
                Pre viabilidad sujeta a visita en sitio.
                En caso de requerir obra civil no se incluye.
                Medio de entrega radio enlace.
                No incluye servicios de colocación.
                Tiempo de implementación 45 días calendario.
                </textarea>
                <input type="hidden" name="observation_hidden[${rowIndex2}]" id="observation_hidden_${rowIndex2}">
            </td>
            <td>
                <button class="btn btn-danger eliminar-fila2" type="button">Eliminar</button>
            </td>
        `;

        tbody2.appendChild(newRow2);

        $('#observation_hidden_' + rowIndex2).val($('#observation_' + rowIndex2).val());

        $('.selectpicker').selectpicker('refresh');
        
        addEventListenersToRow(newRow2, rowIndex2);
        
        // Refrescar selectpicker
        $(newRow2).find('.selectpicker').selectpicker('refresh');
    });

    $(document).on('click', '.eliminar-fila', function () {
        $(this).closest('tr').remove();
    });

    // Event listener para eliminar fila en el formulario de edición
    $(document).on('click', '.eliminar-fila2', function () {
        $(this).closest('tr').remove();
    });

    // Event listener para cargar selectpickers al cargar la página
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
});
