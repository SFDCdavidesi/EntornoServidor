<?php

try{

$cone="mysql:host=192.168.1.134;dbname=sakila";

$conexdb=new PDO($cone,"david", "MBcaYoZElG[cRok6");

$conexdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

echo("entro");



$smt=$conexdb->prepare("SELECT * From city where country_id=?");
//$smt->bindParam(1,$id,PDO::PARAM_INT);
$id=6;
$smt->execute(new Array($id));

while($row = $smt->fetch(PDO::FETCH_ASSOC)){

  foreach ($row as $k=>$v){
    echo $k . " - " . $v . "<br>";
  }
echo "<hr>";
}

}

catch(PDOException $e){

    echo $e->getmessage();

}



$conexdb = null;

?>