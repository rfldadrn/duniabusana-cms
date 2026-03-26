-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_template
CREATE DATABASE IF NOT EXISTS `db_template` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_template`;

-- Dumping structure for table db_template.agencies
CREATE TABLE IF NOT EXISTS `agencies` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `TargetDate` datetime DEFAULT NULL,
  `RowStatus` bit(1) DEFAULT b'1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.agencies: ~1 rows (approximately)
REPLACE INTO `agencies` (`Id`, `Name`, `Description`, `StartDate`, `TargetDate`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Dinas Arsip', NULL, NULL, NULL, b'1', '2026-02-16 01:38:37', '2026-02-16 01:38:37');

-- Dumping structure for table db_template.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `RowStatus` tinyint DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.customers: ~12 rows (approximately)
REPLACE INTO `customers` (`Id`, `Name`, `PhoneNumber`, `Gender`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Khanissa Dwi Suci Lestari', '081374988099', 'Perempuan', 1, '2026-02-14 08:32:56', '2026-02-14 08:32:56'),
	(2, 'Rifaldi Adrian', '081270892182', 'Laki-laki', 1, '2026-02-14 08:49:38', '2026-02-14 08:54:49'),
	(3, 'asdsa', '0812708921822', 'Laki-laki', 0, '2026-02-14 09:06:50', '2026-02-14 09:07:52'),
	(4, 'Dinny Afriyanti', '081374988088', 'Perempuan', 1, '2026-02-15 04:15:19', '2026-02-15 04:15:33'),
	(5, 'Ira Oktarini', '081376123123', 'Perempuan', 1, '2026-02-22 08:14:57', '2026-02-22 08:14:57'),
	(6, 'Adfiarman', '081363134646', 'Laki-laki', 1, '2026-02-22 08:19:33', '2026-02-22 08:19:33'),
	(7, 'testasd', '817238971298321', 'Laki-laki', 0, '2026-02-22 08:22:22', '2026-02-22 08:26:28'),
	(8, 'testasd', '817238971298321', 'Laki-laki', 0, '2026-02-22 08:22:22', '2026-02-22 08:26:26'),
	(9, 'xasa', '12321321', 'Perempuan', 0, '2026-02-22 08:24:38', '2026-02-22 08:26:23'),
	(10, 'xasa', '12321321', 'Perempuan', 0, '2026-02-22 08:24:38', '2026-02-22 08:26:21'),
	(11, 'xasxsaas', '12312321', 'Laki-laki', 0, '2026-02-22 08:25:23', '2026-02-22 08:26:18'),
	(12, 'asd', '0812708921822', 'Laki-laki', 0, '2026-02-22 08:26:34', '2026-02-22 17:00:50');

-- Dumping structure for table db_template.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `JoinDate` datetime DEFAULT NULL,
  `EmployeeTypeId` int DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `RowStatus` bit(1) DEFAULT b'1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `EmployeeTypeId` (`EmployeeTypeId`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`EmployeeTypeId`) REFERENCES `employeetype` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.employee: ~0 rows (approximately)

-- Dumping structure for table db_template.employeetype
CREATE TABLE IF NOT EXISTS `employeetype` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RowStatus` bit(1) DEFAULT b'1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.employeetype: ~0 rows (approximately)

