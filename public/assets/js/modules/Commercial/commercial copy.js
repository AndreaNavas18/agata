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
    const departmentSelects = document.querySelectorAll('select[id^="department_id"]');
    const citySelects = document.querySelectorAll('select[id^="city_id"]');
    const serviceSelects = document.querySelectorAll('select[id^="service_id"]');
    const bandwidthSelects = document.querySelectorAll('select[id^="bandwidth_id"]');
    const agregarFilaBtn = document.getElementById('agregarFila');

    function addEventListenersToRow(row, index) {
        const departmentSelect = row.querySelector(`select[id^="department_id"]`);
        const citySelect = row.querySelector(`select[id^="city_id"]`);
        const serviceSelect = row.querySelector(`select[id^="service_id"]`);
        const bandwidthSelect = row.querySelector(`select[id^="bandwidth_id"]`);
        const nrc12Input = row.querySelector(`input[id^="nrc_12"]`);
        const nrc24Input = row.querySelector(`input[id^="nrc_24"]`);
        const nrc36Input = row.querySelector(`input[id^="nrc_36"]`);
        const mrc12Input = row.querySelector(`input[id^="mrc_12"]`);
        const mrc24Input = row.querySelector(`input[id^="mrc_24"]`);
        const mrc36Input = row.querySelector(`input[id^="mrc_36"]`);

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
            fetchBandwidthDetails(bandwidthSelect, serviceSelect, nrc12Input, nrc24Input, nrc36Input, mrc12Input, mrc24Input, mrc36Input);
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
        const lastRow = tbody.querySelector('tr:last-child');
        const newRow = lastRow.cloneNode(true);

        const rowIndex = tbody.querySelectorAll('tr').length;

        newRow.querySelectorAll('select, input, textarea').forEach((element) => {
            const name = element.getAttribute('name');
            if (name) {
                element.setAttribute('name', name.replace(/\[\d+\]/, `[${rowIndex}]`));
            }
            const id = element.getAttribute('id');
            if (id) {
                element.setAttribute('id', id.replace(/_\d+$/, `_${rowIndex}`));
            }
            element.value = ''; // Clear the value
        });

        tbody.appendChild(newRow);

        addEventListenersToRow(newRow, rowIndex);

        $('.selectpicker').selectpicker('refresh');
    });

    // Inicializar los event listeners en la primera fila
    const firstRow = document.querySelector('tbody tr');
    addEventListenersToRow(firstRow, 0);
});



//FUNCIONA PARA UNA SOLA FILA

// document.addEventListener('DOMContentLoaded', function () {
//     const departmentSelect = document.getElementById('department_id');
//     const citySelect = document.getElementById('city_id');
//     const serviceSelect = document.getElementById('service_id');
//     const bandwidthSelect = document.getElementById('bandwidth_id');

//     const nrc12Input = document.getElementById('nrc_12');
//     const nrc24Input = document.getElementById('nrc_24');
//     const nrc36Input = document.getElementById('nrc_36');
//     const mrc12Input = document.getElementById('mrc_12');
//     const mrc24Input = document.getElementById('mrc_24');
//     const mrc36Input = document.getElementById('mrc_36');

//     departmentSelect.addEventListener('change', () => {
//         fetchCities();
//         fetchBandwidths();
//     });

//     citySelect.addEventListener('change', fetchBandwidths);
//     serviceSelect.addEventListener('change', fetchBandwidths);
//     bandwidthSelect.addEventListener('change', fetchBandwidthDetails);

//     function fetchCities() {
//         const departmentId = departmentSelect.value;
//         console.log('Departamento seleccionado:', departmentId);

//         citySelect.innerHTML = '<option value="">--Seleccione--</option>';

//         if (departmentId) {
//             fetch(`/obtener-ciudades/${departmentId}`)
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Error en la respuesta de la petición');
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     console.log('Ciudades recibidas:', data);
//                     data.forEach(city => {
//                         const option = document.createElement('option');
//                         option.value = city.id;
//                         option.textContent = city.name;
//                         citySelect.appendChild(option);
//                     });
//                     $('.selectpicker').selectpicker('refresh');
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                 });
//         }
//     }

