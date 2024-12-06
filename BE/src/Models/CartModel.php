<?php 
    require_once '../src/Models/BaseModel.php';
    require_once '../src/config.php';

class CartModel extends BaseModel{
    public function __construct(){
        global $pdo;
        $this->table = 'cart';
        self::$pdo = $pdo;
        $this->rows= ['id', 'memberID', 'bookid', 'quantity'];
    }

    /**
     * Summary of addToCart
     * @param mixed $data
     * @return [$result, $msg]
     * $data = ["member_id"=> $member_id, "book_id"=> $book_id, "quantity"=> $quantity]
     */
    public function addToCart($data){
        try{
            $result = $this->insert($data);
            if($result){
                $msg = 'Add to cart successfully';
                return [true, $msg];
            }
            else{
                $msg = 'Add to cart failed';
                return [false, $msg];
            }
        }
        catch(Exception $e){
            // $msg = $e->getMessage();
            // echo $e->getMessage();
            $msg ="Add to cart failed";
            return [false, $msg];
        }
    }

    public function getAllBookInCart($memberID, $page, $perPage){
        try{
            $lim = $perPage;
            $off = ($page-1)*$perPage;
            $stmt = self::$pdo->prepare(
                "SELECT *
                FROM $this->table JOIN book ON $this->table.bookid = book.id
                WHERE memberID = :memberID
                LIMIT $lim OFFSET $off
                ");
            $result = $stmt->execute(["memberID"=> $memberID]);
            
            $stmt1 = self::$pdo->prepare(
                "SELECT COUNT(*)
                FROM $this->table JOIN book ON $this->table.bookid = book.id
                WHERE memberID = :memberID
                "); 
            $stmt1->execute(["memberID"=> $memberID]);
            
            $count = $stmt1->fetchColumn();

            if( $result ){
                if($count == 0){
                    $msg = "Cart is empty or member isn't exist";
                    return [false, $msg, []];
                }else{
                    $msg = "Get all book in cart successfully";
                    return [true, $msg, [$stmt->fetchAll(PDO::FETCH_ASSOC), $count]];
                }
            }else{
                $msg = "Get all book in cart failed";
                return [false, $msg, []];
            }
        }
        catch(Exception $e){
            $msg = "Get all book in cart failed";
            return [false, $msg, []];
        }
    }
}
?>