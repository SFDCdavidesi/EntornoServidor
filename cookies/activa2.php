<?php
function cookiesActivadas():bool
{
    $activas=false;
    if (isset($_COOKIE['nombre'])){
        $activas=true;
    }
    return $activas;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if (cookiesActivadas()){
        echo "Las cookies están activas";
    }else{
        echo "Las cookies están desactivadas";
    }
    ?>
    <br>
    <p>
        <a href="activa1.php">Volver</a>
        <br><a href="borra.php">Borrar Cookies</a>
    </p>
</body>
</html>