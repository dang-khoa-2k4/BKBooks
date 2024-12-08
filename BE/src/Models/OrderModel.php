<?php
require_once '../src/Models/BaseModel.php';
require_once '../src/config.php';

class OrderModel extends BaseModel{
    public function __construct(){
        global $pdo;
        self::$pdo = $pdo;
        $this->table = "order";
        $this->rows = ["ID", "memberID", "status", "deliveryAddress", "time_created"];
    }

    /**
     * Summary of addOrder
     * @param mixed $data. ["memberID"=> $memberID, "deliveryAddress"=> $deliveryAddress,"bookList"=> [["bookID"=> $bookID, "quantity"=> $quantity], ...]]
     * {
     *   "memberID": 11,
     *   "deliveryAddress": "Anywhere",
     *   "bookList":[
     *       {
     *           "bookID": 1,
     *           "quantity": 1
     *       }
     *   ]
     * }
     */
    public function addOrder($data){
        try{
            $stmt = self::$pdo->prepare("INSERT INTO `$this->table` (memberID, deliveryAddress) VALUES (:memberID, :deliveryAddress)");
            $result = $stmt->execute(["memberID"=> $data["memberID"], "deliveryAddress"=> $data["deliveryAddress"]]);
            $last_id = self::$pdo->lastInsertId();

            $empty = true;
            foreach($data["bookList"] as $book){
                $stmt = self::$pdo->prepare("SELECT * from cart where memberID = :memberID and bookID = :bookID and quantity = :quantity");
                $stmt->execute(["memberID"=> $data["memberID"], "bookID"=> $book["bookID"], "quantity" => $book["quantity"]]);
                $status = $stmt->fetch(PDO::FETCH_ASSOC);
                if($status&&$status["Status"] === 'available'){
                    $stmt = self::$pdo->prepare("INSERT INTO contain (orderID, bookID, quantity) VALUES (:orderID, :bookID, :quantity)");
                    $result = $stmt->execute(["orderID"=> $last_id, "bookID"=> $book["bookID"], "quantity"=> $book["quantity"]]);
                    $empty = false;
                }
            }
            if($empty){
                $stmt = self::$pdo->prepare("DELETE FROM `$this->table` WHERE ID = :ID");
                $stmt->execute(["ID"=> $last_id]);
                $msg = "Add order failed because all book is not available";
                return [false, $msg];
            }
            $msg = "Add order successfully";
            return [true, $msg];
        }
        catch(Exception $e){
            echo $e->getMessage();
            $msg = "Add order failed";
            return [false, $msg];
        }
    }


