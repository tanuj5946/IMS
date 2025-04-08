<?php
session_start();
include '../includes/header.php';
?>

<!-- Page Background and Centering -->
<div class="d-flex justify-content-center align-items-center vh-100" style="background: url('../assets/images/background.png') no-repeat center center fixed; background-size: cover;">

    <?php if (isset($_SESSION['message'])): ?>
        <div class="translucent-box text-center">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
            <h3 class="mt-3 text-success">Success!</h3>
            <p class="mt-2" style="font-size: 1.1rem;">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </p>
            <a href="/login" class="btn btn-success mt-3">Go to Login</a>
        </div>
    <?php else: ?>
        <div class="translucent-box text-center">
            <h4>No message to show.</h4>
            <a href="/login" class="btn btn-secondary mt-3">Back to Login</a>
        </div>
    <?php endif; ?>

</div>

<?php include '../includes/footer.php'; ?>
