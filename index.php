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
        <div class="mx-5 md:mx-none">
            <div class="md:mb-44 md:pb-10 md:ml-24">
                <h1 class="md:text-4xl font-bold italic bg-clip-text text-transparent bg-gradient-to-l from-slate-600 to-[#864A27]">"Depression is being colorblind and constantly <br class="hidden md:block">told how colorful the world is." <span class="text-xs md:text-lg text-slate-100 font-bold"><br>- Atticus Poetry</span></h1>
            </div>
            <div class="md:items-start">
                <p class="md:text-lg font-semibold md:ml-24 text-[#99562C]">Begin Your Journey to Understanding <br>Your Mental Health.</p>
                <a href="./components/questions_answerChoices.php" class="button md:ml-24 md:text-3xl text-slate-100 hover:text-[#99562C]">Get Started</a>
            </div>
        </div>
    </div>

    <style>
        .bg-image {
            background-image: url('./img/gloom1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</body>
</html>