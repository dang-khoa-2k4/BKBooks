<?php 
require_once(__DIR__ . '/../BaseController.php');

class CommentController extends BaseController{
    private $CommentModel;

    public function __construct(){
        $this->loadModel('Comment');
        $this->CommentModel= new CommentModel();
    }

    public function addComment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); 
            
            $book_id = $data['book_id'];
            $content = $data['content'];

            // Kiểm tra book_id
            if (!isset($book_id) || !is_numeric($book_id) || $book_id <= 0) {
                echo $this->generateResponse("false", "Invalid book ID");
                exit();
            }

            $content = htmlspecialchars($content);

            $data_to_model = [
                "bookid"    =>  $book_id,
                "memberid"  =>  $member_id,
                "content"   => $content
            ];

            [$result, $msg]= $this->CommentModel->addComment($data_to_model);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }

    public function updateComment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); 
            
            $book_id = $data['book_id'];
            $content = $data['content'];
            $time = $data['time'];

            // Kiểm tra book_id
            if (!isset($book_id) || !is_numeric($book_id) || $book_id <= 0) {
                echo $this->generateResponse("false", "Invalid book ID");
                exit();
            }

            // Kiểm tra time (định dạng thời gian hợp lệ)
            if (!isset($time) || !strtotime($time)) {
                echo $this->generateResponse("false", "Invalid time format");
                exit();
            }

            $content = htmlspecialchars($content);
            $time = htmlspecialchars($time);

            $data_to_model = [
                "bookid"    =>  $book_id,
                "memberid"  =>  $member_id,
                "content"   => $content,
                "time"      => $time
            ];

            [$result, $msg]= $this->CommentModel->updateComment($data_to_model);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }

    public function deleteComment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse('false', 'Please login');
                exit();
            }
        
            $member_id = $_SESSION['id'];

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true); 
            
            $book_id = $data['book_id'];
            $time = $data['time'];

            // Kiểm tra book_id
            if (!isset($book_id) || !is_numeric($book_id) || $book_id <= 0) {
                echo $this->generateResponse("false", "Invalid book ID");
                exit();
            }

            // Kiểm tra time (định dạng thời gian hợp lệ)
            if (!isset($time) || !strtotime($time)) {
                echo $this->generateResponse("false", "Invalid time format");
                exit();
            }

            $time = htmlspecialchars($time);

            [$result, $msg] = $this->CommentModel->deleteComment($book_id, $member_id, $time);
            echo $this->generateResponse($result ? "true" : "false", $msg);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }

    public function getAllComment(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_SESSION['id'])) {
                echo $this->generateResponse("false", "You must be logged in to change your password");
                return;
            }
            $member_id = $_SESSION['id'];
            $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;

            // Kiểm tra book_id
            if (!isset($book_id) || !is_numeric($book_id) || $book_id <= 0) {
                echo $this->generateResponse("false", "Invalid book ID");
                return;
            }

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10;

            [$result, $msg, $data] = $this->CommentModel->getAllComment($page, $perpage, $book_id);
            
            echo $this->generateResponse($result ? "true" : "false", $msg, $data);
        } else {
            echo $this->generateResponse("false", "Invalid request method");
        }
    }
}
?>
