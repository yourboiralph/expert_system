<!DOCTYPE html>
<html class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../dist/output.css" rel="stylesheet">
</head>
<body class="text-white">

    <div class="flex">
        
        <div class="w-1/4 p-4 border border-gray-700">
            <h1 class="text-2xl font-semibold">Graphs and Statistics</h1>
            <ul class="mt-4 space-y-2">
                <li>
                    <a href="?page=graph&content=total-scores" class="text-lg text-yellow-400 hover:underline">Total Scores</a>
                </li>
                <li>
                    <a href="?page=graph&content=private-public" class="text-lg text-yellow-400 hover:underline">Private vs Public</a>
                </li>
                <li>
                    <a href="?page=graph&content=score-age" class="text-lg text-yellow-400 hover:underline">Score and Age</a>
                </li>
                <li>
                    <a href="?page=graph&content=public-age" class="text-lg text-yellow-400 hover:underline">Public and Age</a>
                </li>
            </ul>
        </div>

        <div class="w-3/4 px-4 border border-gray-700">

            <div class="">
                <?php
                if (isset($_GET['content'])) {
                    $page = $_GET['content'];
                    switch ($page) {
                        case 'total-scores':
                            include('total-scores.php'); 
                            break;
                        case 'private-public':
                            include('private-public.php'); 
                            break;
                        case 'score-age':
                            include('score-age.php'); 
                            break;
                        case 'public-age':
                            include('public-age.php'); 
                            break;
                        default:
                            include('total-scores.php'); 
                            break;
                    }
                } else {
                    include('total-scores.php');
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>