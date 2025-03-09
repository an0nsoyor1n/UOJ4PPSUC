-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: app_uoj233
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `best_ac_submissions`
--

DROP TABLE IF EXISTS `best_ac_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `best_ac_submissions` (
  `problem_id` int(11) NOT NULL,
  `submitter` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_id` int(11) NOT NULL,
  `used_time` int(11) NOT NULL,
  `used_memory` int(11) NOT NULL,
  `tot_size` int(11) NOT NULL,
  `shortest_id` int(11) NOT NULL,
  `shortest_used_time` int(11) NOT NULL,
  `shortest_used_memory` int(11) NOT NULL,
  `shortest_tot_size` int(11) NOT NULL,
  PRIMARY KEY (`problem_id`,`submitter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `best_ac_submissions`
--

LOCK TABLES `best_ac_submissions` WRITE;
/*!40000 ALTER TABLE `best_ac_submissions` DISABLE KEYS */;
INSERT INTO `best_ac_submissions` VALUES (1,'an0n',6,9,3284,608,6,9,3284,608);
/*!40000 ALTER TABLE `best_ac_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_problems`
--

DROP TABLE IF EXISTS `blog_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_problems` (
  `blog_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`problem_id`),
  KEY `blog_id` (`blog_id`),
  KEY `problem_id` (`problem_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_problems`
--

LOCK TABLES `blog_problems` WRITE;
/*!40000 ALTER TABLE `blog_problems` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_time` datetime NOT NULL,
  `poster` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_md` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `zan` int(11) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'E' COMMENT 'S: solution, E: experience',
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'新博客','','2025-03-05 19:55:29','an0n','',0,0,'E',0);
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs_comments`
--

DROP TABLE IF EXISTS `blogs_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_time` datetime NOT NULL,
  `poster` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zan` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_comments`
--

LOCK TABLES `blogs_comments` WRITE;
/*!40000 ALTER TABLE `blogs_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs_tags`
--

DROP TABLE IF EXISTS `blogs_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_tags`
--

LOCK TABLES `blogs_tags` WRITE;
/*!40000 ALTER TABLE `blogs_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `click_zans`
--

DROP TABLE IF EXISTS `click_zans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `click_zans` (
  `type` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` int(11) NOT NULL,
  `val` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`type`,`target_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `click_zans`
--

LOCK TABLES `click_zans` WRITE;
/*!40000 ALTER TABLE `click_zans` DISABLE KEYS */;
/*!40000 ALTER TABLE `click_zans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests`
--

DROP TABLE IF EXISTS `contests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `last_min` int(11) NOT NULL,
  `player_num` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `extra_config` varchar(200) NOT NULL,
  `zan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests`
--

LOCK TABLES `contests` WRITE;
/*!40000 ALTER TABLE `contests` DISABLE KEYS */;
INSERT INTO `contests` VALUES (1,'New Contest','2025-03-05 17:50:04',180,0,'unfinished','',0);
/*!40000 ALTER TABLE `contests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_asks`
--

DROP TABLE IF EXISTS `contests_asks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_asks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contest_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `post_time` datetime NOT NULL,
  `reply_time` datetime NOT NULL,
  `is_hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_asks`
--

LOCK TABLES `contests_asks` WRITE;
/*!40000 ALTER TABLE `contests_asks` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_asks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_notice`
--

DROP TABLE IF EXISTS `contests_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_notice` (
  `contest_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  KEY `contest_id` (`contest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_notice`
--

LOCK TABLES `contests_notice` WRITE;
/*!40000 ALTER TABLE `contests_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_permissions`
--

DROP TABLE IF EXISTS `contests_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_permissions` (
  `username` varchar(20) NOT NULL,
  `contest_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`contest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_permissions`
--

LOCK TABLES `contests_permissions` WRITE;
/*!40000 ALTER TABLE `contests_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_problems`
--

DROP TABLE IF EXISTS `contests_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_problems` (
  `problem_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  PRIMARY KEY (`problem_id`,`contest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_problems`
--

LOCK TABLES `contests_problems` WRITE;
/*!40000 ALTER TABLE `contests_problems` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_registrants`
--

DROP TABLE IF EXISTS `contests_registrants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_registrants` (
  `username` varchar(20) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `has_participated` tinyint(1) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`contest_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_registrants`
--

LOCK TABLES `contests_registrants` WRITE;
/*!40000 ALTER TABLE `contests_registrants` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_registrants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contests_submissions`
--

DROP TABLE IF EXISTS `contests_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contests_submissions` (
  `contest_id` int(11) NOT NULL,
  `submitter` varchar(20) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `penalty` int(11) NOT NULL,
  PRIMARY KEY (`contest_id`,`submitter`,`problem_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contests_submissions`
--

LOCK TABLES `contests_submissions` WRITE;
/*!40000 ALTER TABLE `contests_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_test_submissions`
--

DROP TABLE IF EXISTS `custom_test_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_test_submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` int(10) unsigned NOT NULL,
  `submit_time` datetime NOT NULL,
  `submitter` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `judge_time` datetime DEFAULT NULL,
  `result` blob NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_details` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_test_submissions`
--

LOCK TABLES `custom_test_submissions` WRITE;
/*!40000 ALTER TABLE `custom_test_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_test_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hacks`
--

DROP TABLE IF EXISTS `hacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned DEFAULT NULL,
  `submission_id` int(10) unsigned NOT NULL,
  `hacker` varchar(20) NOT NULL,
  `owner` varchar(20) NOT NULL,
  `input` varchar(150) NOT NULL,
  `input_type` char(20) NOT NULL,
  `submit_time` datetime NOT NULL,
  `judge_time` datetime DEFAULT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `details` blob NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_id` (`submission_id`),
  KEY `is_hidden` (`is_hidden`,`problem_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hacks`
--

LOCK TABLES `hacks` WRITE;
/*!40000 ALTER TABLE `hacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `hacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `important_blogs`
--

DROP TABLE IF EXISTS `important_blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `important_blogs` (
  `blog_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `important_blogs`
--

LOCK TABLES `important_blogs` WRITE;
/*!40000 ALTER TABLE `important_blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `important_blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `judger_info`
--

DROP TABLE IF EXISTS `judger_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `judger_info` (
  `judger_name` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ip` char(20) NOT NULL,
  PRIMARY KEY (`judger_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `judger_info`
--

LOCK TABLES `judger_info` WRITE;
/*!40000 ALTER TABLE `judger_info` DISABLE KEYS */;
INSERT INTO `judger_info` VALUES ('compose_judger','_judger_password_','');
/*!40000 ALTER TABLE `judger_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `executed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_migration` (`migration`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'add_problem_lists.sql','2025-03-05 11:21:38'),(2,'update_blogs_type.sql','2025-03-05 11:21:38');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastes`
--

DROP TABLE IF EXISTS `pastes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pastes` (
  `index` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`index`),
  UNIQUE KEY `pastes_index_uindex` (`index`),
  KEY `pastes_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastes`
--

LOCK TABLES `pastes` WRITE;
/*!40000 ALTER TABLE `pastes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pastes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem_list_problems`
--

DROP TABLE IF EXISTS `problem_list_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem_list_problems` (
  `list_id` int(11) NOT NULL,
  `problem_id` int(10) unsigned NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`list_id`,`problem_id`),
  KEY `problem_id` (`problem_id`),
  KEY `list_id` (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem_list_problems`
--

LOCK TABLES `problem_list_problems` WRITE;
/*!40000 ALTER TABLE `problem_list_problems` DISABLE KEYS */;
INSERT INTO `problem_list_problems` VALUES (1,1,1);
/*!40000 ALTER TABLE `problem_list_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem_lists`
--

DROP TABLE IF EXISTS `problem_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `tags` varchar(255) DEFAULT NULL,
  `creator_username` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `creator_username` (`creator_username`),
  KEY `create_time` (`create_time`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem_lists`
--

LOCK TABLES `problem_lists` WRITE;
/*!40000 ALTER TABLE `problem_lists` DISABLE KEYS */;
INSERT INTO `problem_lists` VALUES (1,'新题单','123','123','an0n','2025-03-05 14:00:28','2025-03-05 14:00:32',1);
/*!40000 ALTER TABLE `problem_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem_lists_contents`
--

DROP TABLE IF EXISTS `problem_lists_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem_lists_contents` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `problem_lists_contents_ibfk_1` FOREIGN KEY (`id`) REFERENCES `problem_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem_lists_contents`
--

LOCK TABLES `problem_lists_contents` WRITE;
/*!40000 ALTER TABLE `problem_lists_contents` DISABLE KEYS */;
INSERT INTO `problem_lists_contents` VALUES (3),(4);
/*!40000 ALTER TABLE `problem_lists_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problems`
--

DROP TABLE IF EXISTS `problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `submission_requirement` text,
  `hackable` tinyint(1) NOT NULL DEFAULT '0',
  `extra_config` varchar(500) NOT NULL DEFAULT '{"view_content_type":"ALL","view_details_type":"ALL"}',
  `zan` int(11) NOT NULL,
  `ac_num` int(11) NOT NULL DEFAULT '0',
  `submit_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problems`
--

LOCK TABLES `problems` WRITE;
/*!40000 ALTER TABLE `problems` DISABLE KEYS */;
INSERT INTO `problems` VALUES (1,'New Problem',1,'[{\"name\":\"answer\",\"type\":\"source code\",\"file_name\":\"answer.code\"}]',0,'{\"view_content_type\":\"ALL\",\"view_details_type\":\"ALL\"}',0,1,6),(2,'New Problem',1,'{}',0,'{\"view_content_type\":\"ALL\",\"view_details_type\":\"ALL\"}',0,0,0);
/*!40000 ALTER TABLE `problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problems_contents`
--

DROP TABLE IF EXISTS `problems_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems_contents` (
  `id` int(11) NOT NULL,
  `statement` mediumtext NOT NULL,
  `statement_md` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problems_contents`
--

LOCK TABLES `problems_contents` WRITE;
/*!40000 ALTER TABLE `problems_contents` DISABLE KEYS */;
INSERT INTO `problems_contents` VALUES (1,'',''),(2,'','');
/*!40000 ALTER TABLE `problems_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problems_permissions`
--

DROP TABLE IF EXISTS `problems_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems_permissions` (
  `username` varchar(20) NOT NULL,
  `problem_id` int(11) NOT NULL,
  PRIMARY KEY (`username`,`problem_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problems_permissions`
--

LOCK TABLES `problems_permissions` WRITE;
/*!40000 ALTER TABLE `problems_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `problems_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problems_tags`
--

DROP TABLE IF EXISTS `problems_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_id` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `problem_id` (`problem_id`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problems_tags`
--

LOCK TABLES `problems_tags` WRITE;
/*!40000 ALTER TABLE `problems_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `problems_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_requests`
--

DROP TABLE IF EXISTS `search_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `remote_addr` varchar(50) NOT NULL,
  `type` enum('search','autocomplete') NOT NULL,
  `cache_id` int(11) NOT NULL,
  `q` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `result` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `remote_addr` (`remote_addr`,`created_at`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_requests`
--

LOCK TABLES `search_requests` WRITE;
/*!40000 ALTER TABLE `search_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `problem_id` int(10) unsigned NOT NULL,
  `contest_id` int(10) unsigned DEFAULT NULL,
  `submit_time` datetime NOT NULL,
  `submitter` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(15) NOT NULL,
  `tot_size` int(11) NOT NULL,
  `judge_time` datetime DEFAULT NULL,
  `result` blob NOT NULL,
  `status` varchar(20) NOT NULL,
  `result_error` varchar(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `used_time` int(11) NOT NULL DEFAULT '0',
  `used_memory` int(11) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL,
  `status_details` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_hidden` (`is_hidden`,`problem_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES (1,1,NULL,'2025-03-05 18:48:43','an0n','{\"file_name\":\"\\/submission\\/7215\\/lMlYgz3DEiqKMxndk2FH\",\"config\":[[\"problem_id\",\"1\"]]}','/',0,'2025-03-05 18:48:44',_binary '{\"score\":0,\"error\":\"Judgement Failed\",\"details\":\"Unknown Error\",\"status\":\"Judged\"}','Judged','Judgement Failed',NULL,0,0,1,''),(2,1,NULL,'2025-03-05 22:13:15','an0n','{\"file_name\":\"\\/submission\\/3496\\/VQquKDJOivMbOj3Oo9wJ\",\"config\":[[\"answer_language\",\"C++\"],[\"problem_id\",\"1\"]]}','C++',489,'2025-03-05 22:13:16',_binary '{\"score\":77,\"time\":8,\"memory\":3416,\"details\":\"<tests>\\n<test num=\\\"1\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3332\\\">\\n<in>88 527\\n77 6\\n3 77\\n42 57\\n12 88\\n20 99\\n64 30\\n39 82\\n54 39\\n34 92\\n86 39\\n36 36\\n15 98\\n31 35\\n23 77\\n26 88\\n9 22\\n...<\\/in>\\n<out>2101<\\/out>\\n<res>ok &quot;2101&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"2\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3272\\\">\\n<in>53 193\\n4 27\\n40 83\\n63 9\\n71 65\\n66 63\\n62 65\\n48 13\\n39 99\\n64 31\\n83 8\\n60 82\\n90 60\\n6 30\\n50 79\\n98 41\\n30 50\\n5...<\\/in>\\n<out>917<\\/out>\\n<res>ok &quot;917&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"3\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3260\\\">\\n<in>98 319\\n81 32\\n57 69\\n25 67\\n46 68\\n41 52\\n38 73\\n72 60\\n51 26\\n23 67\\n99 52\\n13 51\\n8 82\\n94 47\\n74 8\\n27 62\\n52 26...<\\/in>\\n<out>1295<\\/out>\\n<res>ok &quot;1295&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"4\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3324\\\">\\n<in>66 571\\n24 87\\n31 78\\n86 55\\n79 69\\n61 7\\n19 94\\n61 7\\n46 6\\n43 92\\n88 33\\n24 34\\n58 59\\n18 99\\n77 26\\n60 54\\n64 82\\n...<\\/in>\\n<out>1561<\\/out>\\n<res>ok &quot;1561&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"5\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3416\\\">\\n<in>91 753\\n92 49\\n83 16\\n51 9\\n55 11\\n71 90\\n83 43\\n84 14\\n99 81\\n10 4\\n67 77\\n34 45\\n15 40\\n31 61\\n7 14\\n26 73\\n16 97\\n...<\\/in>\\n<out>1950<\\/out>\\n<res>ok &quot;1950&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"6\\\" score=\\\"0\\\" info=\\\"Wrong Answer\\\" time=\\\"1\\\" memory=\\\"3256\\\">\\n<in>91 1450\\n27 80\\n99 26\\n24 41\\n55 33\\n60 59\\n91 34\\n14 74\\n88 51\\n54 20\\n88 57\\n14 65\\n83 93\\n36 59\\n88 44\\n36 8\\n61 ...<\\/in>\\n<out>2990<\\/out>\\n<res>wrong answer 1st words differ - expected: \'4348\', found: \'2990\'\\n<\\/res>\\n<\\/test>\\n<test num=\\\"7\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3264\\\">\\n<in>35 555\\n1 52\\n42 67\\n85 56\\n45 30\\n55 26\\n85 11\\n1 28\\n76 96\\n41 29\\n23 62\\n68 87\\n85 21\\n35 62\\n62 55\\n34 88\\n50 72...<\\/in>\\n<out>1042<\\/out>\\n<res>ok &quot;1042&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"8\\\" score=\\\"0\\\" info=\\\"Wrong Answer\\\" time=\\\"2\\\" memory=\\\"3260\\\">\\n<in>61 1165\\n25 96\\n41 78\\n80 50\\n88 55\\n97 17\\n63 35\\n8 63\\n25 90\\n59 12\\n55 37\\n20 37\\n8 100\\n89 38\\n59 52\\n85 78\\n31 ...<\\/in>\\n<out>2157<\\/out>\\n<res>wrong answer 1st words differ - expected: \'2576\', found: \'2157\'\\n<\\/res>\\n<\\/test>\\n<test num=\\\"9\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3276\\\">\\n<in>87 972\\n25 32\\n66 52\\n28 9\\n69 100\\n24 52\\n41 56\\n98 48\\n27 44\\n2 67\\n70 94\\n73 20\\n7 35\\n97 15\\n68 93\\n28 12\\n71 88...<\\/in>\\n<out>2387<\\/out>\\n<res>ok &quot;2387&quot;\\n<\\/res>\\n<\\/test>\\n<\\/tests>\\n\",\"status\":\"Judged\"}','Judged',NULL,77,8,3416,1,''),(3,1,NULL,'2025-03-05 22:16:18','an0n','{\"file_name\":\"\\/submission\\/1417\\/YlK5xYmrOHHzWbFPMwhn\",\"config\":[[\"answer_language\",\"C++\"],[\"problem_id\",\"1\"]]}','C++',563,'2025-03-05 22:16:20',_binary '{\"score\":77,\"time\":11,\"memory\":3276,\"details\":\"<tests>\\n<test num=\\\"1\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3276\\\">\\n<in>88 527\\n77 6\\n3 77\\n42 57\\n12 88\\n20 99\\n64 30\\n39 82\\n54 39\\n34 92\\n86 39\\n36 36\\n15 98\\n31 35\\n23 77\\n26 88\\n9 22\\n...<\\/in>\\n<out>2101<\\/out>\\n<res>ok &quot;2101&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"2\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3140\\\">\\n<in>53 193\\n4 27\\n40 83\\n63 9\\n71 65\\n66 63\\n62 65\\n48 13\\n39 99\\n64 31\\n83 8\\n60 82\\n90 60\\n6 30\\n50 79\\n98 41\\n30 50\\n5...<\\/in>\\n<out>917<\\/out>\\n<res>ok &quot;917&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"3\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3212\\\">\\n<in>98 319\\n81 32\\n57 69\\n25 67\\n46 68\\n41 52\\n38 73\\n72 60\\n51 26\\n23 67\\n99 52\\n13 51\\n8 82\\n94 47\\n74 8\\n27 62\\n52 26...<\\/in>\\n<out>1295<\\/out>\\n<res>ok &quot;1295&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"4\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3192\\\">\\n<in>66 571\\n24 87\\n31 78\\n86 55\\n79 69\\n61 7\\n19 94\\n61 7\\n46 6\\n43 92\\n88 33\\n24 34\\n58 59\\n18 99\\n77 26\\n60 54\\n64 82\\n...<\\/in>\\n<out>1561<\\/out>\\n<res>ok &quot;1561&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"5\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3172\\\">\\n<in>91 753\\n92 49\\n83 16\\n51 9\\n55 11\\n71 90\\n83 43\\n84 14\\n99 81\\n10 4\\n67 77\\n34 45\\n15 40\\n31 61\\n7 14\\n26 73\\n16 97\\n...<\\/in>\\n<out>1950<\\/out>\\n<res>ok &quot;1950&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"6\\\" score=\\\"0\\\" info=\\\"Wrong Answer\\\" time=\\\"2\\\" memory=\\\"3184\\\">\\n<in>91 1450\\n27 80\\n99 26\\n24 41\\n55 33\\n60 59\\n91 34\\n14 74\\n88 51\\n54 20\\n88 57\\n14 65\\n83 93\\n36 59\\n88 44\\n36 8\\n61 ...<\\/in>\\n<out>43482990<\\/out>\\n<res>wrong answer 1st words differ - expected: \'4348\', found: \'43482990\'\\n<\\/res>\\n<\\/test>\\n<test num=\\\"7\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3212\\\">\\n<in>35 555\\n1 52\\n42 67\\n85 56\\n45 30\\n55 26\\n85 11\\n1 28\\n76 96\\n41 29\\n23 62\\n68 87\\n85 21\\n35 62\\n62 55\\n34 88\\n50 72...<\\/in>\\n<out>1042<\\/out>\\n<res>ok &quot;1042&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"8\\\" score=\\\"0\\\" info=\\\"Wrong Answer\\\" time=\\\"2\\\" memory=\\\"3184\\\">\\n<in>61 1165\\n25 96\\n41 78\\n80 50\\n88 55\\n97 17\\n63 35\\n8 63\\n25 90\\n59 12\\n55 37\\n20 37\\n8 100\\n89 38\\n59 52\\n85 78\\n31 ...<\\/in>\\n<out>25762157<\\/out>\\n<res>wrong answer 1st words differ - expected: \'2576\', found: \'25762157\'\\n<\\/res>\\n<\\/test>\\n<test num=\\\"9\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3184\\\">\\n<in>87 972\\n25 32\\n66 52\\n28 9\\n69 100\\n24 52\\n41 56\\n98 48\\n27 44\\n2 67\\n70 94\\n73 20\\n7 35\\n97 15\\n68 93\\n28 12\\n71 88...<\\/in>\\n<out>2387<\\/out>\\n<res>ok &quot;2387&quot;\\n<\\/res>\\n<\\/test>\\n<\\/tests>\\n\",\"status\":\"Judged\"}','Judged',NULL,77,11,3276,1,''),(4,1,NULL,'2025-03-05 22:16:44','an0n','{\"file_name\":\"\\/submission\\/1838\\/aFXHc9VtcTXdlYZjtaYj\",\"config\":[[\"answer_language\",\"C++\"],[\"problem_id\",\"1\"]]}','C++',568,'2025-03-05 22:16:44',_binary '{\"score\":97,\"time\":10,\"memory\":3264,\"details\":\"<tests>\\n<test num=\\\"1\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3124\\\">\\n<in>88 527\\n77 6\\n3 77\\n42 57\\n12 88\\n20 99\\n64 30\\n39 82\\n54 39\\n34 92\\n86 39\\n36 36\\n15 98\\n31 35\\n23 77\\n26 88\\n9 22\\n...<\\/in>\\n<out>2101<\\/out>\\n<res>ok &quot;2101&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"2\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3204\\\">\\n<in>53 193\\n4 27\\n40 83\\n63 9\\n71 65\\n66 63\\n62 65\\n48 13\\n39 99\\n64 31\\n83 8\\n60 82\\n90 60\\n6 30\\n50 79\\n98 41\\n30 50\\n5...<\\/in>\\n<out>917<\\/out>\\n<res>ok &quot;917&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"3\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3264\\\">\\n<in>98 319\\n81 32\\n57 69\\n25 67\\n46 68\\n41 52\\n38 73\\n72 60\\n51 26\\n23 67\\n99 52\\n13 51\\n8 82\\n94 47\\n74 8\\n27 62\\n52 26...<\\/in>\\n<out>1295<\\/out>\\n<res>ok &quot;1295&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"4\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3196\\\">\\n<in>66 571\\n24 87\\n31 78\\n86 55\\n79 69\\n61 7\\n19 94\\n61 7\\n46 6\\n43 92\\n88 33\\n24 34\\n58 59\\n18 99\\n77 26\\n60 54\\n64 82\\n...<\\/in>\\n<out>1561<\\/out>\\n<res>ok &quot;1561&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"5\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3164\\\">\\n<in>91 753\\n92 49\\n83 16\\n51 9\\n55 11\\n71 90\\n83 43\\n84 14\\n99 81\\n10 4\\n67 77\\n34 45\\n15 40\\n31 61\\n7 14\\n26 73\\n16 97\\n...<\\/in>\\n<out>1950<\\/out>\\n<res>ok &quot;1950&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"6\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3112\\\">\\n<in>91 1450\\n27 80\\n99 26\\n24 41\\n55 33\\n60 59\\n91 34\\n14 74\\n88 51\\n54 20\\n88 57\\n14 65\\n83 93\\n36 59\\n88 44\\n36 8\\n61 ...<\\/in>\\n<out>4348<\\/out>\\n<res>ok &quot;4348&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"7\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3228\\\">\\n<in>35 555\\n1 52\\n42 67\\n85 56\\n45 30\\n55 26\\n85 11\\n1 28\\n76 96\\n41 29\\n23 62\\n68 87\\n85 21\\n35 62\\n62 55\\n34 88\\n50 72...<\\/in>\\n<out>1042<\\/out>\\n<res>ok &quot;1042&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"8\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3148\\\">\\n<in>61 1165\\n25 96\\n41 78\\n80 50\\n88 55\\n97 17\\n63 35\\n8 63\\n25 90\\n59 12\\n55 37\\n20 37\\n8 100\\n89 38\\n59 52\\n85 78\\n31 ...<\\/in>\\n<out>2576<\\/out>\\n<res>ok &quot;2576&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"9\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3256\\\">\\n<in>87 972\\n25 32\\n66 52\\n28 9\\n69 100\\n24 52\\n41 56\\n98 48\\n27 44\\n2 67\\n70 94\\n73 20\\n7 35\\n97 15\\n68 93\\n28 12\\n71 88...<\\/in>\\n<out>2387<\\/out>\\n<res>ok &quot;2387&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"-1\\\" score=\\\"-3\\\" info=\\\"Extra Test Failed : Wrong Answer on 1\\\" time=\\\"2\\\" memory=\\\"3188\\\">\\n<in>99 1444\\n63 20\\n4 60\\n71 73\\n54 45\\n46 73\\n11 16\\n6 39\\n66 71\\n79 96\\n33 86\\n63 17\\n87 13\\n17 57\\n98 2\\n96 37\\n12 72...<\\/in>\\n<out>3146<\\/out>\\n<res>wrong answer 1st words differ - expected: \'4667\', found: \'3146\'\\n<\\/res>\\n<\\/test>\\n<\\/tests>\\n\",\"status\":\"Judged\"}','Judged',NULL,97,10,3264,1,''),(5,1,NULL,'2025-03-05 22:17:26','an0n','{\"file_name\":\"\\/submission\\/1585\\/HODrwXi5DbmblmaYvLCF\",\"config\":[[\"answer_language\",\"C++\"],[\"problem_id\",\"1\"]]}','C++',608,'2025-03-05 22:17:28',_binary '{\"score\":97,\"time\":10,\"memory\":3280,\"details\":\"<tests>\\n<test num=\\\"1\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3280\\\">\\n<in>88 527\\n77 6\\n3 77\\n42 57\\n12 88\\n20 99\\n64 30\\n39 82\\n54 39\\n34 92\\n86 39\\n36 36\\n15 98\\n31 35\\n23 77\\n26 88\\n9 22\\n...<\\/in>\\n<out>2101<\\/out>\\n<res>ok &quot;2101&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"2\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3160\\\">\\n<in>53 193\\n4 27\\n40 83\\n63 9\\n71 65\\n66 63\\n62 65\\n48 13\\n39 99\\n64 31\\n83 8\\n60 82\\n90 60\\n6 30\\n50 79\\n98 41\\n30 50\\n5...<\\/in>\\n<out>917<\\/out>\\n<res>ok &quot;917&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"3\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3048\\\">\\n<in>98 319\\n81 32\\n57 69\\n25 67\\n46 68\\n41 52\\n38 73\\n72 60\\n51 26\\n23 67\\n99 52\\n13 51\\n8 82\\n94 47\\n74 8\\n27 62\\n52 26...<\\/in>\\n<out>1295<\\/out>\\n<res>ok &quot;1295&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"4\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3164\\\">\\n<in>66 571\\n24 87\\n31 78\\n86 55\\n79 69\\n61 7\\n19 94\\n61 7\\n46 6\\n43 92\\n88 33\\n24 34\\n58 59\\n18 99\\n77 26\\n60 54\\n64 82\\n...<\\/in>\\n<out>1561<\\/out>\\n<res>ok &quot;1561&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"5\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3276\\\">\\n<in>91 753\\n92 49\\n83 16\\n51 9\\n55 11\\n71 90\\n83 43\\n84 14\\n99 81\\n10 4\\n67 77\\n34 45\\n15 40\\n31 61\\n7 14\\n26 73\\n16 97\\n...<\\/in>\\n<out>1950<\\/out>\\n<res>ok &quot;1950&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"6\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3124\\\">\\n<in>91 1450\\n27 80\\n99 26\\n24 41\\n55 33\\n60 59\\n91 34\\n14 74\\n88 51\\n54 20\\n88 57\\n14 65\\n83 93\\n36 59\\n88 44\\n36 8\\n61 ...<\\/in>\\n<out>4348<\\/out>\\n<res>ok &quot;4348&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"7\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3280\\\">\\n<in>35 555\\n1 52\\n42 67\\n85 56\\n45 30\\n55 26\\n85 11\\n1 28\\n76 96\\n41 29\\n23 62\\n68 87\\n85 21\\n35 62\\n62 55\\n34 88\\n50 72...<\\/in>\\n<out>1042<\\/out>\\n<res>ok &quot;1042&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"8\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3268\\\">\\n<in>61 1165\\n25 96\\n41 78\\n80 50\\n88 55\\n97 17\\n63 35\\n8 63\\n25 90\\n59 12\\n55 37\\n20 37\\n8 100\\n89 38\\n59 52\\n85 78\\n31 ...<\\/in>\\n<out>2576<\\/out>\\n<res>ok &quot;2576&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"9\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3104\\\">\\n<in>87 972\\n25 32\\n66 52\\n28 9\\n69 100\\n24 52\\n41 56\\n98 48\\n27 44\\n2 67\\n70 94\\n73 20\\n7 35\\n97 15\\n68 93\\n28 12\\n71 88...<\\/in>\\n<out>2387<\\/out>\\n<res>ok &quot;2387&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"-1\\\" score=\\\"-3\\\" info=\\\"Extra Test Failed : Wrong Answer on 1\\\" time=\\\"1\\\" memory=\\\"3272\\\">\\n<in>99 1444\\n63 20\\n4 60\\n71 73\\n54 45\\n46 73\\n11 16\\n6 39\\n66 71\\n79 96\\n33 86\\n63 17\\n87 13\\n17 57\\n98 2\\n96 37\\n12 72...<\\/in>\\n<out>4167<\\/out>\\n<res>wrong answer 1st words differ - expected: \'4667\', found: \'4167\'\\n<\\/res>\\n<\\/test>\\n<\\/tests>\\n\",\"status\":\"Judged\"}','Judged',NULL,97,10,3280,1,''),(6,1,NULL,'2025-03-05 22:17:49','an0n','{\"file_name\":\"\\/submission\\/6206\\/Tp4ZusASHaMzJDC9HVta\",\"config\":[[\"answer_language\",\"C++\"],[\"problem_id\",\"1\"]]}','C++',608,'2025-03-05 22:17:50',_binary '{\"score\":100,\"time\":9,\"memory\":3284,\"details\":\"<tests>\\n<test num=\\\"1\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3284\\\">\\n<in>88 527\\n77 6\\n3 77\\n42 57\\n12 88\\n20 99\\n64 30\\n39 82\\n54 39\\n34 92\\n86 39\\n36 36\\n15 98\\n31 35\\n23 77\\n26 88\\n9 22\\n...<\\/in>\\n<out>2101<\\/out>\\n<res>ok &quot;2101&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"2\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"0\\\" memory=\\\"3268\\\">\\n<in>53 193\\n4 27\\n40 83\\n63 9\\n71 65\\n66 63\\n62 65\\n48 13\\n39 99\\n64 31\\n83 8\\n60 82\\n90 60\\n6 30\\n50 79\\n98 41\\n30 50\\n5...<\\/in>\\n<out>917<\\/out>\\n<res>ok &quot;917&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"3\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3192\\\">\\n<in>98 319\\n81 32\\n57 69\\n25 67\\n46 68\\n41 52\\n38 73\\n72 60\\n51 26\\n23 67\\n99 52\\n13 51\\n8 82\\n94 47\\n74 8\\n27 62\\n52 26...<\\/in>\\n<out>1295<\\/out>\\n<res>ok &quot;1295&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"4\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"2\\\" memory=\\\"3188\\\">\\n<in>66 571\\n24 87\\n31 78\\n86 55\\n79 69\\n61 7\\n19 94\\n61 7\\n46 6\\n43 92\\n88 33\\n24 34\\n58 59\\n18 99\\n77 26\\n60 54\\n64 82\\n...<\\/in>\\n<out>1561<\\/out>\\n<res>ok &quot;1561&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"5\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3156\\\">\\n<in>91 753\\n92 49\\n83 16\\n51 9\\n55 11\\n71 90\\n83 43\\n84 14\\n99 81\\n10 4\\n67 77\\n34 45\\n15 40\\n31 61\\n7 14\\n26 73\\n16 97\\n...<\\/in>\\n<out>1950<\\/out>\\n<res>ok &quot;1950&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"6\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3144\\\">\\n<in>91 1450\\n27 80\\n99 26\\n24 41\\n55 33\\n60 59\\n91 34\\n14 74\\n88 51\\n54 20\\n88 57\\n14 65\\n83 93\\n36 59\\n88 44\\n36 8\\n61 ...<\\/in>\\n<out>4348<\\/out>\\n<res>ok &quot;4348&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"7\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3140\\\">\\n<in>35 555\\n1 52\\n42 67\\n85 56\\n45 30\\n55 26\\n85 11\\n1 28\\n76 96\\n41 29\\n23 62\\n68 87\\n85 21\\n35 62\\n62 55\\n34 88\\n50 72...<\\/in>\\n<out>1042<\\/out>\\n<res>ok &quot;1042&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"8\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3228\\\">\\n<in>61 1165\\n25 96\\n41 78\\n80 50\\n88 55\\n97 17\\n63 35\\n8 63\\n25 90\\n59 12\\n55 37\\n20 37\\n8 100\\n89 38\\n59 52\\n85 78\\n31 ...<\\/in>\\n<out>2576<\\/out>\\n<res>ok &quot;2576&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"9\\\" score=\\\"11\\\" info=\\\"Accepted\\\" time=\\\"1\\\" memory=\\\"3140\\\">\\n<in>87 972\\n25 32\\n66 52\\n28 9\\n69 100\\n24 52\\n41 56\\n98 48\\n27 44\\n2 67\\n70 94\\n73 20\\n7 35\\n97 15\\n68 93\\n28 12\\n71 88...<\\/in>\\n<out>2387<\\/out>\\n<res>ok &quot;2387&quot;\\n<\\/res>\\n<\\/test>\\n<test num=\\\"-1\\\" score=\\\"0\\\" info=\\\"Extra Test Passed\\\" time=\\\"-1\\\" memory=\\\"-1\\\">\\n<in><\\/in>\\n<out><\\/out>\\n<res><\\/res>\\n<\\/test>\\n<\\/tests>\\n\",\"status\":\"Judged\"}','Judged',NULL,100,9,3284,1,'');
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `usergroup` char(1) NOT NULL DEFAULT 'U',
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `svn_password` char(10) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '1500',
  `qq` bigint(20) NOT NULL,
  `sex` char(1) NOT NULL DEFAULT 'U',
  `ac_num` int(11) NOT NULL,
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remote_addr` varchar(50) NOT NULL,
  `http_x_forwarded_for` varchar(50) NOT NULL,
  `remember_token` char(60) NOT NULL,
  `motto` varchar(200) NOT NULL,
  `sid` varchar(12) DEFAULT '000000000000',
  `jid` varchar(6) DEFAULT '000000',
  `class` varchar(100) DEFAULT '000000',
  PRIMARY KEY (`username`),
  KEY `rating` (`rating`,`username`),
  KEY `ac_num` (`ac_num`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES ('S','an0n','1257354171@qq.com','0d83098c4e4f5fca3f55c3057e6f6029','ECPQykOSXR',1500,0,'U',1,'2025-03-04 10:06:27','172.18.0.1','','gvvwxRMF3v2s2MBkQPdchYf4C7QwE4Ebih8PHuBanMkSdX5JfCizByQhxlf0','','202321710004','23Q104','23级数据一区');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_msg`
--

DROP TABLE IF EXISTS `user_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `send_time` datetime NOT NULL,
  `read_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_msg`
--

LOCK TABLES `user_msg` WRITE;
/*!40000 ALTER TABLE `user_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_system_msg`
--

DROP TABLE IF EXISTS `user_system_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_system_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` datetime NOT NULL,
  `read_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_system_msg`
--

LOCK TABLES `user_system_msg` WRITE;
/*!40000 ALTER TABLE `user_system_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_system_msg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-06 16:42:52
