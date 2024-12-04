<?php 
require_once '../src/config.php';
require_once '../src/Models/BaseModel.php';


/** 
 * write comment to explain the class
 * 
 */
class BookModel extends BaseModel{
    public function __construct(){
        global $pdo;
        self::$pdo = $pdo;
        $this->table = 'book';
        $this->rows = ['id', 'quantity', 'genre', 'name', 'author', 'publisher', 'price', 'image', 'description'];
        // parent::__construct();
    }

    public function getAllBooks($page, $perPage){
        return $this->getAll($perPage, ($page - 1) * $perPage);
    }

    public function getBookById($id){
        return $this->getBy('id', $id);
    }

    public function getBookByGenre($genre, $page, $perPage){
        return $this->getBy('genre', $genre, $perPage, ($page - 1)* $perPage);
    }

    public function getBookByAuthor($author, $page, $perPage){
        return $this->getBy('author', $author, $perPage, ($page - 1)* $perPage);
    }
    
    public function addBook($data){
        return $this->insert($data);
    }

    public function updateBook($data, $where){
        return $this->update($data, $where);
    }

    public function deleteBook($id){
        return $this->deleteByID($id);
    }
}
