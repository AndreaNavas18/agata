$(document).ready(function() {
    // var fieldCounter = 0;
    // Inicializa el contador de campos adicionales
    $('#addFieldsButton').click(function() {
        // fieldCounter++;
        // Agrega el h3 antes de agregar el formulario
        var ruta = $('input#rutaAjax').attr('data-url-form');
        $.get(ruta, function (data) {

            // Crea un nuevo elemento jQuery a partir de los datos modificados
            // var newData = $(data).find('input, select').map(function () {
            //     // Verifica si el elemento tiene un ID
            //     if ($(this).attr('id')) {
            //         // Modifica el ID agregando el contador
            //         var oldId = $(this).attr('id');
            //         var newId = oldId + '_' + fieldCounter;
            //         $(this).attr('id', newId);

            //         // Agrega el atributo data
            //         $(this).data('counter', fieldCounter);
            //     }3
            //     return this; // Retorna el elemento modificado
            // });

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