<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php'; // defines $pdo

$error = ''; // Initialize error variable

// Retrieve token from GET
$token = $_GET['token'] ?? '';
if (empty($token)) {
    $error = "Invalid or missing token.";
} else {
    try {
        // 1) Check if token is valid and not expired
        $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$token]);
        $reset = $stmt->fetch();

        if (!$reset) {
            $error = "Token is invalid or has expired.";
        } else {
            // 2) If form is submitted, handle new password
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $new_password = trim($_POST['password'] ?? '');
                $confirm_password = trim($_POST['confirm_password'] ?? '');

                if (empty($new_password) || empty($confirm_password)) {
                    $error = "Please fill in both password fields.";
                } elseif ($new_password !== $confirm_password) {
                    $error = "Passwords do not match.";
                } else {
                    // 3) Hash the new password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // 4) Update the user's password in `users` table
                    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                    $stmt->execute([$hashed_password, $reset['email']]);

                    // 5) Delete the used token to prevent reuse
                    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = ?");
                    $stmt->execute([$reset['email']]);

                    echo "<p>Password has been reset successfully. <a href='login.php'>Login here</a></p>";
                    exit;
                }
            }
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Reset Your Password</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Show the form ONLY if there's no error and we have a valid reset token -->
        <?php if (empty($error) && !empty($reset)): ?>
            <form method="POST" class="mt-4">
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>