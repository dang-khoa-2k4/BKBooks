<?php 
require_once('../BaseModel.php');


Class BookModel extends BaseModel{
     // Lấy tất cả sách với phân trang và tìm kiếm
     public function getAll($limit = 10, $offset = 0, $orderBy = ['ID DESC'], $select = ['*']) {
        return $this->all('books', $select, $orderBy, $limit, $offset); // Sử dụng hàm all của BaseModel
    }

    // Lấy thông tin sách theo ID
    public function getById($id) {
        return $this->find('books', 'ID', $id); // Sử dụng hàm find của BaseModel
    }

    public function getByAuthor($author){
        
    }
}
?>