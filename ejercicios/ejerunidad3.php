<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
Definir un array con 3 nombres de compañeros, recorrerlo con for y for each 

a. Añadir un elemento y borrar un elemento 

2. Escriba un programa que muestre una tirada de un número de dados al azar entre 2 y 

7 e indique los valores.

3. Define tres arrays de 20 números enteros cada una, con nombres “numero”, 

“cuadrado” y “cubo”. Carga el array “numero” con valores aleatorios entre 0 y 100. En 

el array “cuadrado” se deben almacenar los cuadrados de los valores que hay en el 

array “numero”. En el array “cubo” se deben almacenar los cubos de los valores que 

hay en “numero”. A continuación, muestra el contenido de los tres arrays dispuesto en 

tres columnas. 

4. Confeccionar un formulario que solicite la carga de un nombre de persona y su edad,

luego mostrar en otra página si es mayor de edad (si la edad es mayor o igual a 18) 

5. Crear una aplicación que suma dos números. El programa index.php recoge los datos y 

el programa suma.php suma los dos números que recibe y muestra el resultado 

6. Escribe un programa que lea 15 números por teclado y que los almacene en un array. 

Rota los elementos de ese array, es decir, el elemento de la posición 0 debe pasar a la 

posición 1, el de la 1 ala 2, etc. El número que se encuentra en la última posición debe 

pasar a la posición 0. Finalmente, muestra el contenido del array. 

7. Almacenar en un vector asociativo la cantidad de dias que tiene cada mes del año. 

Luego accederlo por su nombre 

8. Crear un vector asociativo que almacene las claves de acceso de 5 usuarios de un 

sistema. Acceder a cada componente por su nombre. Imprimir un componente del 

vector. 

9. Array Bidimensional Crear un array con tres motos y sus características(marca, 
modelo, color) recorrer el array decir las características de la motos 

10. Estamos creado la web de una tienda online, en concreto, el código de un buscador de 
productos. Nos piden que creemos un script que solucione el problema de filtrado de 
productos, mostrando solo los productos que ha elegido filtrar el usuario. La 
información de los productos la tenemos en un Array multidimensional 
llamado $arrayProductos, en posiciones consecutivas (0, 1, 2, 3) y en cada una un array 
con dos datos, la categoría del producto y el nombre del producto. 
En la variable $categoria recibiremos el código de la categoria de productos a mostrar. 
</p>
<?php
$ejercicio =$_REQUEST['ejercicio']?$_REQUEST['ejercicio']:1;

switch($ejercicio){
    case 1:
        ejercicio1();
        break;
    case 2:
        ejercicio2();
        break;
    case 3:
        ejercicio3();
        break;
    case 4:
        ejercicio4();
        break;
    case 5:
        ejercicio5();
        break;
    case 6:
        ejercicio6();
        break;
    case 7:
        ejercicio7();
        break;
    case 8:
        ejercicio8();
        break;
    case 9:
        ejercicio9();
        break;
    case 10:
        ejercicio10();
}

//ejercicios
function ejercicio1(){
    /*
     Definir un array con 3 nombres de compañeros, recorrerlo con for y for each 
a. Añadir un elemento y borrar un elemento 
 */
    $nombres = ["pepe", "juan", "maria", "luis"];
    echo "El array tiene " . count($nombres) . " elementos <br>";
    ?>
    Recorremos con un foreach <br/> 
    <ul>
    <?php
    foreach($nombres as $n){
        echo "<li>$n</li>\n";
    }
    ?>
    </ul><br/>    
    <ul>
    Recorremos con un for <br/>
    <?php 
    for ($i=0;$i<count($nombres);$i++){
        echo "<li>$nombres[$i]</li>\n";
    }?>
    </ul>
    <?php
    echo "<br> haciendo un unset <br>";
    unset($nombres[0]);
    imprime($nombres);
    
}
function ejercicio2(){
/*2. Escriba un programa que muestre una tirada de un número de dados al azar entre 2 y 

7 e indique los valores. */
    $tirada = rand(2,7);
    echo "La tirada es $tirada <br>";
    $dados = [];
    for ($i=0;$i<$tirada;$i++){
        $dados[$i] = rand(1,6);
    }
    imprime($dados);

}
function ejercicio3(){
    /*Define tres arrays de 20 números enteros cada una, con nombres “numero”, 
“cuadrado” y “cubo”. Carga el array “numero” con valores aleatorios entre 0 y 100. En 
el array “cuadrado” se deben almacenar los cuadrados de los valores que hay en el 
array “numero”. En el array “cubo” se deben almacenar los cubos de los valores que
hay en “numero”. A continuación, muestra el contenido de los tres arrays dispuesto en 
tres columnas. 
*/
$numero = [];
$cuadrado = [];
$cubo = [];
for ($i=0;$i<20;$i++){
    $numero[$i] = rand(0,100);
    $cuadrado[$i] = $numero[$i] * $numero[$i];
    $cubo[$i] = $numero[$i] * $numero[$i] * $numero[$i];
}
array_unshift($numero,"Números");
array_unshift($cuadrado,"Cuadrados");
array_unshift($cubo,"Cubos");
imprimeColumnas($numero,$cuadrado,$cubo);
}

