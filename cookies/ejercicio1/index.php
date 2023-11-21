<!DOCTYPE html>
<html lang="en">
<head>
    <?php

if (isset($_COOKIE['color'])) {
?>
<style>
body{
    background:linear-gradient(to right(rgb(200,200,200),<?=$_COOKIE['color']?>);
}

</style>
<?php
}
?>
 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
<?php
foreach($_REQUEST as $k => $v){
    echo "<b>$k</b>$v<br>\r";
}
    if (isset($_REQUEST['color'])){
        setcookie("color",$_REQUEST['color'],3600);
        echo "Cookie asignada correctamente<br>";
        ?>
        <a href="#" onclick="window.location=window.location">Recargar</a>
  <?php
    }
    ?><br>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <label for="radios">Selecciona un color para el fondo</label><br>
    <input type="radio" name="color" value="green">Verde</input><br>
    <input type="radio" name="color" value="red">Rojo</input><br>
    <input type="radio" name="color" value="orange">Naranja</input><br>
    <input type="submit" value="cambiar color">
</body>
</html>