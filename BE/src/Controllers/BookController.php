<?php
class BookController {
    private $bookModel;
    public function __construct() {
        require_once '../src/Models/BookModel.php';
        $this->bookModel = new BookModel();
    }
    public function getBooks($page, $perPage) {
        [$books, $count] = $this->bookModel->getAllBooks($page, $perPage);

        $totalPage= ceil($count/$perPage);

        $meta = [
            "page" => $page,
            "perPage" => $perPage,
            "totalPage" => $totalPage,
            "totalRecord" => $count
        ];

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Get all books successfully",
            "data" =>$books,
            "meta" => $meta 
        ];
        echo json_encode($response);
    }

    public function getBookById($id) {
        [$book] = $this->bookModel->getBookById($id);

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Get book by id successfully",
            "data" => $book
        ];
        echo json_encode($response);
    }


    public function getBookByGenre($genre, $page, $perPage) {
        [$books, $count] = $this->bookModel->getBookByGenre($genre, $page, $perPage);

        $totalPage= ceil($count/$perPage);
        $meta = [
            "page" => $page,
            "perPage" => $perPage,
            "totalPage" => $totalPage,
            "totalRecord" => $count
        ];

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Get book by genre successfully",
            "data" => $books,
            "meta" => $meta
        ];
        echo json_encode($response);
    }

    public function getBookByAuthor($author, $page, $perPage){
        [$books, $count] = $this->bookModel->getBookByAuthor($author, $page, $perPage);

        $totalPage= ceil($count/$perPage);
        $meta = [
            "page" => $page,
            "perPage" => $perPage,
            "totalPage" => $totalPage,
            "totalRecord" => $count
        ];

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Get book by author successfully",
            "data" => $books,
            "meta" => $meta
        ];
        echo json_encode($response);
    }

    public function addBook($data) {

        $lastId = $this->bookModel->addBook($data);

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Add book successfully",
            "lastId:" => $lastId
        ];
        echo json_encode($response);
    }

    public function updateBook($data, $where) {
        $this->bookModel->updateBook($data, $where);

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Update book successfully"
        ];
        echo json_encode($response);
    }

    public function deleteBook($id) {
        $this->bookModel->deleteBook($id);

        header('Content-Type: application/json');
        $response = [
            "status" => "success",
            "message" => "Delete book successfully"
        ];
        echo json_encode($response);
    }
}
?>