<?php
require_once "configuracion.php";
require_once "C_SQL.php";
$bd = new BBDD();
$usuario["nombre"]=$_REQUEST["nombre"];
$usuario["apellido"]=$_REQUEST["apellido"];

$usuario["email"]=$_REQUEST["email"];

$usuario["nombreDeUsuario"]=$_REQUEST["nombreDeUsuario"];
$usuario["pass1"]=$_REQUEST["pass1"];

if ($bd->altaUsuario($usuario)){
    pintaMensaje( "Alta usuario","Usuario creado correctamente");
}else{
 
    pintaMensaje("Error en Alta de Usuario","ha ocurrido un error al dar de alta el usuario:" . $bd->muestraErrores());
}
?>