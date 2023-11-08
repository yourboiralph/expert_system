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
        <h1 class="text-2xl font-semibold">Public Users Age Groups</h1>
    </div>

    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Statistics</h2>
            <?php
                $userRetriever = new UserModel();
                $users = $userRetriever->viewUsers();

                // filter users
                $filteredUsers = array_filter($users, function($user) {
                    return $user['age'] !== null && $user['age'] > 0 && $user['first_name'] !== 'anonymous';
                });

                // categorize users 
                $ageGroups = [
                    'Children (10-14 years)' => 0,
                    'Adolescents (15-19 years)' => 0,
                    'Early Adulthood (20-29 years)' => 0,
                    'Adulthood (30-64 years)' => 0,
                    'Older Adults (65-74 years)' => 0,
                    'Elderly (75-90 years)' => 0,
                ];

                foreach ($filteredUsers as $user) {
                    $age = $user['age'];
                    if ($age >= 10 && $age <= 14) {
                        $ageGroups['Children (10-14 years)']++;
                    } elseif ($age >= 15 && $age <= 19) {
                        $ageGroups['Adolescents (15-19 years)']++;
                    } elseif ($age >= 20 && $age <= 29) {
                        $ageGroups['Early Adulthood (20-29 years)']++;
                    } elseif ($age >= 30 && $age <= 64) {
                        $ageGroups['Adulthood (30-64 years)']++;
                    } elseif ($age >= 65 && $age <= 74) {
                        $ageGroups['Older Adults (65-74 years)']++;
                    } elseif ($age >= 75 && $age <= 90) {
                        $ageGroups['Elderly (75-90 years)']++;
                    }
                }

                $totalUsers = count($filteredUsers);
            ?>

            <p><strong>Age Groups:</strong></p>
            <ul>
                <?php
                foreach ($ageGroups as $group => $count) {
                    $percentage = ($count / $totalUsers) * 100;
                    echo "<li>$group: $count users ($percentage%)</li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Interpretation</h2>
            <p>This pie chart displays the distribution of public users into different age groups based on their age. It helps visualize the age distribution among public users, allowing you to identify which age groups are more prominent. Understanding the mental health challenges faced by different age groups within the user community is vital for providing appropriate support and resources.</p>
            <p>For instance, it's essential to note that depression rates and the prevalence of suicidal thoughts and behaviors can vary across age groups. According to the <a href="https://www.who.int/news-room/fact-sheets/detail/adolescent-mental-health" target="_blank" style="color: yellow;">World Health Organization</a>, adolescents aged 15-19 may experience an estimated 2.8% depression rate, and unique challenges during this phase contribute to mental health issues.</p>
            <p>Furthermore, <a href="https://aifs.gov.au/media/depression-suicidality-and-loneliness-mental-health-and-australian-men" target="_blank" style="color: yellow;">Australian Institute of Family Studies</a> emphasizes the impact of depression, suicidality, and loneliness on mental health and highlights the importance of addressing these issues in different age groups.</p>
            <p>Additionally, <a href="https://www.medicalnewstoday.com/articles/why-is-gen-z-depressed" target="_blank" style="color: yellow;">Medical News Today</a> explores the factors contributing to depression in Generation Z, shedding light on the mental health challenges faced by specific age groups.</p>
        </div>
    </div>


    <div class="p-4">
        <div class="p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4">Age Groups Distribution</h2>
            <canvas id="ageGroupPieChart" style="height: 400px;"></canvas>
        </div>
    </div>

    <script>
        var ageGroups = <?php echo json_encode(array_keys($ageGroups)); ?>;
        var ageGroupCounts = <?php echo json_encode(array_values($ageGroups)); ?>;
        
        var ageGroupPieChartCtx = document.getElementById('ageGroupPieChart').getContext('2d');
        var ageGroupPieChart = new Chart(ageGroupPieChartCtx, {
            type: 'pie',
            data: {
                labels: ageGroups,
                datasets: [{
                    data: ageGroupCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                    ],
                }],
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        },
                    },
                },
            },
        });
    </script>
</body>
</html>