//     function fetchBandwidths() {
//         const departmentId = departmentSelect.value;
//         const cityId = citySelect.value;
//         const serviceId = serviceSelect.value;

//         console.log('Departamento seleccionado:', departmentId);
//         console.log('Ciudad seleccionada:', cityId);
//         console.log('Servicio seleccionado:', serviceId);

//         bandwidthSelect.innerHTML = '<option value="">--Seleccione--</option>';

//         if (serviceId && departmentId && cityId) {
//             fetch(`/obtener-anchos-de-banda?servicio_id=${serviceId}&department_id=${departmentId}&city_id=${cityId}`)
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Error en la respuesta de la petición');
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     console.log('Datos de anchos de banda recibidos:', data);
//                     data.forEach(bandwidth => {
//                         console.log(`IDwww: ${bandwidth.bandwidth.id}, Namewww: ${bandwidth.bandwidth.name}`); // Verifica que ID sea correcto
//                         const option = document.createElement('option');
//                         option.value = bandwidth.bandwidth.id;
//                         console.log('Ancho de bandawwwwwwwww:', bandwidth);
//                         option.textContent = `${bandwidth.bandwidth.name}`;
//                         bandwidthSelect.appendChild(option);
//                     });
//                     $('.selectpicker').selectpicker('refresh');
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                 });
//         }
//     }
//     console.log('Bandwidth select:', bandwidthSelect);
//     console.log('Apunto de entrar a la funcion');

//     function fetchBandwidthDetails() {
//         console.log('Función fetchBandwidthDetails llamada.');
//         const bandwidthId = bandwidthSelect.value;
//         const serviceId = serviceSelect.value;
    
//         console.log('Ancho de banda seleccionado:', bandwidthId);
//         console.log('Servicio seleccionado:', serviceId);
    
//         if (bandwidthId && serviceId) {
//             $.ajax({
//                 url: '/obtener-detalles-tarifa',
//                 method: 'GET',
//                 dataType: 'json',
//                 data: {
//                     bandwidth_id: bandwidthId,
//                     service_id: serviceId,
//                 },
//                 success: function(data) {
//                     console.log('Detalles de la tarifa recibidos:', data);
    
//                     // Asignar valores a los campos del formulario
//                     nrc12Input.value = data.recurring_value_12 || '';
//                     nrc24Input.value = data.recurring_value_24 || '';
//                     nrc36Input.value = data.recurring_value_36 || '';
//                     mrc12Input.value = data.value_mbps_12 || '';
//                     mrc24Input.value = data.value_mbps_24 || '';
//                     mrc36Input.value = data.value_mbps_36 || '';
//                 },
//                 error: function(jqXHR, textStatus, errorThrown) {
//                     console.error('Error:', errorThrown);
//                 }
//             });
//         }
//     }

// });






























