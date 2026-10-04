DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS admin_alerts;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS users;

CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE admins (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE products (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(150) NOT NULL,price DECIMAL(10,2) NOT NULL,stock INT NOT NULL DEFAULT 0,category VARCHAR(50) NOT NULL,image VARCHAR(255) DEFAULT NULL,description TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE cart (id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,quantity INT NOT NULL DEFAULT 1,UNIQUE KEY unique_cart_product(user_id,product_id),FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);

CREATE TABLE orders (id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,total_amount DECIMAL(10,2) NOT NULL,status VARCHAR(30) NOT NULL DEFAULT 'Pending',payment_method VARCHAR(40) NOT NULL DEFAULT 'Cash on Delivery',shipping_address TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE);

CREATE TABLE order_items (id INT AUTO_INCREMENT PRIMARY KEY,order_id INT NOT NULL,product_id INT NOT NULL,quantity INT NOT NULL,price DECIMAL(10,2) NOT NULL,FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);

CREATE TABLE admin_alerts (id INT AUTO_INCREMENT PRIMARY KEY,message VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE contacts (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) NOT NULL,message TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

INSERT INTO admins(name,email,password) VALUES('ClassyCubic Admin','admin@classycubic.com','$2y$12$KYDJiNLdRmde.GC7uCHc0eBggKUT1iqv0l4jlLhTU7xF6NhKZUpm.');

INSERT INTO products(name,price,stock,category,image,description) VALUES
('Men Shirt',25,200,'fashion','images/hero_section.png','Comfortable men shirt for everyday wear.'),
('Women Co-ord Set',40,150,'fashion','images/hero_section.png','Stylish women co-ord set.'),
('Men Perfume',30,80,'beauty','images/men_beauty.png','Fresh fragrance for men.'),
('Face Wash (Women)',15,120,'beauty','images/female_beauty.png','Gentle face wash for daily use.'),
('Headphones',60,50,'electronics','images/header_bg.png','Wireless-style headphones for entertainment.'),
('Blender',90,30,'home','images/header_bg.png','Useful kitchen blender for home.'),
('Android Phone',150,40,'electronics','images/header_bg.png','Android smartphone.'),
('Smart Watch',120,25,'electronics','images/header_bg.png','Smart watch with useful daily features.'),
('Samsung Fridge',400,15,'home','images/header_bg.png','Energy-efficient refrigerator.'),
('Haier AC',500,12,'home','images/header_bg.png','Home air conditioner.'),
('Makeup Kit',50,60,'beauty','images/female_beauty.png','Beauty makeup kit.'),
('Baby Lotion',12,70,'beauty','images/baby_beauty.png','Gentle baby lotion.');