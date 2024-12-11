<?php
class BookController {
    private $bookModel;
    public function __construct() {
        require_once '../src/Models/BookModel.php';
        $this->bookModel = new BookModel();
    }
    public function getBooks($page, $perPage) {
        [$result,$msg,[$books, $count]] = $this->bookModel->getAllBooks($page, $perPage);


        header('Content-Type: application/json');
        if ($result) {
            $totalPage= ceil($count/$perPage);

            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "totalPage" => $totalPage,
                "totalRecord" => $count
            ];

            $response = [
                "status" => "success",
                "message" => $msg,
                "data" =>$books,
                "meta" => $meta 
            ];
            echo json_encode($response);
        } else {
                $response = [
                    "status" => "fail",
                    "message" => $msg,
                    "data" => []
                ];
            echo json_encode($response);
        }
    }
    public function getBookById($id) {
        [$result, $msg, $book] = $this->bookModel->getBookById($id);

        header('Content-Type: application/json');
        if ($result) {
            $respone = [
                'status'=> 'success',
                'message'=> $msg,
                'data'=> $book
            ];
            echo json_encode($respone);
        }
        else{
            $response = [
                'status'=> 'fail',
                'message'=> $msg,
                'data'=> []
                ];
            echo json_encode($response);
        }
    }


    public function getBookByGenre($genre, $page, $perPage) {
        [$result,$msg,[$books, $count]] = $this->bookModel->getBookByGenre($genre, $page, $perPage);

        header('Content-Type: application/json');
        if ($result) {
            $totalPage= ceil($count/$perPage);

            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "totalPage" => $totalPage,
                "totalRecord" => $count
            ];

            $response = [
                "status" => "success",
                "message" => $msg,
                "data" =>$books,
                "meta" => $meta 
            ];
            echo json_encode($response);
        } else {
                $response = [
                    "status" => "fail",
                    "message" => $msg,
                    "data" => []
                ];
            echo json_encode($response);
        }
    }

    public function getBookByAuthor($author, $page, $perPage){
        [$result, $msg, [$books, $count]] = $this->bookModel->getBookByAuthor($author, $page, $perPage);

        header('Content-Type: application/json');
        if ($result) {
            $totalPage= ceil($count/$perPage);
            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "totalPage" => $totalPage,
                "totalRecord" => $count
            ];

            
            $response = [
                "status" => "success",
                "message" => $msg,
                "data" => $books,
                "meta" => $meta
            ];
        } else {
            $response = [
                "status" => "fail",
                "message" => $msg,
                "data" => []
            ];
        }
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
        [$result, $msg] = $this->bookModel->updateBook($data, $where);

        header('Content-Type: application/json');
        $response = [
            "status" => $result ? "success" : "fail",
            "message" => $msg
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

    public function getBookByPriceRange($priceBegin, $priceEnd, $page, $perPage, $sortOpt){
        [$result, $msg, [$books, $count]] = $this->bookModel->getBookByPriceRange($priceBegin, $priceEnd, $page, $perPage, $sortOpt); 
        if(!$result){
            header("Content-Type: application/json");
            $response = [
                "status" => "fail",
                "message" => $msg,
                "data" => []
            ];
            echo json_encode($response);
        }
        else{
            header("Content-Type: application/json");
            $totalPage = ceil($count/$perPage);

            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "total"=> $totalPage,
                "totalRecord" => $count,
            ];
            $response = [
                "status" => "success",
                "message" => $msg,
                "data" => $books,
                "meta" => $meta
            ];
            echo json_encode($response);
        }
    }
}
?>