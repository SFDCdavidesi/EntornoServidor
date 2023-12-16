<?php
require_once "php/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body>
<div class="container-fluid">
<?php
require_once "php/configuracion.php";
require_once "php/C_SQL.php";
require_once "php/header.php";
require_once "php/menu_navegacion.php";

if (isset($_REQUEST) && isset($_REQUEST['id'])){
    $opcionNavegacion=$_REQUEST['id'];
    switch ($opcionNavegacion){
        case "00M005":
            include_once "php/gestionUsuarios.php";
            break;
        
        case "00M004":
            include_once "php/cerrarsesion.php";
            break;
            
    }
}

?>
<?php
require_once "php/footer.php";
?>
</div>
</body>
</html>