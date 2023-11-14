<div class="formulario_busqueda">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="hidden" name="opc" value="listar">
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="buscanombre"></td>
            </tr>
            <tr>
                <td>Pais</td>
                <td><input type="text" name="buscapais"></td>
            </tr>
            <tr>
                <td><input type="submit" value="buscar"></td>
                <td><input type="reset" value="borrar formulario"></td>
            </tr>
        </table>
</div>
<?php
if (isset($_REQUEST['opc']) && $_REQUEST['opc']=="listar"){
$city=$_REQUEST['buscanombre'];
$pais=$_REQUEST['buscapais'];
include_once("conexiones.php");
$stm=buscaCity($city,$pais);
?>

<div class="listado">

    <table class="tabla">
        <tr>
            <th>código ciudad</th>
            <th> Ciudad</th>
            <th> País</th>

        </tr><?php
while($resultado=$stm->fetch(PDO::FETCH_ASSOC)){
    ?>
        <tr>
            <?php
            foreach ($resultado as $k=>$v){
                ?>

            <?php
                    echo "<td>$v</td>\r";
                    ?>

            <?php
            }
            ?>
            <td><a href="<?=$_SERVER['PHP_SELF']?>?opc=modificar&id=<?=$resultado['city_id']?>" ><img src="./img/icons8-editar-propiedad-26.png" alt="Modificar registro"></a><a href="#" onClick="if(confirm('¿Confirma que desea eliminar la ciudad de <?=$resultado['city']?>?')){window.location='eliminar.php?id=<?=$resultado['city_id']?>'}";>&nbsp;<img src="./img/icons8-eliminar-26.png" alt="Eliminar registro"></a></td>
        </tr>
        <?php
    }
}

    ?>
    </table>
</div>