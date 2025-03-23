<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M K Kirana Store - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>IMS</h1>
            <p>Inventory Management System</p>
        </header>
        
        <main>
            <?php
            // Display error message if set
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']); // Clear the message after displaying
            }
            ?>
            <form action="authenticate.php" method="POST" class="text-center">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" class="form-control" placeholder="Enter your username" type="text" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input id="password" name="password" class="form-control" placeholder="Enter your password" type="password" required />
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">Show</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="mt-3">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
            </form>
        </main>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> M K Kirana Store. All rights reserved.</p>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const button = event.currentTarget;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                button.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                button.textContent = 'Show';
            }
        }
    </script>
</body>
</html>