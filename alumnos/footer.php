<style>
        /* Estilo para el div */
        .footer {
            position: fixed; /* Posición fija en la ventana */
            bottom: 0; /* Alineado al borde inferior */
            left: 0; /* Alineado al borde izquierdo (puedes usar right en lugar de left) */
            background-color: #3498db; /* Color de fondo (azul) */
            color: #ffffff; /* Color del texto (blanco) */
            padding: 10px; /* Espaciado interno */
            margin: 0 auto;
        }
    </style>

<div class="footer">
<?php
//foreach($_SERVER as $k=>$v)echo "$k => $v <br/>";
$paginas =["Formulario de alta"=>"index.php",
"Listado de alumnos"=>"listado.php",
"Búsqueda y borrado"=>"busqueda.php"];
foreach($paginas as $nombre=>$pag){
    echo "<a href='./$pag'>[$nombre]</a>&nbsp;";
}
?>
<div>