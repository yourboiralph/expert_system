<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/config/database.php';

// Rest of your result.php code
$firstName = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
$totalScore = isset($_SESSION['totalScore']) ? $_SESSION['totalScore'] : '';
$depressionLevel = isset($_SESSION['depressionLevel']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <title>Your Result</title>
</head>
<body class="bg-image h-screen">
    <div class="result-container">
        <h1>Your Depression Level</h1>
        <p>Name: <?php echo $firstName . " " . $lastname; ?></p>
        <p>Depression Level: <?php echo $totalScore . " " . $depressionLevel?></p>
    </div>

    <style>
        .bg-image {
            background-image: url('../img/gloom1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 2s ease forwards;
        }

        @keyframes fadeIn {
            from {
            opacity: 0;
            }
            to {
            opacity: 1;
            }
        } 
    </style>
</body>
</html>
