<?php
require_once "header.php";

?>
<div id="login">
    <fieldset>
        <legend>Login</legend>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" onsubmit="return validateFormLogin();" id="flogin">
        <input type="hidden" name="accion" value="login">
        <label for="nombreDeUsuario">Nombre de usuario:</label>
    <input type="text" name="nombreDeUsuario"><br><br>
    <label for="pass1">Contraseña</label>
    <input type="password" name="pass1"><br><br>
    <input type="submit" value="Enviar">

        </form>
    </fieldset>
    <div class="d-md-inline-block">
    <a href="#" onclick="muestra('registro')">¿No tienes cuenta? Regístrate</a>
</div>
</div>
<div id="mensajes"></div>
<div id="registro" class="oculto">
    <fieldset>
        <legend>Registro</legend>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="fregistro" name="registro"  onsubmit="return validateFormRegistro();">
        <input type="hidden" name="accion" value="registro">
        <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"><br><br>
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido"><br><br>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="usuario">Nombre de usuario:</label>
    <input type="text" name="nombreDeUsuario"><br><br>
    <label for="pass1">Contraseña</label>
    <input type="password" name="pass1"><br><br>

<label for="pass1">Repita Contraseña</label>
    <input type="password" name="pass2"><br><br>
    <input type="submit" value="Enviar">
    <input type="reset" value="Borrar formulario">
    
        </form>
    </fieldset>
    <div class="d-md-inline-block">
    <a href="#" onclick="muestra('login')">¿Ya tienes cuenta? Haz login aquí</a>
</div>
</div>
<?php
if (isset($_REQUEST) && isset($_REQUEST['accion']) ){
    if ( $_REQUEST['accion']=="registro"){
    require_once("altaUsuarios.php");
    ?>
    <script>
        muestra('registro');
    </script>
    <?php
    }else if ($_REQUEST['accion']=="login" && isset($_REQUEST["nombreDeUsuario"]) && strlen($_REQUEST["nombreDeUsuario"]>3)){
            require_once("iniciasesion.php");
        }
    }

?>