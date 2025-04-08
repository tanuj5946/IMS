<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate input
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    if (empty($name) || empty($category) || $price < 0 || $stock < 0) {
        $_SESSION['error'] = "Invalid input. Please check your data.";
        header("Location: add-product.php");
        exit();
    }

    // Prepare and execute the statement
    $stmt = $conn->prepare("INSERT INTO products (name, category, price, stock) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssdi", $name, $category, $price, $stock);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product added successfully!";
        } else {
            $_SESSION['error'] = "Error adding product: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing statement: " . $conn->error;
    }
}

header("Location: add-product.php");
exit();