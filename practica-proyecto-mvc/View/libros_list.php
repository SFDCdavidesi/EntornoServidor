<?php include('../View/header.php') ?>

<section id="list" class="list">
<header class="list__row list__header">
        <h1>
            Libros
        </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_libros">
            <select name="codigo_autor" required>
                <option value="0">Ver todos</option>
                <?php foreach ($autores as $autor) : ?>
                <?php if ($codigo_autor == $autor['codigo_autor']) { ?>
                <option value="<?= $autor['codigo_autor'] ?>" selected>
                    <?php } else { ?>
                <option value="<?= $autor['codigo_autor'] ?>">
                    <?php } ?>
                    <?= $autor['apellidos'] ?>, <?= $autor['nombre'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="add-button bold">Listar</button>
        </form>
    </header>
    <?php if($libros) { ?>
    <?php foreach ($libros as $libro) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= $libro['codigo']?></p>
            <p><?= $libro['titulo']; ?></p>
            <p><?= $libro['nombre']; ?></p>
            <p><?= $libro['apellidos']; ?></p>
            <p><?= $libro['descripcion']; ?></p>
            <p><?php echo ($libro['disponible']>0?"🟢":"🔴"); ?></p>
            <p><?= $libro['precio']; ?></p>
        </div>
        <?php if (isset($_COOKIE["usuario"]) && isset($_COOKIE["rol"]) && $_COOKIE["rol"]=="Admin" ){
            ?>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_libro">
                <input type="hidden" name="codigo" value="<?= $libro['codigo']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
        <div class="list__updateItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="update_libro">
                <input type="hidden" name="codigo" value="<?= $libro['codigo']; ?>">
                <button class="update-button">📝</button>
            </form>
        </div>
        <?php
        }
        ?>
          <?php if (isset($_COOKIE["usuario"]) ){
            ?>
        <div class="list__buyLibro">
            <form action="." method="post">
                <input type="hidden" name="action" value="buy_libro">
                <input type="hidden" name="codigo" value="<?= $libro['codigo']; ?>">
                <button class="buy-button">🛒</button>
            </form>
        </div>
       
        <?php
        }
        ?>
    </div>
    <?php endforeach; ?>
    <?php } else { ?>
   
    <p>No hay libros.</p>
 
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Añadir Libro</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_libro">
        <div class="add__inputs">
            <label>título:</label>
            <input type="text" name="titulo" maxlength="255" placeholder="título" required>
            <label>Autor:</label>
            <select name="codigo_autor" required>
                <option value="">Seleccione autor</option>
                <?php foreach ($autores as $autor) : ?>
                <option value="<?= $autor['codigo_autor']; ?>">
                    <?= $autor['nombre']; ?> <?= $autor['apellidos']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label>Descripción:</label>
            <textarea name="descripcion" ></textarea>
           
            <label>precio:</label>
            <input type="number"  name="precio" maxlength="4" placeholder="0,00" required>
            <label>disponible:</label>
            <input type="checkbox"  name="disponible" >
        </div>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Crear</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_autores">Ver/Editar Autores</a></p>
<?php include('../View/footer.php') ?>