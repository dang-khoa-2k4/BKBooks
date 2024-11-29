<?php

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        if (!isset($_GET['action']))
        {
            http_response_code(400);
            echo json_encode(['message' => 'Action is required']);
            return;
        }
        break;
    case 'POST':
        if (!isset($_POST['action']))
        {
            http_response_code(400);
            echo json_encode(['message' => 'Action is required']);
            return;
        }
        switch($_POST['action'])
        {
            case 'load':
                require_once('Model/UserModel.php');
                $model = new UserModel();
                $cartItems = $model -> loadCartItems();
                $address = $model -> getUserAddress();
                // $cartItems = $model -> loadCartItems(1);
                echo json_encode(['cartItems' => $cartItems, 'address' => $address ,'message' => 'Loaded successfully']);
                break; 
            case 'update':
                if (!isset($_POST['productID']) || !isset($_POST['amount']) || !isset($_POST['cartId']))
                {
                    http_response_code(400);
                    echo json_encode(['message' => 'ProductID, amount and cartId are required']);
                    return;
                }
                require_once('Model/UserModel.php');
                $model = new UserModel();
                $cartItems = $model -> updateCartItems($_POST['productID'], $_POST['amount']);
                // $cartItems = $model -> updateCartItems(1, $_POST['productID'], $_POST['amount'], $_POST['cartId']);
                echo json_encode(['cartItems' => $cartItems, 'message' => 'Updated successfully']);
                break;
            case 'clear':
                require_once('Model/UserModel.php');
                $model = new UserModel();
                $cartItems = $model -> clearCart();
                // $cartItems = $model -> clearCart(1);
                echo json_encode(['cartItems' => $cartItems, 'message' => 'Cleared successfully']);
                break;
            case 'checkout':
                if (!isset($_POST['cartID']))
                {
                    http_response_code(400);
                    echo json_encode(['message' => 'CartID is required']);
                    return;
                }
                require_once('Model/UserModel.php');
                $model = new UserModel();
                $success = $model -> checkout();
                // $success = $model -> checkout(1);
                echo json_encode(['success' => $success, 'message' => 'Checkout successful']);
                break;
            case 'addToCart':
                if (!isset($_POST['productID']) || !isset($_POST['amount']))
                {
                    http_response_code(400);
                    echo json_encode(['message' => 'ProductID and amount are required']);
                    return;
                }
                require_once('Model/UserModel.php');
                $model = new UserModel();
                $cartItems = $model -> addToCartByUser($_POST['productID'], $_POST['amount']);
                // $cartItems = $model -> addToCart(1, $_POST['productID'], $_POST['amount']);
                echo json_encode(['cartItems' => $cartItems, 'message' => 'Added successfully']);
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