-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 03:06 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`) VALUES
(1, 'Abed Ghandour', 'abed@gmail.com', '123456', 'aa.png'),
(2, 'Deyaa Pozan', 'deyaa@gmail.com', '123456', '15280.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_image`) VALUES
(1, 'Watches', 'banner-07.jpg1597957124'),
(2, 'Bags', 'banner-08.jpg1597957143'),
(6, 'Accessories', 'acc.jpg1597959271'),
(7, 'Packages', 'paccc.jpg1597959379');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `order_date` date NOT NULL,
  `city` text NOT NULL,
  `detailed_location` text NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `provider_id` int(10) NOT NULL,
  `order_state` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_description` text NOT NULL,
  `prod_image` text NOT NULL,
  `prod_old_price` double(10,2) NOT NULL,
  `prod_new_price` double(10,2) NOT NULL,
  `category_id` int(255) NOT NULL,
  `provider_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_description`, `prod_image`, `prod_old_price`, `prod_new_price`, `category_id`, `provider_id`) VALUES
(1, 'GEMSTAR WATCH', 'Very Good Watch With high Quality and Water Proof.', 'menwatch1.jpg', 15.00, 10.00, 1, 1),
(2, 'Black Bag', 'very good Bag with high quality', 'bag.jpg', 12.00, 8.00, 2, 1),
(6, 'Gold Bracers', 'very good bracer with high Quality and stanless steal .', 'accessories.jpg1598364220', 13.00, 6.50, 6, 2),
(7, 'test', 'test', '109701503_753760945458529_1125506448157175211_o.jpg1601119758', 15.00, 10.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `prov_id` int(100) NOT NULL,
  `prov_name` varchar(255) NOT NULL,
  `prov_email` varchar(255) NOT NULL,
  `prov_password` varchar(255) NOT NULL,
  `prov_phone` varchar(15) NOT NULL,
  `prov_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`prov_id`, `prov_name`, `prov_email`, `prov_password`, `prov_phone`, `prov_logo`) VALUES
(1, 'Look-Alike', 'lookalikestore@gmail.com', 'ghandour', '0790714916', 'lookalikelogo.jpg'),
(2, 'Watch House', 'watch.house@gmail.com', '123', '0770770770', 'mencat2.jpg1597828304');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`prov_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `prov_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
