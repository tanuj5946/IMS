<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

// Redirect if request is not POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /login");
    exit;
}

// Sanitize input
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Check if fields are filled
if (empty($email) || empty($password)) {
    header("Location: /login?error=" . urlencode("Please fill in all fields."));
    exit;
}

try {
    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Redirect to dashboard
        header("Location: /dashboard");
        exit;
    } else {
        // Login failed
        header("Location: /login?error=" . urlencode("Invalid email or password."));
        exit;
    }

} catch (PDOException $e) {
    // Log error if needed
    error_log("Database error during login: " . $e->getMessage());
    header("Location: /login?error=" . urlencode("Something went wrong. Please try again later."));
    exit; 
}
?>
