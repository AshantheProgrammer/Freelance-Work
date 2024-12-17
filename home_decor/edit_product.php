<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch product details from the database
    $product_query = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $product = $product_query->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form submission and update product details in the database
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        
        $conn->query("UPDATE products SET name = '$name', description = '$description', price = '$price' WHERE id = $product_id");
        
        header("Location: manage_products.php");
        exit();
    }
} else {
    header("Location: manage_products.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Aura Decor</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
