<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/user-model.php';
?>

<!DOCTYPE html>
<html class="scrollbar-hide">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
</head>
<body class="">
    <div class="p-4">
        <h1 class="text-2xl font-semibold">Score and Age</h1>
    </div>

    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Statistics</h2>
            <?php

                $ageData = [];
                $scoreData = [];

                $userRetriever = new UserModel();
                $users = $userRetriever->viewUsers();

                // filter users 
                $filteredUsers = array_filter($users, function($user) {
                    return $user['age'] !== null && $user['age'] > 0 && $user['first_name'] !== 'anonymous';
                });
                
                foreach ($filteredUsers as $user) {
                    $ageData[] = $user['age'];
                    $scoreData[] = $user['total_score'];
                }

                if (count($ageData) > 0) {
                    $meanAge = array_sum($ageData) / count($ageData);
                    $medianAge = median($ageData);
                    $stdDevAge = sqrt(array_sum(array_map(function($x) use ($meanAge) {
                        return pow($x - $meanAge, 2);
                    }, $ageData)) / (count($ageData) - 1));
                } else {
                    $meanAge = 'N/A';
                    $medianAge = 'N/A';
                    $stdDevAge = 'N/A';
                }

                if (count($scoreData) > 0) {
                    $meanScore = array_sum($scoreData) / count($scoreData);
                    $medianScore = median($scoreData);
                    $stdDevScore = sqrt(array_sum(array_map(function($x) use ($meanScore) {
                        return pow($x - $meanScore, 2);
                    }, $scoreData)) / (count($scoreData) - 1));
                } else {
                    $meanScore = 'N/A';
                    $medianScore = 'N/A';
                    $stdDevScore = 'N/A';
                }

                function median($arr) {
                    sort($arr);
                    $count = count($arr);
                    $middle = floor($count / 2);
                    if ($count % 2 == 0) {
                        return ($arr[$middle - 1] + $arr[$middle]) / 2;
                    } else {
                        return $arr[$middle];
                    }
                }
            ?>

            <p><strong>Public Age:</strong></p>
            <ul>
                <li>Mean: <?php echo $meanAge; ?></li>
                <li>Median: <?php echo $medianAge; ?></li>
                <li>Standard Deviation: <?php echo $stdDevAge; ?></li>
            </ul>
            <p class="mt-4"><strong>Public Total Score:</strong></p>
            <ul>
                <li>Mean: <?php echo $meanScore; ?></li>
                <li>Median: <?php echo $medianScore; ?></li>
                <li>Standard Deviation: <?php echo $stdDevScore; ?></li>
            </ul>
        </div>
    </div>

    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Interpretation</h2>
            <p>This scatter plot displays the relationship between age and total score for the public users. It helps visualize any potential trends or patterns in the data.</p>
        </div>
    </div>

    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Age vs. Total Score</h2>
            <canvas id="scatterPlot" style="height: 400px;"></canvas>
        </div>
    </div>

    <script>

    var ageData = <?php echo json_encode($ageData); ?>;
    var scoreData = <?php echo json_encode($scoreData); ?>;
    var users = <?php echo json_encode($filteredUsers); ?>; 
    var scatterPlotData = ageData.map(function(_, index) {
        return {
            x: ageData[index],
            y: scoreData[index]
        };
    });

    // create a scatter plot using Chart.js
    var scatterPlotCtx = document.getElementById('scatterPlot').getContext('2d');
    var scatterPlot = new Chart(scatterPlotCtx, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Age and Total Score',
                data: scatterPlotData,
                backgroundColor: 'rgba(255, 215, 0, 0.6)',
                borderColor: 'rgba(255, 215, 0, 1)',
                pointRadius: 5,
                pointHoverRadius: 7,
                showLine: false,
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: {
                        display: true,
                        text: 'Age',
                        color: 'white'
                    },
                    ticks: {
                        color: 'yellow'
                    }
                },
                y: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Total Score',
                        color: 'white'
                    },
                    ticks: {
                        color: 'yellow'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white',
                    },
                },
                tooltip: {
                    callbacks: {
                        title: function () {
                            return '';
                        },
                        label: function (context) {
                            const data = context.dataset.data[context.dataIndex];
                            const age = data.x;
                            const score = data.y;
                            const user = users.find((user) => user.age === age && user.total_score === score);
                            const depression = user ? user.depression_level : 'N/A';
                            return `Age: ${age}, Score: ${score}, Depression: ${depression}`;
                        },
                    },
                },
            },
        },
    });
    </script>
</body>
</html>