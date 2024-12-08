<?php
require_once '../src/Controllers/MemberController.php';
require_once '../src/Controllers/CartController.php';
require_once '../src/Controllers/OrderController.php';

$memberController = new MemberController();
$cartController = new CartController();
$orderController = new OrderController();
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
else if($_SERVER['REQUEST_METHOD'] === 'GET'&&$_GET['action']==='getAllMember'){
    $memberController->getAllMember($_GET['page'], $_GET['perPage']);
}
else if($_SERVER['REQUEST_METHOD']==='GET'&&$_GET['action']==='getById'){
    $memberController->getMemberById($_GET['id']);
}
else if($_SERVER['REQUEST_METHOD']==='GET'&&$_GET['action']==='deleteById'){
    $memberController->deleteMemberById($_GET['id']);
}
else if($_SERVER['REQUEST_METHOD']==="POST"&&$_GET['action']==='addToCart'){
    $cartController->addToCart([
        "memberid" => $_POST['member_id'],
        "bookid" => $_POST['book_id'],
        "quantity" => $_POST['quantity']
    ]);
}
else if($_SERVER['REQUEST_METHOD']==='GET'&&$_GET['action']==='getAllBookInCart'){
    $cartController->getBookInCart($_GET['id'], $_GET['page'], $_GET['perPage']);
}
else if($_SERVER['REQUEST_METHOD'] ==="POST"&& $_GET["action"]=== "updateQuantity"){
    $cartController->updateQuantity([
        "quantity"=> $_POST['quantity']
    ],[
        "memberID" => $_POST['memberID'],
        'bookID'=> $_POST['bookID'],
    ]);
}
else if($_SERVER['REQUEST_METHOD'] ==="POST"&& $_GET["action"]=== "deleteBookInCart"){
    $cartController->deleteBookInCart($_POST['memberID'], $_POST['bookID'] ? explode(',',$_POST['bookID']): $_POST['bookID']);
}
else if($_SERVER['REQUEST_METHOD'] === "POST"&&$_GET["action"]==="createOrder"){
    $data = json_decode(file_get_contents('php://input'), true);
    // echo json_encode($data);    
    $orderController->createOrder([
        "memberID"=> $data['memberID'],
        "deliveryAddress"=> $data['deliveryAddress'],
        "bookList"=> $data['bookList']
    ]);

}
else if($_SERVER['REQUEST_METHOD']=== 'GET'&& $_GET['action'] === "getBookInOrder"){
    $orderController->getBookInOrder($_GET['orderID'], $_GET['page'], $_GET['perPage']);
}
else if($_SERVER['REQUEST_METHOD']=== 'GET'&& $_GET['action'] === "getAllOrder"){
    $orderController->getAllOrder($_GET["page"], $_GET["perPage"], $_GET["memberID"], $_GET["bookID"], $_GET["status"]);
}
else if($_SERVER['REQUEST_METHOD']=== 'GET'&& $_GET['action'] === "acceptOrder"){
    $orderController->acceptOrder($_GET["orderID"]);
}
else if($_SERVER['REQUEST_METHOD']=== 'GET'&& $_GET['action'] === "rejectOrder"){
    $orderController->rejectOrder($_GET["orderID"]);
}
else if($_SERVER['REQUEST_METHOD']=== 'GET'&& $_GET['action'] === "cancelOrder"){
    $orderController->cancelOrder($_GET["orderID"]);
}
?>