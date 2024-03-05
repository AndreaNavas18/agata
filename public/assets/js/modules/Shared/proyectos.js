$('.editProyect').on('click', function() {
    // Cambiar el método del formulario a PUT
    $('#formProyecto').append('<input type="hidden" name="_method" value="PUT">');
    // Restablecer el formulario
    document.getElementById("formProyecto").reset();
    // Obtener los datos del usuario del atributo "dataproyectoCustomer"
    proyectoCustomer = JSON.parse($(this).attr('dataproyectoCustomer'));
    // Obtener la URL de acción del botón
    action = $(this).attr('dataUrl');
    // Establecer la URL de acción del formulario
    $('#formProyecto').attr('action', action);
    // Llenar los campos del formulario con los datos del usuario
    $('#name').val(proyectoCustomer.name);
    $('#description').val(proyectoCustomer.description);
    // Mostrar el modal
    $('#modalProyecto').modal('show');

    console.log('Si estoy mostrando el modal');
});

$('.addProyecto').on('click', function() {
    // $(".put input").attr('name', 'method');
    $('#formProyecto input[name="_method"]').remove();
    document.getElementById("formProyecto").reset();
    action = $(this).attr('dataUrl');
    $('#formProyecto').attr('action', action);
    $('#modalProyecto').modal('show');
});

$('.obtenerServicios').on('click', function() {
    $('#customerservices').empty();
    const proyectoId = $(this).data('proyecto-id');
    const customerId = $(this).data('customer-id');
    const projectName = $(this).data('proyecto-name');
    $.ajax({
        url: '/clientes/proyectos/getServicios/' + customerId,
        method: 'GET',
        success: function(response) {
            console.log('Servicios obtenidos con éxito:', response.customerServices);
            $.each(response.customerServices, function(i, servicio) {
                $('#customerservices').append('<option value="' + servicio.id + '">' + servicio.description + '</option>');
            });
            $('#customerservices').selectpicker('refresh');
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener servicios:', error);
        }
    });
    $('#title_proyecto').text(projectName);
    $('#proyecto_id').val(proyectoId);
    $('#modalAsignarServicio').modal('show');

});
