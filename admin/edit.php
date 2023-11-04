<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="index.php">Back</a>
    <h2>Edit User</h2>

    <?php
        require ('../php/user-model.php');
        
        $userRetriever = new UserModel(); 
        $userData = $userRetriever->viewUser($_GET['id']);
        if ($userData !== null) {
    ?>
        <form action="../php/user-controller.php" method="POST">
            <div>
                <label>First Name</label><br />
                <input type="text" name="first_name" placeholder="First Name" value="<?php echo $userData['first_name']; ?>"/>
            </div>
            <div>
                <label>Last Name</label><br />
                <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $userData['last_name']; ?>"/>
            </div>
            <div>
                <label>Age</label><br />
                <input type="number" name="age" placeholder="Age" value="<?php echo $userData['age']; ?>"/>
            </div>
            <div>
                <label>Email</label><br />
                <input type="text" name="email" placeholder="Email" value="<?php echo $userData['email']; ?>"/>
            </div>
            <div>
                <label>Score</label><br />
                <input type="number" name="score" placeholder="Score" value="<?php echo $userData['total_score']; ?>"/>
            </div>
            <div>
                <label>Depression</label><br />
                <input type="radio" name="depression_level" value="NORMAL" <?php if ($userData['depression_level'] == 'NORMAL') echo 'checked'; ?> /> Normal
                <input type="radio" name="depression_level" value="MILD" <?php if ($userData['depression_level'] == 'MILD') echo 'checked'; ?>/> Mild
                <input type="radio" name="depression_level" value="BORDERLINE" <?php if ($userData['depression_level'] == 'BORDERLINE') echo 'checked'; ?>/> Borderline
                <input type="radio" name="depression_level" value="MODERATE" <?php if ($userData['depression_level'] == 'MODERATE') echo 'checked'; ?>/> Moderate
                <input type="radio" name="depression_level" value="SEVERE" <?php if ($userData['depression_level'] == 'SEVERE') echo 'checked'; ?>/> Severe
                <input type="radio" name="depression_level" value="EXTREME" <?php if ($userData['depression_level'] == 'EXTREME') echo 'checked'; ?>/> Extreme
            </div>
            <input type="hidden" name="action" value="update">
            <div>
                <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                <button type="submit">Update</button>
            </div>
        </form>
    <?php
        } else {
            // handle the case when no user data is found for the provided ID
            echo "User not found.";
        }
    ?>
</body>

</html> 