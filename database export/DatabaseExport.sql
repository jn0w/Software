-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for grocery_shop
CREATE DATABASE IF NOT EXISTS `grocery_shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `grocery_shop`;

-- Dumping structure for table grocery_shop.guest_orders
CREATE TABLE IF NOT EXISTS `guest_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'card',
  `status` varchar(100) DEFAULT 'Pending',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table grocery_shop.guest_orders: ~8 rows (approximately)
INSERT INTO `guest_orders` (`order_id`, `name`, `address`, `contact_number`, `email`, `total_price`, `payment_method`, `status`, `user_id`) VALUES
	(2, 'John John', 'Park view house ', '1234567890', 'john@gmail.com', 41.00, 'card', 'Pending', NULL),
	(5, 'test', 'test', '1234567890', 'test2@gmail.com', 1.00, 'Credit Card', 'Pending', NULL),
	(6, 'test2', 'test2', '1234567890', 'test2@gmail.com', 4.95, 'Credit Card', 'Pending', 2),
	(7, 'johny test', 'test address', '123236546', 'johny@gmail.com', 56.00, 'Debit Card', 'Pending', 6),
	(8, 'johny', 'test', '5435764746', 'johny@gmail.com', 1.49, 'PayPal', 'Pending', 6),
	(9, 'test', 'test', '5555555', 'test@gmail.com', 40.95, 'PayPal', 'Pending', 8),
	(10, 'joe', 'joe', '4444455555', 'joe@gmail.com', 26.00, 'Credit Card', 'Pending', 9),
	(11, 'bill', 'bbilll', '555666777', 'bill@gmail.com', 2.00, 'Debit Card', 'Pending', 10),
	(12, 'test2', 'test2', '234765756', 'test2@gmail.com', 3.00, 'Debit Card', 'Pending', 2),
	(13, 'last test', 'last', '355765756', 'last@gmail.com', 10.49, 'Debit Card', 'Pending', 12),
	(14, 'get', 'get', '5654645', 'get@gmail.com', 2.00, 'Credit Card', 'Pending', NULL),
	(15, 'john testing', 'testing', '45375467', 'johntesting@gmail.com', 1.00, 'Credit Card', 'Pending', 6),
	(16, 'test', 'test', '4543', 'tert@gmail.com', 1.00, 'Credit Card', 'Pending', 13),
	(17, 'does it work', 'fdgfdg', '5654', 'test@gmail.com', 1.00, 'Credit Card', 'Pending', 11),
	(18, 'johny test', 'test', '5648467', 'johny@gmail.com', 18.99, 'Credit Card', 'Pending', 6),
	(19, 'last one ', 'test', '453463', 'lastone@gmail.com', 8.47, 'PayPal', 'Pending', 15),
	(20, 'check', 'this', '4353563', 'check@gmail.com', 1.00, 'PayPal', 'Pending', 17);

-- Dumping structure for table grocery_shop.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `guest_orders` (`order_id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table grocery_shop.order_items: ~28 rows (approximately)
INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(4, 2, 4, 7, 1.00),
	(5, 2, 8, 7, 2.00),
	(6, 2, 1, 3, 5.00),
	(7, 2, 11, 5, 1.00),
	(10, 5, 4, 1, 1.00),
	(11, 6, 19, 5, 0.99),
	(12, 7, 1, 7, 6.00),
	(13, 7, 8, 7, 2.00),
	(14, 8, 20, 1, 1.49),
	(15, 9, 19, 5, 0.99),
	(16, 9, 1, 5, 6.00),
	(17, 9, 9, 1, 6.00),
	(18, 10, 22, 1, 5.00),
	(19, 10, 3, 3, 7.00),
	(20, 11, 8, 1, 2.00),
	(21, 12, 19, 1, 3.00),
	(22, 13, 20, 1, 1.49),
	(23, 13, 8, 1, 2.00),
	(24, 13, 3, 1, 7.00),
	(25, 14, 8, 1, 2.00),
	(26, 15, 4, 1, 1.00),
	(27, 16, 4, 1, 1.00),
	(28, 17, 4, 1, 1.00),
	(29, 18, 8, 1, 2.00),
	(30, 18, 4, 1, 1.00),
	(31, 18, 19, 1, 3.00),
	(32, 18, 1, 1, 6.50),
	(33, 18, 20, 1, 1.49),
	(34, 18, 22, 1, 5.00),
	(35, 19, 4, 1, 1.00),
	(36, 19, 19, 1, 3.00),
	(37, 19, 20, 3, 1.49),
	(38, 20, 4, 1, 1.00);

-- Dumping structure for table grocery_shop.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table grocery_shop.products: ~12 rows (approximately)
INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`, `image`) VALUES
	(1, 'chicken', 'fresh free range chicken', 6.50, 'Meat', NULL),
	(3, 'mince beef', 'fresh mince beef from grass fed cows', 7.00, 'Meat', NULL),
	(4, 'apple', 'honey crisp apple', 1.00, 'Fruit', NULL),
	(8, 'banana', 'fresh', 2.00, 'Fruit', NULL),
	(9, 'turkey', 'fresh turkey', 6.00, 'Meat', NULL),
	(11, 'carrot', 'fresh carrot.', 0.99, 'Vegetable', NULL),
	(12, 'kitchen towel', 'high quality microfiber towel', 5.00, 'Other', NULL),
	(19, 'Watermelon', 'fresh delicious watermelon.', 3.00, 'Fruit', NULL),
	(20, 'Milk', 'Fresh whole milk, 1 liter.', 1.49, 'Meat', NULL),
	(21, 'Carrot', 'Organic and crunchy carrots.', 0.69, 'Vegetable', NULL),
	(22, 'bottle', 'Stylish metal bottle.', 5.00, 'Other', NULL);

