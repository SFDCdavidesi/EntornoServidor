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
    <div class="container-fluid listado">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
    <?php
    pintaCabecera($arrayasociativo);
    foreach($arrayasociativo as $row){
        echo "<tr><th scope='row'>" . $row["codigo"] . "</th>";
        echo "<td" . $row["codigo"] . "</td>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . pintaDisponibilidad($row["disponible"]) . "</td>";
        echo"<td><button type='button' class='btn btn-warning'>Modificar</button></td>";
        echo"<td><button type='button' class='btn btn-danger'>Eliminar</button></td>";
        echo "</tr>";



    }
    ?>
    </div>
<?php
}
function pintaAutores(){

        $bd= new BBDD();
    
   $res= $bd->getAutores();
   foreach($res as $autor){
    echo "<option value='" . $autor["codigo_autor"] . "'>" . $autor["nombre"] . " " . $autor["apellidos"] . "</option>";
   }
}
?>