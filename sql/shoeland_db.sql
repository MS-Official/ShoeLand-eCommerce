-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2024 at 07:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoeland_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(1, 1, 2, 1),
(2, 1, 5, 2),
(3, 2, 3, 1),
(4, 2, 6, 1),
(5, 3, 1, 1),
(6, 3, 4, 2),
(7, 4, 7, 1),
(8, 5, 9, 3),
(9, 6, 10, 2),
(10, 7, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_ids` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('processing','shipped','delivered','cancelled') NOT NULL,
  `payment_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_ids`, `total_price`, `order_status`, `payment_info`) VALUES
(1, 1, '[1, 2]', 270.00, 'processing', 'PayPal: 1234abcd'),
(2, 2, '[3, 4]', 210.00, 'shipped', 'CreditCard: 4321efgh'),
(3, 3, '[5, 6]', 290.00, 'delivered', 'PayPal: 9876ijkl'),
(4, 4, '[7, 8]', 220.00, 'cancelled', 'CreditCard: 5678mnop'),
(5, 5, '[9, 10]', 160.00, 'processing', 'PayPal: 1357qrst'),
(6, 6, '[2, 5]', 260.00, 'shipped', 'CreditCard: 2468uvwx'),
(7, 7, '[1, 6]', 300.00, 'delivered', 'PayPal: 7890yzab'),
(8, 8, '[4, 8]', 200.00, 'cancelled', 'CreditCard: 0987cdef'),
(9, 9, '[3, 9]', 130.00, 'processing', 'PayPal: 1122ghij'),
(10, 10, '[2, 10]', 190.00, 'shipped', 'CreditCard: 3344klmn'),
(11, 1, '[1, 2]', 270.00, 'processing', 'PayPal: 1234abcd'),
(12, 2, '[3, 4]', 210.00, 'shipped', 'CreditCard: 4321efgh'),
(13, 3, '[5, 6]', 290.00, 'delivered', 'PayPal: 9876ijkl'),
(14, 4, '[7, 8]', 220.00, 'cancelled', 'CreditCard: 5678mnop'),
(15, 5, '[9, 10]', 160.00, 'processing', 'PayPal: 1357qrst'),
(16, 6, '[2, 5]', 260.00, 'shipped', 'CreditCard: 2468uvwx'),
(17, 7, '[1, 6]', 300.00, 'delivered', 'PayPal: 7890yzab'),
(18, 8, '[4, 8]', 200.00, 'cancelled', 'CreditCard: 0987cdef'),
(19, 9, '[3, 9]', 130.00, 'processing', 'PayPal: 1122ghij'),
(20, 10, '[2, 10]', 190.00, 'shipped', 'CreditCard: 3344klmn');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(10) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `size`, `stock`, `image_url`) VALUES
(1, 'Nike Air Max', 'Comfortable and stylish running shoes.', 120.00, '10', 50, 'https://example.com/nike_air_max.jpg'),
(2, 'Adidas Ultraboost', 'High-performance shoes with great cushioning.', 150.00, '9', 30, 'https://example.com/adidas_ultraboost.jpg'),
(3, 'Puma Classic', 'Retro style sneakers for casual wear.', 80.00, '8', 100, 'https://example.com/puma_classic.jpg'),
(4, 'Reebok Nano', 'Cross-training shoes built for performance.', 130.00, '11', 20, 'https://example.com/reebok_nano.jpg'),
(5, 'Under Armour Charged', 'Responsive and comfortable running shoes.', 110.00, '12', 40, 'https://example.com/ua_charged.jpg'),
(6, 'New Balance 990', 'High-quality running shoes for daily wear.', 180.00, '9.5', 25, 'https://example.com/nb_990.jpg'),
(7, 'Asics Gel Nimbus', 'Shoes with superior cushioning for long runs.', 160.00, '10.5', 35, 'https://example.com/asics_gel_nimbus.jpg'),
(8, 'Converse Chuck Taylor', 'Classic canvas sneakers.', 60.00, '7', 150, 'https://example.com/converse_ct.jpg'),
(9, 'Vans Old Skool', 'Skate shoes with iconic design.', 70.00, '8.5', 90, 'https://example.com/vans_old_skool.jpg'),
(10, 'Hoka One One', 'Maximalist running shoes for long distances.', 140.00, '10', 40, 'https://example.com/hoka_one_one.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'John Doe', 'john@example.com', 'hashedpassword1', 'customer'),
(2, 'Jane Smith', 'jane@example.com', 'hashedpassword2', 'customer'),
(3, 'Alice Johnson', 'alice@example.com', 'hashedpassword3', 'admin'),
(4, 'Bob Brown', 'bob@example.com', 'hashedpassword4', 'customer'),
(5, 'Charlie Davis', 'charlie@example.com', 'hashedpassword5', 'customer'),
(6, 'Diana Evans', 'diana@example.com', 'hashedpassword6', 'customer'),
(7, 'Ethan Green', 'ethan@example.com', 'hashedpassword7', 'customer'),
(8, 'Fiona Harris', 'fiona@example.com', 'hashedpassword8', 'admin'),
(9, 'George Irving', 'george@example.com', 'hashedpassword9', 'customer'),
(10, 'Helen Jackson', 'helen@example.com', 'hashedpassword10', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
