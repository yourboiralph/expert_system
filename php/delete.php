<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserDeleter {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function deleteRecord($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; 
        } else {
            $stmt->close();
            return false; 
        }
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $userDeleter = new UserDeleter();

    if ($userDeleter->deleteRecord($id)) {
        header("location: ../admin?delete-success=true");
    } else {
        header("location: ../admin?delete-failed=true");
    }
} else {
    header("location: ../admin?delete-failed=true");
}
?>
