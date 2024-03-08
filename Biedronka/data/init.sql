CREATE DATABASE grocery_shop; 

-- Use the Database
USE grocery_shop;

-- Create Users Table with a 'role' column to differentiate between admin and customer
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') NOT NULL,
    address VARCHAR(255),
    contact_number VARCHAR(255)
);

-- Update Products Table (No changes but included for completeness)
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT
);

-- Update Orders Table to reference the new Users Table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status VARCHAR(100) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id)
);
