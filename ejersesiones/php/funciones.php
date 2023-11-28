<?php
function damePrecio($id):float
{
    global $lechesArray;
    foreach ($lechesArray as $item){
        if ($item['id']==$id){
       
            return $item['precio'];
        }
    }
}
function dameValor($id,$valor){
    global $lechesArray;
    foreach ($lechesArray as $item){
        if ($item['id']==$id){
            return $item[$valor];
        }
    }
}
function dameRegistro($id){
    global $lechesArray;
    foreach($lechesArray as $i){
        if($i['id']==$id){
            return $i;
        }
    }
}
function pintaProducto($id,$unidades){
   $registro=dameRegistro($id);
   $nombre=$registro["nombre"];
   $imagen=$registro["imagen"];
   $precio=$registro["precio"];
   $descripcion=$registro["descripcion"];
    ?>
    <div class="producto">
        <img src="<?=$registro['imagen']?>" alt="<?=$nombre?>" width="50" height="50" onclick="alert('<?=$descripcion?>')">
        <strong><?=$nombre?></strong><br>
      <!--  Descripción:<?=$descripcion?><br-->
         Precio: <?=$precio?>€<br>
        Unidades: <?=$unidades ?><br>
    </div><?php
}
?>