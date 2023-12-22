<?php include('../View/header.php') ?>
<section id="update" class="update">
    <h2>Modificar Usuario</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="update_usuario">
        <div class="add__inputs">
            <label>usuario:</label>
            <input type="text" name="usuario" maxlength="64" placeholder="usuario" value="<?=$u["usuario"]?>" readonly>
            <label>password:</label>
            <input type="password" name="password" maxlength="255"  placeholder="Password" value="<?=$u["password"]?>" required>
            <label>repite password:</label>
            <input type="password" name="passwor2d" maxlength="255" placeholder="Password" value="<?=$u["password"]?>"  required>
            <label>nombre:</label>
            <input type="text" name="nombre" maxlength="128" placeholder="nombre" value="<?=$u["nombre"]?>"  required>
            <label>apellidos:</label>
            <input type="text" name="apellidos" maxlength="255" placeholder="apellidos" value="<?=$u["apellidos"]?>"  required>
        </div>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Crear</button>
        </div>
    </form>
</section>
<?php include('../View/footer.php') ?>