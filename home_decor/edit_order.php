<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Fetch order details from the database
    $order_query = $conn->query("SELECT * FROM orders WHERE id = $order_id");
    $order = $order_query->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form submission and update order status in the database
        $status = $_POST['status'];
        
        $conn->query("UPDATE orders SET status = '$status' WHERE id = $order_id");
        
        header("Location: manage_orders.php");
        exit();
    }
} else {
    header("Location: manage_orders.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order - Aura Decor</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <h1>Edit Order</h1>
    <form method="POST">
        <label for="status">Order Status:</label>
        <select id="status" name="status" required>
            <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        
        <button type="submit">Update Order</button>
    </form>
</body>
</html>
