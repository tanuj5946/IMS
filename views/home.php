<?php
include '../includes/header.php'; // Adjust path if header moves
?>

<body>
    
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
                        <a href="/login" class="btn btn-primary animate__animated animate__pulse animate__infinite">Login</a>
                        <a href="/register" class="btn btn-primary animate__animated animate__pulse animate__infinite">Register</a>
                    </div>
                </section>
            </main>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>