<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php';  // Ensure this path is correct for your setup

// Redirect if request is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pages/login.php");
    exit;
}

// Sanitize input
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Check if fields are filled
if (empty($email) || empty($password)) {
    header("Location: pages/login.php?error=" . urlencode("Please fill in all fields."));
    exit;
}

try {
    // Prepare and execute query. Make sure your database column name is 'email'
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirect to dashboard (adjust path if necessary)
        header("Location: dashboard.php");
        exit;
    } else {
        // Login failed
        header("Location: pages/login.php?error=" . urlencode("Invalid email or password."));
        exit;
    }

} catch (PDOException $e) {
    // Log error if needed
    error_log("Database error during login: " . $e->getMessage());
    header("Location: pages/login.php?error=" . urlencode("Something went wrong. Please try again later."));
    exit;
}
?>