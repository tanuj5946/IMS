<?php
session_start();
include '../includes/header.php';
?>

<div class="container">
    <div class="translucent-box mt-5">
        <h2 class="text-center">Register New User</h2>
        <form action="process-register.php" method="POST" class="w-75 mx-auto mt-4">
            <div class="mb-3 text-start">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
    </div>
</div>
<?php include '../includes/footer.php'; ?>