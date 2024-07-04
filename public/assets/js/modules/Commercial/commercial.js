$(document).ready(function() {
    // var fieldCounter = 0;
    // Inicializa el contador de campos adicionales
    $('#addFieldsButton').click(function() {
        // fieldCounter++;
        // Agrega el h3 antes de agregar el formulario
        var ruta = $('input#rutaAjax').attr('data-url-form');
        $.get(ruta, function (data) {

            // Crea un nuevo elemento jQuery a partir de los datos modificados
            // var newData = $(data).find('input, select').map(function () {
            //     // Verifica si el elemento tiene un ID
            //     if ($(this).attr('id')) {
            //         // Modifica el ID agregando el contador
            //         var oldId = $(this).attr('id');
            //         var newId = oldId + '_' + fieldCounter;
            //         $(this).attr('id', newId);

            //         // Agrega el atributo data
            //         $(this).data('counter', fieldCounter);
            //     }3
            //     return this; // Retorna el elemento modificado
            // });

            // Agrega el formulario al contenedor
            $('#additionalFieldsContainer').append(data);
            
            // Inicializa los selectores
            $('.selectpicker').selectpicker();
            // Agrega una linea de espacio   
            $('#additionalFieldsContainer').children('div.container').last().prepend('<hr style="margin-top: 0; margin-bottom: 15px">');
            //Titulo de Nueva Tarifa   
            $('#additionalFieldsContainer').children('div.container').last().prepend('<h4><strong>Nueva Tarifa</strong>');
            // Agrega un botón de eliminar solo si no existe uno dentro del formulario   
            $('#additionalFieldsContainer').children('div.container').last().append('<button type="button" class="btn btn-danger btn-sm removeFieldsButton"><i class="fas fa-delete"></i>Eliminar</button>');
        });
    });

    // Agrega un listener de eventos para los botones de eliminar
    $('#additionalFieldsContainer').on('click', '.removeFieldsButton', function() {
        // Encuentra el formulario asociado y lo elimínalo
        $(this).closest('div.container').remove();
    });

});


document.addEventListener('DOMContentLoaded', function () {
    const agregarFilaBtn = document.getElementById('agregarFila');

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

    function fetchCities(departmentSelect, citySelect, index) {
        const departmentId = departmentSelect.value;
        console.log('Departamento seleccionado:', departmentId);

        citySelect.innerHTML = '<option value="">--Seleccione--</option>';

        if (departmentId) {
            fetch(`/obtener-ciudades/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Ciudades recibidas:', data);
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

    function fetchBandwidths(departmentSelect, citySelect, serviceSelect, bandwidthSelect, index) {
        const departmentId = departmentSelect.value;
        const cityId = citySelect.value;
        const serviceId = serviceSelect.value;

        console.log('Departamento seleccionado:', departmentId);
        console.log('Ciudad seleccionada:', cityId);
        console.log('Servicio seleccionado:', serviceId);

        bandwidthSelect.innerHTML = '<option value="">--Seleccione--</option>';

        if (serviceId && departmentId && cityId) {
            fetch(`/obtener-anchos-de-banda?servicio_id=${serviceId}&department_id=${departmentId}&city_id=${cityId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Datos de anchos de banda recibidos:', data);
                    data.forEach(bandwidth => {
                        console.log(`ID: ${bandwidth.bandwidth.id}, Name: ${bandwidth.bandwidth.name}`);
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

    function fetchBandwidthDetails(bandwidthSelect, serviceSelect, nrc12Input, nrc24Input, nrc36Input, mrc12Input, mrc24Input, mrc36Input) {
        console.log('Función fetchBandwidthDetails llamada.');
        const bandwidthId = bandwidthSelect.value;
        const serviceId = serviceSelect.value;

        console.log('Ancho de banda seleccionado:', bandwidthId);
        console.log('Servicio seleccionado:', serviceId);

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
                    console.log('Detalles de la tarifa recibidos:', data);

                    nrc12Input.value = data.recurring_value_12 || '';
                    nrc24Input.value = data.recurring_value_24 || '';
                    nrc36Input.value = data.recurring_value_36 || '';
                    mrc12Input.value = data.value_mbps_12 || '';
                    mrc24Input.value = data.value_mbps_24 || '';
                    mrc36Input.value = data.value_mbps_36 || '';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });
        }
    }

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
                <textarea type="text" name="observation[${rowIndex}]" class="form-control" id="observation_${rowIndex}" style="width:250px;height:100px" >
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

        // Añadir event listeners a la nueva fila
        addEventListenersToRow(newRow, rowIndex);

        // Refrescar selectpicker
        $(newRow).find('.selectpicker').selectpicker('refresh');
    });

    // Inicializar los event listeners en la primera fila
    const firstRow = document.querySelector('tbody tr');
    addEventListenersToRow(firstRow, 0);

    function eliminarFila(btnEliminar) {
        const fila = btnEliminar.closest('tr');
        fila.remove();
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('eliminar-fila')) {
            eliminarFila(event.target);
        }
    });
});


