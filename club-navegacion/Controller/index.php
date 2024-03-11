<?php
    session_start();

    require('../Model/BD.php');
    require("../Model/usuarios_bd.php");
    require("../Model/cursos_bd.php");
    require_once ("../Model/funciones.php");


 
    $action = (isset($_REQUEST["action"])?$_REQUEST["action"]:"");
    $usuario=(isset($_REQUEST["nombreUsuario"])?$_REQUEST["nombreUsuario"]:"");
    $password=(isset($_REQUEST["password"])?$_REQUEST["password"]:"");
    $nombre=(isset($_REQUEST["nombre"])?$_REQUEST["nombre"]:"");
    $apellidos=(isset($_REQUEST["apellidos"])?$_REQUEST["apellidos"]:"");
    $email=(isset($_REQUEST["email"])?$_REQUEST["email"]:"");
    $rol=(isset($_REQUEST["rol"])?$_REQUEST["rol"]:"");





    switch($action) {
        case "login": 

            include('../View/login.php');
            break;
        case "crea_usuario": 
            $params = array("action"=>"crea_usuario",
                            "nombreUsuario"=>$usuario,
                            "password"=>$password,
                            "nombre"=>$nombre,
                            "apellidos"=>$apellidos,
                            "email"=>$email,
                            "rol"=>$rol);
            $response= makeCurlRequest($params);
          
         
            break;
        case "logout": 
            borra_sesion($_SESSION["usuario"]);
            header("Location: .?action=menu_principal");

            break;
        case "guarda_sesion":
            $usuario=$_POST["usuario"];
            $rol=$_POST["rol"];
            if(validaUsuarioRol($usuario,$rol)){
                $_SESSION["usuario"]=$usuario;
                $_SESSION["rol"]=$rol;
                $arrayResultado=array("id"=>1,"mensaje"=>"Sesión guardada correctamente");
            }else{
                $arrayResultado=array("id"=>0,"mensaje"=>"Error guardando la sesión");
            }
            $json= json_encode($arrayResultado);
            /* Output header */
                header('Content-type: application/json');
               echo  json_encode($json, JSON_PRETTY_PRINT);
            
            break;
                case "ver_cursos":
                    $verFormularioGestionCursos=false;
                    include ("../View/gestion_cursos.php");
                    break;
     case "gestion_cursos": 
                //$cursos = get_cursos_by_id(null);
                if ($_SESSION["rol"]=="admin"){
                    $verFormularioGestionCursos=true;
                }
                $lugares=get_lugar_by_id(null);
                $tiempos=get_tiempo_by_id(null);
                $fotos=get_fotos_by_directory("img/fotosCursos");
                include('../View/gestion_cursos.php');
                break;
        case  "update_libroForm":
                $limo=get_libros_by_codigolibro([$codigo])[0]; //obtenemos el libro seleccionado [LIbroModificar] para modificar
                $autores = get_autores_by_autor(null);
                $libros=array();
                $codigo_autor=$limo["codigo_autor"];
                include('../View/libros_list.php');
             
                break;
        case "add_libro": 
          //add y update hacen lo mismo
        
        case "update_libro":
                upsert_libro($codigo,$titulo,$codigo_autor,$descripcion,$precio,$disponible);
                header("Location: .?action=list_libros&codigo_autor=".$codigo_autor);
                break;
        case "add_autor": 
        case "update_autor":
                upsert_autor($codigo_autor,$nombre,$apellidos,$año_nacimiento);
                $autores = get_autores_by_autor($codigo_autor);
                header("Location: .?action=list_autores");
                break;
        case "add_usuario": 
        case "update_usuario":
            upsert_usuario($usuario,$password,$nombre,$apellidos,$email,$rol);
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
            $resultadologin= comprueba_usuario($usuario,$password);
            if ($resultadologin==2){
                $error="El usuario y contraseña no son correctos";
                include ("../View/login.php");
                exit();
            }else if ($resultadologin==3){
                $error="El usuario no existe";
                include ("../View/login.php");
                exit(); 
            }else{
                header("Location: .?action=list_libros");
            }
         
           break;
    
        case "mostrar_alta_usuarios":
            $usuarios=get_usuarios_by_username($usuario);
            include ("../View/usuarios_list.php");
            break;
        case "update_usuarioForm":
            $usumodi=get_usuarios_by_username($usuario)[0];
            $usuarios=array();
            include ("../View/usuarios_list.php");
            break;
        case "crea_usuario":
        case "update_usuario":
            if ($password==$password2){
                upsert_usuario($usuario,$password,$nombre,$apellidos,$email,$rol);
            }else{
                $muestraMensajeError="Las passwords no coinciden";
                $usumodi=["usuario"=>$usuario,
                "password"=>"",
                "nombre"=>$nombre,
                "apellidos"=>$apellidos,
                "email"=>$email,
                "rol"=>$rol];
            }
           
            $usuarios=get_usuarios_by_username($usuario);
            $mensaje="Usuario añadido correctamente";
            include ("../View/usuarios_list.php");
            break;
        case "delete_usuario":
                delete_usuario($usuario);
                $usuarios=get_usuarios_by_username($usuario);
                include("../View/usuarios_list.php");
                break;
        case "delete_libro":
                    delete_libro($codigo);
                    if (isset($_SESSION["carrito"])){
                        eliminar_libros_carrito($codigo);
                    }
                    header("Location: .?action=list_libros&codigo_autor=".$codigo_autor);
                    break;
        case "logout":
                borra_sesion($usuario);
                header("Location: .?action=list_libros");
                break;
        case "incrementar_carrito":
                modificar_carrito($codigo,1);
                header("Location: .?action=ver_carrito");
                break;
         case "decrementar_carrito":
                 modificar_carrito($codigo,-1);
              header("Location: .?action=ver_carrito");
             break;
                             
        case "ver_carrito":
            if(isset($_SESSION["carrito"])){
                $codigoslibro=array_keys($_SESSION["carrito"]);
                $libros=get_libros_by_codigolibro($codigoslibro);
                $totalCarrito=calculaTotal($_SESSION["carrito"],$libros);
            }else{
                $codigoslibro=array();
                $libros=array();
                $totalCarrito=0;
            }

            include ("../View/ver_carrito.php");
            break;
        case "buy_libro":
            $error="";
            comprarLibro($codigo);
            $mensaje=$error;
            unset($error);
            $libros = get_libros_by_autor($codigo_autor);
            $autores = get_autores_by_autor(null);
       
            include('../View/libros_list.php');
            break;
        case "menu_principal":
            include ("../View/menu_principal.php");
            break;
        default:
       
            header("Location: .?action=menu_principal");
    }

    