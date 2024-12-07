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
    /**
     * Get all books
     * @param $page
     * @param $perPage
     * @return [$result, $msg, [$books, $count]]
     * $books = [$book1, $book2, ...]
     * $count = number of books
     * $result = true if success, false if fail
     * $msg = message
     */
    public function getAllBook($page, $perPage){
    try{
        $result = $this->getAll($perPage, ($page - 1) * $perPage);
        //$result if have data: [$book, $count] else false
        if(!$result){//fail
            return [false, 'Get all books failed', []];
        }
        else{
            return [true, 'Get all books successfully', $result];
        }
        }catch(PDOException $e){
            // $msg = $e->getMessage();
            $msg = "Get all books failed";
            return [false, $msg, []];
        }
    }

    /**
     * Summary of getBookById
     * @param $id: id of book
     * @return array: [$result, $msg, $book]
     * $result: true if success, false if fail
     * $msg: message
     * $book: book if success
     */
    public function getByIdBook($id){
    try{
        $result = $this->getBy('id', $id);

        if(!$result){
            return [false, 'Get book by id failed', []];
        }
        else{
            if(!$result[0]){
                return [false, 'Book isn\'t exist', []];
            }
            return [true, 'Get book by id successfully', $result[0][0]];
        }
    }catch(PDOException $e){
        $msg = 'Get book by id failed';
        return [false, $msg, []];
    }
    }

    /**
     * Get book by genre
     * @param mixed $genre
     * @param mixed $page
     * @param mixed $perPage
     * @return [$result, $msg, [$books, $count]]
     * $books = [$book1, $book2, ...]
     * $count = number of books
     * $result = true if success, false if fail
     * $msg = message
     */
    public function getByGenreBook($genre, $page, $perPage){
    try{
        $result = $this->getByLike('genre', "%$genre%", $perPage, ($page - 1)* $perPage);
        if(!$result){
            return [false, 'Get book by genre failed', []];
        }
        else {
            if(!$result[0]){
                return [false, 'Book isn\'t exist', []];
            }
            else{
                return [true, 'Get book by genre successfully', $result];
            }
        }
    }catch(PDOException $e){
        $msg = 'Get book by genre failed';
        return [false, $msg, []];
    }
    }

    /**
     * Get book by author
     * @param  $author
     * @param  $page
     * @param  $perPage
     * @return [$result, $msg, [$books, $count]]
     * $books = [$book1, $book2, ...]
     * $count = number of books
     * $result = true if success, false if fail
     */
    public function getByAuthorBook($author, $page, $perPage){
    try{
        $result = $this->getByLike('author', "%$author%", $perPage, ($page - 1)* $perPage);
        if(!$result){
            return [false, "Get book by author failed", []];
        }
        else{
            return [true, "Get book by author successfully", $result];
        }
    }catch(PDOException $e){
        $msg = 'Get book by author failed';
        return [false, $msg, []];
    }
    }
    

    /**
     * Summary of addBook
     * @param mixed $data. examp: [$quantity, $genre, $name, $author, $publisher, $price, $image, $description]
     * @return
     */
    public function addBook($data){
    try{
        $result = $this->insert($data);
        if(!$result){
            return [false, 'Add book failed', []];
        }
        else{
            return [true, 'Add book successfully', []];
        }
    }catch(PDOException $e){
        $msg = 'Add book failed';
        return [false, $msg, []];
    }
    }

    /**
     * Summary of updateBook
     * @param $data examp: [$quantity, $genre, $name, $author, $publisher, $price, $image, $description]
     * @param $where examp: ['id' => $id]
     * @return [$result, $msg, []]
     */
    public function updateBook($data, $where){
    try{
        $result = $this->update($data, $where);
        if(!$result){
            return [false, 'Update book failed', []];
        }else{
            return [true, 'Update book sucessfully', []];
        }
    }catch(PDOException $e){
        $msg = 'Update book failed';
        return [false, $msg, []];
    }
    }

    /**
     * Summary of deleteBook
     * @param $id Examp: 1
     * @return [$result, $msg, []]
     */
    public function deleteBook($id){
    try{
        $result = $this->deleteByID($id);
        if(!$result){
            return [false, 'Delete book failed', []];
        }
        else{
            return [true, 'Delete book successfully', []];
        }
    }catch(PDOException $e){
        $msg = 'Delete book failed';
        return [false, $msg, []];
    }
}
}
