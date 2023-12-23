<?php include('../View/header.php') ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Usuarios
        </h1>
        
    </header>
    <?php if($usuarios && isset($_COOKIE["usuario"]) && isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="Admin") { ?>
    <?php foreach ($usuarios as $usuario) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= "{$usuario['usuario']}" ?></p>
            <p><?= $usuario['nombre']; ?></p>
            <p><?= $usuario['apellidos']; ?></p>
            <p><?= $usuario['nombre']; ?></p>
            <p><?= $usuario['password']; ?></p>
            <p><?= $usuario['email']; ?></p>

            <p><?= $usuario['rol']; ?></p>
            <p><?= $usuario['createddate']; ?></p>

            <p><?= $usuario['lastlogindate']; ?></p>
        </div>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_usuario">
                <input type="hidden" name="usuario" value="<?= $usuario['usuario']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
        <div class="list__updateItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="update_usuarioForm">
                <input type="hidden" name="usuario" value="<?= $usuario['usuario']; ?>">
                <button class="update-button">📝</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <?php } else { ?>
   
    <p>No hay usuarios.</p>
 
    <?php } ?>
</section>
<?php if (isset($muestraMensajeError)) {?>
<div class="mensaje-error"><?=$muestraMensajeError?>
</div>
<?php } ?>
<section id="add" class="add">
    <h2>Añadir Usuario</h2>
    <form action="." method="post" id="add__form" class="add__form" onsubmit="return validaAltaUsuario();">
        <input type="hidden" name="action" value="crea_usuario">
        <div class="add__inputs">
            <label>usuario:</label>
            <input type="text" name="usuario" maxlength="64" placeholder="usuario" value="<?=(isset($usumodi)?$usumodi["usuario"]:"");?>" <?=(isset($usumodi)?"readonly":"")?> required>
            <label>password:</label>
            <input type="password" name="password" maxlength="255" placeholder="Password" value="<?=(isset($usumodi)?$usumodi["password"]:"");?>" required>
            <label>repite password:</label>
            <input type="password" name="password2" maxlength="255" placeholder="Password" value="<?=(isset($usumodi)?$usumodi["password"]:"");?>"required>
            <label>nombre:</label>
            <input type="text" name="nombre" maxlength="128" placeholder="nombre" value="<?=(isset($usumodi)?$usumodi["nombre"]:"");?>"required>
            <label>apellidos:</label>
            <input type="text" name="apellidos" maxlength="255" placeholder="apellidos" value="<?=(isset($usumodi)?$usumodi["apellidos"]:"");?>" required>
            <label>email:</label>
            <input type="email" name="email" maxlength="255" placeholder="email" value="<?=(isset($usumodi)?$usumodi["email"]:"");?>" required>
            <label>rol:</label>
            <select name="rol" required>
                <option > -- Seleccione -- </option>
                <option value="Usuario" <?=(isset($usumodi) && $usumodi["rol"]=="Usuario"?" selected ":"");?>>Usuario</option>
                <option value="Admin" <?=(isset($usumodi) && $usumodi["rol"]=="Admin"?" selected ":"");?>>Administrador</option>
    </select>
            


        </div>
        </div>
        <div class="add__addItem">
            <?php
            if (isset($usumodi)){
                ?>
                            <button class="add-button bold">Modificar</button>

                <?php
            }else{ ?>
                        <button class="add-button bold">Crear</button>

            <?php
            }
        ?>
        </div>
    </form>
</section>
<br>
<p><a href=".">Volver</a></p>
<?php include('../View/footer.php') ?>