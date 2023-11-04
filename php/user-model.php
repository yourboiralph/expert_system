<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function deleteUser($id) {
        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $id);
    
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (Exception $e) {
            die("An error occurred: " . $e->getMessage());
            return false; 
        }
    }

    public function updateUser($id, $first_name, $last_name, $age, $email, $score, $depression_level) {
        try {
            $sql = "UPDATE users SET first_name = ?, last_name = ?, age = ?, email = ?, total_score = ?, depression_level = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssisssi", $first_name, $last_name, $age, $email, $score, $depression_level, $id);
    
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (Exception $e) {
            die("An error occurred: " . $e->getMessage());
            return false; 
        }
    }

    public function createUser($user) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, age, email, total_score, depression_level) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $user->getFirstName(), $user->getLastName(), $user->getAge(), $user->getEmail(), $user->getTotalScore(), $user->getDepressionLvl());
            $stmt->execute();
            $stmt->close();
            $this->db->getConnection()->close();
            return true; 
        } catch (Exception $e) {
            die("An error occurred: " . $e->getMessage());
            return false; 
        }
    }
}
?>
