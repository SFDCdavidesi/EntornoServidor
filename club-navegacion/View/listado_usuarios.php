<?php
if ($mostrarheaderyfooter) {
    include(__DIR__ . '/header.php');
}
//iniciamos la sesión
$token=$_SESSION['token'];
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>


<div id="listado_usuarios" class="container">
    <div class="row justify-content-center">
    <div class="table-responsive">
    <table id="listadoUsuarios" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
            </tr>
        </thead>
        <tbody>
        <!-- Aquí se agregarán dinámicamente las filas de la tabla -->
    </tbody>
    </table>
    
</div>


    </div>



</div>

<!-- modal para confirmar el borrado del usuario -->

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmar acción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas borrar el usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="noBtn" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="siBtn">Sí</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    fetch('http://localhost/club-navegacion/api/ws.php?action=get_usuarios&token=<?php echo $token ?>')
    .then(response => response.json())
    .then(data => {
        // Llenar la tabla con los datos recibidos
        $.each(data, function(index, usuario) {
            $('#listadoUsuarios tbody').append(
                '<tr>' +
                    '<td>' + usuario.id_usuario + '</td>' +
                    '<td>' + usuario.nombre + '</td>' +
                    '<td>' + usuario.apellidos + '</td>' +
                    '<td>' + usuario.email + '</td>' +
                    '<td>' + usuario.rol + '</td>' +
                '</tr>'
            );
        });
    })
    // Hacer la solicitud AJAX
    $.ajax({
        url: 'http://localhost/club-navegacion/api/ws.php?action=get_usuarios&token=<?php echo $token ?>',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
data= data.json();

            // Llenar la tabla con los datos recibidos
            $.each(data, function(index, usuario) {
                $('#listadoUsuarios tbody').append(
                    '<tr>' +
                        '<td>' + usuario.id_usuario + '</td>' +
                        '<td>' + usuario.nombre + '</td>' +
                        '<td>' + usuario.apellidos + '</td>' +
                        '<td>' + usuario.email + '</td>' +
                        '<td>' + usuario.rol + '</td>' +
                    '</tr>'
                );
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error en la solicitud AJAX:', textStatus, errorThrown);
        }
    });
});



</script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if ($mostrarheaderyfooter) {
    include(__DIR__ . '/footer.php');
}
?>