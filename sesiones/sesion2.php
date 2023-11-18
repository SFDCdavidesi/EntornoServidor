
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
foreach ($_SESSION as $k => $v)  {
 
    echo "<b>$k</b> : " . ($k=="instante"?date("Y m d H:i:s", $v):$v) . "<br>\r";

   
}  
foreach ($_SESSION as $k){
    unset($_SESSION[$k]);
}
session_destroy();
?>
<a href="sesion1.php">Volver</a>
</body>
</html>