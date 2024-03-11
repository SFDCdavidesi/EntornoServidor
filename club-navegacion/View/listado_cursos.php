<?php

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
function muestraCursos() {

    $.ajax({
        type: "GET",
        url: "<?=$urlws?>?action=get_cursos",
        success: function(data) {
            // Llena la tabla con los datos recibidos
            $('#listadoCursos').DataTable({
                data: data,
      

                language: {
                    url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
                },

                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'titulo'
                    },
                    {
                        data: 'ubicacion'
                    },
                    {
                        data: 'duracion'
                    },
                    {
                        data: 'unidadDuracion'
                    }

                    // Agrega más columnas según tus necesidades
                ],
                // Configura opciones de paginación, búsqueda, etc.
                paging: true,
                pageLength: 10, // Número de filas por página
                // Agrega más opciones según tus necesidades
            });
        }
    });

}
$(document).ready(function() {
 var $tablalistado = $('#listadoCursos').DataTable({
    "paging": true,
        "pageLength": 10,

        "ajax": {
            "url": "<?=$urlws?>?action=get_cursos",
            "type": "GET",
            "dataSrc": ""
        },
            
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json"
        },
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
                "data": "duracion"
            },
            {
                "data": "unidadDuracion"
            }]
        });

        quit
});



</script>