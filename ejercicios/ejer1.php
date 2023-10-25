<?php

//crear un programa que nos diga cuántos dígitos tiene un número gernador con rnd en php
$ejer=3;
switch($ejer){
    case 1:
        $i = rand(1, 1000000);
        $i=235;
$j=0;
$contador=0;
for ($j=0;$j<$i;$j=(1+$j)*10){
    $contador++;
    echo $j . "<br>";
}
echo "El número $i tiene $contador dígitos";
break;
case 2:
$contador=0;
    do {
        $j=rand(1,99999);
        $contador++;

    }while ($j>=20);
    
    echo "Hemos tardado $contador intentos en generar un número menor que 20";
    break;
    case 3:
        include_once("funciones.php");
        echo "suma 2 + 3 = " . suma(2,3) . "<br>";
        echo "resta 2 - 3 = " . resta(2,3) . "<br/>";
}
