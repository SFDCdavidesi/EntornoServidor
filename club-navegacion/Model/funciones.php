<?php
$auxarray=explode("/",$_SERVER['REQUEST_URI']);

$urlws = "http://" . $_SERVER['SERVER_NAME'] . "/" . $auxarray[1] . "/api/ws.php";
function makeCurlRequest($params)
{
global $urlws;
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $urlws);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp=curl_exec($ch);
$response =(object) json_decode($resp, true);
//var_dump($response);
curl_close($ch);
return $response;

}

function get_fotos_by_directory($directory){
    $directory="../View/".$directory;
    $fotos = array();
    $files = scandir($directory);
    foreach($files as $file){
        if (is_file($directory . "/" . $file)){
          // $fotos[]=$file;
          $fotos[]=["nombre"=>$file,"ruta"=>$directory . "/" . $file,"size"=>filesize($directory . "/" . $file)];
        }
    }

      
        return $fotos;
    }

      
?>