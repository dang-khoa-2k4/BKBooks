<?php
require_once('../BaseController.php');

class BookController extends BaseController {
    private $bookModel;

    public function __construct() {
        $this->loadModel('BookModel');
        $this->bookModel = new BookModel();
    }

    // Lấy tất cả sách với phân trang (limit và offset)
    public function getAll() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Lấy dữ liệu từ query string (URL)
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;  // Mặc định limit = 10
            $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;  // Mặc định offset = 0

                // Kiểm tra và xử lý lỗi cho limit
            if ($limit === null || !is_numeric($limit) || $limit <= 0) {
                echo json_encode(['error' => 'Invalid or missing "limit" parameter. It must be a positive integer.']);
                exit();
            }

            // Kiểm tra và xử lý lỗi cho offset
            if ($offset === null || !is_numeric($offset) || $offset < 0) {
                echo json_encode(['error' => 'Invalid or missing "offset" parameter. It must be a non-negative integer.']);
                exit();
            }
            // Gọi phương thức getAll từ BookModel
            $books = $this->bookModel->getAll($limit, $offset);

            // Trả về kết quả JSON
            if ($books) {
                echo json_encode(['books' => $books]);
            } else {
                echo json_encode(['error' => 'No books found.']);
            }
            exit();
        }
    }

    // Lấy thông tin sách theo ID
    public function get_book_ID() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Lấy ID từ query string (URL)
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];

                if($id === null || !is_numeric($id) || $id<0){
                    echo json_encode(['error' => 'Invalid idbook']);
                    exit();
                }
                // Gọi phương thức getById từ BookModel
                $book = $this->bookModel->getById($id);
                
                // Trả về kết quả JSON
                if ($book) {
                    echo json_encode(['book' => $book]);
                } else {
                    echo json_encode(['error' => 'Book not found.']);
                }
            } else {
                echo json_encode(['error' => 'ID is required.']);
            }
            exit();
        }
    }

    // Lấy sách theo tác giả (author) với phân trang (offset)
    public function getByAuthor() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Lấy dữ liệu từ query string (URL)
            if (isset($_GET['author'], $_GET['limit'], $_GET['offset'])) {
                $author = htmlspecialchars(trim($_GET['author']));
                $limit = (int)$_GET['limit'];
                $offset = (int)$_GET['offset'];

                if ($limit === null || !is_numeric($limit) || $limit <= 0) {
                    echo json_encode(['error' => 'Invalid or missing "limit" parameter. It must be a positive integer.']);
                    exit();
                }
    
                // Kiểm tra và xử lý lỗi cho offset
                if ($offset === null || !is_numeric($offset) || $offset < 0) {
                    echo json_encode(['error' => 'Invalid or missing "offset" parameter. It must be a non-negative integer.']);
                    exit();
                }
                // Gọi phương thức getByAuthor từ BookModel
                $books = $this->bookModel->getByAuthor($author, $limit, $offset);

                // Trả về kết quả JSON
                if ($books) {
                    echo json_encode(['books' => $books]);
                } else {
                    echo json_encode(['error' => 'No books found for the author at this offset.']);
                }
            } else {
                echo json_encode(['error' => 'Invalid or missing parameters (author, limit, offset).']);
            }
            exit();
        }
    }

    // Lấy sách theo thể loại (genre) với phân trang (offset)
    public function getByGenre() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Lấy dữ liệu từ query string (URL)
            if (isset($_GET['genre'], $_GET['limit'], $_GET['offset'])) {
                $genre = htmlspecialchars(trim($_GET['genre']));
                $limit = (int)$_GET['limit'];
                $offset = (int)$_GET['offset'];
                
                if ($limit === null || !is_numeric($limit) || $limit <= 0) {
                    echo json_encode(['error' => 'Invalid or missing "limit" parameter. It must be a positive integer.']);
                    exit();
                }
    
                // Kiểm tra và xử lý lỗi cho offset
                if ($offset === null || !is_numeric($offset) || $offset < 0) {
                    echo json_encode(['error' => 'Invalid or missing "offset" parameter. It must be a non-negative integer.']);
                    exit();
                }
                // Gọi phương thức getByGenre từ BookModel
                $books = $this->bookModel->getByGenre($genre, $limit, $offset);

                // Trả về kết quả JSON
                if ($books) {
                    echo json_encode(['books' => $books]);
                } else {
                    echo json_encode(['error' => 'No books found for the genre at this offset.']);
                }
            } else {
                echo json_encode(['error' => 'Invalid or missing parameters (genre, limit, offset).']);
            }
            exit();
        }
    }
}
?>
