<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda</title>
</head>
<body>
<?php
foreach($_POST as $k=>$v)echo "<b>$k </b> $v <br/>";
if (isset($_POST) && !empty($_POST)){
    $nombre=$_POST['nombre'];

    require_once("conexion.php");
    require_once("sql.php");
    $dbname="ssii";
   $res= busqueda_y_elimina($dbname,$nombre);
    echo "resultado de busqueda y elimina $res <br>";
   if ($res>0){
    ?>
    <h1> Se ha eliminado <?=$nombre?> de la base de datos </h1>
    <?php
   }else{
    ?>
    <h2 font-color='red'>No se ha encontrado a <?=$nombre?> en la base de datos </h2>
    <?php
   }
}

?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    <label for="nombre">Nombre del alumno</label> <input type="text" name="nombre">
    <br/>
    <input type="submit" value="Enviar">
</form>
<?php
  require_once("footer.php");
?>
</body>
</html>