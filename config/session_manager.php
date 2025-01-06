<?php
session_start();
require "../config/sample_class.php";
$conn = new sample_class();

if (!isset($_SESSION['ID_No'])) {
    header("Location: ./residentdashboard.php");
    exit();
} 

$timeout_duration = 1000; 

if (isset($_COOKIE['last_activity']) && (time() - $_COOKIE['last_activity'] > $timeout_duration)) {
    session_unset();
    session_destroy();
    setcookie("last_activity", "", time() - 3600);
    header("Location: login.php?message=Session Timeout");
    exit();
}

setcookie("last_activity", time(), time() + $timeout_duration);

$ID_No = trim($_SESSION['ID_No']);
$user = $conn->fetchUser($ID_No);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php?message=Session expired");
    exit();
}
$_SESSION['user_data'] = $user;
