<?php 
require_once('../BaseController.php');

class CartController extends BaseController{
    private $CartModel;
    private $BookModel;
    public function __construct(){
        $this->loadModel('CartModel');
        $this->CartModel= new CartModel();
        $this->loadModel('BookModel');
        $this->BookModel= new BookModel();
    }
}




?>