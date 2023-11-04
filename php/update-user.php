<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserUpdater {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function updateRecord($id, $first_name, $last_name, $age, $email, $score, $depression_level) {
        $stmt = $this->conn->prepare("UPDATE users SET first_name = ?, last_name = ?, age = ?, email = ?, total_score = ?, depression_level = ? WHERE id = ?");
        $stmt->bind_param("ssisssi", $first_name, $last_name, $age, $email, $score, $depression_level, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true; 
        } else {
            $stmt->close();
            return false; 
        }
    }
}

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $userUpdater = new UserUpdater();

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $score = $_POST["score"];
    $depression_level = $_POST["depression_level"];

    if ($userUpdater->updateRecord($id, $first_name, $last_name, $age, $email, $score, $depression_level)) {
        header("location: ../admin?update-success=true");
    } else {
        header("location: ../admin?update-failed=true");
    }
} else {
    header("location: ../admin?update-failed=true");
}
?>