
function validateForm() {
    // Get values from form
    var nombre = document.getElementById("nombre").value;
    var apellidos = document.getElementById("apellidos").value;
    var telefono = document.getElementById("telefono").value;
    var fechaNacimiento = document.getElementById("fechaNacimiento").value;
    var email = document.getElementById("email").value;
    // Check if all fields are populated
    if (nombre == "" || apellidos == "" || telefono == "" || fechaNacimiento == "" || email == "") {
        alert("Por favor, rellene todos los campos.");
        return false;
    }

    // Check if telefono field contains just numbers
    if (!/^\d+$/.test(telefono)) {
        alert("El campo 'Teléfono' debe contener solo números.");
        return false;
    }

    // Check if email field contains an email
    if (!/\S+@\S+\.\S+/.test(email)) {
        alert("El campo 'Email' debe contener un email válido.");
        return false;
    }

    // Check if fecha de nacimiento is in the past
    var today = new Date();
    var fechaNacimientoDate = new Date(fechaNacimiento);
    if (fechaNacimientoDate >= today) {
        alert("La fecha de nacimiento debe ser en el pasado.");
        return false;
    }

    // If all checks pass, submit the form
    return true;
}