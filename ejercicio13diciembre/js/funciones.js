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

function modificalibro(codigolibro){
let url=window.location.href;
let aux=url.split('?');
    
    url =aux[0] + '?verFormulario=modificarLibro&codigo_libro=' + codigolibro;
window.location.href=url;
}
function eliminalibro(codigolibro){
    let url=window.location.href;
    let aux=url.split('?');
    
    url =aux[0] + '?accion=eliminarLibro&codigo=' + codigolibro;
   if (confirm("¿Está seguro de querer eliminar el libro con código " + codigolibro + "?")){
    window.location.href=url;
   } 
    }