    /**
     * Summary of getBookInOrder
     * @param mixed $orderID
     * @param mixed $page
     * @param mixed $perPage
     * @return [$result, $msg, [$book, $count, $totalPrice]] //LƯU Ý $totalPrice
     */
    public function getBookInOrder($orderID, $page, $perPage){
        try{
            $lim = $perPage;
            $offs = ($page-1)*$perPage;
            $stmt = self::$pdo->prepare("SELECT c.*, b.name, b.genre, b.author, b.image, b.description FROM contain c JOIN book b ON c.bookid = b.id WHERE orderID = :orderID LIMIT $lim OFFSET $offs");
            $stmt->execute(["orderID"=> $orderID]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM contain WHERE orderID = :orderID");
            $stmt1->execute(["orderID"=> $orderID]);
            $count = $stmt1->fetchColumn();
            

            $stmt2 = self::$pdo->prepare("SELECT SUM(b.price * c.Quantity) FROM contain c JOIN book b ON c.BookID = b.id WHERE c.OrderID = :orderID");
            $stmt2->execute(["orderID"=> $orderID]);
            $totalPrice = $stmt2->fetchColumn();

            if($result){
                $msg = "Get book in order successfully";
                return [true, $msg, [$result, $count, $totalPrice]];
            }else{

            }
        }
        catch(Exception $e){
            $msg = "Get book in order failed";
            return [false, $msg, []];
        }
    }

    /**
     * Get all order for admin
     * @param mixed $page
     * @param mixed $perPage
     * 3 param optional $memberID, $bookID, $status
     * @return [$result, $msg, $order]
     */
    public function getAllOrder($page, $perPage, $memberID = null, $bookID = null, $status = null){ 
        try {
            $lim = $perPage;
            $offs = ($page - 1) * $perPage;
    
            // Xây dựng điều kiện WHERE
            $conditions = [];
            if ($memberID) {
                $conditions[] = "m.id = :memberID";
            }
            if ($bookID) {
                $conditions[] = "c.BookID = :bookID";
            }

            if ($status) {
                $conditions[] = "o.status = :status";
            }
            $whereClause = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";
            
            
            // Chuẩn bị câu lệnh SQL chính
            $stmt = self::$pdo->prepare("
                SELECT o.id as orderID, username, o.time_created, o.status, o.deliveryAddress, 
                       (SELECT SUM(b.price * c.Quantity) 
                        FROM contain c 
                        JOIN book b ON c.BookID = b.id 
                        WHERE c.OrderID = o.id) as totalPrice
                FROM `$this->table` o
                JOIN member m ON o.memberID = m.id
                JOIN user ON user.id = m.id
                JOIN contain c ON c.OrderID = o.id
                $whereClause
                GROUP BY o.id
                LIMIT $lim OFFSET $offs
            ");
    
            // Chuẩn bị câu lệnh đếm tổng số đơn hàng
            $stmt1 = self::$pdo->prepare("
                SELECT COUNT(DISTINCT o.id) 
                FROM `$this->table` o
                JOIN member m ON o.memberID = m.id
                JOIN contain c ON c.OrderID = o.id
                $whereClause
            ");
    
            // Thực thi câu lệnh đếm
            $params = [];
            if ($memberID) {
                $params['memberID'] = $memberID;
            }
            if ($bookID) {
                $params['bookID'] = $bookID;
            }
            if($status){
                $params['status'] = $status;
            }
    
            $stmt1->execute($params);
            $count = $stmt1->fetchColumn();
    
            // Thực thi câu lệnh chính
            $result = $stmt->execute($params);
    
            if (!$result) {
                $msg = "Get all orders failed";
                return [false, $msg, []];
            } else {
                $msg = "Get all orders successfully";
                return [true, $msg, [$stmt->fetchAll(PDO::FETCH_ASSOC), $count]];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $msg = "Get all orders failed";
            return [false, $msg, []];
        }
    }
    
    public function acceptOrder($orderID){
        try {
            $stmt = self::$pdo->prepare("UPDATE `$this->table` SET status = 'Accepted' WHERE ID = :orderID");
            $result = $stmt->execute(["orderID"=> $orderID]);
            if (!$result) {
                $msg = "Accept order failed";
                return [false, $msg];
            }
            else{
                $msg = "Accept order successfully";
                return [true, $msg];
            }
        }
        catch (Exception $e) {
            $msg = "Accept order failed";
            return [false, $msg];
        }
    }

    public function rejectOrder($orderID){
        try {
            $stmt = self::$pdo->prepare("UPDATE `$this->table` SET status = 'Rejected' WHERE ID = :orderID");
            $result = $stmt->execute(["orderID"=> $orderID]);
            if (!$result) {
                $msg = "Reject order failed";
                return [false, $msg];
            }
            else{
                $msg = "Reject order successfully";
                return [true, $msg];
            }
        }
        catch (Exception $e) {
            $msg = "Reject order failed";
            return [false, $msg];
        }
    }

    public function cancelOrder($orderID){
        try {
            $stmt = self::$pdo->prepare("UPDATE `$this->table` SET status = 'Cancelled' WHERE ID = :orderID");
            $result = $stmt->execute(["orderID"=> $orderID]);
            if (!$result) {
                $msg = "Cancel order failed";
                return [false, $msg];
            }
            else{
                $msg = "Cancel order successfully";
                return [true, $msg];
            }
        }
        catch (Exception $e) {
            $msg = "Cancel order failed";
            return [false, $msg];
        }
    }
}