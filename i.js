//Función para cargar los anchos de banda
function cargarVelocidades(servicioId, $select){
    $.ajax({
        url:'/obtener-anchos-de-banda',
        type:'GET',
        data: {servicio_id: servicioId},
        success: function(response){
            serviciosDisponibles[servicioId] = response;
            actualizarSelectVelocidades($select, servicioId);
            console.log('Se cargaron los anchos de banda');
        },
        error: function(xhr,status,error){
            console.log('Error al cargar los anchos de banda', error)
        }
    });
}

//Funcion para actualizar los selects de las velocidades
function actualizarSelectVelocidades($select, items){
    $select.empty();
    $select.append($('<option>').text('--Seleccione--').attr('value', ''));

    items.sort(function(a, b){
        return a.id - b.id;
    });

    $.each(items, function(index, item){
        $select.append($('<option>').text(item.name).attr('value', item.id));
    });

    $select.selectpicker('refresh');
}

//Funcion para cargar los detalles de la tarifa
function cargarDetallesTarifa(){
    $.ajax({
        url:'/obtener-detalles-tarifa',
        type:'GET',
        data: {
            bandwidth_id: bandwidthId,
            name_service: nameService
        },
        success: function(response) {
            actualizarCamposTarifa($group, response);
            console.log('Se cargaron los detalles de la tarifa')
        },
        error: function(xhr,status,error){
            console.log('Error al cargar los detalles de la tarifa', error)
        }

    })
}

function actualizarCamposTarifa(){

}

//Funcion para añadir y eliminar un servicio
function addService(){
    var $template = $($('#service-template').html());
    $template('#services-container').append($template);
    console.log('Se añadió un servicio')
}

function removeService(){
    $service.remove();
    console.log('Se eliminó un servicio')
}

//Funcion para añadir y eliminar una velocidad
function addVelocidad($velocidadesContainer){
    var $velocidadTemplate = $($('#velocidad-template').html());
    $velocidadesContainer.append($velocidadTemplate);
    console.log('Se añadió una velocidad')
}

function removeVelocidad($velocidad){
    $velocidad.remove();
    console.log('Se eliminó una velocidad')
}

//Funcion para añadir y eliminar una sección
function addSection($tramosContainer){
    var $tramoTemplate = $($('#tramo-template').html());
    $tramosContainer.append($tramoTemplate);
    console.log('Se añadió una sección')
}

function removeSection($seccion){
    $seccion.remove();
    console.log('Se eliminó una sección')
}
    
