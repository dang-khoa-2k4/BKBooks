<?php

require_once('Controller/BaseController.php');

class UserController extends BaseController{
    private $userModel;

    function __construct(Type $var = null) {
        $this -> loadModel('UserModel');
        $this -> userModel = new UserModel();
    }

    public function index(){
        $data = $this -> userModel -> getById();
        return $this -> view('user.pages.user',[
            "notification" => null,
            'data' => $data
        ]);
    }
    public function edit(){

        

        if (!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email']) || !isset($_POST['phoneno']) || !isset($_POST['gender']) || !isset($_POST['address']) || !isset($_POST['avatar'])){
            return $this -> view('user.pages.user',[
                "notification" => "Please fill in all information",
                'data' => $data
            ]);
        }
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phoneno = $_POST['phoneno'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $avatar = $_POST['avatar'];
        $id = $_SESSION['ID'];

        $this -> userModel -> editUser($id, $firstName, $lastName, $email, $phoneno, $gender, $address, $avatar, 1);
        $data = $this -> userModel -> getById();
        return $this -> view('user.pages.user',[
            "notification" => "Your user has been update successfully",
            'data' => $data
        ]);

    }
}
?>