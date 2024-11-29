<?php

require_once('Controller/BaseController.php');

class ProductController extends BaseController{

    private $productModel;

    function __construct(){
        $this -> loadModel('ProductModel');
        $this -> productModel = new ProductModel();
    }

    public function index(){
        if (!(isset($_GET['id']))){
            return $this -> view('user.pages.home');
        }
        $data = $this -> productModel -> findById($_GET['id']);
        return $this -> view('user.pages.product',
            [
                'data' => $data
            ]
        );
    }

    public function invalid(){
        if (!(isset($_GET['id']))){
            return $this -> view('user.pages.home');
        }
        $data = $this -> productModel -> findById($_GET['id']);
        return $this -> view('user.pages.product',
            [
                'data' => $data,
                'alert' => "Please insert a valid number"
            ]
        );
    }

    
}
?>