<?php

include __DIR__ . '/../includes/header.php';


// Redirect if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: /dashboard");
    exit();
}

$error = $_SESSION['error'] ?? ($_GET['error'] ?? '');
unset($_SESSION['error']);
?>

<div class="container">
    <div class="translucent-box">
        <h2 class="text-center mb-4">Login</h2>

        <?php if (!empty($error)) : ?>
            <div id="error-container" class="alert alert-danger text-center">
                <span id="error-message"><?= htmlspecialchars($error) ?></span>
                <div class="progress mt-2">
                    <div id="error-progress" class="progress-bar bg-danger" role="progressbar" style="width: 100%;"></div>
                </div>
            </div>
        <?php endif; ?>

        <form action="/authenticate" method="POST" class="w-100 position-relative" onsubmit="showSpinner()">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required />
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">Show</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="form-overlay" id="form-overlay">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>

        <div class="text-center mt-3">
            <p><a href="/forgot-password">Forgot your password?</a></p>
            <p>Don't have an account? <a href="/register">Register here</a></p>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>

