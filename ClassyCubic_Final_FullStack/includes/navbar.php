<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<header class="header-bg">
    <h1>ClassyCubic</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="fashion.php">Fashion</a>
        <a href="electronics.php">Electronics</a>
        <a href="home.php">Home Appliances</a>
        <a href="beauty.php">Beauty</a>
        <a href="contact.php">Contact</a>
        <a href="cart.php">🛒 Cart</a>
        <a href="my_messages.php">💬 My Messages</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="nav-user">👤 <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
