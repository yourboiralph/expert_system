<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../dist/output.css">
    <title>Registration</title>
</head>
<body class="bg-image">
    <section class="min-h-screen flex items-center justify-center fade-in">

        <div class="bg-orange-300 bg-opacity-50 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">

            <div class="sm:w-1/2 px-8">
                <h2 class="font-bold text-2xl text-[#1F0805]">Register</h2>
                <p class="text-sm mt-4 text-[#1F0805]">If you're already a member, easily log in</p>

                <form class="flex flex-col gap-4" action="../php/reg-user.php" method="POST">
                    <input class="p-2 mt-8 rounded-2xl border" type="text" name="first_name" placeholder="First name">
                    <input class="p-2 rounded-2xl border" type="text" name="last_name" placeholder="Last name">
                    <input class="p-2 rounded-2xl border" type="email" name="email" placeholder="Email">
                    <div class="relative ">
                        <input class="p-2 rounded-2xl border w-full" type="password" name="pass_word" placeholder="Password">
                        <ion-icon class="absolute top-1/2 right-5 -translate-y-1/2 text-lg" name="eye-outline"></ion-icon>
                    </div>
                    <button class="bg-[#1F0805] rounded-full text-white py-2 hover:scale-105 duration-400" type="submit" name="register">Register</button>
                    <div class="bg-[#1F0805] rounded-full text-white py-2 hover:scale-105 duration-400">
                        <a class="flex justify-center items-center" href="../components/login.php"><ion-icon name="arrow-back-outline"></ion-icon>Go back</a>
                    </div>
                </form>
            </div>

            <div class="hidden md:block w-1/2">
                <a href="../index.php"><img class="hover:scale-110 duration-150 rounded-2xl" src="../img/areu_ok1.jpg" alt=""></a>
            </div>
        </div>
    </section>

    <style>
        .bg-image {
            background-image: url('../img/register1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 2s ease forwards;
        }

        @keyframes fadeIn {
            from {
            opacity: 0;
            }
            to {
            opacity: 1;
            }
        }
        
    </style>
</body>
</html>