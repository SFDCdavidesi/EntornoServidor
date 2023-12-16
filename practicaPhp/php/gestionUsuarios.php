<script>
    var usuario="";
</script>
<?php
require_once("configuracion.php");
require_once("C_SQL.php");
require_once("C_iconos.php");
require_once("header.php");
$BBDD = new BBDD();

if (isset($_REQUEST["accion"]) && $_REQUEST["accion"]=="editar"){
$bbdd = new BBDD();
$modificausuario=$bbdd->modificaUsuario(["usuario"=>$_REQUEST["usuario"],
"pass"=>$_REQUEST["pass"],
"nombre"=>$_REQUEST["nombre"],
"apellidos"=>$_REQUEST["apellidos"],
"correo"=>$_REQUEST["correo"]]);
if ($modificausuario){
    unset($_REQUEST["editar"]);
    ?>
     <div class="alert alert-warning" tabindex="-1">
        <p>Usuario modificado correctamente.</p>
    </div>
    <?php
}else{
    ?>
<div class="alert alert-danger" role="alert">
            <p>Ha ocurrido un error al modificar el usuario. </p>
        <p><?=$bbdd::pmuestraErrores()?></p>
    </div>
    <?php
}
}


function arrayDeUsuario($arrayAsociativo,$indice){
    $devuelve = [];
    try{
        if (!array_key_exists($indice, $arrayAsociativo[0])){
            throw new Exception ("No existe el índice pasado " . $indice);
        }


    foreach($arrayAsociativo as $filas){
        foreach($filas as $campo => $valor){
           
            $devuelve[$filas[$indice]]=$filas;
        }
    }
}catch(Exception $e){
    echo "Ha ocurrido un error al obtener el array de valores " + $e->getMessage();
}
    return $devuelve;
}
$queryUsuarios="SELECT * from usuarios order by createddate";
$res=$BBDD->getQueryParams($queryUsuarios,null);
function cabeceraQuery($query):array{
    $row=$query[0];
    return array_keys($row);
}
?>
<div class="container-fluid px-4 mt-5">
    <?php
if (!empty($res)){
?>
    <table class="table table-striped table-hover">
        <theader>
            <tr>
                <td>Editar</td>
                <?php
  foreach (cabeceraQuery($res) as $k){
    echo "<th scope='col'>$k</th>";
  }
  ?>
            </tr>
        </theader>
        <tbody>
            <?php
    foreach($res as $result){
        echo "<tr>";
        $i=0;
        foreach($result as $k => $v){
           if ($i++==0){
          echo " <td scope='row'><a href='" . $_SERVER['PHP_SELF'] ."?id=" . $_REQUEST['id'] . "&editar=" . $result["usuario"] . "'>"  . Icono::edit() . "</a><button type=\"button\" class=\"btn btn-link\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteUser\" onclick=\"usuario='$v';\">" . Icono::delete() . " </button> </a></td>";
           }
            echo "<td>$v</td>";
        }
        echo "</tr>\r";
    }
    ?>
        </tbody>
    </table>

    <div class="alert alert-warning" tabindex="-1">
        <p>La contraseña mostrada está encriptada.</p>
    </div>
    <?php
}else{
    echo "no hay usuarios";
}

if (isset($_REQUEST["editar"])){
  
    $usuarioAEditar=$_REQUEST["editar"];
$usu = arrayDeUsuario($res,"usuario");
$datos=$usu[$usuarioAEditar];
?>
<div class="container">
    <form action="<?=$_SERVER['PHP_SELF']?>?id=<?=$_REQUEST['id']?>&editar=<?=$_REQUEST["editar"]?>" id="formeditar" method="post" onsubmit="return validateFormEditar();">
    <input type="hidden" name="accion" value="editar">
    <input type="hidden" name="usuario" value="<?=$datos["usuario"]?>">
<div class="mb-3">
    <label for="usuario" class="form-label">Nombre de usuario</label>
    <input type="text" class="form-control" name="usuariodisabled" id="usuariodisabled" aria-describedby="emailHelp" disabled value="<?=$datos["usuario"]?>">
    <div id="emailHelp" class="form-text">No es posible cambiar el nombre de usuario.</div>
  </div>
  <div class="mb-3">
    <label for="pass" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="pass" id="pass" aria-describedby="emailHelp" value="<?=$datos["password"]?>">
    
  </div>
  <div class="mb-3">
    <label for="pass2" class="form-label">Confirmar Contraseña</label>
    <input type="password" class="form-control" name="pass2" id="pass2" aria-describedby="emailHelp" value="<?=$datos["password"]?>">
    
  </div>
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="emailHelp" value="<?=$datos["nombre"]?>">
    
  </div>
  <div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?=$datos["apellidos"]?>">
  </div>
  <div class="mb-3">
    <label for="correo" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="correo" name="correo" value="<?=$datos["email"]?>">
  </div>

  <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <button type="button" class="btn btn-warning" onclick="recarga();"> Cancelar </button>
</form><?php
}
?>

</div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Confirma que desea eliminar el usuario
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="eliminausuario(usuario);">Save changes</button>
      </div>
    </div>
  </div>
</div>