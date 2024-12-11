<?php
require_once(__DIR__ . '/../BaseController.php');
class MemberController extends BaseController{
    private $membermodel;
    public function __construct(){
        $this->loadModel('UserModel');
        $this->membermodel = new UserModel();
    }

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy nội dung body của request
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['username'], 
                        $data['password'], 
                        $data['email'],
                        $data['phone'],
                        $data['address'],
                        $data['firstname'],
                        $data['lastname'],
                        $data['DOB'])) {

                // Lọc và làm sạch dữ liệu đầu vào
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));
                $email = htmlspecialchars(trim($data['email']));
                $phone = htmlspecialchars(trim($data['phone']));
                $address = htmlspecialchars(trim($data['address']));
                $firstname = htmlspecialchars(trim($data['firstname']));
                $lastname = htmlspecialchars(trim($data['lastname']));
                $DOB = htmlspecialchars(trim($data['DOB']));

                // Kiểm tra email có hợp lệ không
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo $this->generateResponse("false", "Your email is wrong");
                    return;
                }

                // Kiểm tra số điện thoại chỉ chứa số
                if (!preg_match('/^[0-9]+$/', $phone)) {
                    echo $this->generateResponse("false", "Your phone number is wrong");
                    return;
                }

                // Kiểm tra ngày sinh (DOB) hợp lệ
                $dobObject = DateTime::createFromFormat('Y-m-d', $DOB);
                if (!$dobObject || $dobObject->format('Y-m-d') !== $DOB) {
                    echo $this->generateResponse("false", "Your Date of birth is wrong");
                    return;
                }


                // Dữ liệu hợp lệ, chuẩn bị truyền vào model
                $data_to_model = [
                    'username' => $username,
                    'password' => $password,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'DOB' => $DOB,
                ];

                // Gọi phương thức register trong model
                [$result, $msg] = $this->membermodel->register($data_to_model);
                echo $this->generateResponse($result ? "true" : "false", $msg);
            } else {
                echo $this->generateResponse("false", "Please provide all information");
            }
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }

    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu JSON từ request body
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['username'], $data['password'])) {
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));

                $data_to_model = [
                    'username' => $username,
                    'password' => $password
                ];

                // start session if not already started
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Gọi phương thức đăng nhập trong model    
                [$result, $msg, $user] = $this->membermodel->login($data_to_model);
                if ($result) {
                    $_SESSION['id'] = $user['ID'];
                    $_SESSION['role'] = $user['Role'];
                    echo $this->generateResponse("true", "Login successfully");
                } else {
                    echo $this->generateResponse("false", "Your username or password is wrong");
                }
            } else {
                echo $this->generateResponse("false", "Please provide both username and password");
            }
        }
    }
    public function changePasswordUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu JSON từ request body
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['oldPassword'], $data['newPassword'])) {
                // Lấy ID từ session (đảm bảo rằng người dùng đã đăng nhập)
                if (!isset($_SESSION['id'])) {
                    echo $this->generateResponse("false", "You must be logged in to change your password");
                    return;
                }

                $id = $_SESSION['id']; // Lấy ID người dùng từ session
                $oldPassword = htmlspecialchars(trim($data['oldPassword']));
                $newPassword = htmlspecialchars(trim($data['newPassword']));

                // Kiểm tra nếu mật khẩu mới khác mật khẩu cũ
                if ($oldPassword === $newPassword) {
                    echo $this->generateResponse("false", "New password must be different from old password");
                    return;
                }

                // Tạo mảng dữ liệu để gửi đến model
                $data_to_model = [
                    'id' => $id,
                    'oldPassword' => $oldPassword,
                    'newPassword' => $newPassword
                ];

                // Gọi phương thức changePassword trong model
                [$result, $msg] = $this->membermodel->changePassword($data_to_model);

                // Trả về kết quả cho client
                echo $this->generateResponse($result ? "true" : "false", $msg);
            } else {
                echo $this->generateResponse("false", "Please provide old password and new password");
            }
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }

}  
?>
