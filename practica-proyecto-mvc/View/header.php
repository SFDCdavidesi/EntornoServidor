<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Tracker</title>
    <link rel="stylesheet" href="../View/css/main.min.css" />
    <link rel="stylesheet" href="../View/css/estilos.css" />

</head>

<body>
    <main class="main">
    <section id="menu" class="menu">
        <ul>
            <?php
            if (isset($_COOKIE["usuario"])){
                ?>
               <li> <?=$_COOKIE["usuario"]?> (<?=$_COOKIE["rol"]?>)</li>
               <li><a href=".?action=logout">Logout</a></li>
                <?php
            }else{
            ?>
            
            <li><a href=".?action=mostrar_login">Login</a></li>
            <?php } ?>
           
            <li><a href=".?action=mostrar_alta_usuarios">Alta Usuarios</a></li>
            <?php
            if (isset($_SESSION["carrito"])){
                ?>
                            <li><a href=".?action=ver_carrito">Ver Carrito</a></li>

                <?php
            }
            ?>
        </ul>
    </section>