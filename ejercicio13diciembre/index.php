<!DOCTYPE html>
<?php
require_once("php/header.php");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_REQUEST["accion"])) {
                require_once("php/acciones.php");
            }
            require_once("php/muestralibros.php");
            ?>
        </div>
        <?php
        if (isset($resultadoaccion)) {
            include "php/mensajeacciones.php";
        }
        ?>
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-info" onclick="muestra('formulariolibros');">Crear</button>

            </div>
        </div>
    
    <div class="row d-none" id="formulariolibros">
        <div class="col">
        <?php
        include("php/formularioLibros.php");
        ?>
        </div>
    </div>
    <?php
    if (isset($_REQUEST["verFormulario"]) && $_REQUEST["verFormulario"] == "modificarLibro") {
        $codigolibro = $_REQUEST["codigo_libro"];
    ?>
        <div class="container " id="formulariolibrosmodificar">
            <?php
            include("php/formularioLibrosModificar.php");
            ?>
        </div>
    <?php
    }
    ?>
</body>

</html>