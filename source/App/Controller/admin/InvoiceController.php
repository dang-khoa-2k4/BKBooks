<?php

class InvoiceController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'InvoiceModel'
        parent::__construct('Invoice');
    }

    // Add a new invoice
    public function addInvoice()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['customer_id'], $data['book_id'], $data['quantity'], $data['total_price'], $data['status'])) {
                // Gọi phương thức add trong model
                parent::__callModel('add', $data);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing invoice
    public function updateInvoice($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();

            // Danh sách các trường cần kiểm tra
            $fields = array(
                'Id',
                'Total_Price',
                'Delivery_Address',
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

    // Get a single invoice by ID
    public function getInvoice($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getByID trong model
            parent::__callModel('getByID', $id);
        }
    }

    // Get all invoices
    public function getAllInvoices()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Gọi phương thức getAll trong model
            parent::__callModel('getAll', []);
        }
    }

    // Delete an invoice by ID
    public function deleteInvoice($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Gọi phương thức delete trong model
            parent::__callModel('delete', $id);
        }
    }
}

?>
