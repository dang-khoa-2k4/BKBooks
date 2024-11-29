<?php
class Database
{
    private $server = 'localhost';
    private $dbName = 'restaurant';
    private $user = 'root';
    private $password = '';
        
    // Hàm kết nối CSDL
	public function connect()
	{
		$conn = new mysqli($this->server, $this->user, $this->password, $this->dbName);

		mysqli_set_charset($conn, 'utf8');

		if ($conn->connect_error) {
			printf($conn->connect_error);
			exit();
		}
		return $conn;
	}
        // Hàm đóng kết nối CSDL
    public function closeDatabase($conn)
	{
		if ($conn) {
			$conn->close();
		}
	}
}