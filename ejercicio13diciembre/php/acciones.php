<?php
require_once "configuracion.php";
require_once "C_SQL.php";
require_once "funciones.php";

$accion=$_REQUEST["accion"];
$bd= new BBDD();
switch($accion){
    case "altaAutor":
        $resultado=$bd->altaAutor($_REQUEST);
        break;
    case "altaLibro":
        $resultado=$bd->altaLibro($_REQUEST);
        break;

}

?>
<?php
if ($resultado==true){
?>
<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>

    <strong class="me-auto">Alta de  <?=($accion=="altaAutor"?"Autores":"Libros")?></strong>
    
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <?php if ($accion=="altaAutor"){
?>
    Autor <?=$_REQUEST["nombre"];?> dado de alta correctamente
<?php
    }else if ($accion=="altaLibro"){
?><?php
    }?>
    Libro <?=$_REQUEST["titulo"];?> dado de alta correctamente
  </div>
</div><?php
}
?>
