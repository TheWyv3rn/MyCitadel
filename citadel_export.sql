/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: citadel_core
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_id` varchar(64) NOT NULL,
  `badge_icon` varchar(64) NOT NULL,
  `badge_color` varchar(10) NOT NULL,
  `points` int(11) DEFAULT 0,
  `badge_category` varchar(32) DEFAULT NULL,
  `badge_name` text DEFAULT NULL,
  `badge_description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badge_id` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` VALUES
(1,'BADGE_BUG_1','fas fa-bug','#00ffcc',100,'HACKER',NULL,NULL),
(2,'BADGE_BUG_5','fas fa-shield-alt','#00ffcc',500,'HACKER',NULL,NULL),
(3,'BADGE_BUG_10','fas fa-user-secret','#00ffcc',1000,'HACKER',NULL,NULL),
(4,'BADGE_GIT_1','fas fa-code-branch','#f05032',50,'CODER',NULL,NULL),
(5,'BADGE_GIT_5','fas fa-terminal','#f05032',250,'CODER',NULL,NULL),
(6,'BADGE_GIT_10','fas fa-microchip','#f05032',500,'CODER',NULL,NULL),
(7,'BADGE_POST_1','fas fa-paper-plane','#00d4ff',10,'SOCIAL',NULL,NULL),
(8,'BADGE_POST_5','fas fa-bullhorn','#00d4ff',50,'SOCIAL',NULL,NULL),
(9,'BADGE_POST_10','fas fa-newspaper','#00d4ff',100,'SOCIAL',NULL,NULL),
(10,'BADGE_POST_50','fas fa-broadcast-tower','#00d4ff',500,'SOCIAL',NULL,NULL),
(11,'BADGE_POST_100','fas fa-star','#00d4ff',1000,'SOCIAL',NULL,NULL),
(12,'BADGE_POST_1000','fas fa-crown','#00d4ff',5000,'SOCIAL',NULL,NULL),
(13,'BADGE_COMMENT_1','fas fa-comment','#ffd700',5,'SOCIAL',NULL,NULL),
(14,'BADGE_COMMENT_5','fas fa-comments','#ffd700',25,'SOCIAL',NULL,NULL),
(15,'BADGE_COMMENT_10','fas fa-comment-dots','#ffd700',50,'SOCIAL',NULL,NULL),
(16,'BADGE_COMMENT_50','fas fa-comment-medical','#ffd700',250,'SOCIAL',NULL,NULL),
(17,'BADGE_COMMENT_100','fas fa-comment-slash','#ffd700',500,'SOCIAL',NULL,NULL),
(18,'BADGE_COMMENT_1000','fas fa-comment-alt','#ffd700',2500,'SOCIAL',NULL,NULL),
(19,'BADGE_COMMENTED_1','fas fa-reply','#ff8c00',10,'SOCIAL',NULL,NULL),
(20,'BADGE_COMMENTED_5','fas fa-reply-all','#ff8c00',50,'SOCIAL',NULL,NULL),
(21,'BADGE_COMMENTED_10','fas fa-quote-left','#ff8c00',100,'SOCIAL',NULL,NULL),
(22,'BADGE_COMMENTED_50','fas fa-quote-right','#ff8c00',500,'SOCIAL',NULL,NULL),
(23,'BADGE_COMMENTED_100','fas fa-at','#ff8c00',1000,'SOCIAL',NULL,NULL),
(24,'BADGE_COMMENTED_1000','fas fa-envelope-open-text','#ff8c00',5000,'SOCIAL',NULL,NULL),
(25,'BADGE_LIKE_1','fas fa-heart','#ff0055',2,'SOCIAL',NULL,NULL),
(26,'BADGE_LIKE_5','fas fa-heart','#ff0055',10,'SOCIAL',NULL,NULL),
(27,'BADGE_LIKE_10','fas fa-heart','#ff0055',20,'SOCIAL',NULL,NULL),
(28,'BADGE_LIKE_50','fas fa-heart','#ff0055',100,'SOCIAL',NULL,NULL),
(29,'BADGE_LIKE_100','fas fa-heart','#ff0055',200,'SOCIAL',NULL,NULL),
(30,'BADGE_LIKE_1000','fas fa-heart','#ff0055',2000,'SOCIAL',NULL,NULL),
(31,'BADGE_LIKED_1','fas fa-thumbs-up','#ff0055',5,'SOCIAL',NULL,NULL),
(32,'BADGE_LIKED_5','fas fa-thumbs-up','#ff0055',25,'SOCIAL',NULL,NULL),
(33,'BADGE_LIKED_10','fas fa-thumbs-up','#ff0055',50,'SOCIAL',NULL,NULL),
(34,'BADGE_LIKED_50','fas fa-thumbs-up','#ff0055',250,'SOCIAL',NULL,NULL),
(35,'BADGE_LIKED_100','fas fa-thumbs-up','#ff0055',500,'SOCIAL',NULL,NULL),
(36,'BADGE_LIKED_1000','fas fa-thumbs-up','#ff0055',5000,'SOCIAL',NULL,NULL),
(37,'BADGE_SLIKE_1','fas fa-bolt','#00ff00',10,'SOCIAL',NULL,NULL),
(38,'BADGE_SLIKE_5','fas fa-bolt','#00ff00',50,'SOCIAL',NULL,NULL),
(39,'BADGE_SLIKE_10','fas fa-bolt','#00ff00',100,'SOCIAL',NULL,NULL),
(40,'BADGE_SLIKE_50','fas fa-bolt','#00ff00',500,'SOCIAL',NULL,NULL),
(41,'BADGE_SLIKE_100','fas fa-bolt','#00ff00',1000,'SOCIAL',NULL,NULL),
(42,'BADGE_SLIKE_1000','fas fa-bolt','#00ff00',10000,'SOCIAL',NULL,NULL),
(43,'BADGE_SDIS_1','fas fa-dumpster-fire','#ff4500',5,'SOCIAL',NULL,NULL),
(44,'BADGE_SDIS_5','fas fa-dumpster-fire','#ff4500',25,'SOCIAL',NULL,NULL),
(45,'BADGE_SDIS_10','fas fa-dumpster-fire','#ff4500',50,'SOCIAL',NULL,NULL),
(46,'BADGE_SDIS_50','fas fa-dumpster-fire','#ff4500',250,'SOCIAL',NULL,NULL),
(47,'BADGE_SDIS_100','fas fa-dumpster-fire','#ff4500',500,'SOCIAL',NULL,NULL),
(48,'BADGE_SDIS_1000','fas fa-dumpster-fire','#ff4500',5000,'SOCIAL',NULL,NULL),
(49,'BADGE_SLIKED_1','fas fa-fire','#00ff00',20,'SOCIAL',NULL,NULL),
(50,'BADGE_SLIKED_5','fas fa-fire','#00ff00',100,'SOCIAL',NULL,NULL),
(51,'BADGE_SLIKED_10','fas fa-fire','#00ff00',200,'SOCIAL',NULL,NULL),
(52,'BADGE_SLIKED_50','fas fa-fire','#00ff00',1000,'SOCIAL',NULL,NULL),
(53,'BADGE_SLIKED_100','fas fa-fire','#00ff00',2000,'SOCIAL',NULL,NULL),
(54,'BADGE_SLIKED_1000','fas fa-fire','#00ff00',20000,'SOCIAL',NULL,NULL),
(55,'BADGE_SDISD_1','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(56,'BADGE_SDISD_5','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(57,'BADGE_SDISD_10','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(58,'BADGE_SDISD_50','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(59,'BADGE_SDISD_100','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(60,'BADGE_SDISD_1000','fas fa-radiation','#ff4500',0,'SOCIAL',NULL,NULL),
(61,'BADGE_PROF_AVATAR','fas fa-user-circle','#a29bfe',50,'PROFILE',NULL,NULL),
(62,'BADGE_PROF_BANNER','fas fa-image','#a29bfe',50,'PROFILE',NULL,NULL),
(63,'BADGE_PROF_BIO','fas fa-address-card','#a29bfe',50,'PROFILE',NULL,NULL),
(64,'BADGE_PROF_SOCIALS','fas fa-share-alt','#a29bfe',100,'PROFILE',NULL,NULL),
(65,'BADGE_PROF_EDUCATION','fas fa-user-graduate','#a29bfe',100,'PROFILE',NULL,NULL),
(66,'BADGE_PROF_JOB','fas fa-briefcase','#a29bfe',100,'PROFILE',NULL,NULL),
(67,'BADGE_PROF_SECURITY','fas fa-user-lock','#a29bfe',200,'PROFILE',NULL,NULL),
(68,'BADGE_COMM_PM_1','fas fa-paper-plane','#bdc3c7',5,'COMMS',NULL,NULL),
(69,'BADGE_COMM_PM_5','fas fa-paper-plane','#bdc3c7',25,'COMMS',NULL,NULL),
(70,'BADGE_COMM_PM_10','fas fa-paper-plane','#bdc3c7',50,'COMMS',NULL,NULL),
(71,'BADGE_COMM_GRP_1','fas fa-users','#bdc3c7',10,'COMMS',NULL,NULL),
(72,'BADGE_COMM_GRP_5','fas fa-users','#bdc3c7',50,'COMMS',NULL,NULL),
(73,'BADGE_COMM_GRP_10','fas fa-users','#bdc3c7',100,'COMMS',NULL,NULL);
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `citizen_badges`
--

DROP TABLE IF EXISTS `citizen_badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `citizen_badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citizen_id` int(11) NOT NULL,
  `badge_db_id` int(11) NOT NULL,
  `awarded_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `citizen_id` (`citizen_id`),
  KEY `badge_db_id` (`badge_db_id`),
  CONSTRAINT `citizen_badges_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`id`) ON DELETE CASCADE,
  CONSTRAINT `citizen_badges_ibfk_2` FOREIGN KEY (`badge_db_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citizen_badges`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `citizen_badges` WRITE;
/*!40000 ALTER TABLE `citizen_badges` DISABLE KEYS */;
/*!40000 ALTER TABLE `citizen_badges` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `citizens`
--

DROP TABLE IF EXISTS `citizens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `citizens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(64) NOT NULL,
  `email_hash` varchar(512) NOT NULL,
  `password_hash` varchar(512) NOT NULL,
  `public_key` text DEFAULT NULL,
  `reputation` int(11) DEFAULT 0,
  `influence` int(11) DEFAULT 0,
  `infractions` int(11) DEFAULT 0,
  `is_premium` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `current_session_id` varchar(255) DEFAULT NULL,
  `browser_fingerprint` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT 'citizen/media/avatars/default.png',
  `banner_path` varchar(255) DEFAULT 'citizen/media/banners/default.png',
  `full_name` varchar(128) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `short_bio` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `fb_handle` varchar(100) DEFAULT NULL,
  `x_handle` varchar(100) DEFAULT NULL,
  `ig_handle` varchar(100) DEFAULT NULL,
  `li_handle` varchar(100) DEFAULT NULL,
  `gh_handle` varchar(100) DEFAULT NULL,
  `h1_handle` varchar(100) DEFAULT NULL,
  `bc_handle` varchar(100) DEFAULT NULL,
  `it_handle` varchar(100) DEFAULT NULL,
  `ywh_handle` varchar(100) DEFAULT NULL,
  `so_handle` varchar(100) DEFAULT NULL,
  `medium_handle` varchar(100) DEFAULT NULL,
  `yt_handle` varchar(100) DEFAULT NULL,
  `twitch_handle` varchar(100) DEFAULT NULL,
  `kick_handle` varchar(100) DEFAULT NULL,
  `xbox_handle` varchar(100) DEFAULT NULL,
  `ps_handle` varchar(100) DEFAULT NULL,
  `steam_handle` varchar(100) DEFAULT NULL,
  `blizzard_handle` varchar(100) DEFAULT NULL,
  `nintendo_handle` varchar(100) DEFAULT NULL,
  `fav_books` text DEFAULT NULL,
  `fav_shows` text DEFAULT NULL,
  `fav_movies` text DEFAULT NULL,
  `fav_songs` text DEFAULT NULL,
  `fav_activities` text DEFAULT NULL,
  `job_company` varchar(150) DEFAULT NULL,
  `job_title` varchar(150) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `highschool` varchar(150) DEFAULT NULL,
  `college_1` varchar(150) DEFAULT NULL,
  `college_2` varchar(150) DEFAULT NULL,
  `college_3` varchar(150) DEFAULT NULL,
  `diploma_1` varchar(150) DEFAULT NULL,
  `diploma_2` varchar(150) DEFAULT NULL,
  `diploma_3` varchar(150) DEFAULT NULL,
  `cert_1` varchar(150) DEFAULT NULL,
  `cert_2` varchar(150) DEFAULT NULL,
  `cert_3` varchar(150) DEFAULT NULL,
  `cert_4` varchar(150) DEFAULT NULL,
  `relationship_status` enum('Married','Dating','Single','Widow') DEFAULT 'Single',
  `has_kids` enum('yes','no') DEFAULT 'no',
  `mfa_email_enabled` tinyint(1) DEFAULT 0,
  `mfa_2fa_enabled` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  UNIQUE KEY `email_hash` (`email_hash`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citizens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `citizens` WRITE;
/*!40000 ALTER TABLE `citizens` DISABLE KEYS */;
INSERT INTO `citizens` VALUES
(1,'TheWyv3rn','HtMCU1R5LCQwAkY3335KAe7pT02Y1tEYsxT1e2ictNpmEfKAyGe0zYb0aJvZZhCY0RZrugJw1GdQ3QYLCmQFD9ahugK6kRTtWDUaGcbZtTsIcS7XUqIzm6cdEaqwtW0XovGjboAXScA=','$argon2id$v=19$m=65536,t=4,p=1$dzdMeTMvdm16UkVIWGZQRw$p1+aVBN7q+hE6jFUYZwIPh8ZnUd3W2/Cu3Nekjx+qSc',NULL,0,0,0,0,'2026-05-05 16:20:16','2026-05-05 16:39:29','841dec9329d523cf3fb52b8adacb0c4e','de1a20521a0786329617052eb0ce4422af69bd7aae2d1598fd43fedd21ff6fc2','citizen/media/avatars/default.png','citizen/media/banners/default.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Single','no',0,0);
/*!40000 ALTER TABLE `citizens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-05-05 17:15:54
