<?php

define('DB_DEBUG', true);

$host = "localhost";
$user = "root";
$pass = "";
$db = "mk_kirana_store";
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};port=3307;dbname={$db};charset={$charset}";

// $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
// Uncomment and adjust the following line if you need a custom port, e.g., 3307

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// 1) Set PHP time zone
date_default_timezone_set('Asia/Kolkata');
// ^ Change "Asia/Kolkata" to your correct region if needed

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $pdo->exec("SET time_zone = '+05:30'");

    if (DB_DEBUG === true && basename($_SERVER['PHP_SELF']) === 'index.php') {
        echo "✅ Database connection successful!";
    }
} catch (PDOException $e) {
    die("❌ Database connection error: " . $e->getMessage());
}
