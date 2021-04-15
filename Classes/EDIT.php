<?php
session_start();
include 'Admin.php';
$admin = new Admin();
$productName = $_POST['productName'];
$paymentName = $_POST['paymentName'];
$price = $_POST['price'];
$investment = $_POST['investment'];
$submitionDate = $_POST['submitionDate'];
$achievementID = $_SESSION['achievementID'];
$admin->editEmployeeMonthlyAchievements($productName,$price,$paymentName,$investment,$submitionDate,$achievementID);
?>