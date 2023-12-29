<?php
include "Vehiculo.php";

$vehiculos =["moto"=>new Moto(),
"coche" => new Coche()];
echo $vehiculos["moto"]->acelerar(20);
echo $vehiculos["coche"]->acelerar(30);

$aceleraciones = [10,20,15,10,5,10,10,10,50];
$decelaraciones = [50,50,50,50,50];

foreach ($aceleraciones as $ace){
    echo $vehiculos["moto"]->acelerar($ace) . "<br>";
    echo $vehiculos["coche"]->acelerar($ace) . "<br>"; 
}

foreach($decelaraciones as $dece){
    echo $vehiculos["moto"]->frenar($dece) . "<br>";
    echo $vehiculos["coche"]->frenar($dece) . "<br>";
}
?>