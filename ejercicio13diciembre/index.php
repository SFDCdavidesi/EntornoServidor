<!DOCTYPE html>
<?php
require_once("php/header.php");
require_once("php/funciones.php");
require_once("php/navegacion.php");

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <?=pintaBarraDeNavegacion($_COOKIE["usuario"]);?>

        <div class="row">
            <?php
            if (isset($_REQUEST["accion"])) {
                require_once("php/acciones.php");
            }
            switch($navega){
                case "catalogo":
                    require_once("php/catalogo.php");
                    break;
                case "vercarrito":
                    require_once("php/carrito.php");
                    break;  
                default:
                     require_once("php/muestralibros.php");

            }
            ?>
        </div>


        </div>
        <?php
        if (isset($resultadoaccion)) {
            include "php/mensajeacciones.php";
        }
        ?>

        <div class="row d-none" id="formulariolibros">
            <div class="col">
                <?php
        include("php/formularioLibros.php");
        ?>
            </div>
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