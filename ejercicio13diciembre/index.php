<!DOCTYPE html>
<?php
require_once("php/header.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_REQUEST["accion"])){
        require_once("php/acciones.php");
    }
    require_once("php/muestralibros.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
            <button type="button" class="btn btn-info" onclick="muestra('formulariolibros');">Crear</button>

            </div>
        </div>
    </div>
    <div class="container d-none" id="formulariolibros">
        <?php
        include_once("php/formularioLibros.php");
        ?>
    </div>

</body>
</html>