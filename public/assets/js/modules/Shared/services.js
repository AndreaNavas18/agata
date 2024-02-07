$('.editService').on('click', function() {
    $(".put input").attr('name', '_method');
    document.getElementById("formService").reset();
    service =JSON.parse($(this).attr('dataService'));
    $('#country_id').val(service.country_id).selectpicker('refresh');

    console.log('service: '+  JSON.stringify(service));
    $('#installation_type').val(service.installation_type).selectpicker('refresh');
    loadDepartments(service.country_id, service.department_id);
    loadCities(service.department_id, service.city_id);
    action = $(this).attr('dataUrl');
    $('#formService').attr('action', action);
    $('#service_id').val(service.service_id).selectpicker('refresh');
    $('#date_service').val(service.date_service);
    $('#latitude_coordinates').val(service.latitude_coordinates);
    $('#longitude_coordinates').val(service.longitude_coordinates);
    $('#customer_id').val(service.customer_id).selectpicker('refresh');
    tipoInstalacion= $('#installation_type').val();
    if (tipoInstalacion=='Propia') {
        $('#provider_id').prop('required', false).prop('disabled', true);
    } else {
        $('#provider_id').prop('required', true).prop('disabled', false);
        $('#provider_id').val(service.provider_id);
    }
    $('select#provider_id').selectpicker('refresh');
    $('#description').val(service.description);
    $('#modalService').modal('show');
})

$('.addService').on('click', function() {
    $(".put input").attr('name', 'method');
    document.getElementById("formService").reset();
    action = $(this).attr('dataUrl');
    $('#formService').attr('action', action);
    $('#modalService').modal('show');
})


$('#installation_type').on('change', function() {
    tipoInstalacion= $(this).val();
    if (tipoInstalacion=='Propia') {
        $('#provider_id').prop('required', false).prop('disabled', true);
    } else {
        $('#provider_id').prop('required', true).prop('disabled', false);
    }
    $('select#provider_id').selectpicker('refresh');
})


function loadDepartments(countryId, department_id) {
    openLoader();
    ruta = $('input#rutaAjaxDepartments').val();
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { countryId: countryId },
        beforeSend: function () {
            $('select#department_id').html('');
            $('select#department_id').append('<option value="">--Seleccione--</option>');
        },
        success: function (departments) {
            closeLoader();
            $.each(departments, function (i, v) {
                $('select#department_id').append($('<option>', {
                    value: v.id,
                    text: v.name
                }));
            });

            // Seleccionar el departamento_id
            if (department_id) {
                $('#department_id').val(department_id).selectpicker('refresh');
            }

            $('#department_id').selectpicker('refresh');

        },
        error: function (e) {
            closeLoader();
            if (e.responseJSON !== undefined) {
                if (e.responseJSON.error != null) {
                    alert(e.responseJSON.error);
                }
            } else {
                alert('Ocurrió un error al cargar los departamentos.');
            }
        }
    });
}




function loadCities(departmentId, cityId) {
    openLoader();
    ruta = $('input#rutaAjax').attr('data-url-cities');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { departmentId: departmentId},
        beforeSend: function() {
            $('select#city_id').html('');
            $('select#city_id').append('<option value="">--Seleccione--</option>');
        },
        success: function(cities) {
            closeLoader();
            $.each(cities, function(i,v) {
                $('select#city_id').append($('<option>', {
                    value: v.id,
                    text : v.name + v.id
                }));
            });

            if (cityId) {
                $('#city_id').val(cityId).selectpicker('refresh');
            }

            $('#city_id').selectpicker('refresh');
        },
        error: function(e) {
            closeLoader();
            if (e.responseJSON !== undefined) {
                if (e.responseJSON.error != null) {
                    alert(e.responseJSON.error);
                }
            } else {
                alert('Ocurrió un error al cargar las ciudades.');
            }
        }
    });
}


