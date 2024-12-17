<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Delete the product from the database
    $conn->query("DELETE FROM products WHERE id = $product_id");
    
    header("Location: manage_products.php");
    exit();
} else {
    header("Location: manage_products.php");
    exit();
}

$conn->close();
?>
