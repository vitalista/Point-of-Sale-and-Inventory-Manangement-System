<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../system/local-cdn/alertify.min.css">
    <title>OTP</title>
</head>
<body style="
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url('../system/images/loginbackground.jpg');">

<?php

@session_start();


if(!isset($_SESSION['otp'])){
    echo "<script>window.location.href = '../index2.php';</script>";
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    if (!isset($_SESSION['otp_attempts'])) {
        $_SESSION['otp_attempts'] = 1;
    } else {
        $_SESSION['otp_attempts']++;
    }

    if ($_SESSION['otp_attempts'] > 2) {
        echo '<script>alert("You have been used 3 attempts you will be redirect back to Login Page"); window.location.href = "../index.php";</script>';
        exit();
    }

    
$otpRan = $_SESSION['otp'];

$num1 = $_POST['1'];
$num2 = $_POST['2'];
$num3 = $_POST['3'];
$num4 = $_POST['4'];
$num5 = $_POST['5'];
$num6 = $_POST['6'];

$otpInput = $num1.$num2.$num3.$num4.$num5.$num6;  
$otpNumber = intval($otpInput);

if($otpRan === $otpNumber){
    header('Location: ../system/homepage.php');
}else{
echo '<script> window.location.href = "../index2.php";</script>';
}
    
} else {
   echo '<script>alert("You have been used 3 attempts you will be redirect back to Login Page"); window.location.href = "../index.php";</script>';
}
?>

<script src="../system/local-cdn/alertify.min.js"></script>
</body>
</html>
