<?php
// Cấu hình kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

// Tạo kết nối với MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
