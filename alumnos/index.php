<html>
<?php

if (isset($_POST) && !empty($_POST)){
    $nombre=$_POST['nombre_completo'];
    $curso=$_POST['curso'];
    $metodo=$_POST['metodo'];

if ($nombre==null or $curso==null)
return;

//incluimos el php de conexion
include_once("conexion.php");
$dbname="ssii";
include_once("sql.php");
$res=inserta($nombre,$curso,$metodo);
if ($res==TRUE){
    echo "$nombre introducido correctamente en curso $curso<br/>";
}else{
    echo "Ha ocurrido un error al tratar de insertar $nombre";
    echo "<b>". $res->error . "</b>";
}

}else{
    ?>
no hemos enviado nada <br />
<?php
}

?>

<body>
    <form action="index.php" method="POST">
        <label for="nombre">xNombre del alumno</label><input type="text" name="nombre_completo"><br />
        <label for="curso">Curso</label><select name="curso" id="curso"></select><br />
        <label for="metodo">Método de conexión</label><select name="metodo" id="metodo"></select>
        <input type="submit" value="Enviar">
    </form>
    <hr>
  <?php
    require_once("footer.php");
    ?>
</body>
<script>
var cursos = ["PHP", "JAVA", "JAVASCRIPT"];
var metodos=["MySQL","PDO"];
var c = document.getElementById('curso');
for (let i = 0; i < cursos.length; i++) {
    var option = document.createElement('option');
    option.value = (i + 1);
    option.text = cursos[i];
    if ((i+1)=="<?=$curso?>"){
        option.selected=true;
    }
    c.appendChild(option);
    
}
var metodo=document.getElementById('metodo');
for (var i=0;i<metodos.length;i++){
    var option = document.createElement('option');
    option.value=metodos[i];
    option.text=metodos[i];
    if (metodos[i]=="<?=$metodo?>"){
        option.selected=true;
    }
    metodo.appendChild(option);
}
</script>

</html>