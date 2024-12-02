<?php

require_once('Controller/BaseController.php');

class UserController extends BaseController{
    private $userModel;

    function __construct(){
        $this -> loadModel('UserModel');
        $this -> userModel = new UserModel();
    }
    
    public function index(){
        $data = $this -> userModel -> getAll();
        return $this -> view('admin.pages.user',[
            'data' => $data
        ]
    );
    }
}
?>