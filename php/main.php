<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/interpret-depression.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/save-session.php';

// from the client
$visibility = isset($_SESSION['visibility']) ? $_SESSION['visibility'] : '';
$first_name = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
$last_name = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$total_score = ($_SESSION['totalScore']);

// generates users
$user = UserFactory::getDetails($visibility, $first_name, $last_name, $email, $total_score);

// saves users
new SaveSession($user);

header("location: ../components/result.php");