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
                    $_SESSION['message'] = 'Your password has been reset successfully!';
                    header('Location: reset-message.php');

                    // echo "<p>Password has been reset successfully. <a href='login.php'>Login here</a></p>";
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
    <link href="../assets/css/styles.css" rel="stylesheet">
    <!-- <style>
        body {
            background: url('../assets/images/background.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .translucent-box {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 90%;
            animation: fadeSlide 0.7s ease-out;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style> -->
</head>

<body>
    <div class="translucent-box">
        <h2 class="text-center mb-4">Reset Your Password</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (empty($error) && !empty($reset)): ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>