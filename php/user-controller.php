<?php
require_once 'user-model.php';
require_once 'interpret-depression.php';

class UserController {
    public function viewUser($id) {
        $userModel = new UserModel();
        return $userModel->getUser($id);
    }

    public function deleteUser($id) {
        $userModel = new UserModel();
        $success = $userModel->deleteUser($id);
        $destination = $success ? 'success' : 'failed';
        header("location: ../admin?delete-$destination=true");
    }

    public function updateUser($id, $first_name, $last_name, $age, $email, $score, $depression_level) {
        $userModel = new UserModel();
        $success = $userModel->updateUser($id, $first_name, $last_name, $age, $email, $score, $depression_level);
        $destination = $success ? 'success' : 'failed';
        header("location: ../admin?update-$destination=true");
    }

    public function createUser($type, $first_name, $last_name, $email, $age, $total_score) {
        $user = UserFactory::getDetails($type, $first_name, $last_name, $email, $age, $total_score);

        $userModel = new UserModel();
        $success = $userModel->createUser($user);

        // array to be used for display in results
        $userData = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "age" => $user->getAge(),
            "email" => $user->getEmail(),
            "totalScore" => $user->getTotalScore(),
            "depressionLevel" => $user->getDepressionLvl(),
        ];
        
        // encode the array to be used as a URL parameter
        $userDataEncoded = base64_encode(json_encode($userData));

        $destination = $success ? 'success' : 'failed';
        header("location: ../components/result.php?create-$destination=true&user=$userDataEncoded");
    }
}

$controller = new UserController();
$action = '';
$id = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) || isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) || isset($_POST['id'])) {
    $action = $_POST['action'];
    $id = $_POST['id'];
}

switch ($action) {
    case 'edit':
        header("location: ../admin/edit.php?id=$id&action=update");
        exit;
    case 'update':
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $score = $_POST["score"];
            $depression_level = $_POST["depression_level"];
            $controller->updateUser($id, $first_name, $last_name, $age, $email, $score, $depression_level);
        } else {
            header("location: ../admin?update-failed=true");
        }
        break;
    case 'create':
        $visibility = isset($_SESSION['visibility']) ? $_SESSION['visibility'] : '';
        $first_name = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
        $last_name = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
        $age = isset($_SESSION['age']) ? $_SESSION['age'] : '';
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
        $total_score = ($_SESSION['totalScore']);

        $controller->createUser($visibility, $first_name, $last_name, $email, $age, $total_score);
        break;
    case 'delete':
        $controller->deleteUser($id);
        break;
    default:
        echo "invalid action";
        break;
}
