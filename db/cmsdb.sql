-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for cmsdb
DROP DATABASE IF EXISTS `cmsdb`;
CREATE DATABASE IF NOT EXISTS `cmsdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cmsdb`;


-- Dumping structure for table cmsdb.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDescription` varchar(255) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.company
DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `CompanyId` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(255) NOT NULL,
  `Company_Mission` varchar(255) NOT NULL,
  `Company_Vission` varchar(255) NOT NULL,
  `Company_Slogon` varchar(255) NOT NULL,
  `Company_Logo` varchar(100) DEFAULT NULL,
  `Company_LogoUrl` varchar(45) DEFAULT NULL,
  `Enterprise` int(11) DEFAULT NULL,
  PRIMARY KEY (`CompanyId`),
  KEY `FK_ENTERPRISE` (`Enterprise`),
  CONSTRAINT `FK_ENTERPRISE` FOREIGN KEY (`Enterprise`) REFERENCES `enterprise` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.company_styles
DROP TABLE IF EXISTS `company_styles`;
CREATE TABLE IF NOT EXISTS `company_styles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyID` int(11) NOT NULL,
  `Company_Style_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `CompanyID` (`CompanyID`,`Company_Style_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.enterprise
DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE IF NOT EXISTS `enterprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) DEFAULT NULL,
  `EventUrl` varchar(255) DEFAULT NULL,
  `EventTitle` varchar(255) DEFAULT NULL,
  `CompanyID` int(11) NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.links
DROP TABLE IF EXISTS `links`;
CREATE TABLE IF NOT EXISTS `links` (
  `LinkID` int(11) NOT NULL AUTO_INCREMENT,
  `LinkName` varchar(255) NOT NULL,
  `LinkUrl` varchar(255) DEFAULT NULL,
  `LinkImage` varchar(255) DEFAULT NULL,
  `LinkDescription` varchar(255) NOT NULL,
  `LinkVisible` int(11) NOT NULL,
  `CompanyId` int(11) NOT NULL,
  PRIMARY KEY (`LinkID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Prod_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(255) NOT NULL,
  `Product_Price` float NOT NULL,
  `Product_Description` varchar(255) NOT NULL,
  `Product_Image` varchar(255) DEFAULT NULL,
  `Product_Discount` float DEFAULT NULL,
  `CategoryId` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  PRIMARY KEY (`Prod_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.rechten
DROP TABLE IF EXISTS `rechten`;
CREATE TABLE IF NOT EXISTS `rechten` (
  `idRechten` int(11) NOT NULL AUTO_INCREMENT,
  `RechtName` varchar(145) DEFAULT NULL,
  `RechtImage` varchar(145) DEFAULT NULL,
  `RechtUrl` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`idRechten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `RoleId` int(11) NOT NULL AUTO_INCREMENT,
  `Role` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.role_rechten
DROP TABLE IF EXISTS `role_rechten`;
CREATE TABLE IF NOT EXISTS `role_rechten` (
  `idRole_Rechten` int(11) NOT NULL AUTO_INCREMENT,
  `RechtId` int(11) DEFAULT NULL,
  `RoleId` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRole_Rechten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.styles
DROP TABLE IF EXISTS `styles`;
CREATE TABLE IF NOT EXISTS `styles` (
  `StyleId` int(11) NOT NULL AUTO_INCREMENT,
  `Style_Name` varchar(255) NOT NULL,
  `Style_Image` varchar(100) DEFAULT NULL,
  `Style_Description` varchar(255) NOT NULL,
  PRIMARY KEY (`StyleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table cmsdb.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Login` varchar(255) NOT NULL,
  `User_password` varchar(64) NOT NULL,
  `User_NickName` varchar(255) NOT NULL,
  `User_Email` varchar(100) NOT NULL,
  `User_Register` datetime DEFAULT NULL,
  `User_LastLogin` datetime DEFAULT NULL,
  `RoleId` int(11) DEFAULT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
