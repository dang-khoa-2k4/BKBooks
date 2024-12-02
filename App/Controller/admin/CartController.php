<?php

require_once('Controller/BaseController.php');

class CartController extends BaseController{
    private $cartModel;

    function __construct(){
        $this -> loadModel('CartModel');
        $this -> cartModel = new CartModel();
    }

    public function index(){
        $data = $this->cartModel->getAll();
        return $this -> view('admin.pages.cart',[
            'data' => $data
        ]);
    }
}
?>