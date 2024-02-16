<?php
if (isset($_POST)){
    if (isset($_POST['nombre'])){
        $nombre=$_POST['nombre'];
    }
    $apellidos=(isset($_POST['apellidos']))?$_POST['apellidos']:"";
    $fecha_de_nacimiento=(isset($_POST['fecha_de_nacimiento']))?$_POST['fecha_de_nacimiento']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $carnet=(isset($_POST['carnet']))?$_POST['carnet']:"";
    $marca=(isset($_POST['marca']))?$_POST['marca']:"";
    $modelo=(isset($_POST['modelo']))?$_POST['modelo']:"";
    $acabado=(isset($_POST['acabado']))?$_POST['acabado']:"";

    $archivo = fopen("vehiculos.txt", "a");
    $separador=";";
    fwrite($archivo, $nombre.$separador.$apellidos.$separador.$email.$separador.$carnet.$separador.$marca.$separador.$modelo.$separador.$acabado."\n");
    fclose($archivo);
    echo "Datos guardados correctamente";
    http_response_code(200);
}else{
    echo "Error al recibir los datos";
    http_response_code(400);
}
?>