<?php
require_once '../src/config.php';

class UserModel {
    // Kiểm tra đăng nhập
    public static function login($username, $password) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Trả về thông tin người dùng nếu đăng nhập thành công
        }

        return null; // Trả về null nếu đăng nhập thất bại
    }

    // Kiểm tra quyền của người dùng
    public static function checkRole($user, $role) {
        return $user['role'] === $role;
    }
}
?>
