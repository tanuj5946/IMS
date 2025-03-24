<?php
session_start();

// Unset all session variables and destroy session
$_SESSION = [];
session_destroy();

// Optionally clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// ⚠️ Do NOT use header() redirect here — let HTML + JS handle it
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging Out...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('../assets/images/background.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logout-message {
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            animation: fadeInZoom 0.8s ease-in-out;
        }

        @keyframes fadeInZoom {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    <script>
        // Redirect to login after 3 seconds
        setTimeout(function() {
            window.location.href = 'login.php'; // adjust if needed
        }, 3000);
    </script>
</head>
<body>
    <div class="logout-message">
        <h2>You have been logged out</h2>
        <p>Redirecting to login page...</p>
        <div class="spinner-border text-primary mt-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</body>
</html>
