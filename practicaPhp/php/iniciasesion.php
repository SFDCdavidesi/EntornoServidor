<?php
require_once "configuracion.php";
require_once "C_SQL.php";
$bd = new BBDD();
        if ($bd->validaUsuario($_REQUEST['nombreDeUsuario'],$_REQUEST['pass1'])){
            $_SESSION['usuario']=$_REQUEST['nombreDeUsuario'];
            $_SESSION['password']=password_hash($_REQUEST['pass1'],PASSWORD_DEFAULT);
            header("Location: ../index.php");
        }

?>