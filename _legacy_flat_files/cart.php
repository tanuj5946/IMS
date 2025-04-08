<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Cart</title></head>
<body>
    <h2>Your Cart</h2>
    <table border="1">
        <tr><th>Product</th><th>Price</th><th>Qty</th></tr>
        <?php foreach ($_SESSION['cart'] ?? [] as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['qty'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="checkout.php">Checkout</a>
</body>
</html>