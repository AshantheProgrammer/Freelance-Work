<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home Decor Products - Explore our range of modern, stylish, and affordable home decor items.">
    <meta name="keywords" content="Home Decor, Modern Interior Design, Affordable Home Accessories, Products">
    <title>Products - Aura Decor</title>
    <!-- Google Font: Caudex -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the main CSS file -->
    <link rel="stylesheet" href="css/products.css"> <!-- Link to the products-specific CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>

    <section id="products" class="products-section">
        <div class="container">
            <h1>Our Products</h1>
            <div class="products-grid">

                <?php
                include 'db.php'; // Include the database connection

                // Fetch products from the database
                $result = $conn->query("SELECT * FROM products");

                // Loop through each product and display it
                while ($product = $result->fetch_assoc()):
                ?>

                <!-- Dynamically generate the product items -->
                <div class="product-item">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="details">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
                    </div>
                </div>

                <?php endwhile; ?>

            </div>
        </div>
    </section>

    <script src="js/main.js"></script> <!-- Link to your JS file -->
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
