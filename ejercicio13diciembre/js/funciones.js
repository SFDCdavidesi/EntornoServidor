function muestra(divname)
{
    let divAMostrar=document.getElementById(divname);
    divAMostrar.classList.remove('d-none');
 //   oculta(divname=='registro'?'login':'registro');

}
function oculta(divname){
    let divAMostrar=document.getElementById(divname);
   // alert (divAMostrar);
    divAMostrar.classList.add('d-none');
}
function recarga(){
let direccion=document.location.href.toString();
let hasta=direccion.indexOf('&');
let leftPart = direccion.substring(0, hasta);
document.location=leftPart;
}
function ponUsuario(usu){
    document.getElementById('usuariomsg').innerHTML=usu;
    usuario=usu;
}


$(document).ready(function() {
    $('#confirmaEliminaUsuario').click(function(){

        $.ajax({
            type: "POST",
            url: "php/eliminarUsuarios.php",
            data: { usuarioAEliminar: usuario }
        }).done(function( msg ) {
            alert( "Usuario eliminado: " + msg );
recarga();
        });
    });
});
