<?php
require_once(__DIR__ . '/../BaseController.php');

class MemberController extends BaseController
{
    public function __construct()
    {
        // Gọi constructor của BaseController và load model 'MemberModel'
        parent::__construct('Member');
    }

    // Add a new Member
    public function addMember()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['username'], $data['phone'], $data['password'])) {
                parent::__callModel('register', [$data]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // Edit an existing Member
    public function updateMember($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') 
        {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateDataInfo = array();
            $updateDataLogin = array();

            // Danh sách các trường cần kiểm tra
            $infoFields = array(
                'firstname',
                'lastname',
                'DOB',
                'email',
                'phone'
            );

            $loginFields = array(
                'username',
                'password'
            );
            
            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            foreach ($infoFields as $field) {
                if (isset($data[$field]) && $data[$field] !== '') {
                    $updateDataInfo[$field] = $data[$field];
                }
            }

            foreach ($loginFields as $field) {
                if (isset($data[$field]) && $data[$field] !== '') {
                    $updateDataLogin[$field] = $data[$field];
                }
            }

            if (!empty($updateDataInfo)) {
                parent::__callModel('update', [$updateDataInfo, $id]);
            }
            // if (!empty($updateDataLogin)) {
            //     parent::__callModel('updateLoginInfo', [$updateDataLogin, $id]);
            // }
            if (empty($updateDataInfo) && empty($updateDataLogin)) {
                echo json_encode(['error' => 'Missing data']);
            }
        }
        
    }


    // Get a single Member by ID
    public function getMember($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getById', [$id]);
        }
    }

    // Get all Members
    public function getAllMember($page = 1, $perPage = 5)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getAll', [$page, $perPage]);
        }
    }

    // Delete a Member by ID
    public function deleteMember($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parent::__callModel('delete', [$id]);
        }
    }
}
