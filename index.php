<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/output.css">
    <title>Home</title>
</head>
<body class="h-screen">
    <?php 
        include './components/navbar.php';
    ?>

    <div class="w-full h-screen bg-image flex flex-col justify-center">
        <div class="mx-5 md:mx-none fade-in">
            <div class="md:mb-44 md:pb-10 md:ml-24">
                <h1 class="md:text-4xl font-bold italic bg-clip-text text-transparent bg-gradient-to-l from-slate-600 to-[#864A27]">"Depression is being colorblind and constantly <br class="hidden md:block">told how colorful the world is." <span class="text-xs md:text-lg text-slate-100 font-bold"><br>- Atticus Poetry</span></h1>
            </div>
            <div class="md:items-start">
                <p class="md:text-lg font-semibold md:ml-24 md:mb-5 text-[#99562C]">Begin Your Journey to Understanding <br>Your Mental Health.</p>
                <a href="./components/visibility.php" class="button font-semibold text-white bg-yellow-950 shadow-2xl shadow-black px-2 rounded-xl hover:text-[#faf761] md:ml-24 md:text-3xl">Get Started</a>
            </div>
        </div>
    </div>

        <?php 
            include './components/footer.php';    
        ?>

    <style>
        .bg-image {
            background-image: url('./img/gloom1.jpg');
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
