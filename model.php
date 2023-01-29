<?php 
/**
 *Database Connection
 */
class Model
{
	private $servername = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbname = 'users';
	private $conn;
	
	function __construct()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
			echo 'Connection Failed';
		} else {
			return $this->conn;
		}
	}

	public function insertRecord($post) {
		$name = $post['name'];
		$email = $post['email'];
		$sql = "INSERT INTO user(name, email, publish)VALUES('$name', '$email', 1)";
		$result = $this->conn->query($sql);
		if ($result) {
			header('location: index.php?msg=ins');
		} else {
			echo "Error" . $sql . "<br>" . $this->conn->error;
		}
	}

	public function updateRecordById($post) {
		$name = $post['name'];
		$email = $post['email'];
		$userId = $post['hid'];
		$sql = "UPDATE user SET name='$name', email='$email' WHERE id='$userId'";
		$result = $this->conn->query($sql);
		if ($result) {
			header('location: index.php?msg=ups');
		} else {
			echo "Error" . $sql . "<br>" . $this->conn->error;
		}
	}

	public function deleteRecordById($delId) {
		$sql = "UPDATE user SET publish=0 WHERE id='$delId'";
		$result = $this->conn->query($sql);
		if ($result) {
			header('location: index.php?msg=del');
		} else {
			echo "Error" . $sql . "<br>" . $this->conn->error;
		}
	}

	public function displayRecord() {
		$sql = "SELECT * FROM user WHERE publish=1";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		}
	}

	public function displayRecordById($editId) {
		$sql = "SELECT * FROM user WHERE id='$editId'";
		$result = $this->conn->query($sql);
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			return $row;			
		}
	}
}
?>