$(document).ready(function(){
    var serviciosDisponibles = {};

    function cargarVelocidades(servicioId, $select) {
        $.ajax({
            url: '/obtener-anchos-de-banda',
            type: 'GET',
            data: { servicio_id: servicioId },
            success: function(response) {
                serviciosDisponibles[servicioId] = response;
                actualizarSelectIndividual($select, servicioId);
                console.log("Anchos de banda cargados:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener anchos de banda:", error);
            }
        });
    }

    function actualizarSelectIndividual($select, servicioId){
        $select.empty();
        $select.append($('<option>').text('--Seleccione--').attr('value', ''));

        var sortedBandwidths = serviciosDisponibles[servicioId].sort(function(a,b){
            return a.id - b.id;
        });

        $.each(sortedBandwidths, function(index, bandwidth){
            $select.append($('<option>').text(bandwidth.name).attr('value', bandwidth.id));
        });

        $select.selectpicker('refresh');
    }

    $('#name_service').change(function(){
        var servicioId = $(this).val();
        if(servicioId){
            console.log("Cargando anchos de banda para servicio:", servicioId);
            cargarVelocidades(servicioId, $('#bandwidth'));
        }else {
            $('#bandwidth').empty();
            $('#bandwidth').selectpicker('refresh');
        }
    });

    $('.selectpicker').selectpicker();

});