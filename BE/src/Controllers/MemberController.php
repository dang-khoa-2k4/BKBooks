<?php


class MemberController{
    private $memberModel;
    public function __construct(){
        require_once '../src/Models/MemberModel.php';
        $this->memberModel = new MemberModel();
    }


    public function register($data){
        $result = $this->memberModel->register($data);
        if($result){
            header('Content-Type: application/json');
            $response = [
                "status" => "success",
                "message" => "Register successfully",
                "data" => $result
            ];
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            $response = [
                "status" => "fail",
                "message" => "Register fail",
                "data" => $result
            ];
            echo json_encode($response);
        }
    }

    public function login($data){
        $result = $this->memberModel->login($data);
        if($result){
            header('Content-Type: application/json');
            $response = [
                "status" => "success",
                "message" => "Login successfully",
                "data" => $result
            ];
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            $response = [
                "status" => "fail",
                "message" => "Login fail",
                "data" => $result
            ];
            echo json_encode($response);
        }
    }

    public function changePassword($id, $newPassword){
        if ($id && $newPassword) {
            $result = $this->memberModel->changePassword(["id"=>$id,"newPassword"=> $newPassword]);
            if ($result) {
                echo json_encode(["message"=> "Change password successful"]);
            } else {
                echo json_encode(["message"=> "Change password failed"]);
            }
        }
        else echo json_encode(["message"=> "Please provide id and new password"]);
    }

    public function getInfo($id){
        $result = $this->memberModel->getInfor($id);
        if($result){
            header("Content-Type: application/json");
            $response = [
                "status"=> "success",
                "message"=> "Get information successfully",
                "data"=> $result
                ];
            echo json_encode($response);
        } else {
            header("Content-Type: application/json");
            $response = [
                "status"=> "fail",
                "message"=> "Get information fail",
                "data"=> $result
                ];
            echo json_encode($response);
        }
    }

    public function updateInfo($data, $id){

        [$result, $msg] = $this->memberModel->updateInfor($data, $id);
        header("Content-Type: application/json");
        if ($result) {
            echo json_encode(["message"=> $msg]);
        }
        else {
            echo json_encode(["message"=> $msg]);
        }

    }

    public function getAllMember($page, $perPage){
        [$result, $msg, [$members, $count]] = $this->memberModel->getAllMember($page, $perPage);

        $totalPage = ceil($count / $perPage);
        $meta = [
            "page" => $page,
            "perPage" => $perPage,
            "totalPage" => $totalPage,
            "totalRecord" => $count
        ];

        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ? "success" : "fail",
            "message"=> $msg,
            "data"=> $members,
            "meta"=> $meta,
        ]);
    }

    public function getMemberById($id){
        [$result, $msg, $members] = $this->memberModel->getMemberById($id);
        
        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ? "success" : "fail",
            "message"=> $msg,
            "data"=> $members,
        ]);
    }

    public function deleteMemberById($id){
        [$result, $msg] = $this->memberModel->deleteMember($id);

        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ? "success":"fail",
            "message"=> $msg,
        ]);
    }
}