<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M K Kirana Store - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let errorContainer = document.getElementById("error-container");
        let progressBar = document.getElementById("error-progress");

        if (errorContainer && progressBar) {
            let duration = 3000; // 3 seconds
            let interval = 50; // Update every 50ms
            let width = 100; // Initial width of progress bar

            let timer = setInterval(function () {
                width -= (100 / (duration / interval)); // Decrease width gradually
                progressBar.style.width = width + "%"; 

                if (width <= 0) {
                    clearInterval(timer);
                    errorContainer.style.display = "none"; // Hide the error message
                }
            }, interval);
        }
    });
</script>

<body>

    <div class="container">
        <div class="translucent-box">
            <header class="mb-4">
                <h1>IMS</h1>
                <p>Inventory Management System</p>
            </header>

            <main>
            <?php
// Display error message if set in session or via GET parameter
            if (isset($_SESSION['error'])) {
                echo '<div id="error-container" class="alert alert-danger text-center">
                        <span id="error-message">' . $_SESSION['error'] . '</span>
                        <div class="progress mt-2">
                            <div id="error-progress" class="progress-bar bg-danger" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>';
                unset($_SESSION['error']);
            } elseif (isset($_GET['error'])) {
                echo '<div id="error-container" class="alert alert-danger text-center">
                        <span id="error-message">' . htmlspecialchars($_GET['error']) . '</span>
                        <div class="progress mt-2">
                            <div id="error-progress" class="progress-bar bg-danger" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>';
            }
            ?>


                <form action="../authenticate.php" method="POST" class="text-center">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" class="form-control" placeholder="Enter your email" type="text"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" name="password" class="form-control" placeholder="Enter your password"
                                type="password" required />
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">Show</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="mt-3">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    <div class="mt-2">
                        <a href="register.php">Don’t have an account? Sign up</a>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> M K Kirana Store. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Password Toggle Script -->
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

        document.addEventListener("DOMContentLoaded", function () {
            let errorMessage = document.querySelector(".alert-danger"); // Select the error message

            if (errorMessage) {
                setTimeout(function () {
                    errorMessage.style.display = "none"; // Hide the error message
                }, 3000); // 3 seconds delay
            }
        });
    </script>
</body>

</html>
