<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/user-model.php';
?>
<!DOCTYPE html>
<html>
<body class="bg-gray-900 text-white">
    <div class="w-full">
        <h1 class="text-2xl font-semibold text-yellow-400 mb-4">Users</h1>

        <?php
        if (isset($_GET['update-success'])) {
            echo 'Successfully updated';
        }

        if (isset($_GET['delete-success'])) {
            echo 'Successfully deleted';
        }
        ?>

        <div class="overflow-x-auto">
            <div class="mx-auto">
                <table class="table-auto min-w-full text-left border border-gray-700">
                    <thead>
                        <tr>
                            <?php
                            $headers = ["ID", "Name", "Age", "Email", "Score", "Depression", "Action"];
                            foreach ($headers as $header) {
                                $headerClass = ($header === "Action") ? "text-right" : "";
                                echo '<th class="px-4 py-2 border border-gray-700 ' . $headerClass . '">' . $header . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $userRetriever = new UserModel();
                        $users = $userRetriever->viewUsers();

                        if (!empty($users)) {
                            foreach ($users as $user) {
                                echo '<tr>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['id'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['first_name'] . ' ' . $user['last_name'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['age'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['email'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['total_score'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . ucfirst(strtolower($user['depression_level'])) . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700 text-right">';
                                echo '<a href="view.php?id=' . $user['id'] . '" class="text-blue-500 hover:underline mr-2">View</a>';
                                echo '<a href="../php/user-controller.php?id=' . $user['id'] . '&action=edit" class="text-yellow-500 hover:underline mr-2">Edit</a>';
                                echo '<a href="../php/user-controller.php?id=' . $user['id'] . '&action=delete" class="text-red-500 hover:underline">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7" class="px-4 py-2">User not found or Empty Database</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>