<?php
$dsn = "mysql:host=localhost;dbname=alumnospdo;charset=utf8mb4";

$username = "david";
$password = "aXVAcaMv5k08lLX6";
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>