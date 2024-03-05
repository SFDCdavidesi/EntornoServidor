<?php
  header('Content-Type: text/html; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

  require_once("../Model/BD.php");
  require_once("../Model/usuarios_bd.php");
    require_once("../Model/cursos_bd.php");

    $action = (isset($_REQUEST["action"])?$_REQUEST["action"]:"");
    //obtenemos las variables que vienen por POST
    $nombreUsuario=(isset($_REQUEST["nombreUsuario"])?$_REQUEST["nombreUsuario"]:"");
    $nombre=(isset($_REQUEST["nombre"])?$_REQUEST["nombre"]:"");
    $apellidos=(isset($_REQUEST["apellidos"])?$_REQUEST["apellidos"]:"");
    $email=(isset($_REQUEST["email"])?$_REQUEST["email"]:"");
    $rol=(isset($_REQUEST["rol"])?$_REQUEST["rol"]:"");
    $password=(isset($_REQUEST["password"])?$_REQUEST["password"]:"");
    $password2=(isset($_REQUEST["password2"])?$_REQUEST["password2"]:"");
    $resultArray=array("error"=>"No se ha encontrado la acción");
    $descripcion=(isset($_REQUEST["descripcion"])?$_REQUEST["descripcion"]:"");
    $nivel_requerido=(isset($_REQUEST["nivel_requerido"])?$_REQUEST["nivel_requerido"]:"");

    $duracion=(isset($_REQUEST["duracion"])?$_REQUEST["duracion"]:"");
    $medida_tiempo=(isset($_REQUEST["medida_tiempo"])?$_REQUEST["medida_tiempo"]:"");
    $lugar_id=(isset($_REQUEST["lugar_id"])?$_REQUEST["lugar_id"]:"");
    $numero_plazas=(isset($_REQUEST["numero_plazas"])?$_REQUEST["numero_plazas"]:"");
    $inscritos=(isset($_REQUEST["inscritos"])?$_REQUEST["inscritos"]:"");
    $foto1=(isset($_FILES["foto1"])?$_FILES["foto1"]:null);
    $foto2=(isset($_FILES["foto2"])?$_FILES["foto2"]:null);
    $foto3=(isset($_FILES["foto3"])?$_FILES["foto3"]:null);
    $foto4=(isset($_FILES["foto4"])?$_FILES["foto4"]:null);

    switch($action){
        case "crea_usuario":
            $resultArray=upsert_usuario($nombreUsuario,$password,$nombre,$apellidos,$email,$rol);
            break;
        case "login":
            $resultArray=comprueba_usuario($nombreUsuario,$password);
            break;
        case "alta_curso":
            $arrayAltaCurso=array("titulo"=>$nombre,"descripcion"=>$descripcion,"nivel_requerido"=>$nivel_requerido,"duracion"=>$duracion,"medida_tiempo"=>$medida_tiempo,"lugar_id"=>$lugar_id,"numero_plazas"=>$numero_plazas,"inscritos"=>$inscritos,"foto1"=>$foto1,"foto2"=>$foto2,"foto3"=>$foto3,"foto4"=>$foto4);
            $resultArray=alta_curso($arrayAltaCurso,$_FILES);
            break;
        default:
            $resultArray=array("error"=>"No se ha encontrado la acción");
            break;

    }
    $json= json_encode($resultArray);
    /* Output header */
        header('Content-type: application/json');
       echo  json_encode($json, JSON_PRETTY_PRINT);
        
  ?>