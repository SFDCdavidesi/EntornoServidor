<?php include('../View/header.php') ?>

<section id="list" class="list">
<header class="list__row list__header">
        <h1>
            Autores
        </h1>
       
    </header>
    <?php if($autores) { ?>
    <?php foreach ($autores as $autor) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= $autor['codigo_autor']?></p>
            <p><?= $autor['nombre']; ?></p>
            <p><?= $autor['apellidos']; ?></p>
            <p><?= $autor['año_nacimiento']; ?></p>
        </div>
        <?php if (isset($_COOKIE["usuario"]) && isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="Admin" ){
            ?>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_autor">
                <input type="hidden" name="codigo_autor" value="<?= $autor['codigo_autor']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
        <div class="list__updateItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="update_libro">
                <input type="hidden" name="codigo_autor" value="<?= $autor['codigo_autor']; ?>">
                <button class="update-button">📝</button>
            </form>
        </div>
        <?php
        }
        ?>
        
    </div>
    <?php endforeach; ?>
    <?php } else { ?>
   
    <p>No hay autores.</p>
 
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Añadir Autor</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_autor">
        <div class="add__inputs">
            <label>Nombre:</label>
            <input type="text" name="nombre" maxlength="255" placeholder="Nombre" required>
            <label>Apellidos:</label>
            <input type="text" name="apellidos" maxlength="255" placeholder="Apellidos" required>
            <label>Año de nacimiento:</label>
            <input type="number"  name="año_nacimiento" maxlength="4" required>
            
        </div>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Crear</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_libros">Ver/Editar Libros</a></p>
<?php include('../View/footer.php') ?>