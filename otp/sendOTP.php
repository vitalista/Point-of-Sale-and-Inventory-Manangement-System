<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Set up PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '@gmail.com';
$mail->Password = ''; // App script password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

try {
    // Generate OTP
    $otp = 123456;
    $_SESSION['otp'] = $otp;
    // Email content
    $mail->setFrom('@gmail.com', 'M&J Paint Enterprises');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP for Verification';
    $message = "Your OTP for verification is: . $otp. Please note that you only have 3 attempts and it's valid for 1 minute. Use it wisely.";
    $mail->Body    = $message;

    $mail->send();
    


} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
