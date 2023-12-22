<?php


function upsert_libro($codigo,$titulo,$codigo_autor,$descripcion,$precio,$disponible):bool{
    
    
    try{
        $con =BD::getConexion();
    if ($codigo){
        //ya existe el usuario, lo actualizamos
        $query="update libros set titulo=:titulo,codigo_autor=:codigo_autor,descripcion=:descripcion,precio=:precio,disponible=:disponible where codigo=:codigo";
    }else{
        //no existe el usuario, lo insertamos
        $query="insert into libros (titulo,codigo_autor,descripcion,precio,disponible) values (:titulo,:codigo_autor,:descripcion,:precio,:disponible)";
  
    }
   $statement= $con->prepare($query);
    if($codigo){
        $statement->bindValue(":codigo",$codigo);

    }
    $statement->bindValue(":titulo",$titulo);
    $statement->bindValue(":codigo_autor",$codigo_autor);
    $statement->bindValue(":descripcion",$descripcion);
    $statement->bindValue(":precio",$precio);
    $statement->bindValue(":disponible",$disponible);

    $statement->execute();
    $statement->closeCursor();
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error insertando / actualizando el libro en la base de datos ";
        $error.= $e->getMessage();
        include ("View/error.php");
        exit();
    }

}
function delete_libro($codigo):bool{
    try{
        $con =BD::getConexion();
    $query="delete from libros where codigo=:codigo"; //compruebo si existe ya un usuario . recordamso que usuario es primary key
   $statement= $con->prepare($query);
    $statement->bindValue(":codigo",$codigo);
    $statement->execute();
    
    $statement->closeCursor();
    return true;
    }catch(PDOException $e){
        $error="Ha ocurrido un error borrando  el libro en la base de datos ";
        $error.= $e->getMessage();
        include ("View/error.php");
        exit();
    }
}
function get_libros_by_autor($autor){
    try{
        $con =BD::getConexion();
        $query="select l.codigo,l.titulo,a.nombre,a.apellidos,l.disponible,l.descripcion,l.precio from libros l left join autores a on l.codigo_autor=a.codigo_autor";

        if ($autor){ //el autor está definido, lo incluimos para filtrarlo
            $query.=" where l.codigo_autor=:autor";
        }
        $query.=" order by l.codigo";
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
        include ("../View/error.php");
        exit();
    }
}
function get_libros_by_codigolibro($arrayLibros){
    try{
        $con =BD::getConexion();
        $query="select l.codigo,l.titulo,a.nombre,a.apellidos,l.disponible,l.descripcion,l.precio from libros l left join autores a on l.codigo_autor=a.codigo_autor";

        if ($arrayLibros){ //el autor está definido, lo incluimos para filtrarlo
            $query.=" where l.codigo in (" . implode(',',array_fill(0,count($arrayLibros),'?')) . ")";
                // Preparar la consulta con marcadores de posición (:codigo)
    $statement= $con->prepare("SELECT codigo, nombre FROM autores WHERE 
    codigo IN (" . implode(',', array_fill(0, count($arrayLibros), '?')) . ")");

 

        }
       
       $statement= $con->prepare($query);
    // Vincular valores a los marcadores de posición
    foreach ($arrayLibros as $k => $v) {
        $statement->bindValue(($k + 1), $v, PDO::PARAM_INT);
    }
        $statement->execute();
        $resultados=$statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultados;
    }catch(PDOException $e){
        $error="Ha ocurrido un error obteniendo  el libro en la base de datos ";
        $error.= $e->getMessage();
        include ("../View/error.php");
        exit();
    }
}
function comprarLibro($codigo_libro){
session_start();
$carrito=array();
if(isset($_SESSION["carrito"])){
$carrito=$_SESSION["carrito"];
}
if ($carrito[$codigo_libro]){
    $carrito[$codigo_libro]["unidades"]++;
}else{
    $carrito[$codigo_libro]["unidades"]=1;
}
$_SESSION["carrito"]=$carrito;
}

function calculaTotal($carrito,$libros){
    $librosprecios= array();
    foreach ($libros as $l) {
        $librosprecios[$l["codigo"]] = array("precio" =>(float) $l["precio"], "unidades" => $carrito[$l["codigo"]]["unidades"]);
    }
    
    $total=0;
    foreach($librosprecios as $lp){
        $uds=(int)$lp["unidades"];
        $precio=$lp["precio"];
        $total+=$uds*$precio;
    }
    return $total;
}
?>