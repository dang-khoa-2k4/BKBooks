<?php

class OrderController{
    private $orderModel;
    public function __construct(){
        require_once '../src/Models/OrderModel.php';
        $this->orderModel = new OrderModel();
    }

    public function createOrder($data){
        [$result, $msg] = $order = $this->orderModel->addOrder($data);

        header('Content-Type: application/json');
        echo json_encode([
            "status" => $result ? "success" : "fail",
            "msg"=> $msg
        ]);
    }

    public function getBookInOrder($orderID, $page, $perPage){
        [$result, $msg, [$books,$count, $totalPrice]] = $this->orderModel->getBookInOrder($orderID, $page, $perPage);

        if($count){
            $totalPage = ceil($count / $perPage);
            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "totalPage" => $totalPage,
                "totalRecord" => $count
            ];
        }
        header('Content-Type: application/json');
        echo json_encode([
            "status" => $result ? "success" : "fail",
            "msg"=> $msg,
            "data" => $books,
            "totalPrice" => $totalPrice,
            "meta" => $meta,
        ]);
    }

    public function getAllOrder( $page, $perPage, $memberID, $bookID, $status){
        [$result, $msg, [$books,$count]] = $this->orderModel->getAllOrder($page, $perPage, $memberID, $bookID, $status);
        if($count){
            $totalPage = ceil($count / $perPage);
            $meta = [
                "page" => $page,
                "perPage" => $perPage,
                "totalPage" => $totalPage,
                "totalRecord" => $count
            ];
        }
        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ?"success":"fail",
            "msg"=> $msg,
            "data"=> $books,
            "meta"=> $meta
        ]);
    }

    public function acceptOrder( $order_id ){
        [$result, $msg] = $this->orderModel->acceptOrder($order_id);
        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ?"success":"fail",
            "msg"=> $msg,
        ]);
    }
    public function rejectOrder( $order_id ){
        [$result, $msg] = $this->orderModel->rejectOrder($order_id);
        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ?"success":"fail",
            "msg"=> $msg,
        ]);
    }
    public function cancelOrder( $order_id ){
            [$result, $msg] = $this->orderModel->cancelOrder($order_id);
            header("Content-Type: application/json");
            echo json_encode([
                "status"=> $result ?"success":"fail",
                "msg"=> $msg,
            ]);
        }
}