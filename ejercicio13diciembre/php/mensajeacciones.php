<?php
if ($resultadoaccion==true){
?>
<div class="row">
<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>

    <strong class="me-auto"><?=$msg?> <?=($accion=="altaAutor"?"Autores":"Libros")?></strong>
    
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <?php if ($accion=="altaAutor"){
?>
    Autor <?=$_REQUEST["nombre"];?> dado de alta correctamente.
<?php
    }else if ($accion=="altaLibro"){
?>
Libro <?=$_REQUEST["titulo"];?> dado de alta correctamente.
<?php
    }else if($accion=="modificarLibro"){?>
    Libro <?=$_REQUEST["titulo"];?> modificado correctamente.
    <?php
    }else if($accion=="eliminarLibro"){?>
    Libro <?=$_REQUEST["codigo"];?> eliminado correctamente.
      <?php
      }
      ?>
  </div>
</div><?php
}else{
    //ha ocurrido un error 
    ?>
<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>

    <strong class="me-auto"><?=$msg?> <?=($accion=="altaAutor"?"Autores":"Libros")?></strong>
    
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
  <div class="alert alert-danger" role="alert">
  <?=$bdaccion->muestraErrores();?>
</div>
  
  </div>
</div>
</div>
    <?php
}
?>