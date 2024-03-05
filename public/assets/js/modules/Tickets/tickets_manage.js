// Agrega un evento change al primer select
$('#employee_position_department_id').change(function() {
    openLoader();
    // Obtén el ID del departamento seleccionado
    var positionDepartmentId = $(this).val();

    // Envía una solicitud AJAX al servidor para obtener la lista de empleados
    $.ajax({
        url: '/obtener-empleados-area', // Ruta que manejará la solicitud en el servidor
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