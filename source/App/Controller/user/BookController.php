<?php 
class BookController extends BaseController{
    private $bookmodel;

    public function __construct(){
        parent:: loadModel('Book');
        $this->bookmodel = new BookModel();
    }

    public function getAllBook(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10;
            
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
                echo $this->generateResponse("false", $msg, []);
            }
        }
    }

    public function getIDBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

            if (!$id) {
                echo json_encode(['error' => 'Invalid ID']);
                return;
            }

            [$result, $msg, $book] = $this->bookmodel->getBookById($id);

            if ($result) {
                echo $this->generateResponse("complete", $msg, [$book]);
            } else {
                echo $this->generateResponse("false", $msg, []);
            }
        }
    }

    public function getGenreBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10;
            
            if (!isset($_GET['genre']) || empty($_GET['genre'])) {
                echo $this->generateResponse("false", "Genre is required", []);
                return;
            }

            $genre = $_GET['genre'];

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

    public function getAuthorBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 10;
            
            if (!isset($_GET['author']) || empty($_GET['author'])) {
                echo $this->generateResponse("false", "Author is required", []);
                return;
            }

            $author = $_GET['author'];

            [$result, $msg, [$data, $count]] = $this->bookmodel->getBookByAuthor($author, $page, $perpage);

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
}
?>


}

?>