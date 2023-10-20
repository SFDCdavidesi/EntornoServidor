<html>
<?php
    include_once("header.php");
    session_start();

    if (!isset($_SESSION['success'])) {
        header("Location: index.php");
        exit();
    }
    ?>
<script>

</script>
<body>
    <div class="container">
        <h1>Usuario válido</h1>
        <a href="index.php">Volver</a>
    </div>
</body>

</html>