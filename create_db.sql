/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for urlocut
CREATE DATABASE IF NOT EXISTS `urlocut` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `urlocut`;

-- Dumping structure for таблиця urlocut.aliases
CREATE TABLE IF NOT EXISTS `aliases` (
  `alias` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_create` datetime NOT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дані для експорту не вибрані

-- Dumping structure for таблиця urlocut.stat
CREATE TABLE IF NOT EXISTS `stat` (
  `alias` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`alias`),
  CONSTRAINT `FK_stat_aliases` FOREIGN KEY (`alias`) REFERENCES `aliases` (`alias`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дані для експорту не вибрані

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
