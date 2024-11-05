<?php
require 'system/config/function.php';

unset($_SESSION['LoggedIn']);
unset($_SESSION['LoggedInUser']);


$sessionProducts = [];


unset($sessionProducts['otp']);
unset($sessionProducts['otp_attempts']);
unset($sessionProducts['Items']);
unset($sessionProducts['ItemIds']);
unset($sessionProducts['productItems']);
unset($sessionProducts['productItemIds']);


if (!isset($_SESSION['LoggedIn'])) {

    session_destroy();

    header('Location: index.php');
} else {
    
    header('Location: homepage.php');
    exit; 
}
?>
