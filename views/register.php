<?php
include __DIR__ . '/../includes/header.php';
?>

<div class="container">
    <div class="translucent-box mt-5">
        <h2 class="text-center">Register New User</h2>
        <form action="/insert-user" method="POST" class="w-75 mx-auto mt-4">
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
        <div class="text-center mt-3">
            <p>Already have an account? <a href="/login">Log in here</a></p>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mt-3"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success mt-3"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>
