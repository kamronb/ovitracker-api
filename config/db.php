<?php
// $host = 'mysql.freehostia.com';
// $db = 'kamben12_ovitracker';
// $user = 'kamben12_ovitracker';
// $pass = 'ELALIACH1984'; 


$host = 'localhost';
$db = 'kamben12_ovitracker';
$user = 'root';
$pass = 'ELALIACH'; 


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
