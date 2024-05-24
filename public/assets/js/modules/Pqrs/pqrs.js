$('#department_id').change(function () {
    var departmentId = $(this).val();
    var ruta = $('input#rutaAjax').attr('data-url-temas');
    if (departmentId) {
        $.ajax({
            url: ruta,
            type: 'GET',
            data: { temaDepartmentId: departmentId },
            beforeSend: function () {
                $('div.loader').addClass('is-active');
                $('select#tema_id').html('');
                $('select#tema_id').append('<option value="">--Seleccione--</option>');
            },
            success: function (temasList) {
                closeLoader();
                $.each(temasList, function (i, tema) {
                    $('select#tema_id').append($('<option>', {
                        value: tema.id,
                        text: tema.name
                    }));
                });
                $('select#tema_id').selectpicker('refresh');
            },
            error: function (e) {
                closeLoader();
                alert('Ocurrió un error al cargar los temas.');
            }
        });
    } else {
        $('select#tema_id').html('<option value="">--Seleccione--</option>');
        $('select#tema_id').selectpicker('refresh');
    }
});
/* Carga las jerarquías */
$('#department_id').change(function() {
    openLoader();
    // Obtén el ID del departamento seleccionado
    var positionDepartmentId = $(this).val();

    // Envía una solicitud AJAX al servidor para obtener la lista de empleados
    $.ajax({
        url: '/pqrs/obtener-empleados', // Ruta que manejará la solicitud en el servidor
        type: 'GET',
        data: { positionDepartmentId: positionDepartmentId },
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
        },  error: function(e) {
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
