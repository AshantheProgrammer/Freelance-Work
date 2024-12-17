<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $message_id = $_GET['id'];
    
    // Fetch message details from the database
    $message_query = $conn->query("SELECT * FROM messages WHERE id = $message_id");
    $message = $message_query->fetch_assoc();
} else {
    header("Location: manage_messages.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message - Aura Decor</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <h1>View Message</h1>
    <p><strong>From:</strong> <?php echo $message['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $message['email']; ?></p>
    <p><strong>Message:</strong></p>
    <p><?php echo $message['message']; ?></p>
</body>
</html>
