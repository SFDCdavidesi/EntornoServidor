<?php
include_once("conexiones.php");
if (isset($_REQUEST) && isset($_REQUEST['id'])){
$id=$_REQUEST['id'];
   try{
    if (eliminaCiudad($id)){
        echo "Ciudad eliminada correctamente";
    }else{
        echo "No se ha podido eliminar la ciudad";
    }
   }catch(PDOException $e){
    echo "Ha ocurrido un error al eliminar la ciudad de la base de datos " . $e->getMessage() . " " . $e->getCode();
    foreach($errores as $e){
        echo "<div class='error'>$e</div>\r";
    }
   } 
}

?>
<br/>
<hr>
<a href="<?=$_SERVER['HTTP_REFERER']?>"> Volver </a>