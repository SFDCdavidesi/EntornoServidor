<?php
$lechesArray = json_decode($leches, true);


if (isset($_SESSION) && isset($_SESSION['carrito'])){
    $total=0;
    $totalProductos=0;
    foreach($_SESSION['carrito'] as $k=>$v){
$idelemento=$k;
$unidades=$v;     
//$precio=damePrecio($idelemento);
$precio=dameValor($idelemento,'precio');
$total+=$unidades*$precio;
$totalProductos+=$unidades;
pintaProducto($idelemento,$unidades);
    }

echo "total precio : $total €<br>";
echo "total productos : $totalProductos";
echo "<a href='" . $_SERVER['PHP_SELF'] . "?borrarCarrito=yes'> Vaciar carrito</a>";
}
?>