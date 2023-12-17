<?php
require_once "configuracion.php";
require_once "C_SQL.php";
require_once "funciones.php";

$accion=$_REQUEST["accion"];
$bdaccion= new BBDD();
$msg="";
switch($accion){
    case "altaAutor":
        $resultadoaccion=$bdaccion->altaAutor($_REQUEST);
        $msg="Alta";
        break;
    case "altaLibro":
        $resultadoaccion=$bdaccion->altaLibro($_REQUEST);
        $msg="Alta";
        break;
    case "modificarLibro":
        $resultadoaccion=$bdaccion->modificarLibro($_REQUEST);
        $msg="Modificación";
        break;
     case "eliminarLibro":
          $resultadoaccion=$bdaccion->eliminarLibro($_REQUEST["codigo"]);
          $msg="Eliminación";
          break;
}

?>

