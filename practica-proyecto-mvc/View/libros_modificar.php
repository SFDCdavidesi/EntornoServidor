<?php include('../View/header.php') ?>

<section id="add" class="add">
    <h2>Modificar Libro</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="update_libro">
        <input type="hidden" name="codigo" value="<?=$l["codigo"]?>">
        <div class="add__inputs">
            <label>título:</label>
            <input type="text" name="titulo" maxlength="255" value="<?=$l["titulo"]?>" required>
            <label>Autor:</label>
            <select name="codigo_autor" required>
                <option value="">Seleccione autor</option>
                <?php foreach ($autores as $autor) {
                ?>
                
                <option value="<?=$autor['codigo_autor'];?>" <?php if($autor['codigo_autor'] == $l["codigo_autor"]){ echo "selected";} ?>>
                    <?= $autor['nombre']; ?> <?= $autor['apellidos']; ?>
                </option>
                <?php } ?>
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
<?php include('../View/footer.php') ?>