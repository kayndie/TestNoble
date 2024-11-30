<?php 
$host = "localhost";
$user = "root";
$password = "";
$dbname = "comprendio";
$dsn = "mysql:host={$host}; dbname={$dbname}";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->exec("SET time_zone = '+8:00';");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
