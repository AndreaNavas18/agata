$('.editUserCustomer').on('click', function() {
    // Cambiar el método del formulario a PUT
    $('#formCustomerUser').append('<input type="hidden" name="_method" value="PUT">');
    // Restablecer el formulario
    document.getElementById("formCustomerUser").reset();
    // Obtener los datos del usuario del atributo "datauserCustomer"
    userCustomer = JSON.parse($(this).attr('datauserCustomer'));
    // Obtener la URL de acción del botón
    action = $(this).attr('dataUrl');
    // Establecer la URL de acción del formulario
    $('#formCustomerUser').attr('action', action);
    // Remover la validación "required" del campo de contraseña
    $('#password').removeAttr('required');
    // Llenar los campos del formulario con los datos del usuario
    $('#name').val(userCustomer.name);
    $('#last_name').val(userCustomer.last_name);
    $('#email').val(userCustomer.email);
    $('#customer_id').val(userCustomer.customer_id).selectpicker('refresh');
    // Mostrar el modal
    $('#modalCustomerUser').modal('show');
});


$('.addUserCustomer').on('click', function() {
    // Elimina el campo _method
    $('#formCustomerUser input[name="_method"]').remove();
    // Restablecer el formulario
    document.getElementById("formCustomerUser").reset();
    // Obtener la URL de acción del botón
    action = $(this).attr('dataUrl');
    // Agregar la validación "required" si el campo está vacío
    $('#password').attr('required', 'required');
    // Establecer la URL de acción del formulario
    $('#formCustomerUser').attr('action', action);
    // Mostrar el modal
    $('#modalCustomerUser').modal('show');
});



