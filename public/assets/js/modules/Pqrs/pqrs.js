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

$('#department_id').change(function () {
    var departmentId = $(this).val();
    var ruta = $('input#rutaAjax').attr('data-url-employee');
    if (departmentId) {
        $.ajax({
            url: ruta,
            type: 'GET',
            data: { employeeDepartment: departmentId },
            beforeSend: function () {
                $('div.loader').addClass('is-active');
                $('select#employee_id').html('');
                $('select#employee_id').append('<option value="">--Seleccione--</option>');
            },
            success: function (employees) {
                closeLoader();
                $.each(employees, function (i, employee) {
                    $('select#employee_id').append($('<option>', {
                        value: employee.id,
                        text: employee.full_name
                    }));
                });
                $('select#employee_id').selectpicker('refresh');
            },
            error: function (e) {
                closeLoader();
                alert('Ocurrió un error al cargar los empleados.');
            }
        });
    } else {
        $('select#employee_id').html('<option value="">--Seleccione--</option>');
        $('select#employee_id').selectpicker('refresh');
    }
});

