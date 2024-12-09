<?php
require_once(__DIR__ . '/../BaseController.php');

class OrderController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'OrderModel'
        parent::__construct('Order');
    }

    // Add a new Order
    public function addOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['MemberId'], $data['DeliveryAddress'], $data['Status'])) {
                // Gọi phương thức add trong model
                parent::__callModel('add', [$data]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing Order
    public function updateOrder($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();

            // Danh sách các trường cần kiểm tra
            $fields = array(
                'MemberId',
                'DeliveryAddress',
                'Status'
            );

            foreach ($fields as $field) {
                if (isset($data[$field]) && $data[$field] !== '') {
                    $updateData[$field] = $data[$field];
                }
            }

            if (!empty($updateData)) {
                // Gọi phương thức update trong model
                parent::__callModel('update', [$updateData, ['id' => $id]]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Get a single Order by ID
    public function getOrder($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getByID trong model
            parent::__callModel('getByID', ['id' => $id]);
        }
    }

    // Get all Orders
    public function getAllOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getAll trong model
            parent::__callModel('getAll', []);
        }
    }
}

?>
