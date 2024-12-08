<?php
// Bắt đầu session
session_start();

// Bao gồm các file cần thiết
require_once '../src/config.php';      // Cấu hình cơ sở dữ liệu
require_once '../src/middleware/AuthMiddleware.php'; // Middleware kiểm tra quyền truy cập
// require_once '../src/routes/cartRoutes.php'; // Các route giỏ hàng
// require_once '../src/routes/orderRoutes.php'; // Các route đơn hàng

// Cấu hình lỗi (nếu có)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra phương thức HTTP và gọi controller tương ứng
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];


$parsedUrl = parse_url($requestUri);
$requestPath = $parsedUrl['path']; 


// Gọi route dựa trên phương thức và URI
switch ($requestMethod) {
    case 'GET':
        if (preg_match('/\/books$/', $requestPath)) {
            require_once '../src/Routes/BookRoute.php'; // Nếu URI là /books thì xử lý bằng bookRoutes
        } elseif(preg_match('/\/members$/', $requestPath)){
            require_once '../src/Routes/MemberRoute.php'; // Nếu URI là /members thì xử lý bằng memberRoutes
        } elseif (preg_match('/\/users$/', $requestPath)) {
            require_once '../src/Routes/UserRoute.php'; // Nếu URI là /users thì xử lý bằng userRoutes
        }
        elseif(preg_match('/\/comments$/', $requestPath)){
            require_once '../src/Routes/CommentRoute.php'; // Nếu URI là /users thì xử lý bằng userRoutes
        }
        else {
            echo json_encode(['message' => 'Route not found']);
        }
        break;
    case 'POST':
        if(preg_match('/\/members$/', $requestPath)){
            require_once '../src/Routes/MemberRoute.php'; // Nếu URI là /members thì xử lý bằng memberRoutes
        }elseif (preg_match('/\/books$/', $requestPath)) {
            require_once '../src/Routes/BookRoute.php'; // Nếu URI là /books thì xử lý bằng bookRoutes
        }
        elseif(preg_match('/\/users$/', $requestPath)){
            require_once '../src/Routes/UserRoute.php'; // Nếu URI là /users thì xử lý bằng userRoutes
        }
        elseif(preg_match('/\/comments$/', $requestPath)){
            require_once '../src/Routes/CommentRoute.php'; // Nếu URI là /users thì xử lý bằng userRoutes
        }
        else{
            echo json_encode(['message' => 'Route not found']);
        }
        break;
}
