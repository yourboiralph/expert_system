<?php
require $_SERVER["DOCUMENT_ROOT"] . '/project2/config/database.php';

// base class
abstract class User {
    protected $totalScore;
    protected $depressionLevel;
    protected $firstname = '';
    protected $lastname = '';
    protected $email = '';
    protected $pass_word = '';

    // setters 
    public function __construct(string $firstname, string $lastname, string $email, string $pass_word, array $numbers) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->pass_word = $pass_word;

        $this->totalScore = 0;

        foreach ($numbers as $number) {
            $this->totalScore += $number;
        }

        // calculate depression level when the object is constructed
        $this->calculateDepressionLevel();
    }

    // identifies depression level
    protected function calculateDepressionLevel() {
        switch (true) {
            case $this->totalScore >= 1 && $this->totalScore <= 10:
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
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->pass_word;
    }
}

// child class
class PublicUser extends User {
}

//child class
class PrivateUser extends User {
    
    public function __construct (array $numbers) {
        $this->totalScore = 0;

        foreach ($numbers as $number) {
            $this->totalScore += $number;
        }

        // calculate depression level when the object is constructed
        $this->calculateDepressionLevel();
    }
}

class UserFactory {
    public static function getDetails(string $type, string $firstname, string $lastname, string $email, string $pass_word, array $numbers) {
        if ($type === "private") {
            return new PrivateUser($numbers);
        } elseif ($type === "public") {
            return new PublicUser($firstname, $lastname, $email, $pass_word, $numbers);
        } else {
            throw new Exception("Invalid user type or incorrect number of arguments for user type: $type");
        }
        
    }
}

// from the client
$user = UserFactory::getDetails('public', 'shean', 'hernandez', 'ralph@123', '123', [40]);

// get the Database singleton instance
$db = Database::getInstance();
$conn = $db->getConnection();

// save to database
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, total_score, depression_level) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword(), $user->getTotalScore(), $user->getDepressionLvl());
$stmt->execute();

$stmt->close();
$db->getConnection()->close();

header("location: ../index.php?save-success=true");