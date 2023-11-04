<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/interpret-depression.php';

class SaveSession {
    private $db;
    private $conn;

    private $first_name;
    private $last_name;
    private $email;
    private $age;
    private $total_score;
    private $depression_level;

    public function __construct(User $user) {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();

        $this->first_name = $user->getFirstName();
        $this->last_name = $user->getLastName();
        $this->age = $user->getAge();
        $this->email = $user->getEmail();
        $this->total_score = $user->getTotalScore();
        $this->depression_level = $user->getDepressionLvl();

        $this->saveUserToDatabase();
    }

    public function saveUserToDatabase() {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, age, email, total_score, depression_level) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $this->first_name, $this->last_name, $this->age, $this->email, $this->total_score, $this->depression_level);
            $stmt->execute();
            $stmt->close();
            $this->db->getConnection()->close();
        } catch (Exception $e) {
            die("An error occurred: " . $e->getMessage());
        }
    }
}

// from the client
$visibility = isset($_SESSION['visibility']) ? $_SESSION['visibility'] : '';
$first_name = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
$last_name = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
$age = isset($_SESSION['age']) ? $_SESSION['age'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$total_score = ($_SESSION['totalScore']);

// generates users
$user = UserFactory::getDetails($visibility, $first_name, $last_name, $email, $age, $total_score);

// saves users
new SaveSession($user);

header("location: ../components/result.php");