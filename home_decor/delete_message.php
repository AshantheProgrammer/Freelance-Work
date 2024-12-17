<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    
    // Delete the message from the database
    $conn->query("DELETE FROM messages WHERE id = $message_id");
    
    header("Location: manage_messages.php");
    exit();
} else {
    header("Location: manage_messages.php");
    exit();
}

$conn->close();
?>
