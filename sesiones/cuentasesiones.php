<?php
session_start();
if (!isset($_SESSION['contador'])){
    $_SESSION['contador']=0;
}
else {
    if( isset($_SESSION['contador']) && isset($_REQUEST['incrementa']) && $_REQUEST['incrementa']==true){
        $_SESSION['contador']++;
    }}
?>

El contenido del contador es : <?=$_SESSION['contador']?>
<br>
<a href="<?=$_SERVER['PHP_SELF']?>?incrementa=true">Incrementa contador</a>

<br>
<a href="<?=$_SERVER['PHP_SELF']?>">Recarga sin incrementar</a>