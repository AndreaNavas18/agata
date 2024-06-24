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
                cargarVelocidades(servicioId, $('#' + velocidadesContainerId + ' .bandwidth'));
            } else {
                $('#' + velocidadesContainerId + ' .bandwidth').empty();
                $('#' + velocidadesContainerId + ' .bandwidth').selectpicker('refresh');
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

            actualizarSelectIndividual($velocidadTemplate.find('.bandwidth'), servicioId);

            $velocidadTemplate.find('.bandwidth').change(function() {
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
        $group.find('.nrc_12').val('');
        $group.find('.nrc_24').val('');
        $group.find('.nrc_36').val('');
        $group.find('.mrc_12').val('');
        $group.find('.mrc_24').val('');
        $group.find('.mrc_36').val('');
    }
});




// $(document).ready(function() {
//     var serviciosDisponibles = {};

//     // Función para cargar las velocidades mediante Ajax
//     function cargarVelocidades(servicioId) {
//         $.ajax({
//             url: '/obtener-anchos-de-banda',
//             type: 'GET',
//             data: { servicio_id: servicioId },
//             success: function(response) {
//                 serviciosDisponibles[servicioId] = response;
//                 actualizarSelectsAnchosBanda(servicioId);
//                 console.log("Anchos de banda cargados:", response);
//             },
//             error: function(xhr, status, error) {
//                 console.error("Error al obtener anchos de banda:", error);
//             }
//         });
//     }

//     // Función para cargar las velocidades al abrir el formulario de edición
//     function cargarVelocidadesIniciales() {
//         var servicioId = $('#name_service').val();
//         if (servicioId) {
//             cargarVelocidades(servicioId);
//         }
//     }

//     // Cargar las velocidades iniciales al abrir el formulario de edición
//     cargarVelocidadesIniciales();

//     // Evento change para el campo de selección de servicios
//     $('#name_service').change(function() {
//         var servicioId = $(this).val();
//         if (servicioId) {
//             cargarVelocidades(servicioId);
//         } else {
//             $('.bandwidth').empty();
//             $('.bandwidth').selectpicker('refresh');
//         }
//     });

//     $('#add-velocidad').click(function() {
//         console.log("Botón 'Añadir otra velocidad (Mbps)' clicado.");
//         var servicioId = $('#name_service').val();
//         if (!servicioId) {
//             alert('Seleccione un servicio primero.');
//             return;
//         }

//         var $template = $($('#velocidad-template').html());
//         $('#velocidades-container').append($template);
//         console.log("Template añadido al contenedor.");
//         //

//         actualizarSelectIndividual($template.find('.bandwidth'), servicioId);

//         $template.find('#bandwidth').change(function() {
//             var bandwidthId = $(this).val();
//             var $group = $(this).closest('.velocidad-group');
//             console.log("Ancho de banda seleccionado:", bandwidthId);
//             if (!bandwidthId) {
//                 limpiarCampos($group);
//                 return;
//             }

//             $.ajax({
//                 url: '/obtener-detalles-tarifa',
//                 type: 'GET',
//                 data: { bandwidth_id: bandwidthId },
//                 success: function(response) {
//                     $group.find('.nrc_12').val(response.recurring_value_12);
//                     $group.find('.nrc_24').val(response.recurring_value_24);
//                     $group.find('.nrc_36').val(response.recurring_value_36);
//                     $group.find('.mrc_12').val(response.value_mbps_12);
//                     $group.find('.mrc_24').val(response.value_mbps_24);
//                     $group.find('.mrc_36').val(response.value_mbps_36);
//                 },
//                 error: function(xhr, status, error) {
//                     console.error("Error al obtener detalles de tarifa:", error);
//                 }
//             });
//         });

//         $template.find('.remove-velocidad').click(function() {
//             $(this).closest('.velocidad-group').remove();
//         });

//         // Inicializar el selectpicker para el nuevo elemento
//         $template.find('.selectpicker').selectpicker();
//         console.log("Selectpicker inicializado para el nuevo elemento.");
//     });

//     // Función para limpiar los campos de una velocidad
//     function limpiarCampos($group) {
//         $group.find('.nrc_12').val('');
//         $group.find('.nrc_24').val('');
//         $group.find('.nrc_36').val('');
//         $group.find('.mrc_12').val('');
//         $group.find('.mrc_24').val('');
//         $group.find('.mrc_36').val('');
//     }

//       // Función para actualizar todos los selects de ancho de banda
//       function actualizarSelectsAnchosBanda(servicioId) {
//         $('#bandwidth').each(function(elemento) {
//             var $select = $(this);
//             $select.empty();
//             $select.append($('<option>').text('--Seleccione--').attr('value', ''));

//             var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a, b) {
//                 return a.id - b.id;
//             });

//             $.each(sortedBandwidths, function(index, bandwidth) {
//                 $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
//             });
//             // $.each(serviciosDisponibles[servicioId], function(index, bandwidth) {
//             //     $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
//             // });
//             $select.selectpicker('refresh');
//         });
//         $('#bandwidth').change();
//     }

//     // Función para actualizar el campo de selección de ancho de banda individualmente
//     function actualizarSelectIndividual($select, servicioId) {
//         $select.empty();
//         $select.append($('<option>').text('--Seleccione--').attr('value', ''));

//         var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a, b) {
//             return a.id - b.id;
//         });

//         $.each(sortedBandwidths, function(index, bandwidth) {
//             $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
//         });

//         // $.each(serviciosDisponibles[servicioId], function(index, bandwidth) {
//         //     $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
//         // });
//     }
    
// });

// $(document).ready(function() {
//     $('#add-tramo').click(function() {
//         console.log("Botón 'Añadir otras opciones' clicado.");

//         var $template = $($('#tramo-template').html());
//         $('#tramos-container').append($template);
//         console.log("Template de tramo añadido al contenedor.");

//         // Añadir evento click para eliminar el grupo
//         $template.find('.remove-tramo').click(function() {
//             $(this).closest('.tramo-group').remove();
//         });
//     });
// });


