<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['visibility'])) {
        $visibility = $_POST['visibility'];

        if ($visibility == 'Skip') {
            $_SESSION['visibility'] = 'private';
            header("location: questions_answerChoices.php");
            exit();
        } elseif ($visibility == 'Submit') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $age = $_POST['age'];
            $email = $_POST['email'];

            if (empty($firstname) || empty($lastname) || empty($age) || empty($email)) {
                echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform" id="error_msg">
                    <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Please fill in all the required fields (First name, Last name, Email Address, Age) before submitting.</h3>
                </div>';
            } elseif ($age < 10) {
                echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform" id="error_msg">
                    <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Age must be 10 or greater.</h3>
                </div>';
            } elseif ($age > 90) {
                echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform" id="error_msg">
                    <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Age must be 90 or less.</h3>
                </div>';
            } else {
                $_SESSION['visibility'] = 'public';
                $_SESSION['email'] = $email;
                $_SESSION['age'] = $age;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                header("location: questions_answerChoices.php");
                exit();
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
<div class="bg-black bg-opacity-60 p-4 rounded-lg shadow-md fade-in">
    <form method="post" action="">
        <h1 class="md:text-4xl font-bold text-white mb-5">Before we begin<span class="md:text-base flex text-white font-thin leading-none">please choose whether you would like to proceed anonymously <br class="md:block hidden">or provide your information.</span></h1>
        <div class="w-64 mx-auto font-bold text-white">
            <label for="firstname">First name</label><br>
            <input type="text" id="firstname" name="firstname" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateInput(this)"><br>
            <label for="lastname">Last name</label><br>
            <input type="text" id="lastname" name="lastname" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateInput(this)"><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateInput(this)"><br>
            <label for="age">Age</label><br>
            <input type="number" id="age" name="age" value="0" class="w-32 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateAge(this)"><br>
        </div>
        <div class="mt-4 flex justify-between space-x-5">
        <a href="../index.php" class="p-2 rounded-lg text-slate-400 hover:bg-opacity-40 hover:bg-slate-400 hover:scale-110 duration-500">Go Back</a>
            <input type="submit" name="visibility" value="Submit" class="p-2 rounded-lg cursor-pointer text-white font-bold hover:bg-opacity-40 hover:bg-yellow-500 hover:scale-110 duration-500">
            <input type="submit" name="visibility" value="Skip" class="p-2 rounded-lg cursor-pointer text-slate-400 hover:bg-opacity-40 hover:bg-slate-400 hover:scale-110 duration-500">
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

<script>
    function validateInput(inputField) {
        if (inputField.value.trim() !== "") {
            inputField.style.borderColor = "green";
        } else {
            inputField.style.borderColor = "red";
        }
    }

    function validateAge(ageField) {
        const age = parseInt(ageField.value);
        if (age <= 10 || age > 90) {
            ageField.style.borderColor = "red";
        } else {
            ageField.style.borderColor = "green";
        }
    }
    setTimeout(() => {
        error_msg.classList.add('hidden');
    }, 2500);
</script>
</body>
</html>
