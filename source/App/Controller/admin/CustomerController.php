<?php

class CustomerController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'CustomerModel'
        parent::__construct('Customer');
    }

    // Add a new customer
    public function addCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'], $data['email'], $data['phone'])) {
                parent::__callModel('add', $data);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing customer
    public function updateCustomer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();
    
                // Danh sách các trường cần kiểm tra
                $fields = array(
                    'Name',
                    'UserName',
                    'Password',
                    'Email',
                    'Phone',
                );
    
                foreach ($fields as $field) {
                    if (isset($data[$field]) && $data[$field] !== '') {
                        $updateData[$field] = $data[$field];
                    }
                }

                if (!empty($updateData)) 
                    parent::__callModel('update', [$updateData, ['id' => $id]]);
            } else {
                echo json_encode(['error' => 'Missing data']);
        }
}


    // Get a single customer by ID
    public function getCustomer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getByID', $id);
        }
    }

    // Get all customers
    public function getAllCustomers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getAll', []);
        }
    }

    // Delete a customer by ID
    public function deleteCustomer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parent::__callModel('delete', $id);
        }
    }

}

?>
