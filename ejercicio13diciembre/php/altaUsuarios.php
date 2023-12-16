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
    echo "Usuario creado correctamente";
}else{
    echo "ha ocurrido un error al dar de alta el usuario:" . $bd->muestraErrores();
}
?>