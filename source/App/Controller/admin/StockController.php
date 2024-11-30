<?php

require_once('Controller/BaseController.php');

class ProductController extends BaseController{
    private $productModel;

    function __construct() {
        $this -> loadModel('ProductModel');
        $this->productModel = new ProductModel();
    }

    public function index(){
        $data = $this -> productModel->getAll();
        return $this -> view('admin.pages.product',[
            'data' => $data
        ]);
    }

    public function deleteProduct(){
        if(isset($_POST['productId'])) {
            $productId = $_POST['productId'];
            $data = $this->productModel->deleteProduct($productId);
            header("Location: index.php?controller=product&action=index");
            exit();
        }
    }

    // public function editProduct(){
    //     if(isset($_POST['productId'])) {
    //         $productId = $_POST['productId'];
    //         $product = $this->productModel->findById($productId);
    //         include 'index.php?View=productEdit.php';
    //     }
    // }

    public function updateProduct(){
        if(isset($_POST['productId'])) {
            $productId = $_POST['productId'];
            $productName = $_POST['productName'];
            $productType = $_POST['productType'];
            $productPrice = $_POST['productPrice'];
            $productDescription = $_POST['productDescription'];
            $productImageURL = $_POST['productImageURL'];
    
            $data = $this->productModel->updateProduct($productId, $productName, $productType, $productPrice, $productDescription, $productImageURL);
    
            header("Location: index.php?controller=product&action=index");
            exit();
        }
        else{
            die($_POST['productId']);
        }
    }

    public function addProduct(){
        if(isset($_POST['productName'])) {
            //$productId = $_POST['productId'];
            $productName = $_POST['productName'];
            $productType = $_POST['productType'];
            $productPrice = $_POST['productPrice'];
            $productDescription = $_POST['productDescription'];
            $productImageURL = $_POST['productImageURL'];
    
            $data = $this->productModel->addProduct($productName, $productType, $productPrice, $productDescription, $productImageURL);
    
            header("Location: index.php?controller=product&action=index");
            exit();
        }
        else{
            die($_POST['productName']);
        }
    }

}
?>