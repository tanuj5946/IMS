<?php
// forgot-password.php
require_once __DIR__ . '../includes/db_connect.php'; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error = "Please enter your email.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Generate token
            $token = bin2hex(random_bytes(50));
            $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

            // Store token in DB (you need to create `password_resets` table)
            $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $token, $expires);
            $stmt->execute();

            // Show reset link (simulate sending email)
            $resetLink = "http://localhost/IMS/pages/reset-password.php?token=" . $token;
            echo "Password reset link (simulate sending email): <a href='$resetLink'>$resetLink</a>";
            exit;
        } else {
            $error = "No user found with that email.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - M K Kirana Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <header class="text-center">
            <h1>Forgot Password</h1>
            <p>Enter your email to reset your password</p>
        </header>
        
        <main class="mt-4">
            <form action="forgot-password.php" method="POST" class="text-center">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Enter your email" required />
                </div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">Back to Login</a>
            </div>
        </main>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> M K Kirana Store. All rights reserved.</p>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
