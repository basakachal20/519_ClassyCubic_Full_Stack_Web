# ClassyCubic — Full-Stack Online Shopping Website

A PHP + MySQL full-stack mini e-commerce application based on the supplied ClassyCubic frontend and backend files. The original frontend theme, colors, font, hero/header images, categories, offers and informational sections are preserved while broken paths, localStorage-based auth/cart, missing PHP pages and database integration are replaced with a single PHP/MySQL flow.

## Requirements
- PHP 8.x
- MySQL 8.x / MySQL Server
- Chrome or Edge
- VS Code 

## Setup
1. Create the database by importing `database/classycubic.sql` in MySQL Workbench/phpMyAdmin.
2. Check `includes/db.php` and set your MySQL username/password if needed.
****** But for security purpose I'm not including db.php directly I'm just uploading same type of instructions like when you open the project through code just create a file named db.php and pasted thr code with necessary information of your database account Here.I'm giving the file name db_example.php and the code will be-
`includes/db_example.php`
<?php

$host = "YOUR_DATABASE_HOST";
$user = "YOUR_DATABASE_USERNAME";
$pass = "YOUR_DATABASE_PASSWORD";
$db   = "YOUR_DATABASE_NAME";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>
3. Open this folder in VS Code.
4. In the terminal run: php -S localhost:8000
5. Open: http://localhost:8000

## Admin
- URL: http://localhost:8000/admin/login.php
- Email:admin@classycubic.com
- Password:Admin@12345
Change the admin password before real deployment.

## Main features
- Registration/login/logout with password hashing
- MySQL product catalog
- Search and category filtering
- Database-backed cart
- Checkout and order placement
- Stock deduction and low-stock alerts
- Admin product CRUD and restocking
- Admin order status updates
- User listing and alert dashboard
- Contact form stored in MySQL
- Recommendations, payments, tracking and seller-support pages
- BDT currency display
## Project Structure
ClassyCubic_Final_FullStack/
│
├── admin/
│   ├── add_product.php
│   ├── alerts.php
│   ├── dashboard.php
│   ├── delete_product.php
│   ├── edit_product.php
│   ├── login.php
│   ├── logout.php
│   ├── messages.php
│   ├── orders.php
│   ├── products.php
│   ├── restock.php
│   └── users.php
│
├── api/
│   ├── add_to_cart.php
│   └── update_cart.php
│
├── css/
│   └── style.css
│
├── database/
│   └── classycubic.sql
│
├── images/
│   ├── all-beauty.png
│   ├── baby_beauty.png
│   ├── female_beauty.png
│   ├── header_bg.png
│   ├── hero_section.png
│   └── men_beauty.png
│
├── includes/
│   ├── admin_navbar.php
│   ├── category.php
│   ├── db.php
│   ├── navbar.php
│   └── session.php
│
├── js/
│   ├── cart.js
│   ├── main.js
│   ├── payment.js
│   ├── search.js
│   ├── sellers.js
│   ├── shop.js
│   ├── tracking.js
│   └── validation.js
│
├── index.php
├── beauty.php
├── cart.php
├── checkout.php
├── contact.php
├── eid-sale.php
├── electronics.php
├── fashion.php
├── friday-sale.php
├── home.php
├── login.php
├── logout.php
├── my_messages.php
├── newyear-sale.php
├── payments.php
├── place_order.php
├── puja-sale.php
├── README.md
├── recommendation.php
├── register.php
├── sellers.php
├── shop.php
└── tracking.php

## Security basics
Prepared statements are used for user-controlled database values, passwords use `password_hash()` / `password_verify()`, sessions protect user/admin pages, and output is escaped with `htmlspecialchars()` where appropriate.

## Note
The supplied frontend originally used localStorage for users, products and cart. In this final full-stack version, authentication, products, cart and orders use PHP/MySQL so there is one server-side source of truth.
