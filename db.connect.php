<?php
// Database configuration
$host = 'localhost'; // Database host
$username = 'your_username'; // Database username
$password = 'your_password'; // Database password
$database = 'your_database'; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally set the character set to UTF-8
$conn->set_charset("utf8");

// You can also define a function to close the connection if needed
function closeConnection($conn) {
    $conn->close();
}
?>