-- Dumping structure for table db_template.headersizecustomer
CREATE TABLE IF NOT EXISTS `headersizecustomer` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `CustomerId` int NOT NULL,
  `Note` text,
  `CreatedBy` int NOT NULL,
  `Rowstatus` tinyint(1) NOT NULL DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `idx_customer_id` (`CustomerId`),
  KEY `idx_created_by` (`CreatedBy`),
  CONSTRAINT `fk_hsc_customer` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_hsc_user` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.headersizecustomer: ~6 rows (approximately)
REPLACE INTO `headersizecustomer` (`Id`, `CustomerId`, `Note`, `CreatedBy`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(39, 1, 'test1', 1, 0, '2026-02-28 06:55:14', '2026-02-28 07:05:08'),
	(40, 5, 't51231', 1, 0, '2026-02-28 07:07:37', '2026-02-28 07:07:52'),
	(41, 5, 'teasdasdsa', 1, 0, '2026-02-28 07:09:51', '2026-02-28 07:18:02'),
	(42, 1, 'Ukuran 2022', 1, 1, '2026-03-01 06:51:37', '2026-03-01 08:19:41'),
	(43, 1, 'Ukuran 2021', 1, 1, '2026-03-01 07:33:36', '2026-03-01 08:19:32'),
	(44, 1, 'testing razka', 1, 1, '2026-03-25 06:03:25', '2026-03-25 06:03:25');

-- Dumping structure for table db_template.items
CREATE TABLE IF NOT EXISTS `items` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) NOT NULL,
  `Description` text,
  `CustomerPrice` decimal(10,2) NOT NULL,
  `EmployeePrice` decimal(10,2) NOT NULL,
  `RowStatus` tinyint(1) NOT NULL DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.items: ~5 rows (approximately)
REPLACE INTO `items` (`Id`, `Name`, `Description`, `CustomerPrice`, `EmployeePrice`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Kemeja lengan panjang', 'Kemeja lengan panjang', 175000.00, 50000.00, 1, '2026-02-17 05:01:48', '2026-02-17 05:01:48'),
	(2, 'Batik puring lengan panjang', 'Batik pria dengan puring dan lengan panjang', 350000.00, 150000.00, 1, '2026-02-17 05:01:48', '2026-02-17 05:01:48'),
	(3, 'Batik Kemeja Lengan Panjang', 'Batik pria non puring', 200000.00, 100000.00, 1, '2026-02-17 05:01:48', '2026-02-17 05:01:48'),
	(4, 'Celana Pria', 'Celana pria', 200000.00, 75000.00, 1, '2026-02-17 05:01:48', '2026-02-17 05:01:48'),
	(5, 'Rok', 'Rok', 150000.00, 50000.00, 1, '2026-02-17 05:01:48', '2026-02-17 05:05:11');

-- Dumping structure for table db_template.itemsize
CREATE TABLE IF NOT EXISTS `itemsize` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ItemId` int NOT NULL,
  `Name` varchar(100) NOT NULL,
  `IsMandatory` tinyint NOT NULL DEFAULT (0),
  `RowStatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `fk_itemsize_item` (`ItemId`),
  CONSTRAINT `fk_itemsize_item` FOREIGN KEY (`ItemId`) REFERENCES `items` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.itemsize: ~11 rows (approximately)
REPLACE INTO `itemsize` (`Id`, `ItemId`, `Name`, `IsMandatory`, `RowStatus`) VALUES
	(1, 4, 'Lebar Pinggang', 0, 1),
	(2, 4, 'Lebar Panggul', 0, 1),
	(3, 4, 'Panjang Pisak', 0, 1),
	(4, 4, 'Lebar Paha', 0, 1),
	(5, 4, 'Lebar Lutut', 0, 1),
	(6, 4, 'Lebar Kaki', 0, 1),
	(7, 4, 'Panjang', 0, 1),
	(8, 5, 'Lebar Pinggang', 1, 1),
	(9, 5, 'Lebar Panggul', 1, 1),
	(10, 5, 'Panjang Rok', 1, 1),
	(11, 5, 'Lebar Bawah', 0, 1);

-- Dumping structure for table db_template.itemsizecustomer
CREATE TABLE IF NOT EXISTS `itemsizecustomer` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ItemSizeId` int NOT NULL,
  `HeaderSizeCustomerId` int NOT NULL,
  `Size` decimal(10,2) NOT NULL,
  `RowStatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `fk_itemsizecustomer_itemsize` (`ItemSizeId`),
  KEY `fk_itemsizecustomer_HeaderSizeCustomerId` (`HeaderSizeCustomerId`) USING BTREE,
  CONSTRAINT `FK_itemsizecustomer_headersizecustomer` FOREIGN KEY (`HeaderSizeCustomerId`) REFERENCES `headersizecustomer` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_itemsizecustomer_itemsize` FOREIGN KEY (`ItemSizeId`) REFERENCES `itemsize` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.itemsizecustomer: ~57 rows (approximately)
