<?php
session_start();

// base class
abstract class User {
    protected $firstname = 'anonymous';
    protected $lastname = null;
    protected $age = null;
    protected $email = null;
    protected $totalScore;
    protected $depressionLevel;

    // setters 
    public function __construct(string $firstname, string $lastname, string $email, int $age, int $number) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->age = $age;
        $this->totalScore = $number;


        // calculate depression level when the object is constructed
        $this->calculateDepressionLevel();
    }

    // identifies depression level
    protected function calculateDepressionLevel() {
        switch (true) {
            case $this->totalScore >= 0 && $this->totalScore <= 10:
                $this->depressionLevel = 'NORMAL';
                break;
            case $this->totalScore >= 11 && $this->totalScore <= 16:
                $this->depressionLevel = 'MILD';
                break;
            case $this->totalScore >= 17 && $this->totalScore <= 20:
                $this->depressionLevel = 'BORDERLINE';
                break;
            case $this->totalScore >= 21 && $this->totalScore <= 30:
                $this->depressionLevel = 'MODERATE';
                break;
            case $this->totalScore >= 31 && $this->totalScore <= 40:
                $this->depressionLevel = 'SEVERE';
                break;
            default:
                $this->depressionLevel = 'EXTREME';
        }
    }

    public function getTotalScore() {
        return $this->totalScore;
    }
    public function getDepressionLvl() {
        return $this->depressionLevel;
    }
    public function getFirstName() {
        return $this->firstname;
    }
    public function getLastName() {
        return $this->lastname;
    }
    public function getAge() {
        return $this->age;
    }
    public function getEmail() {
        return $this->email;
    }
}

// child class
class PublicUser extends User {
}

//child class
class PrivateUser extends User {
    
    public function __construct (int $number) {
        $this->totalScore = 0;
        $this->totalScore = $number;


        // calculate depression level when the object is constructed
        $this->calculateDepressionLevel();
    }
}

class UserFactory {
    public static function getDetails(string $type, string $firstname, string $lastname, string $email, int $age, int $number) {
        if ($type === "private") {
            return new PrivateUser($number);
        } elseif ($type === "public") {
            return new PublicUser($firstname, $lastname, $email, $age, $number);
        } else {
            throw new Exception("Invalid user type or incorrect number of arguments for user type: $type");
        }
    }
}

// from the client
// $visibility = isset($_SESSION['visibility']) ? $_SESSION['visibility'] : '';
// $first_name = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
// $last_name = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
// $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
// $total_score = isset($_SESSION['totalScore']);

// $user = UserFactory::getDetails($visibility, $first_name, $last_name, $email, '123', [$_SESSION['totalScore']]);


// // get the Database singleton instance
// $db = Database::getInstance();
// $conn = $db->getConnection();

// // save to database
// $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, total_score, depression_level) VALUES (?,?,?,?,?,?)");
// $stmt->bind_param("ssssss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getTotalScore(), $user->getDepressionLvl());
// $stmt->execute();

// $stmt->close();
// $db->getConnection()->close();

// header("location: email-send.php");