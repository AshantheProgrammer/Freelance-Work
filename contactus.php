<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include '/includes/db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $subject = $conn->real_escape_string(trim($_POST['subject']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    // SQL query to insert data into the table
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Display the error message
    }

    $conn->close(); // Close the database connection
}
?>