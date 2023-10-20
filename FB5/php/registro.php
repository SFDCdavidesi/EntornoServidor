<html>
<?php
    include_once("header.php");
    ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr><td><b>$key</b></td><td>$value</td></tr>";
    }
    echo "</table>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordconfirm = $_POST["passwordconfirm"];
   

        // Validate input
        if (empty($email) || empty($password) ) {
            echo "<div class='error'>Error: Todos los campos son obligatorios.</div>";
        } elseif ($password != $passwordconfirm) {
            echo "<div class='error'>Error: Las contraseñas no coinciden.</div>.";
        } else {
           require_once ("database.php");


            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check if user already exists
                $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email=:email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    echo "<div class='error'>Error: El usuario ya existe.</div>.";
                } else {
                    // Create user
                    $stmt = $conn->prepare("INSERT INTO usuarios (email, password) VALUES (:email, :password)");
                    $stmt->bindParam(":email", $email);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt->bindParam(":password", $hashed_password);
                   
                    $stmt->execute();
                    echo "<div class='green'>Usuario creado correctamente.</div>.";
                }
            } catch(PDOException $e) {
                echo "<div class='error'>Error: ". $e->getMessage() ."</div>" ;
            }
            $conn = null;
        }
    }
    ?>
    <body>
        <div class="container">
            <div class="titulo">Formulario de registro</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateRegisterForm()">
                <div class="formulario">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder=''><br />
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder=''><br />
                    <label for="passwordconfirm" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm" placeholder=''><br />
                    <input type="submit" class="btn btn-primary" value="Registro">
                    <input type="reset" class="btn btn-primary" value="Reset">
                    <br />
                    <a href="index.php">Volver</a>
                </div>
            </form>
        </div>
    </body>
    </html>

