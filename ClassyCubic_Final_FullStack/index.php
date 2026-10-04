<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>ClassyCubic</title><link rel="stylesheet" href="css/style.css"></head><body>
<?php include __DIR__ . '/includes/navbar.php'; ?>
<section class="hero"><h2>Grab & Buy Your Dreams. Enjoy Your Shopping</h2><p>Find products with secure and fast delivery.</p><button onclick="location.href='shop.php'">Shop Now</button><button onclick="location.href='fashion.php'">Explore Categories</button></section>
<section class="section"><h2>Our Features</h2><div class="features"><div class="card">🎯 <a href="recommendation.php">Personalized Recommendations</a></div><div class="card">🔒 <a href="payments.php">Secure Payments</a></div><div class="card">🚚 <a href="tracking.php">Real-time Tracking</a></div><div class="card">🏪 <a href="sellers.php">Support Small Businesses</a></div></div></section>
<section class="section"><h2>Categories</h2><div class="categories"><div class="card"><a href="fashion.php">👕 Fashion</a></div><div class="card"><a href="electronics.php">📱 Electronics</a></div><div class="card"><a href="home.php">🏠 Home Appliances</a></div><div class="card"><a href="beauty.php">💄 Beauty Products</a></div></div></section>
<section class="section"><h2>Trending Products</h2><div class="products">
<?php include __DIR__.'/includes/db.php'; $r=mysqli_query($conn,"SELECT * FROM products ORDER BY id DESC LIMIT 6"); while($p=mysqli_fetch_assoc($r)): ?>
<div class="product-card"><img src="<?php echo htmlspecialchars($p['image']); ?>" alt="Product"><h3><?php echo htmlspecialchars($p['name']); ?></h3><p class="price">৳<?php echo number_format($p['price'],2); ?></p><p class="stock"><?php echo (int)$p['stock']; ?> in stock</p><a class="btn-primary" href="shop.php">View Shop</a></div>
<?php endwhile; ?></div></section>
<section class="section"><h2>🔥 Current Offers</h2><div class="offer-grid"><a class="offer-card" href="friday-sale.php">Friday Sale<br>20% OFF</a><a class="offer-card" href="eid-sale.php">Eid Sale<br>25% OFF</a><a class="offer-card" href="puja-sale.php">Puja Sale<br>25% OFF</a><a class="offer-card" href="newyear-sale.php">New Year Sale<br>15% OFF</a></div></section>
<section class="section"><h2>Why Trust Us?</h2><p>✔ Secure Checkout | ⭐ Verified Sellers | 📦 Live Tracking</p></section>
<section class="section"><h2>Support Local Sellers</h2><p>Empowering small businesses to grow online.</p><button onclick="location.href='sellers.php'">Become a Seller</button></section>
<footer><p>© 2026 ClassyCubic | All Rights Reserved</p></footer>
</body></html>