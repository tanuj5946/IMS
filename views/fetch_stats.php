
<?php
header('Access-Control-Allow-Origin: *'); // or your domain instead of *
header('Content-Type: application/json');






if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}
// Include the database connection file
include __DIR__ . '/../includes/db_connect.php'; // Ensure the correct path

try {
    // Fetch total orders
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM orders");
    $total_orders = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Fetch total revenue
    $stmt = $pdo->query("SELECT SUM(amount) as total FROM orders");
    $total_revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Fetch total users
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $total_users = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Fetch orders and revenue data for the last 7 days
    $stmt = $pdo->query("SELECT DAYNAME(order_date) as day, COUNT(*) as orders, SUM(amount) as revenue
                                    FROM orders
                                    WHERE order_date >= CURDATE() - INTERVAL 7 DAY
                                    GROUP BY DAY(order_date)
                                    ORDER BY order_date DESC");

    $ordersData = [];
    $revenueData = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ordersData[] = $row['orders'] ?? 0;
        $revenueData[] = $row['revenue'] ?? 0;
    }

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode([
        'orders' => $total_orders,
        'revenue' => $total_revenue,
        'users' => $total_users,
        'ordersData' => $ordersData,
        'revenueData' => $revenueData
    ], JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>