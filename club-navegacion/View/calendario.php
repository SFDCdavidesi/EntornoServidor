<?php
include_once 'header.php';
?>
<link type="text/css" rel="stylesheet" href="../View/pluggins/calendar-gc.css" />
<script src="../View/pluggins/calendar-gc.js"></script>
<div id="calendario" class="container">
    <div class="row">
        <div class="col-12">
            <h1>Calendario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="calendar"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a href="./?action=alta_actividades" class="btn btn-primary">Dar de alta actividades</a>
        </div>
    </div>
    <div class="row" id="detalleCurso">
        <div class="col-12">
            <h2>Detalle del curso</h2>
            <div id="detalleCursoContenido"></div>
        </div>
    </div>
</div>
    <script>

var calendar = $("#calendar").calendarGC({
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes','Sábado'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    dayBegin:1,
    date: new Date(),
    onclickDate:function (e, data) {

      console.log(e, data);

    }


});
let hoy= new Date();
let anio=hoy.getFullYear();
let mes=hoy.getMonth();
mes++;
if (mes<10){
    mes="0"+mes;
}
let dia=hoy.getDate();
if (dia<10){
    dia="0"+dia;
}
let diaHoy=anio + "-" + mes+ "-" + dia;
//calendar.setDate(anio + "-" + mes+ "-" + dia);
var mesActual;

$(document).ready(function(){
    $("#detalleCursoContenido").hide();
    if (mesActual==undefined){
        mesActual=new Date().getMonth() + 1;
    }
    //obtenemos los calendarios del mes actual
    calendar.setDate(diaHoy);
    $.ajax({
        url: "<?=$urlws?>?action=get_calendarios",
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            let eventosObtenidos = [];
            data.forEach(function(calendario){
                var fecha=new Date(calendario.fecha);
                var evento={
                    date: fecha,
                    eventName: calendario.curso,
                    className: "badge bg-info",
                    dateColor: "red",
                    idCurso: calendario.idcurso,
                    onclick: function(e, data){
                        muestraDatosCurso(data.idCurso)
                    }
                };
                eventosObtenidos.push(evento);
            });
            if (eventosObtenidos.length>0){
            calendar.setEvents(eventosObtenidos);
            }
        }
    });
});

function muestraDatosCurso(idCurso){

    alert(idCurso);
    $.ajax({
        url: "<?=$urlws?>?action=get_curso&id=" + idCurso,
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            let curso=data[0];
            let contenido="<h3>"+curso.titulo+"</h3>";
            contenido+="<p>"+curso.entradilla+"</p>";
            contenido+="<p>"+curso.descripcion+"</p>";
            contenido+="<p>Nivel requerido: "+curso.nivel_requerido+"</p>";
            contenido+="<p>Duración: "+curso.duracion+" "+curso.medida_tiempo+"</p>";
            contenido+="<p>Plazas disponibles: "+curso.numero_plazas+"</p>";
            contenido+="<p>Plazas ocupadas: "+curso.inscritos+"</p>";
            contenido+="<p>Ubicación: "+curso.ubicacion+"</p>";
            contenido+="<p>Entidad: "+curso.entidad+"</p>";
            contenido+="<p>Fecha de inicio: "+curso.fecha_inicio+"</p>";
            contenido+="<p>Fecha de fin: "+curso.fecha_fin+"</p>";
            contenido+="<p>Precio: "+curso.precio+"</p>";
            $("#detalleCursoContenido").html(contenido);
            $("#detalleCursoContenido").show();
            $("#detalleCursoContenido").addClass("bg-info");
        }
    });
}
    </script>
<?php
include_once 'footer.php';
?>