
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
   $_SESSION["pathfolder"]=$pathfolder;
?>
<script src="https://unpkg.com/@popperjs/core@2"></script>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>



<link rel="stylesheet" href="<?=$pathfolder?>css/estilos.css">
<script src="<?=$pathfolder?>js/funciones.js"></script>
