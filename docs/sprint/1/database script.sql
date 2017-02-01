-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2017 at 09:49 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rbh_rbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE IF NOT EXISTS `claim` (
  `id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  `product_style` varchar(40) NOT NULL,
  `repair_center_id` int(10) unsigned NOT NULL,
  `date_opened` date NOT NULL,
  `date_closed` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`id`, `customer_id`, `product_style`, `repair_center_id`, `date_opened`, `date_closed`) VALUES
(1, 1, '06922029WAB', 1, '2017-01-18', NULL),
(2, 2, '087210404WB', 1, '2017-01-03', '2017-01-18'),
(3, 3, '6612P001SET', 1, '2017-01-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `claim_comment`
--

CREATE TABLE IF NOT EXISTS `claim_comment` (
  `id` int(10) unsigned NOT NULL,
  `claim_id` int(10) unsigned NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claim_comment`
--

INSERT INTO `claim_comment` (`id`, `claim_id`, `author`, `date`, `comment`) VALUES
(1, 1, 'dbarnett', '2017-01-19', '2 Broken wheels on 22" Silver Mars Vista bag, ordering new wheels'),
(2, 2, 'dbarnett', '2017-01-13', 'Broken zipper, ordering new zipper'),
(3, 2, 'dbarnett', '2017-01-18', 'Zipper repaired, closing claim');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(60) NOT NULL,
  `address_2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(5) NOT NULL,
  `zip` varchar(9) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `address_2`, `city`, `state`, `zip`, `phone`, `extension`, `email`, `comments`) VALUES
(1, 'Jim Test', '1509 Test Ln', '', 'Testville', 'WA', '98493', '1238491239', '', 'jimtest@tester.com', 'Broken Mars Vista 2014 bag'),
(2, 'Sabrina Testol', '3491 Test Dr', '', 'Testington', 'TX', '32841', '1280592374', '', 'sabrina@tester.com', 'Some comments about why Sabrina is in the database'),
(3, 'Charlie Smith', '182738 Smith St', 'Apt C', 'Jacksonville', 'FL', '34782', '8378123738', '', 'charliesmith@tester.com', 'Wheel broke on Ocean Drive 2016 19"');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `part_number` varchar(40) NOT NULL,
  `category` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`part_number`, `category`, `description`) VALUES
('2347898', 'HANDLE', 'Pull Handle'),
('Z39498938', 'ZIPPER', 'Standard zipper');

-- --------------------------------------------------------

--
-- Table structure for table `part_order`
--

CREATE TABLE IF NOT EXISTS `part_order` (
  `id` int(10) unsigned NOT NULL,
  `claim_id` int(10) unsigned NOT NULL,
  `order_date` date NOT NULL,
  `ship_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_order`
--

INSERT INTO `part_order` (`id`, `claim_id`, `order_date`, `ship_date`) VALUES
(1, 2, '2017-01-13', '2017-01-14'),
(2, 1, '2017-01-19', '2017-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `part_order_comment`
--

CREATE TABLE IF NOT EXISTS `part_order_comment` (
  `id` int(10) unsigned NOT NULL,
  `part_order_id` int(10) unsigned NOT NULL,
  `author` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_order_comment`
--

INSERT INTO `part_order_comment` (`id`, `part_order_id`, `author`, `date`, `comment`) VALUES
(1, 1, 'dbarnett', '2017-01-13', 'Order new zipper'),
(2, 2, 'dbarnett', '2017-01-19', 'Order 2 new wheels');

-- --------------------------------------------------------

--
-- Table structure for table `part_order_part`
--

CREATE TABLE IF NOT EXISTS `part_order_part` (
  `id` int(10) unsigned NOT NULL,
  `part_order_id` int(10) unsigned NOT NULL,
  `part_number` varchar(40) NOT NULL,
  `quantity` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_order_part`
--

INSERT INTO `part_order_part` (`id`, `part_order_id`, `part_number`, `quantity`) VALUES
(1, 1, 'Z39498938', 1),
(2, 2, '2347898', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `style` varchar(40) NOT NULL,
  `description` varchar(80) NOT NULL,
  `brand` varchar(40) NOT NULL,
  `warranty_years` tinyint(4) NOT NULL,
  `color` varchar(20) NOT NULL,
  `class` varchar(15) NOT NULL,
  `class_description` varchar(80) NOT NULL,
  `launch_date` date NOT NULL,
  `discontinued` date DEFAULT NULL,
  `wholesale` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`style`, `description`, `brand`, `warranty_years`, `color`, `class`, `class_description`, `launch_date`, `discontinued`, `wholesale`) VALUES
('06922029WAB', '22" Silver Mars Vista 2014', 'Ricardo Beverly Hills', 10, '', '738', '22" Mobile', '2015-01-15', NULL, '125.00'),
('087210404WB', 'OCEAN DRIVE 21-INCH CARRY-ON SPINNER UPRIGHT', 'Ricardo Beverly Hills', 10, '', '723', '21-INCH CARRY-ON', '2016-12-07', NULL, '205.00'),
('6612P001SET', '2PC SET', 'Ricardo Beverly Hills', 10, 'Maroon', '661', 'Newcastle 2014', '2014-07-29', NULL, '113.00');

-- --------------------------------------------------------

--
-- Table structure for table `repair_center`
--

CREATE TABLE IF NOT EXISTS `repair_center` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(5) NOT NULL,
  `zip` varchar(9) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `repair_center`
--

INSERT INTO `repair_center` (`id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `fax`) VALUES
(1, 'Ricardo Beverly Hills Kent', '6329 SOUTH 226TH ST', 'KENT', 'WA', '98032', '(425)207-1929', '(425)207-1930');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Duante Barnett', 'dbarnett@ricardobeverlyhills.com', '$2y$10$8DJ81sGX8.05lL8Kc739UeUsAKKdru5DfXVFtujMFThBVKmCDzxMm', 'o7geUUE0jNrG44Ys66dv6dPFIrAsumZc7pHCjEMMUi8xc0uQO0pNSGupC85W', '2017-01-22 16:08:10', '2017-01-25 13:55:39'),
(2, 'Arnold Koh', 'arnold@kohded.com', '$2y$10$ArhFvpmfb5gOTnPVFshGt.tlzn0UMd9RmiNiNKOHHPQeQgGZEHz.O', 'FI2IjsD4McP8iYrBbQWHwIbcu4VOvW82yDKVu8o9B7Qkbx2W0lIIJI0zyHGt', '2017-01-24 11:09:45', '2017-01-24 11:10:15'),
(3, 'ACP', 'acp@acp.com', '$2y$10$qeSkJ/ubMrXtBn1vbGX9Fusf9R9O83.aRu813lbiPMFt4ZynBkDJK', NULL, '2017-01-25 09:56:02', '2017-01-25 09:56:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `product_id` (`product_style`), ADD KEY `repair_center_id` (`repair_center_id`);

--
-- Indexes for table `claim_comment`
--
ALTER TABLE `claim_comment`
  ADD PRIMARY KEY (`id`), ADD KEY `claim_id` (`claim_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`part_number`);

--
-- Indexes for table `part_order`
--
ALTER TABLE `part_order`
  ADD PRIMARY KEY (`id`), ADD KEY `claim_id` (`claim_id`);

--
-- Indexes for table `part_order_comment`
--
ALTER TABLE `part_order_comment`
  ADD PRIMARY KEY (`id`), ADD KEY `part_order_id` (`part_order_id`);

--
-- Indexes for table `part_order_part`
--
ALTER TABLE `part_order_part`
  ADD PRIMARY KEY (`id`), ADD KEY `part_order_id` (`part_order_id`), ADD KEY `part_number` (`part_number`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`style`);

--
-- Indexes for table `repair_center`
--
ALTER TABLE `repair_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `claim_comment`
--
ALTER TABLE `claim_comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `part_order`
--
ALTER TABLE `part_order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `part_order_comment`
--
ALTER TABLE `part_order_comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `part_order_part`
--
ALTER TABLE `part_order_part`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `repair_center`
--
ALTER TABLE `repair_center`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim`
--
ALTER TABLE `claim`
ADD CONSTRAINT `claim_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `claim_ibfk_2` FOREIGN KEY (`product_style`) REFERENCES `product` (`style`),
ADD CONSTRAINT `claim_ibfk_3` FOREIGN KEY (`repair_center_id`) REFERENCES `repair_center` (`id`);

--
-- Constraints for table `claim_comment`
--
ALTER TABLE `claim_comment`
ADD CONSTRAINT `claim_comment_ibfk_1` FOREIGN KEY (`claim_id`) REFERENCES `claim` (`id`);

--
-- Constraints for table `part_order`
--
ALTER TABLE `part_order`
ADD CONSTRAINT `part_order_ibfk_1` FOREIGN KEY (`claim_id`) REFERENCES `claim` (`id`);

--
-- Constraints for table `part_order_comment`
--
ALTER TABLE `part_order_comment`
ADD CONSTRAINT `part_order_comment_ibfk_1` FOREIGN KEY (`part_order_id`) REFERENCES `part_order` (`id`);

--
-- Constraints for table `part_order_part`
--
ALTER TABLE `part_order_part`
ADD CONSTRAINT `part_order_part_ibfk_1` FOREIGN KEY (`part_order_id`) REFERENCES `part_order` (`id`),
ADD CONSTRAINT `part_order_part_ibfk_2` FOREIGN KEY (`part_number`) REFERENCES `part` (`part_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
