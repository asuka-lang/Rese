-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_db
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `managers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES (1,'木村卓也','kimutaku_777@docomo.ne.jp',NULL,'$2y$10$kTFKYfkeNlcqRo875rjPReW/BCOS3oH7KIPMlzBowmc62uctgefmm',NULL,'2025-02-05 18:05:46','2025-12-08 02:37:03'),(2,'中野一郎','nakano-ichi6@docomo.ne.jp',NULL,'$2y$10$GYv/S335d/E0K0IgAmDO0.SSUaEdqrO6VFlwt.tKwkcf.RTkTdhJi',NULL,'2025-02-05 18:05:58','2025-02-05 18:05:58'),(3,'井上生真','gavv_rider@au.com',NULL,'$2y$10$dYnsNHS1Clv6quHeC5Dvf.eet5g1FtCTvFFIDofx5o38hOztZmKRa',NULL,'2025-02-05 18:06:28','2025-02-05 18:06:28'),(4,'仙台仁','hitoshi_2025@softbank.ne.jp',NULL,'$2y$10$rxmdzbrD.KPulY8IoHalauD./d1PSc4siqfDPvWPuPR7SYbPCW0Qa',NULL,'2025-02-05 18:07:02','2025-02-05 18:07:02'),(5,'伊藤洋子','110_yoko@softbank.ne.jp',NULL,'$2y$10$xgKiUYqb9ewphrX4SM6AwuYzyKGGSiBrO/zQINSMGmPZN/voOqlZm',NULL,'2025-02-05 18:07:16','2025-02-05 18:07:16'),(6,'菅原道長','1129-kaoru@docomo.ne.jp',NULL,'$2y$10$76Al2NCsf7sT.q2ynxNL0.9fxNsE627fY.gvVvcu6Gv/m09jHQl2u',NULL,'2025-02-05 18:07:30','2026-04-04 00:25:31'),(7,'須賀賢三','ken-zo_39@softbank.ne.jp',NULL,'$2y$10$yi6fMzg2YwQYCa4A2LcnK.PXHRcXvsk2VNl40qBbjyWN1XLaP8mKy',NULL,'2025-02-05 18:07:43','2025-12-08 01:02:46'),(8,'山口千斗','sen_nin_sushi@au.com',NULL,'$2y$10$fhBhr2S7pkDhxldXXJbi3eH4SFXE40VQeFWR0JvcjMyqWnnsQFLrK',NULL,'2025-02-05 18:08:07','2025-02-05 18:08:07'),(9,'志摩謙三','sen-ritsu_sakai@au.com',NULL,'$2y$10$wwL5IxmhVsLtoXcHkBzxM.mn2hXmxN231swKaVsOG9dX5U5sIoYGa',NULL,'2025-02-05 18:08:40','2025-02-05 18:08:40'),(10,'星川瑠衣','starlight0123@au.com',NULL,'$2y$10$uzILAgMuzOe6fN9jK1b9u.F/7IUr9Dv/qbN5fplcbtUgARzNs6H6a',NULL,'2025-02-05 18:08:58','2025-02-05 18:08:58'),(11,'東野圭吾','keigo-higasinoa@au.com',NULL,'$2y$10$f8NmmMwMhMGIHd4wsONRcuEd40ZH2oId.OdAqabb9RK9L5wK5lFtG',NULL,'2025-02-05 18:09:13','2025-02-05 18:09:13'),(12,'板利杏','rook-italian_res@icloud.com',NULL,'$2y$10$uj2UG3Dd2zQ.VvcZNjkpOuuZsWAzMI8un69d9DTmhN7aA1Rvg5JEu',NULL,'2025-02-05 18:09:36','2025-02-05 18:09:36'),(13,'桃井はるこ','momo-haruko@docomo.ne.jp',NULL,'$2y$10$btRSw1seIUvP8myMkqOtCuFMJtgLNt4fwyReTv7adqWb8VBdIdcEa',NULL,'2025-02-05 18:09:48','2025-02-05 18:09:48'),(14,'極寺次郎','kiwami_jiro@docomo.ne.jp',NULL,'$2y$10$eRzqvwmE/DgqVnv6EvR1UuZG5.58pWdsYrR3WHsWfYV9xTijcrBIi',NULL,'2025-02-05 18:10:05','2025-02-05 18:10:05'),(15,'牛島光','hikaru-baffa@yahoo.ne.jp',NULL,'$2y$10$P3MI3Vj1TRYaY/PI0KGBI.sWoPQu/hVMXLVJuejGPpJqv3DhqMtzy',NULL,'2025-02-05 18:10:21','2025-02-05 18:10:21'),(16,'犬飼こむぎ','woderful_komugi@au.com',NULL,'$2y$10$UZcWZXqxBShekVqx5HhSHeWn2d8p5BC8TXjKTElJv12mZYJriXeqy',NULL,'2025-02-05 18:10:36','2025-02-05 18:10:36'),(17,'猫屋敷まゆ','cats-lilian@softbank.ne.jp',NULL,'$2y$10$P5IFyqkV8.329fXc32O1/eCsU2I48xB0lomNjKKsMg2Ead00.iHzG',NULL,'2025-02-05 18:10:48','2025-02-05 18:10:48'),(18,'簡秀吉','hide_kannace@au.com',NULL,'$2y$10$2s9indqtcCInRGhzQ9BgpeAn9ZnMiPzEGEKNVkvBgwj3k9Dub0/V.',NULL,'2025-02-05 18:11:12','2025-02-05 18:11:12'),(19,'酒井圭一','keichi-sakaya@softbank.ne.jp',NULL,'$2y$10$xoPvTnc7gKpxo..6PjcLcetigRi.AXg1eNj4evWYXHHm8mwLA6sjG',NULL,'2025-02-05 18:11:55','2025-02-05 18:11:55'),(20,'鬼頭はる','onisis-don@docomo.ne.jp',NULL,'$2y$10$HEKvCin3pkFt7wI8QA3BR.xhom9s6GVWgbkPM6vLgDeyf2PE070M.',NULL,'2025-02-05 18:12:29','2025-02-05 18:12:29'),(21,'高野博文','ultraman.13.taka122749@docomo.ne.jp',NULL,'$2y$10$g5WS8xmCeljeZeXKgybBSehCSZasJS3zR69tyGBFDU.QYYA4dOj7e',NULL,'2025-02-05 18:12:43','2025-02-05 18:12:43'),(22,'高野里美','asuketti-momo@docomo.ne.jp',NULL,'$2y$10$gIHdjJQdQdXRdreKemTBB.hKOSiF3cVT9vU7yWXIU/9uQbSov9uL2',NULL,'2025-02-05 18:13:02','2025-02-05 18:13:02');
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-24 13:51:42
