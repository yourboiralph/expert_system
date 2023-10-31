<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['visibility'])) {
        $visibility = $_POST['visibility']; // Storing the choice in a variable
        if($visibility == 'Skip'){
            $_SESSION['visibility'] = 'private'; // Storing the choice in the session
            header("location: questions_answerChoices.php");
            exit(); // Add an exit after header to prevent further execution
        }
        elseif($visibility == 'Submit'){
            $_SESSION['visibility'] = 'public';
            header("location: questions_answerChoices.php");
            exit(); // Add an exit after header to prevent further execution
        }
    } else {
        echo 'Please select a visibility option.';
    }
}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form method="post" action="">
            <h1>HELLO NIGGAS! WELCOME TO THE DEPRESSION TEST!!!!</h1>
            <label>First name</label><br>
            <input type="text" name="firstname"><br>
            <label>Last name</label><br>
            <input type="text" name="lastname"><br>
            <label>Age</label><br>
            <input type="text" name="age"><br>
            <input type="submit" name="visibility" value="Submit">
            <input type="submit" name="visibility" value="Skip">
        </form>
    </body>
</html>