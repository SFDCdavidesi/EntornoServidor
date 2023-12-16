console.log("entrando en js");
var errores = Array();
function validateFormLogin() {
    errores = Array(); // inicializamos errores
    document.getElementById("mensajes").innerHTML = "";

  let f = document.getElementById("flogin");
  let pass = f.pass1.value;
  let username = f.nombreDeUsuario.value;
  if (username.length < 3) {
    errores[errores.length] = "El nombre de usuario no puede estar vacío";
  }
  if (pass == "") {
    errores[errores.length] = "La contraseña no puede estar vacía";
  } else if (pass.length < 8) {
    errores[errores.length] =
      "El tamaño de la contraseña no puede ser inferior a 8 caracteres";
  }
  if (errores.length > 0) {
    pintaErrores();
    return false;
  } else {
    return true;
  }
}
function validateFormRegistro() {
  let f = document.getElementById("fregistro");
  errores = Array(); // inicializamos errores
  document.getElementById("mensajes").innerHTML = "";
  let nombre = f.nombre.value;
  let pass1 = f.pass1.value;
  let pass2 = f.pass2.value;
  let username = f.nombreDeUsuario.value;
  let apellido = f.apellido.value;
  let correo = f.email.value;
  if (nombre == "" || nombre.length < 2) {
    errores[errores.length] = "El nombre no puede estar vacío";
  }
  if (apellido == "" || apellido.length < 2) {
    errores[errores.length] = "El apellido no puede estar vacío";
  }
  if (correo == "") {
    errores[errores.length] = "El correo no puede estar vacío";
  }
  if (pass1 == "" || pass2 == "") {
    errores[errores.length] = "Las contraseñas no pueden estar vacías";
  } else if (pass1 != pass2) {
    errores[errores.length] = "Las contraseñas no coinciden";
  } else if (pass1.length < 8) {
    errores[errores.length] =
      "El tamaño mínimo de contraseña es de 8 caracteres";
  }
  if (errores.length > 0) {
    pintaErrores();
    return false;
  } else {
    return true;
  }
}
function pintaErrores() {
  let destino = document.getElementById("mensajes");
  let lista = document.createElement("ul");

  if (errores.length > 0) {
    errores.forEach((e) => {
      let msg = document.createTextNode(e);
      let li = document.createElement("li");
      li.appendChild(msg);
      lista.appendChild(li);
    });
    destino.appendChild(lista);
  }
}
function validateFormEditar(){

  let f = document.getElementById('formeditar');
  if (f.pass.value.length<8){
    errores[errores.length]='La contraseña tiene que tener un valor mínimo de 8';
  }else if (f.pass.value != f.pass2.value){
    errores[errores.length]='Las contraseñas no coinciden';
  }
  if (f.nombre.value<3){
    errores[errores.length]='El nombre no puede estar vacío';
  }
  if (f.apellidos.value<3){
    errores[errores.length]='El apellido no puede estar vacío';
  }
  if (f.correo.length<3){
    errores[errores.length]='El correo no puede estar vacío';
  }
  if (errores.size()>0){
    alert(errores);
    return false;
  }
  return true;
}
