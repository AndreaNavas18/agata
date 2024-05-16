$(document).ready(function() {
    $('#addFieldsButton').click(function() {
        // Agrega el h3 antes de agregar el formulario
        var ruta = ruta = $('input#rutaAjax').attr('data-url-form');
        $.get(ruta, function(data) {
            
            $('#newTariff').removeAttr('style');
            // Agrega el formulario al contenedor
            $('#additionalFieldsContainer').append(data);
            
            // Inicializa los selectores
            $('.selectpicker').selectpicker();
                // Agrega una linea de espacio   
            $('#additionalFieldsContainer').children('div.container').last().prepend('<hr style="margin-top: 0; margin-bottom: 15px">');
                //Titulo de Nueva Tarifa   
            $('#additionalFieldsContainer').children('div.container').last().prepend('<h4><strong>Nueva Tarifa</strong>');
                // Agrega un botón de eliminar solo si no existe uno dentro del formulario   
            $('#additionalFieldsContainer').children('div.container').last().append('<button type="button" class="btn btn-danger btn-sm removeFieldsButton"><i class="fas fa-delete"></i>Eliminar</button>');
        });
    });

        // Agrega un listener de eventos para los botones de eliminar
        $('#additionalFieldsContainer').on('click', '.removeFieldsButton', function() {
            // Encuentra el formulario asociado y lo elimínalo
            $(this).closest('div.container').remove();
        });

});