<?php
require_once '../src/Models/UserModel.php';

class UserController {
    public function __construct() {
        $this->userModel = new UserModel();
    }
    // Đăng nhập
    public function login() {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($data->username) && isset($data->password)) {
            $user = UserModel::login($data->username, $data->password);
            if ($user) {
                // Nếu đăng nhập thành công, lưu thông tin vào session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Lưu role người dùng
                
                echo json_encode(['message' => 'Login successful', 'role' => $user['role']]);
            } else {
                echo json_encode(['message' => 'Invalid credentials']);
            }
        } else {
            echo json_encode(['message' => 'Please provide username and password']);
        }
    }

    // Đăng xuất
    public function logout() {
        session_start();
        session_unset(); // Xóa tất cả session variables
        session_destroy(); // Hủy session
        echo json_encode(['message' => 'Logged out successfully']);
    }

    // Kiểm tra quyền người dùng
    public function checkPermission($requiredRole) {
        session_start();
        
        if (isset($_SESSION['role']) && $_SESSION['role'] === $requiredRole) {
            echo json_encode(['message' => 'Access granted']);
        } else {
            echo json_encode(['message' => 'Access denied']);
        }
    }

    // Kiểm tra trạng thái đăng nhập
    public function isLoggedIn() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            echo json_encode(['message' => 'User is logged in', 'user' => $_SESSION['username']]);
        } else {
            echo json_encode(['message' => 'User is not logged in']);
        }
    }

    public function register($username, $password) {
        
        if ($username && $password) {
            $result = UserModel::register([
                'username' => $username,
                'password' => $password
            ]);
            if ($result) {
                echo json_encode(['message' => 'Register successful']);
            } else {
                echo json_encode(['message' => 'Username already exists']);
            }
        } else {
            echo json_encode(['message' => 'Please provide username and password']);
        }
    }
}
?>