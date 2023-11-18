<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidad 4</title>
    <style>
    .contenedor {
        width: 50%;
    }

    .row {
        width: 100%;
        display:flex;
    }

    .column {
        width: 34%;

    }
    </style>

</head>

<body>
    <div class="contenedor">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="row">
                <div class="column">
                    <label for="nombre_completo">Nombre completo</label>
                </div>
                <div class="column">
                    <input type="text" maxlength="128" minlength="4" name="nombre_completo">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="curso">Curso</label>
</div>
<div class="column">
                    <select name="curso">
                        <option value="1">PHP</option>
                        <option value="2">JAVA</option>
                        <option value="3">JAVASCRIPT</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <input type="submit" value="enviar">
                </div>
            </div>
    </div>
<?php
foreach($_REQUEST as $k=>$v){
    echo "$k => $v <br>";
}
if (isset($_REQUEST['nombre_completo'])){
    $nombre_completo=$_REQUEST['nombre_completo'];
    $curso=$_REQUEST['curso'];
    //llamaos al fichero con datos de conexión
    require_once("conexion.php");
    $con=mysqli_connect($host,$user,$pass,$dbname) or die ("Error conectando a base de datos");

   $stmt= $con->prepare("select * from alumnossql where nombre_completo=? and codigocurso=?");
$stmt->bind_param("si",$nombre_completo,$curso);
$stmt->execute();

if ($stmt->num_rows==0){
    $stmt->store_result();
    //no existía, podemos insertarlo
    $stmt = $con->prepare("insert into alumnossql (nombre_completo,codigocurso) values (?,?)");
    $stmt->bind_param("si",$nombre_completo,$curso);
    $stmt->execute();
    echo "alumno dado de alta correctamente<br>";
}else{
    die ("No se puede dar de alta ese alumno pues ya se encuentra en la BBDD<br>");
}

}
?>
</body>

</html>