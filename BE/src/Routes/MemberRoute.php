<?php
require_once '../src/Controllers/MemberController.php';

$memberController = new MemberController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'register') {
    $memberController->register([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'DOB' => $_POST['DOB'],
        'phone' => $_POST['phone'],
    ]);
}
else if($_SERVER['REQUEST_METHOD']==='POST'&&$_GET['action'] === 'login'){
    $memberController->login([
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ]);
}
else if($_SERVER['REQUEST_METHOD']==='POST'&&$_GET['action']==='changePassword'){
    $memberController->changePassword($_POST['id'], $_POST['newPassword']);
}
else if($_SERVER['REQUEST_METHOD']==='GET'&& $_GET['action'] === 'infor'){
    $memberController->getInfo($_GET['id']);
}
else if($_SERVER['REQUEST_METHOD']==='POST'&&$_GET['action'] === 'updateInfo'){
    $memberController->updateInfo( [
        "firstname" => $_POST['firstname'],
    ], $_POST['id']);
}
?>