<?php
require_once("C_SQL.php");
require_once("C_iconos.php");
function pintaCabecera ($a){
    ?>
<thead>
    <?php
          echo "<tr>";
           $i=0;
        foreach($a[0] as $k=>$v){
            if ($i++==0){
                echo "<th  scope='col'>$k</th>";

            }else{
                echo "<th>$k</th>";

            }
        }
        echo "</tr>";
?>
</thead>
<?php
}
function pintaDisponibilidad($d){
    return ($d==1?Icono::disponible():Icono::nodisponible());
}
function pintalibros($arrayasociativo){
    ?>


<?php
    pintaCabecera($arrayasociativo);
    foreach($arrayasociativo as $row){
        echo "<tr><th scope='row'>" . $row["codigo"] . "</th>";
        echo "<td" . $row["codigo"] . "</td>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellidos"] . "</td>";
        echo "<td>" . pintaDisponibilidad($row["disponible"]) . "</td>";
        echo"<td><button type='button' class='btn btn-warning' onclick='modificalibro(" . $row["codigo"] . ");'>Modificar</button></td>";
        echo"<td><button type='button' class='btn btn-danger' onclick='eliminalibro(" . $row["codigo"] . ");'>Eliminar</button></td>";
        echo "</tr>";



    }
    ?>

<?php
}
function pintaAutores($autorpreselected="-1"){

        $bd= new BBDD();
    
   $res= $bd->getAutores();
   foreach($res as $autor){
    echo "<option value='" . $autor["codigo_autor"] . "' " . ($autorpreselected==$autor["codigo_autor"]?"selected":"") . ">" . $autor["nombre"] . " " . $autor["apellidos"] . "</option>";
   }
}

function pintaMensaje($cabecera="",$mensaje){
    ?>
<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#007aff"></rect>
        </svg>

        <strong class="me-auto"><?=$cabecera?></strong>

        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <div class="alert alert-danger" role="alert">
            <?=$mensaje?>
        </div>

    </div>
</div><?php
}
function pintaBarraDeNavegacion($usuario){
    ?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="col-9">
            <a class="navbar-brand" href="#"
                onclick="alert('usuario activo es ' + '<?=$usuario?>');">[<?=$usuario?>]</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="php/cerrarsesion.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?navegacion=catalogo">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?navegacion=administrarlibros">Administrar
                            Libros</a>
                    </li>
            </div>
</div>
            <div class="col-2">
              <?php if (isset($_SESSION["totalLibrosCarrito"])){?>
                <span class="navbar-text d-flex " id="carrito">
                    <span id="numProductos"><?=$_SESSION["totalLibrosCarrito"]?> &nbsp;</span>
                    <span><a href="<?=$_SERVER['PHP_SELF'];?><?=parametrosUrl(["navegacion"=>"vercarrito"]);?>" alt="ver carrito" > <?=Icono::cart()?></a></span> 
                </span>
                <?php
              }
              ?>
                <!--    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
            </div>
        </div>
    </div>
</nav>
<?php
}
function pintaListadoAutores($aautores){
  foreach($aautores as $autor){
    ?>
<div class="col-sm-3 ">
    <a href="<?=$_SERVER['PHP_SELF']?>?navegacion=<?=$_REQUEST["navegacion"]?>&autor=<?=$autor["codigo_autor"]?>"><?=$autor["nombre"]?>
        <?=$autor["apellidos"]?></a>
</div>
<?php
  }
  ?>

<?php
}
function pintaLibrosTarjetas($alibros){
  foreach($alibros as $libro){
    ?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?=$libro["titulo"];?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?=$libro["nombre"];?> <?=$libro["apellidos"];?></h6>
        <!--p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p-->
        <a href="#" class="card-link" onclick='addCart(<?=$libro["codigo"]?>);'>Añadir al carrito</a>
        <a href="#" class="card-link">Another link</a>
    </div>
</div>
<?php
  }
}
function pintaCarrito($arrayCarrito){
  $bd= new BBDD();

  echo "<table>";
  foreach($arrayCarrito as $libro=>$uds){
    echo "<tr>";
    $rlibro=$bd->dameLibro($libro);
    echo "<td>" . $rlibro["titulo"] . "</td><td>" . $uds["unidades"] . "</td></tr>";
    
  }
  echo "</table>";
}
function parametrosUrl($paramoverrite){
  $param= "?";
  if (sizeof($_REQUEST)==0){
    $k=array_keys($paramoverrite)[0] ;
    $param.=  $k . "=" . $paramoverrite[$k];
  }else{

 
  
  foreach($_REQUEST as $k=>$v){
    if (key_exists($k,$paramoverrite)){
      $param.= $k . "=" . $paramoverrite[$k];
    }else{
      $param.= $k . "=" . $v . "&";

    }
  }
}
  return $param;
}
?>