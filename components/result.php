<?php
$userEncoded = $_GET['user'];
$user = json_decode(base64_decode(urldecode($userEncoded)), true);

$firstName = $user['firstName'];
$lastName = $user['lastName'];
$age = $user['age'];
$email = $user['email'];
$totalScore = $user['totalScore'];
$depressionLevel = $user['depressionLevel'];
?>

<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <title>Your Result</title>
</head>
<body>
    <p>
        <?php
        if (isset($_GET['create-success'])) {
            echo 'Successfully created!';
        }
        ?>
    </p> 
    <div class="result-container">
        <h1>Your Depression Level</h1>
        <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
        <p>Depression Level: <?php echo $totalScore . " " . $depressionLevel; ?></p>
    </div>
</body>
</html>
