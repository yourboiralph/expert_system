<?php
session_start();
$points = [
    0 => 0,
    1 => 1,
    2 => 2, 
    3 => 3
];

$questions = [
    "How often do you feel sad?",
    "How do you feel about the future?",
    "How do you perceive your past successes and failures?",
    "How much satisfaction do you get from daily activities?",
    "How often do you feel guilty?",
    "How do you perceive the possibility of punishment?",
    "How do you feel about yourself?",
    "How do you compare yourself to others?",
    "Have you had thoughts of self-harm or suicide?",
    "How often do you cry?",
    "How easily do you get irritated?",
    "How interested are you in other people?",
    "How well can you make decisions?",
    "How do you perceive your appearance?",
    "How well can you work or be productive?",
    "How is your sleep quality?",
    "How tired do you feel?",
    "How is your appetite?",
    "Have you experienced significant weight loss?",
    "How much do you worry about your physical health?",
    "How has your interest in sex changed?"
];

$answerChoices = [
    ['I do not feel sad.', 'I feel sad.', 'I am sad all the time and I can\'t snap out of it.', 'I am so sad and unhappy that I can\'t stand it.'],
    ['I am not particularly discouraged about the future.', 'I feel discouraged about the future.', 'I feel I have nothing to look forward to.', 'I feel the future is hopeless and that things cannot improve.'],
    ['I do not feel like a failure.', 'I feel I have failed more than the average person.', 'As I look back on my life, all I can see is a lot of failures.', 'I feel I am a complete failure as a person.'],
    ['I get as much satisfaction out of things as I used to.', 'I don\'t enjoy things the way I used to.', 'I don\'t get real satisfaction out of anything anymore.', 'I am dissatisfied or bored with everything.'],
    ['I don\'t feel particularly guilty.', 'I feel guilty a good part of the time.', 'I feel quite guilty most of the time.', 'I feel guilty all of the time.'],
    ['I don\'t feel I am being punished.', 'I feel I may be punished.', 'I expect to be punished.', 'I feel I am being punished.'],
    ['I don\'t feel disappointed in myself.', 'I am disappointed in myself.', 'I am disgusted with myself.', 'I hate myself.'],
    ['I don\'t feel I am any worse than anybody else.', 'I am critical of myself for my weaknesses or mistakes.', 'I blame myself all the time for my faults.', 'I blame myself for everything bad that happens.'],
    ['I don\'t have any thoughts of killing myself.', 'I have thoughts of killing myself, but I would not carry them out.', 'I would like to kill myself.', 'I would kill myself if I had the chance.'],
    ['I don\'t cry any more than usual.', 'I cry more now than I used to.', 'I cry all the time now.', 'I used to be able to cry, but now I can\'t cry even though I want to.'],
    ['I am no more irritated by things than I ever was.', 'I am slightly more irritated now than usual.', 'I am quite annoyed or irritated a good deal of the time.', 'I feel irritated all the time.'],
    ['I have not lost interest in other people.', 'I am less interested in other people than I used to be.', 'I have lost most of my interest in other people.', 'I have lost all of my interest in other people.'],
    ['I make decisions about as well as I ever could.', 'I put off making decisions more than I used to.', 'I have greater difficulty in making decisions more than I used to.', 'I can\'t make decisions at all anymore.'],
    ['I don\'t feel that I look any worse than I used to.', 'I am worried that I am looking old or unattractive.', 'I feel there are permanent changes in my appearance that make me look unattractive.', 'I believe that I look ugly.'],
    ['I can work about as well as before.', 'It takes an extra effort to get started at doing something.', 'I have to push myself very hard to do anything.', 'I can\'t do any work at all.'],
    ['I can sleep as well as usual.', 'I don\'t sleep as well as I used to.', 'I wake up 1-2 hours earlier than usual and find it hard to get back to sleep.', 'I wake up several hours earlier than I used to and cannot get back to sleep.'],
    ['I don\'t get more tired than usual.', 'I get tired more easily than I used to.', 'I get tired from doing almost anything.', 'I am too tired to do anything.'],
    ['My appetite is no worse than usual.', 'My appetite is not as good as it used to be.', 'My appetite is much worse now.', 'I have no appetite at all anymore.'],
    ['I haven\'t lost much weight, if any, lately.', 'I have lost more than five pounds.', 'I have lost more than ten pounds.', 'I have lost more than fifteen pounds.'],
    ['I am no more worried about my health than usual.', 'I am worried about physical problems like aches, pains, upset stomach, or constipation.', 'I am very worried about physical problems, and it\'s hard to think of much else.', 'I am so worried about my physical problems that I cannot think of anything else.'],
    ['I have not noticed any recent change in my interest in sex.', 'I am less interested in sex than I used to be.', 'I have almost no interest in sex.', 'I have lost interest in sex completely.'],
];  

