<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tablas de multiplicar</title>
    <script>
        function cargaOpciones(){
            var s=document.getElementById('tablas');
            for (var i=0;i<20;i++){
                var option = document.createElement('option');
                option.value=(i+1);
                option.text=(i+1);
                s.appendChild(option);
            }
        }
        </script>
        <style>
            .contenedor {
                border: 1px solid black;
                padding:10;
                text-align: center;
                margin: 10px;
            }
            </style>
</head>
<body onload="cargaOpciones();">
    <div class="contenedor">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="seleccion">Seleccione un número para mostrar las tablas de multiplicar </label>
        <select name="tablas" id="tablas"></select>
        <br/>
        <input type="submit" value="Enviar">

</form>
</div>
<?php
if (isset($_POST) && !empty($_POST)){
    $num=(($_POST['tablas']!=null?$_POST['tablas']:0));
?>
    <div class="contenedor">
        El número elegido es el <?=$num?><br/>
        <table border="1"><?php

            for ($j=0;$j<$num;$j++){
                echo "<tr>\n";
                for ($i=0;$i<=10;$i++){
                    $resultado=($j+1)*$i;
                    echo "\t<td >" . ($j+1) . " x $i = $resultado </td>\n ";

                }
                echo "</tr>\n";
            }
           
        ?>
</table>

    </div><?php

}
?>
</body>
</html>