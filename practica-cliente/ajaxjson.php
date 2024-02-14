<?php
// Ruta al archivo CSV
$archivo = 'registros.csv';

// Función para agregar un nuevo registro de usuario al archivo CSV
function agregarRegistro($nombre, $apellidos, $email, $fechaNacimiento) {
    global $archivo;
    $nuevoRegistro = array($nombre, $apellidos, $email, $fechaNacimiento);
    $manejadorArchivo = fopen($archivo, 'a');
    fputcsv($manejadorArchivo, $nuevoRegistro);
    fclose($manejadorArchivo);
}

// Función para leer todos los registros de usuarios del archivo CSV
function leerRegistros() {
    global $archivo;
    $registros = array();
    $manejadorArchivo = fopen($archivo, 'r');
    while (($registro = fgetcsv($manejadorArchivo)) !== false) {
        $registros[] = $registro;
    }
    fclose($manejadorArchivo);
    return $registros;
}

// Función para buscar un registro por nombre, apellidos o ambos
function buscarRegistro($nombre = null, $apellidos = null) {
    $registros = leerRegistros();
    $resultados = array();
    foreach ($registros as $registro) {
        if (($nombre === null || strpos(strtolower($registro[0]), strtolower($nombre)) !== false) && ($apellidos === null || strpos(strtolower($registro[1]), strtolower($apellidos)) !== false)) {
            $resultados[] = $registro;
        }
    }
    return $resultados;
}

// Manejar las solicitudes HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los datos requeridos se han recibido


    if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['fechaNacimiento'])) {
        // Agregar un nuevo registro
        
        agregarRegistro($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['fechaNacimiento']);
        echo "Registro agregado correctamente.";
    } else {
        // Datos incompletos
        http_response_code(400);
        echo "Todos los campos son obligatorios.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verificar si se está realizando una búsqueda
    if (isset($_GET['nombre']) || isset($_GET['apellidos'])) {
        // Realizar búsqueda por nombre, apellidos o ambos
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $apellidos = isset($_GET['apellidos']) ? $_GET['apellidos'] : null;
        $resultados = buscarRegistro($nombre, $apellidos);
        header('Content-Type: application/json');
        echo json_encode($resultados);
    } else {
        // Leer todos los registros si no se especifica una búsqueda
        $registros = leerRegistros();
        header('Content-Type: application/json');
        echo json_encode($registros);
    }
} else {
    // Método no permitido
    http_response_code(405);
    echo "Método no permitido.";
}
?>
