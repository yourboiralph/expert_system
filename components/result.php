<?php
session_start(); // Add session start

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
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <h3 class="bg-white rounded-full text-green-500 text-center font-medium p-2 z-50 text-xs">Successfully created!</h3>
                    </div>';
            }
        ?>
        <div class="flex justify-center">
            <div class="mt-44 w-11/12 h-60 flex justify-center rounded-xl md:mt-64 md:w-3/6 md:h-60">
                <div class="p-4 w-full text-white md:px-10 md:space-y-5 flex flex-col items-center">
                    <h1 class="text-center text-base text-[#ffc599] font-bold md:text-3xl">Your Depression Level</h1>
                    <div class="w-11/12 h-5/6 p-4 pb-10 text-xs bg-white bg-opacity-20 rounded-xl grid grid-cols-2 md:text-xl md:w-11/12 md:h-5/6">
                        <p>Name: </p>
                        <div class="text-center text-base md:text-3xl md:text-start"><?php echo $firstName . " " . $lastName; ?></div>
                        <p>Score: </p>
                        <div class="text-center text-base md:text-3xl md:text-start"><?php echo $totalScore; ?></div>
                        <p>Depression Level: </p>
                        <div class="text-center text-base md:text-3xl md:text-start"><?php echo $depressionLevel; ?></div>
                    </div>
                    <?php if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') { ?>
                        <form action="" method="POST">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" class="w-62 px-4 mt-1 rounded-lg border-2 border-yellow-500 bg-transparent" oninput="validateInput(this)" require><br>
                        <input type="submit" value="Send Email" class="p-2 rounded-lg cursor-pointer bg-yellow-500 text-white hover:bg-opacity-40 hover:bg-yellow-500 hover:scale-110">
                        </form>
                    <?php
                    }elseif (isset($_GET['visibility']) && $_GET['visibility'] == 'public'){?>
                        <a href="../php/email-send.php">Send Email</a><br />
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="mx-5 my-10 text-white">
            <h1>Did You Know</h1>
            <div>
                <h2>Children (10-14 years):</h2>
                <p>Depression is estimated to affect around 1.1% of children aged 10-14. While it is rare, it's not unheard of for children in this age group to experience depression.</p>
            </div>
        </div>
    </div>

    <div class="flex justify-center mb-10">
        <div class="p-5 bg-white bg-opacity-30 rounded-xl flex justify-center md:w-7/12 md:h-11/12">
            <canvas id="ageChart" width="300" height="150"></canvas>
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
        // Your age statistics data
var ageData = {
    "Children (10-14 years)": 1.1,
    "Adolescents (15-19 years)": 2.8,
    "Early Adulthood (20-29 years)": 8,  // Taking an average of 6-10%
    "Adulthood (30-64 years)": 8,        // Taking an average of 6-10%
    "Older Adults (65-74 years)": 3,      // Taking an average of 1-5%
    "Elderly (75-90 years)": 3            // Taking an average of 1-5%
};

// Get the canvas element
var ctx = document.getElementById('ageChart').getContext('2d');

// Create a bar graph
var ageChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: Object.keys(ageData),
        datasets: [{
            label: 'Prevalence of Depression (%)',
            data: Object.values(ageData),
            backgroundColor: 'rgba(153, 87, 44, 1)',
            borderColor: 'rgba(255, 255, 255, 1)',
            borderWidth: 3,
            borderRadius: 5
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: 'white'
                }
            },
            x: {
                ticks: {
                    color: 'white'
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: 'white' // Set text color for legend labels
                }
            }
        }
    }
});
    setTimeout(() => {
        error_msg.classList.add('hidden');
    }, 2500);
    </script>
</body>
</html>
