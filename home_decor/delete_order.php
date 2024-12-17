<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Delete the order from the database
    $conn->query("DELETE FROM orders WHERE id = $order_id");
    
    header("Location: manage_orders.php");
    exit();
} else {
    header("Location: manage_orders.php");
    exit();
}

$conn->close();
?>