REPLACE INTO `itemsizecustomer` (`Id`, `ItemSizeId`, `HeaderSizeCustomerId`, `Size`, `RowStatus`) VALUES
	(175, 8, 39, 1.20, 0),
	(176, 9, 39, 1.30, 0),
	(177, 10, 39, 1.40, 0),
	(178, 11, 39, 1.50, 0),
	(179, 8, 40, 1.00, 0),
	(180, 9, 40, 2.00, 0),
	(181, 10, 40, 3.00, 0),
	(182, 11, 40, 4.00, 0),
	(183, 8, 40, 1.00, 0),
	(184, 9, 40, 2.00, 0),
	(185, 10, 40, 3.00, 0),
	(186, 11, 40, 4.00, 0),
	(187, 8, 40, 12.00, 0),
	(188, 9, 40, 2.10, 0),
	(189, 10, 40, 3.00, 0),
	(190, 11, 40, 4.00, 0),
	(191, 8, 41, 1.00, 0),
	(192, 9, 41, 2.00, 0),
	(193, 10, 41, 3.00, 0),
	(194, 11, 41, 4.00, 0),
	(195, 8, 41, 1.00, 0),
	(196, 9, 41, 2.00, 0),
	(197, 10, 41, 3.00, 0),
	(198, 11, 41, 4.00, 0),
	(199, 8, 42, 1.00, 0),
	(200, 9, 42, 2.00, 0),
	(201, 10, 42, 3.00, 0),
	(202, 11, 42, 4.00, 0),
	(203, 8, 42, 1.00, 0),
	(204, 9, 42, 2.00, 0),
	(205, 10, 42, 3.00, 0),
	(206, 11, 42, 4.00, 0),
	(207, 1, 43, 1.00, 0),
	(208, 2, 43, 2.00, 0),
	(209, 3, 43, 3.00, 0),
	(210, 4, 43, 4.00, 0),
	(211, 5, 43, 5.00, 0),
	(212, 6, 43, 6.00, 0),
	(213, 7, 43, 7.00, 0),
	(214, 1, 43, 1.00, 1),
	(215, 2, 43, 2.00, 1),
	(216, 3, 43, 3.00, 1),
	(217, 4, 43, 4.00, 1),
	(218, 5, 43, 5.00, 1),
	(219, 6, 43, 6.00, 1),
	(220, 7, 43, 7.00, 1),
	(221, 8, 42, 1.00, 1),
	(222, 9, 42, 2.00, 1),
	(223, 10, 42, 3.00, 1),
	(224, 11, 42, 4.00, 1),
	(225, 1, 44, 1.00, 1),
	(226, 2, 44, 2.00, 1),
	(227, 3, 44, 3.00, 1),
	(228, 4, 44, 4.00, 1),
	(229, 5, 44, 5.00, 1),
	(230, 6, 44, 6.00, 1),
	(231, 7, 44, 1.00, 1);

-- Dumping structure for table db_template.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `MenuName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MenuUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `MenuIcon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `MenuSlug` varchar(100) DEFAULT NULL,
  `ParentId` int DEFAULT '0',
  `IsMenu` int DEFAULT '0',
  `OrderNo` int DEFAULT '0',
  `Rowstatus` tinyint(1) DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT (now()),
  `Updated_at` timestamp NULL DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.menus: ~7 rows (approximately)
