<?php
// No session_start() — handled in router
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/mailer.php';
include __DIR__ . '/../includes/header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $otp = rand(100000, 999999);
            $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

            $stmt = $pdo->prepare("REPLACE INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
            $stmt->execute([$email, $otp, $expires_at]);

            $subject = "Your OTP for Password Reset";
            $body = "Your OTP is: <b>$otp</b>. It is valid for 5 minutes.";

            if (sendEmail($email, $subject, $body)) {
                $_SESSION['reset_email'] = $email;
                header("Location: /verify-otp");
                exit;
            } else {
                $error = "Failed to send OTP. Please try again later.";
            }
        } else {
            $error = "No user found with that email address.";
        }
    }
}
?>

<div class="container">
    <div class="translucent-box mt-5">
        <h2 class="text-center">Forgot Your Password?</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/forgot-password" method="POST" class="w-75 mx-auto mt-4">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send OTP</button>
        </form>

        <div class="text-center mt-3">
            <p>Remember your password? <a href="/login">Log in here</a></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
