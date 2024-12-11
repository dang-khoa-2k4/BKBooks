<?php require_once(__DIR__ . '/../BaseController.php');
class CartController extends BaseController{
    private $CartModel;

    public function __construct(){
        $this->loadModel('CartModel');
        $this->CartModel= new CartModel();
    }

    public function addToCart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];
            //print_r($member_id);

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng


            // Kiểm tra xem $book_id và $quantity có tồn tại trong dữ liệu gửi lên hay không
            if (!isset($data['book_id'], $data['quantity'])) {
                echo $this->generateResponse('false', 'There is something wrong');
                exit();
            }
        
            // Lấy giá trị từ dữ liệu gửi lên
            $book_id = $data['book_id'];
            $quantity = $data['quantity'];
            
            // Kiểm tra nếu $book_id và $quantity là số nguyên và không âm
            if (!is_numeric($book_id) || intval($book_id) <= 0) {
                echo $this->generateResponse('false', 'Invalid book ID');
                exit();
            }
        
            if (!is_numeric($quantity) || intval($quantity) < 0) {
                echo $this->generateResponse('false', 'Quantity must be a non-negative number');
                exit();
            }
        
            // Chuyển giá trị sang kiểu số nguyên
            $book_id = intval($book_id);
            $quantity = intval($quantity);
        
            // Dữ liệu hợp lệ, chuẩn bị truyền vào model
            $data_to_model = [
                "memberID" => $member_id,
                "bookid" => $book_id,
                "quantity" => $quantity
            ];
        
            // Gọi phương thức addToCart trong model để thêm vào giỏ hàng
            [$result, $msg] = $this->CartModel->addToCart($data_to_model);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
        
    }

    public function updateQuantityCart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng
        
            // Kiểm tra xem $book_id và $quantity có tồn tại trong dữ liệu gửi lên hay không
            if (!isset($data['book_id'], $data['quantity'])) {
                echo $this->generateResponse('false', 'There is something wrong');
                exit();
            }
        
            // Lấy giá trị từ dữ liệu gửi lên
            $book_id = $data['book_id'];
            $quantity = $data['quantity'];
        
            // Kiểm tra nếu $book_id và $quantity là số nguyên và không âm
            if (!is_numeric($book_id) || intval($book_id) <= 0) {
                echo $this->generateResponse('false', 'Invalid book ID');
                exit();
            }
        
            if (!is_numeric($quantity) || intval($quantity) < 0) {
                echo $this->generateResponse('false', 'Quantity must be a non-negative number');
                exit();
            }
        
            // Chuyển giá trị sang kiểu số nguyên
            $book_id = intval($book_id);
            $quantity = intval($quantity);
        
            // Dữ liệu hợp lệ, chuẩn bị truyền vào model
            $data_to_model = [
                "quantity" => $quantity
            ];
            $where=[
                "memberID"=>$member_id,
                "bookID"=>$book_id
            ];
        
            // Gọi phương thức addToCart trong model để thêm vào giỏ hàng
            [$result, $msg] = $this->CartModel->updateQuantity($data_to_model,$where);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
        
    }
    public function deletebookCart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); // Giải mã JSON thành mảng
        
            // Kiểm tra xem $book_id và $quantity có tồn tại trong dữ liệu gửi lên hay không
            if (!isset($data['book_id'])) {
                echo $this->generateResponse('false', 'There is something wrong');
                exit();
            }
        
            // Lấy giá trị từ dữ liệu gửi lên
            $book_id = $data['book_id'];

            // Kiểm tra nếu $book_id và $quantity là số nguyên và không âm
            if (!is_numeric($book_id) || intval($book_id) <0) {
                echo $this->generateResponse('false', 'Invalid book ID');
                exit();
            }
        
            // Chuyển giá trị sang kiểu số nguyên
            $book_id = intval($book_id);
            // Dữ liệu hợp lệ, chuẩn bị truyền vào model

            $data_to_model = [
                "member_id" => $member_id,
                "book_id" => $book_id,
            ];
        
            // Gọi phương thức addToCart trong model để thêm vào giỏ hàng
            [$result, $msg] = $this->CartModel->deleteBook($member_id, [$book_id]);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
        
    }
    // xem lại hàm delete:)) lỡ ngu xóa mất tài khoản như chơi
    public function GetAllBookCart(){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }

            $memberid= $_SESSION['id'];
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại, mặc định là trang 1
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10; // Lấy số sách trên mỗi trang, mặc định là 10 sách
            
            [$result, $msg, [$data, $count]] = $this->CartModel->getAllBookInCart($memberid, $page, $perpage);
            if ($result) {
                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                echo $this->generateResponse("complete", $msg, $data, $meta);
            }
        }else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }



}


?>