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
            <div class="mt-64 w-3/6 h-60 bg-white bg-opacity-20 flex justify-center rounded-xl">
                <div class="p-4 w-full text-white text-xs md:px-10 md:space-y-5 md:text-3xl">
                    <h1 class="flex justify-center text-[#ffc599] font-bold">Your Depression Level</h1>
                    <p>Name: <?php echo $firstName . " " . $lastName; ?></p>
                    <p>Score: <?php echo $totalScore; ?></p>
                    <p>Depression Level: <?php echo $depressionLevel; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center mb-10">
        <div class="bg-black bg-opacity-30 rounded-xl flex justify-center md:w-7/12 md:h-11/12">
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
            borderColor: 'rgba(0, 0, 0, 1))',
            borderWidth: 1,
            borderRadius: 10
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: 'white' // Set text color for y-axis labels
                }
            },
            x: {
                ticks: {
                    color: 'white' // Set text color for x-axis labels
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
