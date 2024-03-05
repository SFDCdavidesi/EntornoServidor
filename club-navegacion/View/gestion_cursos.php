<?php
include(__DIR__ . '/header.php');
?>
<script>
$(document).ready(function() {
    $("#altaCurso").submit(function(e) {
        alert('hola ')
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?= $urlws ?>?action=alta_curso",
            data: new FormData($("#formulario")[0]),
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Curso dado de alta correctamente')
                console.log(response);
            }
        });
    });
});
</script>

<div class="container">
    <h1 class="mt-4 mb-4">Gestión de Cursos</h1>

    <!-- Formulario para dar de alta los cursos -->
    <div class="card mb-4">
        <div class="card-header">
            Dar de alta un curso
        </div>
        <div class="card-body">
            <form id="altaCurso" method="POST">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="nivel_requerido">Nivel requerido:</label>
                    <input type="number" class="form-control" id="nivel_requerido" name="nivel_requerido" min="1"
                        max="5">
                </div>
                <div class="form-group">
                    <label for="duracion">Duración:</label>
                    <input type="number" class="form-control" id="duracion" name="duracion">
                    <select class="form-control" id="medida_tiempo" name="medida_tiempo">
                        <?php
                       foreach($tiempos as $tiempo){
                          echo "<option value='".$tiempo["id"]."'>".$tiempo["nombre"]."</option>";
                       }
                       ?>
                    </select>
                    <div class="form-group">
                        <label for="lugar_id">ID del lugar:</label>
                        <select class="form-control" id="lugar_id" name="lugar_id">
                            <?php
                       foreach($lugares as $lugar){
                          echo "<option value='".$lugar["id"]."'>".$lugar["nombre"]."</option>";
                       }
                       ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="numero_plazas">Número de plazas:</label>
                        <input type="number" class="form-control" id="numero_plazas" name="numero_plazas">
                    </div>
                    <div class="form-group d-none">
                        <label for="inscritos">Número de inscritos:</label>
                        <input type="number" class="form-control" id="inscritos" name="inscritos">
                    </div>
                    <div class="form-group">
                        <label for="foto1">Foto 1:</label>
                        <input type="file" class="form-control" id="foto1" name="foto1">
                    </div>
                    <div class="form-group">
                        <label for="foto2">Foto 2:</label>
                        <input type="file" class="form-control" id="foto2" name="foto2">
                    </div>
                    <div class="form-group">
                        <label for="foto3">Foto 3:</label>
                        <input type="file" class="form-control" id="foto3" name="foto3">
                    </div>
                    <div class="form-group">
                        <label for="foto4">Foto 4:</label>
                        <input type="file" class="form-control" id="foto4" name="foto4">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Curso</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="mt-4 mb-4">Listado de Cursos</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Descripción</th>
                <th scope="col">Nivel requerido</th>
                <th scope="col">Lugar</th>
                <th scope="col">Número de plazas</th>
                <th scope="col">Número de inscritos</th>
                <th scope="col">Foto 1</th>
                <th scope="col">Foto 2</th>
                <th scope="col">Foto 3</th>
                <th scope="col">Foto 4</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($cursos as $curso){
                    echo "<tr>";
                    echo "<td>".$curso["id"]."</td>";
                    echo "<td>".$curso["titulo"]."</td>";
                    echo "<td>".$curso["descripcion"]."</td>";
                    echo "<td>".$curso["nivel_requerido"]."</td>";
                    echo "<td>".$curso["lugar_id"]."</td>";
                    echo "<td>".$curso["numero_plazas"]."</td>";
                    echo "<td>".$curso["inscritos"]."</td>";
                    echo "<td>".$curso["foto1"]."</td>";
                    echo "<td>".$curso["foto2"]."</td>";
                    echo "<td>".$curso["foto3"]."</td>";
                    echo "<td>".$curso["foto4"]."</td>";
                    echo "<td><a href='update_cursoForm.php?id=".$curso["id"]."'>Modificar</a> <a href='delete_curso.php?id=".$curso["id"]."'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
    <?php   
include(__DIR__ . '/footer.php');
?>