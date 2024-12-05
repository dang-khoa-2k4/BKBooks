<?php
require_once '../src/config.php';
require_once '../src/Models/UserModel.php';

class MemberModel extends UserModel{
    private $MemberTable;
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
     * @return [$result, $msg]
     * $data = [$username, $password, $firstname, $lastname, $DOB, $phone, $email]
     */
    public function register($data){
    try{
        $stmt = self::$pdo->prepare("SELECT * FROM $this->table WHERE username = :username");
        $stmt->execute(['username' => $data['username']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $msg = "Username already exists";
            return [false, $msg];
        }


        //check email exist
        $stmt = self::$pdo->prepare("SELECT * FROM $this->MemberTable WHERE email = :email");
        $stmt->execute(['email' => $data['email']]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($member) {
            $msg = "Email already exists";
            return [false, $msg];
        }

        $stmt = self::$pdo->prepare("INSERT INTO $this->table (username, password, role) VALUES (:username, :password, :role)");
        $result = $stmt->execute([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'member'
        ]);

        if(!$result){
            $msg = 'Register failed';
            return [false, $msg];
        }

        $lastId = self::$pdo->lastInsertId();

        $stmt = self::$pdo->prepare("INSERT INTO $this->MemberTable (id,firstname, lastname, DOB, phone, email, status) VALUES (:id,:firstname, :lastname, :DOB, :phone, :email, :status)");
        $result = $stmt->execute([
            'id' => $lastId,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'DOB' => $data['DOB'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'status' => 'active'
        ]);

        if(!$result){
            $msg = 'Register failed';
            return [false, $msg];
        }

        $msg = 'Register successfully';
        return [true, $msg];

    }catch(PDOException $e){
        $msg = "Register failed";
        return [false, $msg];
    }
    }

    public function getInfor($id){
    try{
        $stmt = self::$pdo->prepare('SELECT firstname, lastname, DOB, phone, email FROM member WHERE id = :id');
        $result = $stmt->execute(['id'=> $id]);

        if(!$result){
            $msg = 'Get infor failed';
            return [false, $msg, []];
        }
        else{
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$data){
                $msg = 'Member isn\'t exist';
                return [false, $msg, []];
            }
            $msg = 'Get infor successfully';
            return [true, $msg,$data];
        }
    }catch(PDOException $e){
        $msg = 'Get infor failed';
        return [false, $msg, []];
    }
    }
}