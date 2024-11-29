<?php

require_once('Controller/BaseController.php');

class HomeController extends BaseController{
    public function index(){
        return $this -> view('user.pages.home');
    }
}
?>