$currentQuestion = isset($_GET['question']) ? (int)$_GET['question'] : 0;
$previousQuestion = ($currentQuestion > 0) ? ($currentQuestion - 1) : 0;
$nextQuestion = ($currentQuestion < count($questions) - 1) ? ($currentQuestion + 1) : $currentQuestion;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answerIndex = isset($_POST['question_' . $currentQuestion]) ? (int)$_POST['question_' . $currentQuestion] : null;

    if ($answerIndex !== null) {
        if (isset($_SESSION['answers'][$currentQuestion]) && $_SESSION['answers'][$currentQuestion] !== $answerIndex) {
            $_SESSION['totalPoints'] -= $points[$_SESSION['answers'][$currentQuestion]];
            $_SESSION['totalPoints'] += $points[$answerIndex];
        } elseif ($_SESSION['answers'][$currentQuestion] === null) {
            $_SESSION['totalPoints'] += $points[$answerIndex];
        }
    }

    $_SESSION['answers'][$currentQuestion] = $answerIndex;

    if (isset($_POST['next'])) {
        if ($_SESSION['answers'][$currentQuestion] === null) {
            echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform">
                    <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Please select an option before proceeding.</h3>
                </div>';
        } else {
            header('Location: questions_answerChoices.php?question=' . $nextQuestion);
            exit();
        }
    } elseif (isset($_POST['submit'])) {
        $unanswered = false;
        foreach ($_SESSION['answers'] as $answer) {
            if ($answer === null) {
                $unanswered = true;
                break;
            }
        }
        if ($unanswered) {
            echo '<div class="absolute inset-x-[38%] inset-y-24 transform">
                    <h3 style="color:red" class="bg-white rounded-full text-center font-medium p-2 z-50">Please make sure to answer all the questions!</h3>
                </div>';
        } else {
            $_SESSION['totalPoints'] = isset($_SESSION['totalPoints']) ? $_SESSION['totalPoints'] : 0;
            $_SESSION['totalScore'] = $_SESSION['totalPoints'];
            header('Location: ../php/main.php');
            exit();
        }
    } elseif (isset($_POST['reset'])) {
        session_destroy();
        header('Location: questions_answerChoices.php?question=0');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <title>Get Started</title>
</head>
<body>
    <?php 
        include '../components/navbar.php';
    ?>
    <div class="w-full h-screen bg-image flex flex-col justify-center items-center">
        <form class="p-5 w-auto shadow-2xl shadow-slate-800 text-xs md:w-7/12 md:text-3xl bg-black bg-opacity-50 rounded-2xl fade-in" method="post" action="questions_answerChoices.php?question=<?php echo $currentQuestion; ?>">
        <strong class="text-slate-400 font-thin md:font-normal text-xs md:text-lg">Question <?php echo $currentQuestion + 1 ?> :</strong> <span class="text-yellow-500 text-sm font-bold md:text-3xl"><?php echo $questions[$currentQuestion]; ?></span><br>

            <?php
                foreach ($answerChoices[$currentQuestion] as $index => $choice) {
                    $checked = isset($_SESSION['answers'][$currentQuestion]) && $_SESSION['answers'][$currentQuestion] == $index ? 'checked' : '';
                    $radioId = 'radio_' . $currentQuestion . '_' . $index;
                    echo '<input type="radio" id="' . $radioId . '" name="question_' . $currentQuestion . '" value="' . $index . '" ' . $checked . '>';
                    echo '<label for="' . $radioId . '" class="text-white text-xs md:text-lg">' . $choice . '</label><br>';
                }
            ?>

            <div class="flex justify-evenly mt-4 md:text-sm">
                <?php
                    if ($currentQuestion > 0) {
                        echo '<a href="?question=' . $previousQuestion . '" class="bg-white bg-opacity-50 text-white p-2 rounded-xl hover:bg-green-300 duration-500">Previous</a> ';
                    }
                    if ($currentQuestion < count($questions) - 1) {
                        echo '<button type="submit" name="next" class="bg-white px-2 md:p-2 rounded-xl md:font-semibold hover:text-white hover:bg-green-300 duration-500">Next</button> ';
                    } else {
                        echo '<input type="submit" name="submit" value="Submit Answers" class="bg-green-300 p-2 rounded-xl font-bold hover:text-white hover:bg-green-600 duration-500">';
                    }
                    echo '<input type="submit" name="reset" value="Reset" class="hover:bg-red-800 hover:text-white duration-500 bg-white bg-opacity-50 font-bold text-red-800 shadow shadow-slate-950 p-2 rounded-xl">';
                ?>
            </div>
        </form>
    </div>

    <style>
        .bg-image {
            background-image: url('../img/sunflower.jpg');
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    const answerText = document.querySelectorAll('.text-white.text-xs');

    function updateTextColor() {
      answerText.forEach((text, index) => {
        if (radioButtons[index].checked) {
          text.classList.add('text-yellow-500');
        } else {
          text.classList.remove('text-yellow-500');
        }
      });
    }

    updateTextColor();

    radioButtons.forEach((radio, index) => {
      radio.addEventListener('change', function () {
        updateTextColor();
      });
    });
  });
</script>
</body>
</html>