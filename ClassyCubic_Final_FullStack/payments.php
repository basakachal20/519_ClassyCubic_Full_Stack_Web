<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Secure Payments | ClassyCubic</title><link rel="stylesheet" href="css/style.css"></head><body>
<?php include __DIR__ . '/includes/navbar.php'; ?>
<section class="section"><h2>🔒 Secure Payments</h2><p>Choose from multiple safe and trusted payment methods.</p><div class="payment-grid"><div class="payment-card">💳<h3>Card Payment</h3><p>Visa, MasterCard, Debit/Credit supported</p></div><div class="payment-card">💵<h3>Cash on Delivery</h3><p>Pay when you receive your product</p></div><div class="payment-card">📱<h3>bKash</h3><p>Mobile payment in Bangladesh</p></div><div class="payment-card">📲<h3>Nagad</h3><p>Digital wallet payment</p></div></div><div class="features"><div class="card">🔐 Encrypted Transactions</div><div class="card">✔ Verified Payment Gateways</div><div class="card">🛡️ Fraud Protection</div><div class="card">📦 Safe Checkout</div></div></section><script src="js/payment.js"></script>
<footer><p>© 2026 ClassyCubic | All Rights Reserved</p></footer>
</body></html>