# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.25-log)
# Database: kuis
# Generation Time: 2014-03-10 06:02:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`)
VALUES
	(1,'User','','2014-01-22 18:27:33','2014-01-22 18:27:33'),
	(2,'Admin','{\"admin\":1}','2014-01-22 18:27:33','2014-01-22 18:27:33');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jawaban
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jawaban`;

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jawaban` text,
  `is_benar` enum('1','0') DEFAULT '0',
  `poin` int(11) DEFAULT NULL,
  `soal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`soal_id`),
  KEY `fk_jawaban_soal1_idx` (`soal_id`),
  CONSTRAINT `fk_jawaban_soal1` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jawaban` WRITE;
/*!40000 ALTER TABLE `jawaban` DISABLE KEYS */;

INSERT INTO `jawaban` (`id`, `jawaban`, `is_benar`, `poin`, `soal_id`, `created_at`, `updated_at`)
VALUES
	(29,'Rusa tidak berekor','0',0,10,'2014-01-17 18:28:47','2014-01-17 18:28:47'),
	(30,'Rusa sama dengan kambing.','0',0,10,'2014-01-17 18:28:47','2014-01-17 18:28:47'),
	(31,'Rusa, kambing, dan kerbau adalah binatang bertanduk.','1',10,10,'2014-01-17 18:28:47','2014-01-17 18:28:47'),
	(32,'Kambing bertanduk tidak berekor.','0',0,10,'2014-01-17 18:28:47','2014-01-17 18:28:47'),
	(33,'kamis','0',0,11,'2014-01-17 18:34:17','2014-01-17 18:34:17'),
	(34,'minggu','0',0,11,'2014-01-17 18:34:17','2014-01-17 18:34:17'),
	(35,'senin','0',0,11,'2014-01-17 18:34:17','2014-01-17 18:34:17'),
	(36,'jumat','1',10,11,'2014-01-17 18:34:17','2014-01-17 18:34:17'),
	(37,'lurus','0',0,12,'2014-01-17 18:35:58','2014-01-17 18:35:58'),
	(38,'kecenderungan','1',10,12,'2014-01-17 18:35:58','2014-01-17 18:35:58'),
	(39,'kesamaan','0',0,12,'2014-01-17 18:35:58','2014-01-17 18:35:58'),
	(40,'tensi','0',0,12,'2014-01-17 18:35:58','2014-01-17 18:35:58'),
	(41,'cek','1',10,13,'2014-01-17 18:38:11','2014-01-17 18:38:11'),
	(42,'rubel','0',0,13,'2014-01-17 18:38:11','2014-01-17 18:38:11'),
	(43,'lire','0',0,13,'2014-01-17 18:38:11','2014-01-17 18:38:11'),
	(44,'rupiah','0',0,13,'2014-01-17 18:38:11','2014-01-17 18:38:11'),
	(45,'bumi','0',0,14,'2014-01-17 18:43:28','2014-01-17 18:43:28'),
	(46,'bola','0',0,14,'2014-01-17 18:43:28','2014-01-17 18:43:28'),
	(47,'pepaya','1',10,14,'2014-01-17 18:43:28','2014-01-17 18:43:28'),
	(48,'melon','0',0,14,'2014-01-17 18:43:28','2014-01-17 18:43:28'),
	(49,'turun','0',0,15,'2014-01-17 18:45:41','2014-01-17 18:45:41'),
	(50,'diam','0',0,15,'2014-01-17 18:45:41','2014-01-17 18:45:41'),
	(51,'bergerak terus','1',10,15,'2014-01-17 18:45:41','2014-01-17 18:45:41'),
	(52,'konstan','0',0,15,'2014-01-17 18:45:41','2014-01-17 18:45:41'),
	(53,'Siang : Terang : Matahari','0',0,16,'2014-01-17 18:47:18','2014-01-17 18:47:18'),
	(54,'Bulan : Bintang : Malam','0',0,16,'2014-01-17 18:47:18','2014-01-17 18:47:18'),
	(55,'Makanan : Lapar : Kenyang','1',10,16,'2014-01-17 18:47:18','2014-01-17 18:47:18'),
	(56,'Minuman : Dahaga : Haus','0',0,16,'2014-01-17 18:47:18','2014-01-17 18:47:18'),
	(57,'WHO','0',0,17,'2014-01-17 18:53:58','2014-01-17 18:53:58'),
	(58,'UNHCR','1',10,17,'2014-01-17 18:53:58','2014-01-17 18:53:58'),
	(59,'ILO','0',0,17,'2014-01-17 18:53:58','2014-01-17 18:53:58'),
	(60,'UNESCO','0',0,17,'2014-01-17 18:53:58','2014-01-17 18:53:58'),
	(61,'Banten','0',0,18,'2014-01-17 18:54:35','2014-01-17 18:54:35'),
	(62,'Cirebon','0',0,18,'2014-01-17 18:54:35','2014-01-17 18:54:35'),
	(63,'Blora','1',10,18,'2014-01-17 18:54:35','2014-01-17 18:54:35'),
	(64,'Pacitan','0',0,18,'2014-01-17 18:54:35','2014-01-17 18:54:35'),
	(65,'Nobel','1',10,19,'2014-01-17 18:55:19','2014-01-17 18:55:19'),
	(66,'Norbert Winner','0',0,19,'2014-01-17 18:55:19','2014-01-17 18:55:19'),
	(67,'Pulitzer','0',0,19,'2014-01-17 18:55:19','2014-01-17 18:55:19'),
	(68,'Oscar','0',0,19,'2014-01-17 18:55:19','2014-01-17 18:55:19'),
	(69,'Footix','0',0,20,'2014-01-17 18:55:52','2014-01-17 18:55:52'),
	(70,'Zakumi','1',10,20,'2014-01-17 18:55:52','2014-01-17 18:55:52'),
	(71,'Willy','0',0,20,'2014-01-17 18:55:52','2014-01-17 18:55:52'),
	(72,'Ciao','0',0,20,'2014-01-17 18:55:52','2014-01-17 18:55:52'),
	(73,'Mengubah haluan','0',0,21,'2014-01-17 18:58:41','2014-01-17 18:58:41'),
	(74,'Bertekat bulat','0',0,21,'2014-01-17 18:58:41','2014-01-17 18:58:41'),
	(75,'Mengukuhkan jabatan','0',0,21,'2014-01-17 18:58:41','2014-01-17 18:58:41'),
	(76,'Menjajaki pendapat umum','1',10,21,'2014-01-17 18:58:41','2014-01-17 18:58:41'),
	(77,'Pak Anto mungkin ikut mengeluhkan harga kedelai naik','1',10,22,'2014-01-17 19:04:06','2014-01-17 19:04:06'),
	(78,'Harga kedelai bukanlah keluhan Pak Anto','0',0,22,'2014-01-17 19:04:06','2014-01-17 19:04:06'),
	(79,'Pak Anto pasti mengeluhkan harga kedelai naik','0',0,22,'2014-01-17 19:04:06','2014-01-17 19:04:06'),
	(80,'Pak Anto tidak mengeluhkan harga kedelai naik.','0',0,22,'2014-01-17 19:04:06','2014-01-17 19:04:06'),
	(81,'Soto adalah makanan pertama yang akan disantap Heldy','0',0,23,'2014-01-17 19:07:51','2014-01-17 19:07:51'),
	(82,'Setelah makan soto, Heldy minum es buah di dekat Stadion Manahan','0',0,23,'2014-01-17 19:07:51','2014-01-17 19:07:51'),
	(83,'Sebelum ke Stadion Manahan, heldy ingin mengembalikan CD kepada Hardoyo sebab takut terlupa','0',0,23,'2014-01-17 19:07:51','2014-01-17 19:07:51'),
	(84,'Pisang adalah makanan pertama yang akan disantap Heldy','1',10,23,'2014-01-17 19:07:51','2014-01-17 19:07:51'),
	(85,'Usaha sambilan – dapat kerja – nikah – punya anak – punya rumah','0',0,24,'2014-01-17 19:12:38','2014-01-17 19:12:38'),
	(86,'Dapat kerja – usaha sambilan – nikah – punya rumah – punya anak','1',10,24,'2014-01-17 19:12:38','2014-01-17 19:12:38'),
	(87,'Dapat kerja – nikah – usaha sambilan – punya rumah – punya anak','0',0,24,'2014-01-17 19:12:38','2014-01-17 19:12:38'),
	(88,'Dapat kerja – nikah – punya rumah – usaha sambilan – punya anak','0',0,24,'2014-01-17 19:12:38','2014-01-17 19:12:38'),
	(89,'33','0',0,25,'2014-01-17 19:14:24','2014-01-17 19:14:24'),
	(90,'31','0',0,25,'2014-01-17 19:14:24','2014-01-17 19:14:24'),
	(91,'29','1',10,25,'2014-01-17 19:14:24','2014-01-17 19:14:24'),
	(92,'25','0',0,25,'2014-01-17 19:14:24','2014-01-17 19:14:24'),
	(93,'n','1',10,26,'2014-01-17 19:16:32','2014-01-17 19:16:32'),
	(94,'t','0',0,26,'2014-01-17 19:16:32','2014-01-17 19:16:32'),
	(95,'s','0',0,26,'2014-01-17 19:16:32','2014-01-17 19:16:32'),
	(96,'u','0',0,26,'2014-01-17 19:16:32','2014-01-17 19:16:32'),
	(97,'x dan y nilainya sama','1',10,27,'2014-01-17 19:20:29','2014-01-17 19:20:29'),
	(98,'x/y = 1/77','0',0,27,'2014-01-17 19:20:29','2014-01-17 19:20:29'),
	(99,'y = x + 1/19,95','0',0,27,'2014-01-17 19:20:29','2014-01-17 19:20:29'),
	(100,'y > x','0',0,27,'2014-01-17 19:20:29','2014-01-17 19:20:29'),
	(101,'Rp. 800.000,-','0',0,28,'2014-01-17 19:21:43','2014-01-17 19:21:43'),
	(102,'Rp. 750.000,-','0',0,28,'2014-01-17 19:21:43','2014-01-17 19:21:43'),
	(103,'Rp. 700.000,-','1',10,28,'2014-01-17 19:21:43','2014-01-17 19:21:43'),
	(104,'Rp. 850.000,-','0',0,28,'2014-01-17 19:21:43','2014-01-17 19:21:43'),
	(105,'n = 5 Orang x = 44 Kelereng','0',0,29,'2014-01-17 19:24:12','2014-01-17 19:24:12'),
	(106,'n = 6 Orang x = 44 Kelereng','0',0,29,'2014-01-17 19:24:12','2014-01-17 19:24:12'),
	(107,'n = 2 Orang x = 48 Kelereng','0',0,29,'2014-01-17 19:24:12','2014-01-17 19:24:12'),
	(108,'n = 4 Orang x = 48 Kelereng','1',10,29,'2014-01-17 19:24:12','2014-01-17 19:24:12'),
	(109,'Rosyid tidak menginginkan harta dan tahta.','0',0,30,'2014-01-17 19:25:33','2014-01-17 19:25:33'),
	(110,'Tahta bukanlah keinginan Rosyid, tapi harta mungkin ya.','0',0,30,'2014-01-17 19:25:33','2014-01-17 19:25:33'),
	(111,'Rosyid menginginkan tahta tapi tidak berminat menjadi politikus.','0',0,30,'2014-01-17 19:25:33','2014-01-17 19:25:33'),
	(112,'Tidak dapat ditarik kesimpulan','1',10,30,'2014-01-17 19:25:33','2014-01-17 19:25:33'),
	(113,'Sering','0',0,31,'2014-01-17 19:30:34','2014-01-17 19:30:34'),
	(114,'Makan sepuasnya','0',0,31,'2014-01-17 19:30:34','2014-01-17 19:30:34'),
	(115,'Banyak tak tentu','1',10,31,'2014-01-17 19:30:34','2014-01-17 19:30:34'),
	(116,'Frekuensi tinggi','0',0,31,'2014-01-17 19:30:34','2014-01-17 19:30:34'),
	(117,'Terbunuhnya Putra Mahkota Inggris','1',10,32,'2014-01-17 19:31:46','2014-01-17 19:31:46'),
	(118,'Terjadinya pertentangan antar negara','0',0,32,'2014-01-17 19:31:46','2014-01-17 19:31:46'),
	(119,'Timbulnya gerakan nasionalisme di berbagai negara','0',0,32,'2014-01-17 19:31:46','2014-01-17 19:31:46'),
	(120,'Terjadinya perlombaan senjata','0',0,32,'2014-01-17 19:31:46','2014-01-17 19:31:46'),
	(121,'Kekuasaan tertinggi ada di tangan rakyat','0',0,33,'2014-01-17 19:32:45','2014-01-17 19:32:45'),
	(122,'Negara haruslah diatur berdasarkan hukum, bukan kekuasaan perorangan','1',10,33,'2014-01-17 19:32:45','2014-01-17 19:32:45'),
	(123,'Kekuasaan tertinggi ada di tangan perwakilan rakyat','0',0,33,'2014-01-17 19:32:45','2014-01-17 19:32:45'),
	(124,'Pembagian kekuasaan negara menjadi tiga bagian','0',0,33,'2014-01-17 19:32:45','2014-01-17 19:32:45'),
	(125,'Cut Nyak Dien','0',0,34,'2014-01-17 19:33:36','2014-01-17 19:33:36'),
	(126,'Panglima Polim','0',0,34,'2014-01-17 19:33:36','2014-01-17 19:33:36'),
	(127,'Sultan Ageng Tirtayasa','0',0,34,'2014-01-17 19:33:36','2014-01-17 19:33:36'),
	(128,'Nyi Ageng Serang','1',10,34,'2014-01-17 19:33:36','2014-01-17 19:33:36'),
	(129,'Rujukan','0',0,35,'2014-01-17 19:35:42','2014-01-17 19:35:42'),
	(130,'Yurisprudensi','1',10,35,'2014-01-17 19:35:42','2014-01-17 19:35:42'),
	(131,'Konvensi','0',0,35,'2014-01-17 19:35:42','2014-01-17 19:35:42'),
	(132,'Rekondisi','0',0,35,'2014-01-17 19:35:42','2014-01-17 19:35:42'),
	(133,'Asosiatif','0',0,36,'2014-01-17 19:39:04','2014-01-17 19:39:04'),
	(134,'Peyoratif','0',0,36,'2014-01-17 19:39:04','2014-01-17 19:39:04'),
	(135,'Meluas','0',0,36,'2014-01-17 19:39:04','2014-01-17 19:39:04'),
	(136,'Menyempit','1',10,36,'2014-01-17 19:39:04','2014-01-17 19:39:04'),
	(137,'Shuttlecock','0',0,37,'2014-01-17 19:39:56','2014-01-17 19:39:56'),
	(138,'Olahraga','1',10,37,'2014-01-17 19:39:56','2014-01-17 19:39:56'),
	(139,'Raket','0',0,37,'2014-01-17 19:39:56','2014-01-17 19:39:56'),
	(140,'Atlet','0',0,37,'2014-01-17 19:39:56','2014-01-17 19:39:56'),
	(141,'(1) (3) (2) (4)','0',0,38,'2014-01-17 19:41:45','2014-01-17 19:41:45'),
	(142,'(3) (1) (2) (4)','1',10,38,'2014-01-17 19:41:45','2014-01-17 19:41:45'),
	(143,'(3) (2) (1) (4)','0',0,38,'2014-01-17 19:41:45','2014-01-17 19:41:45'),
	(144,'(2) (3) (1) (4)','0',0,38,'2014-01-17 19:41:45','2014-01-17 19:41:45'),
	(145,'Analitis','1',10,39,'2014-01-17 19:44:26','2014-01-17 19:44:26'),
	(146,'Memiliki teori','0',0,39,'2014-01-17 19:44:26','2014-01-17 19:44:26'),
	(147,'Memiliki metode tertentu','0',0,39,'2014-01-17 19:44:26','2014-01-17 19:44:26'),
	(148,'Empiris','0',0,39,'2014-01-17 19:44:26','2014-01-17 19:44:26'),
	(149,'Chauvinisme','0',0,40,'2014-01-17 19:45:24','2014-01-17 19:45:24'),
	(150,'Renaissance','0',0,40,'2014-01-17 19:45:24','2014-01-17 19:45:24'),
	(151,'Separatisme','0',0,40,'2014-01-17 19:45:24','2014-01-17 19:45:24'),
	(152,'Nasionalisme','1',10,40,'2014-01-17 19:45:24','2014-01-17 19:45:24'),
	(153,'1939 -1944','0',0,41,'2014-01-17 19:46:49','2014-01-17 19:46:49'),
	(154,'1939 - 1945','1',10,41,'2014-01-17 19:46:49','2014-01-17 19:46:49'),
	(155,'1938 - 1945','0',0,41,'2014-01-17 19:46:49','2014-01-17 19:46:49'),
	(156,'1939 - 1940','0',0,41,'2014-01-17 19:46:49','2014-01-17 19:46:49'),
	(157,'Menlu, Mendagri, dan Menhankam','1',10,42,'2014-01-17 19:47:52','2014-01-17 19:47:52'),
	(158,'Mahkamah Agung','0',0,42,'2014-01-17 19:47:52','2014-01-17 19:47:52'),
	(159,'Panglima TNI dan Kapolri','0',0,42,'2014-01-17 19:47:52','2014-01-17 19:47:52'),
	(160,'Mendagri','0',0,42,'2014-01-17 19:47:52','2014-01-17 19:47:52'),
	(161,'Kepolisian','0',0,43,'2014-01-17 19:48:32','2014-01-17 19:48:32'),
	(162,'Mahkamah Konstitusi (MK)','0',0,43,'2014-01-17 19:48:32','2014-01-17 19:48:32'),
	(163,'Mahkamah Agung (MA)','1',10,43,'2014-01-17 19:48:32','2014-01-17 19:48:32'),
	(164,'Wakil Presiden','0',0,43,'2014-01-17 19:48:32','2014-01-17 19:48:32'),
	(165,'Hak meminta pertanggungjawaban pemerintah','0',0,44,'2014-01-17 19:53:45','2014-01-17 19:53:45'),
	(166,'Hak meminta keterangan dari pemerintah mengenai suatu kebijakan','1',10,44,'2014-01-17 19:53:45','2014-01-17 19:53:45'),
	(167,'Hak menyelidiki dugaan pelanggaran oleh pemerintah','0',0,44,'2014-01-17 19:53:45','2014-01-17 19:53:45'),
	(168,'Hak membekukan sementara sebagian kekuasaan Presiden','0',0,44,'2014-01-17 19:53:45','2014-01-17 19:53:45'),
	(169,'Sigmund Freud','0',0,45,'2014-01-17 19:55:04','2014-01-17 19:55:04'),
	(170,'Machiavelli','0',0,45,'2014-01-17 19:55:04','2014-01-17 19:55:04'),
	(171,'J.J. Rousseau','0',0,45,'2014-01-17 19:55:04','2014-01-17 19:55:04'),
	(172,'John Locke','1',10,45,'2014-01-17 19:55:04','2014-01-17 19:55:04'),
	(173,'Negara kuat yang beritikad baik untuk melindungi negara-negara lain di sekitar wilayahnya','0',0,46,'2014-01-17 19:57:20','2014-01-17 19:57:20'),
	(174,'Negara kuat yang tak pernah minta perlindungan','0',0,46,'2014-01-17 19:57:20','2014-01-17 19:57:20'),
	(175,'Negara yang berada di bawah perlindungan negara lain yang lebih kuat','1',10,46,'2014-01-17 19:57:20','2014-01-17 19:57:20'),
	(176,'Negara yang butuh perlindungan','0',0,46,'2014-01-17 19:57:20','2014-01-17 19:57:20'),
	(177,'Pemilahan kepentingan yang positif dan kurang positif','0',0,47,'2014-01-17 19:59:11','2014-01-17 19:59:11'),
	(178,'Menyampaikan kepentingan rakyat kepada pemerintah','0',0,47,'2014-01-17 19:59:11','2014-01-17 19:59:11'),
	(179,'Proses menggabungkan berbagai kepentingan yang serupa','1',10,47,'2014-01-17 19:59:11','2014-01-17 19:59:11'),
	(180,'Membuang terlebih dahulu sebuah aspirasi kepentingan yang tidak patut untuk disuarakan','0',0,47,'2014-01-17 19:59:11','2014-01-17 19:59:11'),
	(181,'OAPC','0',0,48,'2014-01-17 19:59:57','2014-01-17 19:59:57'),
	(182,'IPA','0',0,48,'2014-01-17 19:59:57','2014-01-17 19:59:57'),
	(183,'AIPO','1',10,48,'2014-01-17 19:59:57','2014-01-17 19:59:57'),
	(184,'OECD','0',0,48,'2014-01-17 19:59:57','2014-01-17 19:59:57'),
	(185,'Tahun 1949 sampai dengan 1950','1',10,49,'2014-01-17 20:00:46','2014-01-17 20:00:46'),
	(186,'Tahun 1949 sampai dengan 1959','0',0,49,'2014-01-17 20:00:46','2014-01-17 20:00:46'),
	(187,'Tahun 1949 sampai dengan 1955','0',0,49,'2014-01-17 20:00:46','2014-01-17 20:00:46'),
	(188,'Tahun 1950 sampai dengan 1955','0',0,49,'2014-01-17 20:00:46','2014-01-17 20:00:46');

