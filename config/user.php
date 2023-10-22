<?php

require $_SERVER["DOCUMENT_ROOT"] . '/project/config/database.php';

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, gender, diagnosis) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $firstname, $lastname, $gender, $diagnosis);

$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];
$gender = $_POST["gender"];
$diagnosis = $_POST["diagnosis"];
$stmt->execute();

$stmt->close();
$conn->close();

header("location: ../../index.php?save-success=true");