<?php

require_once('Controller/BaseController.php');

class HomeController extends BaseController{

    private $adminModel;
    private $userModel;
    private $productModel;
    private $cartModel;

    function __construct(){

        $this -> loadModel('AdminModel');
        $this -> adminModel = new AdminModel();
        $this -> loadModel('UserModel');
        $this -> userModel = new UserModel();
        $this -> loadModel('ProductModel');
        $this -> productModel = new ProductModel();
        $this -> loadModel('CartModel');
        $this -> cartModel = new CartModel();

    }

    public function index(){
        # TODO: 
    }
    
    public function logout(){
        $this -> adminModel -> logout();
        return $this -> view('user.pages.login',
        [
            'error' => [],
            'success' => "Logout successfully."
        ]);
    }
}
?>