/*!40000 ALTER TABLE `jawaban` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kategori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`)
VALUES
	(1,'Pengetahuan Umum',NULL,NULL),
	(2,'Pengetahuan Dasar',NULL,NULL);

/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lembar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lembar`;

CREATE TABLE `lembar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `user_id` int(10) unsigned NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `is_random` enum('1','0') DEFAULT '0',
  `batas_waktu` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`,`kategori_id`),
  KEY `fk_lembar_kategori1_idx` (`kategori_id`),
  KEY `fk_lembar_users1_idx` (`user_id`),
  CONSTRAINT `fk_lembar_kategori1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lembar_users1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `lembar` WRITE;
/*!40000 ALTER TABLE `lembar` DISABLE KEYS */;

INSERT INTO `lembar` (`id`, `nama`, `keterangan`, `user_id`, `kategori_id`, `limit`, `is_random`, `batas_waktu`, `created_at`, `updated_at`)
VALUES
	(1,'Kuis Online EDI','Edi adalah <b>parto</b> dan parto adalah Edi bukan Ide ide.<br>',1,1,10,'1',20,'2014-01-17 20:27:32','2014-01-22 11:04:21'),
	(4,'Kontes Koding #4','Contoh kuis untuk kompetisi Kontes Koding #4.<br><ul><li>36 total soal<br></li><li>12 soal akan ditampilkan secara acak<br></li><li>Batas waktu 24 menit<br></li></ul>',1,1,12,'1',24,'2014-01-19 08:58:40','2014-01-19 09:24:13');

