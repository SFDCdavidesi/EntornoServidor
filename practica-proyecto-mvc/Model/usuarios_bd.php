<?php
function comprueba_usuario($usu,$pass):int{
    $con=BD::getConexion();
    $query="select usuario,password,rol from usuarios where usuario=:usuario";
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
            return 1;
        }else{
            return 2;
        }
    }else{
        $statement->closeCursor();
       return 3;
    }

}

function upsert_usuario($usuario,$password,$nombre,$apellidos,$email,$rol):bool{
    
    
    try{
        $con =BD::getConexion();
    $query="select * from usuarios where usuario=:usuario"; //compruebo si existe ya un usuario . recordamso que usuario es primary key
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usuario);
    $statement->execute();
    $actualizapassword=false;
    if ($statement->rowCount()>0){
        //ya existe el usuario, lo actualizamos
        //comprobamos si hemos actualizado la password
      $res=$statement->fetch();
      if ($res["password"]!=$password){$actualizapassword=true;
        $query="update usuarios set email=:email,nombre=:nombre,apellidos=:apellidos,password=:password,rol=:rol where usuario=:usuario";
    }else{
        $query="update usuarios set email=:email,nombre=:nombre,apellidos=:apellidos,rol=:rol where usuario=:usuario";
    }


    }else{
        //no existe el usuario, lo insertamos
        $query="insert into usuarios (usuario,nombre,apellidos,email,password,rol) values (:usuario,:nombre,:apellidos,:email,:password,:rol)";
    }
   $statement= $con->prepare($query);
    $statement->bindValue(":usuario",$usuario);
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
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error insertando / actualizando el usuario en la base de datos";
        include ("../View/error.php");
        exit();
    }

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
    $query="update usuarios set lastlogindate=NOW() where usuario=:usuario"; 
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
setcookie("usuario",$usuario,time()+(3600*24));
if($rol){
    setcookie("rol",$rol,time()+(3600*24));
}
}
?>