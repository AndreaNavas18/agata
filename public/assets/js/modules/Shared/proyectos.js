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

//Asignar servicios a proyecto
$('.asignarServicios').on('click', function() {
    // Limpiar el select de servicios
    $(".put input").attr('name', '_method');
    $('#customerservices').empty();
    // Obtener la URL de la acción del botón
    var action = $(this).attr('dataUrl');
    // Obtener el nombre del proyecto
    var projectName = $(this).data('proyecto-name');
    var proyectoId = $(this).data('proyecto-id');

    $('#proyectoSeleccionadoId').val(proyectoId);
    $('#projectName').text('Proyecto (' + projectName + ')');
    $('#title_proyecto').text(projectName);
     // Establecer la acción del formulario
     $('#formAsignarServicio').attr('action', action);

     // Mostrar el modal
     $('#modalAsignarServicio').modal('show');

     console.log('ID del proyecto seleccionado:', proyectoId);
     console.log('Nombre del proyecto seleccionado:', projectName);

     $.ajax({
        url: '/obtener-proyecto-seleccionado?proyectoId=' + proyectoId,
        method: 'GET',
        success: function(response) {
            console.log('Información del proyecto obtenida con éxito:', response.proyecto);
        },
        error: function(xhr, status, error) {
            console.error('Error al enviar ID del proyecto seleccionado al servidor:', error);
        }
    });
 });

 // Manejar el envío del formulario
// $('#formAsignarServicio').on('submit', function(event) {
//     // Evitar que se envíe el formulario de manera predeterminada
//     event.preventDefault();

//     // Obtener los datos del formulario
//     var formData = $(this).serialize();

//     // Realizar una solicitud AJAX para enviar los datos al servidor
//     $.ajax({
//         url: $(this).attr('action'), 
//         method: 'PUT',
//         data: formData,
//         success: function(response) {
//             // Manejar la respuesta del servidor (por ejemplo, mostrar un mensaje de éxito)
//             console.log('Servicios asignados correctamente');
//             // Cerrar el modal después de asignar los servicios
//             $('#modalAsignarServicio').modal('hide');
//         },
//         error: function(xhr, status, error) {
//             // Manejar errores de la solicitud AJAX
//             console.error('Error al asignar servicios:', error);
//         }
//     });
// });




//     $('#formAsignarServicio input[name="_method"]').remove();
//     document.getElementById("formProyecto").reset();
//     action = $(this).attr('dataUrl');
//     $('#formAsignarServicio').attr('action', action);
//     $('#modalAsignarServicio').modal('show');
// })