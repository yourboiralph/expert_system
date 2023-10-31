<?php
session_start();
if(isset($_SESSION['totalPoints'])){
    $totalPoints = $_SESSION['totalPoints'];
    // You can use the $totalPoints variable here
    echo "Total Points from another file: " . $totalPoints;
} else {
    echo "Total Points are not set yet.";
}
?>