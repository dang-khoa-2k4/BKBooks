<?php

class BaseController
{
    protected $model_instance;  // Instance of the model
    protected $model;  // Model name
    protected $no_response_method = ['add', 'update', 'delete', 'register', 'reject', 'accept', 'addStock', 'updateLoginInfo'];
    protected $response_method = ['getAll', 'getById', 'getAllStock', 'getStatistic'];

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
        $callMethod = strtolower($method) . $this->model; // Example: 'get' -> 'getCustomer'
        $callModel = $this->model_instance;
        
        if (method_exists($callModel, $callMethod)) {
            $response = call_user_func_array([$callModel, $callMethod], $params);
            header('Content-Type: application/json');
            if (in_array($method, $this->no_response_method)) {
                if ($response[0] == true) {
                    echo json_encode(value: ['success' => 'Record ' . $callMethod . ' successfully']);
                } else {
                    echo json_encode(['error' => $response[1]]);
                }
            } else if (in_array($method, $this->response_method)) {
                if ($response[0] == true) {
                    if ($method != 'getById' && $method != 'getStatistic') 
                    {
                        $totalPage = ceil($response[2][1] / $params[1]);
                        $meta = [
                            "page" => $params[0],
                            "perpage" => $params[1],
                            "totalPage" => $totalPage,
                            "TotalRecord" => $response[2][1]
                        ];
                        echo json_encode(['data' => $response[2][0], 'meta' => $meta]);
                    } 
                    else 
                    {
                        echo json_encode(['data' => $response[2]]);
                    }
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
        echo json_encode($response);
    }
}
