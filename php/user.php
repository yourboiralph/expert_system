<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserRetriever {
    private $db;
    private $conn;
    private $data; 

    public function __construct($id) {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();

        $this->getUserById($id);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $this->data = $result->fetch_assoc(); 
            $stmt->close();
        } else {
            $stmt->close();
            $this->data = null; 
        }
    }

    public function getUserData() {
        return $this->data; 
    }
}
