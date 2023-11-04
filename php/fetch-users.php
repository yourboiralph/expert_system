<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

class UserDataRetriever {
    private $db;
    private $conn;

    private $data;

    public function __construct() {
        // the database connection
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();

        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        $data = [];

        // check if the query was successful before fetching data
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->close(); 
        } else {
            die("Error: " . $this->conn->error);
        }

        $this->conn->close();

        $this->data = $data; 
    }

    public function getData() {
        return $this->data;
    }
}

class User {
    public $id;
    public $firstName;
    public $lastName;
    public $age;
    public $email;
    public $totalScore;
    public $depressionLevel;

    public function __construct($id, $firstName, $lastName, $age, $email, $totalScore, $depressionLevel) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
        $this->totalScore = $totalScore;
        $this->depressionLevel = $depressionLevel;
    }

    public function getID() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getAge() {
        return $this->age;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTotalScore() {
        return $this->totalScore;
    }

    public function getDepressionLevel() {
        return $this->depressionLevel;
    }
}

class UserFactory {
    public static function getDetails() {
        $userDataRetriever = new UserDataRetriever(); 
        $userData = $userDataRetriever->getData();

        $users = [];

        foreach ($userData as $userDataEntry) {
            if (!empty($userDataEntry)) {
                $users[] = new User(
                    $userDataEntry['id'],
                    $userDataEntry['first_name'],
                    $userDataEntry['last_name'],
                    $userDataEntry['age'],
                    $userDataEntry['email'],
                    $userDataEntry['total_score'],
                    $userDataEntry['depression_level']
                );
            }
        }
        return $users;
    }
}