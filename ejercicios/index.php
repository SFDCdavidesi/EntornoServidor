<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contenedor{

            border:1px solid black;

        }
        </style>
</head>
<body>
    <div class="contenedor">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="numfilas">Número de filas</label><input type="number" name="numfilas" id="numfilas"><br/>
            <label form="numcolumnas">Número de columnas</label><input type="number" name="numcolumnas" id="numcolumnas"><br/>
            <input type="submit" value="enviar"></br>
    </form>

    </div>
    <?php
    if (isset($_POST) && !empty($_POST)){
        $filas=$_POST['numfilas'];
        $columnas=$_POST['numcolumnas'];
    ?>
    <div id="tabla">
        <table border="1">
        <?php
        for ($i=0;$i<$filas;$i++){
            echo "<tr>\n";
            for ($j=0;$j<$columnas;$j++){
                echo "<td>$i $j </td>\n";
            }
            echo "</tr>";
        }
        ?>
        </table>

        
    </div>
    <?php
    }
    ?>
</body>
</html>