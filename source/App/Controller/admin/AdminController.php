<?php

require_once('Controller/BaseController.php');

class AdminController extends BaseController{
    private $adminModel;

    function __construct(){
        $this -> loadModel('AdminModel');
        $this -> adminModel = new AdminModel();
    }

    public function index(){
        $data = $this->adminModel->getAll();
        return $this -> view('admin.pages.admin',[
            'data' => $data
        ]);
    }
}
?>