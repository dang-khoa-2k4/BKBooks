<?php
require_once '../src/config.php';
require_once '../src/Models/UserModel.php';

class MemberModel extends UserModel{
    private $MemberTable;
    private $MemberRows;
    public function __construct(){
        global $pdo;
        self::$pdo = $pdo;
        $this->table = 'user';
        $this->rows = ['id', 'username', 'password', 'role'];
        $this->MemberTable = 'member';
        $this->MemberRows = ['id', 'firstname', 'lastname', 'DOB', 'phone', 'email', 'status'];
    }

    /**
     * Register new account for member
     * @param $data
     * @return bool
     * $data = [$username, $password, $firstname, $lastname, $DOB, $phone, $email]
     */
    public function register($data){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM $this->table WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return false; // Trả về false nếu tài khoản đã tồn tại
        }


        //check email exist
        $stmt = $pdo->prepare("SELECT * FROM $this->MemberTable WHERE email = :email");
        $stmt->execute(['email' => $data['email']]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($member) {
            echo "Email already exists";
            return false; // Trả về false nếu email đã tồn tại
        }

        $stmt = $pdo->prepare("INSERT INTO $this->table (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'member'
        ]);



        $lastId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO $this->MemberTable (id,firstname, lastname, DOB, phone, email, status) VALUES (:id,:firstname, :lastname, :DOB, :phone, :email, :status)");
        $stmt->execute([
            'id' => $lastId,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'DOB' => $data['DOB'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status' => 'active'
        ]);

        return true; // Trả về true nếu đăng ký thành công
    }
}