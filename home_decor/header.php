<?php
session_start();
?>

<header>
    <div class="container">
        <div class="logo">
            <a href="index.php">Aura Decor</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="logout.php" class="login-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="auth.php" class="login-btn">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
