<?php
$addlibro=$_REQUEST["libro"];
session_start();
try{
    $listadolibros=[];
    if (isset($_SESSION["listadolibros"])){
    $listadolibros=$_SESSION["listadolibros"];
    }
    if (isset($listadolibros[$addlibro])){
        $unidades=$listadolibros[$addlibro]["unidades"];
        $listadolibros[$addlibro]["unidades"]=++$unidades;
    }else{
        //no está en la sesión, lo añadimos
        $listadolibros[$addlibro]["unidades"]=1;
    }
    $totallibros=0;
    foreach($listadolibros as $libro=>$unidades){
        $totallibros+=$unidades["unidades"];
    }
    $_SESSION["listadolibros"]=$listadolibros;
    $_SESSION["totalLibrosCarrito"]=$totallibros;
}catch(Exception $e){
echo "<script>console.log('error añadiendo libro al carrito');</script>";
}
echo $totallibros;
?>