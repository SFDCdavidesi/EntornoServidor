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
    //creamos 3 variables de sesión y asignamos valores
    $_SESSION['color']='rojo';
    $_SESSION['animal']='caballo';
    $_SESSION['instante']=time();
    ?>
    <a href="sesion2.php">Página 2</a><br/>
    <a href="sesion2.php?session_id=<?=session_id();?>">Página 2 con sesión</a>
</body>
</html>