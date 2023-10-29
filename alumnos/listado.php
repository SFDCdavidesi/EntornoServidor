<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de alumnos</title>
    <style>
        table{
            border:2px solid black;
        }
        /* Estilo para las filas impares */
        table.striped tr:nth-child(odd) {
            background-color: #E6F3FF; /* Azul claro */
        }

        /* Estilo para las filas pares */
        table.striped tr:nth-child(even) {
            background-color: #B0C4DE; /* Azul más claro */
        }
    
    </style>
</head>

<body>
    <?php
    require_once("conexion.php");
    require_once("sql.php");

    //funciones propias de de esta página
    function curso($c=1): string{
        $cursos = array("PHP","JAVA","JAVASCRIPT");
        return $cursos[$c-1];


    }
    ?>
    <hr>
    <?php
   
    $tabla="PDO";
    if (isset($_POST) && !empty($_POST)){
        $tabla=$_POST['tabla'];
    }
    foreach ($_POST as $k=>$v)echo "$k => $v <br/>\r";

    $resultado=listaalumnos($tabla);
    if ($resultado){
   ?>
    <h1> Listado de alumnos </h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formulario">
        <label for="tabla">Elija la tabla </label> <input type="radio" name="tabla" value="PDO"
            <?=($tabla=="PDO"?"checked":"");?> onchange="formulario.submit();">PDO</input>
        <input type="radio" name="tabla" value="MySQL" <?=($tabla=="MySQL"?"checked":"");?>
            onchange="formulario.submit();">MySQL</input>
    </form>
    <table class="striped">
        <tr>
            <th> Código de alumno </th>
            <th> Nombre de alumno </th>
            <th> Curso del alumno </th>
        </tr>
        <?php
        foreach($resultado as $fila){
            $cc=curso($fila['codigocurso']);
            echo "<tr>";
            echo "<td>" . $fila['codigo'] . "</td>\r";
            echo "<td>" . $fila ['nombre_completo'] . "</td>";
            echo "<td>" . $cc . "</td>\r";
            echo "</tr>\r";

        }

        ?>
    </table>
    <?php
    }
    
    ?>
    <hr><br />
    <?php
      require_once("footer.php");
      ?>
</body>

</html>