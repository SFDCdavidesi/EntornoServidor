<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de funciones</title>
    <style>
        body{
            background-color: antiquewhite;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?php
    /*. Escriba una función lógica que reciba un carácter y determine si este es un 
dígito entre ‘0’ a ‘9’.
2. Escriba una función que reciba una cadena de caracteres y devuelva su 
longitud.
3. Escriba una función que dado dos números enteros a y b, realice la operación 
de potencia ab
4. Escriba una rutina que permita concatenar dos cadenas de caracteres. 
Concatenar significa unir dos cadenas. Ejemplo: cadena1=”Hola”, cadena2=” 
mundo”, cadenafinal=”Hola mundo”. La cadena final debe ser retornada por la 
función y recibida como parámetro (por referencia).
5. Crea un fichero php con dos funciones sumar y restar y una variable, en un 
segundo fichero php llama a una de las funciones y usa la variable creada en 
el anterior ficher */
    $step = $_GET['step'];
    if ($step == null) $step = 1;
    echo "Ejercicio $step <br>";
    switch ($step) {
        case 1:
            ejer1();
            break;
        case 2:
            ejer2();
            break;
        case 3:
            ejer3();
            break;
        case 4:
            ejer4();
            break;

            case 5:
                ejer5();
                //no necesito break pues es el último
    }

    function ejer1()
    {
        echo "Ejercicio 1<br>";
        //Escriba una función lógica que reciba un carácter y determine si este es un 
        //  dígito entre ‘0’ a ‘9’.
        $caracters = ["a", "3", "pepe"];
        foreach ($caracters as $c) {
            echo "averiguando si $c es un caracter: " . printBoolean(esCaracter($c)) . "<br>";
        }
    }
    function ejer2()
    {
        /*. Escriba una función que reciba una cadena de caracteres y devuelva su 
longitud. */
        $cadenas = ["hola", "cocacola", "Esto es una cadena de caracters de gran longitud"];
        foreach ($cadenas as $cad) {
            echo "La cadena $cad tiene " . logitud($cad) . " caracteres <br>";
        }
    }
    
    function ejer3()
    {
        /*. Escriba una función que dado dos números enteros a y b, realice la operación    de potencia ab */
        $base = $_GET['base'];
        $exponente = $_GET['exponente'];
        echo "la potencia de $base y $exponente es " . potencia($base, $exponente);
    ?><form action="funciones.php" method="get">
            <table>
                <tr>
                    <td><label for="base">Base</label></td>
                    <td><input type="number" id="base" name="base"></td>
                </tr>
                <tr>
                    <td><label for="exponente">Exponente</label></td>
                    <td><input type="number" id="exponente" name="exponente"></td>
                </tr>
                <input type="hidden" name="step" value="3">
                <tr>
                    <td> <input type="submit" class="button"> </td>
                </tr>
            </table>
        <?php
    }

    function ejer4()
    {
        /*Escriba una rutina que permita concatenar dos cadenas de caracteres. 
Concatenar significa unir dos cadenas. Ejemplo: cadena1=”Hola”, cadena2=” 
mundo”, cadenafinal=”Hola mundo”. La cadena final debe ser retornada por la 
función y recibida como parámetro (por referencia). */
        ?>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                <label for="cadena1"></label>Cadena 1</label><input type="text" name="cadena1" id="cadena1"><br />
                <label for="cadena2"></label>Cadena 2</label><input type="text" name="cadena2" id="cadena2"><br/>
                <input type="submit" value="Enviar"><input type="reset" value="Borrar">
                <input type="hidden" name="step" value="4">
            </form>
        <?php
        $c1 = $_GET["cadena1"];
        $c2 = $_GET["cadena2"];
        if ($c1 != null && $c2 != null) {
            echo "El resultado de contactenar $c1 y $c2 es " . concatenar($c1, $c2) . "<br/>";
            echo "cadena1 = $c1 <br/>";
            echo "cadena2 = $c2 <br/>";
        }
    }

   
   
       
       function ejer5(){
        /**Crea un fichero php con dos funciones sumar y restar y una variable, en un 
segundo fichero php llama a una de las funciones y usa la variable creada en 
el anterior fichero */
include_once("segundofichero.php");
$n1=$_GET["n1"];
$n2=$_GET["n2"];
$tipoOperacion=$_GET["tipoOperacion"];

?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                <label for="n1"></label>Primer Número</label><input type="number" name="n1" id="n1" placeholder="<?=$n1?>"><br />
                <label for="n2"></label>Segundo Número</label><input type="number" name="n2" id="n2" placeholder="<?=$n2?>"><br/>
                <label for="tipoOperacion">Tipo de operación</label>
                <input type="radio" id="suma" name="tipoOperacion" value="suma">
                <label for="suma">Suma</label>
                <input type="radio" id="resta" name="tipoOperacion" value="resta">
                <label for="resta">Resta</label>
                <input type="submit" value="Enviar"><input type="reset" value="Borrar">
                <input type="hidden" name="step" value="5">
            </form>
            <br/>
            

<?php

if ($n1!=null && $n2!=null && $tipoOperacion!=null){
    echo "El resultado de $n1 $tipoOperacion $n2 es " . ($tipoOperacion=="suma"?sumar($n1,$n2):restar($n1,$n2)) . "<br/>";
       }
       
    }
    function logitud($cadena): int
    {
        return strlen($cadena);
    }

    function potencia($a, $b): int
    {
        return pow($a, $b);
    }
    function esCaracter($c): bool
    {
        if (strlen($c) != 1) return false; // no es un caracter
        return is_numeric($c) ? true : false;
    }
    function printBoolean($b): string
    {
        return $b ? "true" : "false";
    }
    function concatenar($cad1, &$cad2): string
    {
        return $cad1 . $cad2;
    }
    ?>
    <hr>
    <?php
       $ejercicios = ["ejer1", "ejer2", "ejer3", "ejer4","ejer5"];
       foreach ($ejercicios as $e){
           $index=substr($e,-1);
           echo "<a href='funciones.php?step=$index'>$e</a> - ";
       }
       ?>

</body>

</html>