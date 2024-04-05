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

function upsert_curso($arrayCurso,$fotosSeleccionadas,$id){
    $arrayResultado = array();
    if ($_SESSION["rol"]!="admin"){
        $arrayResultado = array("id" => 0, "mensaje" => "No tienes permisos para realizar esta acción");
        return $arrayResultado;
    }
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
        if ($id==null){
            $query="insert into cursos (titulo,entradilla,descripcion,lugar_id,duracion,medida_tiempo,createdby,nivel_requerido,activo) values (:titulo,:entradilla,:descripcion,:lugar_id,:duracion,:medida_tiempo,:createdby,1,:activo)";
        }else{
            $query="update cursos set titulo=:titulo,entradilla=:entradilla,descripcion=:descripcion,lugar_id=:lugar_id,duracion=:duracion,medida_tiempo=:medida_tiempo,activo=:activo where id=:id";
        }

        $statement= $con->prepare($query);
        if ($id!=null){
            $statement->bindValue(":id",$id);
        }else{
          //  $statement->bindValue(":createdby",$_SESSION["usuario"]);
            $statement->bindValue(":createdby",$_SESSION["id_usuario"]);
        }
        $statement->bindValue(":titulo",$arrayCurso["titulo"]);
        $statement->bindValue(":entradilla",$arrayCurso["entradilla"]);
        $statement->bindValue(":descripcion",$arrayCurso["descripcion"]);
       
        $statement->bindValue(":lugar_id",$arrayCurso["lugar_id"]);
     //   $statement->bindValue(":numero_plazas",$arrayCurso["numero_plazas"]);
        $statement->bindValue(":duracion",$arrayCurso["duracion"]);
        $statement->bindValue(":medida_tiempo",$arrayCurso["medida_tiempo"]);
      
      
        $statement->bindValue(":activo",$arrayCurso["activo"]=="true"?1:0);

   
 

        $statement->execute();
        $statement->closeCursor();
        $idcurso=$con->lastInsertId();
        
        //insertamos las fotos en el caso de que se hayan incluido
        if ($fotosSeleccionadas!=null && count($fotosSeleccionadas)>0){
            if ($id!=null){
                $idcurso=$id;
                //borramos las fotos anteriores
                $query="delete from fotosCursos where id_curso=:id";
                $statement= $con->prepare($query);
                $statement->bindValue(":id",$id);
                $statement->execute();
                $statement->closeCursor();
            }
            $queryFotos ="insert into fotosCursos (id_curso,foto) values ";

            for ($i=0;$i<count($fotosSeleccionadas);$i++){
                $queryFotos.="(:id_curso,:foto" . $i . ")";
                if ($i < count($fotosSeleccionadas) - 1) {
                    $queryFotos.=",";
                }
            }  
            $statement= $con->prepare($queryFotos); 
            for ($i=0;$i<count($fotosSeleccionadas);$i++){
                $statement->bindValue(":id_curso",$idcurso);
                $statement->bindValue(":foto" . $i,$fotosSeleccionadas[$i]);
            }  

                $statement->execute();
                $statement->closeCursor();
            }
          
        $queryFotos ="insert into fotosCursos (id_curso,foto) values(:id_curso,:foto)";
        $arrayResultado = array("id" => 1, "mensaje" => "Curso insertado correctamente",
    "registrocreado"=> $idcurso);
        return $arrayResultado;
    }catch(PDOException $e){
        $arrayResultado = array("id" => 0, "mensaje" => "Ha ocurrido un error insertando el curso en la base de datos " . $e->getMessage());
        return $arrayResultado;
        exit();
    }

}

function borrar_curso($id){
    $arrayResultado = array();
    if ($_SESSION["rol"]!="admin"){
        $arrayResultado = array("id" => 0, "mensaje" => "No tienes permisos para realizar esta acción");
        return $arrayResultado;
    }
    try{
        $con =BD::getConexion();
        $query="delete from cursos where id=:id";
        $statement= $con->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $statement->closeCursor();
        $arrayResultado = array("id" => 1, "mensaje" => "Curso borrado correctamente");
        return $arrayResultado;
    }catch(PDOException $e){
        http_response_code(500); // Código de error de servidor interno
        $arrayResultado = array("id" => 0, "mensaje" => "Ha ocurrido un error borrando el curso en la base de datos " . $e->getMessage());
        return $arrayResultado;
        exit();
    }
}   
/**
 * Obtiene los niveles de la base de datos
 */
function get_niveles_by_id($id){
    try{
        $con =BD::getConexion();
        $query="select * from niveles ";
        if ($id){ //el nivel está definido, lo incluimos para filtrarlo
            $query.=" where id=:id";
        }
        $query.=" order by id";
       $statement= $con->prepare($query);
        if ($id){
            $statement->bindValue(":id",$id);
        }
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el nivel en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }


}
function get_cursos_by_id($id){
    try{
        $con =BD::getConexion();
        $query="SELECT cursos.id as id,
        cursos.titulo as titulo ,
        cursos.entradilla as entradilla,
        cursos.descripcion as descripcion,
        lugares.nombre AS ubicacion,
        cursos.duracion as duracion, 
        medida_tiempo.nombre AS unidadDuracion,
        activo,
        nivel_requerido,
        numero_plazas,
        cursos.lugar_id as lugar_id,
        cursos.medida_tiempo as medida_tiempo
        
    
    FROM
        cursos
    JOIN
        lugares ON cursos.lugar_id = lugares.id
    JOIN
        medida_tiempo ON cursos.medida_tiempo = medida_tiempo.id";
        if ($id){ //el curso está definido, lo incluimos para filtrarlo
            $query.=" where cursos.id=:id";
        }
        $query.=" order by titulo";
       $statement= $con->prepare($query);
        if ($id){
            $statement->bindValue(":id",$id);
        }
        $statement->execute();
        if ($statement->rowCount()>0){
            $resultado=$statement->fetchAll();
        }else{
            $resultado=array("id"=>0,"mensaje"=>"No se ha encontrado el curso [" . $id . "]");
        }
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el curso en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }

}
function get_fotos_curso($id){
    try{
        $con =BD::getConexion();
        $query="select * from fotosCursos where id_curso=:id";
        $statement= $con->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  las fotos del curso en la base de datos ";
        $error.= $e->getMessage();
        
       
        exit();
        return  array("id"=>0,"mensaje"=>$error);
    }

}
function pintaOptionsSelect($arrayOpciones,$clave=null,$valor=null){
    $html="";
    foreach($arrayOpciones as $opcion){
        if ($clave){
            $html.="<option value='" . $opcion[$clave] . "'>" . $opcion[$valor] . "</option>";
        }else{
            $html.="<option value='" . $opcion . "'>" . $opcion . "</option>";
        }
        $html.="\n";
    }
    return $html;
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