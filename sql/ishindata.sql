-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ishindata.serialtable
CREATE TABLE IF NOT EXISTS `serialtable` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `instanceid` varchar(18) NOT NULL DEFAULT '0',
  `userid` varchar(20) NOT NULL DEFAULT '',
  `expiredate` date DEFAULT NULL,
  `serialno` varchar(10) DEFAULT NULL,
  `datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ishindata.serialtable: ~9 rows (approximately)
/*!40000 ALTER TABLE `serialtable` DISABLE KEYS */;
INSERT INTO `serialtable` (`sid`, `instanceid`, `userid`, `expiredate`, `serialno`, `datecreate`) VALUES
	(1, '615491987373563909', 'cct3000', '2020-10-03', '1', '2020-06-29 08:59:22'),
	(2, '615491987516170245', 'cct3000', '2020-10-03', '2', '2020-06-29 08:59:22'),
	(3, '615491987549724677', 'cct3000', '2020-10-03', '3', '2020-06-29 08:59:22'),
	(4, '615491987574890501', 'cct3000', '2020-10-03', '4', '2020-06-29 08:59:22'),
	(5, '615491987625222149', 'cct3000', '2020-10-03', '5', '2020-06-29 08:59:22'),
	(6, '615491987641999365', 'cct3000', '2020-10-03', '6', '2020-06-29 08:59:22'),
	(7, '615491987658776581', 'cct3000', '2020-10-03', '7', '2020-06-29 08:59:22'),
	(8, '615491987675553797', 'cct3000', '2020-10-03', '8', '2020-06-29 08:59:22'),
	(9, '615491987692331013', 'cct3000', '2020-10-03', '9', '2020-06-29 08:59:22');
/*!40000 ALTER TABLE `serialtable` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
