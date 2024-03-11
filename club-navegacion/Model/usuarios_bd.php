<?php
function comprueba_usuario($usu,$pass):array{
    $con=BD::getConexion();
    $query="select usuarios.nombre_usuario,usuarios.password,roles.nombre as rol FROM
    usuarios left JOIN roles ON usuarios.rol_id=roles.id where usuarios.nombre_usuario=:usuario";
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usu);
    $statement->execute();
    if ($statement->rowCount()==1){
        $resultado=$statement->fetch(PDO::FETCH_ASSOC);
        $userOK=password_verify($pass,$resultado["password"]);
        $statement->closeCursor();
        if ($userOK==true){
            actualizaLoginDate($usu);
            crearSesion($usu,$resultado["rol"]);
            $resultado = array("id"=>1,
            "usuario"=>$usu,
            "rol"=>$resultado["rol"],
            "mensaje"=>"Usuario y contraseña correctos");
        }else{
            $resultado = array("id"=>-1,
            "mensaje"=>"Contraseña incorrecta");
        }
    }else{
        $statement->closeCursor();
        $resultado = array("id"=>-1,
            "mensaje"=>"Usuario no existe");
    }
    return $resultado;

}

function upsert_usuario($nombre_usuario,$password,$nombre,$apellidos,$email,$rol):array{
    
    
    try{
        $con =BD::getConexion();
    $query="select * from usuarios where nombre_usuario=:nombre_usuario"; //compruebo si existe ya un usuario . recordamso que usuario es primary key
   $statement= $con->prepare($query);
    $statement->bindValue(":nombre_usuario",$nombre_usuario);
    $statement->execute();
    $actualizapassword=false;
    if ($statement->rowCount()>0){
        //ya existe el usuario, lo actualizamos
        //comprobamos si hemos actualizado la password
      $res=$statement->fetch();
      if ($res["password"]!=$password){$actualizapassword=true;
        $query="update usuarios set email=:email,nombre=:nombre,apellidos=:apellidos,password=:password,rol_id=:rol where nombre_usuario=:nombre_usuario";
    }else{
        $query="update usuarios set email=:email,nombre=:nombre,apellidos=:apellidos,rol_id=:rol where nombre_usuario=:nombre_usuario";
    }


    }else{
        //no existe el usuario, lo insertamos
        $query="insert into usuarios (nombre_usuario,nombre,apellidos,email,password,rol_id) values (:nombre_usuario,:nombre,:apellidos,:email,:password,:rol)";
    }
   $statement= $con->prepare($query);
    $statement->bindValue(":nombre_usuario",$nombre_usuario);
    if($actualizapassword || $statement->rowCount()==0){
        $hashedpassword= password_hash($password,PASSWORD_DEFAULT);
        $statement->bindValue(":password",$hashedpassword);
    }

    $statement->bindValue(":nombre",$nombre);
    $statement->bindValue(":apellidos",$apellidos);
    $statement->bindValue(":email",$email);
    $statement->bindValue(":rol",$rol);
    $statement->execute();
    $statement->closeCursor();
 $resultado=array("id"=>1,
 "mensaje"=>"Usuario insertado / actualizado correctamente");
    }catch(PDOException $e){
        $resultado=array("id"=>0,
        "mensaje"=>"Ha ocurrido un error insertando / actualizando el usuario en la base de datos " . $e->getMessage()
    );
    }
    return $resultado;
}
function delete_usuario($usuario):bool{
    try{
        $con =BD::getConexion();
    $query="delete from usuarios where usuario=:usuario"; //compruebo si existe ya un usuario . recordamso que usuario es primary key
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usuario);
    $statement->execute();
    
    $statement->closeCursor();
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error borrando  el usuario en la base de datos ";
        $error.= $e->getMessage();
        include ("View/error.php");
        exit();
    }
}
function validaUsuarioRol($usuario,$rol):bool{
    $con =BD::getConexion();
    $query="select * FROM usuarios left JOIN roles ON usuarios.rol_id=roles.id WHERE usuarios.nombre_usuario=:usuario and roles.nombre=:rol";
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usuario);
    $statement->bindValue(":rol",$rol);
    $statement->execute();
    if ($statement->rowCount()>0){
        return true;
    }else{
        return false;
    }
}
function get_usuarios_by_username($username){

        $con =BD::getConexion();
        $query="select * from usuarios ";

        if ($username){ //el autor está definido, lo incluimos para filtrarlo
            $query.=" where usuario=:usuario";
        }
        $query.=" order by nombre";
       $statement= $con->prepare($query);
        if ($username){
            $statement->bindValue(":usuario",$username);
        }

        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;

}
function actualizaLoginDate($usuario){
    $con =BD::getConexion();
    $query="update usuarios set fecha_ultimo_ingreso=NOW() where nombre_usuario=:usuario"; 
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usuario);
    $statement->execute();

}


function borra_sesion($usuario){
    setcookie("usuario",null,time()-86400);
    setcookie("rol",null,time()-(3600*24));
    //destruimos también la sesión
    session_destroy();
    unset($_SESSION["carrito"]);

}
//creamos una cookie de usuario con duración de un día
function crearSesion($usuario,$rol){
    $_SESSION["usuario"]=$usuario;
    $_SESSION["rol"]=$rol;
    if (session_status() == PHP_SESSION_NONE) {
        // Si no hay una sesión activa, inicia una nueva sesión
        session_start();
    }
    
/**
    setcookie("usuario",$usuario,time()+(3600*24));
    if($rol){
        setcookie("rol",$rol,time()+(3600*24));
    }
*/
}
?>