function ejercicio4(){
/*Confeccionar un formulario que solicite la carga de un nombre de persona y su edad,

luego mostrar en otra página si es mayor de edad (si la edad es mayor o igual a 18)  */
?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label for="nombre">Nombre</label><input type="text" name="nombre" id="nombre"><br>
    <label for="edad">Edad</label><input type="number" name="edad" id="edad"><br>
    <input type="submit" value="enviar">
    <input type="hidden" name="ejercicio" value="4">

</form>

<?php
    $nombre=$_REQUEST['nombre']?$_REQUEST['nombre']:"";
    $edad=$_REQUEST['edad']?$_REQUEST['edad']:"";
    if ($nombre && $edad )
    echo "$nombre " . ($edad>=18?"es mayor de edad":"es menor de edad") . "<br/>";
}

function ejercicio5(){
/*5. Crear una aplicación que suma dos números. El programa index.php recoge los datos y 

el programa suma.php suma los dos números que recibe y muestra el resultado  */
?>
    <form action="suma.php" method="post">
    <label for="numero1">Número 1</label><input type="number" name="numero1" id="numero1"><br>
    <label for="numero2">Número 2</label><input type="number" name="numero2" id="numero2"><br>
    <input type="submit" value="enviar">
    <input type ="hidden" name="ejercicio" value="5">
    <input type="hidden" name="retUrl" value="<?=$_SERVER['PHP_SELF'];?>">
    <?php

}

function ejercicio6(){
    /*6. Escribe un programa que lea 15 números por teclado y que los almacene en un array. 

Rota los elementos de ese array, es decir, el elemento de la posición 0 debe pasar a la 

posición 1, el de la 1 ala 2, etc. El número que se encuentra en la última posición debe 

pasar a la posición 0. Finalmente, muestra el contenido del array.  */
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<label for="numeros">  </label>Introduce 15 números separados por comas</label><textarea name="numeros" id="numeros" columns="100" rows="15"></textarea><br>
<input type="hidden" name="ejercicio" value="6">
<input type="submit" value="enviar">
</form>


<?php
$numeros=$_REQUEST['numeros']?$_REQUEST['numeros']:"";

if ($numeros!=""){
    $numeros = explode(",",$numeros);
    echo "has introducido " . count($numeros) . " números <br>";
    imprime($numeros,true);
    $ultimoNumero=array_pop($numeros);
    echo "rotamos el array<br/>";
    array_unshift($numeros,$ultimoNumero);
    imprime($numeros,true);
}

}

