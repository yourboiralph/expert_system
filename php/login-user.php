<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $is_invalid = false;
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $email = $_POST["email"];
    $password = $_POST["pass_word"];

    $stmt = $conn->prepare("SELECT * FROM user_admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user_admin = $result->fetch_assoc();

    if($user_admin){
        if(password_verify($password, $user_admin["password"])){
            session_start();
            $_SESSION['user_id'] = $user_admin['id'];
            header("location: ../admin?login=true"); 
            exit(); 
        }
    }

    $is_invalid = true;
    header("location: ../components/login.php?login=false");
    exit(); 
}
?>