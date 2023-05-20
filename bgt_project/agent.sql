-- --------------------------------------------------------
-- Host:                         217.21.72.181
-- Server version:               10.5.19-MariaDB-cll-lve - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table u1675311_agent.statuses: ~18 rows (approximately)
INSERT INTO `statuses` (`id`, `status_code`, `description`, `group`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'OR', 'Order Receiverd', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:48:02', NULL),
	(2, 'DC', 'Declare at Customs', 'POL', '2023-05-10 08:48:05', '2023-05-10 08:48:08', NULL),
	(3, 'RC', 'Released by Customs', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(4, 'GR', 'Goods Received in Warehouse', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(5, 'CL', 'Container Loading Completed', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(6, 'CT', 'Container Transferred to Port Completed', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(7, 'BS', 'Bill Sent', 'POL', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(8, 'CAF', 'Container Arrived CFS', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(9, 'MS', 'Manifest Submit', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(10, 'FTE', 'LCL Free Time Expires', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(11, 'DOR', 'D/O Released', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(12, 'CU', 'Container Unloading', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(13, 'FP', 'Freight&Tariff Paid', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(14, 'IC', 'Import Clearance', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(15, 'GPD', 'Goods Picked/Goods Delivered', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(16, 'PR', 'POD Received', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(17, 'CCT', 'Container Changed to transfer', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL),
	(18, 'ITR', 'Import Tariff Received', 'POD', '2023-05-10 08:47:59', '2023-05-10 08:47:59', NULL);

-- Dumping data for table u1675311_agent.tracks: ~2 rows (approximately)
INSERT INTO `tracks` (`id`, `tracking`, `code`, `time`, `type`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '12345678A', 'CT', '2023-05-09 08:51:38', 'HBL', 'Remark 1', '2023-05-01 08:52:29', '2023-05-01 08:52:34', NULL),
	(2, '12345678B', 'DOR', '2023-05-05 08:53:03', 'ACCSN', 'Remark 2', '2023-05-06 08:53:22', '2023-05-06 08:53:28', NULL);

-- Dumping data for table u1675311_agent.types: ~5 rows (approximately)
INSERT INTO `types` (`id`, `code`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'TRACKING', 'ASOTS\'S Serial Number', '2023-05-10 08:40:45', '2023-05-10 08:40:48', NULL),
	(2, 'HBL', 'HBL Number', '2023-05-10 08:41:15', '2023-05-10 08:41:18', NULL),
	(3, 'CTR', 'Container Number', '2023-05-10 08:41:35', '2023-05-10 08:41:38', NULL),
	(4, 'ACCSN', 'ASOTS Consol Container Serial Number', '2023-05-10 08:41:56', '2023-05-10 08:41:58', NULL),
	(5, 'REF', 'REF Number(Base shipment)', '2023-05-10 08:42:17', '2023-05-10 08:42:20', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
