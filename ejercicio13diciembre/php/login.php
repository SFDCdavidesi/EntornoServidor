<?php
require_once "header.php";

?>
<div id="login" class="container-lg ">
    <fieldset>
        <legend>Login</legend>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" onsubmit="return validateFormLogin();" id="flogin">
        <input type="hidden" name="accion" value="login">
        <div class="mb-3">
    <label for="nombreDeUsuario" class="form-label">Nombre de usuario:</label>
    <input type="text" class="form-control" id="nombreDeUsuario" name="nombreDeUsuario" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Introduzca el nombre de usuario.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass1">
  </div>
    <input type="submit" value="Enviar">

        </form>
        
    </fieldset>
    <div class="d-md-inline-block">
    <a href="#" onclick="muestra('registro');oculta('login');">¿No tienes cuenta? Regístrate</a>
</div>
</div>
<div id="mensajes"></div>
<div id="registro" class="container-fluid text-center pt-3 d-none">
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
    <a href="#" onclick="muestra('login');oculta('registro');">¿Ya tienes cuenta? Haz login aquí</a>
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