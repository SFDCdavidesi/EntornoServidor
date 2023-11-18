<?php
setcookie("nombre","",time()-3600);
echo "La cookie ha sido borrada";
?>
<br>
<a href="activa2.php">Comprobar</a><br>
<a href="activa1.php">Activar cookie</a>