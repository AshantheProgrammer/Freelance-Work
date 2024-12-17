<?php
include 'header.php';
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert message into database
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Aura Decor - Get in Touch with Us">
    <meta name="keywords" content="Home Decor, Contact Us, Aura Decor">
    <title>Contact Us - Aura Decor</title>
    <!-- Google Font: Caudex -->
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the main CSS file -->
    <link rel="stylesheet" href="css/contact.css"> <!-- Link to the contact-specific CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>

    <section id="contact" class="contact-section">
        <div class="gradient-1"></div>
        <div class="gradient-2"></div>
        <div class="gradient-3"></div>
        <div class="gradient-4"></div>
        <div class="gradient-5"></div>
        <div class="gradient-6"></div>
        <div class="container">
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p class="tagline">We'd Love to Hear From You!</p>
                <p>If you have any questions, feedback, or need assistance, feel free to reach out to us. Our team is here to help you make your home decor dreams come true.</p>
                <ul class="contact-details">
                    <li><i class="fas fa-map-marker-alt"></i> 123 Decor Street, New York, NY 10001</li>
                    <li><i class="fas fa-phone-alt"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> support@auradecor.com</li>
                </ul>
            </div>
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <script src="js/main.js"></script> <!-- Link to your JS file -->
</body>
</html>
