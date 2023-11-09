<?php
    session_start();
    if($_GET['login'] == false){
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../dist/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="text-white bg-gray-900">
    <header class="py-4 bg-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php"><h1 class="text-2xl font-semibold text-yellow-400">Dashboard</h1></a>
            <nav class="space-x-4">
                <a href="?login=true&page=list" class="hover:underline">Users</a>
                <a href="?login=ture&page=graph" class="hover:underline">Graphs</a>
                <a href="../" class="hover:underline">Sign Out</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto mt-4 w-full"> 
        <?php
        // simple routing
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'list':
                    include('view-list.php'); 
                    break;
                case 'graph':
                    include('graph.php'); 
                    break;
                default:
                    include('view-list.php'); 
                    break;
            }
        } else {
            include('content.php');
        }
        ?>
    </div>
</body>
</html>