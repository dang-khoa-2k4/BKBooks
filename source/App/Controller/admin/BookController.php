
<?php
require_once(__DIR__ . '/../BaseController.php');

class BookController extends BaseController
{
    public function __construct()
    {
        parent::__construct('Book');
    }

    // API: Get all books
    public function getAllBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getAll', []);
        }
    }

    // API: Get a single book by its ID
    public function getBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::__callModel('getById', ['id' => $id]);
        }
    }

    // API: Add a new book
    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $data['quantity'] = 0;
            if (isset($data['name'], $data['author'], $data['price'])) {
                parent::__callModel('add', [$data]);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // API: Edit an existing book
    public function updateBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $updateData = array();

            // Danh sách các trường cần kiểm tra
            $fields = array(
                'Name',
                'Publisher',
                'Author',
                'Price',
                'Description',
                'Genre',
                'Image',
                'Quantity',
            );

            foreach ($fields as $field) {
                if (isset($data[$field]) && $data[$field] !== '') {
                    $updateData[$field] = $data[$field];
                }
            }

            if (!empty($updateData))
                parent::__callModel('update', [$updateData, ['id' => $id]]);

        } else {
            echo json_encode(['error' => 'Missing data']);
        }
    }

    // API: Delete a book by its ID
    public function deleteBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parent::__callModel('delete', ['id' => $id]);
        }
    }
}
