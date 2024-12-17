<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $category_id = $conn->real_escape_string($_POST['category_id']);
    $image = basename($_FILES["image"]["name"]);

    // Handle image upload
    $target_dir = "images/";
    $target_file = $target_dir . $image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert product into database
    $sql = "INSERT INTO products (name, description, price, image, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$categories = $conn->query("SELECT * FROM categories");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Aura Decor</title>
    <link rel="stylesheet" href="css/admin.css"> <!-- Link to your admin-specific CSS file -->
</head>
<body>

    <h1>Add New Product</h1>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>
        <br>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php while ($category = $categories->fetch_assoc()): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" required>
        <br>
        <button type="submit">Add Product</button>
    </form>

</body>
</html>
