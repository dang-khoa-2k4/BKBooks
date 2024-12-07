<?php 
class BookController extends BaseController{
    private $bookmodel;

    public function __construct(){
        parent::loadModel('Book'); // Tải model Book
        $this->bookmodel = new BookModel(); // Khởi tạo instance của BookModel
    }

    /**
     * Lấy danh sách sách với phân trang.
     * Phương thức này xử lý yêu cầu GET từ client để lấy danh sách sách với các tham số phân trang.
     * @return #string JSON chứa danh sách sách và thông tin phân trang.
     * Nếu thành công, trả về danh sách sách cùng với metadata (số trang, số bản ghi).
     * Nếu không thành công, trả về thông báo lỗi.
     * Phương thức này yêu cầu các tham số `page` và `perpage` trong URL.
     */
    public function getAllBook(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại, mặc định là trang 1
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10; // Lấy số sách trên mỗi trang, mặc định là 10 sách
            
            [$result, $msg, [$data, $count]] = $this->bookmodel->getAllBooks($page, $perpage);

            if ($result) {
                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                echo $this->generateResponse("complete", $msg, $data, $meta);
            } else {
                // Trả về lỗi nếu không có sách
                echo $this->generateResponse("false", $msg, []);
            }
        }
    }

    /**
     * Lấy thông tin chi tiết sách theo ID.
     * Phương thức này xử lý yêu cầu GET để lấy thông tin của một cuốn sách dựa trên ID.
     * @return #string JSON chứa thông tin của cuốn sách với id tương ứng.
     * Nếu tìm thấy, trả về thông tin sách.
     * Nếu không tìm thấy, trả về thông báo lỗi.
     * Phương thức này yêu cầu tham số `id` trong URL.
     */
    public function getIDBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null; // Kiểm tra ID hợp lệ

            if (!$id) {
                echo json_encode(['error' => 'Invalid ID']); // Nếu ID không hợp lệ, trả về lỗi
                return;
            }


            [$result, $msg, $book] = $this->bookmodel->getBookById($id);

            if ($result) {
                echo $this->generateResponse("true", $msg, [$book]);
            } else {
                echo $this->generateResponse("false", $msg, []);
            }
        }
    }

    /**
     * Lấy danh sách sách theo thể loại.
     * Phương thức này xử lý yêu cầu GET để lấy sách theo thể loại với phân trang.
     * @return   #JSON chứa danh sách sách theo thể loại và thông tin phân trang.
     * Nếu thành công, trả về danh sách sách theo thể loại cùng với metadata.
     * Nếu không thành công, trả về thông báo lỗi.
     * Phương thức này yêu cầu tham số `genre` trong URL.
     */
    public function getGenreBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại, mặc định là trang 1
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10; // Lấy số sách trên mỗi trang, mặc định là 10 sách
            
            if (!isset($_GET['genre']) || empty($_GET['genre'])) {
                echo $this->generateResponse("false", "Genre is required", []); // Nếu không có thể loại, trả về lỗi
            }

            $genre = $_GET['genre']; // Lấy thể loại từ URL
            [$result, $msg, [$data, $count]] = $this->bookmodel->getBookByGenre($genre, $page, $perpage);

            if ($result) {

                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                echo $this->generateResponse("true", $msg, $data, $meta);
            } else {

                echo $this->generateResponse("false", $msg, []);
            }
        }
    }

    /**
     * Lấy danh sách sách theo tác giả.
     * Phương thức này xử lý yêu cầu GET để lấy sách theo tác giả với phân trang.
     * @return #string JSON chứa danh sách sách theo tác giả và thông tin phân trang.
     * Nếu thành công, trả về danh sách sách theo tác giả cùng với metadata.
     * Nếu không thành công, trả về thông báo lỗi.
     * Phương thức này yêu cầu tham số `author` trong URL.
     */
    public function getAuthorBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại, mặc định là trang 1
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10; // Lấy số sách trên mỗi trang, mặc định là 10 sách
            
            if (!isset($_GET['author']) || empty($_GET['author'])) {
                echo $this->generateResponse("false", "Author is required", []); // Nếu không có tác giả, trả về lỗi
                return;
            }

            $author = $_GET['author']; // Lấy tên tác giả từ URL

            // Gọi phương thức getBookByAuthor từ model để lấy danh sách sách theo tác giả
            [$result, $msg, [$data, $count]] = $this->bookmodel->getBookByAuthor($author, $page, $perpage);

            if ($result) {
                // Tính toán số trang và trả về kết quả
                $totalPage = ceil($count / $perpage);
                $meta = [
                    "page" => $page,
                    "perpage" => $perpage,
                    "totalPage" => $totalPage,
                    "TotalRecord" => $count
                ];
                echo $this->generateResponse("true", $msg, $data, $meta);
            } else {
                // Trả về lỗi nếu không có sách của tác giả
                echo $this->generateResponse("false", $msg, []);
            }
        }
    }
}
?>
