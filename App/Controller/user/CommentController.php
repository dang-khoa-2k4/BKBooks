<?php
require_once('../BaseController.php');

class CommentController extends BaseController {

    private $CommentModel;

    public function __construct() {
        $this->loadModel('CommentModel');
        $this->CommentModel = new CommentModel();
    }

    // Thêm bình luận
    public function AddCommentController($User_id, $BookID, $Content) {
        // Kiểm tra thông tin
        if(empty($User_id) || empty($BookID) || empty($Content)) {
            echo json_encode(['error' => 'All fields are required.']);
            return;
        }
        $User_id= htmlspecialchars($User_id);
        $BookID= htmlspecialchars($BookID);
        $Content= htmlspecialchars($Content);

        // Thêm bình luận
        $result = $this->CommentModel->AddCommentModel($User_id, $BookID, $Content);

        // Kiểm tra kết quả và trả về phản hồi
        if ($result) {
            return json_encode(['success' => 'Comment added successfully.']);
        } else {
            return json_encode(['error' => 'Failed to add comment.']);
        }
    }

    // Lấy tất cả bình luận của một sách
    public function Get_Comment_Book_Controller($BookID) {
        if (empty($BookID)) {
            echo json_encode(['error' => 'Book ID is required.']);
            return;
        }

        // Lấy bình luận
        $comments = $this->CommentModel->Get_Comment_Book_Model($BookID);

        // Trả về bình luận dưới dạng JSON
        return json_encode(['comments' => $comments]);
    }

    // Xóa bình luận của người dùng
    public function Delete_Comment_by_User_Controller($User_id, $Book_id, $Content) {
        // Kiểm tra thông tin
        if (empty($User_id) || empty($Book_id) || empty($Content)) {
            echo json_encode(['error' => 'User ID, Book ID and Content are required.']);
            return;
        }
        $User_id= htmlspecialchars($User_id);
        $BookID= htmlspecialchars($Book_id);
        $Content= htmlspecialchars($Content);
        
        // Xóa bình luận
        $result = $this->CommentModel->Delete_Comment_by_User_Model($User_id, $Book_id, $Content);
        // need to do again

        // Kiểm tra kết quả và trả về phản hồi
        if ($result) {
            return json_encode(['success' => 'Comment deleted successfully.']);
        } else {
            return json_encode(['error' => 'Failed to delete comment.']);
        }
    }
}
?>
