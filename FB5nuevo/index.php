<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .tabla {
        border: 1px solid black;
    }

    .tabla tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .error {
        color: red;
    }

    .enunciado {
        margin: auto;
  font-family: Arial, sans-serif;
  font-size: medium;
  background-color: lightyellow;
    }

    ul {
  display: flex;
}

 li {
  display: inline-block;
  margin-right: 50px;
}

    </style>
</head>

<body>
    <div class="enunciado">
        Realizar un programa PHP
        Crud Create, Read, Update, Select de la tabla Country de Sakila.
        Obligatorio: usar mas de un formulario
        NOTA: Realizarlo en tecnología PDO.
    </div>

    <div class="menu">
        <ul>
            <li> <a href="<?=$_SERVER ['PHP_SELF']?>?opc=alta">Alta</a></li>
        <li> <a href="<?=$_SERVER ['PHP_SELF']?>?opc=listado">Listado</a></li>

        </ul>
    </div>
    <div class="principal">
        <?php
    $opc=isset($_REQUEST['opc'])?$_REQUEST['opc']:"";

    switch($opc){
        case "alta":
        include_once("alta.php");
        break;
        case "listado":
            include_once("listado.php");
            break;
        case "modificar":
            include_once("modificar.php");
            break;
        case "eliminar":
            include_once("eliminar.php");
            break;
        default:
            include_once("listado.php");


    }
    ?>
    </div>
</body>

</html>