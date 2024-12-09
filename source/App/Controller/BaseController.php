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
    protected function loadModel($model)
    {
        require_once(__DIR__ . '../../Model/' . $model . '.php'); // Yêu cầu file model tương ứng
    }

    // example : __callModel('getAll', [])
    // ex model called: getAllBook, getByIDBook, addBook, updateBook, deleteBook
    public function __callModel($method, $params = [])
    {
        // $this->respondJson(['error' => 'Method not found']);
        $callMethod = strtolower($method) . $this->model; // Example: 'get' -> 'getCustomer'
        $callModel = $this->model_instance;
        
        if (method_exists($callModel, $callMethod)) {
            $response = call_user_func_array([$callModel, $callMethod], $params);
            header('Content-Type: application/json');
            if ($method === 'add' || $method === 'update' || $method === 'delete') {
                if ($response[0] == true) {
                    echo json_encode(value: ['success' => 'Record ' . $callMethod . ' successfully']);
                } else {
                    echo json_encode(['error' => $response[1]]);
                }
            } else if ($method === 'getAll' || $method === 'getById') {
                if ($response[0] == true) {
                    echo json_encode($response[2]);
                } else {
                    echo json_encode(['error' => $response[1]]);
                }
            }
        }
        else {
            echo json_encode(['error' => 'Method not found']);
        }
    }
    protected function generateResponse($status, $message, $data = [], $meta = null)
    {
        header('Content-Type: application/json');
        $response = [
            "status" => $status,
            "message" => $message,
            "data" => $data
        ];
        if ($meta) {
            $response['meta'] = $meta;
        }
        return json_encode($response);
    }
}
