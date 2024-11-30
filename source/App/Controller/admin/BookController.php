<?php

class BookController
{
    private $bookModel;

    public function __construct()
    {
        $this->loadModel('BookModel');  // Load the BookModel
        $this->bookModel = new BookModel();  // Initialize the model
    }

    // API: Get all books
    public function getAllBooks()
    {
        $books = $this->bookModel->getAllBooks();
        echo json_encode($books);
    }

    // API: Get a single book by its ID
    public function getBook($id)
    {
        $book = $this->bookModel->getBookById($id);
        if ($book) {
            echo json_encode($book);
        } else {
            echo json_encode(['error' => 'Book not found']);
        }
    }

    // API: Add a new book
    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'], $data['author'], $data['price'])) {
                $name = $data['name'];
                $author = $data['author'];
                $price = $data['price'];

                $book = $this->bookModel->addBook($name, $author, $price);

                echo json_encode($book);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    // API: Edit an existing book
    public function editBook($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['name'], $data['author'], $data['price'])) {
                $name = $data['name'];
                $author = $data['author'];
                $price = $data['price'];

                $updatedBook = $this->bookModel->updateBook($id, $name, $author, $price);

                echo json_encode($updatedBook);
            } else {
                echo json_encode(['error' => 'Missing data']);
            }
        }
    }

    private function loadModel($model)
    {
        require_once 'Model/' . $model . '.php';
    }
}

?>
