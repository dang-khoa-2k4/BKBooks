<?php
require_once '../src/config.php';
require_once '../src/Models/BaseModel.php';

class UserModel extends BaseModel {
    public function __construct() {
        global $pdo;
        self::$pdo = $pdo;
        $this->table = 'user';
        $this->rows = ['id', 'username', 'password', 'role'];
    }


    // Kiểm tra đăng nhập
    public function login($data) {
        echo $data['password'];
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($data['password'], $user['Password'])) {
            return $user; // Trả về thông tin người dùng nếu đăng nhập thành công
        }

        return null; // Trả về null nếu đăng nhập thất bại  
    }

    // Kiểm tra quyền của người dùng
    public function checkRole($user, $role) {
        return $user['role'] === $role;
    }

    public function register($data){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return false; // Trả về false nếu tài khoản đã tồn tại
        }

        $stmt = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'admin'
        ]);

        return true; // Trả về true nếu đăng ký thành công
    }
}
?>
