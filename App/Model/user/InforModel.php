<?php
require_once("../BaseModel.php") ;// Bao gồm lớp kết nối cơ sở dữ liệu

class InforModel extends BaseModel {

    // Thêm thông tin người dùng
    public function addInfor($userID, $LastName, $FirstName, $Address, $Email, $DOB) {
        // Tạo mảng dữ liệu cần thêm vào cơ sở dữ liệu
        $data = [
            'LastName' => $LastName,
            'FirstName' => $FirstName,
            'Address' => $Address,
            'Email' => $Email,
            'DOB' => $DOB,
            'UserID' => $userID // Truyền ID vào mảng dữ liệu
        ];

        // Gọi hàm create để thêm thông tin vào cơ sở dữ liệu
        return $this->create('user_information', $data); // 'user_information' là bảng lưu thông tin người dùng
    }

    // Cập nhật thông tin người dùng
    public function updateInfor($userID, $LastName, $FirstName, $Address, $Email, $DOB) {
        // Tạo mảng dữ liệu cần cập nhật vào cơ sở dữ liệu
        $data = [
            'LastName' => $LastName,
            'FirstName' => $FirstName,
            'Address' => $Address,
            'Email' => $Email,
            'DOB' => $DOB
        ];

        // Gọi hàm update để cập nhật thông tin
        return $this->update('user_information', 'UserID', $userID, $data); // 'user_information' là bảng lưu thông tin người dùng
    }

    // Lấy thông tin người dùng theo ID (UserID)
    public function getInfor($userID) {
        return $this->find('user_information', 'UserID', $userID); // Lấy thông tin người dùng theo UserID
    }

    // Xóa thông tin người dùng theo ID (UserID)
    public function deleteInfor($userID) {
        return $this->delete('user_information', 'UserID', $userID); // Xóa thông tin người dùng theo UserID
    }
}
?>
