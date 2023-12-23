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
    $password2=(isset($_REQUEST["password2"])?$_REQUEST["password2"]:"");

    $password=(isset($_REQUEST["password"])?$_REQUEST["password"]:"");
    $disponible=(isset($_REQUEST["disponible"]) && $_REQUEST["disponible"]==true?true:false);
    $nombre=(isset($_REQUEST["nombre"])?$_REQUEST["nombre"]:"");
    $apellidos=(isset($_REQUEST["apellidos"])?$_REQUEST["apellidos"]:"");
    $año_nacimiento=(isset($_REQUEST["año_nacimiento"])?$_REQUEST["año_nacimiento"]:"");
    $email=(isset($_REQUEST["email"])?$_REQUEST["email"]:"");
    $rol=(isset($_REQUEST["rol"])?$_REQUEST["rol"]:"");




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
        default:
       
            header("Location: .?action=list_libros");
    }

    