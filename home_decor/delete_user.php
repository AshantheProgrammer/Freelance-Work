<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Delete the user from the database
    $conn->query("DELETE FROM users WHERE id = $user_id");
    
    header("Location: manage_users.php");
    exit();
} else {
    header("Location: manage_users.php");
    exit();
}

$conn->close();
?>
