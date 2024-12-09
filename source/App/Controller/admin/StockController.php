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
    public function addStock($id, $quantity)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if (isset($id, $quantity)) {
                parent::__callModel('addStock', [ $quantity, $id ]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Get all stock entries
    public function getAllStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getAll trong model
            parent::__callModel('getAllStock', []);
        }
    }

    // // Delete a stock entry by ID
    // public function deleteStock($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    //         // Gọi phương thức delete trong model
    //         parent::__callModel('delete', [ 'id' => $id ]);
    //     }
    // }
}

?>