<?php
$host="192.168.1.134";
$username="david";
$password="MBcaYoZElG[cRok6";
$dbname="sakila";


 $conexion;
 $errores=array();
function conecta(){
    global $host,$username,$password,$dbname;
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    try  {
        // Ejecutamos las variables y aplicamos UTF8
       $connect= new PDO ( $dsn, $username, $password ) ;

        return $connect;
    } catch (PDOException $e)  {
        exit ("Error: " . $e->getMessage ());
    }
      }

      function buscaCity($city,$pais) 
      {
global $conexion;
if ($conexion==null){
    $conexion=conecta();
}
$sql ="select c.city_id , c.city ,  co.country from city c inner join  country co on  c.country_id = co.country_id where 1";
$a=false;
if (!empty($city)){
    $sql.=" AND c.city  like CONCAT('%', :ciudad ,'%')";
   
}
if (!empty($pais)){
    $pais="%$pais%";
  $sql.=" AND co.country like :pais";
}
$sql .=  " order by c.city, c.last_update ";
$stm =$conexion->prepare($sql);

if (!empty($city)){
    $stm->bindParam('ciudad',$city, PDO::PARAM_STR);
}
if (!empty($pais)){
    $stm->bindParam('pais',$pais,PDO::PARAM_STR);
}
try {
    $stm->execute();
}
catch( PDOException $Exception ) {
    // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
    // String.
    throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
}

 $rowCount = $stm->rowCount();
 return $stm;

      }
      function cargaPaises(){
        $devuelve=array();
        global $conexion;
        try{
        if ($conexion==null){
            $conexion=conecta();
        }
       $stm= $conexion->prepare("SELECT country_id,country from country");
        $stm->execute();
        while($resultado=$stm->fetch(PDO::FETCH_ASSOC)){
            $devuelve[$resultado['country_id']]=$resultado['country'];
        }
    }catch(PDOException $e){
        throw new MyDatabaseException($e->getMessage() , $e->getCode());
    }
        return $devuelve;
      }
      function insertarCiudad($city_id,$city,$country_id){
global $conexion,$errores;
if ($conexion==null){
    $conexion = conecta();
}

        try{
            if (existeCiudad($city,$country_id)){
                $errores[]="La combinación de ciudad y país ya existe";
                return false;
            }
            $stm=$conexion->prepare ("INSERT INTO city (city_id,city,country_id,last_update) values (:city_id,:city,:country_id,current_timestamp())");
            $stm->bindparam('city',$city,PDO::PARAM_STR);
            $stm->bindParam('city_id',$city_id,PDO::PARAM_STR);
            $stm->bindParam('country_id',$country_id,PDO::PARAM_STR);
            $stm->execute();

            return $stm->rowCount()>0?true:false;



        }catch(PDOException $e){
            throw $e;
        }
      }
      function existeCiudad($ciudad,$pais):bool{
        global $conexion;
        if ($conexion==null){
            $conexion=conecta();
        }
        $stm=$conexion->prepare("SELECT * FROM city where city=:city AND country_id=:pais");
        $stm->bindParam("city",$ciudad);
        $stm->bindParam("pais",$pais);
        try{
            $stm->execute();
        }catch(PDOException $e){
            throw $e;
        }
        return ($stm->rowCount()>0?true:false);
      }
      function dameCiudad($id):array{
        global $conexion,$errores;
        if ($conexion==null){
            $conexion=conecta();
        }
        $stm=$conexion->prepare("SELECT * FROM city where city_id=:id");
        $stm->bindParam("id",$id);
        try{
            $stm->execute();
        }catch(PDOException $e){
            throw $e;
        }
        if ($stm->rowCount()>0){
            return $stm->fetch(PDO::FETCH_ASSOC);
        }else{
            $errores[]="No hay ninguna ciudad disponible";
        }
      }




      function modificarCiudad($city_id,$city,$country_id){
        global $conexion,$errores;
        if ($conexion==null){
            $conexion = conecta();
        }
        
                try{
                  
                    $stm=$conexion->prepare ("Update  city set city=:city, country_id=:country_id, last_update=current_timestamp() where city_id=:city_id");
                    $stm->bindparam('city',$city,PDO::PARAM_STR);
                    $stm->bindParam('city_id',$city_id,PDO::PARAM_STR);
                    $stm->bindParam('country_id',$country_id,PDO::PARAM_STR);
                    $stm->execute();
        
                    return $stm->rowCount()>0?true:false;
        
        
        
                }catch(PDOException $e){
                    throw $e;
                }
              }




              function eliminaCiudad($ciudad):bool{
                global $conexion;
                if ($conexion==null){
                    $conexion=conecta();
                }
                $stm=$conexion->prepare("Delete from city where city_id=:id");
                $stm->bindParam("id",$ciudad);
                try{
                    $stm->execute();
                }catch(PDOException $e){
                    throw $e;
                }
                return ($stm->rowCount()>0?true:false);
              }
?>