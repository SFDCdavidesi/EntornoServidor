<?php
if (session_status() == PHP_SESSION_NONE) {
    // Si no hay una sesión activa, inicia una nueva sesión
    session_start();
}

  header('Content-Type: text/html; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

  require_once("../Model/BD.php");
  require_once("../Model/usuarios_bd.php");
    require_once("../Model/cursos_bd.php");
    require_once("../Model/calendario_bd.php");


    $action = (isset($_REQUEST["action"])?$_REQUEST["action"]:"");
    //obtenemos las variables que vienen por POST
    $nombreUsuario=(isset($_REQUEST["nombreUsuario"])?$_REQUEST["nombreUsuario"]:"");
    $nombre=(isset($_REQUEST["nombre"])?$_REQUEST["nombre"]:"");
    $apellidos=(isset($_REQUEST["apellidos"])?$_REQUEST["apellidos"]:"");
    $email=(isset($_REQUEST["email"])?$_REQUEST["email"]:"");
    $rol=(isset($_REQUEST["rol"])?$_REQUEST["rol"]:"");
    $password=(isset($_REQUEST["password"])?$_REQUEST["password"]:"");
    $password2=(isset($_REQUEST["password2"])?$_REQUEST["password2"]:"");
    $titulo=(isset($_REQUEST["titulo"])?$_REQUEST["titulo"]:"");
    $descripcion=(isset($_REQUEST["descripcion"])?$_REQUEST["descripcion"]:"");
    $nivel_requerido=(isset($_REQUEST["nivel_requerido"])?$_REQUEST["nivel_requerido"]:"");

    $duracion=(isset($_REQUEST["duracion"])?$_REQUEST["duracion"]:"");
    $medida_tiempo=(isset($_REQUEST["medida_tiempo"])?$_REQUEST["medida_tiempo"]:"");
    $ubicacion=(isset($_REQUEST["ubicacion"])?$_REQUEST["ubicacion"]:"");
    $numero_plazas=(isset($_REQUEST["numero_plazas"])?$_REQUEST["numero_plazas"]:"");
    $inscritos=(isset($_REQUEST["inscritos"])?$_REQUEST["inscritos"]:"");
    $id=(isset($_REQUEST["id"])?$_REQUEST["id"]:"");
    $duracion=(isset($_REQUEST["duracion"])?$_REQUEST["duracion"]:"");
    $entradilla=(isset($_REQUEST["entradilla"])?$_REQUEST["entradilla"]:"");
    $unidadDuracion=(isset($_REQUEST["unidadDuracion"])?$_REQUEST["unidadDuracion"]:"");
    $activos=(isset($_REQUEST["activos"])?$_REQUEST["activos"]:"");
    $nombreusuario=(isset($_REQUEST["nombreusuario"])?$_REQUEST["nombreusuario"]:"");
//datos para alta de curso y calendario
    $curso=(isset($_REQUEST["curso"])?$_REQUEST["curso"]:"");
    $nivel=(isset($_REQUEST["nivel"])?$_REQUEST["nivel"]:"");
    $plazas=(isset($_REQUEST["plazas"])?$_REQUEST["plazas"]:"");
    $fecha=(isset($_REQUEST["fecha"])?$_REQUEST["fecha"]:"");
    $activo=(isset($_REQUEST["activo"])?$_REQUEST["activo"]:"");
  
    $unidad_medida=(isset($_REQUEST["unidad_medida"])?$_REQUEST["unidad_medida"]:"");
    $precio=(isset($_REQUEST["precio"])?$_REQUEST["precio"]:"");

    $mes=(isset($_REQUEST["mes"])?$_REQUEST["mes"]:"");
    $token=(isset($_REQUEST["token"])?$_REQUEST["token"]:"");


    switch($action){
        case "get_fotos_curso":
            $resultArray=get_fotos_curso($id);
            break;
        case "get_nivel_requerido":
            $resultArray=get_niveles_by_id($id);
            break;
        case "get_calendarios":
            $resultArray=get_calendarios_by_month($mes);
            break;
        case "crea_usuario":
            $resultArray=upsert_usuario($nombreUsuario,$password,$nombre,$apellidos,$email,$rol);
            break;
        case "login":
            $resultArray=comprueba_usuario($nombreUsuario,$password);
            if ($resultArray["id"]==1){ //si el login es correcto, guardamos la sesión
                $_SESSION["usuario"]=$nombreUsuario;
                $_SESSION["rol"]=$resultArray["rol"];
            }
            break;
        case "alta_calendario":
            $resultArray=alta_calendario($curso,$nivel,$plazas,$fecha,$activo,$precio,$duracion,$unidad_medida);
            break;
       case "actualiza_curso":
       $actualizandocurso=1;
        case "alta_curso":
            $arrayAltaCurso=array("titulo"=>$titulo,"entradilla"=>$entradilla,"descripcion"=>$descripcion,"nivel_requerido"=>$nivel_requerido,"duracion"=>$duracion,"medida_tiempo"=>$unidadDuracion,"lugar_id"=>$ubicacion,"numero_plazas"=>$numero_plazas,
            "activo"=>$activo,
            "inscritos"=>$inscritos);
            $fotosSeleccionadas=$_POST["fotos"];
            if (isset($actualizandocurso) && $actualizandocurso==1){
                $resultArray=upsert_curso($arrayAltaCurso,$fotosSeleccionadas,$id);
            }else{
                          
            $resultArray=upsert_curso($arrayAltaCurso,$fotosSeleccionadas,null);
                        }
            break;
        case "docambiarcontraseña":
            $resultArray=actualizarcontraseña($token,$password,$password2);
            break;
       case "recuperarcontraseña":
            $resultArray=recuperar_contraseña($nombreusuario,$email);
            break;
        case "get_curso": //sólo un curso
             $resultArray=get_cursos_by_id($id);
            break;
        case "get_niveles":
            foreach(get_niveles_by_id(null) as $nivel){
                $resultArray[]=$nivel;
            }
            break;
        case "get_cursos":

            foreach(get_cursos_by_id(null) as $curso){
                if ($activos=="true"){
                    if (  $curso["activo"]==1){
                        $resultArray[]=$curso;
                    }
                    
                }else{
                    $resultArray[]=$curso;
                }

               
            }
            break;
        default:
            $resultArray=array("error"=>"No se ha encontrado la acción");
            break;

    }
   // $json = json_encode($resultArray,JSON_PRETTY_PRINT);
    
    /* Output header */
        header('Content-type: application/json');
       echo  json_encode($resultArray, JSON_PRETTY_PRINT);
        
  ?>