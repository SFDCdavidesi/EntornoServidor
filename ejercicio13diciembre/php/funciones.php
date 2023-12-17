<?php
require_once("C_SQL.php");
require_once("C_iconos.php");
function pintaCabecera ($a){
    ?>
    <thead>
        <?php
          echo "<tr>";
           $i=0;
        foreach($a[0] as $k=>$v){
            if ($i++==0){
                echo "<th  scope='col'>$k</th>";

            }else{
                echo "<th>$k</th>";

            }
        }
        echo "</tr>";
?>
    </thead>
    <?php
}
function pintaDisponibilidad($d){
    return ($d==1?Icono::disponible():Icono::nodisponible());
}
function pintalibros($arrayasociativo){
    ?>

    
    <?php
    pintaCabecera($arrayasociativo);
    foreach($arrayasociativo as $row){
        echo "<tr><th scope='row'>" . $row["codigo"] . "</th>";
        echo "<td" . $row["codigo"] . "</td>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . pintaDisponibilidad($row["disponible"]) . "</td>";
        echo"<td><button type='button' class='btn btn-warning' onclick='modificalibro(" . $row["codigo"] . ");'>Modificar</button></td>";
        echo"<td><button type='button' class='btn btn-danger' onclick='eliminalibro(" . $row["codigo"] . ");'>Eliminar</button></td>";
        echo "</tr>";



    }
    ?>
 
<?php
}
function pintaAutores($autorpreselected="-1"){

        $bd= new BBDD();
    
   $res= $bd->getAutores();
   foreach($res as $autor){
    echo "<option value='" . $autor["codigo_autor"] . "' " . ($autorpreselected==$autor["codigo_autor"]?"selected":"") . ">" . $autor["nombre"] . " " . $autor["apellidos"] . "</option>";
   }
}
?>