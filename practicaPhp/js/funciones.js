function muestra(divname)
{
    let divAMotrar=document.getElementById(divname);
    divAMotrar.classList.remove('oculto');
    oculta(divname=='registro'?'login':'registro');

}
function oculta(divname){
    let divAMotrar=document.getElementById(divname);
    divAMotrar.classList.add('oculto');}
function recarga(){
let direccion=document.location.href.toString();
let hasta=direccion.indexOf('&');
let leftPart = direccion.substring(0, hasta);
document.location=leftPart;
}
function eliminausuario(u){
    alert(usuario);
    $.ajax({
        type: "POST",
        url: "eliminarUsuario.php",
        data: { usuario: usuario }
    }).done(function( msg ) {
        alert( "Usuario eliminado: " + msg );
    });
    
}