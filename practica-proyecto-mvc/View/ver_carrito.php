<?php include('../View/header.php') ?>

<section id="list" class="list">
<header class="list__row list__header">
        <h1>
            Carrito
        </h1>
        
    </header>
    <?php if($libros) { ?>
    <?php foreach ($libros as $libro) {
        $codlibro=$libro["codigo"];
         ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold">Unidades : <?= $_SESSION["carrito"][$codlibro]["unidades"]?></p>
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
    <?php } ?>
    <?php } else { ?>
   
    <p>No hay libros.</p>
 
    <?php } ?>
</section>
<?php
if (isset($totalCarrito)){?>
<?=$totalCarrito?> en total
<?php } ?>
<br>
<p><a href=".?action=list_libros">Ver/Editar Libros</a></p>
<?php include('../View/footer.php') ?>