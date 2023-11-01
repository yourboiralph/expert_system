<?php
session_start();
if(isset($_SESSION['totalPoints'])){
    $totalPoints = $_SESSION['totalPoints'];
    echo "Total Points from another file: " . $totalPoints;
} else {
    echo "Total Points are not set yet.";
}
?>