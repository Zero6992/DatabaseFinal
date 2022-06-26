-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        5.7.17-log - MySQL Community Server (GPL)
-- 伺服器作業系統:                      Win32
-- HeidiSQL 版本:                  12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 傾印  資料表 team10.user 結構
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` enum('使用者','管理員') DEFAULT '使用者',
  `name` varchar(20) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `account` (`account`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  team10.user 的資料：~7 rows (近似值)
INSERT IGNORE INTO `user` (`user_id`, `user_type`, `name`, `mail`, `account`, `password`) VALUES
	(16, '管理員', 'murry', 'aaaa@aaaa.com', 'qqqq', 'pppp'),
	(17, '使用者', 'Iris', 'Iris@iii.xyz', 'iiii', 'xxxx'),
	(18, '使用者', 'Oreo', 'Oreo@oooo.me', 'oooo', 'xxxx'),
	(19, '使用者', 'King', 'king@king.king', 'king', 'queen'),
	(22, '使用者', 'Max', 'max@gmail.com', 'wwww', 'eeee'),
	(23, '使用者', 'lastfight', 'last@gmail.com', 'last', 'last123'),
	(25, '管理員', 'admin', 'admin@gmail.com', 'admin', 'admin0000');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
