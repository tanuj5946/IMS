<?php if (session_status() === PHP_SESSION_NONE)
  session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>M K Kirana Store</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector("form");
        const overlay = document.createElement("div");
        overlay.className = "form-overlay";
        overlay.innerHTML = `<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>`;
        form.parentNode.appendChild(overlay);

        form.addEventListener("submit", function () {
            overlay.style.display = "flex";
        });
    });
</script>

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
          <li class="nav-item"><a class="nav-link" href="../pages/login.php">Login</a></li>

        </ul>
      </div>
    </div>
  </nav>
</body>

</html>