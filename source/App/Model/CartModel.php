<?php
require_once('Model/BaseModel.php');
require_once('Model/ProductModel.php');
class CartModel extends BaseModel
{

    const TABLE = 'cart';
    private $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel();
    }

    // This is for testing purposes only, don't use this
    public function getAll($selct = ['*'], $orderBy = [], $limit = 100)
    {
        return $this->all(self::TABLE, $selct, $orderBy, $limit);
    }

    public function findById($id)
    {
        return $this->find(self::TABLE, 'CartID', $id);
    }

    public function count()
    {
        $sql = "SELECT COUNT(CartID) AS NumberOfCart FROM " . self::TABLE;
        $result = $this->_query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getRecentCart()
    {
        $sql = "SELECT Username, CartID, ExportDate FROM " . self::TABLE . " c JOIN member m ON c.UserID = m.UserID ORDER BY CartID DESC LIMIT 5";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function addToCart($ProductID,$CartId,$amount){
        $sql = "INSERT INTO cartitem (ProductID,CartID,Amount) VALUES ({$ProductID} , $CartId, {$amount})";
        $this -> _query($sql);
    }

    public function getInUseCart(){
        $sql = "SELECT CartID FROM ". self::TABLE. " WHERE ExportDate IS NULL AND UserID = {$_SESSION['ID']} ";
        $result = $this -> _query($sql);
        $row = $result->fetch_assoc();
        if ((bool)$row){
            return $row['CartID'];
        } else {
            $data = ['UserID' => $_SESSION['ID']];
            $this -> create(self::TABLE, $data);

            $sql = "SELECT CartID FROM ". self::TABLE. " WHERE ExportDate IS NULL AND UserID = {$_SESSION['ID']} ";
            $result = $this -> _query($sql);
            $row = $result -> fetch_assoc();
            return $row['CartID'];
        }  
    }

    public function getCartId($userID){
        $sql = "SELECT CartID FROM cart WHERE UserID = $userID AND ExportDate IS NULL";
        $result = $this->_query($sql);
        $row = $result->fetch_assoc();
        if ((bool)$row == False) return null;
        return $row['CartID'];
    }

    public function getUserIdByCartId($cartID){
        return $this->find(self::TABLE, 'CartID', $cartID)['UserID'];
    }

    public function loadCartItems($cartID)
    {
        $sql = "SELECT * FROM cartitem WHERE CartID = $cartID";
        $result = $this->_query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $item = [
                'Product' => $this -> productModel->loadProductInfo($row['ProductID']),
                'CartID' => $row['CartID'],
                'Amount' => $row['Amount']
            ];
            $data[] = $item;
        }
        return $data;
    }

    public function updateCartItems($productID, $amount, $cartID)
    {
        if ($amount == 0) {
            // If amount is 0, delete the item from cartitem
            $sql = "DELETE FROM cartitem WHERE CartID = $cartID AND ProductID = $productID";
            $this->_query($sql);
        } else {
            $sql = "SELECT * FROM cartitem WHERE CartID = $cartID AND ProductID = $productID";
            $result = $this->_query($sql);

            // if the item is not in the cart, insert a new item
            if ($result->num_rows == 0) {
                $this -> addToCart($productID,$cartID,$amount);
            } else {
                // if the item is in the cart, update the amount
                $sql = "UPDATE cartitem SET Amount = $amount WHERE CartID = $cartID AND ProductID = $productID";
                $this->_query($sql);
            }
        }
        return $this->loadCartItems($cartID);
    }

    public function clearCart($cartID)
    {
        $this -> delete('cartitem', 'CartID', $cartID);
        return [];
    }

    public function deleteCart($cartID)
    {
        $this -> delete('cartitem', 'CartID', $cartID);
        $this -> delete(self::TABLE, 'CartID', $cartID);
        return [];
    }

    public function checkout($cartID)
    {
        $sql = "UPDATE cart SET ExportDate = NOW() WHERE CartID = $cartID";
        $this->_query($sql);
        return True;
    }
}
