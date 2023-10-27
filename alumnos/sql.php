<?php
include_once("conexion.php");
function conecta($dbname){
    global $user,$pass,$host;

    $dsn="mysql:host=$host;dbname=$dbname";

    return new PDO($dsn,$user,$pass);
}
    $con=conecta("ssii");
function inserta_nombre_curso($n,$c){
    global $con,$dbname;
    if ($con==null){
        $con=conecta($dbname);
    }
    $insert_sql="INSERT INTO alumnospdo(nombre_completo,codigocurso) values('$n',$c)";

   return $con->exec($insert_sql);
}
function conectaMySQL($dbname){
    global $host,$user,$pass;
    $conn=new mysqli($host,$user,$pass,$dbname);
    return $conn;
}
function inserta($n,$c,$tipo="DBO"){
    if ($tipo=="DBO"){
        return inserta_nombre_curso($n,$c);
    }else{
        return inserta_nombre_curso_mysql($n,$c);
    }

}
function inserta_nombre_curso_mysql($n,$c){
    global $conn,$dbname;
    if ($conn==null){
        $conn=conectaMySQL($dbname);
    }
    $SQL_INSERTA="INSERT INTO alumnosmysql (nombre_completo,codicurso) VALUES ('$n',$c)";
    return $conn->query($SQL_INSERTA);
}

?>