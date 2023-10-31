<?php
$dsn = "mysql:host=192.168.1.135;dbname=alumnospdo;charset=utf8mb4";
$username = "phpmac";
$password = "Macvs23!!macvs23!!";
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>