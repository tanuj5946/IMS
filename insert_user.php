<?php
// Include your database connection
include 'includes/db_connect.php';

// User data to insert
$name = "Test User";
$email = "test@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT); // securely hash the password

// Prepare and execute insert query
$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        echo "✅ Test user created successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "❌ Statement preparation failed: " . $conn->error;
}

$conn->close();
?>
