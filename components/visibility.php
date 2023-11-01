<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['visibility'])) {
        $visibility = $_POST['visibility']; // Storing the choice in a variable

        if ($visibility == 'Skip') {
            $_SESSION['visibility'] = 'private'; // Storing the choice in the session
            header("location: questions_answerChoices.php");
            exit(); // Add an exit after the header to prevent further execution
        } elseif ($visibility == 'Submit') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $age = $_POST['age'];

            if (empty($firstname) || empty($lastname) || empty($age)) {
                echo 'Please fill in all the required fields (First name, Last name, Age) before submitting.';
            } else {
                $_SESSION['visibility'] = 'public';
                header("location: questions_answerChoices.php");
                exit(); // Add an exit after the header to prevent further execution
            }
        }
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../dist/output.css">
        <title>Get Started</title>
    </head>
<body class="bg-image flex justify-center items-center h-screen">
    <div class="bg-white p-4 border-2 border-red-600 rounded-lg shadow-md text-center form-container">
        <form method="post" action="">
            <h1 class="text-4xl font-bold">Before we begin <br>please choose whether you would like to proceed anonymously or provide your information.</h1>
            <div class="border-2 border-red-600 w-60">
                <label for="firstname">First name</label><br>
                <input type="text" id="firstname" name="firstname" class="w-56 px-4 mt-1 border rounded-lg"><br>
                <label for="lastname">Last name</label><br>
                <input type="text" id="lastname" name="lastname" class="w-56 px-4 mt-1 border rounded-lg"><br>
                <label for="age">Age</label><br>
                <input type="text" id="age" name="age" class="w-56 px-4 mt-1 border rounded-lg"><br>
            </div>
            <div class="mt-4 button-container">
                <input type="submit" name="visibility" value="Submit" class="px-4 py-2 border-2 border-red-600 rounded-lg bg-red-600 text-white cursor-pointer">
                <input type="submit" name="visibility" value="Skip" class="px-4 py-2 border-2 border-red-600 rounded-lg cursor-pointer">
            </div>
        </form>
    </div>

        <style>
            body {
                background-image: url('../img/visibility.jpg');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
        </style>
    </body>
</html>