function ejercicio7(){
/* Almacenar en un vector asociativo la cantidad de dias que tiene cada mes del año. 

Luego accederlo por su nombre  */
$meses = ["enero"=>31,"febrero"=>28,"marzo"=>31,"abril"=>30,"mayo"=>31,"junio"=>30,"julio"=>31,"agosto"=>31,"septiembre"=>30,"octubre"=>31,"noviembre"=>30,"diciembre"=>31];
?> <ul>
    <?php
foreach($meses as $mes=>$dias){
    echo "<li>El mes de <b>$mes</b> tiene $dias días </li>";
}
?>
   </ul>
   <?php

}
function ejercicio8(){
    /*8. Crear un vector asociativo que almacene las claves de acceso de 5 usuarios de un 

sistema. Acceder a cada componente por su nombre. Imprimir un componente del 

vector.  */
$claves = ["pepe"=>"1234","juan"=>"1234","maria"=>"1234","luis"=>"1234","ana"=>"1234"];
echo "El usuario pepe tiene la clave " . $claves["pepe"] . "<br>";
echo "El usuario juan tiene la clave " . $claves["juan"] . "<br>";
echo "El usuario maria tiene la clave " . $claves["maria"] . "<br>";
echo "El usuario luis tiene la clave " . $claves["luis"] . "<br>";
echo "El usuario ana tiene la clave " . $claves["ana"] . "<br>";
}


function ejercicio9(){
/* Array Bidimensional Crear un array con tres motos y sus características(marca, 
modelo, color) recorrer el array decir las características de la motos  */

$motos = [["marca"=>"honda","modelo"=>"cb500","color"=>"rojo"],["marca"=>"yamaha","modelo"=>"fz6","color"=>"azul"],["marca"=>"kawasaki","modelo"=>"z750","color"=>"verde"]];
foreach ($motos as $moto){
    echo "La moto es una " . $moto["marca"] . " " . $moto["modelo"] . " de color " . $moto["color"] . "<br>";
}
}
function ejercicio10(){
    /*
    10. Estamos creado la web de una tienda online, en concreto, el código de un buscador de 
productos. Nos piden que creemos un script que solucione el problema de filtrado de 
productos, mostrando solo los productos que ha elegido filtrar el usuario. La 
información de los productos la tenemos en un Array multidimensional 
llamado $arrayProductos, en posiciones consecutivas (0, 1, 2, 3) y en cada una un array 
con dos datos, la categoría del producto y el nombre del producto. 
En la variable $categoria recibiremos el código de la categoria de productos a mostrar. */
$arrayProductos = [[0,"cama"],[0,"armario"],[0,"mesilla de noche"],[1,"sofá"],[1,"mesa de comedor"],[1,"sillas de comedor"],[2,"sartenes"],[2,"cazos"],[2,"salero"],
[3,"mampara de ducha"],[3,"lavabo"],[3,"inodoro"]];
$categorias = [0=>"muebles",1=>"salón",2=>"cocina",3=>"baño"];
$categoria = $_REQUEST["categoria"]?$_REQUEST["categoria"]:0;
echo "Has elegido la categoría $categorias[$categoria] <br>";
echo "<ul>";
foreach ($arrayProductos as $producto){
    if ($producto[0]==$categoria){
        echo "<li>$producto[1]</li>";
    }
}
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input type="hidden" name="ejercicio" value="10">
    <label for="categoria">Elige una categoría</label>
    <select name="categoria" id="categoria">
        <?php
        foreach($categorias as $k=>$v){
            echo "<option value='$k'>$v</option>";
        }
    ?>
    </select>
    <input type="submit" value="enviar">
    <?php

}
//funciones
function imprimeColumnas(...$parametros){
    echo "número de parámetros recibidos " . count($parametros) . "<br>";
    echo "<table border='1'>";
    echo "<tr>\n";
    foreach ($parametros as $p){
        echo "<td>\n";
        imprime($p);
        echo "</td>\n";
    }
    echo "</tr>\n";
    echo "</table>";

}
function imprime($var,$ordered=false){
    echo $ordered?"<ol>":"<ul>";
    foreach ($var as $n) {
        echo "<li>$n</li>\n";
    }
    echo $ordered?"</ol>":"</ul>";

}
?>
<br><hr>
<?php
$ejercicios = array ("ejercicio1","ejercicio2","ejercicio3","ejercicio4","ejercicio5","ejercicio6","ejercicio7","ejercicio8","ejercicio9","ejercicio10");
foreach ($ejercicios as $e){
    $a=strlen($e);
    $pos=9-$a;
    $index=substr($e,$pos);
    echo "[<a href='?ejercicio=$index'>$e</a> ] ";
}
?>
</body>
</html>