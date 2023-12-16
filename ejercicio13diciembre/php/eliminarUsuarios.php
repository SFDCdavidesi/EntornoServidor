<?php
require_once "configuracion.php";
require_once "C_SQL.php";
$bd = new BBDD();
;

if ($bd->eliminaUsuario($_REQUEST["usuarioAEliminar"])){
    echo "Usuario eliminado correctamente";
}else{
    echo "ha ocurrido un error al dar de alta el usuario:" . $bd->muestraErrores();
}
?>