$(document).ready(function() {
    var serviciosDisponibles = {};
    var serviceCounter = 0;

    // Función para cargar las velocidades mediante Ajax
    function cargarVelocidades(servicioId, $select) {
        $.ajax({
            url: '/obtener-anchos-de-banda',
            type: 'GET',
            data: { servicio_id: servicioId },
            success: function(response) {
                serviciosDisponibles[servicioId] = response;
                actualizarSelectIndividual($select, servicioId);
                console.log("Anchos de banda cargados:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener anchos de banda:", error);
            }
        });
    }

    // Función para añadir un nuevo servicio
    function addService() {
        serviceCounter++;
        var $template = $($('#service-template').html());
        
        // Asignar IDs únicos a los elementos del template
        var serviceId = 'service_' + serviceCounter;
        var nameServiceId = 'name_service_' + serviceCounter;
        var observationId = 'observation_' + serviceCounter;
        var velocidadesContainerId = 'velocidades-container_' + serviceCounter;
        var tramosContainerId = 'tramos-container_' + serviceCounter;

        $template.find('.name_service').attr('id', nameServiceId);
        $template.find('label[for="name_service_template"]').attr('for', nameServiceId);
        $template.find('#name_service_template').attr('id', nameServiceId);

        $template.find('textarea').attr('id', observationId);
        $template.find('label[for="observation_template"]').attr('for', observationId);
        $template.find('#observation_template').attr('id', observationId);

        $template.find('.velocidades-container').attr('id', velocidadesContainerId);
        $template.find('.tramos-container').attr('id', tramosContainerId);

        $('#services-container').append($template);
        console.log("Nuevo servicio añadido.");

        $('#' + nameServiceId).change(function() {
            var servicioId = $(this).val();
            if (servicioId) {
                cargarVelocidades(servicioId, $('#' + velocidadesContainerId + ' #bandwidth'));
            } else {
                $('#' + velocidadesContainerId + ' #bandwidth').empty();
                $('#' + velocidadesContainerId + ' #bandwidth').selectpicker('refresh');
            }
        });

        $template.find('.add-velocidad').click(function() {
            var servicioId = $('#' + nameServiceId).val();
            if (!servicioId) {
                alert('Seleccione un servicio primero.');
                return;
            }

            var $velocidadTemplate = $($('#velocidad-template').html());
            $('#' + velocidadesContainerId).append($velocidadTemplate);
            console.log("Velocidad añadida al servicio.");

            actualizarSelectIndividual($velocidadTemplate.find('#bandwidth'), servicioId);

            $velocidadTemplate.find('#bandwidth').change(function() {
                var bandwidthId = $(this).val();
                var $group = $(this).closest('.velocidad-group');
                console.log("Ancho de banda seleccionado:", bandwidthId);
                if (!bandwidthId) {
                    limpiarCampos($group);
                    return;
                }

                $.ajax({
                    url: '/obtener-detalles-tarifa',
                    type: 'GET',
                    data: { bandwidth_id: bandwidthId },
                    success: function(response) {
                        $group.find('.address').val(response.address);
                        $group.find('.observation').val(response.observation);
                        $group.find('.nrc_12').val(response.recurring_value_12);
                        $group.find('.nrc_24').val(response.recurring_value_24);
                        $group.find('.nrc_36').val(response.recurring_value_36);
                        $group.find('.mrc_12').val(response.value_mbps_12);
                        $group.find('.mrc_24').val(response.value_mbps_24);
                        $group.find('.mrc_36').val(response.value_mbps_36);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al obtener detalles de tarifa:", error);
                    }
                });
            });

            $velocidadTemplate.find('.remove-velocidad').click(function() {
                $(this).closest('.velocidad-group').remove();
            });

            $velocidadTemplate.find('.selectpicker').selectpicker();
        });

        $template.find('.add-tramo').click(function() {
            var $tramoTemplate = $($('#tramo-template').html());
            $('#' + tramosContainerId).append($tramoTemplate);
            console.log("Otras opciones añadidas al servicio.");

            $tramoTemplate.find('.remove-tramo').click(function() {
                $(this).closest('.tramo-group').remove();
            });
        });

        $template.find('.remove-service').click(function() {
            $(this).closest('.service-group').remove();
        });

        $template.find('.add-service').click(function() {
            addService();
        });

        $template.find('.selectpicker').selectpicker();
    }

    // Inicializar el primer servicio al cargar la página
    $('#add-service').click(function() {
        addService();
    });

    function actualizarSelectIndividual($select, servicioId) {
        $select.empty();
        $select.append($('<option>').text('--Seleccione--').attr('value', ''));

        var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a, b) {
            return a.id - b.id;
        });

        $.each(sortedBandwidths, function(index, bandwidth) {
            $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
        });

        $select.selectpicker('refresh');
    }

    function limpiarCampos($group) {
        $group.find('.address').val('');
        $group.find('.observation').val('');
        $group.find('.nrc_12').val('');
        $group.find('.nrc_24').val('');
        $group.find('.nrc_36').val('');
        $group.find('.mrc_12').val('');
        $group.find('.mrc_24').val('');
        $group.find('.mrc_36').val('');
    }
});




