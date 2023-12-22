<?php
    require('../Model/BD.php');
    require('../Model/autores_bd.php');
    require('../Model/libros_bd.php');
    require('../Model/usuarios_bd.php');

    session_start();
 
    $action = (isset($_REQUEST["action"])?$_REQUEST["action"]:"");
    $codigo_autor=(isset($_REQUEST["codigo_autor"])?$_REQUEST["codigo_autor"]:"");

    $codigo=(isset($_REQUEST["codigo"])?$_REQUEST["codigo"]:"");
    $titulo=(isset($_REQUEST["titulo"])?$_REQUEST["titulo"]:"");
    $descripcion=(isset($_REQUEST["descripcion"])?$_REQUEST["descripcion"]:"");
    $precio=(isset($_REQUEST["precio"])?$_REQUEST["precio"]:"");
    $usuario=(isset($_REQUEST["usuario"])?$_REQUEST["usuario"]:"");
    $password=(isset($_REQUEST["password"])?$_REQUEST["password"]:"");
    $disponible=(isset($_REQUEST["disponible"]) && $_REQUEST["disponible"]==true?true:false);
    $nombre=(isset($_REQUEST["nombre"])?$_REQUEST["nombre"]:"");
    $apellidos=(isset($_REQUEST["apellidos"])?$_REQUEST["apellidos"]:"");
    $año_nacimiento=(isset($_REQUEST["año_nacimiento"])?$_REQUEST["año_nacimiento"]:"");
    $email=(isset($_REQUEST["email"])?$_REQUEST["email"]:"");





    switch($action) {
        case "list_libros": 
            $libros = get_libros_by_autor($codigo_autor);
            $autores = get_autores_by_autor(null);

            include('../View/libros_list.php');
            break;
     case "list_autores": 
             
                $autores = get_autores_by_autor($codigo_autor);    
                include('../View/autores_list.php');
                break;
        case "add_libro": 
        case "update_libro":
                upsert_libro($codigo,$titulo,$codigo_autor,$descripcion,$precio,$disponible);
                header("Location: .?action=list_libros");
                break;
        case "add_autor": 
        case "update_autor":
                upsert_autor($codigo_autor,$nombre,$apellidos,$año_nacimiento);
                $autores = get_autores_by_autor($codigo_autor);
                header("Location: .?action=list_autores");
                break;
        case "add_usuario": 
        case "update_usuario":
            upsert_usuario($usuario,$password,$nombre,$apellidos,$email);
            header("Location: .?action=list_usuarios");
        break;
        
        case "delete_autor":
            if ($codigo_autor) {
                try {
                    delete_autor($codigo_autor);
                } catch (PDOException $e) {
                    $error = "Ha ocurrido un error al eliminar al autor.";
                    include('../view/error.php');
                    exit();
                }
                header("Location: .?action=list_courses");
            }
            break;
        case "mostrar_login":
            include ("../View/login.php");
            break;
        case "dologin":
           if(! comprueba_usuario($usuario,$password)){
            $error="El usuario introducido no es correcto";
            include ("../View/login.php");
            exit();
           }
           header("Location: .?action=list_libros");
            break;
        case "mostrar_alta_usuarios":
            $usuarios=get_usuarios_by_username($usuario);
            include ("../View/usuarios_list.php");
            break;
        case "crea_usuario":
            upsert_usuario($usuario,$password,$nombre,$apellidos,$email);
            $usuarios=get_usuarios_by_username($usuario);
            include ("../View/usuarios_list.php");
            break;
        case "delete_usuario":
                delete_usuario($usuario);
                $usuarios=get_usuarios_by_username($usuario);
                include("../View/usuarios_list.php");
                break;
        case "logout":
                borra_sesion($usuario);
                header("Location: .?action=list_libros");

        case "ver_carrito":
            $codigoslibro=array_keys($_SESSION["carrito"]);
            $libros=get_libros_by_codigolibro($codigoslibro);
            $totalCarrito=calculaTotal($_SESSION["carrito"],$libros);
            include ("../View/ver_carrito.php");
            break;
        case "buy_libro":
            comprarLibro($codigo);
            default:
       
            header("Location: .?action=list_libros");
    }

    