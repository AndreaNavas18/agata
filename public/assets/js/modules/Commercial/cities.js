$(document).ready(function() {
    // Funcion para cargar ciudades según el departamento
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
                    citySelect.val(selectedCityId); // Establecer el valor seleccionado
                    citySelect.selectpicker('refresh');  // Refrescar el selectpicker después de cargar las opciones
                    console.log('si entrouuu');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            console.log('No hay nada seleccionado');
            var citySelect = $('#' + citySelectId);
            citySelect.empty();
            citySelect.append('<option value="">--Seleccione--</option>');
            citySelect.selectpicker('refresh');
        }
    }
 // Función para manejar la creación
    function handleCreate() {
        $('#department_id_create').on('change', function() {
            var departmentId = $(this).val();
            var citySelectId = 'city_id_create';
            loadCities(departmentId, citySelectId);
        });
    }

    // Función para manejar la edición
    function handleEdit() {
        $('[id^=department_id_]').each(function() {
            var departmentId = $(this).val();
            var citySelectId = $(this).data('city-select-id');
            var selectedCityId = $('#' + citySelectId).data('selected-city-id');
            if (selectedCityId) {
                loadCities(departmentId, citySelectId, selectedCityId);
            }

            $(this).on('change', function() {
                departmentId = $(this).val();
                citySelectId = $(this).data('city-select-id');
                loadCities(departmentId, citySelectId);
            });
        });
    }

    // Llamar las funciones correspondientes
    handleCreate();
    handleEdit();
});


