<?php

class BaseController
{
    protected $model_instance;  // Instance of the model
    protected $model;  // Model name

    // Constructor, khi kế thừa sẽ gọi constructor của lớp con và load model
    public function __construct($modelName)
    {
        $this->model = $modelName;
        $modelName = $modelName . 'Model';
        $this->loadModel($modelName);  // Tải model
        $this->model_instance = new $modelName();  // Tạo instance của model
    }

    // Phương thức load model
    private function loadModel($model)
    {
        require_once 'Model/' . $model . '.php'; // Yêu cầu file model tương ứng
    }

    // example : __callModel('getAll', [])
    // ex model called: getAllBook, getByIDBook, addBook, updateBook, deleteBook
    public function __callModel ($method, $params)
    {
        // $this->respondJson(['error' => 'Method not found']);
        $callMethod = strtolower($method) . $this->model; // Example: 'get' -> 'getCustomer'
        $callModel = $this->model_instance;
        $response = call_user_func_array([$callModel, $callMethod], $params);
        if ($method === 'add' || $method === 'update' || $method === 'delete') {
            if ($response) {
                echo json_encode(value: ['success' => 'Record' . $callMethod . 'successfully']);
            } else {
                echo json_encode(['error' => 'Cannot' . $callMethod . 'record']);
            }
        } else if ($method === 'getAll' || $method === 'getByID') {
            if ($response) {
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Record not found']);
            }
        }  
    }
}

?>
