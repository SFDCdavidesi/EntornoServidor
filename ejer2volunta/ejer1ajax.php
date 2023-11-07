<?php

if (isset($_REQUEST["action"])) {
    if ($_REQUEST["action"] == "ejercicio2") {
        $sexo = $_REQUEST["sexo"];
        $aficiones = $_REQUEST["aficiones"];
        $sexospermitidos = array("hombre", "mujer");
        $aficionespermitidas = array("cine", "literatura", "musica");
        if (isset($sexo)){
            if (in_array($sexo, $sexospermitidos)) {
                echo "Sexo: $sexo<br>";
            } else {
                echo "Sexo no permitido<br>";

            }
            
        }else{
            echo "No se ha introducido ningún sexo<br>";
        }
        echo "Aficiones: ";
        if (isset($aficiones)) {
            foreach ($aficiones as $aficion) {
                if (in_array($aficion, $aficionespermitidas)) {
                    echo "$aficion ";
                } else {
                    echo "Afición no permitida<br>";
                }
            }
        } else {
            echo "No se ha introducido ninguna afición<br>";
    }

    }
    $num1 = $_REQUEST["num1"];
    $num2 = $_REQUEST["num2"];
    $operacion = $_REQUEST["operacion"];
    switch ($operacion) {
        case "suma":
            $resultado = $num1 + $num2;
            break;
        case "resta":
            $resultado = $num1 - $num2;
            break;
        case "multiplicacion":
            $resultado = $num1 * $num2;
            break;
    }
    echo $resultado;
}
