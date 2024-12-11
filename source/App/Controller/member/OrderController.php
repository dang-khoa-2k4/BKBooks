<?php
require_once(__DIR__ . '/../BaseController.php');

class OrderController extends BaseController
{
    private $Ordermodel;

    public function __construct()
    {
        $this->loadModel("OrderModel");
        $this->Ordermodel = new OrderModel();
    }
    public function addOrder()
    {
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

            $address = htmlspecialchars(trim($data['address']));
            $booklist = $data['booklist'];

            // Kiểm tra tính hợp lệ của địa chỉ
            if (empty($address)) {
                echo $this->generateResponse('false', 'Address cannot be empty');
                exit();
            }

            // Khởi tạo mảng book_to_model để chứa các thông tin sách
            $book_to_model = [];

            // Kiểm tra và xử lý từng sách trong danh sách
            foreach ($booklist as $book) {
                if (!isset($book['BookID'], $book['Quantity'])) {
                    echo $this->generateResponse('false', 'Each book must have a valid bookID and quantity');
                    exit();
                }

                // Kiểm tra xem bookID có phải là một số nguyên hợp lệ không
                if (!is_numeric($book['BookID']) || intval($book['BookID']) <= 0) {
                    echo $this->generateResponse('false', 'Invalid bookID');
                    exit();
                }

                // Kiểm tra quantity phải là số nguyên và không âm
                if (!is_numeric($book['Quantity']) || intval($book['Quantity']) <= 0) {
                    echo $this->generateResponse('false', 'Quantity must be a positive integer');
                    exit();
                }
                $book_model = [
                    'bookID' => intval($book['BookID']),
                    'quantity' => intval($book['Quantity'])
                ];
                // Tạo một đối tượng book để thêm vào mảng book_to_model
                $book_to_model[] = $book_model;
            }
            // Tạo dữ liệu đơn hàng để lưu vào cơ sở dữ liệu (gồm member_id, address và booklist)
            $order_data = [
                'memberID' => $member_id,
                'deliveryAddress' => $address,
                'bookList' => $book_to_model // Lưu danh sách các sách với bookID và quantity
            ];

            // Gọi phương thức model để thêm đơn hàng vào cơ sở dữ liệu
            [$result, $msg, $failBook] = $this->Ordermodel->addOrder($order_data);

            // Trả về phản hồi sau khi thêm đơn hàng
            echo $this->generateResponse($result ? 'true' : 'false', $msg, $failBook);
        } else {
            echo $this->generateResponse('false', 'Invalid request method');
        }
    }

    public function cancelOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Kiểm tra nếu người dùng chưa đăng nhập
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }

            if (!isset($_GET['order_id'])) {
                echo $this->generateResponse('false', 'Invalid order_id');
                exit;
            }

            $order_id = $_GET['order_id'];
            [$result, $msg] = $this->Ordermodel->cancelOrder($order_id);
            echo $this->generateResponse($result ? 'true' : 'false', $msg);
        } else {
            echo $this->generateResponse('false', 'Invalid request method');
        }
    }

    public function getBookInOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }

            if (!isset($_GET['order_id'])) {
                echo $this->generateResponse('false', 'Invalid order_id');
                exit;
            }

            $order_id = $_GET['order_id'];
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại, mặc định là trang 1
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10; // Lấy số sách trên mỗi trang, mặc định là 10 sách

            [$result, $msg, [$book, $count, $totalPrice]] =
                $this->Ordermodel->getBookInOrder($order_id, $page, $perpage);
            if ($result) {
                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                $data_to_respone = [
                    "booklist" => $book,
                    "totalprice" => $totalPrice
                ];
                echo $this->generateResponse("complete", $msg, $data_to_respone, $meta);
            }
        } else {
            echo $this->generateResponse('false', 'Invalid request method');
        }
    }
    public function getByOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }

            $status = isset($_GET['status']) ? $_GET['status'] : null;
            $bookID =  isset($_GET['bookID']) ? $_GET['bookID'] : null;
            $member_id = $_SESSION['id'];


            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10;

            [$result, $msg, [$order, $count]] =
                $this->Ordermodel->getAllOrder($page, $perpage, $member_id, $bookID, $status);
            if ($result) {
                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                echo $this->generateResponse("complete", $msg, $order, $meta);
            } else {
                echo $this->generateResponse('false', 'Invalid request method');
            }
        }
    }
}
