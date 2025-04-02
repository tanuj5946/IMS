<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['upload'])) {
    if (is_uploaded_file($_FILES['csv_file']['tmp_name'])) {
        $file = fopen($_FILES['csv_file']['tmp_name'], 'r');
        
        // Skip the first line (header)
        fgetcsv($file);

        $successCount = 0;
        $failCount = 0;

        while (($row = fgetcsv($file)) !== FALSE) {
            $name = mysqli_real_escape_string($conn, $row[0]);
            $sku = mysqli_real_escape_string($conn, $row[1]);
            $category_id = (int)$row[2];
            $quantity = (int)$row[3];
            $price = (float)$row[4];

            $query = "INSERT INTO products (name, sku, category_id, quantity, price)
                      VALUES ('$name', '$sku', $category_id, $quantity, $price)";

            if (mysqli_query($conn, $query)) {
                $successCount++;
            } else {
                $failCount++;
            }
        }

        fclose($file);
        echo "<p>✅ $successCount products added successfully.</p>";
        echo "<p>❌ $failCount products failed to import.</p>";
        echo "<a href='upload_csv.php'>Upload Another</a> | <a href='dashboard.php'>Dashboard</a>";

    } else {
        echo "No file uploaded.";
    }
} else {
    echo "Invalid request.";
}
?>
