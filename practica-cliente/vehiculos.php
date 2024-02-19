<?php
if ($_SERVER['REQUEST_METHOD']==='GET'){
    //si la petición es GET vamos a devolver todos los datos del fichero vehículos.txt
    $archivo = fopen("vehiculos.txt", "r"); //Abrir el archivo en modo lectura
    $datos = array(); //Inicializar un array para guardar los datos
    while (!feof($archivo)){ //Mientras no se haya llegado al final del archivo
        $linea = fgets($archivo); //Leer una línea del archivo
        if ($linea==""|| $linea==";;;;;;\n") continue; //Skip empty lines or lines containing ";;;"
        $datos[] = explode(";", $linea); //Dividir la línea en campos y guardarlos en el array
    }
    fclose($archivo); //Cerrar el archivo
    echo json_encode($datos); //Devolver los datos en formato JSON
    http_response_code(200); //Código de respuesta 200 , OK
    exit(); //Finalizar el script
}

if (isset($_POST)){ //Si se ha recibido datos por POST
    foreach ($_POST as $clave => $valor){ //Recorrer los campos recibidos
        echo $clave.": ".$valor."<br>"; //Mostrar el nombre del campo y su valor
    }
    if (isset($_POST['nombre'])){ //Si se ha recibido el campo nombre
        $nombre=$_POST['nombre'];
    }
    $apellidos=(isset($_POST['apellidos']))?$_POST['apellidos']:""; //Si se ha recibido el campo apellidos
    $fecha_de_nacimiento=(isset($_POST['fecha_de_nacimiento']))?$_POST['fecha_de_nacimiento']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $carnet=(isset($_POST['carnet']))?$_POST['carnet']:"";
    $marca=(isset($_POST['marca']))?$_POST['marca']:"";
    $modelo=(isset($_POST['modelo']))?$_POST['modelo']:"";
    $acabado=(isset($_POST['acabado']))?$_POST['acabado']:"";

    $archivo = fopen("vehiculos.txt", "a"); //Abrir el archivo en modo escritura al final del archivo
    $separador=";"; //Separador de campos
    fwrite($archivo, $nombre.$separador.$apellidos.$separador.$email.$separador.$fecha_de_nacimiento.$separador.$carnet.$separador.$marca.$separador.$modelo.$separador.$acabado."\n"); //Escribir los datos en el archivo
    fclose($archivo); //Cerrar el archivo
    echo "Datos guardados correctamente"; //Mensaje de éxito que será recibido por el cliente
    http_response_code(200); //Código de respuesta 200 , OK
}else{
    echo "Error al recibir los datos"; //Mensaje de error que será recibido por el cliente
    http_response_code(400); //Código de respuesta 400 , Bad Request
}
?>