<?php
// Bắt đầu session
session_start();

// Bao gồm các file cần thiết
require_once '../src/config.php';      // Cấu hình cơ sở dữ liệu
require_once '../src/middleware/AuthMiddleware.php'; // Middleware kiểm tra quyền
require_once '../src/Routes/BookRoute.php'; // Các route sách
require_once '../src/Routes/UserRoute.php'; // Các route người dùng
// require_once '../src/routes/cartRoutes.php'; // Các route giỏ hàng
// require_once '../src/routes/orderRoutes.php'; // Các route đơn hàng

// Cấu hình lỗi (nếu có)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra phương thức HTTP và gọi controller tương ứng
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Gọi route dựa trên phương thức và URI
switch ($requestMethod) {
    case 'GET':
        if (preg_match('/^\/books/', $requestUri)) {
            require_once '../src/Routes/BookRoute.php'; // Nếu URI là /books thì xử lý bằng bookRoutes
        } elseif (preg_match('/^\/users/', $requestUri)) {
            require_once '../src/Routes/UserRoute.php'; // Nếu URI là /users thì xử lý bằng userRoutes
        } else {
            echo json_encode(['message' => 'Route not found']);
        }
        break;
    case 'POST':
        
//     case 'POST':
//         if (preg_match('/^\/books/', $requestUri)) {
//             require_once '../src/routes/bookRoutes.php'; // Nếu URI là /books thì xử lý bằng bookRoutes
//         } elseif (preg_match('/^\/users/', $requestUri)) {
//             require_once '../src/routes/userRoutes.php'; // Nếu URI là /users thì xử lý bằng userRoutes
//         } elseif (preg_match('/^\/cart/', $requestUri)) {
//             require_once '../src/routes/cartRoutes.php'; // Nếu URI là /cart thì xử lý bằng cartRoutes
//         } else {
//             echo json_encode(['message' => 'Route not found']);
//         }
//         break;

//     case 'PUT':
//     case 'DELETE':
//         // Các route cho PUT, DELETE có thể làm tương tự
//         if (preg_match('/^\/books/', $requestUri)) {
//             require_once '../src/routes/bookRoutes.php'; // Nếu URI là /books thì xử lý bằng bookRoutes
//         } elseif (preg_match('/^\/cart/', $requestUri)) {
//             require_once '../src/routes/cartRoutes.php'; // Nếu URI là /cart thì xử lý bằng cartRoutes
//         } else {
//             echo json_encode(['message' => 'Route not found']);
//         }
//         break;

//     default:
//         echo json_encode(['message' => 'Method not allowed']);
//         break;
}
