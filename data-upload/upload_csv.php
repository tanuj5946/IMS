<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV</title>
</head>
<body>
    <h2>Upload Product CSV</h2>

    <form action="import_csv.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <br><br>
        <input type="submit" name="upload" value="Upload CSV">
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
