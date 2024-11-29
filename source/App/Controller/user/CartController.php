<?php

require_once('Controller/BaseController.php');

class CartController extends BaseController{

    private $cartModel;

    public function __construct() {
        $this-> loadModel('CartModel');
        $this-> cartModel = new CartModel();
    }

    public function index(){
        return $this -> view('user.pages.cart');
    }

    public function addToCart(){
        if ((!isset($_POST['id'])) || (!isset($_POST['amount']))) 
        {
            return $this -> view('user.pages.product',
            [
                'noti' => "No valid input"
            ]
            );
        }


        $productId = $_POST['id'];
        $amount = $_POST['amount'];

        if ($amount <= 0){
            return header('Location:?controller=product&action=invalid&id='.$id);
        }

        $cartID = $this -> cartModel -> getInUseCart();

        $this -> cartModel -> addToCart($productId,$cartID,$amount);
        
        return $this -> view('user.pages.cart');
    }

}
?>