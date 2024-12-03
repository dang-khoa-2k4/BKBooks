<?php
require_once "../BaseController.php";

class InforController extends BaseController {

    private $InforModel;

    public function __construct() {
        $this->loadModel("InforModel"); // Tải mô hình thông tin người dùng
        $this->InforModel = new InforModel(); // Khởi tạo mô hình
    }

    // Phương thức thêm thông tin người dùng
    //function này sẽ được gọi cùng lúc với đăng ký khi đso người nhận sẽ nhận về id vè tạo luôn một cái infor
    public function addInfor($user_id, $name = '', $LastName = '', $FirstName = '', $Address = '', $email = '') {
        // Kiểm tra tham số đầu vào để đảm bảo chúng không rỗng
       
        //gán giá trị rỗng vào 
        // Gọi phương thức addInfor từ model để thêm dữ liệu vào CSDL
        $response = $this->InforModel->addInfor($user_id, $name, $LastName, $FirstName, $Address, $email);

        return $response;
    }
    // Phương thức cập nhật thông tin người dùng
    public function updateInfor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu JSON từ yêu cầu HTTP
            $jsonData = file_get_contents('php://input'); // Đọc nội dung JSON
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng

            // Kiểm tra dữ liệu hợp lệ
            if (isset($data['LastName'], $data['FirstName'], $data['Address'], $data['Email'], $data['DOB'])) {
                $LastName = htmlspecialchars(trim($data['LastName']));
                $FirstName = htmlspecialchars(trim($data['FirstName']));
                $Address = htmlspecialchars(trim($data['Address']));
                $Email = htmlspecialchars(trim($data['Email']));
                $DOB = htmlspecialchars(trim($data['DOB']));
                
                if(!isset($_SESSION['ID'])){
                    
                    echo json_encode(['success' => 0, 'error' => 'Please login']);
                    exit();
                }
                // Lấy ID người dùng từ session
                $userID = $_SESSION['ID'];

                // Gọi phương thức updateInfor từ InforModel và truyền ID
                $result = $this->InforModel->updateInfor($userID, $LastName, $FirstName, $Address, $Email, $DOB);

                if ($result) {
                    echo json_encode(['success' => 1, 'message' => 'Information updated successfully.']);
                } else {
                    echo json_encode(['success' => 0, 'error' => 'Failed to update information.']);
                }
            } else {
                echo json_encode(['success' => 0, 'error' => 'Invalid input data.']);
            }
            exit();
        }
    }

    // Phương thức xóa thông tin người dùng
    public function deleteInfor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID người dùng từ session
            $userID = $_SESSION['ID'];

            // Gọi phương thức delete từ InforModel để xóa thông tin
            $result = $this->InforModel->deleteInfor($userID);

            if ($result) {
                echo json_encode(['success' => 1, 'message' => 'Information deleted successfully.']);
            } else {
                echo json_encode(['success' => 0, 'error' => 'Failed to delete information.']);
            }
            exit();
        }
    }// may be not use it
}
?>
