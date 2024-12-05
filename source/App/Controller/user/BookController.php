<?php 
class BookController extends BaseController{
    public function __construct(){
        parent::__construct('Book');
    }

    public function getAllBook(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){

            $page= isset($_GET['page']) ? (int)$_GET['page']: 1;
            $perpage = isset($_GET['perpage']) ? (int) $_GET['perpage']:10;

            parent:: __callModel('getAllBooks', [$page, $perpage]);
        }
    }

    public function getIDBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id= (int)$_GET['id'];
            
            if($id=== null){
                echo json_encode(['error' => 'Record not found']);
            }

            parent:: __callModel('getBookById', [$id]);
        }
    }

    public function getGenreBook(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $genre= $_GET['Genre'];
            
            if($genre === null){
                echo json_encode(['error' => 'Record not found']);
            }

            parent:: __callModel('getBookByGenre', [$genre]);
        }
    }

    public function getAuthorBook(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $author = $_GET['author'];
            if($author === null){
                echo json_encode(['error' => 'Record not found']);
            }
            
            parent:: __callModel('getBookByAuthor', [$author]);

        }
    }


}

?>