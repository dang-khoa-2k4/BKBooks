<?php
class MemberController extends BaseController{
    public function __construct(){
        parent::__construct('Member');
    }

    public function registerMember(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

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
                    echo json_encode(['error' => 'Invalid email format']);
                    return;
                }

                // Kiểm tra số điện thoại chỉ chứa số
                if (!preg_match('/^[0-9]+$/', $phone)) {
                    echo json_encode(['error' => 'Phone number must be all digits']);
                    return;
                }

                // Kiểm tra ngày sinh (DOB) hợp lệ
                $dobObject = DateTime::createFromFormat('Y-m-d', $DOB);
                if (!$dobObject || $dobObject->format('Y-m-d') !== $DOB) {
                    echo json_encode(['error' => 'Invalid date of birth format. Use YYYY-MM-DD']);
                    return;
                }

                // Kiểm tra tuổi người dùng (ví dụ trên 18 tuổi)
                $now = new DateTime();
                $age = $now->diff($dobObject)->y;
                if ($age < 18) {
                    echo json_encode(['error' => 'You must be at least 18 years old']);
                    return;
                }

                // Dữ liệu hợp lệ, chuẩn bị truyền vào model
                $data_to_model = [
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'DOB' => $DOB
                ];

                // Gọi phương thức register trong model
                parent::__callModel('register', $data_to_model);
            } else {
                echo json_encode(['error' => 'Missing required fields']);
            }
        }
    }

    public function loginMember(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Lấy dữ liệu JSON từ request body
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra nếu dữ liệu có tồn tại
            if (isset($data['username'], $data['password'])) {
                $username = htmlspecialchars(trim($data['username']));
                $password = htmlspecialchars(trim($data['password']));
                
                $data_to_model=[
                    'username'=>$username,
                    'password'=>$password
                ];

                // start session 
                // Gọi phương thức đăng nhập trong model
                parent:: loadModel('Member');
                $model=new MemberModel();
                $response= $model->login($data_to_model);
                

            } else {
                echo json_encode(['error' => 'Username and password are required']);
            }
        }
    }
}
?>
