<html>
<?php
    include_once("header.php");
    include_once("funciones.php");
    ?>

<body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $debug) {
    echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr><td><b>$key</b></td><td>$value</td></tr>";
    }
    echo "</table>";
}




    // Check connection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $formpassword = htmlspecialchars($_POST["password"]) ;
        require_once ("database.php");
        // Connect to the database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "<div class='error'>Falló la conexión " . $e->getMessage() . "</div>";
            exit;
        }

        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
      //  echo $email;
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        
        // Check if the user exists
        if ($result) {
            $dbpassword=$result['password'];
           

            // Verify the password
                if (coincidenContrasenias($formpassword, $dbpassword)) {
                    $_SESSION["success"] = "Login successful!";
                    $_SESSION["email"]=$email;
                    header("Location: usuariovalido.php"); // Redirect to the dashboard page
                    exit;
                } else {
                    echo "<div class='error'>Contraseña no válida</div>"; // Return an error message
                }
            
        } else {
            echo "<div class='error'>Usuario no encontrado</div>"; // Return an error message
        }

        // Close the connection
        $conn = null;
    }
    ?>
    <a href="index.php">Volver</a>


</body>

</html>