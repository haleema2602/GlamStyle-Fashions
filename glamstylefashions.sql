-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 10:27 AM
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
-- Database: `glamstylefashions`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `image`, `title`, `description`, `created_at`) VALUES
(1, 'img/blog-1.jpg', 'Summer Style Vibes', 'Fresh and breezy summer looks for every wardrobe.', '2025-05-14 16:23:36'),
(2, 'img/blog-2.jpg', 'Jewellery', 'Add a touch of elegance with our finely crafted jewellery. From timeless classics to modern designs, each piece is made to shine and elevate your everyday or special occasion look.', '2025-05-14 16:25:09'),
(3, 'img/blog-3.jpg', 'Mat', 'Durable, non-slip, and stylish this mat is perfect for your home, gym, or office. Easy to clean and designed for daily use, it adds comfort and function to any space.', '2025-05-14 16:25:26'),
(4, 'img/blog-4.jpg', 'Wardrobe Building', 'Create a timeless and versatile wardrobe with our curated collection of essentials. From classic staples to trendy pieces.', '2025-05-14 16:26:13'),
(5, 'img/blog-5.jpg', 'Kids Wear', 'Bright, comfy, and full of fun! Our kids wear collection features playful designs, soft fabrics, and perfect fits made to keep up with every adventure your little one takes.', '2025-05-14 16:26:29'),
(6, 'img/blog-6.jpg', 'Shopping Basket', 'Sturdy, lightweight, and easy to carry this shopping basket is perfect for quick grocery runs or home organization. Designed with a strong handle and spacious interior for everyday convenience.', '2025-05-14 16:26:53'),
(7, 'img/blog-7.jpg', 'Stylish Wear', 'Turn heads with our latest collection of stylish wear where fashion meets comfort from chic cuts to bold designs, each piece is crafted to express your unique style with confidence.', '2025-05-14 16:27:07'),
(8, 'img/blog-8.jpg', 'Footwear', 'Step out in style with our versatile footwear collection. Designed for comfort and crafted for trendsetters, these shoes are perfect for everyday wear, special occasions, and everything in between.', '2025-05-14 16:27:19'),
(9, 'img/blog-9.jpg', 'T-Shirts', 'Soft, breathable, and effortlessly cool this T-shirt is your go to for everyday comfort with a perfect fit and stylish design, it\'s ideal for casual wear, lounging, or layering.', '2025-05-14 16:27:34'),
(10, 'img/blog-10.jpg', 'Earrings', 'Delicate yet striking, our earrings are designed to add a touch of sparkle to any outfit. From classic studs to bold statement pieces, find the perfect pair for every occasion.', '2025-05-14 16:27:48'),
(11, 'img/blog-11.jpg', 'Dupatta', 'Elegant and timeless, this dupatta adds a perfect finishing touch to any ethnic outfit. Made with soft, flowing fabric and beautiful detailing.', '2025-05-14 16:28:10'),
(12, 'img/blog-12.jpg', 'Shoes', 'Step into comfort and style with our premium shoe collection. Designed for everyday wear and special occasions, these shoes offer the perfect blend of durability, fit, and fashion-forward design.', '2025-05-14 16:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `full_name`, `email`, `message`, `created_at`) VALUES
(1, 'haleema darudwale', 'haleemakousardarudwale@gmail.com', 'hiii!we like your order', '2025-05-27 16:25:33'),
(2, 'sangeeta', 'sangeeta123@gmail.com', 'hello!!', '2025-05-29 05:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_size` varchar(20) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `special_notes` text DEFAULT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `payment_method` varchar(50) DEFAULT 'COD',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_title`, `product_price`, `product_image`, `product_size`, `product_color`, `special_notes`, `customer_name`, `customer_contact`, `customer_address`, `payment_method`, `order_date`) VALUES
(1, 'Unknown Product', 0.00, 'img/default.jpg', 'S', 'black', NULL, 'sana', '6733378355', 'hubli', 'COD', '2025-05-28 08:56:49'),
(2, 'Unknown Product', 0.00, 'img/default.jpg', 'S', 'black', NULL, 'sana', '6733378355', 'hubli', 'COD', '2025-05-28 09:01:46'),
(3, 'Elegant Evening Frock', 500.00, 'img/product-2.jpg', 'M', 'black', NULL, 'sana', '6733378355', 'hubli', 'COD', '2025-05-28 10:08:58'),
(4, 'Elegant Evening Frock', 500.00, 'img/product-2.jpg', 'M', 'black', NULL, 'sudee', '9110878212', 'raichur', 'COD', '2025-05-28 10:10:55'),
(5, 'Earpods', 6.00, 'img/product-11.jpg', 'S', 'red', 'no', 'kousar', '9809876589', 'bangalore', 'COD', '2025-05-29 04:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(12) NOT NULL,
  `image` varchar(200) NOT NULL,
  `title` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `description`, `quantity`, `price`, `image`, `title`, `created_at`) VALUES
(1, 'Light & breezy, perfect for sunny days.', '1', '200.00', 'img/product-1.jpg', 'Chic Summer Top', '2025-05-26 11:47:23'),
(2, 'Perfect for a night out.', '1', '500.00', 'img/product-2.jpg', 'Elegant Evening Frock', '2025-05-26 11:48:26'),
(3, 'Stay connected in style with this sleek smartwatch. Track your fitness, monitor your health, receive notifications, and control music all from your wrist. Designed for comfort and built for performance.', '1', '999.00', 'img/product-3.jpg', 'Smart Watch', '2025-05-26 11:49:33'),
(4, 'Redefine your style with these lightweight, high-fashion spectacles. Designed for comfort and clarity, they offer a perfect blend of trend and function for everyday elegance.', '1', '850.00', 'img/product-4.jpg', 'Elegant Vision Spectacles', '2025-05-26 11:49:54'),
(5, 'Comfort meets style in this soft, breathable T-shirt,perfect for casual outings or layering, designed to keep you looking cool and feeling comfortable all day.', '1', '350.00', 'img/product-5.jpg', 'T-shirt', '2025-05-26 11:52:56'),
(6, 'Experience crystal-clear sound and deep bass with these high-performance headphones,designed for comfort and built for style, they deliver immersive audio whether you are working, gaming, or relaxing.', '1', '499.00', 'img/product-6.jpg', 'HeadPhones', '2025-05-26 11:53:47'),
(7, 'Compact and stylish.', '1', '1400.00', 'img/product-7.jpg', 'Purse', '2025-05-26 11:54:07'),
(8, 'Shine with these classic earrings, perfect for both everyday glam and evening elegance.', '1', '1900.00', 'img/product-8.jpg', 'Earrings', '2025-05-26 11:55:27'),
(9, 'Elevate your style.', '1', '1500.00', 'img/product-9.jpg', 'High-heels Elegance', '2025-05-26 11:55:45'),
(10, 'Navigate with accuracy and ease using this ergonomic wireless mouse with smooth tracking, fast response, and a comfortable grip,perfect for work, gaming, or everyday use.', '1', '100.00', 'img/product-10.jpg', 'Precision Glide Wireless Mouse', '2025-05-26 11:56:34'),
(11, 'Wireless audio freedom.', '1', '6500.00', 'img/product-11.jpg', 'Earpods', '2025-05-26 11:59:27'),
(12, 'Mirrorless power with lightning fast autofocus, perfect for capturing runway looks and behind the scenes glam.', '1', '2320.00', 'img/product-12.jpg', 'Sony Alpha a6400 - Style Meets', '2025-05-26 12:00:20'),
(13, 'Work and entertainment.', '1', '11450.00', 'img/product-13.jpg', 'Laptop', '2025-05-26 12:04:30'),
(14, 'Stay warm in style.', '1', '780.00', 'img/product-14.jpg', 'Hoody', '2025-05-26 12:04:46'),
(15, 'Next-gen gaming fun.', '1', '7480.00', 'img/product-15.jpg', 'PS-4', '2025-05-26 12:05:04'),
(16, 'Latest mobile tech.', '1', '116700.00', 'img/product-16.jpg', 'Phones', '2025-05-26 12:05:19'),
(17, 'Trendy and comfortable.', '1', '2900.00', 'img/product-17.jpg', 'Stylish Elegance-Shoes', '2025-05-26 12:05:36'),
(18, 'Perfect for cooler days.', '1', '1890.00', 'img/product-18.jpg', 'Jacket', '2025-05-26 12:05:52'),
(19, 'Rich color with a smooth matte finish for all-day glam.', '1', '890.00', 'img/product-19.jpg', 'Lipstick', '2025-05-26 12:06:08'),
(20, 'Timeless design to add charm to every outfit.', '1', '330.00', 'img/product-20.jpg', 'Rings', '2025-05-26 12:06:27'),
(21, 'Delicate and trendy, perfect for everyday elegance.', '1', '500.00', 'img/product-21.jpg', 'Bracelet', '2025-05-26 12:07:49'),
(22, 'Soft, breathable comfort for all-day wear.', '1', '200.00', 'img/product-22.jpg', 'Cozy Ankle Socks', '2025-05-26 12:08:03'),
(23, 'Bold and beautiful, perfect to elevate any look.', '1', '600.00', 'img/product-23.jpg', 'Necklace', '2025-05-26 12:57:10'),
(24, 'Spacious, stylish, and perfect for work or travel.', '1', '250.00', 'img/product-24.jpg', 'Trendy Backpack', '2025-05-26 12:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(2, 'ADMIN'),
(1, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_number`, `email`, `password`, `first_name`, `last_name`, `created_at`) VALUES
(1, '9916015222', 'haleemakousardarudwale@gmail.com', '$2y$10$a.e02YUCyT0Kg2SZ0Ofm.eH52JnzvrtigBx0HUS0aDxKMzXTEtJ8S', 'haleema', 'darudwale', '2025-05-26 10:58:41'),
(2, '9110878212', 'sudeepthihiremath@gmail.com', '$2y$10$q6BxsrpkuK/DEpyRLxfIFu/PewvIxQzBT.oZvDQn8duIkiPGkwSB6', 'sudeepthi', 'hiremath', '2025-05-27 05:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_roles_name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_users_email` (`email`),
  ADD UNIQUE KEY `uq_users_phone_number` (`phone_number`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `fk_users_roles_role` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `fk_users_roles_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_users_roles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
