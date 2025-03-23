<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M K Kirana Store - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background: url('assets/images/background.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .translucent-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
            text-align: center;
        }
        .container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        footer {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark animate__animated animate__fadeInDown w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">M K Kirana Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>

                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container homepage-container animate__animated animate__fadeIn">
        <div class="translucent-box">
            <header>
                <h1 class="animate__animated animate__bounceIn">Welcome to M K Kirana Store</h1>
                <p>Your one-stop solution for Inventory Management</p>
            </header>
            
            <main>
                <section id="about" class="my-5 animate__animated animate__fadeInLeft">
                    <h2>About Our System</h2>
                    <p>The Inventory Management System (IMS) helps manage your inventory efficiently. Track stock levels, manage orders, and generate reports with ease.</p>
                </section>
                
                <section id="get-started" class="my-5 animate__animated animate__fadeInRight">
                    <h2>Get Started</h2>
                    <p>Click below to log in and start managing your inventory.</p>
                    <div class="homepage-buttons">
                        <a href="login.php" class="btn btn-primary animate__animated animate__pulse animate__infinite">Login</a>
                        <a href="register.php" class="btn btn-primary animate__animated animate__pulse animate__infinite">Register</a>
                    </div>
                </section>
            </main>
        </div>
    </div>
    
    <footer class="bg-dark text-white text-center py-3 animate__animated animate__fadeInUp">
        <p>&copy; <?php echo date('Y'); ?> M K Kirana Store. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
