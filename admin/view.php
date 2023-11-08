<!DOCTYPE html>
<html lang="en">
<head class="scrollbar-hide">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title> 
    <link href="../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white p-4">
    <a href="javascript:history.go(-1)" class="hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Back
    </a>

    <h2 class="text-3xl font-semibold text-yellow-400 mb-4">User Profile</h2>

    <?php
    require('../php/user-model.php');
    
    $userRetriever = new UserModel(); 
    $userData = $userRetriever->viewUser($_GET['id']);
    if ($userData !== null) {
    ?>
    <div class="rounded-lg bg-gray-800 p-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="text-lg">
                <strong>First Name:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['first_name']; ?>
            </div>
            <div class="text-lg">
                <strong>Last Name:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['last_name']; ?>
            </div>
            <div class="text-lg">
                <strong>Age:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['age']; ?>
            </div>
            <div class="text-lg">
                <strong>Email:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['email']; ?>
            </div>
            <div class="text-lg">
                <strong>Score:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['total_score']; ?>
            </div>
            <div class="text-lg">
                <strong>Depression Level:</strong>
            </div>
            <div class="text-lg">
                <?php echo $userData['depression_level']; ?>
            </div>
        </div>
    </div>
    <?php
    } else {
        echo "User not found.";
    }
    ?>
</body>
</html>