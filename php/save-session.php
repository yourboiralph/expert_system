<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class SaveSession {
    private $db;
    private $conn;

    private $first_name;
    private $last_name;
    private $email;
    private $total_score;
    private $depression_level;

    public function __construct(User $user) {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();

        $this->first_name = $user->getFirstName();
        $this->last_name = $user->getLastName();
        $this->email = $user->getEmail();
        $this->total_score = $user->getTotalScore();
        $this->depression_level = $user->getDepressionLvl();

        $this->saveUserToDatabase();
    }

    public function saveUserToDatabase() {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, total_score, depression_level) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $this->first_name, $this->last_name, $this->email, $this->total_score, $this->depression_level);
            $stmt->execute();
            $stmt->close();
            $this->db->getConnection()->close();
        } catch (Exception $e) {
            die("An error occurred: " . $e->getMessage());
        }
    }
}
