<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="./dist/output.css" rel="stylesheet">
    <title>Navbar</title>
</head>
<body>
    <?php
        $isIncludedInAboutUs = (basename($_SERVER['PHP_SELF']) === 'aboutus.php' || basename($_SERVER['PHP_SELF']) === 'result.php');
    ?>
    <nav class="p-2 shadow-md fixed w-full <?php echo $isIncludedInAboutUs ? 'bg-white bg-opacity-70' : ''; ?> md:p-5 md:py-0 md:flex md:items-center md:justify-between">
        <div class="flex justify-between items-center ml-10">
            <a href="/Appdev/index.php"><img src="/Appdev/img/untangled1.png" alt="Untangled" class="w-[30%] h-[30%] md:w-[30%] md:h-[15%]"></a>
            
            <span class="text-xl cursor-pointer mx-5 transition duration-100 text-black hover:text-white md:hidden block">
                <ion-icon name="grid-outline" onclick="Menu(this)"></ion-icon>
            </span>
        </div>
        <ul class="text-xs text-center font-bold mt-0 mr-4 right-7 grid gap-y-4 z-[40] absolute rounded-3xl p-5 opacity-0 top-[-400px] transition-all ease-in duration-500 md:text-lg md:flex md:mt-0 md:items-center md:flex-row md:gap-x-10 md:z-auto md:static md:w-auto md:opacity-100">
            <li><a href="/Appdev/index.php" class="hover:text-[#B8764B] duration-500 md:hover:text-[#B8764B] button">Home</a></li>
            <li><a href="/Appdev/components/aboutus.php" class="hover:text-[#B8764B] duration-500 md:hover:text-[#B8764B] button">About us</a></li> 
            <!-- <li><a href="contact.php" class="hover:text-[#B8764B] duration-500 md:hover:text-[#B8764B] button">Contact us</a></li> -->
            <!-- <button class="shadow-[#B8764B] p-2 rounded-2xl hover:scale-125 duration-300 text-[#B8764B] hover:text-[#DAC5B7]"><a href="/Appdev/components/login.php">Login</a></button> -->
        </ul>
    </nav>

    <?php 
        include './footer.php';    
    ?>

    <style>
        .button {
            position: relative;
            overflow: hidden;
        }

        .button::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: currentColor;
            transition: width 0.5s ease;
        }

        .button:hover::before {
            width: 100%;
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

    <script>
        function Menu(e){
        let list = document.querySelector('ul');
        e.name === 'grid-outline' ? (e.name = "grid",list.classList.add('top-[80px]') , list.classList.add('opacity-100')) :( e.name = "grid-outline" ,list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'))
        }
    </script>
</body>
</html>