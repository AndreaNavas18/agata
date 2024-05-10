/* Carga las ciudades */
$('#country_id, #country_id_filter').on('change', function() {
    openLoader();
    var countryId = $(this).val(),
    ruta = $('input#rutaAjaxDepartments').val();
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { countryId: countryId},
        beforeSend: function() {
            $('select#department_id,select#department_id_filter').html('');
            $('select#department_id,select#department_id_filter').append('<option value="">--Seleccione--</option>');
        },
        success: function(customerServices) {
            console.log("Primer carga")
            console.log(customerServices);
            closeLoader();
            $.each(customerServices, function(i,v) {
                $('select#department_id,select#department_id_filter').append($('<option>', {
                    value: v.id,
                    text : v.name
                }));
            });
            $('select#department_id,select#department_id_filter').selectpicker('refresh');
        },
        error: function(e) {
            console.log("error")
            closeLoader();
            if (e.responseJSON !== undefined) {
                console.log("error 2")
                if (e.responseJSON.error != null) {
                    alert(e.responseJSON.error);
                }
            } else {
                alert('Ocurrió un error al cargar las jerarquías.');
            }
        }
    });
});


$('#department_id, #department_id_filter').on('change', function() {
    openLoader();
    var departmentId = $(this).val(),
    ruta = $('input#rutaAjax').attr('data-url-cities');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { departmentId: departmentId},
        beforeSend: function() {
            $('select#city_id,select#city_id_filter').html('');
            $('select#city_id,select#city_id_filter').append('<option value="">--Seleccione--</option>');
        },
        success: function(customerServices) {
            console.log("segunda carga")
            console.log(customerServices);
            closeLoader();
            $.each(customerServices, function(i,v) {
                $('select#city_id,select#city_id_filter').append($('<option>', {
                    value: v.id,
                    text : v.name
                }));
            });
            $('select#city_id,select#city_id_filter').selectpicker('refresh');
        },
        error: function(e) {
            closeLoader();
            if (e.responseJSON !== undefined) {
                if (e.responseJSON.error != null) {
                    alert(e.responseJSON.error);
                }
            } else {
                alert('Ocurrió un error al cargar las jerarquías.');
            }
        }
    });
});

