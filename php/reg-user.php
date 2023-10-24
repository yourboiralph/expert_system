<?php

require $_SERVER["DOCUMENT_ROOT"] . '/project2/config/database.php';

// Get the Database singleton instance
$db = Database::getInstance();
$conn = $db->getConnection();

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $pass_word);

$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];
$email = $_POST["email"];
$pass_word = password_hash($_POST["pass_word"], PASSWORD_DEFAULT);
$stmt->execute();

$stmt->close();
$db->getConnection()->close();

header("location: ../index.php?save-success=true");