<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Include the database connection

// Fetch all users
$users_query = $conn->query("SELECT * FROM users");

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aura Decor - Manage Users">
    <meta name="keywords" content="Admin, Manage Users, Aura Decor">
    <title>Manage Users - Aura Decor</title>
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
            <h1>Manage Users</h1>
            <h2>All Registered Users</h2>
            <div class="item-list">
                <?php while ($user = $users_query->fetch_assoc()): ?>
                    <div class="item-card">
                        <h3><?php echo $user['name']; ?></h3>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Role:</strong> <?php echo ucfirst($user['role']); ?></p>
                        <div class="actions">
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="action-btn">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="action-btn delete-btn">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
