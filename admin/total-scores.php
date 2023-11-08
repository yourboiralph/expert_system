<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/user-model.php';
?>

<!DOCTYPE html>
<html class="scrollbar-hide">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
</head>

<body class="text-white min-h-screen m-5">
    <div class="p-4">
        <h1 class="text-2xl font-semibold text-white">Total Scores Bar Graph</h1>
    </div>

    <div class="p-4">
        <div class="bg-dark-yellow p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Interpretation</h2>
            <p class="text-gray-200">
                The Total Scores Bar Graph displays the total scores of users. Each bar represents a user, and the height of the bar corresponds to their total score. It helps visualize the distribution of scores among users.
            </p>
        </div>
    </div>

    <div class="p-4">
        <div class="bg-dark-yellow p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Total Scores</h2>
            <div class="w-full">
                <canvas class="" id="totalScoresChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <script>
        <?php
            $userRetriever = new UserModel(); 
            $users = $userRetriever->viewUsers();
            
            $totalScores = [];
            foreach ($users as $user) {
                $totalScores[] = $user['total_score'];
            }
        ?>

        var totalScoresData = <?php echo json_encode($totalScores); ?>;

        var ctxTotalScores = document.getElementById('totalScoresChart').getContext('2d');
        var totalScoresChart = new Chart(ctxTotalScores, {
            type: 'bar',
            data: {
                labels: totalScoresData.map(function (_, index) {
                    return 'User ' + (index + 1);
                    
                }),
                datasets: [{
                    label: 'Total Scores',
                    data: totalScoresData,
                    backgroundColor: 'rgba(255, 215, 0, 0.6)', 
                    borderColor: 'rgba(255, 215, 0, 1)', 
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' 
                        }
                    }
                },  
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'yellow' 
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white' 
                        }
                    }                    
                }
            }
        });

    </script>
</body>
</html>