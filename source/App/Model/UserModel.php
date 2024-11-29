<?php
require_once('Model/BaseModel.php');
require_once('Model/CartModel.php');
class UserModel extends BaseModel{

	const TABLE = 'member';
    private $cartModel;

    public function __construct(){
        parent::__construct();
        $this -> cartModel = new CartModel();
    }

    // This is for testing purposes only, don't use this
	public function getAll($selct = ['*'], $orderBy = [], $limit = 10){
        return $this -> all(self::TABLE, $selct, $orderBy, $limit);
    }

    public function getById(){
        if (!isset($_SESSION['ID'])){
            echo "Must be login";
            die();
        }
        return $this -> find(self::TABLE, 'UserID', $_SESSION['ID']);
    }

    public function login($username,$password){
        $sql = "SELECT * FROM " . self::TABLE . " WHERE username = '$username' AND password = '$password'";
        $result = $this -> _query($sql);
        $row = $result->fetch_assoc();
        

        if ((bool)$row){
            if ($row['AccessLevel'] == 0)
                return 2;
            $_SESSION['ID'] = $row['UserID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Role'] = 'member';
            return True;
        } 
        else 
        {
            return False;
        }   
    }
    public function logout(){
        session_unset();
        session_destroy();  
        
    }
    public function register($username,$password,$name,$phoneNo,$avatar){
        // TODO
        // TODO
        // Check if user already exists
        $sql = "SELECT * FROM " . self::TABLE . " WHERE username = '$username'";
        $result = $this -> _query($sql);
        if ($result->num_rows > 0){
            return False;
        }

        // Check if username is same with admin
        $sql = "SELECT * FROM admin WHERE name = '$username'";
        $result = $this -> _query($sql);
        if ($result->num_rows > 0){
            return False;
        }
        // If not, create a new user
        // Use create in BaseModel to create a new user
        // If create in BaseModel throw an error, you can freely modify it (not recommended)
        // $sql = "INSERT INTO " . self::TABLE . "(Username, Password, Name, Phoneno, Avatar, AccessLevel) VALUES ('$username', '$password', '$name', '$phoneNo', '$avatar', 1)";
        // $this -> _query($sql);
        $this -> create(self::TABLE, ['Username' => $username, 'Password' => $password, 'Name' => $name, 'Phoneno' => $phoneNo, 'Avatar' => $avatar, 'AccessLevel' => 1]);
        return True;
        // If create successfully return True
        // Other case return false
        // TODO
        // TODO
    }

    public function count(){
        $sql = "SELECT COUNT(UserID) AS NumberOfUser FROM " . self::TABLE;
        $result = $this -> _query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getRecentUser(){
        $sql = "SELECT * FROM " . self::TABLE . " ORDER BY UserID DESC LIMIT 5";
        $result = $this -> _query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data, $row);
        }
        return $data;
    }

    public function loadCartItems(){
        $cartID = $this -> cartModel -> getCartId($_SESSION['ID']);
        
        // If there is no cart, create a new cart
        if ($cartID == null){
            $cartID = $this -> cartModel -> create($this -> cartModel::TABLE, ['UserID' => $_SESSION['ID']]) -> fetch_assoc()['CartID'];
        }

        return $this -> cartModel -> loadCartItems($cartID);
    }

    public function addToCartByUser($productID, $amount){
        $cartID = $this -> cartModel -> getCartId($_SESSION['ID']);
        return $this -> cartModel -> updateCartItems($productID, $amount, $cartID);
    }

    public function updateCartItems($productID, $amount){
        $cartID = $this -> cartModel -> getCartId($_SESSION['ID']);
        return $this -> cartModel -> updateCartItems($productID, $amount, $cartID);
    }

    public function clearCart(){
        $cartID = $this -> cartModel -> getCartId($_SESSION['ID']);
        return $this -> cartModel -> clearCart($cartID);
    }

    public function checkout(){
        $cartID = $this -> cartModel -> getCartId($_SESSION['ID']);
        return $this -> cartModel -> checkout($cartID);
    }

    public function editUser($userID, $Name, $LastName, $Email, $Phoneno, $Gender, $Address, $Avatar, $AccessLevel){
        $inputData = ["Name" => $Name, "LastName" => $LastName, "Email" => $Email, "Phoneno" => $Phoneno, "Gender" => $Gender, "Address" => $Address, "Avatar" => $Avatar, "AccessLevel" => $AccessLevel];
        $this -> update(self::TABLE,"UserID" ,$userID,$inputData);
        return True;
    }

    public function getUserAddress(){
        $result = $this -> find(self::TABLE, 'UserID', $_SESSION['ID']);
        return $result['Address'];
    }
}