<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Checkout</title></head>
<body>
    <h2>Checkout</h2>
    <p>Thank you for your purchase!</p>
    <?php unset($_SESSION['cart']); ?>
    <a href="billing.php">Back to Billing</a>
</body>
</html>