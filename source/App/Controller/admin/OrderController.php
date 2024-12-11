<?php
require_once(__DIR__ . '/../BaseController.php');

class OrderController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'OrderModel'
        parent::__construct('Order');
    }

    // Edit an existing Order
    public function updateOrder($id, $state)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if ($state == 0) {
                // Gọi phương thức update trong model
                parent::__callModel('reject', [$id]);
            } else if ($state == 1) {
                // Gọi phương thức update trong model
                parent::__callModel('accept', [$id]);
            }
        }
    }

    // Get all Orders
    public function getAllOrder($page = 1, $perPage = 5, $memberId = null, $bookID = null, $state = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getAll trong model
            if (isset($page, $perPage))
                parent::__callModel('getAll', [$page, $perPage, $memberId, $bookID, $state]);
        }
    }
}

?>
