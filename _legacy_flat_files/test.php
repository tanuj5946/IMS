<?php
include __DIR__ . '/includes/db_connect.php'; // Make sure this path is correct

try {
    // Test query to fetch database version
    $stmt = $pdo->query("SELECT VERSION() AS db_version");
    $db_version = $stmt->fetch(PDO::FETCH_ASSOC)['db_version'];

    echo "✅ Database connection successful! MySQL Version: " . $db_version;
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}
?>
