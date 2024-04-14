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
    <?php
    if (isset ($_SESSION) && isset($_SESSION['rol']) && $_SESSION['rol'] == "admin") {
    ?>
    <div class="row">
        <div class="col-12 text-center">
            <a href="./?action=alta_actividades" class="btn btn-primary">Dar de alta actividades</a>
        </div>
    </div>
    <?php
    }
    ?>




</div>


<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-content">
                <div id="fotos">
                    <div class="item"><img src="https://via.placeholder.com/150" alt="Imagen 1"></div>
                </div>

            </div>
            <div class="modal-body ">

                <table class="table mt-3">
                    <tbody>
                        <tr>
                            <th>Título</th>
                            <td id="titulo"></td>
                        </tr>
                        <tr>
                            <th>Entradilla</th>
                            <td id="entradilla"></td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td id="descripcion"></td>
                        </tr>
                        <tr>
                            <th>Nivel Requerido</th>
                            <td id="nivel_requerido"></td>
                        </tr>
                        <tr>
                            <th>Lugar</th>
                            <td id="lugar"></td>
                        </tr>
                        <tr>
                            <th>Número de Plazas</th>
                            <td id="numero_plazas"></td>
                        </tr>
                        <tr>
                            <th>Duración</th>
                            <td id="duracion"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
               <?php
               if (isset($_SESSION) && isset($_SESSION["rol"])){?> <button type="button" class="btn btn-secondary" id="inscribirme"  >Inscribirme</button>
               <?php
               }
               ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>
<script>
var calendar = $("#calendar").calendarGC({
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
        'Octubre', 'Noviembre', 'Diciembre'
    ],
    dayBegin: 1,
    date: new Date(),
    onclickDate: function(e, data) {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalFullscreenXxl'), {
            keyboard: false
        })
        myModal.show();
        console.log(e, data);

    }


});
let hoy = new Date();
let anio = hoy.getFullYear();
let mes = hoy.getMonth();
mes++;
if (mes < 10) {
    mes = "0" + mes;
}
let dia = hoy.getDate();
if (dia < 10) {
    dia = "0" + dia;
}
let diaHoy = anio + "-" + mes + "-" + dia;
//calendar.setDate(anio + "-" + mes+ "-" + dia);
var mesActual;

$(document).ready(function() {
    $("#detalleCursoContenido").hide();
    if (mesActual == undefined) {
        mesActual = new Date().getMonth();
    }
    //obtenemos los calendarios del mes actual
    calendar.setDate(diaHoy);

<?php
if (isset($_SESSION) && isset($_SESSION["rol"])) { ?>
$("#inscribirme").click(function(){
    console.log("inscribirme en el curso "+cursoseleccionado);
});

    <?php
}?>
    $.ajax({
        url: "<?=$urlws?>?action=get_calendarios",
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            let eventosObtenidos = [];
            data.forEach(function(calendario) {
                var fecha = new Date(calendario.fecha);
                var evento = {
                    date: fecha,
                    eventName: calendario.curso,
                    className: "badge bg-info",
                    dateColor: "red",
                    idCurso: calendario.idcurso,
                    onclick: function(e, data) {
                        muestraDatosCurso(data.idCurso)
                    }
                };
                eventosObtenidos.push(evento);
            });
            if (eventosObtenidos.length > 0) {
                calendar.setEvents(eventosObtenidos);
            }
        }
    });


});

function obtener_cursos() {
    $.ajax({
        url: "<?=$urlws?>?action=get_cursos",
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            data.forEach(function(curso) {
                $("#curso").append(`<option value="${curso.id}">${curso.titulo}</option>`);
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}
var cursoseleccionado;
function muestraDatosCurso(idCurso) {

    $("#infoModal").modal('show');
    cursoseleccionado = idCurso;
    $.ajax({
        url: "<?=$urlws?>?action=get_curso&id=" + idCurso,
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data);
            let curso = data[0];
            $("#titulo").html(curso.titulo);
            $("#entradilla").html(curso.entradilla);
            $("#descripcion").html(curso.descripcion);
            //obtenemos el nivel requerido
            $.ajax({
                url: "<?=$urlws?>?action=get_nivel_requerido&id=" + curso.nivel_requerido,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    let nivel = data[0];
                    console.table(nivel);
                    $("#nivel_requerido").html(nivel.nombre);
                }
            });

            $("#lugar").html(curso.ubicacion);
            $("#numero_plazas").html(curso.numero_plazas);
            $("#duracion").html(curso.duracion + " " + curso.unidadDuracion);


            //obtenemos las fotos del curso
            cargarFotos('#fotos', idCurso);

        }
    });
}
var arrayfotos = [];
var currentIndex = 0;

function cargarFotos(idcarrusel, idcurso) {
    currentIndex = 0;
    $.ajax({
        url: "<?=$urlws?>?action=get_fotos_curso&id=" + idcurso,
        type: "GET",
        dataType: "json",

        success: function(data) {
           arrayfotos=[];
            for (let i = 0; i < data.length; i++) {
                arrayfotos.push(data[i].foto);
            }




            // Llamamos a la función inicialmente para mostrar la primera foto
            mostrarSiguienteFoto();

            // Llamamos a la función cada 3 segundos para mostrar la siguiente foto
            if (arrayfotos.length > 1){
                setInterval(mostrarSiguienteFoto, 3000);

            }else if (arrayfotos.length==0) {
                $('#fotos').empty();

            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error al cargar las fotos:", errorThrown);
        }
    });
}
// Función para mostrar la siguiente foto en el div "fotos"
function mostrarSiguienteFoto() {
    $('#fotos').empty(); // Limpiamos el div antes de agregar la nueva foto
    $('#fotos').append('<img src="' + arrayfotos[currentIndex]+
        '" class="img-responsive" style="max-width: 300px; height: auto;">');
    currentIndex = (currentIndex + 1) % arrayfotos.length; // Avanzamos al siguiente índice (circular)
}
</script>
<?php
include_once 'footer.php';
?>