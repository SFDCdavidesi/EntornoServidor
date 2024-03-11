<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

    <link rel="icon" type="image/jpg" href="../View/img/icono.ico"/>

    <title>Menú de Navegación</title>


    <!-- enlaces bootstrap y jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- bootstrap y jquery --> 
    <link href="../View/css/estilos.css?v3" rel="stylesheet">
    <script src="../View/js/cursos.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../View/img/velero.png" class="w-25"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav" style="width: 90%;">
        <li class="nav-item active">
            <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"]=="admin"){
                ?>
          <a class="nav-link" href="./?action=gestion_cursos">Gestionar Cursos </a>
          <?php
            }else{
                ?>
          <a class="nav-link" href="./?action=ver_cursos">Ver Cursos </a>
          <?php
            }
            ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
            <li class="nav-item dropdown float-right">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
      </ul>
      <?php if (isset($_SESSION["usuario"])){
        ?>
              <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" ><?=$_SESSION["usuario"]?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./?action=logout"  title="cerrar sesion">📴</a>
        </li>
      </ul>
      <?php
      }else{
        ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="./?action=login">Login</a>
        </li>
      </ul>
      <?php
      }
        ?>
    </div>
  </div>
</nav>




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="guardar">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
    

    }); 
    function mostrarModal(titulo,mensaje){
        $('#exampleModalCenter').modal('show');
        $('#exampleModalLongTitle').html(titulo);
        $('.modal-body').html(mensaje);}
</script>
