-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2022 at 02:23 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp_nixon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `a_pseudo` varchar(255) NOT NULL,
  `a_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `a_name`, `a_pseudo`, `a_password`) VALUES
(1, 'administrateur', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_content` text NOT NULL,
  `blog_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_title`, `blog_content`, `blog_date`) VALUES
(3, 'RDC: Une Première dame cible d’attaques politiques coordonnées 123 modified ', 'Dans la guerre froide qui oppose Félix Tshisekedi à Moïse Katumbi autour du pouvoir, des méthodes aussi étranges que matoises sont utilisées du coté de l’ancien gouverneur du Katanga pour l’emporter. Denise Tshisekedi, Première Dame de la RDC est alors visée par la machine Katumbistes, tantôt dans la presse, tantôt dans des affaires touchant à la fois l’Église catholique ou même l’opposition.\r\n\r\n', '2022-08-13 11:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'informatique'),
(2, 'livre'),
(3, 'hi-fi');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `chat_message`, `chat_time`) VALUES
(6, 2, 'hello hello', '2022-08-01 21:07:19'),
(7, 2, 'abc abc abc', '2022-08-01 21:09:38'),
(8, 1, 'sita sita sita', '2022-08-01 21:23:12'),
(11, 0, 'abc', '2022-08-13 22:24:58'),
(12, 0, 'ehhhh', '2022-08-13 22:45:11'),
(13, 0, 'e', '2022-08-13 22:45:18'),
(14, 0, 'e', '2022-08-13 22:45:29'),
(15, 0, 'errt', '2022-08-13 22:49:23'),
(16, 0, 'tty665', '2022-08-13 22:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_date` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `blog_id`, `user_id`, `comment_date`) VALUES
(7, 'first comment user 2', 3, 2, '2022-08-13 21:28:54'),
(8, 'comment 2', 3, 2, '2022-08-13 21:33:21'),
(9, 'comment 3', 3, 2, '2022-08-13 21:33:26'),
(10, 'comment 4', 3, 2, '2022-08-13 21:33:29'),
(11, 'comment 5', 3, 2, '2022-08-13 21:33:34'),
(12, 'comment 6', 3, 2, '2022-08-13 21:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `connexion_attempts`
--

CREATE TABLE `connexion_attempts` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `con_status` int(11) NOT NULL DEFAULT 0,
  `con_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connexion_attempts`
--

INSERT INTO `connexion_attempts` (`id`, `u_id`, `con_status`, `con_date`) VALUES
(1, 2, 0, '2022-08-06 20:47:29'),
(2, 2, 0, '2022-08-11 20:57:13'),
(3, 2, 1, '2022-08-13 18:30:00'),
(4, 2, 0, '2022-08-13 22:04:43'),
(5, 2, 0, '2022-08-13 22:06:50'),
(6, 1, 1, '2022-08-13 22:08:43'),
(7, 2, 1, '2022-08-14 00:06:28'),
(8, 1, 1, '2022-08-14 00:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'pending',
  `order_number` int(11) NOT NULL DEFAULT 0,
  `order_date` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_price`, `order_status`, `order_number`, `order_date`) VALUES
(1, 2, '111.00', 'pending', 0, '2022-08-07 02:47:16'),
(2, 2, '111.00', 'pending', 0, '2022-08-07 02:47:23'),
(3, 2, '111.00', 'pending', 0, '2022-08-07 02:47:53'),
(4, 2, '111.00', 'pending', 0, '2022-08-07 03:00:19'),
(5, 2, '111.00', 'pending', 0, '2022-08-07 03:00:28'),
(6, 2, '111.00', 'pending', 0, '2022-08-07 03:01:18'),
(7, 2, '111.00', 'pending', 0, '2022-08-07 03:01:19'),
(8, 2, '86.00', 'success', 432, '2022-08-07 03:01:55'),
(9, 2, '137.00', 'success', 594, '2022-08-07 03:18:50'),
(10, 1, '152.00', 'success', 166, '2022-08-07 04:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id`, `order_id`, `prod_id`, `prod_qty`, `sub_total`) VALUES
(1, 10, 3, 1, '12.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_code` varchar(25) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_code`, `prod_name`, `prod_price`, `cat_id`) VALUES
(1, 'ab9098', 'livre1', 15, 2),
(2, 'ab9001', 'livre2', 25, 2),
(3, 'ab9012', 'souris', 12, 1),
(6, 'a568f98289', 'prod new2', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_fname` varchar(255) NOT NULL,
  `u_lname` varchar(255) NOT NULL,
  `u_adress` text NOT NULL,
  `u_postal_code` varchar(25) NOT NULL,
  `u_date_of_birth` varchar(50) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_pseudo` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_fname`, `u_lname`, `u_adress`, `u_postal_code`, `u_date_of_birth`, `u_email`, `u_pseudo`, `u_password`, `u_status`) VALUES
(1, 'glee', 'sita', 'luadi 9850', '00243', '1988-05-12', 'javadb2030@gmail.com', 'sitaglee', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'renathe', 'lembe', 'luadi 98100', '00244', '1994-12-12', 'abc@gmail.com', 'renalembe', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `connexion_attempts`
--
ALTER TABLE `connexion_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `connexion_attempts`
--
ALTER TABLE `connexion_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `connexion_attempts`
--
ALTER TABLE `connexion_attempts`
  ADD CONSTRAINT `connexion_attempts_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `connexion_attempts_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
