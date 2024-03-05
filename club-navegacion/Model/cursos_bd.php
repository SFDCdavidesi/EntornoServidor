<?php

function get_lugar_by_id($id_lugar){
    try{
        $con =BD::getConexion();
        $query="select * from lugares ";
        if ($id_lugar){ //el lugar está definido, lo incluimos para filtrarlo
            $query.=" where id=:id_lugar";
        }
        $query.=" order by nombre";
       $statement= $con->prepare($query);
        if ($id_lugar){
            $statement->bindValue(":id_lugar",$id_lugar);
        }
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el lugar en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }


}
function get_tiempo_by_id($id){
    try{
        $con =BD::getConexion();
        $query="select * from medida_tiempo ";
        if ($id){ //el tiempo está definido, lo incluimos para filtrarlo
            $query.=" where id=:id";
        }
        $query.=" order by nombre";
       $statement= $con->prepare($query);
        if ($id){
            $statement->bindValue(":id",$id);
        }
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el tiempo en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }


}
function alta_curso($arrayCurso,$files){
    try{
        /**  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `nivel_requerido` int(11) NOT NULL CHECK (`nivel_requerido` >= 1 and `nivel_requerido` <= 5),
  `lugar_id` int(11) DEFAULT NULL,
  `numero_plazas` int(11) NOT NULL,
  `duracion` int(2) NOT NULL,
  `medida_tiempo` int(11) NOT NULL,
  `inscritos` int(11) NOT NULL,
  `foto1` varchar(255) DEFAULT NULL,
  `foto2` varchar(255) DEFAULT NULL,
  `foto3` varchar(255) DEFAULT NULL,
  `foto4` varchar(255) DEFAULT NULL */
        $con =BD::getConexion();
        $query="insert into cursos (titulo,descripcion,nivel_requerido,lugar_id,numero_plazas,duracion,medida_tiempo,inscritos,foto1,foto2,foto3,foto4,createdby) values (:titulo,:descripcion,:nivel_requerido,:lugar_id,:numero_plazas,:duracion,:medida_tiempo,:inscritos,:foto1,:foto2,:foto3,:foto4,:createdby)";
        $statement= $con->prepare($query);
        $statement->bindValue(":titulo",$arrayCurso["titulo"]);
        $statement->bindValue(":descripcion",$arrayCurso["descripcion"]);
        $statement->bindValue(":nivel_requerido",$arrayCurso["nivel_requerido"]);
        $statement->bindValue(":lugar_id",$arrayCurso["lugar_id"]);
        $statement->bindValue(":numero_plazas",$arrayCurso["numero_plazas"]);
        $statement->bindValue(":duracion",$arrayCurso["duracion"]);
        $statement->bindValue(":medida_tiempo",$arrayCurso["medida_tiempo"]);
        $statement->bindValue(":inscritos",0);
        $statement->bindValue(":createdby",$_SESSION["usuario"]);

   
  
for ($i=1;$i<=4;$i++){
    $foto="foto".$i;
    if ($_FILES[$foto]["name"]) {
        $foto_tmp = $_FILES[$foto]["tmp_name"];
        $foto_destino = "../View/img/fotosCursos/" . $_FILES[$foto]["name"];
        
        // Check if file already exists
        if (file_exists($foto_destino)) {

        do{
            $random_string = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
            $foto_destino = "../View/img/fotosCursos/" . $random_string . $_FILES[$foto]["name"];
        }while (file_exists($foto_destino)) ;
        }
        $statement->bindValue(":".$foto,$foto_destino);
        
        move_uploaded_file($foto_tmp, $foto_destino);
    }
}

                
              


        $statement->execute();
        $statement->closeCursor();
        $arrayResultado = array("id" => 1, "mensaje" => "Curso insertado correctamente");
        return arrayResultado;
    }catch(PDOException $e){
        $arrayResultado = array("id" => 0, "mensaje" => "Ha ocurrido un error insertando el curso en la base de datos " . $e->getMessage());
        return arrayResultado;
        exit();
    }

}
function get_cursos_by_id($id){
    try{
        $con =BD::getConexion();
        $query="select * from cursos ";
        if ($id){ //el curso está definido, lo incluimos para filtrarlo
            $query.=" where id=:id";
        }
        $query.=" order by  titulo";
       $statement= $con->prepare($query);
        if ($id){
            $statement->bindValue(":id",$id);
        }
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el curso en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }

}

/*
function upsert_autor($codigo_autor,$nombre,$apellidos,$año_nacimiento):bool{
    
    
    try{
        $con =BD::getConexion();
    if ($codigo_autor){
        //ya existe el autor, lo actualizamos
        $query="update autores set nombre=:nombre,apellidos=:apellidos,año_nacimiento=:anio_nacimiento where codigo_autor=:codigo_autor";
    }else{
        //no existe el usuario, lo insertamos
        $query="insert into autores (nombre,apellidos,año_nacimiento) values (:nombre,:apellidos,:anio_nacimiento)";
  
    }
   $statement= $con->prepare($query);
    if($codigo_autor){
        $statement->bindValue(":codigo_autor",$codigo_autor);

    }
    $statement->bindValue(":nombre",$nombre);
    $statement->bindValue(":apellidos",$apellidos);
    $statement->bindValue(":anio_nacimiento",$año_nacimiento);


    $statement->execute();
    $statement->closeCursor();
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error insertando / actualizando el autor en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }

}
function delete_autor($codigo_autor):bool{
    try{
        $con =BD::getConexion();
    $query="delete from autores where codigo_autor=:codigo_autor"; //compruebo si existe ya un usuario . recordamso que usuario es primary key
   $statement= $con->prepare($query);
    $statement->bindValue(":codigo_autor",$codigo_autor);
    $statement->execute();
    
    $statement->closeCursor();
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error borrando  el autor en la base de datos ";
        $error.= $e->getMessage();
        include ("View/error.php");
        exit();
    }
}
function get_autores_by_autor($autor){
    try{
        $con =BD::getConexion();
        $query="select * from autores ";

        if ($autor){ //el autor está definido, lo incluimos para filtrarlo
            $query.=" where codigo_autor=:autor";
        }
        $query.=" order by apellidos";
       $statement= $con->prepare($query);
        if ($autor){
            $statement->bindValue(":autor",$autor);
        }

        $statement->execute();
        $resultados=$statement->fetchAll();
        $statement->closeCursor();
        return $resultados;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el libro en la base de datos ";
        $error.= $e->getMessage();
        include ("View/error.php");
        exit();
    }
}
*/

?>