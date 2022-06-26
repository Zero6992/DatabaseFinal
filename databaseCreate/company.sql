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

-- 傾印  資料表 team10.company 結構
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '0',
  `mail` varchar(30) DEFAULT '0',
  `phone` varchar(20) DEFAULT '0',
  `bank_account` varchar(20) DEFAULT '0',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- 正在傾印表格  team10.company 的資料：~0 rows (近似值)
INSERT IGNORE INTO `company` (`company_id`, `name`, `mail`, `phone`, `bank_account`) VALUES
	(1, '台北清潔隊', 'test@gmil.com', '27208889', '123456789'),
	(3, '公園路燈工程管理處', '23815132', 'pkl.gov.taipe', '14969226'),
	(4, '環境保護局', 'https://www.dep.gov.taipei/', '27208889', '169117070'),
	(5, '久泰資源回收有限公司', 'jiutai168@gmail.com', '0961191199', '1961191199'),
	(6, 'test1', 'ts2', 'ts3', 'ts4'),
	(7, '10', '011', '0111', '0111');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
