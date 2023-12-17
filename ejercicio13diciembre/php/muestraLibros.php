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