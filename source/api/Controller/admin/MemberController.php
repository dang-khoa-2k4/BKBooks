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
            // print_r($data);

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
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();
    
                // Danh sách các trường cần kiểm tra
                $fields = array(
                    'firstname',
                    'lastname',
                    'DOB',
                    'username',
                    'password',
                    'email',
                    'phone'
                );
    
                foreach ($fields as $field) {
                    if (isset($data[$field]) && $data[$field] !== '') {
                        $updateData[$field] = $data[$field];
                    }
                }

                if (!empty($updateData)) 
                    parent::__callModel('update', [$updateData, $id]);
            } else {
                echo json_encode(['error' => 'Missing data']);
        }
}


    // Get a single Member by ID
    public function getMember($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getById', [ $id ]);
        }
    }

    // Get all Members
    public function getAllMember($page, $perPage)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getAll', [$page, $perPage]);
        }
    }

    // Delete a Member by ID
    public function deleteMember($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parent::__callModel('delete', [ $id ]);
        }
    }

}

?>
