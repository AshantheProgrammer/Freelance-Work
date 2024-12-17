<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Include the database connection

// Fetch all orders
$orders_query = $conn->query("SELECT * FROM orders");

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aura Decor - Manage Orders">
    <meta name="keywords" content="Admin, Manage Orders, Aura Decor">
    <title>Manage Orders - Aura Decor</title>
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
            <h1>Manage Orders</h1>
            <h2>All Orders</h2>
            <div class="item-list">
                <?php while ($order = $orders_query->fetch_assoc()): ?>
                    <div class="item-card">
                        <h3>Order #<?php echo $order['id']; ?></h3>
                        <p><strong>Customer:</strong> <?php echo $order['customer_name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $order['customer_email']; ?></p>
                        <p><strong>Total Amount:</strong> $<?php echo $order['total_amount']; ?></p>
                        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
                        <div class="actions">
                            <a href="view_order.php?id=<?php echo $order['id']; ?>" class="action-btn">View</a>
                            <a href="edit_order.php?id=<?php echo $order['id']; ?>" class="action-btn">Edit</a>
                            <a href="delete_order.php?id=<?php echo $order['id']; ?>" class="action-btn delete-btn">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
