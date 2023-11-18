<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    setcookie("nombre",1,time()+ (60*2) );
    header("Location: activa2.php");
    ?>
</body>
</html>