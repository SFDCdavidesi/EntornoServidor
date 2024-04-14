<?php
function alta_calendario($curso,$nivel,$plazas,$fecha,$activo,$precio,$duracion,$unidad_medida){
    try{
        $con =BD::getConexion();
        $query="insert into calendario (id_curso,nivel_requerido,plazas_disponibles,fecha,activo,precio,createdby) values (:curso,:nivel,:plazas,:fecha,:activo,:precio,:createdby)";
        $statement= $con->prepare($query);
        $statement->bindValue(":curso",$curso);
        $statement->bindValue(":nivel",$nivel);
        $statement->bindValue(":plazas",$plazas);
        $statement->bindValue(":fecha",$fecha);
        $statement->bindValue(":activo",$activo=="true"?1:0);
        $statement->bindValue(":precio",$precio);
        $statement->bindValue(":createdby",$_SESSION["id_usuario"]); //añadimos el usuario que está dando de alta el curso
        $statement->execute();
        $statement->closeCursor();
        $resultado=array("id"=>$con->lastInsertId(),
        "mensaje"=>"Curso dado de alta correctamente");
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error dando de alta el curso en la base de datos ";
        $error.= $e->getMessage();
        $resultado=array("id"=>0,"mensaje"=>$error);
        include ("../View/error.php");
        return $resultado;
        exit();
    }
}

function get_calendarios_by_month($mes){
    try{
        $con =BD::getConexion();
        $query="select c.id,c.curso_id as idcurso, c.fecha, c.plazas_disponibles, c.activo, c.precio, c.nivel_requerido, n.nombre as nivel, cu.titulo as curso from calendario c inner join niveles n on c.nivel_requerido=n.id inner join cursos cu on c.curso_id=cu.id";
        $statement= $con->prepare($query);
        if ($mes!=null){
            $query.=" where month(c.fecha)=:mes";
            $statement->bindValue(":mes",$mes);
        } 
       
       
        $statement->execute();
        $resultado=$statement->fetchAll();
        $statement->closeCursor();
        return $resultado;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo los calendarios en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }
}
?>