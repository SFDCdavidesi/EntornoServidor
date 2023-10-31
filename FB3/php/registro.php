<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilos.css">
        <title>Registro</title>
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
</body>
</html>