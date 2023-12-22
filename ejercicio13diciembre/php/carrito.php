<?php
require_once "configuracion.php";
require_once "C_SQL.php";
require_once "funciones.php";
$bd = new BBDD();

if (isset($_SESSION["listadolibros"])){
    pintacarrito($_SESSION["listadolibros"]);
}
?>