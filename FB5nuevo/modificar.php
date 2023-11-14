<?php
include_once("conexiones.php");
conecta();
$paises=cargaPaises();
if (isset($_REQUEST) && isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
try{
    $registro=dameCiudad($id);
    $city_id=$registro['city_id'];
    $city=$registro['city'];
    $country_id=$registro['country_id'];
}catch (PDOException $e){
    foreach($errores as $e){
        echo "<div class='error'>$e</div>";
    }
    die ("Ha ocurrido un error al obtener la ciudad" . $e->getMessage() . " " . $e->getCode());
}

}
?>
<form action="" method="post">
    <input type="hidden" value="opc" value="modificar">
    <table>
        <tr>
            <td>Código ciudad</td>
            <td><input type="number" name="city_id" id="city_id" maxlength="3" readonly value='<?=$city_id?>'></td>
        </tr>
        <tr>
            <td>Ciudad</td>
            <td><input type="text" name="city" id="city" required value='<?=$city?>'></td>
        </tr>
        <tr>
            <td>País</td>
            <td><select name="country_id" id="country_id">
                    <?php
                foreach ($paises as $cod_pais=>$pais){
                    echo "<option value='$cod_pais'" . ($cod_pais==$country_id?" selected ":"") . ">$pais</option>\r";
                }?>
                </select></td>
        </tr>
        <tr>
            <td><input type="submit" value="enviar"></td>
            <td><input type="reset" value="borrar formulario"></td>
        </tr>
    </table>

</form>

<!--
    INSERT INTO `city` (`city_id`, `city`, `country_id`, `last_update`) VALUES (NULL, '', '', current_timestamp())
-->
<?php
if (isset($_REQUEST['city_id']) && isset($_REQUEST['city'])){
$city_id=$_REQUEST['city_id'];
$city=$_REQUEST['city'];
$country_id=$_REQUEST['country_id'];
try{
    $res=modificarCiudad($city_id,$city,$country_id);

    echo ($res==true?"Ciudad modificada correctamente":"Ha ocurrido un error al modificar la ciudad");
    if (isset($errores) && !empty($errores)){
        foreach ($errores as $e){
            echo "<div class='error'>$e</div>";
        }
    }

}catch(PDOException $e){
   echo "Ha ocurrido un error al modificar la tabla en la base de datos" . $e->getMessage() . " " .$e->getCode() . "<br>";
}


}
?>