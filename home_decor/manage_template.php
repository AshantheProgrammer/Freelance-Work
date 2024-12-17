<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Include the database connection

// Fetch data based on the specific page
// This example assumes you pass a specific query for products, orders, users, or messages

// Example query for products
$data_query = $conn->query("SELECT * FROM products");

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aura Decor - Manage">
    <meta name="keywords" content="Admin, Manage, Aura Decor">
    <title>Manage Items - Aura Decor</title>
    <!-- Google Font: Caudex -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_manage.css"> <!-- Link to the new manage-specific CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>
    <div class="admin-dashboard-section">
        <div class="gradient-1"></div>
        <div class="gradient-2"></div>
        <div class="gradient-3"></div>
        <div class="gradient-4"></div>
        <div class="gradient-5"></div>
        <div class="gradient-6"></div>
        <!-- Logout Button -->
        <div class="logout-btn-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="admin-card">
            <h1>Manage Items</h1>
            <h2>Manage Your Items Here</h2>
            <div class="item-list">
                <?php while ($item = $data_query->fetch_assoc()): ?>
                    <div class="item-card">
                        <h3><?php echo $item['name']; // Adjust based on the data ?></h3>
                        <p><?php echo $item['description']; // Adjust based on the data ?></p>
                        <div class="actions">
                            <a href="edit_item.php?id=<?php echo $item['id']; ?>" class="action-btn">Edit</a>
                            <a href="delete_item.php?id=<?php echo $item['id']; ?>" class="action-btn delete-btn">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
