<?php 
require_once('../BaseController.php');

class AccountCotroller extends BaseController{
    private $AccountModel;

    function __construct(){
        $this->loadModel('AccountModel');
        $this->AccountModel = new  AccountModel();
    }

    public function regiter(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            $email = htmlspecialchars(trim($_POST['email']));
            // make the string input to html to avoid XSS
            $response = $this->AccountModel->register($username, $password, $email);
            // connect to model
            echo $response;
            exit();
        }

    }

    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $username= htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            
            $response= $this->AccountModel->login($username, $password);
            $data= json_decode($response, true);

            if($data['success']=="1"){
                session_start();
                $_SESSION['username']=$data['username'];
                $_SESSION['role']=$data['role'];
                $_SESSION['login']= true;
                // respons to client
                echo $response;
            }else{
                echo $response;
            }
        }
        exit();
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        // Gửi phản hồi JSON về client
        echo json_encode(['success' => '1', 'message' => 'You have logged out successfully.']);
        exit();
    }

    public function changePassword(){
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
            echo json_encode(['success' => '0', 'message' => 'You need to be logged in to update your password.']);
            exit();
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $username= $_SESSION['username']? $_SESSION['username']:'null';
            if($username='null'){
                echo json_encode(['success' => '0', 'message' => 'You need to be logged in to update your password.']);
                exit();
            }

            $password_old = htmlspecialchars(trim($_POST['password_old']));
            $password_new = htmlspecialchars(trim($_POST['password_new']));
            $response =$this->AccountModel->updatePassword($username, $password_old, $password_new);

            echo $response;
            exit();
        }
    }

}
?>