-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 07:40 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_data`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `calculate_total_amount` (IN `user_id` INT, OUT `subtotal` DECIMAL(10,2), OUT `tax` DECIMAL(10,2), OUT `total_amount` DECIMAL(10,2))   BEGIN
    -- calculate the subtotal
    SELECT SUM(products.price * cart.quantity) INTO subtotal
    FROM cart
    INNER JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = user_id;

    -- calculate the tax (10% of the subtotal)
    SET tax = subtotal * 0.025;

    -- calculate the total amount (subtotal + tax)
    SET total_amount = subtotal + tax;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calculate_total_quantity` (IN `user_id` INT, OUT `total_products` INT)   BEGIN
    SELECT SUM(quantity) INTO total_products
    FROM cart
    WHERE cart.user_id = user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `series_id` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `password`, `series_id`, `remember_token`, `expires`, `admin_type`) VALUES
(11, 'admin', '$2y$10$NF8V4ZSz/u4MYEHbEcjX9u7faliCW5nf/2bGmCfK5modEiVb1Ncym', NULL, NULL, NULL, 'admin'),
(12, 'super', '$2y$10$LATPki1itFiqaqY6NX9mbOsc/BaB1o4MT40b2il9oR/OZU9KMxcv2', NULL, NULL, NULL, 'super');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(12, 11, 22, 41),
(13, 11, 21, 15),
(14, 11, 16, 1),
(15, 11, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `gender`) VALUES
(1, 'Tops', 'women'),
(2, 'Bottoms', 'women'),
(3, 'Dresses', 'women'),
(4, 'Outerwear', 'women'),
(5, 'Tops', 'men'),
(6, 'Bottoms', 'men'),
(7, 'Suits', 'men'),
(8, 'Outerwear', 'men'),
(10, 'Accessories', 'women');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('pending','shipped','delivered','cancelled') CHARACTER SET utf8mb4  NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total`, `created_at`) VALUES
(7, 11, 'pending', '106723.00', '2023-05-03 10:11:56'),
(8, 11, 'cancelled', '873.30', '2023-05-06 12:57:41'),
(9, 11, 'shipped', '8734.03', '2023-05-16 00:31:08'),
(10, 11, 'delivered', '8734.03', '2023-05-16 00:31:08'),
(11, 11, 'pending', '8541.84', '2023-05-18 23:50:53'),
(12, 11, 'pending', '8541.84', '2023-05-18 23:56:50'),
(13, 11, 'pending', '8541.84', '2023-05-19 10:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 7, 1, 10, '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `subcategory_id`, `image_url`, `created_at`) VALUES
(1, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(2, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(3, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(4, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(5, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(6, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(7, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(8, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(9, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(10, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(11, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(12, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(13, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '678.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(14, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '1200.00', 18, 8, 23, 'jacket-3.jpg', '2023-05-17 17:41:51'),
(15, 'Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '1000.00', 18, 8, 23, 'jacket-2.jpg', '2023-05-17 17:41:51'),
(16, 'OK OK OK Jacket', 'This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket This is a jacket.', '1000.00', 18, 8, 23, 'jacket-2.jpg', '2023-05-17 17:41:51'),
(21, 'Skirt', 'Skirt', '107.50', 10, 2, 7, 'clothes-4.jpg', '2023-05-17 17:41:51'),
(22, 'Jacket', 'Jacket', '123.00', 10, 8, 23, 'jacket-1.jpg', '2023-05-17 17:41:51'),
(23, 'Skirt', 'Skirt', '130.00', 13, 2, 7, 'clothes-3.jpg', '2023-05-19 20:11:06'),
(24, 'Skirt', 'Skirt', '120.00', 30, 2, 7, 'clothes-3.jpg', '2023-05-19 20:26:49'),
(34, 'Jacket', 'Jacket', '110.00', 30, 8, 23, 'jacket-4.jpg', '2023-05-19 21:20:10'),
(35, 'Skirt', 'Skirt', '155.33', 10, 2, 7, 'clothes-4.jpg', '2023-05-19 21:22:18'),
(36, 'Short', 'Short', '125.00', 30, 6, 19, 'shorts-2.jpg', '2023-05-20 15:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`) VALUES
(1, 'Shirts', 1),
(2, 'Blouses', 1),
(3, 'Sweaters', 1),
(4, 'Pants', 2),
(5, 'Jeans', 2),
(6, 'Shorts', 2),
(7, 'Skirts', 2),
(8, 'Casual Dresses', 3),
(9, 'Formal Dresses', 3),
(10, 'Coats', 4),
(11, 'Jackets', 4),
(12, 'Vests', 4),
(13, 'Shirts', 5),
(14, 'Polo Shirts', 5),
(15, 'T-Shirts', 5),
(16, 'Sweaters', 5),
(17, 'Pants', 6),
(18, 'Jeans', 6),
(19, 'Shorts', 6),
(20, 'Suits', 7),
(21, 'Tuxedos', 7),
(22, 'Coats', 8),
(23, 'Jackets', 8),
(24, 'Vests', 8),
(26, 'Jewelry', 10);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'aliexpress', 'aliexpress@gmail.com', '212600000000', 'NA'),
(2, 'alibaba', 'alibaba@gmail.com', '212611111111', 'NA'),
(3, 'jumia', 'jumia@gmail.com', '212622222222', 'NA'),
(4, 'ebay', 'ebay@gmail.com', '212644444444', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_prices`
--

CREATE TABLE `supplier_prices` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `supplier_prices`
--

INSERT INTO `supplier_prices` (`id`, `product_id`, `supplier_id`, `price`) VALUES
(3, 21, 1, '105.00'),
(4, 21, 2, '110.00'),
(5, 24, 1, '120.00'),
(8, 34, 1, '120.00'),
(9, 34, 2, '100.00'),
(10, 35, 1, '280.00'),
(11, 35, 2, '17.00'),
(12, 35, 3, '169.00'),
(13, 36, 1, '120.00'),
(14, 36, 3, '130.00');

--
-- Triggers `supplier_prices`
--
DELIMITER $$
CREATE TRIGGER `update_product_price_trigger` AFTER INSERT ON `supplier_prices` FOR EACH ROW BEGIN
  UPDATE products p
  SET p.price = (
    SELECT AVG(sp.price) FROM supplier_prices sp WHERE sp.product_id = p.id
  )
  WHERE p.id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` bigint NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address_line_one` varchar(255) NOT NULL,
  `address_line_two` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `postalcode` int NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `series_id` varchar(60) CHARACTER SET utf8mb4  DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `birthdate`, `gender`, `address_line_one`, `address_line_two`, `country`, `city`, `region`, `postalcode`, `role`, `series_id`, `remember_token`, `expires`, `created_at`) VALUES
(6, 'test', 'test@gmail.com', '$2y$10$spNXoyCsvlapKZywnq3EjOLU1oVOZpVsjuygVtOsOdB67.Xf6Km4i', 666666666, '1111-01-01', 'prefer not to say', 'test', 'test', 'morocco', 'test', 'test', 11111, 0, NULL, NULL, NULL, '2023-05-08 15:23:01'),
(11, 'test2', 'test2@gmail.com', '$2y$10$8dbCes/U3xpMhNOHmkH2AuOPC7zBHmWe/a0v3yiRnjlMexIwO2Sje', 611111111, '1111-01-01', 'prefer not to say', 'test2', 'test2', 'morocco', 'test2', 'test2', 10000, 0, NULL, NULL, NULL, '2023-05-08 15:23:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `supplier_prices`
--
ALTER TABLE `supplier_prices`
  ADD CONSTRAINT `supplier_prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `supplier_prices_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
