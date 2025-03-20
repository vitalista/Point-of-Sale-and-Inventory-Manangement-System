-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 07:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mnj`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(99) NOT NULL,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(10, 'Paint', 'asdasd'),
(11, 'Brush', ''),
(12, 'Body Filler', ''),
(13, 'Tape', ''),
(14, 'Thinner', ''),
(16, 'Paint Supplies', ''),
(17, 'Primer Coat', ''),
(18, 'Top Coat', ''),
(19, 'Epoxy Paint', ''),
(20, 'Latex Paint', ''),
(21, 'Enamel Paint', ''),
(22, 'Acrylic Paint', ''),
(23, 'Spray Paint', ''),
(24, 'Urethane Paint', ''),
(25, 'Laquer Paint', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(23, 'Aries Cus', '123smb', '1234567890', '2024-04-27'),
(25, 'None', '', 'None', '2023-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `orders_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `orders_status`, `payment_mode`, `order_placed_by_id`) VALUES
(43, 25, '81280', 'INV-557793', '145', '2024-05-09', 'booked', '', 10),
(44, 25, '51444', 'INV-548011', '260', '2024-05-09', 'booked', '', 10),
(45, 25, '17873', 'INV-858461', '440', '2024-05-09', 'booked', '', 10),
(46, 25, '85481', 'INV-902040', '60', '2024-05-09', 'booked', '', 10),
(47, 25, '60009', 'INV-917978', '560', '2024-05-09', 'booked', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `item_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `item_date`) VALUES
(62, 43, 115, '25', 1, '2024-05-10'),
(63, 43, 117, '40', 1, '2024-05-09'),
(64, 43, 121, '80', 1, '2024-05-08'),
(65, 44, 123, '100', 1, '2024-05-09'),
(66, 44, 122, '80', 1, '2024-05-13'),
(67, 44, 121, '80', 1, '2024-05-20'),
(68, 45, 118, '360', 1, '2025-05-09'),
(69, 45, 121, '80', 1, '2023-05-09'),
(70, 46, 114, '30', 2, '2024-05-09'),
(71, 47, 122, '80', 7, '2024-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `size` varchar(255) NOT NULL,
  `numeric_size` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `grit_size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `created_at`, `size`, `numeric_size`, `volume`, `grit_size`, `type`, `color`) VALUES
(111, 'BRSH01', 11, 'Brush', '', 18, 0, '', '2024-04-27', '', '', '', '', '', ''),
(112, 'BRSH02', 11, 'Brush', '', 20, 0, '', '2024-04-27', '', '3/8', '', '', '', ''),
(113, 'BRSH03', 11, 'Brush', '', 25, 0, '', '2024-04-27', '', '1', '', '', '', ''),
(114, 'BRSH04', 11, 'Brush', '', 30, 34, '', '2024-04-27', '', '1 1/2', '', '', '', ''),
(115, 'MSKNGTP01', 13, 'Masking Tape', '', 25, 56, '', '2024-04-27', '', '1/2', '', '', '', ''),
(116, 'MSKNG02', 13, 'Masking Tape', '', 30, 13, '', '2024-04-27', '', '3/8', '', '', '', ''),
(117, 'THNNR01', 14, 'Paint Thinner', '', 40, 11, '', '2024-04-27', '', '', '1 Bottle', '', '', ''),
(118, 'THNNR02', 14, 'Pain Thinner', '', 360, 29, '', '2024-04-27', '', '', '1 gal', '', '', ''),
(119, 'RTHN01', 24, 'Urethane Paint', '', 80, 45, '', '2024-04-27', '', '', '1/2L', '', '', ''),
(120, 'BYSNRGRD01', 10, 'Boysen RoofGuard', '', 620, 0, '', '2024-04-27', '', '', '1gal', '', '', 'Blue'),
(121, 'CRLCPNT01', 22, 'Acrylic Paint', '', 80, 14, '', '2024-04-27', '', '', '1/4L', '', '', ''),
(122, 'PXYPRMR', 0, 'Epoxy Primer', '1/4L', 80, 48, '', '2024-04-27', '', '', '', '', '', ''),
(123, 'BYSNRGRD02', 10, 'Boysen RoofGuard', '', 100, 85, '', '2024-04-27', '', '', '1 gal', '', '', 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `purchase_order_date` date NOT NULL,
  `orders_status` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL COMMENT 'cash, online',
  `confirmation` tinyint(1) DEFAULT 0 COMMENT '0=not_confirm,1=confirmed',
  `order_placed_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `supplier_id`, `tracking_no`, `total_amount`, `purchase_order_date`, `orders_status`, `payment_mode`, `confirmation`, `order_placed_by_id`) VALUES
(58, 7, '73443', 145, '2024-05-09', 'placed', 'Cash Payment', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(104, 57, 112, 20, 5),
(105, 57, 123, 100, 1),
(106, 57, 122, 80, 1),
(107, 57, 114, 30, 7),
(108, 58, 112, 20, 6),
(109, 58, 115, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `send_otp`
--

CREATE TABLE `send_otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `send_otp`
--

INSERT INTO `send_otp` (`id`, `email`, `password`, `date`) VALUES
(1, 'vitalista.ariesg@gmail.com', 'jrpoqsusluvfxlqf', '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `created_at`) VALUES
(7, 'Paint sup', 'asdasdBalawi', '0912354658', '2024-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not_ban,1=ban',
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `user_role` varchar(5) NOT NULL,
  `can_create` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=can_create,0=not',
  `can_edit` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=can_edit,0=not',
  `can_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=can_delete,0=not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `is_ban`, `created_at`, `user_role`, `can_create`, `can_edit`, `can_delete`) VALUES
(10, 'Aries', 'admin@gmail.com', '$2y$10$BAgo65bnTuXAIKRijz9pOe2q7PglDqo0xZL0Tnpmif9dwK0vLFiQC', '09123456789', 0, '2024-02-19', 'ADMIN', 1, 1, 1),
(26, 'standard', 'standard@gmail.com', '$2y$10$sOjzQXp30pDTJMFQO7HoxOmHgA8bhZFrinwQhImrSmuhZ9nZCKHIu', '09123456789', 0, '2024-04-28', 'USER', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_otp`
--
ALTER TABLE `send_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `send_otp`
--
ALTER TABLE `send_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
