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
            case 'getUserAccounts':
                require_once('Model/AdminModel.php');
                $adminModel = new AdminModel();
                $data = $adminModel->getUserAccounts();
                echo json_encode(['data' => $data, 'message' => 'Success']);
                break;
            case 'getAdminAccounts':
                require_once('Model/AdminModel.php');
                $adminModel = new AdminModel();
                $data = $adminModel->getAdminAccounts();
                echo json_encode(['data' => $data, 'message' => 'Success']);
                break;
            case 'editAccount':
                if (!isset($_POST['type']) || !isset($_POST['id']) || !isset($_POST['data'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Type, id and data are required']);
                    return;
                }
                require_once('Model/AdminModel.php');
                $adminModel = new AdminModel();
                $type = $_POST['type'];
                $id = $_POST['id'];
                $data = $_POST['data'];
                $result = $adminModel->editAccount($type, $id, $data);
                if ($result) {
                    echo json_encode(['message' => 'Success']);
                } else {
                    http_response_code(406);
                    echo json_encode(['message' => 'Failed']);
                }
                break;
            case 'deleteAccount':
                if (!isset($_POST['type']) || !isset($_POST['id'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Type and id are required']);
                    return;
                }
                require_once('Model/AdminModel.php');
                $adminModel = new AdminModel();
                $type = $_POST['type'];
                $id = $_POST['id'];
                $result = $adminModel->deleteAccount($type, $id);
                if ($result) {
                    echo json_encode(['message' => 'Success']);
                } else {
                    http_response_code(406);
                    echo json_encode(['message' => 'Failed']);
                }
                break;
            case 'addAccount':
                if (!isset($_POST['type']) || !isset($_POST['data'])) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Type and data are required']);
                    return;
                }
                require_once('Model/AdminModel.php');
                $adminModel = new AdminModel();
                $type = $_POST['type'];
                $data = $_POST['data'];
                $result = $adminModel->addAccount($type, $data);
                if ($result) {
                    echo json_encode(['message' => 'Success']);
                } else {
                    http_response_code(406);
                    echo json_encode(['message' => 'Failed']);
                }
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
