<?php
require_once "configuracion.php";
require_once "C_SQL.php";
require_once "funciones.php";
$bd = new BBDD();

?>

  <div class="row" style="display: flex;" id="autores">
   <?php
   pintaListadoAutores($bd->getAutores());
   ?>
  </div>
<div class="row" id="catalogolibros">
    <?=pintaLibrosTarjetas($bd->getLibrosAutor($autor));?>
</div>