REPLACE INTO `menus` (`Id`, `MenuName`, `MenuUrl`, `MenuIcon`, `MenuSlug`, `ParentId`, `IsMenu`, `OrderNo`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Dashboard', '/', 'fa-home', '', 0, 1, 1, 1, '2026-02-14 03:24:29', '2026-02-15 04:04:45'),
	(2, 'Master Data', NULL, NULL, NULL, 0, 0, 2, 1, '2026-02-14 03:26:26', '2026-02-14 03:28:25'),
	(3, 'User', '/users', 'fa-users', 'users', 2, 1, 1, 1, '2026-02-14 03:28:48', '2026-02-15 02:45:49'),
	(4, 'Settings', NULL, NULL, NULL, 0, 0, 4, 1, '2026-02-14 05:20:33', '2026-02-16 00:54:24'),
	(5, 'User Profile', '/user/profile', 'fa-user-cog', NULL, 4, 1, 1, 1, '2026-02-14 05:20:59', '2026-02-14 06:00:08'),
	(7, 'Pelanggan', '/customers', 'fa-users', 'customers', 2, 1, 2, 1, '2026-02-14 08:11:42', '2026-02-15 02:45:58'),
	(8, 'Transaksi', '/transactions', 'fa-database', 'transactions', 2, 1, 3, 1, '2026-02-16 00:53:38', '2026-02-16 01:01:48');

-- Dumping structure for table db_template.paymenttypes
CREATE TABLE IF NOT EXISTS `paymenttypes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RowStatus` bit(1) DEFAULT b'1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.paymenttypes: ~5 rows (approximately)
REPLACE INTO `paymenttypes` (`Id`, `Name`, `Description`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Tunai', NULL, b'1', '2026-02-16 01:40:55', '2026-02-16 01:40:55'),
	(2, 'QRIS', NULL, b'1', '2026-02-16 01:41:04', '2026-02-16 01:41:04'),
	(3, 'Bank Transfer (BNI)', NULL, b'1', '2026-03-01 05:40:30', '2026-03-01 05:40:30'),
	(4, 'Bank Transfer (BCA)', NULL, b'1', '2026-03-01 05:40:46', '2026-03-01 05:40:46'),
	(5, 'Bank Transfer (Nagari)', NULL, b'1', '2026-03-01 05:40:56', '2026-03-01 05:40:56');

-- Dumping structure for table db_template.rolemapping
CREATE TABLE IF NOT EXISTS `rolemapping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rolesId` int NOT NULL,
  `menusId` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rolemapping_roles` (`rolesId`),
  KEY `fk_rolemapping_menus` (`menusId`),
  CONSTRAINT `fk_rolemapping_menus` FOREIGN KEY (`menusId`) REFERENCES `menus` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rolemapping_roles` FOREIGN KEY (`rolesId`) REFERENCES `roles` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.rolemapping: ~10 rows (approximately)
REPLACE INTO `rolemapping` (`id`, `rolesId`, `menusId`, `created_at`) VALUES
	(1, 1, 1, '2026-02-14 03:29:37'),
	(2, 1, 2, '2026-02-14 03:29:47'),
	(3, 1, 3, '2026-02-14 03:29:56'),
	(4, 1, 4, '2026-02-14 05:21:32'),
	(5, 1, 5, '2026-02-14 05:21:36'),
	(6, 1, 7, '2026-02-14 08:13:26'),
	(7, 2, 1, '2026-02-15 03:44:53'),
	(8, 2, 4, '2026-02-15 03:45:13'),
	(9, 2, 5, '2026-02-15 03:45:21'),
	(10, 1, 8, '2026-02-16 01:00:12');

-- Dumping structure for table db_template.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(100) NOT NULL,
  `Rowstatus` tinyint(1) DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT (now()),
  `Updated_at` timestamp NULL DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.roles: ~2 rows (approximately)
REPLACE INTO `roles` (`Id`, `RoleName`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Super Admin', 1, '2026-02-14 03:22:52', '2026-02-14 03:22:52'),
	(2, 'Administrator', 1, '2026-02-15 03:44:38', '2026-02-15 03:44:38');

-- Dumping structure for table db_template.statustransaction
CREATE TABLE IF NOT EXISTS `statustransaction` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RowStatus` bit(1) DEFAULT b'1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.statustransaction: ~0 rows (approximately)

-- Dumping structure for table db_template.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `TransactionCode` varchar(50) NOT NULL DEFAULT '0',
  `CustomerId` int NOT NULL,
  `AgencyId` int DEFAULT NULL,
  `TransactionDate` datetime NOT NULL,
  `CompletionDate` datetime DEFAULT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `PaidAmount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `BalanceDue` decimal(18,2) GENERATED ALWAYS AS ((`Amount` - `PaidAmount`)) STORED,
  `Note` varchar(500) DEFAULT NULL,
  `PaymentTypeId` int NOT NULL,
  `CreatedBy` int NOT NULL,
  `RowStatus` tinyint(1) NOT NULL DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `TransactionCode` (`TransactionCode`),
  KEY `FK_Transaction_Customer` (`CustomerId`),
  KEY `FK_Transaction_Agency` (`AgencyId`),
  KEY `FK_Transaction_PaymentType` (`PaymentTypeId`),
  KEY `FK_Transaction_User` (`CreatedBy`),
  CONSTRAINT `FK_Transaction_Agency` FOREIGN KEY (`AgencyId`) REFERENCES `agencies` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_Transaction_Customer` FOREIGN KEY (`CustomerId`) REFERENCES `customers` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_Transaction_PaymentType` FOREIGN KEY (`PaymentTypeId`) REFERENCES `paymenttypes` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_Transaction_User` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`Id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.transactions: ~2 rows (approximately)
REPLACE INTO `transactions` (`Id`, `TransactionCode`, `CustomerId`, `AgencyId`, `TransactionDate`, `CompletionDate`, `Amount`, `PaidAmount`, `Note`, `PaymentTypeId`, `CreatedBy`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, '2026020001', 4, 1, '2026-02-16 08:41:28', '2026-02-16 08:41:29', 500000.00, 100000.00, 'segera', 1, 1, 1, '2026-02-16 01:41:55', '2026-02-16 01:47:49'),
	(2, '2026020002', 1, NULL, '2026-02-16 08:42:03', '2026-02-16 08:42:05', 550000.00, 0.00, 'tunggu bahan', 2, 8, 1, '2026-02-16 01:42:35', '2026-02-16 02:01:27');

-- Dumping structure for table db_template.users
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nama_pengguna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `RolesId` int NOT NULL,
  `Rowstatus` tinyint(1) DEFAULT '1',
  `Created_at` timestamp NULL DEFAULT (now()),
  `Updated_at` timestamp NULL DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`) USING BTREE,
  UNIQUE KEY `username` (`Username`) USING BTREE,
  KEY `fk_users_roles` (`RolesId`) USING BTREE,
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`RolesId`) REFERENCES `roles` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.users: ~4 rows (approximately)
REPLACE INTO `users` (`Id`, `Nama_pengguna`, `Username`, `Password`, `RolesId`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Rifaldi Adrian', 'rfldadrn', '$2y$10$mPSYScVMgdh3VHpL7FKwZujFQUCZLyNaozXQACkNbgeIVmsZfJ18e', 1, 1, '2026-02-14 03:30:37', '2026-02-22 04:32:49'),
	(2, 'Khairur Rozis', 'krozi', '$2y$10$NSXmuL27DyyS6a3MUcs6HeBL1jY1ycQbzwU1T4Xzlacc/042Op9fe', 2, 1, '2026-02-14 03:41:30', '2026-02-15 04:10:53'),
	(8, 'Muhammad Haikal Zahirsa', 'kalls', '$2y$10$hbtklL5yIKanZ054e0lnA.GaSKLWfOvVtt6I7qxaXki3up7HZORYa', 2, 1, '2026-02-15 04:14:41', '2026-02-15 04:14:45'),
	(9, 'Syaharani Ara', 'ara', '$2y$10$vNO.V1EoLMTIr87uN8mFhOKLG2A6GGP3WsX8dLlzdyrYF1ppp20c6', 2, 1, '2026-02-21 17:51:28', '2026-02-21 17:51:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
