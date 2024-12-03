<?php 
require_once('../BaseController.php');

class AccountController extends BaseController {
    private $AccountModel;

    function __construct() {
        $this->loadModel('AccountModel');
        $this->AccountModel = new AccountModel();
    }

    // Đăng ký người dùng mới
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu JSON từ yêu cầu HTTP
            $jsonData = file_get_contents('php://input'); // Lấy nội dung body của request
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['username'], $data['password'], $data['email'])) {
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));
                $email = htmlspecialchars(trim($data['email']));

                // Gọi phương thức register từ model
                $response = $this->AccountModel->register($username, $password, $email);

                // Gửi phản hồi JSON về client
                echo $response;
                exit();
            } else {
                echo json_encode(['success' => '0', 'message' => 'Invalid input data.']);
                exit();
            }
        }
    }

    // Đăng nhập người dùng
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu JSON từ yêu cầu HTTP
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['username'], $data['password'])) {
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));

                // Gọi phương thức login từ model
                $response = $this->AccountModel->login($username, $password);
                $data = json_decode($response, true);

                if ($data['success'] == "1") {
                    session_start();
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['role'] = $data['role'];
                    $_SESSION['login'] = true;

                    // Gửi phản hồi JSON về client
                    echo $response;
                } else {
                    echo $response;
                }
            } else {
                echo json_encode(['success' => '0', 'message' => 'Invalid login data.']);
            }

            exit();
        }
    }

    // Đăng xuất người dùng
    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        // Gửi phản hồi JSON về client
        echo json_encode(['success' => '1', 'message' => 'You have logged out successfully.']);
        exit();
    }

    // Thay đổi mật khẩu người dùng
    public function changePassword() {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
            echo json_encode(['success' => '0', 'message' => 'You need to be logged in to update your password.']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu JSON từ yêu cầu HTTP
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['password_old'], $data['password_new'])) {
                $username = $_SESSION['username'] ?? null;

                if ($username == null) {
                    echo json_encode(['success' => '0', 'message' => 'You need to be logged in to update your password.']);
                    exit();
                }
                
                $password_old = htmlspecialchars(trim($data['password_old']));
                $password_new = htmlspecialchars(trim($data['password_new']));

                // Gọi phương thức updatePassword từ model
                $response = $this->AccountModel->updatePassword($username, $password_old, $password_new);

                echo $response;
                exit();
        }
    }
}
?>
