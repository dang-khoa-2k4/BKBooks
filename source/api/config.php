<?php

$host = 'mysql-1e3f33b2-bk-book.e.aivencloud.com';
$dbname = 'bkbook';
$username = 'avnadmin';
$port = 28408;
$password = "AVNS_xeZiEdqaHZ2MkpWk1wT";
// Tạo kết nối với MySQL
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>