<?php

class CustomerController
{
    private $customerModel;

    public function __construct()
    {
        $this->loadModel('CustomerModel');  // Load the CustomerModel
        $this->customerModel = new CustomerModel();  // Initialize the model
    }

    // Add a new customer
    public function addCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'], $data['email'], $data['phone'], $data['address'])) {
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $address = $data['address'];

                $newCustomer = $this->customerModel->addCustomer($name, $email, $phone, $address);

                echo json_encode($newCustomer);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing customer
    public function editCustomer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'], $data['email'], $data['phone'], $data['address'])) {
                $name = $data['name'];
                $email = $data['email'];
                $phone = $data['phone'];
                $address = $data['address'];

                $updatedCustomer = $this->customerModel->editCustomer($id, $name, $email, $phone, $address);

                echo json_encode($updatedCustomer);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Get a single customer by ID
    public function getCustomer($id)
    {
        $customer = $this->customerModel->getCustomerById($id);
        if ($customer) {
            echo json_encode($customer);
        } else {
            echo json_encode(['error' => 'Customer not found']);
        }
    }

    // Delete a customer by ID
    public function deleteCustomer($id)
    {
        $deleted = $this->customerModel->deleteCustomer($id);
        if ($deleted) {
            echo json_encode(['message' => 'Customer deleted successfully']);
        } else {
            echo json_encode(['error' => 'Failed to delete customer']);
        }
    }

    // Ban a customer
    public function banCustomer($id)
    {
        $bannedCustomer = $this->customerModel->banCustomer($id);
        if ($bannedCustomer) {
            echo json_encode(['message' => 'Customer banned successfully', 'customer' => $bannedCustomer]);
        } else {
            echo json_encode(['error' => 'Failed to ban customer']);
        }
    }

    private function loadModel($model)
    {
        require_once 'Model/' . $model . '.php';
    }
}

?>
