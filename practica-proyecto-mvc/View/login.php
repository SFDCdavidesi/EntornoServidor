<?php include('../View/header.php') ?>
<?php
if (isset($error)){?>
<section id="message" class="message">
    
    </section>
<?php
}
?>
<section id="add" class="add">
    <h2>Login</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="dologin">
        <div class="add__inputs">
            <label>usuario:</label>
            <input type="text" name="usuario" maxlength="255" required>
            <label>Contraseña:</label>            
            <input type="password"  name="password" maxlength="255" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Login</button>
        </div>
    </form>
</section>
<?php include('../View/footer.php') ?>