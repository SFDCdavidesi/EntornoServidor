<?php
include ("../php/connect.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="David Herrero">
        <meta description="Ejercicio 4">
        <title>Ejercicio 4</title>
    </head>
    <body>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<center><table>";
    foreach ($_POST as $key => $value) {
        echo "<tr><td><b>" . strtoupper( $key) . "</b></td><td><i>" . $value . "</i></td></tr>";
    }
    echo "</table></center>";
}
?>
        <?php
        $step= $_POST["step"];
        if ($step==null || $step==1){?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nombre">Nombre del alumno a modificar</label>
            <input type="text" name="nombre" id="nombre" ><br/>
            <input type="hidden" name="step" value="2" >
            <input type="submit" value="Modificar">
        </form>
        <?php
        }
        elseif ($step==2 ){?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="nombre">Introduzca el nuevo nombre del alumno</label>
                <input type="text" name="nombre" id="nombre" placeholder="<?php echo $_POST['nombre']; ?>" ><br/>
                <input type="hidden" name="step" value="3" >
                <input type="hidden" name="nombreAntiguo" value="<?php echo $_POST['nombre']; ?>" >
                <input type="submit" value="Modificar">
            </form>
            <?php
            }else{
                $nombreAntiguo = htmlspecialchars($_POST['nombreAntiguo'], ENT_QUOTES, 'UTF-8');
                $nombre=htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
                $sql = "UPDATE alumnospdo SET nombre='$nombre' WHERE nombre='$nombreAntiguo'";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                echo "Alumno modificado correctamente";
                echo "<br/>Nombre anterior: $nombreAntiguo";
                echo "<br/>Nombre nuevo: $nombre";
                echo "<br/><a href='index.php'>Volver</a>";
            }

        ?>
    </body>
</html>