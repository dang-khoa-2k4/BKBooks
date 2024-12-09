<?php 
require_once (__DIR__ . '/../config.php');
require_once 'BaseModel.php';



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
    // public function getAllBooks($page, $perPage){
    // try{
    //     $result = $this->getAll($perPage, ($page - 1) * $perPage);
    //     //$result if have data: [$book, $count] else false
    //     if(!$result){//fail
    //         return [false, 'Get all books failed', []];
    //     }
    //     else{
    //         return [true, 'Get all books successfully', $result];
    //     }
    //     }catch(PDOException $e){
    //         // $msg = $e->getMessage();
    //         $msg = "Get all books failed";
    //         return [false, $msg, []];
    //     }
    // }

    public function getAllBook($page, $perPage){
        try{
            $lim = $perPage;
            $offset = ($page - 1) * $perPage;

            $stmt = self::$pdo->prepare("
                SELECT b.*, 
                    IFNULL(SUM(CASE WHEN o.Status = 'Accepted' THEN c.Quantity ELSE 0 END), 0) AS soldQuantity,
                    IFNULL(SUM(CASE WHEN o.Status = 'Pending' THEN c.Quantity ELSE 0 END), 0) AS onOrderQuantity
                FROM book b
                LEFT JOIN contain c ON b.id = c.BookID
                LEFT JOIN `order` o ON c.OrderID = o.ID
                GROUP BY b.id
                LIMIT $lim OFFSET $offset
            ");

            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt1 = self::$pdo->prepare("
                SELECT COUNT(*) 
                FROM book
            ");
            $stmt1->execute();
            $count = $stmt1->fetchColumn();

            if ($books) {
                $msg = 'Get all books successfully';
                return [true, $msg, [$books, $count]];
            } else {
                $msg = 'Get all books failed';
                return [false, $msg, []];
            }
        } catch (PDOException $e) {
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
    public function getBookById($id){
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
    public function getBookByGenre($genre, $page, $perPage){
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
    public function getBookByAuthor($author, $page, $perPage){
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

    public function addStockBook($quantity, $id){
        try{
            $stmt = self::$pdo->prepare("UPDATE $this->table SET quantity = quantity + :quantity WHERE id = :id");
            $result = $stmt->execute(["quantity"=> $quantity,"id"=> $id]);
            if(!$result){
                $msg = "Add quantity failed";
                return [false, $msg];
            }
            else{
                $msg = "Add quantity successfully";
                return [true, $msg];
            }
        }
        catch(Exception $e){
            $msg = "Add quantity failed";
            return [false, $msg];
        }
    }

    public function getAllStockBook($page, $perPage){
        try{
            $lim = $perPage;
            $offset = ($page -1) * $perPage;
            $stmt = self::$pdo->prepare("SELECT * FROM $this->table WHERE quantity > 0 LIMIT $lim OFFSET $offset");
            $result = $stmt->execute();

            $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM $this->table WHERE quantity > 0");
            $result1 = $stmt1->execute();
            $count = $stmt1->fetchColumn();
            if(!$result){
                $msg = "Get all book in stock failed";
                return [false, $msg,[]];
            }
            else{
                $msg = "Get all book in stock successfully";
                return [true, $msg, [$stmt->fetchAll(PDO::FETCH_ASSOC), $count]];
            }
        }
        catch(Exception $e){
            $msg = "Get all book in stock failed";
            return [false, $msg, []];
        }
    }
}

?>