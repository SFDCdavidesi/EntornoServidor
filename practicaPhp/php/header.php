
<?php
session_start();
    if (!isset($_SESSION['usuario'])){

        //usuario no autenticado
        //redirigimos a la página de Login
        if (!str_ends_with($_SERVER['PHP_SELF'],'login.php')){
             header("Location: php/login.php");
        }
    }
    $pathfolder=(!str_ends_with($_SERVER['PHP_SELF'],'login.php'))?"":"../";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?=$pathfolder?>css/estilos.css">
<script src="<?=$pathfolder?>js/validaciones.js"></script>
<script src="<?=$pathfolder?>js/funciones.js"></script>
<?=$pathfolder?>