-- Dumping structure for table grocery_shop.users
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table grocery_shop.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `address`, `contact_number`) VALUES
	(1, 'test1', 'test1', 'test1@gmail.com', '$2y$10$eN6bmbzAQUo1s.0hToIiu.0fAIXOovBW9ohxlkQl78rsJYbEYIwIG', 'customer', 'test1', '1234567890'),
	(2, 'test2', 'test2', 'test2@gmail.com', '$2y$10$BFfawhAXDRI.Xm8CEKWvteuH1Ws8HAy8553xJ4pJwPATTGS6p1Tyi', 'customer', 'test2', '1234567890'),
	(6, 'johny', 'test', 'johny@gmail.com', '$2y$10$snM5vj.0bBXgNPitoOeAYeFdSzJP9FrwcLUVDEPr2Of9fzvzCE3Pq', 'customer', 'test address ', '123454645'),
	(8, 'test', 'test', 'test@gmail.com', '$2y$10$AT0GNYOkl3N/eXNQBIuJaur2dlzADBYkMV.CrKZhEQ35sjgS2cDnm', 'customer', 'test', '555555555'),
	(9, 'joe', 'lee', 'joe@gmail.com', '$2y$10$Pt6wQQCNLd8Zd.YeI6zKI.Hb4u4OvIPwmHk4/E9hf4rgLImniUmZy', 'customer', 'joe', '444445555'),
	(10, 'bill', 'billy', 'bill@gmail.com', '$2y$10$Lw4vDNtDMF6vYzYSyibnKeGwAQLDQ8P5HcW4B/r34A.sRMTmX6ArK', 'customer', 'bill', '555666777'),
	(11, 'admin', 'admin', 'admin@gmail.com', '$2y$10$SKlSEbWhEsFucWSQcKXX7OMwvKs7iew9lGy4DQonBppIklyhP49T.', 'admin', 'admin', 'admin'),
	(12, 'last', 'test', 'last@gmail.com', '$2y$10$VJiSrK2eku9sWy1HPQ76JuZlgJAsAfHif7/MMrER9T6k.Yuh3hNV2', 'customer', 'last', '457657657'),
	(13, 'test', 'test', 'test@test.com', '$2y$10$hz1uvWmQojEve5ZcyUpGUedFOpyMP3Dfq5KHp8sIoCF2G0tC/BqG.', 'customer', 'test', '4543'),
	(14, 'wow', 'ama', 'ama@gmail.com', '$2y$10$ZhBqBYKKPTynaAbk1SZZyOmLp4lc0uBCiJvPKGRL4xgLGO5z1LigW', 'customer', 'asd', '6456'),
	(15, 'last', 'one', 'lastone@gmail.com', '$2y$10$nDkwDwzZO5ZCxAQxEPZ5COyxcZzozA.t/abANMdbMyx2Th85eftLS', 'customer', 'test', '436757564'),
	(17, 'check', 'this', 'check@gmail.com', '$2y$10$F/wEIrqnpsQno9hcy6eaWeOV1k94yW1Igecero9oh3btzLhS5Ik2a', 'customer', 'check', '4676574534');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
