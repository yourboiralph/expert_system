<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $conn = require $_SERVER["DOCUMENT_ROOT"] . '/project2/config/database.php';
    
    $email = $_POST["email"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user){
        if(password_verify($_POST["pass_word"], $user["password"])){
            die("login success!");
        }
    }

    $is_invalid = true;
    die("Login unsuccessful");
    

}
?>
