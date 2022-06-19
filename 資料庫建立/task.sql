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

-- 傾印  資料表 team10.task 結構
CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_type` varchar(10) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` varchar(20) NOT NULL,
  `problem` varchar(30) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `accept_time` time DEFAULT '00:00:00',
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  team10.task 的資料：~8 rows (近似值)
INSERT IGNORE INTO `task` (`task_id`, `task_type`, `time`, `location`, `problem`, `flag`, `accept_time`, `user_id`) VALUES
	(9, '髒污清潔', '2022-06-11 19:24:00', '分部校門口', '積水嚴重', 0, '00:00:00', NULL),
	(10, '器物損壞', '2022-05-19 07:26:00', '理圖807', '20號電腦損壞', 1, '00:00:00', NULL),
	(15, '器物損壞', '2022-06-09 22:32:00', '分部圖書館1樓', '沙發椅子破損', 1, '00:00:00', NULL),
	(16, '落葉', '2022-06-05 00:35:00', '本部全家門口', '大量落葉未清掃', 2, '00:00:00', NULL),
	(18, '其他', '2022-06-08 20:54:00', '本部禮堂前', '多落葉', 1, '00:00:00', 16),
	(19, '器物損壞', '2022-06-09 21:59:00', '本部誠205', '地板髒汙', 0, '00:00:00', 16),
	(23, '其他', '2022-06-14 09:46:00', '本部誠正大樓10樓電梯門口', '天花板漏水', 0, '00:00:00', 17),
	(24, '落葉', '2022-06-16 17:51:00', '校長室', '落葉', 0, '00:00:00', 25);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
