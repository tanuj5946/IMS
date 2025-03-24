<?php
session_start();

// 1) Load PDO connection and Composer autoloader
require_once __DIR__ . '/../includes/db_connect.php'; // defines $pdo
require_once __DIR__ . '/../vendor/autoload.php';     // Composer autoloader

// 2) Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 3) Load environment variables from .env (optional, if you store mail creds there)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email)) {
        $error = "Please enter your email.";
    } else {
        try {
            // Check if user exists in 'users' table
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Generate reset token & expiry (1 hour from now)
                $token = bin2hex(random_bytes(50));
                $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

                // Insert/Update token in 'password_resets' table
                $stmt2 = $pdo->prepare("
                    INSERT INTO password_resets (email, token, expires_at)
                    VALUES (?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                        token = VALUES(token),
                        expires_at = VALUES(expires_at),
                        created_at = CURRENT_TIMESTAMP
                ");
                $stmt2->execute([$email, $token, $expires]);

                // Construct reset link
                // NOTE: 192.168.1.1 may change if your router reassigns IPs (in cmd ipconfig)
                // If you prefer local testing on the same machine, use: http://localhost/...
                $resetLink = "http://localhost/Ims-inventory/pages/reset-password.php?token={$token}";

                // 4) Send email with PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // SMTP settings (from .env or hardcoded)
                    $mail->isSMTP();
                    $mail->Host = $_ENV['MAIL_HOST'];       // e.g. smtp.gmail.com
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['MAIL_USERNAME'];   // e.g. your-gmail@gmail.com
                    $mail->Password = $_ENV['MAIL_PASSWORD'];   // e.g. app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = $_ENV['MAIL_PORT'];       // e.g. 587

                    // No-Reply setup
                    $mail->setFrom('noreply.yourname@gmail.com', 'No Reply');
                    $mail->clearReplyTos(); // remove default reply-to
                    $mail->addCustomHeader("Auto-Submitted: auto-generated");
                    $mail->addCustomHeader("X-Auto-Response-Suppress: All");

                    // if you want reply by users go to specific email 
                    // Use a "From" address that you monitor
                    // $mail->setFrom('support@yourdomain.com', 'Support Team');

                    // Add a Reply-To if you want replies to go somewhere specific
                    // $mail->addReplyTo('support@yourdomain.com', 'Support Team');


                    // Recipient
                    $mail->addAddress($email);

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Reset Request';
                    $mail->Body = "
                        <p>Hello,</p>
                        <p>You requested a password reset. Please click the link below to reset (valid for 1 hour):</p>
                        <p><a href='{$resetLink}'>{$resetLink}</a></p>
                        <p>If you did not request this, ignore this email.</p>
                    ";

                    $mail->send();
                    echo "<p>A password reset link has been sent to your email.</p>";
                    exit;
                } catch (Exception $e) {
                    $error = "Email could not be sent. Mailer Error: " . $mail->ErrorInfo;
                }
            } else {
                $error = "No user found with that email.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <div class="container mt-5">
     <div class="translucent-box">
        <h1>Forgot Password</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="email" class="form-label">Enter your email address:</label>
                <input type="email" name="email" id="email" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </form>
        <div class="mt-3">
            <a href="login.php">Back to Login</a>
        </div>
     </div>    
    </div>
</body>

</html>