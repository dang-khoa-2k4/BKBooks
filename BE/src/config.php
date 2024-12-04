<?php

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$port = '';

// Tạo kết nối với MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
