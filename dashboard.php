<?php
session_start();

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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            background: #f8f9fa;
            color: #333;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #6f42c1;
            color: white;
            padding: 20px;
            position: fixed;
            transition: all 0.3s;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #5a32a3;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
            width: 100%;
        }
        .card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: linear-gradient(135deg, #6f42c1, #9b6ed6);
            color: white;
            border: none;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .filter-btns button {
            background: #6f42c1;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .filter-btns button:hover {
            background: #5a32a3;
        }
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        /* Dark Mode */
    .dark-mode {
        background: #1e1e2e;
        color: #ffffff;
    }
    .dark-mode .card {
        background: #28283d;
        color: #ffffff;
    }
    .dark-mode .sidebar {
        background: #12121c;
    }
    .dark-mode .sidebar a:hover, .dark-mode .sidebar a.active {
        background: #28283d;
    }
    #darkModeToggle {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 1000;
}

    </style>
</head>
<body>
    <div class="sidebar">
        <h3>M . K. Kirana Store - Admin</h3>
        <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="#"><i class="fas fa-box"></i> Products</a>
        <a href="#"><i class="fas fa-list"></i> Categories</a>
        <a href="#"><i class="fas fa-users"></i> Users</a>
        <a href="#"><i class="fas fa-chart-bar"></i> Reports</a>
    </div>
    <div class="content">
        <button id="darkModeToggle" class="btn btn-dark">🌙 Dark Mode</button>
        <h2 class="text-center">Admin Dashboard</h2>
        <div class="text-center filter-btns mb-3">
            <button>Day</button>
            <button>Week</button>
            <button>Month</button>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>Orders</h4>
                    <p id="orderCount">0</p> <!-- Updated ID for dynamic update -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <i class="fas fa-dollar-sign"></i>
                    <h4>Revenue</h4>
                    <p id="revenueCount">₹ 0</p> <!-- Updated ID for dynamic update -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <i class="fas fa-user"></i>
                    <h4>Users</h4>
                    <p id="userCount">0</p> <!-- Updated ID for dynamic update -->
                </div>
            </div>
        </div>
        <div class="chart-container mt-4">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script>
    let lastData = {}; // Store last fetched data

function fetchStats() {
    fetch('fetch_stats.php')
        .then(response => response.json())
        .then(data => {
            // Only update if data has changed
            if (JSON.stringify(data) !== JSON.stringify(lastData)) {
                document.getElementById('orderCount').innerText = data.orders;
                document.getElementById('revenueCount').innerText = '₹' + parseFloat(data.revenue).toFixed(2);
                document.getElementById('userCount').innerText = data.users;

                lastData = data; // Save new data
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data every 5 seconds
setInterval(fetchStats, 5000);
fetchStats(); // Run once on page load
document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const body = document.body;

    // Check localStorage for dark mode preference
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        darkModeToggle.innerText = "☀️ Light Mode";
    }

    darkModeToggle.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
            darkModeToggle.innerText = "☀️ Light Mode";
        } else {
            localStorage.setItem("darkMode", "disabled");
            darkModeToggle.innerText = "🌙 Dark Mode";
        }
    });
});
    </script>
</body>
</html>