/* Carga las jerarquías */
$('#employee_position_department_id').change (function() {
    openLoader();
    var positionDepartmentId = $(this).val(),
    ruta = $('input#rutaAjax').attr('data-url-employees');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { positionDepartmentId: positionDepartmentId},
        beforeSend: function() {
            $('div.loader').addClass('is-active');
            $('select#employee_id').html('');
            $('select#employee_id').append('<option value="">--Seleccione--</option>');
        },
        success: function(positionsDepartmentsList) {
            closeLoader();
            $.each(positionsDepartmentsList, function(i,v) {
                $('select#employee_id').append($('<option>', {
                    value: v.id,
                    text : v.full_name
                }));
            });
            $('select#employee_id').selectpicker('refresh');
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

/* Carga las jerarquías */
$('#customer_id').on('change', function() {
    var customerId = $(this).val();
    serachServicesCustomer(customerId);
});


function serachServicesCustomer(customerId) {
    openLoader();
    ruta = $('input#rutaAjax').attr('data-url-services');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { customerId: customerId},
        beforeSend: function() {
            $('div.loader').addClass('is-active');
            $('select#customer_service_id').html('');
            $('select#customer_service_id').append('<option value="">--Seleccione--</option>');
        },
        success: function(customerServices) {
            $.each(customerServices, function(i,v) {
                $('select#customer_service_id').append($('<option>', {
                    value: v.id,
                    text : v.name
                }));
            });
            $('select#customer_service_id').selectpicker('refresh');
            closeLoader();
        },
        error: function(e) {
            if (e.responseJSON !== undefined) {
                if (e.responseJSON.error != null) {
                    alert(e.responseJSON.error);
                }
            } else {
                alert('Ocurrió un error al cargar las jerarquías.');
            }
            closeLoader();
        }
    });
}


