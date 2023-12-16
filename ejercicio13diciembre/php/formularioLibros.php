<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<input type="hidden" name="accion" value="altaLibro">
  <div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="tituloHelp" placeholder="Título del libro">
    <small id="tituloHelp" class="form-text text-muted">Título del libro</small>
  </div>
  <div class="form-group">
    <label for="autor">Autor</label>
    <select name="codigo_autor">
        <?php
pintaAutores();
        ?>
    </select>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#autorModal">
        <?=Icono::pen();?>
</button>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="disponible" name="disponible">
    <label class="form-check-label" for="disponible">disponible</label>
  </div>
  <button type="submit" class="btn btn-primary">Crear Libro</button>
  <button type='button' class='btn btn-warning' onclick="oculta('formulariolibros');">Ocultar formulario</button>

</form>


<!-- Modal -->
<div class="modal fade" id="autorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Alta de Autores</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form name="altaAutor" method="GET" action="<?=$_SERVER['PHP_SELF'];?>">
      <input type="hidden" name="accion" value="altaAutor">
  <div class="form-group">
    <label for="nombreautor">Nombre</label>
    <input type="text" class="form-control" id="nombreautor" name="nombre" aria-describedby="nombreautorHelp" placeholder="Nombre" required>
    <small id="nombreautorHelp" class="form-text text-muted">Nombre del autor</small>
  </div>
  <div class="form-group">
    <label for="apellidosautor">Apellidos</label>
    <input type="text" class="form-control" id="apellidosautor" name="apellidos" aria-describedby="apellidosautorHelp" placeholder="Apellidos" required>
    <small id="apellidosautorHelp" class="form-text text-muted">Apellidos del autor</small>
  </div>
  <div class="form-group">
    <label for="añonacimiento">Año de nacimiento</label>
    <input type="number" class="form-control" id="añonacimiento" name="año_nacimiento" aria-describedby="añonacimientoHelp" placeholder="Año de nacimiento" maxlength="4">
    <small id="añonacimientoHelp" class="form-text text-muted">Año de nacimiento</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Crear Autor</button>
  <button type='button' class='btn btn-warning' onclick="oculta('formulariolibros');">Ocultar formulario</button>

</form>      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>