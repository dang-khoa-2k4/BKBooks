<?php
require_once(__DIR__ . '/../BaseController.php');
class MemberController extends BaseController {
    private $membermodel;

    public function __construct() {
        $this->loadModel('MemberModel');
        $this->membermodel = new MemberModel(); // Fixed typo
    }
        /**
     * Đăng ký thành viên mới.
     * Phương thức này nhận thông tin đăng ký từ yêu cầu POST, kiểm tra tính hợp lệ của dữ liệu và gọi phương thức
     * đăng ký trong model để thêm thành viên mới vào cơ sở dữ liệu.
     * @return #string JSON phản hồi với kết quả đăng ký (thành công hoặc thất bại).
     * Yêu cầu: Thông tin username, password, email, phone, address, firstname, lastname, DOB.
     */
    public function registerMember() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy nội dung body của request
            $jsonData = file_get_contents('php://input');
           // print_r($jsonData);
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            //print_r($data);
            if (!isset($data['username'], 
                        $data['password'], 
                        $data['email'],
                        $data['phone'],
                        $data['firstname'],
                        $data['lastname'],
                        $data['DOB'])) {
                            echo $this->generateResponse("false", "Please provide all information");
                            exit;
            }

                // Lọc và làm sạch dữ liệu đầu vào
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));
                $email = htmlspecialchars(trim($data['email']));
                $phone = htmlspecialchars(trim($data['phone']));
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
                    exit;
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
                    'role'
                ];

                // Gọi phương thức register trong model

                [$result, $msg] = $this->membermodel->registerMember($data_to_model);
                echo $this->generateResponse($result ? "true" : "false", $msg);
            
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }
     /**
     * Đăng nhập thành viên.
     * Phương thức này nhận thông tin đăng nhập từ yêu cầu POST, kiểm tra tính hợp lệ của dữ liệu và gọi phương thức
     * đăng nhập trong model. Nếu thành công, tạo phiên (session) cho người dùng.
     * @return #string JSON phản hồi với kết quả đăng nhập (thành công hoặc thất bại).
     * Yêu cầu: Thông tin username và password.
     */
    public function loginMember() {
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

                    //set session id and role
                    $_SESSION['id'] = $user['ID'];
                    $_SESSION['role']= $user['ID'];


                    echo $this->generateResponse("true", "Login successfully");
                } else {
                    echo $this->generateResponse("false", "Your username or password is wrong");
                }
            } else {
                echo $this->generateResponse("false", "Please provide both username and password");
            }
        }
    }

    /**
     * Thay đổi mật khẩu của thành viên.
     * Phương thức này cho phép thành viên thay đổi mật khẩu. Nó kiểm tra tính hợp lệ của mật khẩu cũ và mật khẩu mới,
     * và nếu hợp lệ, gọi phương thức changePassword trong model.
     * @return #string JSON phản hồi với kết quả thay đổi mật khẩu (thành công hoặc thất bại).
     * Yêu cầu: Thông tin oldPassword và newPassword.
     */
    public function changePasswordMember() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu JSON từ request body
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['oldPassword'], $data['newPassword'])) {
                // Lấy ID từ session (đảm bảo rằng người dùng đã đăng nhập)
                if (!isset($_SESSION['id'])) {
                    echo $this->generateResponse("false", "You must be logged in to change your password");
                    exit;
                }

                $id = $_SESSION['id']; // Lấy ID người dùng từ session
                $oldPassword = htmlspecialchars(trim($data['oldPassword']));
                $newPassword = htmlspecialchars(trim($data['newPassword']));

                // Kiểm tra nếu mật khẩu mới khác mật khẩu cũ
                if ($oldPassword === $newPassword) {
                    print_r($oldPassword );
                    print_r($newPassword);
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
 /**
     * Lấy thông tin thành viên.
     * Phương thức này trả về thông tin cá nhân của thành viên hiện tại (dựa trên session).
     * @return #string JSON phản hồi với thông tin thành viên (thành công hoặc thất bại).
     */
    public function getInforMember(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse("false", "You must be logged in to change your password");
                return;
            }
            $id = $_SESSION['id'];
            [$result, $msg, $user]=$this->membermodel->getInfor($id);

            echo $this->generateResponse($result ? "true" : "false", $msg,$user);

        }else{
            echo $this->generateResponse("false", "Invalid request method");
        }
    }
    /**
     * Cập nhật thông tin thành viên.
     * Phương thức này cho phép thành viên cập nhật thông tin cá nhân (email, phone, address, firstname, lastname, DOB).
     * @return #string JSON phản hồi với kết quả cập nhật thông tin (thành công hoặc thất bại).
     * Yêu cầu: Thông tin email, phone, address, firstname, lastname, DOB.
     */
    public function updateInforMember(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy nội dung body của request
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset( $data['email'],
                        $data['phone'],
                        $data['firstname'],
                        $data['lastname'],
                        $data['DOB'])) {
                if (!isset($_SESSION['id'])) {
                    echo $this->generateResponse("false", "You must be logged in to change your password");
                    return;
                }

                $id = $_SESSION['id']; // Lấy ID người dùng từ session

                // Lọc và làm sạch dữ liệu đầu vào
                $email = htmlspecialchars(trim($data['email']));
                $phone = htmlspecialchars(trim($data['phone']));
                //$address = htmlspecialchars(trim($data['address']));
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

                $data_to_model = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                    'DOB' => $DOB,
                ];

                // Gọi phương thức register trong model
                [$result, $msg] = $this->membermodel->updateMember($data_to_model, $id);
                echo $this->generateResponse($result ? "true" : "false", $msg);
            } else {
                echo $this->generateResponse("false", "Please provide all information");
            }
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }
    // hủy tài khoản
     /**
     * Hủy tài khoản thành viên.
     * Phương thức này cho phép thành viên hủy tài khoản của mình (dựa trên session).
     * @return #string JSON phản hồi với kết quả hủy tài khoản (thành công hoặc thất bại).
     */
    public function deleteMember(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse("false", "You must be logged in to delete the account");
                exit;
            }
            $id = $_SESSION['id'];
            [$result, $msg]=$this->membermodel->deleteMember($id);

            echo $this->generateResponse($result ? "true" : "false", $msg,);

        }else{
            echo $this->generateResponse("false", "Invalid request method");
        }
    }
}

?>
