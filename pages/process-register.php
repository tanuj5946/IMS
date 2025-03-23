<?php
session_start();
include 'includes/db_connect.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT); // Secure hashing
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful!";
    } else {
        $_SESSION['error'] = "Username already taken!";
    }

    $stmt->close();
}

header("Location: login.php");
exit();
