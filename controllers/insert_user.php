<?php
session_start();
include __DIR__ . '/../includes/db_connect.php';

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
            header("Location: /login"); // Redirect to login after successful registration
            exit();
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: /register"); // Redirect back to registration page on failure
            exit();
        }

    } catch (PDOException $e) {
        // If the email column is UNIQUE, inserting a duplicate triggers an error code 23000
        if ($e->getCode() == 23000) {
            $_SESSION['error'] = "Email already taken!";
        } else {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
        header("Location: /register"); // Redirect back to registration page on error
        exit();
    }
} else {
    $_SESSION['error'] = "Please fill out all fields!";
    header("Location: /register"); // Redirect back to registration page if fields are empty
    exit();
}
?>