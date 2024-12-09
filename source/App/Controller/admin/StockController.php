<?php
require_once(__DIR__ . '/../BaseController.php');

class StockController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'StockModel'
        parent::__construct('Book');
    }

    // Add a new stock entry
    public function addStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['Id'], $data['Quantity'])) {
                // Gọi phương thức add trong model
                parent::__callModel('add', [$data]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing stock entry
    public function updateStock($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();

            // Danh sách các trường cần kiểm tra
            $fields = array(
                'Quantity'
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

    // Get a single stock entry by ID
    public function getStock($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getByID trong model
            parent::__callModel('getByID', [ 'id' => $id ]);
        }
    }

    // Get all stock entries
    public function getAllStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getAll trong model
            parent::__callModel('getAll', []);
        }
    }

    // Delete a stock entry by ID
    public function deleteStock($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Gọi phương thức delete trong model
            parent::__callModel('delete', [ 'id' => $id ]);
        }
    }
}

?>