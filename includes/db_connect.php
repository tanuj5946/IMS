<?php

define('DB_DEBUG', true);
$host = "localhost";
$user = "root";      
$pass = "";       
$db = "mk_kirana_store"; 
$charset = 'utf8mb4';


// $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
// Uncomment and adjust the following line if you need a custom port, e.g., 3307
$dsn = "mysql:host={$host};port=3306;dbname={$db};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throws exceptions for errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Only display a success message if DB_DEBUG is defined and true.
    // Show success message only in development mode and only on specific pages
    if (defined('DB_DEBUG') && DB_DEBUG === true && basename($_SERVER['PHP_SELF']) === 'index.php') {
        echo "✅ Database connection successful!";
    }

} catch (PDOException $e) {
    die("❌ Database connection error: " . $e->getMessage());
}
?>