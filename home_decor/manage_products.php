<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$data_query = $conn->query("SELECT * FROM products");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aura Decor - Manage Products">
    <meta name="keywords" content="Admin, Manage Products, Aura Decor">
    <title>Manage Products - Aura Decor</title>
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_manage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="admin-dashboard-section">
        <div class="gradient-1"></div>
        <div class="gradient-2"></div>
        <div class="gradient-3"></div>
        <div class="gradient-4"></div>
        <div class="gradient-5"></div>
        <div class="gradient-6"></div>
        <div class="logout-btn-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        <div class="admin-card">
            <h1>Manage Products</h1>
            <h2>All Products</h2>
            <div class="item-list">
                <?php while ($item = $data_query->fetch_assoc()): ?>
                    <div class="item-card">
                        <h3><?php echo $item['name']; ?></h3>
                        <p><?php echo $item['description']; ?></p>
                        <div class="actions">
                            <a href="edit_product.php?id=<?php echo $item['id']; ?>" class="action-btn">Edit</a>
                            <a href="delete_product.php?id=<?php echo $item['id']; ?>" class="action-btn delete-btn">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
