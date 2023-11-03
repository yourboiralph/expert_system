<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/fetch-users.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../src/style.css">
</head>
<body>
    <div>
        <h1>
            Users
        </h1>
    </div>
    
    <a href="../">
        <button>
            Back
        </button>
    </a>

    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Score</th>
            <th>Depression</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php
                $users = UserFactory::getDetails();

                // check if user data exists and handle accordingly
                if (!empty($users)) {
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->getID(); ?></td>
                            <td>
                                <?php
                                    echo $user->getFirstName() . ' ' . $user->getLastName();
                                ?>
                            </td>
                            <td><?php echo $user->getAge(); ?></td>
                            <td><?php echo $user->getEmail(); ?></td>
                            <td><?php echo $user->getTotalScore(); ?></td>
                            <td><?php echo ucfirst(strtolower($user->getDepressionLevel())); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $user->getID(); ?>">
                                    Edit
                                </a>
                                <a href="../php/delete.php?id=<?php echo $user->getID(); ?>">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">User not found or Empty Database</td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>

    </table>

    <a href="../">
        <button>
            Back
        </button>
    </a>
</body>
</html>