$(document).ready(function() {
    var serviciosDisponibles = {};

    // Función para cargar las velocidades mediante Ajax
    function cargarVelocidades(servicioId) {
        $.ajax({
            url: '/obtener-anchos-de-banda',
            type: 'GET',
            data: { servicio_id: servicioId },
            success: function(response) {
                serviciosDisponibles[servicioId] = response;
                actualizarSelectsAnchosBanda(servicioId);
                console.log("Anchos de banda cargados:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener anchos de banda:", error);
            }
        });
    }

    // Función para cargar las velocidades al abrir el formulario de edición
    function cargarVelocidadesIniciales() {
        var servicioId = $('#name_service').val();
        if (servicioId) {
            cargarVelocidades(servicioId);
        }
    }

    // Cargar las velocidades iniciales al abrir el formulario de edición
    cargarVelocidadesIniciales();

    // Evento change para el campo de selección de servicios
    $('#name_service').change(function() {
        var servicioId = $(this).val();
        if (servicioId) {
            cargarVelocidades(servicioId);
        } else {
            $('.bandwidth').empty();
            $('.bandwidth').selectpicker('refresh');
        }
    });

    $('#add-velocidad').click(function() {
        console.log("Botón 'Añadir otra velocidad (Mbps)' clicado.");
        var servicioId = $('#name_service').val();
        if (!servicioId) {
            alert('Seleccione un servicio primero.');
            return;
        }

        var $template = $($('#velocidad-template').html());
        $('#velocidades-container').append($template);
        console.log("Template añadido al contenedor.");
        //

        actualizarSelectIndividual($template.find('.bandwidth'), servicioId);

        $template.find('#bandwidth').change(function() {
            var bandwidthId = $(this).val();
            var $group = $(this).closest('.velocidad-group');
            console.log("Ancho de banda seleccionado:", bandwidthId);
            if (!bandwidthId) {
                limpiarCampos($group);
                return;
            }

            $.ajax({
                url: '/obtener-detalles-tarifa',
                type: 'GET',
                data: { bandwidth_id: bandwidthId },
                success: function(response) {
                    $group.find('.nrc_12').val(response.recurring_value_12);
                    $group.find('.nrc_24').val(response.recurring_value_24);
                    $group.find('.nrc_36').val(response.recurring_value_36);
                    $group.find('.mrc_12').val(response.value_mbps_12);
                    $group.find('.mrc_24').val(response.value_mbps_24);
                    $group.find('.mrc_36').val(response.value_mbps_36);
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener detalles de tarifa:", error);
                }
            });
        });

        $template.find('.remove-velocidad').click(function() {
            $(this).closest('.velocidad-group').remove();
        });

        // Inicializar el selectpicker para el nuevo elemento
        $template.find('.selectpicker').selectpicker();
        console.log("Selectpicker inicializado para el nuevo elemento.");
    });

    // Función para limpiar los campos de una velocidad
    function limpiarCampos($group) {
        $group.find('.nrc_12').val('');
        $group.find('.nrc_24').val('');
        $group.find('.nrc_36').val('');
        $group.find('.mrc_12').val('');
        $group.find('.mrc_24').val('');
        $group.find('.mrc_36').val('');
    }

      // Función para actualizar todos los selects de ancho de banda
      function actualizarSelectsAnchosBanda(servicioId) {
        $('#bandwidth').each(function(elemento) {
            var $select = $(this);
            $select.empty();
            $select.append($('<option>').text('--Seleccione--').attr('value', ''));

            var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a, b) {
                return a.id - b.id;
            });

            $.each(sortedBandwidths, function(index, bandwidth) {
                $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
            });
            // $.each(serviciosDisponibles[servicioId], function(index, bandwidth) {
            //     $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
            // });
            $select.selectpicker('refresh');
        });
        $('#bandwidth').change();
    }

    // Función para actualizar el campo de selección de ancho de banda individualmente
    function actualizarSelectIndividual($select, servicioId) {
        $select.empty();
        $select.append($('<option>').text('--Seleccione--').attr('value', ''));

        var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a, b) {
            return a.id - b.id;
        });

        $.each(sortedBandwidths, function(index, bandwidth) {
            $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
        });

        // $.each(serviciosDisponibles[servicioId], function(index, bandwidth) {
        //     $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
        // });
    }
    
});

$(document).ready(function() {
    $('#add-tramo').click(function() {
        console.log("Botón 'Añadir otras opciones' clicado.");

        var $template = $($('#tramo-template').html());
        $('#tramos-container').append($template);
        console.log("Template de tramo añadido al contenedor.");

        // Añadir evento click para eliminar el grupo
        $template.find('.remove-tramo').click(function() {
            $(this).closest('.tramo-group').remove();
        });
    });
});


