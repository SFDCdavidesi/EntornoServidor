<?php
require_once "configuracion.php";
require_once "C_SQL.php";
$bd = new BBDD();
$resultado=$bd->getLibros();
var_dump($resultado);

?>