/*!40000 ALTER TABLE `lembar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),
	('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),
	('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),
	('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table soal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` text,
  `kategori_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `durasi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`kategori_id`,`user_id`),
  KEY `fk_soal_kategori_idx` (`kategori_id`),
  KEY `fk_soal_users1_idx` (`user_id`),
  CONSTRAINT `fk_soal_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_soal_users1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `soal` WRITE;
/*!40000 ALTER TABLE `soal` DISABLE KEYS */;

INSERT INTO `soal` (`id`, `pertanyaan`, `kategori_id`, `user_id`, `durasi`, `created_at`, `updated_at`)
VALUES
	(10,'<ul><li>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<span>Rusa bertanduk\r\n  indah. <br></span></li><li><span>Kambing adalah binatang bertanduk. <br></span></li><li><span>Kerbau mempunyai ekor dan tanduk.\r\n\r\n \r\n</span>\r\n\r\n\r\n\r\n\r\n</li></ul>',1,1,2,'2014-01-17 18:28:47','2014-01-17 18:28:47'),
	(11,'<span>Jika hari<b> kamis</b> adalah hari kelima dalam suatu\r\n  bulan,maka hari apakah hari ke-20 pada bulan tersebut ?</span><br>',1,1,3,'2014-01-17 18:34:17','2014-01-17 18:34:17'),
	(12,'<span><span>Kata\r\n  yang memiliki kelompok yang sama dengan kata <b>TENDENSI</b> adalah ?\r\n\r\n </span>\r\n</span>\r\n\r\n\r\n\r\n\r\n<br>',1,1,1,'2014-01-17 18:35:58','2014-01-17 18:35:58'),
	(13,'<span>Yang bukan termasuk\r\n  mata uang adalah ?\r\n\r\n \r\n</span>\r\n\r\n\r\n\r\n\r\n<br>',1,1,1,'2014-01-17 18:38:11','2014-01-17 18:38:11'),
	(14,'<span>Cari yang bentuknya\r\n  <u>tidak serupa</u></span><br>',1,1,2,'2014-01-17 18:43:28','2014-01-17 18:43:28'),
	(15,'Persamaan kata dari\r\n  kata DINAMIS adalah ?<br>',1,1,1,'2014-01-17 18:45:41','2014-01-17 18:45:41'),
	(16,'<span>LAMPU : GELAP :\r\n  TERANG = ....\r\n\r\n \r\n</span>\r\n\r\n\r\n\r\n\r\n<br>',1,1,1,'2014-01-17 18:47:18','2014-01-17 18:47:18'),
	(17,'<span>Organisasi <b>PBB</b> yang bergerak dalam bidang kemanusiaan adalah …</span><br>',1,1,2,'2014-01-17 18:53:58','2014-01-17 18:53:58'),
	(18,'<span>Suku <b>Samin</b> terdapat di daerah …</span><br>',1,1,2,'2014-01-17 18:54:35','2014-01-17 18:54:35'),
	(19,'Nama penghargaan di bidang perdamaian adalah …<br>',1,1,1,'2014-01-17 18:55:19','2014-01-17 18:55:19'),
	(20,'Nama maskot piala dunia di Afrika Selatan tahun 2010 adalah …<br>',1,1,1,'2014-01-17 18:55:52','2014-01-17 18:55:52'),
	(21,'Kata yang tidak cocok digunakan dalam komunikasi tulis resmi terdapat pada ….<br>',1,1,1,'2014-01-17 18:58:41','2014-01-17 18:58:41'),
	(22,'<div>\r\n			<div>\r\n				Sebagian perajin tempe mengeluhkan harga kedelai\r\nnaik. Pak Anto seorang perajin tempe.\r\n\r\n						\r\n				\r\n			</div>\r\n		</div>\r\n	\r\n<br>',1,1,1,'2014-01-17 19:04:06','2014-01-17 19:04:06'),
	(23,'<div>\r\n			<div>\r\n				Pagi ini Heldy punya rencana. Dia ingin\r\nmengembalikan CD Linux kepada Hardoyo setelah\r\nmerasakan kelezatan soto daging di Jalan Perintis kemerdekaan 75 Solo. Heldy ingin makan 2 pisang\r\ngoreng hangat di kantin Bu Sum di dekat kampus UNS\r\nSolo. Setelah makan pisang dia tidak mau minum es\r\nteh di kantin Bu Sum tapi ingin minum es buah di\r\ndekat stadion Manahan Solo. Sesudah dari Manahan,\r\nHeldy menuju Jalan perintis kemerdekaan.\r\n\r\n				\r\n			\r\n		\r\n	\r\n<br></div></div>',1,1,3,'2014-01-17 19:07:51','2014-01-17 19:07:51'),
	(24,'<div>\r\n			<div>\r\n				<div>\r\n					Azkia ingin nikah sebelum punya rumah. Ingin dapat\r\nkerja sebelum nikah. Setelah dapat kerja ingin punya\r\nusaha sambilan. Ingin punya anak setelah punya\r\nrumah. Ingin menikah setelah punya usaha sambilan.\r\nDan ingin punya usaha sambilan sebelum punya\r\nrumah. Mana urutan yang tepat ?</div></div></div>',1,1,4,'2014-01-17 19:12:38','2014-01-17 19:12:38'),
	(25,'<div>\r\n			<div>\r\n				<div>\r\n					Seri angka : 17, 21, 23, 27 selanjutnya ...</div></div></div>',1,1,1,'2014-01-17 19:14:24','2014-01-17 19:14:24'),
	(26,'<div>\r\n			<div>\r\n				<div>\r\n					Suatu seri huruf : z, v, r selanjutnya ...</div></div></div>',1,1,1,'2014-01-17 19:16:32','2014-01-17 19:16:32'),
	(27,'<div>\r\n			<div>\r\n				<div>\r\n					x adalah 28,95% dari 19. Dan y = 19% dari 28,95.\r\nMaka pernyataan yang benar ...</div></div></div>',1,1,4,'2014-01-17 19:20:29','2014-01-17 19:22:03'),
	(28,'<div>\r\n			<div>\r\n				Ridho harus mengkredit sebuah laptop dengan lima\r\nkali cicilan. Jika uang mukanya sebesar Rp.\r\n1.500.000,- yang merupakan 30% dari harga laptop,\r\nberapa rupiahkah yang harus dibayarkan Ridho tiap\r\nkali cicilan ?</div></div>',1,1,3,'2014-01-17 19:21:43','2014-01-17 19:21:43'),
	(29,'<div>\r\n			<div>\r\n				<div>\r\n					Pak Hakim mempunyai sejumlah x kelereng dan\r\ndibagikan merata kepada n orang. Setiap orang\r\nmendapatkan masing-masing 12 kelereng. Bila ada\r\ndua orang yang bergabung untuk minta kebagian\r\nkelereng, dan kemudian x kelereng tersebut dibagikan\r\nmerata, maka tiap orang mendapat 8 kelereng saja.\r\nBerapa jumlah n (kelompok pertama) ? Dan berapa pula x (jumlah kelereng) ?</div></div></div>',1,1,3,'2014-01-17 19:24:12','2014-01-17 19:24:21'),
	(30,'<div>\r\n			<div>\r\n				Sebagian orang yang berminat menjadi politikus hanya\r\nmenginginkan harta dan tahta. Rosyid tidak berminat\r\nmenjadi politikus</div></div>',1,1,1,'2014-01-17 19:25:33','2014-01-17 19:25:33'),
	(31,'<div>\r\n			<div>\r\n				Setelah dinyatakan lulus Ujian Nasional (Unas), Dhika mengajak anak-\r\nanak Panti Asuhan untuk makan-makan di Restoran Jepang. Kata\r\n“<u>makan-makan</u>” bermakna</div></div>',1,1,1,'2014-01-17 19:30:34','2014-01-17 19:30:34'),
	(32,'<div>\r\n			<div>\r\n				<div>\r\n					Sebab umum terjadinya Perang Dunia I tahun 1914-1918 adalah sebagai\r\nberikut, kecuali</div></div></div>',1,1,1,'2014-01-17 19:31:46','2014-01-17 19:31:46'),
	(33,'<div>\r\n			<div>\r\n				<div>\r\n					Revolusi Perancis yang terjadi pada tahun 1789 tidak terlepas dari\r\npengaruh pemikiran cendekiawan tentang demokrasi dan hukum. John\r\nLocke adalah salah satu cendekiawan terkenal, yang memiliki pendapat\r\nmengenai</div></div></div>',1,1,1,'2014-01-17 19:32:45','2014-01-17 19:32:45'),
	(34,'<div>\r\n			<div>\r\n				<div>\r\n					Perang Diponegoro akhirnya selesai setelah Pangeran Diponegoro\r\nditangkap dan dibuang ke Makassar. Selama perang tersebut\r\nberlangsung, Pangeran Diponegoro dibantu oleh</div></div></div>',1,1,1,'2014-01-17 19:33:36','2014-01-17 19:33:36'),
	(35,'<div>\r\n			<div>\r\n				<div>\r\n					Keputusan hakim terdahulu yang sering diakui dan dijadikan dasar\r\nkeputusan oleh hakim kemudian mengenai masalah yang serupa disebut\r\ndengan istilah</div></div></div>',1,1,1,'2014-01-17 19:35:42','2014-01-17 19:35:42'),
	(36,'<div>\r\n			<div>\r\n				Kata ahli dalam kata ahli mesin mengalami perubahan makna secara</div></div>',1,1,1,'2014-01-17 19:39:04','2014-01-17 19:39:04'),
	(37,'<div>\r\n			<div>\r\n				<div>\r\n					Kata bulutangkis adalah hiponim dari</div></div></div>',1,1,1,'2014-01-17 19:39:56','2014-01-17 19:39:56'),
	(38,'<div>\r\n			<div>\r\n				<div>\r\n					<ol><li>\r\n							Apabila tiang pancang kurang baik, kebudayaaan otomatis kekurangan\r\nkekuatan untuk berdiri tegak mengabdikan kepada kepentingan nasional.</li><li>Ini berarti bahwa salah satu bidang kehidupan bangsa dan negara mudah\r\nterancam.</li><li>Bahasa merupakan tiang pancang kebudayaan.</li><li>Maka jelaslah bahwa politik pertahanan keamanan nasional yang\r\nmenggariskan kebijakan didalam upaya rakyat untuk mewujudkan kondisi\r\naman sebagai salah satu syarat mutlak untuk menyukseskan perjuangan\r\nmempunyai korelasi yang erat dengan politik bahasa nasional.\r\n</li></ol>\r\n\r\n	\r\n		\r\n		\r\n	\r\n	\r\n		<div>\r\n			<div>\r\n				<div>\r\n					Urutan kalimat yang benar adalah ...\r\n\r\n				</div>\r\n			</div>\r\n		</div>\r\n	\r\n\r\n				</div>\r\n			</div>\r\n		</div>\r\n	\r\n<br><br>',1,1,3,'2014-01-17 19:41:45','2014-01-17 19:42:15'),
	(39,'<div>\r\n			<div>\r\n				Sebagai sebuah ilmu pengetahuan, Sejarah memiliki ciri-ciri sebagai\r\nberikut, kecuali</div></div>',1,1,1,'2014-01-17 19:44:26','2014-01-17 19:44:26'),
	(40,'<div>\r\n			<div>\r\n				Loyalitas setiap orang yang diberikan kepada negara adalah\r\npencerminan dari ideologi yang dinamakan</div></div>',1,1,1,'2014-01-17 19:45:24','2014-01-17 19:45:24'),
	(41,'<div>\r\n			<div>\r\n				Perang Dunia II terjadi pada tahun</div></div>',1,1,1,'2014-01-17 19:46:49','2014-01-17 19:46:49'),
	(42,'<div>\r\n			<div>\r\n				<div>\r\n					Jika presiden dan wakil presiden mangkat, berhenti atau diberhentikan,\r\nmaka pelaksana tugas kepresidenan dipegang oleh</div></div></div>',1,1,1,'2014-01-17 19:47:52','2014-01-17 19:47:52'),
	(43,'<div>\r\n			<div>\r\n				<div>\r\n					Grasi dan Rehabilitasi yang diberikan Presiden, adalah dengan\r\nmeperhatikan pertimbangan</div></div></div>',1,1,1,'2014-01-17 19:48:32','2014-01-17 19:48:32'),
	(44,'<div>\r\n			<div>\r\n				<div>\r\n					DPR memiliki hak interpelasi. Adapun arti dari hak interpelasi adalah</div></div></div>',1,1,1,'2014-01-17 19:53:45','2014-01-17 19:53:45'),
	(45,'<div>\r\n			<div>\r\n				<div>\r\n					Siapakah tokoh yang mengemukakan <i>Teori perjanjian masyarakat</i> ?</div></div></div>',1,1,1,'2014-01-17 19:55:04','2014-01-17 19:55:45'),
	(46,'<div>\r\n			<div>\r\n				<div>\r\n					Istilah negara <i>protektorat</i> memiliki arti :</div></div></div>',1,1,1,'2014-01-17 19:57:20','2014-01-17 19:57:20'),
	(47,'<div>\r\n			<div>\r\n				<div>\r\n					Salah satu fungsi dari partai politik adalah sebagai sarana komunikasi\r\npolitik. Dalam melaksanakan fungsi tersebut sebuah partai politik sering melakukan apa yang disebut agregasi kepentingan. Apa yang dimaksud\r\ndengan agregasi kepentingan ?\r\n	\r\n</div></div></div>',1,1,1,'2014-01-17 19:59:11','2014-01-17 19:59:11'),
	(48,'<div>\r\n			<div>\r\n				<div>\r\n					Organisasi kerjasama parlemen antar negara-negara anggota ASEAN\r\nadalah</div></div></div>',1,1,1,'2014-01-17 19:59:57','2014-01-17 19:59:57'),
	(49,'<div>\r\n			<div>\r\n				<div>\r\n					Negara Indonesia pernah melaksanakan bentuk negara federal <b>Republik Indonesia Serikat</b> pada tahun</div></div></div>',1,1,1,'2014-01-17 20:00:46','2014-01-17 20:01:16');

