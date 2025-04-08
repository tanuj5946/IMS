<?php
// session_start();
require_once '../includes/db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['reset_email'] ?? '';
    $entered_otp = $_POST['otp'];

    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE email = ? AND token = ? AND expires_at > NOW()");
    $stmt->execute([$email, $entered_otp]);
    $match = $stmt->fetch();

    if ($match) {
        $_SESSION['otp_verified'] = true;
        header("Location: /reset-password");
        exit;
    } else {
        $error = "Invalid or expired OTP.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body {
            background: url('/assets/images/background.png') no-repeat center center fixed;
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

        .otp-input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            margin: 0 5px;
        }

        .otp-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="translucent-box">
    <h2 class="text-center mb-4">Enter OTP</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/verify-otp" onsubmit="combineOTP()">
        <div class="otp-group">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <input type="text" class="form-control otp-input" maxlength="1" pattern="\d" required oninput="moveNext(this, <?= $i ?>)" id="otp<?= $i ?>">
            <?php endfor; ?>
        </div>

        <input type="hidden" name="otp" id="otp">
        <button type="submit" class="btn btn-success w-100">Verify OTP</button>
    </form>
</div>

<script>
    function moveNext(el, index) {
        const next = document.getElementById('otp' + (index + 1));
        if (el.value.length === 1 && next) {
            next.focus();
        }
    }

    function combineOTP() {
        let otp = '';
        for (let i = 1; i <= 6; i++) {
            otp += document.getElementById('otp' + i).value;
        }
        document.getElementById('otp').value = otp;
    }

    // Auto-focus first input
    window.onload = () => document.getElementById('otp1').focus();
</script>
</body>
</html>