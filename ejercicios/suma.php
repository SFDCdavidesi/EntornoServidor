<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   
    $numero1=$_REQUEST["numero1"]?$_REQUEST["numero1"]:0;
    $numero2=$_REQUEST["numero2"]?$_REQUEST["numero2"]:0;
    $retUrl=$_REQUEST["retUrl"];
    $ejercicio=$_REQUEST["ejercicio"]?$_REQUEST["ejercicio"]:1;
   
    if ($numero1>0 || $numero2>0){
        echo "La suma de $numero1 y $numero2 es " . ($numero1+$numero2);
    }else{
        echo "no se han introducido numeros";
    }
    ?>
    <br><br><hr><br><?php
    echo "<a href='$retUrl?ejercicio=$ejercicio'>Volver</a>";
    ?>
</body>
</html>