/*!40000 ALTER TABLE `soal` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table soal_has_lembar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `soal_has_lembar`;

CREATE TABLE `soal_has_lembar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soal_id` int(11) NOT NULL,
  `lembar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_soal_has_lembar_lembar1_idx` (`lembar_id`),
  KEY `fk_soal_has_lembar_soal1_idx` (`soal_id`),
  CONSTRAINT `fk_soal_has_lembar_lembar1` FOREIGN KEY (`lembar_id`) REFERENCES `lembar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_soal_has_lembar_soal1` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `soal_has_lembar` WRITE;
/*!40000 ALTER TABLE `soal_has_lembar` DISABLE KEYS */;

INSERT INTO `soal_has_lembar` (`id`, `soal_id`, `lembar_id`, `created_at`, `updated_at`)
VALUES
	(1,10,1,'2014-01-19 15:22:56',NULL),
	(2,16,1,'2014-01-19 15:30:46',NULL),
	(3,20,1,'2014-01-19 15:37:15',NULL),
	(7,36,4,'2014-01-19 15:59:11',NULL),
	(8,19,4,'2014-01-19 15:59:16',NULL),
	(9,41,4,'2014-01-19 15:59:21',NULL),
	(10,46,4,'2014-01-19 15:59:31',NULL),
	(11,43,4,'2014-01-19 15:59:36',NULL),
	(12,29,4,'2014-01-19 15:59:41',NULL),
	(13,38,4,'2014-01-19 15:59:47',NULL),
	(14,26,4,'2014-01-19 15:59:53',NULL),
	(15,28,4,'2014-01-19 15:59:57',NULL),
	(16,31,4,'2014-01-19 16:00:03',NULL),
	(17,25,4,'2014-01-19 16:00:08',NULL),
	(18,24,4,'2014-01-19 16:00:13',NULL),
	(19,20,4,'2014-01-19 16:00:18',NULL),
	(20,23,4,'2014-01-19 16:00:22',NULL),
	(21,17,4,'2014-01-19 16:02:49',NULL),
	(22,22,4,'2014-01-19 16:02:54',NULL),
	(23,14,4,'2014-01-19 16:02:59',NULL),
	(24,13,4,'2014-01-19 16:03:03',NULL),
	(25,15,4,'2014-01-19 16:03:08',NULL),
	(26,12,4,'2014-01-19 16:03:12',NULL),
	(27,27,4,'2014-01-19 16:03:17',NULL),
	(28,49,4,'2014-01-19 16:03:22',NULL),
	(29,30,4,'2014-01-19 16:03:28',NULL),
	(30,32,4,'2014-01-19 16:03:33',NULL),
	(31,33,4,'2014-01-19 16:03:37',NULL),
	(32,39,4,'2014-01-19 16:03:43',NULL),
	(33,48,4,'2014-01-19 16:03:51',NULL),
	(34,18,4,'2014-01-19 16:03:55',NULL),
	(35,16,4,'2014-01-19 16:03:59',NULL),
	(36,34,4,'2014-01-19 16:04:04',NULL),
	(37,40,4,'2014-01-19 16:04:09',NULL),
	(38,37,4,'2014-01-19 16:04:21',NULL),
	(39,45,4,'2014-01-19 16:04:29',NULL),
	(40,44,4,'2014-01-19 16:04:36',NULL),
	(41,21,4,'2014-01-19 16:04:41',NULL),
	(42,42,4,'2014-01-19 16:04:46',NULL);

