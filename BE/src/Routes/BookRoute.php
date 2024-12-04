<?php
require_once '../src/Controllers/BookController.php';
require_once '../src/middleware/AuthMiddleware.php';

$bookController = new BookController();

// Kiểm tra người dùng đã đăng nhập chưa
// AuthMiddleware::checkLogin();

// Route cho khách hàng (xem sách)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'getAllBooks') {
    if(!isset($_GET['page']) || !isset($_GET['perPage'])) {
        $bookController->getBooks(1, 10);
    } else {
        $bookController->getBooks($_GET['page'], $_GET['perPage']);
    }
}

//Route xem sách theo id
if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'getBookById') {
    $bookController->getBookById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'getBookByGenre') {
    if(!isset($_GET['page']) || !isset($_GET['perPage'])) {
        $bookController->getBookByGenre($_GET['genre'], 1, 10);
    } else {
        $bookController->getBookByGenre($_GET['genre'], $_GET['page'], $_GET['perPage']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'getBookByAuthor') {
    if(!isset($_GET['page']) || !isset($_GET['perPage'])) {
        $bookController->getBookByAuthor($_GET['author'], 1, 10);
    } else {
        $bookController->getBookByAuthor($_GET['author'], $_GET['page'], $_GET['perPage']);
    }
}


//Route thêm sách
if($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'addBook') {
    // AuthMiddleware::checkRole('admin');
    $bookController->addBook(array(
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'publisher' => $_POST['publisher'],
        'author' => $_POST['author'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
        'quantity' => $_POST['quantity'],
        'genre' => $_POST['genre'],
        'image' => $_POST['image']
    ));
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'updateBook') {
    // AuthMiddleware::checkRole('admin');
    // Khởi tạo mảng để lưu trữ các trường hợp có giá trị
    $updateData = array();

    // Danh sách các trường cần kiểm tra
    $fields = array(
        'name',
        'publisher',
        'author',
        'price',    
        'description',
        'quantity',
        'genre',
        'image'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])&& $_POST[$field] !== '') {
            $updateData[$field] = $_POST[$field];
        }
    }

    // Cập nhật sách chỉ với các trường có giá trị
    $bookController->updateBook($updateData, array(
        'id' => $_POST['id']
    ));

}

if($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'deleteBook') {
    // AuthMiddleware::checkRole('admin');
    $bookController->deleteBook($_GET['id']);
}

// Route yêu cầu người dùng phải có quyền admin để tạo sách
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'createBook') {
    AuthMiddleware::checkRole('admin');
    $bookController->createBook();
}
?>
