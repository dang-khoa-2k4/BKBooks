<?php
require_once (__DIR__ . '/../config.php');
require_once 'BaseModel.php';


class UserModel extends BaseModel {
    public function __construct() {
        global $pdo;
        self::$pdo = $pdo;
        $this->table = 'user';
        $this->rows = ['id', 'username', 'password', 'role'];

    }

    /**
     * Login
     * @param mixed $data
     * @return [$result, $msg, $data] 
     *
     * $data = [$username, $password]
     */
    // Kiểm tra đăng nhập
    public function login($data) {
    try{
        $stmt = self::$pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($data['password'], $user['Password'])) {
            return [true, 'Login successfully', $user];
        }
        else{
            return [false,'Login failed',[]];
        }
    }catch(PDOException $e){
        $msg = "Login failed";
        return [false, $msg, []];
    }
    }

    /**
     * Change password
     * @param mixed $data [$id, $newPassword]
     * @return [$result, $msg, $data]
     * 
     */
    public function changePassword($data) {
    try{
        //check old password
        $stmt = self::$pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->execute(['id'=> $data['id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$user){
            $msg = 'User not found';
            return [false, $msg, []];
        }

        if(password_verify($data['newPassword'], $user['Password'])){
            $msg ='New password must be different from old password';
            return [false, $msg, []]; // Trả về false nếu mật khẩu mới trùng với mật khẩu cũ
        }

        $stmt = self::$pdo->prepare('UPDATE user SET password = :password WHERE id = :id');
        $result = $stmt->execute(['id'=> $data['id'], "password" => password_hash($data['newPassword'], PASSWORD_DEFAULT)]);   

        if($result){
            return [true,'Change password successfully', []];
        }
        else{
            return [false,'Change password failed',[]];
        }
    }catch(PDOException $e){
        $msg = 'Change password failed';
        return [false, $msg, []];
    }
}

    /**
     * Register
     * @param mixed $data
     * $data = [$username, $password]
     * @return 
     * 
     */
    public function register($data){
    try{
        $stmt = self::$pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $msg = 'Username already exists';
            return [false, $msg, []]; // Trả về false nếu tài khoản đã tồn tại
        }

        $stmt = self::$pdo->prepare("INSERT INTO user (username, password, role) VALUES (:username, :password, :role)");
        $result = $stmt->execute([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'admin'
        ]);

        if (!$result) {
            $msg = 'Register failed';
            return [false, $msg, []]; 
        }
        else{
            $msg = 'Register successfully';
            return [true, $msg, []];
        }
        
    }
    catch(PDOException $e){
        $msg = 'Register failed';
        return [false, $msg, []];
    }
}
}
?>
