<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>About Us</title>
</head>
<body class="bg-image">
    <?php 
        include '../components/navbar.php';
    ?>
    <div class="bg-slate-600 bg-opacity-90 h-screen items-center justify-center grid grid-cols-2 gap-4">
        <h1 class="absolute text-white md:text-3xl md:font-bold top-64 left-10">About US</h1>
        <div class="bg-white p-4 rounded-lg shadow-lg animation border-2 border-red-500 ml-10">
            <p class="text-[0.5%] md:text-base">Welcome to Untangled, your space for understanding and improving your mental health. Our platform offers a simple and anonymous questionnaire to help you gain insights into your emotional well-being. Whether you choose to stay anonymous or share your information, we're here to support you on your path to a healthier, happier you. <br>We believe in the power of self-discovery and are dedicated to helping you untangle your thoughts. Your mental health matters, and Untangled is your companion on the journey to emotional well-being.</p>
        </div>
        <div>
            <img src="../img/aboutus.jpg" class="w-2/3 h-1/3 mx-auto mb-4">
        </div>
    </div>

    <div class=" flex items-center justify-center h-screen">
        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-semibold mb-6">Meet Our Team</h1>
            <div class="grid grid-cols-2 gap-4">
                <?php
                $teamMembers = [
                    ['John', 'Developer', 'john.jpg'],
                    ['Jane', 'Designer', 'jane.jpg'],
                    ['Mike', 'Marketing', 'mike.jpg'],
                    ['Sarah', 'Content Writer', 'sarah.jpg'],
                ];

                foreach ($teamMembers as $member) {
                    list($name, $position, $image) = $member;
                ?>
                <div class="bg-white p-4 rounded-lg shadow-lg animation">
                    <img src="<?= $image ?>" alt="<?= $name ?>" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h2 class="text-xl font-semibold"><?= $name ?></h2>
                    <p class="text-gray-600"><?= $position ?></p>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <style>
        .bg-image {
            background-image: url('../img/team.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .animation {
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        // You can add additional JavaScript animations here if needed
    </script>
</body>
</html>
