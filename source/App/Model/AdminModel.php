<?php
require_once('Model/BaseModel.php');
class AdminModel extends BaseModel
{

    const TABLE = 'admin';

    // This is for testing purposes only, don't use this
    public function getAll($selct = ['*'], $orderBy = [], $limit = 10)
    {
        return $this->all(self::TABLE, $selct, $orderBy, $limit);
    }

    public function getById()
    {
        if (!isset($_SESSION['ID'])) {
            echo "Must be login";
            die();
        }
        return $this->find(self::TABLE, 'AdminID', $_SESSION['ID']);
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE name = '{$username}' AND password = '{$password}'";
        $result = $this->_query($sql);
        $row = $result->fetch_assoc();
        if ((bool)$row) {
            $_SESSION['ID'] = $row['AdminID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Role'] = 'admin';
            return True;
        } else {
            return False;
        }
    }
    public function logout()
    {
        session_unset();
        session_destroy();
    }
    public function register($username, $password, $name, $phoneNo, $avatar)
    {
        // TODO
        // TODO
        // Check if user already exists

        // Use create in BaseModel to create a new user
        // If create in BaseModel throw an error, you can freely modify it (not recommended)

        // If create successfully return True
        // Other case return false
        // TODO
        // TODO
    }

    public function getUserAccounts()
    {
        return $this->all('member');
    }

    public function getAdminAccounts()
    {
        return $this->all('admin');
    }

    public function editAccount($type, $id, $data)
    {
        if ($type == 'admin') {
            // Check if the account already exists
            $row = $this->find('admin', 'Name', $data['Name']);
            if ((bool)$row && $row['AdminID'] != $id) {
                return False;
            }
            // Check in the member table
            $row = $this->find('member', 'Username', $data['Name']);
            if ((bool)$row) {
                return False;
            }
            // Update the account
            return $this->update('admin', 'AdminID', $id, $data);
        } else if ($type == 'user') {
            // Check if the account already exists
            $row = $this->find('member', 'Username', $data['Username']);
            if ((bool)$row && $row['UserID'] != $id) {
                return False;
            }
            // Check in the admin table
            $row = $this->find('admin', 'Name', $data['Username']);
            if ((bool)$row) {
                return False;
            }
            // Update the account
            return $this->update('member', 'UserID', $id, $data);
        } else {
            return False;
        }
    }

    public function deleteAccount($type, $id)
    {
        if ($type == 'admin') {
            return $this->delete('admin', 'AdminID', $id);
        } else if ($type == 'user') {
            return $this->delete('member', 'UserID', $id);
        } else {
            return False;
        }
    }

    public function addAccount($type, $data)
    {
        $sql = "";
        if ($type == 'admin') {
            $row = $this->find('admin', 'Name', $data['Name']);
            if ((bool)$row) {
                return False;
            }
            $row = $this->find('member', 'Username', $data['Name']);
            if ((bool)$row) {
                return False;
            }
            return $this->create('admin', $data);
        } else if ($type == 'user') {
            // Check if the account already exists
            $row = $this->find('member', 'Username', $data['Username']);
            if ((bool)$row) {
                return False;
            }
            // Check in the admin table
            $row = $this->find('admin', 'Name', $data['Username']);
            if ((bool)$row) {
                return False;
            }
            // Insert the account
            return $this->create('member', $data);
        } else {
            return False;
        }
    }

    public function getUserInfo($id)
    {
        return $this->find('member', 'UserID', $id);
    }
}
