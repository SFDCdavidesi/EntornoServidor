<?php
if ($mostrarheaderyfooter) {
    include(__DIR__ . '/header.php');
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div id="listado_cursos" class="container">
    <div class="row justify-content-center">
        <table id="listadoCursos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>

                    <th scope="col">#</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Duración</th>
                </tr>
            </thead>
        </table>
    </div>



</div>
<script>

$(document).ready(function() {
 var $tablalistado = $('#listadoCursos').DataTable({
    "paging": true,
        "pageLength": 10,

        "ajax": {
            "url": "<?=$urlws?>?action=get_cursos",
            "type": "GET",
            "dataSrc": ""
        },
        "select": false,       
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json"
        },
         // Agrega una columna para los botones de edición
         "columnDefs": [{
                    "targets": -1, // Última columna
                    "data": null,
                    "defaultContent": "<button class='btnEditar'>Editar</button>"
                }],
        "columns": [{
                "data": "id"
            },
            {
                "data": "titulo"
            },
            {
                "data": "ubicacion"
            },
   
             {
                        // Combina nombre y edad en una sola columna
                        "data": null,
                        "render": function (data, type, row) {
                            return data.duracion + ' ' + data.unidadDuracion + '';
                        }
                   
            }
            <?php
            if (esadmin()) {
                ?>
            ,            
            {
                "data":  "<button class='btnEditar' >Editar</button>"
            }
            <?php
            }
            ?>
        ]
        });


        $('#listadocursos').on('hover', 'tbody tr', function() {
            $(this).css('cursor', 'pointer');
            $(this).css('background-color', 'lightgray');
        });
        $('#listadoCursos').on('click', 'tbody tr button', function() {
           $.ajax({
                type: "GET",
                url: "<?=$urlws?>?action=get_curso&id=" + $(this).closest('tr').find('td').eq(0).text(),
                success: function(data) {
                    data = typeof data === 'string' ? JSON.parse(data) : data;
                    if (data.length>0){
                    data=data[0];
                    }
                  
                    $("#titulo").val(data.titulo);
                    $("#entradilla").val(data.entradilla);
                    $("#descripcion").val(data.descripcion);
                    $("#id_lugar").val(data.lugar_id);
                    $("#duracion").val(data.duracion);
                    $("#unidadDuracion").val(data.medida_tiempo);
                    $("#activo").val(data.activo);
                    

                    //obtenemos las fotos
                    $.ajax({
                        type: "GET",
                        url: "<?=$urlws?>?action=get_fotos_curso&id=" + data.id,
                        success: function(data) {
                            data = typeof data === 'string' ? JSON.parse(data) : data;
                            //recorremos el array obtenido con las fotos y preseleccionamos el select
                            data.forEach(function(data) {
                                $("#fotos option[value='" + data.foto + "']").prop('selected', true);
                            });
                        }
                    });

                    //cambiamos el texto del botón submit a modificar
                    $('button[type="submit"]').text('Modificar');
                    //mostramos un alert cuando se hace click en el botón de limpiar
                    $('button[type="reset"]').click(function() {
                        $('button[type="submit"]').text('Registrar Curso');
                    });
                    //creamos un campo hidden con el id del curso y lo adjuntamos al formulario
                    var idCurso = $("<input>").attr("type", "hidden").attr("name", "id").val(data.id);
                    $('#cursoForm').append(idCurso);
                    //cambiamos el evento submit del formulario para que haga un update en lugar de un insert
      
                }
            });
});

        
});



</script>
<?php
if ($mostrarheaderyfooter) {
    include(__DIR__ . '/footer.php');
}
?>