<?php
session_start();
require_once '../includes/db_connect.php';
require_once '../includes/mailer.php';

$email = $_POST['email'];
$otp = rand(100000, 999999);
$expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    $stmt = $pdo->prepare("REPLACE INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$email, $otp, $expires_at]);

    $subject = "Your OTP for Password Reset";
    $body = "Your OTP is: <b>$otp</b>. It is valid for 5 minutes.";

    if (sendEmail($email, $subject, $body)) {
        $_SESSION['reset_email'] = $email;
        header("Location: verify-otp.php");
        exit;
    } else {
        echo "Failed to send OTP.";
    }
} else {
    echo "Email not found.";
}
?>
