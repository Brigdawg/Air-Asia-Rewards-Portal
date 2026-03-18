-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2026 at 02:16 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rewards`
--

-- --------------------------------------------------------

--
-- Table structure for table `USER`
-- (Created first because ACCOUNT references it via foreign key)
--

CREATE TABLE `USER` (
  `userId` int NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`userId`, `userName`, `password`, `firstName`, `lastName`, `role`) VALUES
(1, 'jsmith', 'password123', 'John', 'Smith', 'customer'),
(2, 'jdoe', 'password123', 'Jane', 'Doe', 'customer'),
(3, 'bwilson', 'password123', 'Bob', 'Wilson', 'admin'),
(4, 'sjohnson', 'password123', 'Sarah', 'Johnson', 'customer'),
(5, 'mbrown', 'password123', 'Mike', 'Brown', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT`
--

CREATE TABLE `ACCOUNT` (
  `accountId` int NOT NULL,
  `userId` int NOT NULL,
  `accountType` varchar(100) NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`accountId`, `userId`, `accountType`, `points`) VALUES
(1, 1, 'Gold', 5000),
(2, 2, 'Silver', 3000),
(3, 3, 'Platinum', 10000),
(4, 4, 'Bronze', 1500),
(5, 5, 'Gold', 7500);

-- --------------------------------------------------------

--
-- Table structure for table `GIFTCARD`
--

CREATE TABLE `GIFTCARD` (
  `cardId` int NOT NULL,
  `cardName` varchar(100) NOT NULL,
  `cardType` varchar(100) NOT NULL,
  `cardValue` float NOT NULL,
  `points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `GIFTCARD`
--

INSERT INTO `GIFTCARD` (`cardId`, `cardName`, `cardType`, `cardValue`, `points`) VALUES
(1, 'Starbucks Coffee', 'Food & Beverage', 25, 2500),
(2, 'Amazon Gift Card', 'Shopping', 50, 5000),
(3, 'iTunes Gift Card', 'Entertainment', 25, 2500),
(4, 'Walmart Gift Card', 'Shopping', 100, 10000),
(5, 'Target Gift Card', 'Shopping', 50, 5000),
(6, 'Best Buy Gift Card', 'Electronics', 75, 7500),
(7, 'Uber Ride Credit', 'Transportation', 30, 3000),
(8, 'Netflix Subscription', 'Entertainment', 15, 1500),
(9, 'Spotify Premium', 'Entertainment', 10, 1000),
(10, 'Whole Foods Market', 'Food & Beverage', 50, 5000),
(11, 'Sephora Beauty', 'Beauty', 40, 4000),
(12, 'Home Depot', 'Home Improvement', 100, 10000),
(13, 'Nike Store', 'Sports', 60, 6000),
(14, 'McDonald\'s', 'Food & Beverage', 20, 2000),
(15, 'Subway', 'Food & Beverage', 15, 1500),
(16, 'GameStop', 'Gaming', 50, 5000),
(17, 'Barnes & Noble', 'Books', 30, 3000),
(18, 'AMC Theatres', 'Entertainment', 25, 2500),
(19, 'Papa John\'s Pizza', 'Food & Beverage', 25, 2500),
(20, 'Southwest Airlines', 'Travel', 200, 20000),
(21, 'Taco Bell', 'Food & Beverage', 25, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `REDEMPTION`
--

CREATE TABLE `REDEMPTION` (
  `redeemId` int NOT NULL,
  `date` varchar(100) NOT NULL,
  `pointsRedeemed` int NOT NULL,
  `accountId` int NOT NULL,
  `cardId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `ACCOUNT`
--
ALTER TABLE `ACCOUNT`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `GIFTCARD`
--
ALTER TABLE `GIFTCARD`
  ADD PRIMARY KEY (`cardId`);

--
-- Indexes for table `REDEMPTION`
--
ALTER TABLE `REDEMPTION`
  ADD PRIMARY KEY (`redeemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ACCOUNT`
--
ALTER TABLE `ACCOUNT`
  MODIFY `accountId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `GIFTCARD`
--
ALTER TABLE `GIFTCARD`
  MODIFY `cardId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `REDEMPTION`
--
ALTER TABLE `REDEMPTION`
  MODIFY `redeemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Foreign key constraints
--

ALTER TABLE `ACCOUNT`
  ADD CONSTRAINT `fk_account_user` FOREIGN KEY (`userId`) REFERENCES `USER` (`userId`);

ALTER TABLE `REDEMPTION`
  ADD CONSTRAINT `fk_redemption_account` FOREIGN KEY (`accountId`) REFERENCES `ACCOUNT` (`accountId`);

ALTER TABLE `REDEMPTION`
  ADD CONSTRAINT `fk_redemption_card` FOREIGN KEY (`cardId`) REFERENCES `GIFTCARD` (`cardId`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
