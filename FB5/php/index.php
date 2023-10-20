<html>
<?php
    include_once("header.php");
    ?>
<script>

</script>
<body>
    <div class="container">
        <form action="login.php" method="post" onsubmit="return validateLoginForm()">
            <div class="formulario">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder=''><br />
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder=''><br />
                <input type="submit" class="btn btn-primary" value="Login">
                <input type="reset" class="btn btn-primary" value="Reset">
                <br />
                <a href="registro.php">No estoy registrado. Ir al registro</a>
            </div>
        </form>
    </div>
</body>

</html>