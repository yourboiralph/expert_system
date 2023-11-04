<?php
session_start();

$userEncoded = $_GET['user'];
$user = json_decode(base64_decode(urldecode($userEncoded)), true);

$firstName = $user['firstName'];
$lastName = $user['lastName'];
$age = $user['age'];
$email = $user['email'];
$totalScore = $user['totalScore'];
$depressionLevel = $user['depressionLevel'];

if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (empty($email)) {
            echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform">
                <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Please fill in all the required fields (First name, Last name, Email Address, Age) before submitting.</h3>
            </div>';
        } else {
            $_SESSION['email'] = $email;
            header("Location: ../php/email-send.php");
            exit();
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
    <title>Your Result</title>
</head>
<body>
    <div class="result-container">
        <h1>Your Depression Level</h1>
        <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
        <p>Depression Level: <?php echo $totalScore . " " . $depressionLevel; ?></p>
        <?php if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') { ?>
            <form action="" method="POST">
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateInput(this)" require><br>
            <input type="submit" value="Send Email" class="p-2 rounded-lg cursor-pointer bg-yellow-500 text-white hover:bg-opacity-40 hover:bg-yellow-500 hover:scale-110">
            </form>
        <?php
        }elseif (isset($_GET['visibility']) && $_GET['visibility'] == 'public'){?>
            <a href="../php/email-send.php"><button>Send Email</button></a><br />
        <?php } ?>
        <a href="../index.php" class="p-2 mt-10 rounded-lg cursor-pointer bg-yellow-500 text-white hover:bg-opacity-40 hover:bg-yellow-500 hover:scale-110"><button>Home</button></a>
    </div>
</body>
</html>

<style>
    input{
        cursor: pointer;
    }
</style>
