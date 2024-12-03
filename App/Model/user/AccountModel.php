<?php 
require_once('../BaseModel.php');

class AccountModel extends BaseModel{

    public function register($username, $password, $email){
        
        if($this->find('users','username', $username)){
            return json_encode(['success'=> '0', 'message'=>'Username exits']);
        }
        if ($this->find('users', 'email', $email)) {
            return json_encode(['success' => '0', 'message' => 'Email already exists.']);
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Dữ liệu người dùng mới
        $data = [
            'username' => $username,
            'password' => $hashedPassword,
            'email'    => $email,
            'role'     => 'user',
        
        ];
        if($this->create('user', $data)){
            return json_encode(['success' => '1', 'message' => 'Registration successful.']);
        } else {
            return json_encode(['success'=>'0', 'message' =>'Registration failed']);
        }
    }
        // Đăng nhập người dùng
    public function login($username, $password) {
        // Tìm người dùng theo username
        $user = $this->find('users', 'username', $username);

        if ($user && password_verify($password, $user['password'])) {
            // Trả về thông tin người dùng dưới dạng JSON
            return json_encode([
                'success' => '1',
                'ID'       => $user['ID'],
                'username' => $user['username'],
                'role' => $user['role'], // Giả sử role có trong bảng users
                'message' => 'Login successful.'
            ]);
        }

        return json_encode(['success' => '0', 'message' => 'Invalid username or password.']);
    }

    // Cập nhật mật khẩu người dùng
    public function updatePassword($username, $password_old, $password_new) {
        // Kiểm tra xem user có tồn tại không
        $user = $this->find('users', 'username', $username);

        if (!$user) {
            return json_encode(['success' => '0', 'message' => 'User not found.']);
        }

        // Kiểm tra mật khẩu cũ
        if (!password_verify($password_old, $user['password'])) {
            return json_encode(['success' => '0', 'message' => 'Old password is incorrect.']);
        }

        // Mã hóa mật khẩu mới
        $hashedNewPassword = password_hash($password_new, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới
        $data = ['password' => $hashedNewPassword];

        if ($this->update('users', 'username', $username, $data)) {
            return json_encode(['success' => '1', 'message' => 'Password updated successfully.']);
        } else {
            return json_encode(['success' => '0', 'message' => 'Password update failed.']);
        }
    }
}

?>