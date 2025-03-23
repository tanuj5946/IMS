<?php
session_start();
include '../includes/db_connect.php';  // This file defines $pdo

// Retrieve POST data
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Only proceed if both fields are provided
if ($email && $password) {
    try {
        // Securely hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement using PDO
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");

        // Execute the statement with bound parameters
        $success = $stmt->execute([
            ':email' => $email,
            ':password' => $hash
        ]);

        if ($success) {
            $_SESSION['success'] = "Registration successful!";
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
        }

    } catch (PDOException $e) {
        // If the email column is UNIQUE, inserting a duplicate triggers an error code 23000
        if ($e->getCode() == 23000) {
            $_SESSION['error'] = "Email already taken!";
        } else {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    }
} else {
    $_SESSION['error'] = "Please fill out all fields!";
}

// Redirect to the login page after processing
header("Location: login.php");
exit();
