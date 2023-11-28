
<!DOCTYPE html>
<?php
include_once("php/header.php");
include_once "php/funciones.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones 3</title>
</head>

<body>
    <div class="container">
        <div class="row">
        <div class="col-sm-10 col-lg-10 menu-principal">
            <?php
    include_once("php/principal.php");
    ?>
        </div>
        <div class="col-sm-2 col-lg-2 menu-carrito">
            <?php
        include_once("php/carrito.php")
        ?>
            menu carrito
        </div>
        </div>
    </div>
</body>

</html>