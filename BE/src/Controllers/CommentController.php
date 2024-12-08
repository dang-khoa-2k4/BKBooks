<?php

class CommentController{
    private $commentModel;
    public function __construct(){
        require_once '../src/Models/CommentModel.php';
        $this->commentModel = new CommentModel();
    }

    public function addComment($data){
        [$result, $msg] = $this->commentModel->addComment($data);
        header('Content-Type: application/json');
        echo json_encode([
            "status" => $result ? "success" : "fail",
            "msg"=> $msg
        ]);
    }

    public function deleteComment($bookid, $memberid, $time){
        [$result, $msg] = $this->commentModel->deleteComment($bookid, $memberid, $time);
        header('Content-Type: application/json');
        echo json_encode([
            "status" => $result ? "success" : "fail",
            "msg"=> $msg
        ]);
    }

    public function getComment($page,$perPage,$bookid, $memberid, $time){
        [$result, $msg, [$comment, $count]] = $this->commentModel->getAllComment($page, $perPage, $bookid, $memberid, $time);
        $meta = [
            "page" => $page,
            "perPage"=> $perPage,
            "totalPage" => ceil($count/$perPage),
            "totalRecord" => $count
        ];
        header("Content-Type: application/json");
        echo json_encode([
            "status"=> $result ?"success":"fail",
            "data"=> $comment,
            "meta"=> $meta
        ]);
    }

    public function updateComment($data){
        [$result, $msg] = $this->commentModel->updateComment($data);
        header('Content-Type: application/json');
        echo json_encode([
            "status" => $result ? "success" : "fail",
            "msg"=> $msg
        ]);
    }
}