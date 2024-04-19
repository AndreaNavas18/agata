/* Carga las jerarquías */
$('#employee_position_department_id').change(function () {
    openLoader();
    var positionDepartmentId = $(this).val(),
        ruta = $('input#rutaAjax').attr('data-url-employees');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { positionDepartmentId: positionDepartmentId },
        beforeSend: function () {
            $('div.loader').addClass('is-active');
            $('select#employee_id').html('');
            $('select#employee_id').append('<option value="">--Seleccione--</option>');
        },
        success: function (positionsDepartmentsList) {
            closeLoader();
            $.each(positionsDepartmentsList, function (i, v) {
                $('select#employee_id').append($('<option>', {
                    value: v.id,
                    text: v.full_name
                }));
            });
            $('select#employee_id').selectpicker('refresh');
        },
        error: function (e) {
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
    var customerId = '';
    var customerChanged = false;
    var projectChanged = false;

    $('#id_customer').on('change', function () {
        customerChanged = true;
        projectChanged = true;
        customerId = $(this).val();
    
        $('select#customer_service_id').html('');
        $('select#customer_service_id').append('<option value="">--Seleccione--</option>').selectpicker('refresh');
        // serachServicesCustomer(customerId);
        //Traer todos proyectos
        // console.log('Cliente= ', customerId);
        serachProject(customerId);
    });

    $('#customer_id').on('change', function () {
    var idCustomer = $(this).val()
        serachServicesCustomer(idCustomer);
    });
    

    //Cuando se edita, manda el id del cliente para que filtre los servicios con los proyectos.
   

    $(document).ready(function() {
        if (!customerChanged) {
            customerId = $('#id_customer').val()
        }
        projectId = $('#project_id').val();
        if(!projectChanged && projectId!==undefined){
             serachServicesProjectCustomer(customerId, projectId)


        }
    });


// Id del proyecto Seleccionado
$('#project_id').on('change', function () {
    var projectId = $(this).val();
    // console.log('Proyecto= ', projectId);
    serachServicesProjectCustomer(customerId, projectId);
    var x = ''
});




//Traer los servicios del cliente que pertenecen a un proyecto seleccionado
function serachServicesProjectCustomer(customerId, projectId) {
    openLoader();
    if (projectId === '') {
        // Si el campo de búsqueda está vacío, limpiar la lista de opciones y salir de la función
        $('select#customer_service_id').html('');
        $('select#customer_service_id').append('<option value="">--Seleccione--</option>');
        $('select#customer_service_id').selectpicker('refresh');
        closeLoader();
        return;
    }
    ruta = $('input#rutaAjax').attr('data-url-services-project');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { customerId: customerId, projectId: projectId },
        
        beforeSend: function () {
            if(!projectChanged && projectId!==undefined){
           
            x = $('#customer_service_id').val()

        }
            $('div.loader').addClass('is-active');
            $('select#customer_service_id').html('');
            $('select#customer_service_id').append('<option value="">--Seleccione--</option>');

        },
        success: function (servicesCustomerProject) {
            $.each(servicesCustomerProject, function (i, v) {
                var option = $('<option>', {
                    value: v.id,
                    text: 'ID ' + v.stratecsa_id + ' - OTP ' + v.otp + ' - ' + v.name
                });
            
                // Verificar si el valor de la opción coincide con el valor seleccionado
                if(!projectChanged && projectId!==undefined){
                if (x == v.id) {
                    option.prop('selected', true);
                }
            }
            
                $('select#customer_service_id').append(option);
            });
            
            $('select#customer_service_id').selectpicker('refresh');
            closeLoader();
            
           
        },
        error: function (e) {
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




//Trea por Ajax Todos los proyectos
function serachProject(customerId) {
    openLoader();
    if (customerId === '') {
        // Si el campo de búsqueda está vacío, limpiar la lista de opciones y salir de la función
        $('select#project_id').html('');
        $('select#project_id').append('<option value="">--Seleccione--</option>');
        $('select#project_id').selectpicker('refresh');
        closeLoader();
        return;
    }
    ruta = $('input#rutaAjax').attr('data-url-projects');
    $.ajax({
        url: ruta,
        type: 'GET',
        data: { customerId: customerId},
        beforeSend: function () {
            $('div.loader').addClass('is-active');
            $('select#project_id').html('');
            $('select#project_id').append('<option value="">--Seleccione--</option>');
            $('select#project_id').append('<option value="Null">Sin Proyecto</option>');
        },
        success: function (proyectos) {
            $.each(proyectos, function (i, v) {
                $('select#project_id').append($('<option>', {
                    value: v.id,
                    text: v.name
                }));
                // console.log(v);
            });
            $('select#project_id').selectpicker('refresh');
            closeLoader();
        },
        error: function (e) {
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

//Busquedas para servicios de u n cliente sin filtro de Proyectos
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
                    text : 'ID ' + v.stratecsa_id + ' - OTP ' + v.otp +  ' - '  + (v.name ? v.name.toUpperCase() : '')
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

//PUEBAS


// $(document).ready(function() {
//     // Función autoejecutable
//     (function serachServicesProjectCustomer() {
//         var projectId = $('#project_id').val();
        
//         openLoader();

       
//             // Si el campo de búsqueda está vacío, limpiar la lista de opciones y salir de la función
//             $('select#customer_service_id').html('');
//             $('select#customer_service_id').append('<option value="">--Seleccione--</option>');
//             $('select#customer_service_id').selectpicker('refresh');
  

//         var ruta = $('input#rutaAjax').attr('data-url-services-project');
        
//         $.ajax({
//             url: ruta,
//             type: 'GET',
//             data: { customerId: customerId, projectId: projectId },
//             beforeSend: function () {
//                 $('div.loader').addClass('is-active');
//                 $('select#customer_service_id').html('');
//                 $('select#customer_service_id').append('<option value="">--Seleccione--</option>');
//             },
//             success: function (servicesCustomerProject) {
//                 $.each(servicesCustomerProject, function (i, v) {
//                     $('select#customer_service_id').append($('<option>', {
//                         value: v.id,
//                         text: 'ID ' + v.stratecsa_id + ' - OTP ' + v.otp + ' - ' + v.name
//                     }));
//                 });
//                 $('select#customer_service_id').selectpicker('refresh');
//                 closeLoader();
//             },
//             error: function (e) {
//                 if (e.responseJSON !== undefined) {
//                     if (e.responseJSON.error != null) {
//                         alert(e.responseJSON.error);
//                     }
//                 } else {
//                     alert('Ocurrió un error al cargar las jerarquías.');
//                 }
//                 closeLoader();
//             }
//         });
//     })();
// });



