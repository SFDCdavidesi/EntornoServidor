function validateLoginForm(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    if (email == "" || password == ""){
        alert("Debe completar todos los campos");
        return false;
    }
    return true;

}
function validateRegisterForm() {
    
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordconfirm = document.getElementById("passwordconfirm").value;


    if (email == "") {
        alert("El email no puede estar vacío");
        return false;
    }
    if (password == "") {
        alert("La contraseña no puede estar vacía");
        return false;
    }
    if (passwordconfirm == "") {
        alert("La confirmación de la contraseña no puede estar vacía");
        return false;
    }
    if (password.length < 6) {
        alert("El tamaño de la contraseña no puede ser menor de 6 caracteres");
        return false;
    }
    if (password != passwordconfirm) {
        alert("Las contraseñas no coinciden");
        return false;
    }
    return true;
}