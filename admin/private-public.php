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
        <h1 class="text-2xl font-semibold text-white">Private vs. Public Users</h1>
    </div>

    <div class="p-4">
        <div class="bg-dark-yellow p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Statistics</h2>
            <?php
            $userRetriever = new UserModel();
            $users = $userRetriever->viewUsers();

            // filter users
            $privateUsers = array_filter($users, function ($user) {
                return $user['first_name'] === 'anonymous';
            });
            $publicUsers = array_filter($users, function ($user) {
                return $user['first_name'] !== 'anonymous';
            });

            $totalUsers = count($users);
            $totalPrivateUsers = count($privateUsers);
            $totalPublicUsers = count($publicUsers);

            echo "<p>Total Users: $totalUsers</p>";
            echo "<p>Total Private Users: $totalPrivateUsers</p>";
            echo "<p>Total Public Users: $totalPublicUsers</p>";
            ?>
        </div>
    </div>

    <div class="p-4">
        <div class="bg-dark-yellow p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Interpretation</h2>
            <p class="text-gray-200">
                The "Private vs. Public Users" graph illustrates the comparison between the number of private users and public users. Private users are denoted by the red bars, while public users are represented by the dark yellow bars.

                This analysis can help understand the distribution of user types and make data-driven decisions based on this distinction.
            </p>
        </div>
    </div>

    <div class="p-4">
        <div class="bg-dark-yellow p-4 rounded shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-white">Private vs. Public Users</h2>
            <div class="w-full">
                <canvas id="userTypeChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <script>
    var ctxUserType = document.getElementById('userTypeChart').getContext('2d');
    var userTypeChart = new Chart(ctxUserType, {
        type: 'bar',
        data: {
            labels: ['User Types'],
            datasets: [
                {
                    label: 'Private Users',
                    data: [<?php echo count($privateUsers); ?>],
                    backgroundColor: 'rgba(128, 128, 128, 0.6)', 
                    borderColor: 'rgba(128, 128, 128, 1)', 
                    borderWidth: 1
                },
                {
                    label: 'Public Users',
                    data: [<?php echo count($publicUsers); ?>],
                    backgroundColor: 'rgba(255, 215, 0, 0.6)', 
                    borderColor: 'rgba(255, 215, 0, 1)', 
                    borderWidth: 1
                },
            ]
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
                        color: 'white'
                    }
                },
                x: {
                    ticks: {
                        color: 'yellow'
                    }
                }
            }
        }
    });
</script>

</body>

</html>