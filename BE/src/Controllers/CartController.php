<?php

class CartController{
    private $cartModel;
    public function __construct(){
        require_once '../src/Models/CartModel.php';
        $this->cartModel = new CartModel();
    }

    public function addToCart($data){
        [$result, $msg] = $this->cartModel->addToCart($data);
        if($result){
            header('Content-Type: application/json');
            $response = [
                "status" => "success",
                "message" => $msg
            ];
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            $response = [
                "status" => "fail",
                "message" => $msg
            ];
            echo json_encode($response);
        }
    }

    public function getBookInCart($memberID, $page, $perPage){
        [$result, $msg, [$books, $count]] = $this->cartModel->getAllBookInCart($memberID, $page, $perPage);
        header("Content-Type: application/json");
        if($result){
            $totalPage = ceil($count/$perPage); 
            $response = [
                "status" => "success",
                "message" => $msg,
                "data" => $books,
                "meta" => [
                    "page" => $page,
                    "perPage" => $perPage,
                    "totalPage" => $totalPage,
                    "totalRecord" => $count
                ]
            ];
            echo json_encode($response);
        }
        else{
            $response = [
                "status" => "fail",
                "message" => $msg,
                "data" => []
            ];
            echo json_encode($response);
        }
    }
};
