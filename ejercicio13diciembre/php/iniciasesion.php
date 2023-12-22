<?php
require_once "configuracion.php";
require_once "C_SQL.php";
$bd = new BBDD();
        if ($bd->validaUsuario($_REQUEST['nombreDeUsuario'],$_REQUEST['pass1'])){
            /**
                $_SESSION['usuario']=$_REQUEST['nombreDeUsuario'];
                $_SESSION['password']=password_hash($_REQUEST['pass1'],PASSWORD_DEFAULT);
            */
            setcookie("usuario", $_REQUEST['nombreDeUsuario'], time() + 3600*24, "/"); // si el usuario es correcto guardamos una cookie por 1 día
            header("Location: ../index.php");
        }else{
            ?>
            <div class="container-fluid">
            <div class="alert alert-danger" role="alert">
            <p>Combinación de usuario y contraseña incorrecta. </p>
      
    </div>
        </div>
            <?php
        }

?>