function validaAltaUsuario(){
    
    let f = document.getElementById('add__form');
    let errores =[];
    if (f.usuario.value.length<1){
        errores[errores.length]="El usuario no puede estar vacío";
    }
    if (f.password.value.length<1){
        errores[errores.length]="La contraseña no puede estar vacía";

    }
    if (f.password.value!=f.password2.value){
        errores[errores.length]="Las contraseñas no coinciden";

    }
if(f.nombre.value.length<1){
    errores[errores.length]="El nombre no puede estar vacío";

}
if (f.apellidos.value.length<1){
    errores[errores.length]="Los apellidos no pueden estar vacíos";

}
if (f.email.value.length<3){
    errores[errores.length]="El email no puede estar vacío";

}else{
    //validamos email
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // Se realiza la validación
    if(! regex.test(f.email.value)){
        errores[errores.length]="El email no es correcto";
    }
}

if (errores.length>0){
    alert(errores);
    return false;
}
return true;
}