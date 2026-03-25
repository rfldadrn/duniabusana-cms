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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.customers: ~4 rows (approximately)
REPLACE INTO `customers` (`Id`, `Name`, `PhoneNumber`, `Gender`, `RowStatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Khanissa Dwi Suci Lestari', '081374988099', 'Perempuan', 1, '2026-02-14 08:32:56', '2026-02-14 08:32:56'),
	(2, 'Rifaldi Adrian', '081270892182', 'Laki-laki', 1, '2026-02-14 08:49:38', '2026-02-14 08:54:49'),
	(3, 'asdsa', '0812708921822', 'Laki-laki', 0, '2026-02-14 09:06:50', '2026-02-14 09:07:52'),
	(4, 'Dinny Afriyanti', '081374988088', 'Perempuan', 1, '2026-02-15 04:15:19', '2026-02-15 04:15:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.menus: ~6 rows (approximately)
REPLACE INTO `menus` (`Id`, `MenuName`, `MenuUrl`, `MenuIcon`, `MenuSlug`, `ParentId`, `IsMenu`, `OrderNo`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Dashboard', '/', 'fa-home', '', 0, 1, 1, 1, '2026-02-14 03:24:29', '2026-02-15 04:04:45'),
	(2, 'Master Data', NULL, NULL, NULL, 0, 0, 2, 1, '2026-02-14 03:26:26', '2026-02-14 03:28:25'),
	(3, 'User', '/users', 'fa-users', 'users', 2, 1, 1, 1, '2026-02-14 03:28:48', '2026-02-15 02:45:49'),
	(4, 'Settings', NULL, NULL, NULL, 0, 0, 3, 1, '2026-02-14 05:20:33', '2026-02-14 05:20:39'),
	(5, 'User Profile', '/user/profile', 'fa-user-cog', NULL, 4, 1, 1, 1, '2026-02-14 05:20:59', '2026-02-14 06:00:08'),
	(7, 'Pelanggan', '/customers', 'fa-users', 'customers', 2, 1, 2, 1, '2026-02-14 08:11:42', '2026-02-15 02:45:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.rolemapping: ~9 rows (approximately)
REPLACE INTO `rolemapping` (`id`, `rolesId`, `menusId`, `created_at`) VALUES
	(1, 1, 1, '2026-02-14 03:29:37'),
	(2, 1, 2, '2026-02-14 03:29:47'),
	(3, 1, 3, '2026-02-14 03:29:56'),
	(4, 1, 4, '2026-02-14 05:21:32'),
	(5, 1, 5, '2026-02-14 05:21:36'),
	(6, 1, 7, '2026-02-14 08:13:26'),
	(7, 2, 1, '2026-02-15 03:44:53'),
	(8, 2, 4, '2026-02-15 03:45:13'),
	(9, 2, 5, '2026-02-15 03:45:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_template.users: ~3 rows (approximately)
REPLACE INTO `users` (`Id`, `Nama_pengguna`, `Username`, `Password`, `RolesId`, `Rowstatus`, `Created_at`, `Updated_at`) VALUES
	(1, 'Rifaldi Adrians', 'rfldadrn', '$2y$10$mPSYScVMgdh3VHpL7FKwZujFQUCZLyNaozXQACkNbgeIVmsZfJ18e', 1, 1, '2026-02-14 03:30:37', '2026-02-15 04:10:33'),
	(2, 'Khairur Rozis', 'krozi', '$2y$10$NSXmuL27DyyS6a3MUcs6HeBL1jY1ycQbzwU1T4Xzlacc/042Op9fe', 2, 1, '2026-02-14 03:41:30', '2026-02-15 04:10:53'),
	(8, 'Muhammad Haikal Zahirsa', 'kalls', '$2y$10$hbtklL5yIKanZ054e0lnA.GaSKLWfOvVtt6I7qxaXki3up7HZORYa', 2, 1, '2026-02-15 04:14:41', '2026-02-15 04:14:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
