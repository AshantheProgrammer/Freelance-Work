<?php
include 'db.php'; // Include the database connection

// User credentials
$name = 'admin';
$email = 'admin@example.com';
$password = password_hash('password', PASSWORD_BCRYPT); // Hash the password securely
$role = 'admin';

// Check if the admin user already exists
$result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result->num_rows > 0) {
    echo "Admin user already exists.";
} else {
    // Insert the admin user into the database
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin user registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>
