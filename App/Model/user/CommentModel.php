<?php 
require_once('../BaseModel.php');

class CommentModel extends BaseModel {

    // Thêm bình luận
    public function AddCommentModel($User_id, $BookID, $Content) {
        $data = [
            'user_id' => $User_id,
            'book_id' => $BookID,
            'content' => $Content,
            'created_at' => date('Y-m-d H:i:s')  // Ghi nhận thời gian tạo bình luận
        ];

        // Thêm vào bảng comments
        return $this->create('comments', $data); // Dùng phương thức create từ BaseModel
    }

    // Lấy bình luận theo bookID
    public function Get_Comment_Book_Model($BookID) {
        // Lấy tất cả bình luận của một sách từ bảng comments
        return $this->all('comments', ['*'], [], 100, 0, "book_id = '{$BookID}'");
    }

    // Xóa bình luận của người dùng theo book_id và nội dung
    public function Delete_Comment_by_User_Model($User_id, $Book_id, $Content) {
        // Delete a new function delete have $user_id, $Book_id, $Content

        //need to do
    }

}
?>
