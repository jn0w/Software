CREATE DATABASE IF NOT EXISTS `grocery_shop`;
USE `grocery_shop`;

CREATE TABLE IF NOT EXISTS `guest_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'card',
  `status` varchar(100) DEFAULT 'Pending',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `guest_orders` (`order_id`, `name`, `address`, `contact_number`, `email`, `total_price`, `payment_method`, `status`) VALUES
(2, 'John John', 'Park view house ', '1234567890', 'john@gmail.com', 41.00, 'card', 'Pending'),
(3, 'test2', 'test2', '1234567890', 'test2@gmail.com', 1.00, 'card', 'Pending');

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(100) DEFAULT 'Pending',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
  -- Remove foreign key constraints for simplicity
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
  -- Remove foreign key constraints for simplicity
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(4, 2, 4, 7, 1.00),
(5, 2, 8, 7, 2.00),
(6, 2, 1, 3, 5.00),
(7, 2, 11, 5, 1.00),
(8, 3, 4, 1, 1.00);

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`, `image`) VALUES
(1, 'chicken', 'fresh free range chicken', 6.00, 'Meat', NULL),
(3, 'mince beef', 'fresh mince beef from grass fed cows', 7.00, 'Meat', NULL),
(4, 'apple', 'honey crisp apple', 1.00, 'Fruit', NULL),
(8, 'banana', 'fresh', 2.00, 'Fruit', NULL),
(9, 'turkey', 'fresh turkey', 6.00, 'Meat', NULL),
(11, 'carrot', 'fresh carrot', 1.00, 'Vegetable', NULL),
(12, 'kitchen towel', 'high quality microfiber towel', 5.00, 'Other', NULL);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `address`, `contact_number`) VALUES
(1, 'test1', 'test1', 'test1@gmail.com', 'hashed_password1', 'customer', 'test1', '1234567890'),
(2, 'test2', 'test2', 'test2@gmail.com', 'hashed_password2', 'customer', 'test2', '1234567890'),
(3, 'Admin', 'User', 'admin@gmail.com', 'hashed_password3', 'admin', 'admin', 'admin');
