<?php
// reset-password.php
require_once __DIR__ . '/includes/db_connect.php';

$token = $_GET['token'] ?? '';
if (empty($token)) {
    die("Invalid or missing token.");
}

// Step 1: Check if token exists and not expired
$stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$reset = $result->fetch_assoc();

if (!$reset) {
    die("Token is invalid or expired.");
}

// Step 2: Handle password reset form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($new_password) || empty($confirm_password)) {
        $error = "Please fill in both password fields.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in `users` table
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $reset['email']);
        $stmt->execute();

        // Delete used token
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->bind_param("s", $reset['email']);
        $stmt->execute();

        echo "<p>Password has been reset successfully. <a href='login.php'>Login here</a></p>";
        exit;
    }
}
?>

<!-- HTML FORM -->
<h2>Reset Your Password</h2>
<form method="POST">
    <input type="password" name="password" placeholder="New Password" required><br><br>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br><br>
    <button type="submit">Reset Password</button>
</form>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
