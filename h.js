$(document).ready(function() {
    var serviciosDisponibles = {};
    var serviceCounter = $('.service-group').length; // Obtener el número actual de servicios
    
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

    // Código para manejar la inicialización de selectpicker u otros plugins
    $('.selectpicker').selectpicker();

    // Función para eliminar un servicio
    $(document).on('click', '.remove-service', function() {
        $(this).closest('.service-group').remove();
    });

    // Función para eliminar una velocidad
    $(document).on('click', '.remove-velocidad', function() {
        $(this).closest('.velocidad-group').remove();
    });

    // Función para eliminar un tramo
    $(document).on('click', '.remove-tramo', function() {
        $(this).closest('.tramo-group').remove();
    });
});
