function agregarPersona() {
    const personasDiv = document.getElementById('personas');
    const nuevaPersona = `
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombres[]">
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select class="form-control" name="sexos[]">
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select>
        </div>
    `;
    personasDiv.innerHTML += nuevaPersona;
}