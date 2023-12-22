<?php
require_once "configuracion.php";
require_once "C_SQL.php";
require_once "funciones.php";
$bd = new BBDD();
$resultado=$bd->getLibros();
?>
<div class="col">
    <table class="table table-striped">
        <?php  
            pintalibros($resultado);
            ?>
    </table>
</div>
<div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-info" onclick="muestra('formulariolibros');">Crear</button>

            </div>