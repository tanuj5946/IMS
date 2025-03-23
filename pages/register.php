<?php
session_start();
include '../includes/header.php';
?>
<div class="container mt-5">
    <h2 class="text-center">Register New User</h2>
    <form action="process-register.php" method="POST" class="w-50 mx-auto mt-4">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>