/*!40000 ALTER TABLE `soal_has_lembar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`)
VALUES
	(1,2,NULL,0,0,0,NULL,NULL,NULL),
	(2,3,NULL,0,0,0,NULL,NULL,NULL),
	(3,1,NULL,0,0,0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin@demo.com','$2y$10$wuBJhrWqulZZcfxZldIScuq7hIqhzQe.lZtP57C2Ecyr.Ildm8OfO',NULL,1,NULL,NULL,'2014-02-05 22:45:20','$2y$10$kOv2yOlLHV2FdGPOM2k55OxYTaUXTsbB17zgM/WQ4QWdUlplWdR/e',NULL,NULL,NULL,'2014-01-22 18:27:33','2014-02-05 22:45:20'),
	(2,'user@demo.com','$2y$10$9qQqP0vuD0wvZKGgXUSOuuMlYynd/CJ2q.Rh6cpG.txGT3TwJSYdq',NULL,1,NULL,NULL,'2014-01-22 22:58:37','$2y$10$FT8o6k9Pi9aE3PZ9mi7CSOsB3IAF3sG1JCiit16xworNTK/7jszJK',NULL,NULL,NULL,'2014-01-22 18:27:34','2014-01-22 22:58:37'),
	(3,'bambang@demo.com','$2y$10$NKTxqNVItBtRpmqsQs2BdOa3JwRz7jfclJiAGvyhMnjOiOqGMc3GW',NULL,1,'v2hw0BRgJxI6TgkYZYfDHgudrdJ7uhK3vAidZDQBTo','2014-01-22 19:17:47','2014-01-22 22:18:09','$2y$10$rFN4c0Ize1uElL7lrrw3UOnZww8O287kHdYjPwCowzOWHzIpZz.pq',NULL,NULL,NULL,'2014-01-22 19:17:47','2014-01-22 22:18:09');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_jawab
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_jawab`;

CREATE TABLE `user_jawab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soal_id` int(11) NOT NULL,
  `jawaban_id` int(11) DEFAULT NULL,
  `user_jawab_lembar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`soal_id`,`user_jawab_lembar_id`),
  KEY `fk_user_jawab_soal1_idx` (`soal_id`),
  KEY `fk_user_jawab_jawaban1_idx` (`jawaban_id`),
  KEY `fk_user_jawab_user_jawab_lembar1_idx` (`user_jawab_lembar_id`),
  CONSTRAINT `fk_user_jawab_jawaban1` FOREIGN KEY (`jawaban_id`) REFERENCES `jawaban` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_jawab_soal1` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_jawab_user_jawab_lembar1` FOREIGN KEY (`user_jawab_lembar_id`) REFERENCES `user_jawab_lembar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_jawab` WRITE;
/*!40000 ALTER TABLE `user_jawab` DISABLE KEYS */;

