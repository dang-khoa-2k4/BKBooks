<?php
require_once('Model/BaseModel.php');
class ProductModel extends BaseModel
{

    const TABLE = 'product';

    // This is for testing purposes only, don't use this
    public function getAll($selct = ['*'], $orderBy = [], $limit = 100)
    {
        return $this->all(self::TABLE, $selct, $orderBy, $limit);
    }

    public function findById($id)
    {
        return $this->find(self::TABLE, 'ProductId', $id);
    }

    public function count()
    {
        $sql = "SELECT COUNT(ProductID) AS NumberOfProduct FROM " . self::TABLE;
        $result = $this->_query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function loadProductInfo($productID)
    {
        // Select the product in product table with ProductID
        return $this->find(self::TABLE, 'ProductID', $productID);
    }

    public function loadProductItemFromCart($cartID)
    {
        $sql = "SELECT * FROM cartitem WHERE CartID = $cartID";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function deleteProduct($productId){
        $sql = "DELETE FROM product WHERE ProductID = $productId";
        $result = $this->_query($sql);
        return $result;
        // header("Location: admin.product.php");
        // exit();
    }

    public function updateProduct($productId, $productName, $productType, $productPrice, $productDescription, $productImageURL){
        $sql = "UPDATE product SET Name = '$productName', Type = '$productType', Price = '$productPrice', Description = '$productDescription', Picture = '$productImageURL' WHERE ProductID = $productId";
        //die($sql);
        $result = $this->_query($sql);
        return $result;
    }

    public function addProduct($productName, $productType, $productPrice, $productDescription, $productImageURL){
        $sql = "INSERT INTO product (Name, Price, Description, Type, Picture) VALUES ('$productName', '$productPrice', '$productDescription', '$productType', '$productImageURL')";
        //die($sql);
        $result = $this->_query($sql);
        return $result;
    }
}
