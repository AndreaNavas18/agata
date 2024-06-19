// $(document).ready(function() {
//     $('#department_id').on('change', function() {
//         var departmentId = $(this).val();
//         if (departmentId) {
//             $.ajax({
//                 url: '/obtener-ciudades/' + departmentId,
//                 type: 'GET',
//                 dataType: 'json',
//                 success: function(data) {
//                     $('#city_id').empty();
//                     $('#city_id').append('<option value="">--Seleccione--</option>');
//                     $.each(data, function(key, value) {
//                         $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
//                     });
//                     $('#city_id').selectpicker('refresh');
//                 },
//                 error: function(xhr, status, error) {
//                     console.error('Error:', error);
//                 }
//             });
//         } else {
//             $('#city_id').empty();
//             $('#city_id').append('<option value="">--Seleccione--</option>');
//             $('#city_id').selectpicker('refresh');
//         }
//     });
// });

$(document).ready(function() {
    function loadCities(departmentId, citySelectId, selectedCityId = null) {
        if (departmentId) {
            $.ajax({
                url: '/obtener-ciudades/' + departmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var citySelect = $('#' + citySelectId);
                    citySelect.empty();
                    citySelect.append('<option value="">--Seleccione--</option>');
                    $.each(data, function(key, value) {
                        citySelect.append('<option value="' + value.id + '"' + (value.id == selectedCityId ? ' selected' : '') + '>' + value.name + '</option>');
                    });
                    citySelect.selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            var citySelect = $('#' + citySelectId);
            citySelect.empty();
            citySelect.append('<option value="">--Seleccione--</option>');
            citySelect.selectpicker('refresh');
        }
    }

    // Evento change para cualquier select de departamento
    $(document).on('change', '[id^=department_id]', function() {
        var departmentId = $(this).val();
        var citySelectId = $(this).data('city-select-id');
        loadCities(departmentId, citySelectId);
    });

    // Cargar ciudades en la edición al cargar la página
    $('[id^=department_id]').each(function() {
        var departmentId = $(this).val();
        var citySelectId = $(this).data('city-select-id');
        var selectedCityId = $('#' + citySelectId).data('selected-city-id');
        if (selectedCityId) {
            loadCities(departmentId, citySelectId, selectedCityId);
        }
    });
});
