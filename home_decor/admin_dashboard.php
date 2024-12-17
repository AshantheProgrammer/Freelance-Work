<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Fetch statistics for the dashboard

// Fetch total products count
$total_products_query = $conn->query("SELECT COUNT(*) AS count FROM products");
$total_products = $total_products_query->fetch_assoc()['count'];

// Fetch total orders count
$total_orders_query = $conn->query("SELECT COUNT(*) AS count FROM orders");
$total_orders = $total_orders_query->fetch_assoc()['count'];

// Fetch total users count
$total_users_query = $conn->query("SELECT COUNT(*) AS count FROM users");
$total_users = $total_users_query->fetch_assoc()['count'];

// Fetch total messages count
$total_messages_query = $conn->query("SELECT COUNT(*) AS count FROM messages");
$total_messages = $total_messages_query->fetch_assoc()['count'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aura Decor - Admin Dashboard">
    <meta name="keywords" content="Admin, Dashboard, Aura Decor">
    <title>Admin Dashboard - Aura Decor</title>
    <!-- Google Font: Caudex -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_dashboard.css"> <!-- Link to the new admin-specific CSS file -->
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
            <h1>Admin Dashboard</h1>
            <h2>Overview</h2>
            <div class="dashboard-stats">
                <div class="stat">
                    <h3>Total Products</h3>
                    <p><?php echo $total_products; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Orders</h3>
                    <p><?php echo $total_orders; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Users</h3>
                    <p><?php echo $total_users; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Messages</h3>
                    <p><?php echo $total_messages; ?></p>
                </div>
            </div>
            <div class="dashboard-links">
                <a href="manage_products.php">Manage Products</a>
                <a href="manage_orders.php">Manage Orders</a>
                <a href="manage_users.php">Manage Users</a>
                <a href="manage_messages.php">Manage Messages</a>
            </div>
        </div>
    </div>
</body>
</html>
