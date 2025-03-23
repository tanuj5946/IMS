<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>M K Kirana Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/index.php">M K Kirana Store</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/IMS/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/IMS/login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="/IMS/register.php">Register</a></li>
      </ul>
    </div>
  </div>
</nav>