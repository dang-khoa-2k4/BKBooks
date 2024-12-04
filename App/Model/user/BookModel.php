<?php 
require_once('../BaseModel.php');

Class BookModel extends BaseModel {
    
    // Lấy tất cả sách với phân trang và tìm kiếm
    public function getAll($limit = 10, $offset = 0, $orderBy = ['ID DESC'], $select = ['*']) {
        return $this->all('books', $select, $orderBy, $limit, $offset); // Sử dụng hàm all của BaseModel
    }

    // Lấy thông tin sách theo ID
    public function getById($id) {
        return $this->find('books', 'ID', $id); // Sử dụng hàm find của BaseModel
    }

    // Lấy các sách theo tác giả
    public function getByAuthor($author, $limit = 10, $offset = 0, $orderBy = ['ID DESC'], $select = ['*']) {
        return $this->all('books', $select, $orderBy, $limit, $offset, "author = '{$author}'");
    }

    // Lấy các sách theo thể loại
    public function getByGenre($genre, $limit = 10, $offset = 0, $orderBy = ['ID DESC'], $select = ['*']) {
        return $this->all('books', $select, $orderBy, $limit, $offset, "genre = '{$genre}'");
    }
    // use to getbook have desc orderID 
    public function getBooksByOrderId($orderID, $limit = 10, $offset = 0, $orderBy = ['bookID DESC'], $select = ['*']) {
        return $this->all('order_book', $select, $orderBy, $limit, $offset, "orderID = '{$orderID}'");
    }



    // use to add book into Order_book table
    public function addBookToOrder($orderID, $bookID) {
        $data = [
            'orderID' => $orderID,
            'bookID' => $bookID
        ];

        return $this->create('order_book', $data); // Sử dụng hàm create của BaseModel
    }
}
?>
