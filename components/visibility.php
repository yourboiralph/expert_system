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
    <div class="bg-black bg-opacity-60 p-4 rounded-lg shadow-md">
        <form method="post" action="">
            <h1 class="text-4xl font-bold text-white mb-5">Before we begin<span class="text-base flex text-white font-thin">please choose whether you would like to proceed <br>anonymously or provide your information.</span></h1>
            <div class="w-64 mx-auto font-bold text-white">
                <label for="firstname">First name</label><br>
                <input type="text" id="firstname" name="firstname" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent"><br>
                <label for="lastname">Last name</label><br>
                <input type="text" id="lastname" name="lastname" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent"><br>
                <label for="age">Age</label><br>
                <input type="text" id="age" name="age" class="w-16 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent"><br>
            </div>
            <div class="mt-4 flex justify-end space-x-5">
                <input type="submit" name="visibility" value="Submit" class="p-2 rounded-lg cursor-pointer hover:bg-opacity-40 hover:bg-yellow-500 hover:text-white hover:scale-110">
                <input type="submit" name="visibility" value="Skip" class="p-2 rounded-lg cursor-pointer">
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