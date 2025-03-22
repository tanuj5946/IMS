<?php
session_start();
include 'includes/db_connect.php';

if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($product = $result->fetch_assoc()) {
        $_SESSION['cart'][] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'qty' => 1
        ];
    }
    $stmt->close();
}
header("Location: cart.php");
exit();
