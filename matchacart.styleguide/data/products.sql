-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2026 at 05:55 PM
-- Server version: 10.11.19-MariaDB-cll-lve
-- PHP Version: 8.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EELVIRA_WNM608`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(32) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(128) NOT NULL,
  `images` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `date_create`, `date_modify`, `description`, `thumbnail`, `images`) VALUES
(1, 'Ceremonial Grade Matcha (30g)', 32.00, 'drinking ', '2026-11-03 17:19:21', '2026-11-03 17:19:21', 'First-harvest, stone-ground matcha with a smooth, naturally sweet taste. Best whisked with water in the traditional way.', 'drinking_ceremonial_matcha.png.webp', 'drinking_ceremonial_matcha.png.webp, drinking_ceremonial_matcha 2.png.webp.jpeg'),
(2, 'Everyday Latte Matcha (100g)', 28.00, 'drinking', '2026-11-03 17:24:54', '2026-11-03 17:24:54', 'A bold, vibrant blend made to stand up to milk. Ideal for lattes, iced drinks and smoothies.', 'drinking_everday_matcha.png', 'drinking_everday_matcha.png'),
(3, 'Culinary Baking Matcha (100g)', 18.00, 'baking', '2026-11-03 17:27:13', '2026-11-03 17:27:13', 'Robust flavor and bright color that holds up in cookies, cakes, pastries and ice cream.', 'baking_matcha.jpg.webp', 'baking_matcha.jpg.webp'),
(4, 'Culinary Matcha Bulk Bag (500g)', 55.00, 'baking', '2026-11-03 17:29:41', '2026-11-03 17:29:41', 'A large-format culinary grade for bakeries, cafés and frequent home bakers.', 'baking_matcha_bulk.webp', 'baking_matcha_bulk.webp'),
(5, 'Vanilla Matcha (80g)', 24.00, 'flavored', '2026-11-03 17:31:21', '2026-11-03 17:31:21', 'Premium matcha blended with natural vanilla for a creamy, dessert-like cup.', 'flavored_vanilla_matcha.png.webp', 'flavored_vanilla_matcha.png.webp'),
(6, 'Strawberry Matcha (80g)', 24.00, 'flavored', '2026-11-03 17:32:56', '2026-11-03 17:32:56', 'Matcha blended with freeze-dried strawberry for a fruity, naturally pink-tinted latte.', 'flavored_strawberry_matcha.png.webp', 'flavored_strawberry_matcha.png.webp'),
(7, 'Pure Matcha Green Tea Bags (20 ct)', 16.00, 'tea-bags', '2026-11-03 17:35:36', '2026-11-03 17:35:36', 'Japanese sencha coated with fine matcha for a quick, smooth cup with no whisk needed.', 'tea-bags_pure_matcha.webp', 'tea-bags_pure_matcha.webp'),
(8, 'Genmaicha Matcha Tea Bags (20 ct)', 14.00, 'tea-bags', '2026-11-03 17:38:31', '2026-11-03 17:38:31', 'Green tea with toasted brown rice and matcha, with a warm, nutty, comforting flavor.', 'tea-bags_genmaicha_matcha.jpg', 'tea-bags_genmaicha_matcha.jpg'),
(9, 'Uji Kyoto Matcha (30g)', 38.00, 'regional', '2026-11-03 17:41:04', '2026-11-03 17:41:04', 'From Uji, Kyoto, Japan’s most famous matcha region. Deep umami with a lingering sweet finish.', 'regional_ujikyoto_matcha.jpg.webp', 'regional_ujikyoto_matcha.jpg.webp'),
(10, 'Kagoshima Matcha (30g)', 34.00, 'regional', '2026-11-03 17:42:52', '2026-11-03 17:42:52', 'Grown in southern Japan’s volcanic soil, giving a fresh, bright and mellow character.', 'regional_kagoshima_matcha.jpg.webp', 'regional_kagoshima_matcha.jpg.webp'),
(11, 'Matcha Starter Gift Box', 78.00, 'gift-box', '2026-11-03 17:45:04', '2026-11-03 17:45:04', 'Ceremonial matcha, a bamboo whisk (chasen), a bamboo scoop (chashaku) and a ceramic bowl. Everything needed to start.', 'gift-box_starter_matcha.jpg.webp', 'gift-box_starter_matcha.jpg.webp, gift-box_starter_matcha 2.jpg'),
(12, 'Regional Matcha Sampler Gift Box', 65.00, 'gift-box', '2026-11-03 17:49:56', '2026-11-03 17:49:56', 'Three 20g tins from Uji, Yame and Nishio, so the recipient can taste how region shapes flavor.', 'regional_matcha_sampler.png.webp', 'regional_matcha_sampler.png.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
