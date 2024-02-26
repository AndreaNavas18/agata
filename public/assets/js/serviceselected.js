// Load the selected service id into the form

document.querySelectorAll('.createforservice').forEach(button => {
    button.addEventListener('click', function() {
        const serviceId = this.getAttribute('data-id');
        document.getElementById('selected_service_id').value = serviceId;
        //quiero imprimir algo en consola para saber que este script si esta corriendo 
        console.log('Service ID: ' + serviceId);
    });
});
