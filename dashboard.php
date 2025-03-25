<?php
session_start();

// Include header from the same directory level
// include 'includes/header.php';

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M K Kirana Store - Dashboard</title>
    <!-- Assuming dashboard.css is in lms-inventory/assets/css/ -->
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <script defer src="assets/scripts/dashboard.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Welcome to the Dashboard</h1>
            <p>Your Inventory Management System</p>
        </header>
        <main class="dashboard-body">
            <section class="dashboard-stats">
                <div class="stat-card">
                    <h2>Total Products</h2>
                    <p id="total-products">0</p>
                </div>
                <div class="stat-card">
                    <h2>Low Stock Alerts</h2>
                    <p id="low-stock-alerts">0</p>
                </div>
                <div class="stat-card">
                    <h2>Sales Today</h2>
                    <p id="sales-today">0</p>
                </div>
            </section>
            <section class="dashboard-actions">
                <h2>Quick Actions</h2>
                <div class="dashboard-buttons">
                    <a href="pages/logout.php" class="button">Logout</a>
                </div>
            </section>
        </main>
        <footer class="dashboard-footer">
            <p>&copy; <?php echo date('Y'); ?> M K Kirana Store. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
