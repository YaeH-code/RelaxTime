-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2024 at 09:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `relaxtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(7, 'Coffee', '2024-06-21 21:44:42'),
(10, 'Tea', '2024-06-23 16:22:50'),
(11, 'Herve tea', '2024-06-23 16:32:38'),
(12, 'etc', '2024-06-23 16:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `comment` varchar(255) NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `img`, `created_at`, `category_id`, `user_id`) VALUES
(20, 'RoseHip Tea', 'The rose family (Rosaceae) is one of the most beloved botanical groups; humans have had a deep affinity with these plants for thousands and thousands of years.\r\n\r\nThe fruit of roses, rose hips, is a delicious wild edible. These fruits are nutritious and tart and can be brewed into a vitamin-rich tea, especially vitamins A and C. Although citrus fruits are known to be an excellent source of vitamin C, rosehips actually contain a higher concentration of this important vitamin and are in fact one of the richest botanical sources.\r\n\r\nRosehips help reduce inflammation associated with autoimmune diseases. They also facilitate the digestive system, have a laxative effect on the colon', '57901_tea-rosehip.jpg', '2024-06-23 16:16:31', 11, 5),
(21, 'Oriental Beauty', 'Oriental Beauty (or Dong Fang Mei Ren) is one of the most prestigious Taiwanese oolongs. Coming from a natural farming garden, this Oriental beauty was aged for several years before being refreshed (light cooking with charcoal) by Mr Gao Dingshi, legend of natural tea in Taiwan. This tea takes us into the world of vintage oolong (a Taiwanese institution in the same way as wine here), carried by its delicate aromas (honey, fruits, spices) but even more by its beautiful energy and depth. A little gem, a real invitation to relaxation.', '30830_tea-oolang.jpg', '2024-06-23 16:22:16', 10, 5),
(22, 'JAMAICA BLUE MOUNTAIN', 'Blue Mountain coffee beans are some of the best in the world. This coffee is grown on the mountain range which occupies the eastern third of the island of Jamaica: the Blue Mountain range. The climate, soil and altitude (between 910 and 1700 meters) favor its growth. \r\nTesting Note :\r\nPrestigious coffee selected from one of the most beautiful farms in the Montagne Bleue for a particularly harmonious cup.\r\nA cup with sweet notes of cocoa and hazelnut enhanced with a lovely fruitiness with accents of grapefruit.\r\n\r\n', '25756_coffee-sack-2296123_1280.jpg', '2024-06-23 16:32:09', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Amandine Cherryz', 'amandine.che@gmail.com', '$2y$10$bYqO8q/l72WBnkPPl62uROMz6HcsEEVM5G5UhANk6nyZsRf/rsk26', 'user'),
(2, 'Andre Langlois', 'an.langlois@outlook.com', '$2y$10$6Zy6NZlFMKPZ77xoFrkUq.1wdMx2LMS0ZkHZsq3sS.lGmKfix5F16', 'admin'),
(4, 'Jean Doe', 'je_Doe23@gmail.com', '$2y$10$tNIgjZlDOgIuulOvplhbZ.HL3WObUR4Bf6iEcx11juTqTbY6IpQ0e', 'user'),
(5, 'Hector Henri', 'heHenri@outlook.com', '$2y$10$7LqihRtt8Sol5k.GizHLt./nP2kEE0T07JT.PGTxPmhlqa.RAgYvS', 'user'),
(6, 'Cyrille', 'joe.marcel@gmail.com', '$2y$10$9vOOagRkO1rYy49Jy8Ums.8UQDjZ1jyuWX7N4AXMZlLn.kOsjUFK6', 'user'),
(7, 'Julie Dupont', 'Julie.Du@outlook.fr', '$2y$10$6avvZ.Vh7BLtxlIMdtoTT.Rvk.PL/lZOLPUcSZLnsKnehyFzljPs2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `comment_user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
