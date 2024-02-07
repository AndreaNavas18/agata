
function deleteCampo(id) {
    $(`#contact-content${id}`).remove();
}

$('#contact-add').on('click', function() {
    var typesContacts              = JSON.parse($('#typesContacts').val());
    var cities                     = JSON.parse($('#cities').val());
    var num_contact_content        = $('.data-contacts').length + 1;

    $('#contact-content').append(`
        <div class="data-contacts" id="contact-content${num_contact_content}">
            <div class="border-bottom border-1 border-secondary mt-2 mb-2"></div>
            <div class="row">
                <div class="col-12 mb-2 mt-3">
                    <h5>
                        <b class="font-weight-bold">Contacto ${num_contact_content}</b>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Tipo de contacto
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                        <select class="form-control
                            selectpicker"
                            data-live-search="true"
                            name="type_contact_id[]"
                            id="type_contact_id${num_contact_content}"
                            required>
                            <option value="">--Seleccione--</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Ciudad
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                        <select class="form-control
                            selectpicker"
                            data-live-search="true"
                            name="city_contact_id[]"
                            id="city_contact_id${num_contact_content}"
                            required>
                            <option value="">--Seleccione--</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4  mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Nombre
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                    <input type="text"
                            name="name_contact[]"
                            class="form-control"
                            required>
                    </div>
                </div>

                <div class="col-md-4  mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Telefono fijo
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                    <input type="text"
                            name="home_phone_contact[]"
                            class="form-control">
                    </div>
                </div>

                <div class="col-md-4  mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Telefono movil
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                    <input type="text"
                            name="cell_phone_contact[]"
                            class="form-control"
                            required>
                    </div>
                </div>

                <div class="col-md-4  mb-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Correo Electronico
                            <i class=" fa fa-asterisk small text-danger"></i>
                        </label>
                    <input type="text"
                            name="email_contact[]"
                            class="form-control"
                            required>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col align-self-end">
                    <button class="btn btn-danger btn-sm loading"
                        type="button"
                        onclick="deleteCampo(${num_contact_content});">
                        <i class="fas fa-trash"></i>
                        Eliminar contacto ${num_contact_content}
                    </button>
                </div>
            </div>
        </div>
    `);

    typesContacts.forEach(element => {
        $("#type_contact_id"+num_contact_content).append('<option value="'+ element['id'] +'">'+ element['name'] +'</option>')
    });

    cities.forEach(element => {
        $("#city_contact_id"+num_contact_content).append('<option value="'+ element['id'] +'">'+ element['name'] +'</option>')
    });

    $("#type_contact_id"+num_contact_content).selectpicker('refresh');
    $("#city_contact_id"+num_contact_content).selectpicker('refresh');
})


function deleteContactForm() {
     // Abre una ventana de confirmación
     var confirmacion = confirm("¿Estás seguro que deseas eliminar este registro?");

     // Si el usuario hace clic en "Sí", redirige al enlace
     if (confirmacion) {
         window.location.href = event.target.href;
     }
}

