-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 12:53 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juan_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_name`, `car_name`, `car_brand`, `description`, `subtotal`, `image_path`, `created_at`) VALUES
(22, '', 'Eg Hatch', '21', 'Honda Civic Eg Hatch 2020', '25.00', '../assets/uploads/Eg Hatch.jpg', '2023-05-26 16:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(19, 'Mazda'),
(20, 'Mitsubishi'),
(21, 'Honda'),
(22, 'Nissan'),
(23, 'Toyota'),
(24, 'Ford'),
(25, 'Ferrari'),
(26, 'Lamborghini'),
(27, 'Hyundai'),
(28, 'Suzuki'),
(30, 'Volks Wagon');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_brand` int(11) NOT NULL,
  `description` text NOT NULL,
  `price_hour` decimal(10,2) NOT NULL,
  `price_daily` decimal(10,2) NOT NULL,
  `price_monthly` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_brand`, `description`, `price_hour`, `price_daily`, `price_monthly`, `image_path`) VALUES
(26, 'Civic', 21, 'Honda Civic SiR 1999', '28.00', '200.00', '900.00', '../assets/uploads/SiR.jpg'),
(27, 'RX7', 19, 'Mazda RX7 TYPE RB 2002', '40.00', '280.00', '1200.00', '../assets/uploads/rx7.jpg'),
(34, 'Skyline', 22, 'Nissan Skyline R32 GTR V Spec 2 1994', '40.00', '250.00', '1100.00', '../assets/uploads/skyline.jpg'),
(36, 'Lancer', 20, 'Lancer Evolution VIII', '25.00', '100.00', '4321.00', '../assets/uploads/evo.png'),
(39, 'Supra', 23, 'Supra MK4 1995', '25.00', '150.00', '4500.00', '../assets/uploads/supra.jpg'),
(40, 'Vios', 23, 'Toyota Vios 2020', '25.00', '100.00', '3000.00', '../assets/uploads/vios.jpg'),
(41, 'Montero', 20, 'Mitsubishi Montero Sport', '20.00', '150.00', '3000.00', '../assets/uploads/montero.jpg'),
(42, 'Raptor', 24, 'Ford Raptor 2021', '20.00', '100.00', '4500.00', '../assets/uploads/raptor.jpg'),
(43, '370Z ', 22, 'Nissan 370Z Heritage Edition', '25.00', '250.00', '3000.00', '../assets/uploads/Nissan 370Z.jpg'),
(44, 'Eg Hatch', 21, 'Honda Civic Eg Hatch 2020', '25.00', '150.00', '3000.00', '../assets/uploads/Eg Hatch.jpg'),
(45, 'Ranger', 24, 'Ford Ranger 2021', '15.00', '100.00', '2000.00', '../assets/uploads/ranger.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `car_id` int(11) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_brand` varchar(255) NOT NULL,
  `description` text,
  `price_hour` decimal(10,2) NOT NULL,
  `price_daily` decimal(10,2) NOT NULL,
  `price_monthly` decimal(10,2) NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_name`, `car_id`, `car_name`, `car_brand`, `description`, `price_hour`, `price_daily`, `price_monthly`, `image_path`, `created_at`) VALUES
(37, 'svenn', 40, 'Vios', '23', 'Toyota Vios 2020', '25.00', '100.00', '3000.00', '../assets/uploads/vios.jpg', '2023-05-26 15:27:57'),
(38, 'svenn', 41, 'Montero', '20', 'Mitsubishi Montero Sport', '20.00', '150.00', '3000.00', '../assets/uploads/montero.jpg', '2023-05-26 15:27:58'),
(39, 'user', 44, 'Eg Hatch', '21', 'Honda Civic Eg Hatch 2020', '25.00', '150.00', '3000.00', '../assets/uploads/Eg Hatch.jpg', '2023-05-26 16:45:19'),
(40, 'user', 39, 'Supra', '23', 'Supra MK4 1995', '25.00', '150.00', '4500.00', '../assets/uploads/supra.jpg', '2023-05-26 16:45:23'),
(41, 'user', 41, 'Montero', '20', 'Mitsubishi Montero Sport', '20.00', '150.00', '3000.00', '../assets/uploads/montero.jpg', '2023-05-26 16:45:25'),
(42, 'user', 27, 'RX7', '19', 'Mazda RX7 TYPE RB 2002', '40.00', '280.00', '1200.00', '../assets/uploads/rx7.jpg', '2023-05-26 17:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(4, 'its me', 'walar@rfdsa', 'tfidasjfsa', '2023-05-26 10:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `created_at`) VALUES
(1, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2023-05-15 05:26:05'),
(2, 'regie', 'regie@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', '2023-05-15 10:40:25'),
(3, 'user', 'user@user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', '2023-05-15 12:52:59'),
(4, 'Regie', 'regie@admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2023-05-17 11:10:19'),
(5, 'Regie', 'regie@user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', '2023-05-19 06:36:37'),
(6, 'svenn', 'regiealquisar@user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', '2023-05-22 05:27:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_brand` (`car_brand`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`car_brand`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
