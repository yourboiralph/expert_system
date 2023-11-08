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
<body class="bg-image">
    <?php 
        include '../components/navbar.php';
    ?>

    <div class="h-screen">
        <?php
            if (isset($_GET['create-success'])) {
                echo '<div class="absolute inset-x-[38%] inset-y-24 transform" id="error_msg">
                        <h3 class="bg-white rounded-full text-green-500 text-center font-medium p-2 z-50">Successfully created!</h3>
                    </div>';
            }
        ?>
        <div class="flex justify-center">
            <div class="mt-64 w-3/6 h-60 bg-black bg-opacity-70 flex justify-center rounded-xl">
                <div class="p-4 w-full text-white text-xs md:text-3xl">
                    <h1 class="flex justify-center text-[#ffdcc2] font-bold">Your Depression Level</h1>
                    <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
                    <p>Depression Level: <?php echo $totalScore . " " . $depressionLevel; ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php 
        include '../components/footer.php';
    ?>

    <style>
        .bg-image {
            background-image: url('../img/result1.jpg');
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
    setTimeout(() => {
        error_msg.classList.add('hidden');
    }, 2500);
    </script>
</body>
</html>
