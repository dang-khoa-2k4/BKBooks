<?php

class AuthMiddleware {
    // Kiểm tra nếu người dùng đã đăng nhập
    public static function checkLogin() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['message' => 'User is not logged in']);
            exit;
        }
    }

    // Kiểm tra quyền của người dùng (role)
    public static function checkRole($requiredRole) {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
            echo json_encode(['message' => 'Access denied']);
            exit;
        }
    }
}
?>