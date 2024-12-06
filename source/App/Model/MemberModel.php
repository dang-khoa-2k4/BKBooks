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

    /**
     * Summary of updateInfor
     * @param mixed $id: id of member
     * @param mixed $data: data to update
     * @return [$result, $msg]
     * $data = ["firstname"=> $firstname, "lastname"=> $lastname, "DOB"=> $DOB, "phone"=> $phone, "email"=> $email]
     * 
     *
     */
    public function updateInfor($data,$id){
        try{
            // Fields to be added.
            $fields = array_keys($data);
            // Fields values
            $values = array_values($data);

            $stmt = self::$pdo->prepare("
            UPDATE member SET ".  implode(', ', array_map(function($field){ return $field . ' = ? '; }, $fields)) ."
            WHERE id = ?");
            array_push($values, $id);
            $result = $stmt->execute($values);

            if(!$result){
                $msg = 'Update infor failed';
                return [false, $msg];
            }
            else{
                $msg = 'Update infor successfully';
                return [true, $msg];
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $msg = 'Update infor failed';
            return [false, $msg];
        }
    }

    /**
     * Summary of getAllMember
     * @param mixed $page: page number
     * @param mixed $perPage: number of member per page
     * @return [$result, $msg, $members]
     * $members = [$member1, $member2, ...]
     * $result = true if success, false if fail
     * $msg = message
     */
    public function getAllMember($page, $perPage){
        try{    
            $lim = $perPage;
            $offset = ($page - 1) * $perPage;

            $stmt = self::$pdo->prepare(
                "SELECT * FROM $this->MemberTable JOIN $this->table ON $this->MemberTable.id = $this->table.id LIMIT $lim OFFSET $offset");
            $result = $stmt->execute();
            
            $stmt1 = self::$pdo->prepare("SELECT COUNT(*) FROM $this->MemberTable");
            $stmt1->execute([]);
            $count = $stmt1->fetchColumn();

            if(!$result){
                $msg = 'Get all member failed';
                return [false, $msg,[]];
            }
            else{
                $msg = 'Get all member successfully';
                return [true, $msg,[$stmt->fetchAll(PDO::FETCH_ASSOC), $count]];
            }
        }
        catch(PDOException $e){
            // echo $e->getMessage();
            $msg = 'Get all member failed';
            return [false, $msg, []];
        }
    }


    /**
     * Summary of getMemberById
     * @param  $id
     * @return [$result, $msg, $member]
     */
    public function getMemberById($id){
        try{
            $stmt = self::$pdo->prepare("SELECT * FROM $this->MemberTable JOIN user ON $this->MemberTable.id = $this->table.id WHERE $this->MemberTable.id = :id");
            $resutl = $stmt->execute(["id"=> $id]);
            if($resutl){
                $msg = "Get member by id successfully";
                $member = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!$member){
                    $msg = "Member isn't exist";
                    return [false, $msg, []];
                }
                return [true, $msg, $member];
            }
            else{
                $msg = "Get member by id failed";
                return [false, $msg, []];
            }
        }catch(PDOException $e){
            // echo $e->getMessage();
            $msg = "Get member by id failed";
            return [false, $msg,[]];
        }
    }

    //You can delete admin too (need check)
    /**
     * Summary of deleteMember
     * @param  $id
     * @return array [bool, string]
     */
    public function deleteMember($id){
        try{
            $result = $this->deleteByID($id);
            if($result){
                $msg = "Delete member successfully";
                return [true, $msg,];
            }
            else{
                $msg = "Delete member failed";
                return [false, $msg,];
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $msg = "Delete member failed";
            return [false, $msg];
        }
    }
}