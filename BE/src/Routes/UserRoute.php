<?php
require_once '../src/controllers/UserController.php';
require_once '../src/middleware/AuthMiddleware.php';

$userController = new UserController();

// Route đăng nhập (cho phép bất kỳ người dùng nào đăng nhập)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'login') {
    $userController->login();
}

// Route đăng xuất (chỉ dành cho người dùng đã đăng nhập)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'logout') {
    AuthMiddleware::checkLogin();
    $userController->logout();
}
?>