INSERT INTO `user_jawab` (`id`, `soal_id`, `jawaban_id`, `user_jawab_lembar_id`, `created_at`, `updated_at`)
VALUES
	(10,20,70,10,'2014-01-22 21:11:04','2014-01-22 21:11:09'),
	(11,10,32,10,'2014-01-22 21:11:04','2014-01-22 21:11:12'),
	(12,16,55,10,'2014-01-22 21:11:04','2014-01-22 21:11:17'),
	(13,16,NULL,11,'2014-01-22 21:24:09','2014-01-22 21:24:09'),
	(14,20,NULL,11,'2014-01-22 21:24:09','2014-01-22 21:24:09'),
	(15,10,NULL,11,'2014-01-22 21:24:09','2014-01-22 21:24:09'),
	(16,13,41,12,'2014-01-22 22:18:22','2014-01-22 22:18:28'),
	(17,48,182,12,'2014-01-22 22:18:22','2014-01-22 22:18:32'),
	(18,12,38,12,'2014-01-22 22:18:22','2014-01-22 22:19:19'),
	(19,41,154,12,'2014-01-22 22:18:22','2014-01-22 22:18:43'),
	(20,20,71,12,'2014-01-22 22:18:22','2014-01-22 22:18:46'),
	(21,28,102,12,'2014-01-22 22:18:22','2014-01-22 22:18:51'),
	(22,18,61,12,'2014-01-22 22:18:22','2014-01-22 22:18:56'),
	(23,15,51,12,'2014-01-22 22:18:22','2014-01-22 22:19:00'),
	(24,21,74,12,'2014-01-22 22:18:22','2014-01-22 22:19:03'),
	(25,37,137,12,'2014-01-22 22:18:22','2014-01-22 22:19:07'),
	(26,36,135,12,'2014-01-22 22:18:22','2014-01-22 22:19:11'),
	(27,17,60,12,'2014-01-22 22:18:22','2014-01-22 22:19:14'),
	(28,40,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(29,14,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(30,25,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(31,39,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(32,24,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(33,27,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(34,37,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(35,32,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(36,16,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(37,36,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(38,41,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55'),
	(39,49,NULL,13,'2014-01-22 23:03:55','2014-01-22 23:03:55');

/*!40000 ALTER TABLE `user_jawab` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_jawab_lembar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_jawab_lembar`;

CREATE TABLE `user_jawab_lembar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lembar_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wkt_mulai` timestamp NULL DEFAULT NULL,
  `wkt_selesai` timestamp NULL DEFAULT NULL,
  `score` double DEFAULT '0',
  PRIMARY KEY (`id`,`lembar_id`,`user_id`),
  KEY `fk_user_jawab_lembar_lembar1_idx` (`lembar_id`),
  KEY `fk_user_jawab_lembar_users1_idx` (`user_id`),
  CONSTRAINT `fk_user_jawab_lembar_lembar1` FOREIGN KEY (`lembar_id`) REFERENCES `lembar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_jawab_lembar_users1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user_jawab_lembar` WRITE;
/*!40000 ALTER TABLE `user_jawab_lembar` DISABLE KEYS */;

INSERT INTO `user_jawab_lembar` (`id`, `lembar_id`, `user_id`, `created_at`, `updated_at`, `wkt_mulai`, `wkt_selesai`, `score`)
VALUES
	(10,1,2,'2014-01-22 21:11:04','2014-01-22 21:11:17','2014-01-22 21:11:04','2014-01-22 21:11:17',26),
	(11,1,2,'2014-01-22 21:24:09','2014-01-22 21:24:09','2014-01-22 21:24:09',NULL,10),
	(12,4,3,'2014-01-22 22:18:22','2014-01-22 22:19:19','2014-01-22 22:18:22','2014-01-22 22:19:19',24),
	(13,4,2,'2014-01-22 23:03:55','2014-01-22 23:03:55','2014-01-22 23:03:55',NULL,12);

/*!40000 ALTER TABLE `user_jawab_lembar` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`user_id`, `group_id`)
VALUES
	(1,1),
	(1,2),
	(2,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
