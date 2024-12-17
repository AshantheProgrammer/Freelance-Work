<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch user details from the database
    $user_query = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $user = $user_query->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form submission and update user details in the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        $conn->query("UPDATE users SET name = '$name', email = '$email', role = '$role' WHERE id = $user_id");
        
        header("Location: manage_users.php");
        exit();
    }
} else {
    header("Location: manage_users.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Aura Decor</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select>
        
        <button type="submit">Update User</button>
    </form>
</body>
</html>
