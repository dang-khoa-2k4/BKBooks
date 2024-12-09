<?php 
class OrderController extends BaseController{
    private $Ordermodel;

    public function __construct(){
        $this->loadModel("Order");
        $this->Ordermodel = new OrderModel();
    }
    public function addOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra nếu người dùng chưa đăng nhập
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
            
            $member_id = $_SESSION['id'];
            
    
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); 
            
            // Kiểm tra xem địa chỉ và danh sách sách có tồn tại không
            if (!isset($data['address'], $data['booklist']) || empty($data['booklist'])) {
                echo $this->generateResponse('false', 'Please provide all required information');
                exit();
            }
    
            // Lấy địa chỉ và danh sách sách từ dữ liệu JSON
            $address = htmlspecialchars(trim($data['address']));
            $booklist = $data['booklist'];
    
            // Kiểm tra tính hợp lệ của địa chỉ
            if (empty($address)) {
                echo $this->generateResponse('false', 'Address cannot be empty');
                exit();
            }
    
            // Kiểm tra và xử lý từng sách trong danh sách
            foreach ($booklist as $book) {
                if (!isset($book['bookID'], $book['quantity'])) {
                    echo $this->generateResponse('false', 'Each book must have a valid bookID and quantity');
                    exit();
                }
    
                // Kiểm tra xem bookID có phải là một số nguyên hợp lệ không
                if (!is_numeric($book['bookID']) || intval($book['bookID']) <= 0) {
                    echo $this->generateResponse('false', 'Invalid bookID');
                    exit();
                }
    
                // Kiểm tra quantity phải là số nguyên và không âm
                if (!is_numeric($book['quantity']) || intval($book['quantity']) <= 0) {
                    echo $this->generateResponse('false', 'Quantity must be a positive integer');
                    exit();
                }
                
            }
    
            // Tạo dữ liệu đơn hàng để lưu vào cơ sở dữ liệu (gồm member_id, address và booklist)
            $order_data = [
                'member_id' => $member_id,
                'address' => $address,
                'booklist' => $booklist // Lưu danh sách các sách với bookID và quantity
            ];
    
            // Gọi phương thức model để thêm đơn hàng vào cơ sở dữ liệu
            [$result, $msg,$failBoook] = $this->Ordermodel->addOrder($order_data);
            
            // Trả về phản hồi sau khi thêm đơn hàng
            echo $this->generateResponse($result ? 'true' : 'false', $msg, $failBoook);
    
        } else {
            echo $this->generateResponse('false', 'Invalid request method');
        }
    }
    

    public function cancelOrder(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra nếu người dùng chưa đăng nhập
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }

            //?? get orrder ID wwhere 
        }else{
            echo $this->generateResponse('false', 'Invalid request method');
       
        }

    }

    public function getOrder(){

    }
}



?>