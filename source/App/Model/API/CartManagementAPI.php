<?php
if ($_SESSION['Role'] != 'admin') {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    return;
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (!isset($_GET['action'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Action is required']);
            return;
        }
        break;
    case 'POST':
        if (!isset($_POST['action'])) {
            http_response_code(400);
            echo json_encode(['message' => 'Action is required']);
            return;
        }
        switch ($_POST['action']) {
            case 'getAllCarts':
                require_once('Model/CartModel.php');
                $cartModel = new CartModel();
                $data = $cartModel->getAll();
                echo json_encode(['data' => $data, 'message' => 'Success']);
                break;
            case 'getCartInfo':
                if (!isset($_POST['cartId'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Cart ID is required']);
                    return;
                }
                require_once('Model/CartModel.php');
                require_once('Model/AdminModel.php');
                require_once('Model/ProductModel.php');
                $cartModel = new CartModel();
                $adminModel = new AdminModel();
                $productModel = new ProductModel();
                $cartId = $_POST['cartId'];
                $data = ['CardID' => $cartId];

                // Find cart info
                $cartInfo = $cartModel->findById($cartId);
                if (!$cartInfo) {
                    http_response_code(404);
                    echo json_encode(['message' => 'Cart not found']);
                    return;
                }
                $data['ExportDate'] = $cartInfo['ExportDate'];
                $data['UserInfo'] = $adminModel->getUserInfo($cartInfo['UserID']);
                $products = $productModel->loadProductItemFromCart($cartId);
                $productInCart = [];
                foreach ($products as $product) {
                    $productInfo = [];
                    $productInfo['ProductInfo'] = $productModel->loadProductInfo($product['ProductID']);
                    $productInfo['Amount'] = $product['Amount'];
                    array_push($productInCart, $productInfo);
                }
                $data['Products'] = $productInCart;
                echo json_encode(['data' => $data, 'message' => 'Success']);
                break;
            case 'clearCart':
                if (!isset($_POST['cartId'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Cart ID is required']);
                    return;
                }
                require_once('Model/CartModel.php');
                $cartModel = new CartModel();
                $cartId = $_POST['cartId'];
                $cartModel->clearCart($cartId);
                echo json_encode(['message' => 'Success']);
                break;
            case 'deleteCart':
                if (!isset($_POST['cartId'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Cart ID is required']);
                    return;
                }
                require_once('Model/CartModel.php');
                $cartModel = new CartModel();
                $cartId = $_POST['cartId'];
                $cartModel->deleteCart($cartId);
                echo json_encode(['message' => 'Success']);
                break;
            default:
                http_response_code(400);
                echo json_encode(['message' => 'Invalid action']);
                break;
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not supported']);
        break;
}
