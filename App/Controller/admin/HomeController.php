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

        $admininfo = $this->adminModel-> getById();
        $usercount = $this -> userModel->count();
        $productcount = $this -> productModel->count();
        $cartcount=  $this -> cartModel ->count();
        $cartlist  = $this -> cartModel -> getRecentCart();
        //TODO
        //add username to this list 
        $userlist = $this -> userModel -> getRecentUser();

        return $this -> view('admin.pages.home',[
            'admininfo' => $admininfo,
            'usercount' => $usercount,
            'productcount' => $productcount,
            'cartcount' => $cartcount,
            'cartlist' => $cartlist,
            'userlist' => $userlist
        ]);
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