-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: lineblocs
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

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
-- Table structure for table `api_credentials`
--

DROP TABLE IF EXISTS `api_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_credentials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aws_access_key_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `aws_secret_access_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `aws_region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'us-east-1',
  `stripe_pub_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_private_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_test_pub_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_test_private_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_mode` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_host` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_port` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_user` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_tls` tinyint(1) NOT NULL DEFAULT '0',
  `google_service_account_json` varchar(8192) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `storage_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `tts_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `api_user_rpm` int NOT NULL DEFAULT '100',
  `api_carrier_rpm` int NOT NULL DEFAULT '100',
  `setup_complete` tinyint(1) NOT NULL DEFAULT '0',
  `namecheap_api_user` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `namecheap_api_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `namecheap_api_ip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `google_signin_key` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `msft_signin_key` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `apple_signin_key` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `google_signin_developer_key` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_client_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_client_secret` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `msft_signin_client_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `msft_signin_client_secret` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `apple_signin_client_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `apple_signin_client_secret` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_app_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_analytics_script_tag` varchar(2048) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `matomo_script_tag` varchar(2048) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_credentials`
--

LOCK TABLES `api_credentials` WRITE;
/*!40000 ALTER TABLE `api_credentials` DISABLE KEYS */;
INSERT INTO `api_credentials` VALUES (1,'2023-01-03 23:12:26','2023-03-27 21:24:59','','','us-east-1','','','','','live','','','','',0,'','','',100,100,0,'','','','','','','123','','','m-123','','','','','111','test');
/*!40000 ALTER TABLE `api_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_countries`
--

DROP TABLE IF EXISTS `billing_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `iso` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_countries`
--

LOCK TABLES `billing_countries` WRITE;
/*!40000 ALTER TABLE `billing_countries` DISABLE KEYS */;
INSERT INTO `billing_countries` VALUES (1,'2023-05-04 22:35:39','2023-05-04 22:35:39','Canada','CA');
/*!40000 ALTER TABLE `billing_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_regions`
--

DROP TABLE IF EXISTS `billing_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_regions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `billing_country_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `billing_regions_billing_country_id_foreign` (`billing_country_id`),
  CONSTRAINT `billing_regions_billing_country_id_foreign` FOREIGN KEY (`billing_country_id`) REFERENCES `billing_countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_regions`
--

LOCK TABLES `billing_regions` WRITE;
/*!40000 ALTER TABLE `billing_regions` DISABLE KEYS */;
INSERT INTO `billing_regions` VALUES (2,'2023-05-04 22:35:49','2023-05-04 22:35:49','test','T1',1);
/*!40000 ALTER TABLE `billing_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_taxes`
--

DROP TABLE IF EXISTS `billing_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_taxes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `federal` tinyint(1) NOT NULL DEFAULT '0',
  `region_id` int unsigned DEFAULT NULL,
  `country_id` int unsigned DEFAULT NULL,
  `primary_tax` int DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `tax_rate` double(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `billing_taxes_region_id_foreign` (`region_id`),
  KEY `billing_taxes_country_id_foreign` (`country_id`),
  CONSTRAINT `billing_taxes_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `billing_countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `billing_taxes_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `billing_regions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_taxes`
--

LOCK TABLES `billing_taxes` WRITE;
/*!40000 ALTER TABLE `billing_taxes` DISABLE KEYS */;
INSERT INTO `billing_taxes` VALUES (3,'2023-05-04 22:37:16','2023-05-04 22:38:59',0,2,NULL,1,'GST',7.00);
/*!40000 ALTER TABLE `billing_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocked_numbers`
--

DROP TABLE IF EXISTS `blocked_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocked_numbers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blocked_numbers_public_id_unique` (`public_id`),
  KEY `blocked_numbers_user_id_foreign` (`user_id`),
  KEY `blocked_numbers_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `blocked_numbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `blocked_numbers_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked_numbers`
--

LOCK TABLES `blocked_numbers` WRITE;
/*!40000 ALTER TABLE `blocked_numbers` DISABLE KEYS */;
INSERT INTO `blocked_numbers` VALUES (6,'2023-04-27 21:26:43','2023-04-27 21:26:43',53,'+3793030303030','bn-fbb6b7a6-d6a0-4861-af77-af8ca7d3ba5c',49);
/*!40000 ALTER TABLE `blocked_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `byo_carriers`
--

DROP TABLE IF EXISTS `byo_carriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `byo_carriers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `byo_carriers_user_id_foreign` (`user_id`),
  KEY `byo_carriers_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `byo_carriers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `byo_carriers_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `byo_carriers`
--

LOCK TABLES `byo_carriers` WRITE;
/*!40000 ALTER TABLE `byo_carriers` DISABLE KEYS */;
INSERT INTO `byo_carriers` VALUES (1,'2023-03-20 20:50:49','2023-03-20 20:50:49','d-c2a61cdd-5f70-4ccf-a732-68a7b1c7621c',2,2,'Test1','127.0.0.1');
/*!40000 ALTER TABLE `byo_carriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `byo_carriers_ips`
--

DROP TABLE IF EXISTS `byo_carriers_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `byo_carriers_ips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `carrier_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `byo_carriers_ips_carrier_id_foreign` (`carrier_id`),
  CONSTRAINT `byo_carriers_ips_carrier_id_foreign` FOREIGN KEY (`carrier_id`) REFERENCES `byo_carriers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `byo_carriers_ips`
--

LOCK TABLES `byo_carriers_ips` WRITE;
/*!40000 ALTER TABLE `byo_carriers_ips` DISABLE KEYS */;
INSERT INTO `byo_carriers_ips` VALUES (1,'2023-03-20 20:50:49','2023-03-20 20:50:49','127.0.0.1','/32',1);
/*!40000 ALTER TABLE `byo_carriers_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `byo_carriers_routes`
--

DROP TABLE IF EXISTS `byo_carriers_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `byo_carriers_routes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `carrier_id` int unsigned NOT NULL,
  `prefix` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prepend` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `match` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `byo_carriers_routes_carrier_id_foreign` (`carrier_id`),
  CONSTRAINT `byo_carriers_routes_carrier_id_foreign` FOREIGN KEY (`carrier_id`) REFERENCES `byo_carriers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `byo_carriers_routes`
--

LOCK TABLES `byo_carriers_routes` WRITE;
/*!40000 ALTER TABLE `byo_carriers_routes` DISABLE KEYS */;
INSERT INTO `byo_carriers_routes` VALUES (1,'2023-03-20 20:50:49','2023-03-20 20:50:49',1,'','.','.');
/*!40000 ALTER TABLE `byo_carriers_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `byo_did_numbers`
--

DROP TABLE IF EXISTS `byo_did_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `byo_did_numbers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `did_action` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'accept-call',
  PRIMARY KEY (`id`),
  KEY `byo_did_numbers_user_id_foreign` (`user_id`),
  KEY `byo_did_numbers_workspace_id_foreign` (`workspace_id`),
  KEY `byo_did_numbers_flow_id_foreign` (`flow_id`),
  CONSTRAINT `byo_did_numbers_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `byo_did_numbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `byo_did_numbers_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `byo_did_numbers`
--

LOCK TABLES `byo_did_numbers` WRITE;
/*!40000 ALTER TABLE `byo_did_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `byo_did_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rates`
--

DROP TABLE IF EXISTS `call_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_rates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `outbound` decimal(8,8) NOT NULL,
  `inbound` decimal(8,8) NOT NULL,
  `dial_prefix` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `call_rate` decimal(8,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rates`
--

LOCK TABLES `call_rates` WRITE;
/*!40000 ALTER TABLE `call_rates` DISABLE KEYS */;
INSERT INTO `call_rates` VALUES (2,'2023-01-03 23:12:27','2023-01-03 23:12:27','United States & Canada Outbound - Toll Free',0.00000000,0.00000000,'','outbound',0.00850000),(3,'2023-01-03 23:12:27','2023-01-03 23:12:27','United States - Alaska Outbound',0.00000000,0.00000000,'','outbound',0.09000000),(4,'2023-01-03 23:12:27','2023-01-03 23:12:27','United States - Hawaii Outbound',0.00000000,0.00000000,'','outbound',0.13000000),(5,'2023-01-03 23:12:27','2023-01-03 23:12:27','Canada Outbound',0.00000000,0.00000000,'','outbound',0.01300000),(6,'2023-01-03 23:12:28','2023-01-03 23:12:28','Canada - Yukon Territory Outbound',0.00000000,0.00000000,'','outbound',0.14500000),(7,'2023-01-03 23:12:28','2023-01-03 23:12:28','United States Inbound',0.00000000,0.00000000,'','inbound',0.00085000),(8,'2023-01-03 23:12:28','2023-01-03 23:12:28','Canada Inbound',0.00000000,0.00000000,'','inbound',0.00085000);
/*!40000 ALTER TABLE `call_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_rates_dial_prefixes`
--

DROP TABLE IF EXISTS `call_rates_dial_prefixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_rates_dial_prefixes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `call_rate_id` int unsigned NOT NULL,
  `dial_prefix` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `call_rates_dial_prefixes_call_rate_id_foreign` (`call_rate_id`),
  CONSTRAINT `call_rates_dial_prefixes_call_rate_id_foreign` FOREIGN KEY (`call_rate_id`) REFERENCES `call_rates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rates_dial_prefixes`
--

LOCK TABLES `call_rates_dial_prefixes` WRITE;
/*!40000 ALTER TABLE `call_rates_dial_prefixes` DISABLE KEYS */;
INSERT INTO `call_rates_dial_prefixes` VALUES (320,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1800'),(321,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1833'),(322,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1844'),(323,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1855'),(324,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1866'),(325,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1877'),(326,'2023-01-03 23:12:27','2023-01-03 23:12:27',2,'1888'),(327,'2023-01-03 23:12:27','2023-01-03 23:12:27',3,'1907'),(328,'2023-01-03 23:12:27','2023-01-03 23:12:27',4,'1808'),(329,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1368'),(330,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1403'),(331,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1587'),(332,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1780'),(333,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1825'),(334,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1236'),(335,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1250'),(336,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1604'),(337,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1672'),(338,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1778'),(339,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1204'),(340,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1431'),(341,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1428'),(342,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1506'),(343,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1709'),(344,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1879'),(345,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1867'),(346,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1782'),(347,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1902'),(348,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1867'),(349,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1226'),(350,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1249'),(351,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1289'),(352,'2023-01-03 23:12:27','2023-01-03 23:12:27',5,'1343'),(353,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1365'),(354,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1416'),(355,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1437'),(356,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1519'),(357,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1548'),(358,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1613'),(359,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1647'),(360,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1705'),(361,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1807'),(362,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1905'),(363,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1782'),(364,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1902'),(365,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1354'),(366,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1367'),(367,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1418'),(368,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1438'),(369,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1450'),(370,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1514'),(371,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1579'),(372,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1581'),(373,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1819'),(374,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1873'),(375,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1306'),(376,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1474'),(377,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1639'),(378,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1600'),(379,'2023-01-03 23:12:28','2023-01-03 23:12:28',5,'1622'),(380,'2023-01-03 23:12:28','2023-01-03 23:12:28',6,'1867'),(381,'2023-01-03 23:12:28','2023-01-03 23:12:28',7,'1'),(382,'2023-01-03 23:12:28','2023-01-03 23:12:28',8,'1');
/*!40000 ALTER TABLE `call_rates_dial_prefixes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_system_templates`
--

DROP TABLE IF EXISTS `call_system_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_system_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_system_templates`
--

LOCK TABLES `call_system_templates` WRITE;
/*!40000 ALTER TABLE `call_system_templates` DISABLE KEYS */;
INSERT INTO `call_system_templates` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','Basic Call System','Includes 2 extensions, call forwarding and a simple IVR setup','{\"extensions\":[{\"username\":\"1000\",\"caller_id\":\"1000\",\"flow_name\":\"Call Forward\"},{\"username\":\"2000\",\"caller_id\":\"2000\",\"flow_name\":\"Call Forward\"}],\"extension_codes\":[],\"flows\":[]}');
/*!40000 ALTER TABLE `call_system_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_tags`
--

DROP TABLE IF EXISTS `call_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `call_id` int unsigned NOT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `call_tags_call_id_foreign` (`call_id`),
  CONSTRAINT `call_tags_call_id_foreign` FOREIGN KEY (`call_id`) REFERENCES `calls` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_tags`
--

LOCK TABLES `call_tags` WRITE;
/*!40000 ALTER TABLE `call_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `call_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `direction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `notes` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `plan_snapshot` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `channel_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `billed` tinyint(1) NOT NULL DEFAULT '0',
  `provider_id` int unsigned DEFAULT NULL,
  `sip_call_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `sip_status` int DEFAULT NULL,
  `from_extension_id` int unsigned DEFAULT NULL,
  `to_extension_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `calls_api_id_unique` (`api_id`),
  KEY `calls_user_id_foreign` (`user_id`),
  KEY `calls_workspace_id_foreign` (`workspace_id`),
  KEY `calls_provider_id_foreign` (`provider_id`),
  KEY `calls_from_extension_id_foreign` (`from_extension_id`),
  KEY `calls_to_extension_id_foreign` (`to_extension_id`),
  CONSTRAINT `calls_from_extension_id_foreign` FOREIGN KEY (`from_extension_id`) REFERENCES `extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `calls_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `calls_to_extension_id_foreign` FOREIGN KEY (`to_extension_id`) REFERENCES `extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `calls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `calls_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (1,'call-9dac48f8-e446-4f6c-8534-11163a802d17','15878557657','','completed','inbound',3600,'2023-01-03 23:12:26','2023-01-03 23:12:26',2,'2019-07-01 09:00:00','2019-07-01 09:01:00',2,'','','',0,NULL,'',NULL,NULL,NULL),(2,'call-ea297d12-d2af-4e8f-91c8-03bfa2c57148','15878557657','','completed','inbound',3600,'2023-01-03 23:12:26','2023-01-03 23:12:26',2,'2019-07-01 12:00:00','2019-07-01 12:05:00',2,'','','',0,NULL,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_representatives`
--

DROP TABLE IF EXISTS `company_representatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_representatives` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `main_conact` tinyint(1) NOT NULL DEFAULT '0',
  `main_contact` smallint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_representatives`
--

LOCK TABLES `company_representatives` WRITE;
/*!40000 ALTER TABLE `company_representatives` DISABLE KEYS */;
INSERT INTO `company_representatives` VALUES (2,'2023-04-13 00:27:59','2023-04-13 00:42:51','test_new','test_new@example.org',0,0),(3,'2023-04-13 00:28:09','2023-04-13 00:28:09','test_new2','test_new@example.org',0,0),(4,'2023-04-13 00:39:51','2023-04-13 00:42:51','test','test@example.org',0,1);
/*!40000 ALTER TABLE `company_representatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferences`
--

DROP TABLE IF EXISTS `conferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conferences` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conferences_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `conferences_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferences`
--

LOCK TABLES `conferences` WRITE;
/*!40000 ALTER TABLE `conferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `conferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conferences_members`
--

DROP TABLE IF EXISTS `conferences_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conferences_members` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `conference_id` int unsigned NOT NULL,
  `call_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conferences_members_conference_id_foreign` (`conference_id`),
  KEY `conferences_members_call_id_foreign` (`call_id`),
  CONSTRAINT `conferences_members_call_id_foreign` FOREIGN KEY (`call_id`) REFERENCES `calls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conferences_members_conference_id_foreign` FOREIGN KEY (`conference_id`) REFERENCES `conferences` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conferences_members`
--

LOCK TABLES `conferences_members` WRITE;
/*!40000 ALTER TABLE `conferences_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `conferences_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customizations`
--

DROP TABLE IF EXISTS `customizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customizations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `app_logo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `app_icon` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `alt_app_logo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `admin_portal_logo` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `color_scheme` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `layout_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `grid_size` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `primary_font` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `secondary_font` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `site_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `verification_workflow` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'sms',
  `verification_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'stripe',
  `payment_gateway_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `custom_code_containers_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `mail_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'smtp-gateway',
  `dns_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'self-managed',
  `aws_route53_zone_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `facebook_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `facebook_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `instagram_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `intagram_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `twitter_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `twitter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `tiktok_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tiktok_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `linkedin_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `linkedin_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `privacy_policy` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `terms_of_service` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `enable_google_signin` tinyint(1) NOT NULL DEFAULT '0',
  `enable_msft_signin` tinyint(1) NOT NULL DEFAULT '0',
  `enable_apple_signin` tinyint(1) NOT NULL DEFAULT '0',
  `search_include_resources` tinyint(1) NOT NULL,
  `search_include_portal_views` tinyint(1) NOT NULL,
  `search_include_blog_views` tinyint(1) NOT NULL,
  `signup_requires_payment_detail` tinyint(1) NOT NULL DEFAULT '0',
  `portal_analytics_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `site_analytics_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `analytics_sdk` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `billing_num_retries` int NOT NULL DEFAULT '0',
  `billing_retry_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `contact_phone_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customizations`
--

LOCK TABLES `customizations` WRITE;
/*!40000 ALTER TABLE `customizations` DISABLE KEYS */;
INSERT INTO `customizations` VALUES (1,'2023-01-03 23:12:26','2023-04-13 01:01:03','AHpRx3FhL3cyszMeYoE4H4CV2X65VR.png','taofm6BLhiuYC5Nc7Y9SP1uZxER2Or.png','XLGn8TolSzsOLBgM3IMk05gzWK3iRk.png','rSWZIwmS7awYk5bvyRLr7otFoF0Zql.png','standard','normal','','arial','arial','','email','','stripe',0,0,'smtp-gateway','self-managed','','https://www.facebook.com/lineblocs/',0,'',0,'',0,'',0,'',0,'','',1,1,1,1,1,1,1,1,0,'matomo',10,0,'+1 888 980 9750','First Edmonton Place\r\n10665 Jasper Avenue\r\nSuite 1412','sales@lineblocs.com');
/*!40000 ALTER TABLE `customizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `debugger_logs`
--

DROP TABLE IF EXISTS `debugger_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `debugger_logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `from` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `report` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'info',
  PRIMARY KEY (`id`),
  UNIQUE KEY `debugger_logs_api_id_unique` (`api_id`),
  KEY `debugger_logs_workspace_id_foreign` (`workspace_id`),
  KEY `debugger_logs_flow_id_foreign` (`flow_id`),
  CONSTRAINT `debugger_logs_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`),
  CONSTRAINT `debugger_logs_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `debugger_logs`
--

LOCK TABLES `debugger_logs` WRITE;
/*!40000 ALTER TABLE `debugger_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `debugger_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `did_numbers`
--

DROP TABLE IF EXISTS `did_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `did_numbers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `monthly_cost` int NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trial_number` tinyint(1) NOT NULL,
  `api_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `did_action` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'accept-call',
  `features` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `availability` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `setup_cost` int NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  `external_app_did` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `did_numbers_public_id_unique` (`public_id`),
  KEY `did_numbers_user_id_foreign` (`user_id`),
  KEY `did_numbers_workspace_id_foreign` (`workspace_id`),
  KEY `did_numbers_flow_id_foreign` (`flow_id`),
  KEY `did_numbers_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `did_numbers_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `did_numbers_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `did_numbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `did_numbers_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `did_numbers`
--

LOCK TABLES `did_numbers` WRITE;
/*!40000 ALTER TABLE `did_numbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `did_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `did_numbers_tags`
--

DROP TABLE IF EXISTS `did_numbers_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `did_numbers_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number_id` int unsigned NOT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `did_numbers_tags_number_id_foreign` (`number_id`),
  CONSTRAINT `did_numbers_tags_number_id_foreign` FOREIGN KEY (`number_id`) REFERENCES `did_numbers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `did_numbers_tags`
--

LOCK TABLES `did_numbers_tags` WRITE;
/*!40000 ALTER TABLE `did_numbers_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `did_numbers_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dns_records`
--

DROP TABLE IF EXISTS `dns_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dns_records` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `host` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'A',
  `address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `ttl` int NOT NULL DEFAULT '300',
  `value` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `0` (`host`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dns_records`
--

LOCK TABLES `dns_records` WRITE;
/*!40000 ALTER TABLE `dns_records` DISABLE KEYS */;
INSERT INTO `dns_records` VALUES (1,'2023-01-12 01:13:50','2023-01-12 01:13:50','one','A','',60,'test');
/*!40000 ALTER TABLE `dns_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_user_trace`
--

DROP TABLE IF EXISTS `error_user_trace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `error_user_trace` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `full_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `error_user_trace_workspace_id_foreign` (`workspace_id`),
  KEY `error_user_trace_user_id_foreign` (`user_id`),
  CONSTRAINT `error_user_trace_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `error_user_trace_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_user_trace`
--

LOCK TABLES `error_user_trace` WRITE;
/*!40000 ALTER TABLE `error_user_trace` DISABLE KEYS */;
INSERT INTO `error_user_trace` VALUES (1,'2023-01-12 02:22:28','2023-01-12 02:22:28','DNS error occured',NULL,7,'https://lineblocs.com/api/userSpinup');
/*!40000 ALTER TABLE `error_user_trace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extension_codes`
--

DROP TABLE IF EXISTS `extension_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extension_codes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `extension_codes_public_id_unique` (`public_id`),
  KEY `extension_codes_workspace_id_foreign` (`workspace_id`),
  KEY `extension_codes_flow_id_foreign` (`flow_id`),
  KEY `extension_codes_user_id_foreign` (`user_id`),
  CONSTRAINT `extension_codes_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `extension_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `extension_codes_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extension_codes`
--

LOCK TABLES `extension_codes` WRITE;
/*!40000 ALTER TABLE `extension_codes` DISABLE KEYS */;
INSERT INTO `extension_codes` VALUES (1,'2023-02-24 02:24:38','2023-02-24 02:24:38',2,5,'test123','*10','ec-ee3d51c5-e47f-4ae9-9d1d-141aad0dd84c',2);
/*!40000 ALTER TABLE `extension_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extensions`
--

DROP TABLE IF EXISTS `extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extensions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `caller_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `last_registered` datetime DEFAULT NULL,
  `register_expires` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `extensions_public_id_unique` (`public_id`),
  KEY `extensions_user_id_foreign` (`user_id`),
  KEY `extensions_workspace_id_foreign` (`workspace_id`),
  KEY `extensions_flow_id_foreign` (`flow_id`),
  CONSTRAINT `extensions_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `extensions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `extensions_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extensions`
--

LOCK TABLES `extensions` WRITE;
/*!40000 ALTER TABLE `extensions` DISABLE KEYS */;
INSERT INTO `extensions` VALUES (1,'2023-01-12 02:27:41','2023-01-12 02:27:41','4000','@DW/j+@],>)%zWF-T!*bL7KG',9,'4000','ext-fc450f65-48fc-423f-8c6f-1da59ac21abe',9,2,NULL,0),(2,'2023-01-12 02:27:49','2023-01-12 02:27:49','4000','@DW/j+@],>)%zWF-T!*bL7KG',9,'4000','ext-dbe388cc-beb8-4495-a21e-bac5eeb71893',9,4,NULL,0),(3,'2023-01-20 07:15:40','2023-01-20 07:15:40','5000','!sp]>@{H_6SHs*/?,LG&{YE>',2,'5000','ext-ce0763c2-a499-4fec-97cc-085a75c1dc33',2,6,NULL,0),(4,'2023-03-17 22:34:30','2023-03-17 22:34:30','9000','eA(&5T,DDqy>k/9A=8AQT^%G',26,'9000','ext-de9990c2-9f47-41c5-ad3d-7842bb4bb110',22,8,NULL,0),(5,'2023-04-06 08:07:26','2023-04-06 08:07:26','dhudhdssaj@gamil.com','5v]Ev--av!=/bw-Ug!t?zSNU',43,'343243243243432','ext-0b6011e1-da94-455d-80c0-bb2a98e099c0',39,10,NULL,0),(6,'2023-04-06 08:07:39','2023-04-06 08:07:39','dhudhdssaj@gamil.com','5v]Ev--av!=/bw-Ug!t?zSNU',43,'343243243243432','ext-90d2b727-7c7f-494e-93f3-adef161e800e',39,12,NULL,0),(7,'2023-04-14 12:47:26','2023-04-14 12:47:26','dhudhdssaj12@gamil.com','xgV+B=gWB//AF$Q>,eg]^$4L',47,'343243243243432','ext-b6d32e1a-2a13-4869-91e4-1eed4cbb3960',43,14,NULL,0),(8,'2023-04-14 12:47:35','2023-04-14 12:47:35','dhudhdssaj12@gamil.com','z[mfZeBUjckZ)qG7b}+$+VXE',47,'343243243243432','ext-c3a24419-2794-4973-8407-3eeef9c63c80',43,16,NULL,0),(9,'2023-04-19 09:40:09','2023-04-19 09:40:09','dhudhdssaj123@gamil.com','@/PS.E@_GnT2UY_CQ]E7>4__',48,'343243243243432','ext-7531bcc1-9cfb-40dc-828f-7bd0b3011b09',44,18,NULL,0),(10,'2023-04-19 09:41:08','2023-04-19 09:41:08','dhudhdssaj123@gamil.com','d4Dg%7unS]^*Zn*xA@x,uCcA',48,'343243243243432','ext-a9073ae1-73fd-401f-8a67-5d5fe9955b2e',44,20,NULL,0),(11,'2023-04-19 09:41:17','2023-04-19 09:41:17','dhudhdssaj123@gamil.com','gETLVjMWtw]jejuNvGkaFh?S',48,'343243243243432','ext-d69eca86-d777-4373-8c76-c9107b287556',44,22,NULL,0),(13,'2023-05-01 21:39:58','2023-05-01 21:39:58','5000','rT/WJVP.D6Pp->3_VzfZ_eWY',60,'5000','ext-d0f64290-9674-4388-a3c8-59a4221f243f',56,24,NULL,0),(14,'2023-05-03 02:38:28','2023-05-03 02:38:28','erdhudhdtyiorsaj1d23@gamil.com','(etTt<D/h5RQa=%fSGW[J8J&',58,'343243243243432','ext-6dfde373-8ba9-42c3-8e96-692d024f19f4',54,30,NULL,0);
/*!40000 ALTER TABLE `extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extensions_tags`
--

DROP TABLE IF EXISTS `extensions_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extensions_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `extension_id` int unsigned NOT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `extensions_tags_extension_id_foreign` (`extension_id`),
  CONSTRAINT `extensions_tags_extension_id_foreign` FOREIGN KEY (`extension_id`) REFERENCES `extensions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extensions_tags`
--

LOCK TABLES `extensions_tags` WRITE;
/*!40000 ALTER TABLE `extensions_tags` DISABLE KEYS */;
INSERT INTO `extensions_tags` VALUES (1,'2023-03-17 22:34:30','2023-03-17 22:34:30',4,'one'),(2,'2023-03-17 22:34:30','2023-03-17 22:34:30',4,'test'),(3,'2023-03-17 22:34:30','2023-03-17 22:34:30',4,'example');
/*!40000 ALTER TABLE `extensions_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `question` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (9,'2023-03-27 22:44:03','2023-03-27 22:44:03','What does it cost to create a Lineblocs account?','Creating an account is free. However when you create a Lineblocs account you are only given a 10 day evaluation period – regardless of membership type – which covers basic calling, setting up extensions, and using the user portal.'),(10,'2023-03-27 22:46:43','2023-03-27 22:46:43','Which countries do you offer services for?','At this time Lineblocs only offers services to valid residents based in North America.'),(11,'2023-03-27 22:46:43','2023-03-27 22:46:43','Is Lineblocs a CPaaS?','No Lineblocs is not not a CPaaS. However we do provide calling, fax, and IM related services'),(12,'2023-03-27 22:46:43','2023-03-27 22:46:43','Can I port my phone number to Lineblocs?','Yes, you are able to port numbers to Lineblocs. You can learn more about porting numbers in the Porting Numbers guide.'),(13,'2023-03-27 22:46:43','2023-03-27 22:46:43','Does Lineblocs offer an API like Twilio?','No, we currently do not offer a CPaaS type of API.'),(14,'2023-03-27 22:46:43','2023-03-27 22:46:43','Does Lineblocs offer toll free numbers?','Yes you can currently purchase toll free numbers in the Lineblocs dashboard.'),(15,'2023-03-27 22:46:43','2023-03-27 22:46:43','Does Lineblocs offer SMS services?','No we do not currently have any SMS service. Lineblocs currently only supports voice, fax, and IM.');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faxes`
--

DROP TABLE IF EXISTS `faxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faxes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `size` int NOT NULL DEFAULT '0',
  `call_id` int unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_snapshot` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faxes_api_id_unique` (`api_id`),
  KEY `faxes_user_id_foreign` (`user_id`),
  KEY `faxes_workspace_id_foreign` (`workspace_id`),
  KEY `faxes_call_id_foreign` (`call_id`),
  CONSTRAINT `faxes_call_id_foreign` FOREIGN KEY (`call_id`) REFERENCES `calls` (`id`),
  CONSTRAINT `faxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `faxes_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faxes`
--

LOCK TABLES `faxes` WRITE;
/*!40000 ALTER TABLE `faxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `faxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `files_api_id_unique` (`api_id`),
  KEY `files_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `files_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flow_templates_presets`
--

DROP TABLE IF EXISTS `flow_templates_presets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flow_templates_presets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `template_id` int unsigned NOT NULL,
  `var_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `screen_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `variable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `extras` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `lookup_table` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lookup_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `depends_on_field` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `depends_on_value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `default` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `placeholder` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `widget` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `widget_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flow_templates_presets_template_id_foreign` (`template_id`),
  CONSTRAINT `flow_templates_presets_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `flows_templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flow_templates_presets`
--

LOCK TABLES `flow_templates_presets` WRITE;
/*!40000 ALTER TABLE `flow_templates_presets` DISABLE KEYS */;
/*!40000 ALTER TABLE `flow_templates_presets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flows`
--

DROP TABLE IF EXISTS `flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned NOT NULL,
  `started` tinyint(1) NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flows_public_id_unique` (`public_id`),
  KEY `flows_user_id_foreign` (`user_id`),
  KEY `flows_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `flows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `flows_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flows`
--

LOCK TABLES `flows` WRITE;
/*!40000 ALTER TABLE `flows` DISABLE KEYS */;
INSERT INTO `flows` VALUES (1,'Flow for ext 4000','',NULL,'2023-01-12 02:27:41','2023-01-12 02:27:41',9,0,'f-b08e13c3-7e47-4a51-a074-90004d9b3b84',9,'extension'),(2,'Flow for ext 4000','',NULL,'2023-01-12 02:27:41','2023-01-12 02:27:41',9,0,'f-e46ce247-e072-44be-a59a-fa64bfb39633',9,'extension'),(3,'Flow for ext 4000','',NULL,'2023-01-12 02:27:49','2023-01-12 02:27:49',9,0,'f-9915a66d-c5d0-490f-aad6-73e0763465c0',9,'extension'),(4,'Flow for ext 4000','',NULL,'2023-01-12 02:27:49','2023-01-12 02:27:49',9,0,'f-20fcabf8-07da-4325-9811-afd14f5263e7',9,'extension'),(5,'Flow for ext 5000','',NULL,'2023-01-20 07:15:40','2023-01-20 07:15:40',2,0,'f-18ccd417-5c22-4903-bd71-6dd2219b68d1',2,'extension'),(6,'Flow for ext 5000','',NULL,'2023-01-20 07:15:40','2023-01-20 07:15:40',2,0,'f-f8393dab-75ab-4ce9-bbda-bae616326291',2,'extension'),(7,'Flow for ext 9000','',NULL,'2023-03-17 22:34:30','2023-03-17 22:34:30',26,0,'f-ba860b82-1da1-4558-9b2b-a03929ffb7f7',22,'extension'),(8,'Flow for ext 9000','',NULL,'2023-03-17 22:34:30','2023-03-17 22:34:30',26,0,'f-f2e7e76c-372e-441e-a81a-f1ea44d4c739',22,'extension'),(9,'Flow for ext dhudhdssaj@gamil.com','',NULL,'2023-04-06 08:07:26','2023-04-06 08:07:26',43,0,'f-300c7f79-4d40-42fa-96a2-35b4bd611a2b',39,'extension'),(10,'Flow for ext dhudhdssaj@gamil.com','',NULL,'2023-04-06 08:07:26','2023-04-06 08:07:26',43,0,'f-8495d28e-4a64-4b36-bfa0-9aaecbae7fa5',39,'extension'),(11,'Flow for ext dhudhdssaj@gamil.com','',NULL,'2023-04-06 08:07:39','2023-04-06 08:07:39',43,0,'f-a83ebb86-1ba0-442e-b3da-a0d20bde43e4',39,'extension'),(12,'Flow for ext dhudhdssaj@gamil.com','',NULL,'2023-04-06 08:07:39','2023-04-06 08:07:39',43,0,'f-6e3be87c-c3a2-4def-8374-86012baecbfe',39,'extension'),(13,'Flow for ext dhudhdssaj12@gamil.com','',NULL,'2023-04-14 12:47:26','2023-04-14 12:47:26',47,0,'f-94059974-6ac7-4174-b1f4-cc12dddadc04',43,'extension'),(14,'Flow for ext dhudhdssaj12@gamil.com','',NULL,'2023-04-14 12:47:26','2023-04-14 12:47:26',47,0,'f-5e552fbb-288d-4bc4-966b-097a62d51e87',43,'extension'),(15,'Flow for ext dhudhdssaj12@gamil.com','',NULL,'2023-04-14 12:47:35','2023-04-14 12:47:35',47,0,'f-bdeccec2-4529-4e80-8de8-fd787c6e4b7e',43,'extension'),(16,'Flow for ext dhudhdssaj12@gamil.com','',NULL,'2023-04-14 12:47:35','2023-04-14 12:47:35',47,0,'f-837d7445-83ac-426f-89fb-b4adbd0baabf',43,'extension'),(17,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:40:09','2023-04-19 09:40:09',48,0,'f-2612f870-83c3-4789-b7e8-2c10bf49d74f',44,'extension'),(18,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:40:09','2023-04-19 09:40:09',48,0,'f-275eb48d-2160-4c83-aa8c-d6d031a585ca',44,'extension'),(19,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:41:08','2023-04-19 09:41:08',48,0,'f-4b9f6453-c4a8-40a4-9e0a-07f37aa40d92',44,'extension'),(20,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:41:08','2023-04-19 09:41:08',48,0,'f-c01065d5-cd2e-4f7c-aa99-423a17945fba',44,'extension'),(21,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:41:17','2023-04-19 09:41:17',48,0,'f-c07ddd4d-215e-47d4-80bf-2c9da2dc2b9d',44,'extension'),(22,'Flow for ext dhudhdssaj123@gamil.com','',NULL,'2023-04-19 09:41:17','2023-04-19 09:41:17',48,0,'f-0808c4ff-728d-4f6a-91fe-8840e8a7b41f',44,'extension'),(23,'test123','','{\"graph\":{\"cells\":[{\"type\":\"devs.FlowLink\",\"source\":{\"id\":\"823bf81d-2290-474b-b473-44b33664688b\",\"port\":\"No Input\"},\"target\":{\"id\":\"5e723a4f-f39c-4467-90c3-16ac92f6aca6\",\"port\":\"In\"},\"id\":\"65d0ede3-2a54-41c3-9a42-ded5b36c1c96\",\"z\":-1,\"vertices\":[{\"x\":768.2412414550781,\"y\":416.5883331298828}],\"attrs\":{}},{\"type\":\"devs.FlowLink\",\"source\":{\"id\":\"9fae4e6a-7792-41a0-b93a-e0109fefd361\",\"port\":\"Incoming Call\"},\"target\":{\"id\":\"823bf81d-2290-474b-b473-44b33664688b\",\"port\":\"In\"},\"id\":\"e7cf559b-b042-4603-bce2-fb912606ba37\",\"z\":0,\"vertices\":[{\"x\":606.2,\"y\":241.59999084472656}],\"attrs\":{}},{\"name\":\"Launch\",\"type\":\"devs.LaunchModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[],\"outPorts\":[\"Incoming Call\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"Incoming Call\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Incoming Call\"}}}]},\"position\":{\"x\":422.4,\"y\":94},\"angle\":0,\"id\":\"9fae4e6a-7792-41a0-b93a-e0109fefd361\",\"z\":1,\"attrs\":{\".label\":{\"ref-y\":20,\"font-size\":\"18\",\"fill\":\"#385374\"}}},{\"name\":\"Process Input\",\"type\":\"devs.ProcessInputModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[\"In\"],\"outPorts\":[\"Digits Received\",\"Speech Received\",\"No Input\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Digits Received\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Digits Received\"}}},{\"id\":\"Speech Received\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Speech Received\"}}},{\"id\":\"No Input\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"No Input\"}}}]},\"position\":{\"x\":470,\"y\":289.1999816894531},\"angle\":0,\"id\":\"823bf81d-2290-474b-b473-44b33664688b\",\"z\":2,\"attrs\":{\".label\":{\"text\":\"Process Input\",\"fill\":\"#385374\",\"font-size\":\"18\"}}},{\"name\":\"Process Input\",\"type\":\"devs.ProcessInputModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[\"In\"],\"outPorts\":[\"Digits Received\",\"Speech Received\",\"No Input\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Digits Received\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Digits Received\"}}},{\"id\":\"Speech Received\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Speech Received\"}}},{\"id\":\"No Input\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"No Input\"}}}]},\"position\":{\"x\":746.4824829101562,\"y\":443.9766845703125},\"angle\":0,\"id\":\"5e723a4f-f39c-4467-90c3-16ac92f6aca6\",\"z\":3,\"attrs\":{\".label\":{\"text\":\"Process Input (1)\",\"fill\":\"#385374\",\"font-size\":\"18\"},\".description\":{\"text\":\"Use text to speech to process input\",\"fill\":\"#385374\"}}}]},\"models\":[{\"id\":\"9fae4e6a-7792-41a0-b93a-e0109fefd361\",\"name\":\"Launch\",\"data\":{},\"links\":[]},{\"id\":\"823bf81d-2290-474b-b473-44b33664688b\",\"name\":\"Process Input\",\"data\":{},\"links\":[]},{\"id\":\"5e723a4f-f39c-4467-90c3-16ac92f6aca6\",\"name\":\"Process Input (1)\",\"data\":{\"playback_type\":\"Say\",\"text_to_say\":\"Test 123\",\"text_language\":\"en-AU\",\"text_gender\":\"MALE\"},\"links\":[]}]}','2023-05-01 21:26:26','2023-05-02 02:39:06',60,1,'f-2169b668-8a12-474c-a4a1-1da2bb44577a',56,'extension'),(24,'Test','',NULL,'2023-05-01 21:33:58','2023-05-01 21:33:58',60,1,'f-bedf6be4-a465-4641-aa60-6c4e68b610a4',56,'extension'),(25,'test 123','','{\"graph\":{\"cells\":[{\"type\":\"devs.FlowLink\",\"source\":{\"id\":\"530e21af-e340-49df-bb90-2e50dbeff409\",\"port\":\"Incoming Call\"},\"target\":{\"id\":\"cc647fcb-7614-4ba8-9f00-8655f881f05c\",\"port\":\"In\"},\"id\":\"c47ee5a8-5561-4238-97bd-08e77f8cee9c\",\"z\":0,\"vertices\":[{\"x\":715,\"y\":230}],\"attrs\":{}},{\"name\":\"Launch\",\"type\":\"devs.LaunchModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[],\"outPorts\":[\"Incoming Call\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"Incoming Call\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Incoming Call\"}}}]},\"position\":{\"x\":330,\"y\":75},\"angle\":0,\"id\":\"530e21af-e340-49df-bb90-2e50dbeff409\",\"z\":1,\"attrs\":{\".label\":{\"ref-y\":20,\"font-size\":\"18\",\"fill\":\"#385374\"}}},{\"name\":\"Bridge\",\"type\":\"devs.BridgeModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[\"In\"],\"outPorts\":[\"Connected Call Ended\",\"Caller Hung Uo\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Connected Call Ended\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Connected Call Ended\"}}},{\"id\":\"Caller Hung Uo\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Caller Hung Uo\"}}}]},\"position\":{\"x\":420,\"y\":345},\"angle\":0,\"id\":\"5edc9eba-293a-4688-aa05-382fe6001c73\",\"z\":2,\"attrs\":{\".label\":{\"fill\":\"#385374\",\"font-size\":\"18\"}}},{\"name\":\"Bridge\",\"type\":\"devs.BridgeModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[\"In\"],\"outPorts\":[\"Connected Call Ended\",\"Caller Hung Uo\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Connected Call Ended\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Connected Call Ended\"}}},{\"id\":\"Caller Hung Uo\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Caller Hung Uo\"}}}]},\"position\":{\"x\":780,\"y\":285},\"angle\":0,\"id\":\"cc647fcb-7614-4ba8-9f00-8655f881f05c\",\"customType\":\"supportqPicker\",\"z\":3,\"attrs\":{\".label\":{\"text\":\"supportq\",\"fill\":\"#385374\",\"font-size\":\"18\"}}}]},\"models\":[{\"id\":\"530e21af-e340-49df-bb90-2e50dbeff409\",\"name\":\"Launch\",\"data\":{},\"links\":[]},{\"id\":\"5edc9eba-293a-4688-aa05-382fe6001c73\",\"name\":\"Bridge\",\"data\":{},\"links\":[]},{\"id\":\"cc647fcb-7614-4ba8-9f00-8655f881f05c\",\"name\":\"supportq\",\"data\":[],\"links\":[]}]}','2023-05-01 21:35:18','2023-05-01 21:35:59',60,1,'f-9c191f85-427d-4e81-b415-87f220e7c20d',56,'extension'),(26,'test','',NULL,'2023-05-01 21:37:43','2023-05-01 21:37:43',60,1,'f-ffdf4874-6220-4c54-bc9d-bfbdba895b02',56,'extension'),(27,'Flow for ext 5000','','{\"graph\":{\"cells\":[{\"type\":\"devs.FlowLink\",\"source\":{\"id\":\"54e806c2-8baf-4ea4-a156-76909d856f27\",\"port\":\"Incoming Call\"},\"target\":{\"id\":\"062b8712-fd26-4a60-9f4e-86114d57bf22\",\"port\":\"In\"},\"id\":\"9b207d4e-3e68-4899-ad9e-e612204c12bc\",\"z\":0,\"vertices\":[{\"x\":596.2,\"y\":314.5}],\"attrs\":{}},{\"name\":\"Launch\",\"type\":\"devs.LaunchModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[],\"outPorts\":[\"Incoming Call\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"Incoming Call\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Incoming Call\"}}}]},\"position\":{\"x\":422.4,\"y\":94},\"angle\":0,\"id\":\"54e806c2-8baf-4ea4-a156-76909d856f27\",\"z\":1,\"attrs\":{\".label\":{\"ref-y\":20,\"font-size\":\"18\",\"fill\":\"#385374\"}}},{\"name\":\"Bridge\",\"type\":\"devs.BridgeModel\",\"size\":{\"width\":320,\"height\":100},\"inPorts\":[\"In\"],\"outPorts\":[\"Connected Call Ended\",\"Caller Hung Uo\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Connected Call Ended\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Connected Call Ended\"}}},{\"id\":\"Caller Hung Uo\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Caller Hung Uo\"}}}]},\"position\":{\"x\":450,\"y\":435},\"angle\":0,\"id\":\"062b8712-fd26-4a60-9f4e-86114d57bf22\",\"z\":2,\"attrs\":{\".label\":{\"fill\":\"#385374\",\"font-size\":\"18\"}}}]},\"models\":[{\"id\":\"54e806c2-8baf-4ea4-a156-76909d856f27\",\"name\":\"Launch\",\"data\":{},\"links\":[]},{\"id\":\"062b8712-fd26-4a60-9f4e-86114d57bf22\",\"name\":\"Bridge\",\"data\":{\"call_type\":\"ExtensionFlow\",\"extension\":\"None\",\"do_record\":true},\"links\":[]}]}','2023-05-01 21:39:48','2023-05-01 21:41:48',60,1,'f-8364bbca-a4fb-4e79-a52a-ca504c40f6e3',56,'extension'),(29,'Flow for ext erdhudhdtyiorsaj1d23@gamil.com','',NULL,'2023-05-03 02:38:28','2023-05-03 02:38:28',58,0,'f-9c213c06-b974-435f-b94e-925e558ec5b2',54,'extension'),(30,'Flow for ext erdhudhdtyiorsaj1d23@gamil.com','',NULL,'2023-05-03 02:38:28','2023-05-03 02:38:28',58,0,'f-b37bfad5-0130-4630-be2f-15d2911f9f50',54,'extension'),(31,'test','',NULL,'2023-05-03 17:11:02','2023-05-03 17:11:02',63,1,'f-21d187a2-6fca-4a29-a200-423bbe602a3e',59,'extension');
/*!40000 ALTER TABLE `flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flows_templates`
--

DROP TABLE IF EXISTS `flows_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flows_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext COLLATE utf8mb3_unicode_ci,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `extra_data` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flows_templates`
--

LOCK TABLES `flows_templates` WRITE;
/*!40000 ALTER TABLE `flows_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `flows_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_whitelist`
--

DROP TABLE IF EXISTS `ip_whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ip_whitelist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_whitelist_public_id_unique` (`public_id`),
  KEY `ip_whitelist_user_id_foreign` (`user_id`),
  KEY `ip_whitelist_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `ip_whitelist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ip_whitelist_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_whitelist`
--

LOCK TABLES `ip_whitelist` WRITE;
/*!40000 ALTER TABLE `ip_whitelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `ip_whitelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macro_functions`
--

DROP TABLE IF EXISTS `macro_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `macro_functions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `compiled_code` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `macro_functions_public_id_unique` (`public_id`),
  KEY `macro_functions_workspace_id_foreign` (`workspace_id`),
  KEY `macro_functions_user_id_foreign` (`user_id`),
  CONSTRAINT `macro_functions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `macro_functions_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_functions`
--

LOCK TABLES `macro_functions` WRITE;
/*!40000 ALTER TABLE `macro_functions` DISABLE KEYS */;
/*!40000 ALTER TABLE `macro_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macro_templates`
--

DROP TABLE IF EXISTS `macro_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `macro_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `changeable_params` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `macro_templates_public_id_unique` (`public_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_templates`
--

LOCK TABLES `macro_templates` WRITE;
/*!40000 ALTER TABLE `macro_templates` DISABLE KEYS */;
INSERT INTO `macro_templates` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','','Business Hours Check','mt-f7d943a5-cdc7-4482-8383-3d27d802ac93','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','','Send Voicemail To Email','mt-bc83d861-5c83-4a1b-aec5-fff62da270e6','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(3,'2023-01-03 23:12:26','2023-01-03 23:12:26','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-986d7724-efab-4d50-88f9-c0d26317aac2','');
/*!40000 ALTER TABLE `macro_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_servers`
--

DROP TABLE IF EXISTS `media_servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_servers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address_range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address_range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `webrtc_optimized` tinyint(1) NOT NULL DEFAULT '0',
  `live_call_count` int NOT NULL DEFAULT '0',
  `live_cpu_pct_used` double(8,2) NOT NULL DEFAULT '0.00',
  `live_status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `k8s_pod_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_servers`
--

LOCK TABLES `media_servers` WRITE;
/*!40000 ALTER TABLE `media_servers` DISABLE KEYS */;
INSERT INTO `media_servers` VALUES (2,'2023-02-20 19:48:15','2023-02-20 19:48:15','127.0.0.1','127.0.0.1','/8','127.0.0.1','/8',1,0,0.00,'','',''),(3,'2023-02-20 19:51:01','2023-02-20 19:51:01','test','127.0.0.1','/8','127.0.0.1','/8',0,0,0.00,'','','');
/*!40000 ALTER TABLE `media_servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `microservice_api_keys`
--

DROP TABLE IF EXISTS `microservice_api_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `microservice_api_keys` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `rotated_at` datetime DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `microservice_api_keys`
--

LOCK TABLES `microservice_api_keys` WRITE;
/*!40000 ALTER TABLE `microservice_api_keys` DISABLE KEYS */;
INSERT INTO `microservice_api_keys` VALUES (1,'2023-01-18 22:47:12','2023-01-18 22:47:12','','$2y$10$eaC0zFKVj7g61pFj1WsDZOouMrGgF5/0mXwHxBUNiLuXnKIRfzxBy',NULL,'proxy'),(2,'2023-01-18 22:51:12','2023-01-18 22:51:12','','$2y$10$iQd2d6ZWdkIdm7erwipLf.DxxRtBROMXjc7nNoAAmdYsbrr9NQOK6',NULL,'media_server');
/*!40000 ALTER TABLE `microservice_api_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2019_07_26_190119_create_did_numbers_table',1),('2019_07_26_190123_create_flows_table',1),('2019_07_26_190909_add_flow_to_did_numbers',1),('2019_07_29_165444_change_flows_json_to_nullable',1),('2019_07_29_212722_create_calls_table',1),('2019_07_29_212744_create_recordings_table',1),('2019_08_06_151105_create_extensions_table',1),('2019_08_08_193636_add_call_id_to_recordings',1),('2019_08_08_195213_add_precise_datetime_fields_to_calls',1),('2019_08_08_222630_add_recording_tag_field',1),('2019_08_10_222023_add_name_fields_to_users',1),('2019_08_11_030346_add_provider_id_to_numbers',1),('2019_08_19_235424_create_user_credits',1),('2019_08_19_235435_create_user_debits',1),('2019_08_19_235838_create_user_cards',1),('2019_08_19_235905_add_stripe_customer_id',1),('2019_08_20_005942_add_balance_to_credits',1),('2019_08_20_005957_add_balance_to_debits',1),('2019_08_20_012943_add_user_id_to_cards',1),('2019_08_20_034057_add_card_id_to_credits',1),('2019_08_21_012206_add_status_to_credits',1),('2019_08_21_012217_add_status_to_debits',1),('2019_08_21_013700_create_user_invoices',1),('2019_08_23_021540_add_container_name',1),('2019_08_23_022450_add_sip_and_rtp_info_to_user',1),('2019_08_23_221925_create_flows_templates',1),('2019_08_25_030157_add_started_to_flows',1),('2019_09_01_234154_add_trial_field_to_phone_numbers',1),('2019_09_01_234217_add_trial_mode_users',1),('2019_09_04_034909_add_plan_to_users',1),('2019_09_04_040224_add_caller_id_to_extensions',1),('2019_09_05_014921_add_auto_charge_to_users',1),('2019_09_10_000017_add_call_verification_Code',1),('2019_09_10_000219_add_mobile_number',1),('2019_09_10_020803_change_card_id_to_null',1),('2019_09_11_212227_add_api_number_to_dids',1),('2019_09_22_211335_add_reserved_fields_to_user',1),('2019_09_22_222624_make_reserved_ip_nullable',1),('2019_09_23_174133_add_reserved_private_ip',1),('2019_09_23_174818_add_ip_private',1),('2019_10_17_020822_add_region_to_user',1),('2019_10_17_021327_change_region',1),('2019_11_02_225244_add_module_id_to_debits',1),('2019_11_05_035642_add_name_to_rec',1),('2019_11_22_022833_flows_add_pub_id',1),('2019_11_22_022849_did_numbers_add_pub_id',1),('2019_11_22_022902_extensions_add_pub_id',1),('2019_11_26_044330_add_duration_to_recordings',1),('2019_11_27_042803_add_invoices_by_email',1),('2019_11_27_044950_add_billing_package',1),('2019_11_28_012255_add_verified_callerids',1),('2019_11_28_012315_blocked_numbers',1),('2019_11_28_022032_add_code_to_verified',1),('2019_11_28_022555_add_public_id',1),('2019_11_28_022613_add_public_id_to_blocked_numbers',1),('2019_11_28_023459_add_confirmed_to_verified',1),('2019_11_29_023727_add_last_login_users',1),('2019_11_29_025428_add_user_devices_table',1),('2019_11_29_030648_add_last_login_to_devices',1),('2019_11_29_034138_add_email_verified_fields',1),('2019_11_29_041451_create_usage_triggers',1),('2019_11_29_042901_create_usage_trigger_results',1),('2019_11_29_044609_add_last_login_reminded',1),('2019_11_29_050110_add_credit_id_to_usage_triggers',1),('2019_12_01_234439_add_size_to_recordings',1),('2019_12_02_013217_add_whitelist_setting_to_self',1),('2019_12_02_013259_add_ip_whitelist',1),('2019_12_08_171656_create_workspaces_table',1),('2019_12_08_171751_create_workspaces_users_table',1),('2019_12_08_201942_add_workspace_fields',1),('2019_12_08_202304_add_workspace_fields_2',1),('2019_12_08_203425_add_workspace_id_to_blocked_numbers',1),('2019_12_08_203425_add_workspace_id_to_calls',1),('2019_12_08_203425_add_workspace_id_to_dids',1),('2019_12_08_203425_add_workspace_id_to_extensions',1),('2019_12_08_203425_add_workspace_id_to_flows',1),('2019_12_08_203425_add_workspace_id_to_ip_whitelist',1),('2019_12_08_203425_add_workspace_id_to_recordings',1),('2019_12_08_203425_add_workspace_id_to_verified_caller_ids',1),('2019_12_08_211721_add_public_id_to_workspace_users',1),('2019_12_10_003037_add_personal_fields',1),('2019_12_10_003552_add_linked_paypal',1),('2020_01_06_175437_make_macro_functions',1),('2020_01_06_223411_add_workspace_perms',1),('2020_01_06_224515_create_macro_templates',1),('2020_01_06_233145_add_public_id_to_macro_templates',1),('2020_01_07_020818_add_compiled_code_to_macros',1),('2020_01_08_204250_create_workspace_params',1),('2020_01_08_222415_add_manage_params_perm',1),('2020_01_12_191325_add_flow_id_to_extensions',1),('2020_01_13_001016_create_extension_codes_new',1),('2020_01_13_013305_manage_extension_codes_priv',1),('2020_01_13_183249_add_category_to_flow_templates',1),('2020_01_14_210429_create_call_system_templates',1),('2020_01_16_012121_create_debugger_table',1),('2020_01_16_013126_add_api_id_to_logs',1),('2020_01_16_030929_create_recording_tags',1),('2020_01_16_032459_add_tag_to_recording_tags',1),('2020_01_16_181813_create_port_numbers',1),('2020_01_16_182010_create_port_numbers_documents',1),('2020_01_16_185250_add_manage_ports',1),('2020_01_16_212014_add_fields_to_ports',1),('2020_01_16_214752_add_estimated_completion_date_to_ports',1),('2020_01_16_224331_add_type_to_port_docs',1),('2020_01_21_041158_add_api_fields',1),('2020_01_22_023942_add_extra_data_to_flow_templates',1),('2020_01_22_035726_add_user_id_to_ext_codes',1),('2020_01_28_040920_change_foreign_for_dids',1),('2020_01_28_040930_change_foreign_for_extensions',1),('2020_01_28_042638_add_level_to_debugger',1),('2020_02_04_233222_create_widget_templates',1),('2020_02_04_233438_create_widget_templates_tags',1),('2020_02_12_021051_add_free_started',1),('2020_02_18_053321_add_did_action',1),('2020_02_19_020015_create_fax_table',1),('2020_02_19_031239_add_sz_to_faxes',1),('2020_02_19_031556_add_call_id_to_faxes',1),('2020_02_19_031914_add_name_to_faxes',1),('2020_02_19_051706_free_trial_reminder',1),('2020_02_20_051924_add_features_to_dids',1),('2020_02_25_042156_add_did_number_tags',1),('2020_02_25_233808_create_files_table',1),('2020_02_27_015551_add_changable_params_to_macro_templates',1),('2020_03_01_030103_add_eta_to_ports',1),('2020_03_01_030427_info_needed_to_ports',1),('2020_03_01_064209_sip_providers',1),('2020_03_01_070530_add_active_to_providers',1),('2020_03_01_073539_create_call_rates',1),('2020_03_04_023551_create_sip_countries',1),('2020_03_04_023608_create_sip_regions',1),('2020_03_04_023621_create_sip_rate_centers',1),('2020_03_04_032810_add_active_to_countries',1),('2020_03_04_032825_add_active_to_regions',1),('2020_03_04_040156_add_active_to_rate_centers',1),('2020_03_04_052317_add_sip_rate_center_providers',1),('2020_03_04_061115_add_api_name_to_sip_providers',1),('2020_03_09_025513_create_phones_table',1),('2020_03_09_025537_create_phones_groups_table',1),('2020_03_09_025549_create_phones_global_settings_table',1),('2020_03_09_025605_create_phones_individual_settings_table',1),('2020_03_09_030714_create_phones_definitions_table',1),('2020_03_09_031440_add_group_id_to_phones',1),('2020_03_09_032614_create_phone_defaults',1),('2020_03_09_200636_add_phone_settings_to_workspace',1),('2020_03_09_204502_add_phone_grps_to_workspace',1),('2020_03_09_221633_add_workspace_prov_settings_params',1),('2020_03_11_041842_create_phones_global_settings_values',1),('2020_03_11_205622_create_phones_individual_settings_values',1),('2020_03_19_032609_add_xml_attrs_to_phone_defaults',1),('2020_03_23_021121_add_extensions_tags',1),('2020_03_23_021236_add_phones_tags',1),('2020_03_23_053501_add_type_to_dids',1),('2020_03_23_065938_add_fax_args_to_ratecenters',1),('2020_03_24_233714_add_availability_to_did_numbers',1),('2020_03_31_193531_add_category_to_flows',1),('2020_03_31_202628_add_office_number_to_users',1),('2020_03_31_220721_call_rate_dial_prefix',1),('2020_04_01_025332_add_type_to_call_rate',1),('2020_04_01_025447_call_rate_to_call_rate',1),('2020_04_07_011337_create_system_status_categories_table',1),('2020_04_07_011505_create_system_status_updates_table',1),('2020_04_07_015347_add_status_to_sys_updates',1),('2020_04_14_190351_add_hash_to_workspace_users',1),('2020_04_14_194525_add_job_title_to_users',1),('2020_04_17_032730_add_needs_password_set',1),('2020_04_17_041637_add_accepted_workspace',1),('2020_04_17_044206_add_hash_expired_to_workspace_users',1),('2020_04_17_044615_needs_set_password_date',1),('2020_05_03_194429_create_conferences_table',1),('2020_05_03_194502_create_conferences_members_table',1),('2020_05_06_000215_create_error_user_trace',1),('2020_05_06_032418_create_sip_providers_hosts',1),('2020_05_06_041334_add_type_of_provider',1),('2020_05_11_021831_create_byo_carriers',1),('2020_05_11_021851_create_byo_dids',1),('2020_05_11_022031_create_byo_carriers_routes',1),('2020_05_11_041708_add_byo_roles',1),('2020_05_11_054648_add_byo_settings',1),('2020_05_11_210048_add_flow_id_to_byo_dids',1),('2020_05_22_061003_create_byo_carriers_ips',1),('2020_05_24_223501_create_sip_providers_whitelist_ips',1),('2020_05_25_030825_create_media_servers',1),('2020_05_29_191452_add_api_id_to_conf',1),('2020_06_01_030814_add_transcription_text',1),('2020_06_02_001019_add_outbound_verifier_macro',1),('2020_06_02_051240_add_provision_error',1),('2020_06_03_222452_ip_whitelist_disabled',1),('2020_06_03_222521_byo_did_action',1),('2020_06_05_040154_create_sip_routers',1),('2020_06_05_040222_create_sip_routers_media_servers',1),('2020_06_18_034824_add_call_fields',1),('2020_06_18_034944_create_call_tags',1),('2020_06_18_054015_add_active_to_dids',1),('2020_07_02_205621_move_plan_to_workspaces',1),('2020_07_02_211150_create_plan_usage_period',1),('2020_07_02_211217_add_plan_to_calls',1),('2020_07_02_211226_add_plan_to_recordings',1),('2020_07_02_211237_add_plan_to_faxes',1),('2020_07_02_212948_add_plan_to_users_debits',1),('2020_07_07_025134_add_primary_to_cards',1),('2020_07_07_025427_add_workspace_to_cards',1),('2020_07_12_064116_add_workspace_to_invoices',1),('2020_07_13_000500_add_setup_cost',1),('2020_07_17_012659_add_breakdown_of_costs_to_invoices',1),('2020_07_17_014656_add_cents_collected_to_invoices',1),('2020_07_25_062322_create_sip_providers_rates',1),('2020_07_25_062512_add_rate_ref_to_rates',1),('2020_07_25_083648_add_prefix_priority_to_sip_hosts',1),('2020_07_27_134704_add_register_info_to_exts',1),('2020_07_28_071822_add_webrtc_optimized_to_servers',1),('2020_09_24_205620_add_pending_number',1),('2020_09_25_020516_create_template_presets',1),('2020_09_25_042350_add_widget_key_to_presets',1),('2020_09_30_030600_add_workspace_user_assigned_data',1),('2020_10_06_033659_add_live_media_Server_data',1),('2020_10_14_040750_add_live_stats_to_routers',1),('2020_10_15_060038_add_pop_workspace_users',1),('2020_10_15_212843_create_workspaces_invites',1),('2020_10_15_213435_add_hash_to_invites',1),('2021_10_20_224404_add_channel_id_to_calls',1),('2021_11_16_213509_add_recordings_for_storage',1),('2021_11_16_221046_add_recordings_s3_url',1),('2021_11_17_001924_add_recordings_relocation_attempts',1),('2021_11_17_010259_add_calls_billed',1),('2021_11_19_032551_add_k8s_ids_sip_routers',1),('2021_11_19_032808_add_k8s_ids_media_servers',1),('2021_11_22_222046_add_region_to_media_servers',1),('2021_11_26_194222_create_api_credentials',1),('2021_11_26_230215_add_google_service_acc',1),('2021_12_02_012416_add_settings_cols',1),('2021_12_10_013151_add_rate_limit_settings',1),('2021_12_10_014025_add_sip_provider_metrics',1),('2021_12_10_015743_add_sip_provider_to_calls',1),('2021_12_10_030306_add_sipcallid',1),('2021_12_14_211701_add_setup_complete',1),('2021_12_15_004333_add_customizations_table',1),('2021_12_16_013225_create_number_inventory',1),('2021_12_20_211043_create_router_flows',1),('2021_12_20_211240_create_router_flows_templates',1),('2021_12_26_222102_create_rtpproxy_tbl',1),('2021_12_27_000342_add_carrier_key',1),('2022_01_09_205944_add_sip_country_fields',1),('2022_01_09_210308_add_routing_flow_id',1),('2022_01_09_214321_workspaces_routing_flows',1),('2022_01_09_220106_sip_providers_countries',1),('2022_01_09_220138_sip_providers_call_rates',1),('2022_01_09_234559_add_active_channels',1),('2022_01_09_234631_add_active_channels_hosts',1),('2022_02_10_221404_add_recording_trim',1),('2022_03_24_024322_add_sip_trunks',1),('2022_03_24_024647_add_sip_trunks_origination',1),('2022_03_24_024706_add_sip_trunks_termination',1),('2022_03_24_024955_add_sip_trunks_termination_acl',1),('2022_03_24_025005_add_sip_trunks_termination_creds',1),('2022_03_24_025528_add_sip_trunks_origination_endpoints',1),('2022_07_29_060310_add_trunk_id_to_dids',1),('2022_10_20_014232_add_ip_variables_to_sip_trunk_tables',1),('2022_12_01_213043_add_trunk_perms_workspaces',1),('2023_01_03_195656_add_customization_fields_for_verification_workflow',1),('2023_01_03_203146_add_customization_fields_for_preferences',1),('2023_01_03_215047_add_region_to_workspace',1),('2023_01_03_224005_add_customization_dns_provider',1),('2023_01_10_222013_create_microservice_api_key',2),('2023_01_11_233636_create_dns_records',3),('2023_01_11_234919_create_workspaces_regions',4),('2023_01_12_001513_add_route53_zone_id',4),('2023_01_12_003523_add_namecheap_api_settings',5),('2023_02_01_010310_create_service_plans',6),('2023_02_07_201921_create_workspaces_sip_webhooks',7),('2023_02_07_222033_add_new_fields_to_customizations',8),('2023_02_07_222519_add_resource_article_sections',9),('2023_02_07_222520_add_resource_articles',10),('2023_02_07_223303_create_faqs',11),('2023_02_27_185455_create_resource_sections',12),('2023_02_27_185512_create_resource_articles',12),('2023_03_10_014730_add_admin_sso_options',13),('2023_03_10_014822_add_admin_sso_keys',13),('2023_03_13_225748_add_search_opts_to_customizations_table',14),('2023_03_16_055819_create_workspace_events',15),('2023_03_16_060751_create_workspace_events_props',15),('2023_03_16_062133_create_workspace_events_properties',16),('2023_03_20_214208_add_req_payment_field',17),('2023_03_27_200633_add_2fa_fields',18),('2023_03_27_210259_analytics_columns',19),('2023_03_27_211743_add_analytis_creds',20),('2023_03_28_182516_add_service_plan_fields',21),('2023_04_04_202950_add_cols_to_users_invoices',22),('2023_04_04_223233_add_billing_settings_to_admin_prefs',23),('2023_04_11_175441_add_rank_to_service_plans',24),('2023_04_12_235623_create_company_representatives',25),('2023_04_13_003006_add_main_rep_column',26),('2023_04_13_005140_add_contact_details_to_custs',27),('2023_04_24_201522_add_service_plan_term',28),('2023_04_24_201845_add_service_plan_term',29),('2023_04_24_201852_add_service_plan_term_to_ws',29),('2023_04_24_202032_add_service_annual_options',30),('2023_04_25_041938_add_theme_to_users_table',31),('2023_04_26_193801_add_extension_fields_to_calls',32),('2023_04_27_213201_add_port_type',33),('2023_05_01_185459_external_app_fields',34),('2023_05_01_185604_external_app_fields_workspace',34),('2023_05_01_200957_external_app_fields_dids',35),('2023_05_04_211531_add_company_name_to_users',36),('2023_05_04_212723_add_tax_number_to_users',37),('2023_05_04_213109_make_billing_countries',38),('2023_05_04_213136_make_billing_regions',38),('2023_05_04_213444_make_billing_taxes',39),('2023_05_04_214300_add_workspace_billing',40),('2023_05_04_215409_add_invoices_due_date',40),('2023_05_04_220602_add_invoices_complete_date',40),('2023_05_04_224222_create_invoices_line_items',41);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `number_inventory`
--

DROP TABLE IF EXISTS `number_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `number_inventory` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `api_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `features` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `monthly_cost` int NOT NULL,
  `setup_cost` int NOT NULL,
  `type` int NOT NULL,
  `reserved_by` int unsigned DEFAULT NULL,
  `routed_server` int unsigned DEFAULT NULL,
  `provider_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `number_inventory_reserved_by_foreign` (`reserved_by`),
  KEY `number_inventory_routed_server_foreign` (`routed_server`),
  KEY `number_inventory_provider_id_foreign` (`provider_id`),
  CONSTRAINT `number_inventory_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `number_inventory_reserved_by_foreign` FOREIGN KEY (`reserved_by`) REFERENCES `workspaces` (`id`) ON DELETE SET NULL,
  CONSTRAINT `number_inventory_routed_server_foreign` FOREIGN KEY (`routed_server`) REFERENCES `sip_routers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `number_inventory`
--

LOCK TABLES `number_inventory` WRITE;
/*!40000 ALTER TABLE `number_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `number_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones`
--

DROP TABLE IF EXISTS `phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mac_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `needs_provisioning` tinyint(1) NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `phone_type` int NOT NULL,
  `group_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_public_id_unique` (`public_id`),
  UNIQUE KEY `phones_mac_address_unique` (`mac_address`),
  KEY `phones_user_id_foreign` (`user_id`),
  KEY `phones_workspace_id_foreign` (`workspace_id`),
  KEY `phones_group_id_foreign` (`group_id`),
  CONSTRAINT `phones_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `phones_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `phones_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones`
--

LOCK TABLES `phones` WRITE;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_defaults`
--

DROP TABLE IF EXISTS `phones_defaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_defaults` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `phone_type` int NOT NULL,
  `slotID` int NOT NULL,
  `group_id` int unsigned DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_2` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_2_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_3` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_3_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_4` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_4_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_5` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_5_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_6` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_6_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_7` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_7_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_8` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_8_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_9` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_9_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_10` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_10_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_11` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_11_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_12` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_12_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_13` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_13_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_14` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_14_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_15` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_15_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_16` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_16_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_17` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_17_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_18` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_18_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_19` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_19_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_20` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_20_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `xml_attrs` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_defaults_group_id_foreign` (`group_id`),
  CONSTRAINT `phones_defaults_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `phones_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_defaults`
--

LOCK TABLES `phones_defaults` WRITE;
/*!40000 ALTER TABLE `phones_defaults` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_defaults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_definitions`
--

DROP TABLE IF EXISTS `phones_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_definitions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `manufacturer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data2` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_type` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_definitions`
--

LOCK TABLES `phones_definitions` WRITE;
/*!40000 ALTER TABLE `phones_definitions` DISABLE KEYS */;
INSERT INTO `phones_definitions` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2130','','',1),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2140','','',2),(3,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2160','','',3),(4,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4248','','',4),(5,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4224','','',5),(6,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4216','','',6),(7,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA303G','','',7),(8,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA504G','','',8),(9,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA508G','','',9),(10,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA509G','','',9),(11,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA514G','','',10),(12,'2023-01-03 23:12:26','2023-01-03 23:12:26','Polycom','IP330','','',11),(13,'2023-01-03 23:12:26','2023-01-03 23:12:26','Polycom','IP331','','',12);
/*!40000 ALTER TABLE `phones_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_global_settings`
--

DROP TABLE IF EXISTS `phones_global_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_global_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `phone_type` int NOT NULL,
  `phone_group` int unsigned DEFAULT NULL,
  `setting_variable_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_global_settings_public_id_unique` (`public_id`),
  KEY `phones_global_settings_phone_group_foreign` (`phone_group`),
  KEY `phones_global_settings_user_id_foreign` (`user_id`),
  KEY `phones_global_settings_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `phones_global_settings_phone_group_foreign` FOREIGN KEY (`phone_group`) REFERENCES `phones_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phones_global_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `phones_global_settings_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_global_settings`
--

LOCK TABLES `phones_global_settings` WRITE;
/*!40000 ALTER TABLE `phones_global_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_global_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_global_settings_values`
--

DROP TABLE IF EXISTS `phones_global_settings_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_global_settings_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `setting_variable_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_global_settings_values_setting_id_foreign` (`setting_id`),
  CONSTRAINT `phones_global_settings_values_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `phones_global_settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_global_settings_values`
--

LOCK TABLES `phones_global_settings_values` WRITE;
/*!40000 ALTER TABLE `phones_global_settings_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_global_settings_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_groups`
--

DROP TABLE IF EXISTS `phones_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_groups_public_id_unique` (`public_id`),
  KEY `phones_groups_user_id_foreign` (`user_id`),
  KEY `phones_groups_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `phones_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `phones_groups_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_groups`
--

LOCK TABLES `phones_groups` WRITE;
/*!40000 ALTER TABLE `phones_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_individual_settings`
--

DROP TABLE IF EXISTS `phones_individual_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_individual_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mac_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phones_individual_settings_public_id_unique` (`public_id`),
  KEY `phones_individual_settings_phone_id_foreign` (`phone_id`),
  KEY `phones_individual_settings_user_id_foreign` (`user_id`),
  KEY `phones_individual_settings_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `phones_individual_settings_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phones_individual_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `phones_individual_settings_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_individual_settings`
--

LOCK TABLES `phones_individual_settings` WRITE;
/*!40000 ALTER TABLE `phones_individual_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_individual_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_individual_settings_values`
--

DROP TABLE IF EXISTS `phones_individual_settings_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_individual_settings_values` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `setting_id` int unsigned NOT NULL,
  `setting_variable_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_individual_settings_values_setting_id_foreign` (`setting_id`),
  CONSTRAINT `phones_individual_settings_values_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `phones_individual_settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_individual_settings_values`
--

LOCK TABLES `phones_individual_settings_values` WRITE;
/*!40000 ALTER TABLE `phones_individual_settings_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_individual_settings_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones_tags`
--

DROP TABLE IF EXISTS `phones_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phones_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `phone_id` int unsigned NOT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_tags_phone_id_foreign` (`phone_id`),
  CONSTRAINT `phones_tags_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_tags`
--

LOCK TABLES `phones_tags` WRITE;
/*!40000 ALTER TABLE `phones_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `phones_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_usage_period`
--

DROP TABLE IF EXISTS `plan_usage_period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plan_usage_period` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `plan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `started_at` datetime NOT NULL,
  `renews_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `plan_usage_period_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `plan_usage_period_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_usage_period`
--

LOCK TABLES `plan_usage_period` WRITE;
/*!40000 ALTER TABLE `plan_usage_period` DISABLE KEYS */;
INSERT INTO `plan_usage_period` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26',2,'','2023-01-03 23:12:26',NULL,NULL,1),(2,'2023-01-03 23:13:52','2023-01-03 23:13:52',3,'trial','0000-00-00 00:00:00',NULL,NULL,0),(3,'2023-01-03 23:15:05','2023-01-03 23:15:05',4,'trial','0000-00-00 00:00:00',NULL,NULL,0),(4,'2023-01-12 02:18:53','2023-01-12 02:18:53',7,'trial','0000-00-00 00:00:00',NULL,NULL,0),(5,'2023-01-12 02:25:10','2023-01-12 02:25:10',8,'trial','0000-00-00 00:00:00',NULL,NULL,0),(6,'2023-01-12 02:26:53','2023-01-12 02:26:53',9,'trial','0000-00-00 00:00:00',NULL,NULL,0),(7,'2023-01-20 07:16:18','2023-01-20 07:16:18',10,'trial','0000-00-00 00:00:00',NULL,NULL,0),(8,'2023-03-02 03:19:18','2023-03-02 03:19:18',11,'trial','0000-00-00 00:00:00',NULL,NULL,0),(9,'2023-03-02 03:24:19','2023-03-02 03:24:19',12,'trial','0000-00-00 00:00:00',NULL,NULL,0),(10,'2023-03-02 03:43:06','2023-03-02 03:43:06',14,'trial','0000-00-00 00:00:00',NULL,NULL,0),(11,'2023-03-02 16:10:58','2023-03-02 16:10:58',15,'trial','0000-00-00 00:00:00',NULL,NULL,0),(12,'2023-03-16 20:31:39','2023-03-16 20:31:39',16,'trial','0000-00-00 00:00:00',NULL,NULL,0),(13,'2023-03-16 20:37:18','2023-03-16 20:37:18',17,'trial','0000-00-00 00:00:00',NULL,NULL,0),(14,'2023-03-17 10:44:19','2023-03-17 10:44:19',18,'trial','0000-00-00 00:00:00',NULL,NULL,0),(15,'2023-03-17 10:47:50','2023-03-17 10:47:50',19,'trial','0000-00-00 00:00:00',NULL,NULL,0),(16,'2023-03-17 10:50:49','2023-03-17 10:50:49',20,'trial','0000-00-00 00:00:00',NULL,NULL,0),(17,'2023-03-17 10:57:15','2023-03-17 10:57:15',21,'trial','0000-00-00 00:00:00',NULL,NULL,0),(18,'2023-03-17 21:44:58','2023-03-17 21:44:58',22,'trial','0000-00-00 00:00:00',NULL,NULL,0),(19,'2023-03-28 18:03:52','2023-03-28 18:03:52',27,'trial','0000-00-00 00:00:00',NULL,NULL,0),(20,'2023-03-31 20:45:04','2023-03-31 20:45:04',30,'trial','0000-00-00 00:00:00',NULL,NULL,0),(21,'2023-04-02 05:29:55','2023-04-02 05:29:55',31,'trial','0000-00-00 00:00:00',NULL,NULL,0),(22,'2023-04-03 16:39:46','2023-04-03 16:39:46',32,'trial','0000-00-00 00:00:00',NULL,NULL,0),(23,'2023-04-03 16:43:44','2023-04-03 16:43:44',33,'trial','0000-00-00 00:00:00',NULL,NULL,0),(24,'2023-04-03 16:45:46','2023-04-03 16:45:46',34,'trial','0000-00-00 00:00:00',NULL,NULL,0),(25,'2023-04-03 16:45:53','2023-04-03 16:45:53',35,'trial','0000-00-00 00:00:00',NULL,NULL,0),(26,'2023-04-03 16:50:10','2023-04-03 16:50:10',36,'trial','0000-00-00 00:00:00',NULL,NULL,0),(27,'2023-04-04 11:11:38','2023-04-04 11:11:38',37,'trial','0000-00-00 00:00:00',NULL,NULL,0),(28,'2023-04-04 17:19:19','2023-04-04 17:19:19',38,'trial','0000-00-00 00:00:00',NULL,NULL,0),(29,'2023-04-05 10:47:03','2023-04-05 10:47:03',39,'trial','0000-00-00 00:00:00',NULL,NULL,0),(30,'2023-04-12 10:36:02','2023-04-12 10:36:02',41,'trial','0000-00-00 00:00:00',NULL,NULL,0),(31,'2023-04-12 12:50:10','2023-04-12 12:50:10',42,'trial','0000-00-00 00:00:00',NULL,NULL,0),(32,'2023-04-14 12:19:40','2023-04-14 12:19:40',43,'trial','0000-00-00 00:00:00',NULL,NULL,0),(33,'2023-04-18 10:18:01','2023-04-18 10:18:01',44,'trial','0000-00-00 00:00:00',NULL,NULL,0),(34,'2023-04-24 05:07:09','2023-04-24 05:07:09',46,'trial','0000-00-00 00:00:00',NULL,NULL,0),(35,'2023-04-24 06:07:32','2023-04-24 06:07:32',47,'trial','0000-00-00 00:00:00',NULL,NULL,0),(36,'2023-04-25 09:38:09','2023-04-25 09:38:09',48,'trial','0000-00-00 00:00:00',NULL,NULL,0),(37,'2023-04-27 21:14:32','2023-04-27 21:14:32',49,'trial','0000-00-00 00:00:00',NULL,NULL,0),(38,'2023-04-28 10:34:22','2023-04-28 10:34:22',50,'trial','0000-00-00 00:00:00',NULL,NULL,0),(39,'2023-04-29 03:32:03','2023-04-29 03:32:03',51,'trial','0000-00-00 00:00:00',NULL,NULL,0),(40,'2023-04-29 03:39:50','2023-04-29 03:39:50',52,'trial','0000-00-00 00:00:00',NULL,NULL,0),(41,'2023-05-01 04:01:08','2023-05-01 04:01:08',53,'trial','0000-00-00 00:00:00',NULL,NULL,0),(42,'2023-05-01 16:16:50','2023-05-01 16:16:50',54,'trial','0000-00-00 00:00:00',NULL,NULL,0),(43,'2023-05-01 16:56:57','2023-05-01 16:56:57',55,'trial','0000-00-00 00:00:00',NULL,NULL,0),(44,'2023-05-01 20:51:16','2023-05-01 20:51:16',56,'trial','0000-00-00 00:00:00',NULL,NULL,0),(45,'2023-05-02 18:08:20','2023-05-02 18:08:20',57,'trial','0000-00-00 00:00:00',NULL,NULL,0),(46,'2023-05-02 18:36:32','2023-05-02 18:36:32',58,'trial','0000-00-00 00:00:00',NULL,NULL,0),(47,'2023-05-03 17:10:36','2023-05-03 17:10:36',59,'trial','0000-00-00 00:00:00',NULL,NULL,0),(48,'2023-05-04 21:13:59','2023-05-04 21:13:59',60,'trial','0000-00-00 00:00:00',NULL,NULL,0),(49,'2023-05-04 21:21:48','2023-05-04 21:21:48',61,'trial','0000-00-00 00:00:00',NULL,NULL,0);
/*!40000 ALTER TABLE `plan_usage_period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `port_numbers`
--

DROP TABLE IF EXISTS `port_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `port_numbers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `estimated_completion_date` date NOT NULL,
  `eta` date DEFAULT NULL,
  `info_needed` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_of_port` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'single',
  `numbers` varchar(2048) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `port_numbers_public_id_unique` (`public_id`),
  KEY `port_numbers_user_id_foreign` (`user_id`),
  KEY `port_numbers_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `port_numbers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `port_numbers_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `port_numbers`
--

LOCK TABLES `port_numbers` WRITE;
/*!40000 ALTER TABLE `port_numbers` DISABLE KEYS */;
INSERT INTO `port_numbers` VALUES (1,'2023-03-24 16:06:43','2023-03-24 16:06:43','6386383','7878273823','pending-review',2,2,'p-f3b1582f-ba0b-4fd1-9635-73fa44f80806','Chandrashekhar','Kumar','Mohali','Mohali','Mohali','Mohali','160059','CA','0000-00-00',NULL,'','single',''),(2,'2023-03-24 16:20:51','2023-03-24 16:20:51','38787387','267637672','pending-review',2,2,'p-6ac279b0-ae09-4ba6-a8b3-bd2c998063f1','Chandrashekhar','Kumar','Mohali','Mohali','Mohali','Mohali','162683','CA','0000-00-00',NULL,'','single',''),(3,'2023-03-25 01:48:35','2023-03-25 01:48:35','','','pending-review',2,2,'p-bfdc17a0-e99f-4670-ae7b-66a665916475','Chandrashekhar','Kumar','Mohali','Mohali','Mohali','Mohali','789789','CA','0000-00-00',NULL,'','single',''),(4,'2023-04-27 21:33:14','2023-04-27 21:33:14','','test','pending-review',53,49,'p-a1834861-123c-4402-b7a4-ee7cf211c7a1','Test1','Test1','Test1','Test1','Test1','Test1','Test1','CA','0000-00-00',NULL,'','Multi number port','[\"1010101\",\"20202020\"]'),(5,'2023-04-27 21:38:12','2023-04-27 21:38:12','','test','pending-review',53,49,'p-832ec5a0-aadd-49ca-809e-43fbd82cef35','Test1','Test1','Test1','Test1','Test1','Test1','Test1','CA','0000-00-00',NULL,'','Multi number port','[\"1010101\",\"20202020\"]');
/*!40000 ALTER TABLE `port_numbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `port_numbers_documents`
--

DROP TABLE IF EXISTS `port_numbers_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `port_numbers_documents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `port_numbers_documents_number_id_foreign` (`number_id`),
  KEY `port_numbers_documents_user_id_foreign` (`user_id`),
  CONSTRAINT `port_numbers_documents_number_id_foreign` FOREIGN KEY (`number_id`) REFERENCES `port_numbers` (`id`),
  CONSTRAINT `port_numbers_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `port_numbers_documents`
--

LOCK TABLES `port_numbers_documents` WRITE;
/*!40000 ALTER TABLE `port_numbers_documents` DISABLE KEYS */;
INSERT INTO `port_numbers_documents` VALUES (1,'2023-03-24 16:06:43','2023-03-24 16:06:43',1,2,'1641dca9336728.pdf','','loa'),(2,'2023-03-24 16:06:43','2023-03-24 16:06:43',1,2,'1641dca9337c48.pdf','','csr'),(3,'2023-03-24 16:06:43','2023-03-24 16:06:43',1,2,'1641dca9338849.pdf','','invoice'),(4,'2023-03-24 16:20:51','2023-03-24 16:20:51',2,2,'1641dcde3e6e5d.pdf','','loa'),(5,'2023-03-24 16:20:51','2023-03-24 16:20:51',2,2,'1641dcde3e7878.pdf','','csr'),(6,'2023-03-24 16:20:51','2023-03-24 16:20:51',2,2,'1641dcde3e7f9b.pdf','','invoice'),(7,'2023-03-25 01:48:35','2023-03-25 01:48:35',3,2,'1641e52f30ca29.pdf','','loa'),(8,'2023-03-25 01:48:35','2023-03-25 01:48:35',3,2,'1641e52f30d3b3.pdf','','csr'),(9,'2023-03-25 01:48:35','2023-03-25 01:48:35',3,2,'1641e52f30daff.pdf','','invoice'),(10,'2023-04-27 21:33:14','2023-04-27 21:33:14',4,53,'1644aea1a55c00.pdf','','loa'),(11,'2023-04-27 21:33:14','2023-04-27 21:33:14',4,53,'1644aea1a571d9.pdf','','csr'),(12,'2023-04-27 21:33:14','2023-04-27 21:33:14',4,53,'1644aea1a57a5a.pdf','','invoice'),(13,'2023-04-27 21:38:12','2023-04-27 21:38:12',5,53,'1644aeb44c5153.pdf','','loa'),(14,'2023-04-27 21:38:12','2023-04-27 21:38:12',5,53,'1644aeb44c5e7e.pdf','','csr'),(15,'2023-04-27 21:38:12','2023-04-27 21:38:12',5,53,'1644aeb44c674c.pdf','','invoice');
/*!40000 ALTER TABLE `port_numbers_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recording_tags`
--

DROP TABLE IF EXISTS `recording_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recording_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recording_id` int unsigned NOT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recording_tags_recording_id_foreign` (`recording_id`),
  CONSTRAINT `recording_tags_recording_id_foreign` FOREIGN KEY (`recording_id`) REFERENCES `recordings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recording_tags`
--

LOCK TABLES `recording_tags` WRITE;
/*!40000 ALTER TABLE `recording_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `recording_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recordings`
--

DROP TABLE IF EXISTS `recordings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recordings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `call_id` int unsigned DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `size` double(8,2) NOT NULL DEFAULT '0.00',
  `workspace_id` int unsigned NOT NULL,
  `transcription_ready` tinyint(1) NOT NULL DEFAULT '0',
  `transcription_text` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_snapshot` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `storage_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `storage_server_ip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `s3_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `relocation_attempts` int NOT NULL DEFAULT '0',
  `trim` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `recordings_api_id_unique` (`api_id`),
  KEY `recordings_user_id_foreign` (`user_id`),
  KEY `recordings_call_id_foreign` (`call_id`),
  KEY `recordings_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `recordings_call_id_foreign` FOREIGN KEY (`call_id`) REFERENCES `calls` (`id`),
  CONSTRAINT `recordings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `recordings_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recordings`
--

LOCK TABLES `recordings` WRITE;
/*!40000 ALTER TABLE `recordings` DISABLE KEYS */;
INSERT INTO `recordings` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','recording-f671cd60-7378-43be-85cb-abcf81d565dc','completed','http://recordings.onelinepbx.com/user-id/test.wav',2,1,'','',0,0.00,2,0,'','','','','',0,0),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','recording-32bca88d-9baa-40b6-8628-a98b278b29f8','completed','http://recordings.onelinepbx.com/user-id/test.wav',2,1,'','',0,0.00,2,0,'','','','','',0,0),(3,'2023-01-03 23:12:26','2023-01-03 23:12:26','recording-6e39295e-a043-426d-a6b6-c16959ea0183','completed','http://recordings.onelinepbx.com/user-id/test.wav',2,2,'','',0,0.00,2,0,'','','','','',0,0);
/*!40000 ALTER TABLE `recordings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_articles`
--

DROP TABLE IF EXISTS `resource_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource_articles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `section_id` int unsigned DEFAULT NULL,
  `seo_tags` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `active` smallint DEFAULT '0',
  `content` mediumtext COLLATE utf8mb3_unicode_ci,
  `key_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `resource_articles_section_id_foreign` (`section_id`),
  CONSTRAINT `resource_articles_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `resource_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_articles`
--

LOCK TABLES `resource_articles` WRITE;
/*!40000 ALTER TABLE `resource_articles` DISABLE KEYS */;
INSERT INTO `resource_articles` VALUES (4,'2023-03-03 03:54:19','2023-03-27 22:04:04','Purchasing New Numbers','','learn how to buy numbers in your web portal.','',5,'did numbers, dids, purchase, buy, lineblocs',1,'# Purchase Numbers\r\n\r\n\r\n\r\nLineblocs currently offers voice numbers that are toll-free, local or vanity based. You can use the Lineblocs user dashboard to buy new DID numbers in a supported rate centre and region.\r\n\r\n\r\n\r\n## Searching for numbers\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click [\"DID Numbers\" -> \"Buy Numbers\"](https://app.lineblocs.com/#/dashboard/dids/buy-numbers)\r\n\r\n2. Select Voice Numbers\r\n\r\n3. Search for numbers based on the filters provided. Click \"More Options\" for advanced filters\r\n\r\n![info](/img/frontend/docs/purchase-numbers/filter-1.png) \r\n\r\n4. Click Search\r\n\r\n\r\n\r\n## Buying a number\r\n\r\n\r\n\r\nTo purchase a number, click the ![info](/img/frontend/docs/purchase-numbers/buy.png) button next to the number.\r\n\r\n\r\n\r\n## Setup Number\r\n\r\n\r\n\r\nOnce you have purchased a new number, you can change the number\'s settings according to your needs – including changing its label, call flow, and more. For more info on managing numbers please [click here](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related guides, please see the following:\r\n\r\n\r\n\r\n- [Porting Numbers](https://lineblocs.com/resources/managing-numbers/porting-numbers)\r\n\r\n- [Releasing Numbers](https://lineblocs.com/resources/managing-numbers/release-numbers)','purchase-numbers'),(5,'2023-03-03 03:55:36','2023-03-27 22:04:12','Managing number tags and flows','','add number tags and flows to your number','',5,'did numbers, manage dids, edit, delete',1,'# Manage Numbers\r\n\r\n\r\n\r\nYou can use the Lineblocs dashboard to manage number settings – including number tags and flows. Managing numbers is a simple yet very useful feature.\r\n\r\n\r\n\r\n## Editing a number\r\n\r\n\r\n\r\n1. Go to [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n\r\n\r\n#### Change Number Name\r\n\r\n\r\n\r\nYour number name is used as a label for your number. For example, you may want to make use of \"Sales Number\" if your number is related to sales. Or you may want to associate an appropriate name for your number based on its use case.\r\n\r\n\r\n\r\nThe number name is also used throughout Lineblocs – in call flow editor and other sections. Keeping your number name unique helps you search for the number when needed.\r\n\r\n\r\n\r\n#### Add Number Tags\r\n\r\n\r\n\r\nYou can add one or more tags to your number. Number tags can be used to add additional filters to your number.\r\n\r\n\r\n\r\nNumber tags help you find groups of numbers based on common attributes. For example, you may want to use the number tag \"West\" if you know it will only be used by agents in a Western region.\r\n\r\n\r\n\r\n#### Number Call Flow\r\n\r\n\r\n\r\nTo change your number\'s inbound Lineblocs flow you can update the \"Attached Flow\" setting. \r\n\r\n\r\n\r\n## Update Number\r\n\r\n\r\n\r\nTo save your number settings, click \"Save\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor other related guides be sure to check out the following:\r\n\r\n\r\n\r\n[Porting Numbers](https://lineblocs.com/resources/managing-numbers/porting-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','manage-numbers'),(6,'2023-03-03 03:56:31','2023-03-27 22:04:20','Releasing numbers','','a guide on unrenting numbers','',5,'release numbers, unrent, lineblocs',1,'# Release Numbers\r\n\r\n\r\n\r\nYou can unrent a Lineblocs number at any time – regardless of your membership plan or account status. Please note that once you unrent a number, all of its call records and associated data will also be removed from your account. \r\n\r\n\r\n\r\n## Unrent A Number\r\n\r\n\r\n\r\n1. Go to [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the     ![](/img/frontend/docs/shared/trash.png) icon on the number you wish to unrent\r\n\r\n3. Confirm unrenting the number by typing in the number\r\n\r\n4. Click \"Confirm\"\r\n\r\n\r\n\r\n## Discontinued Number Billing Charge\r\n\r\n\r\n\r\nBilling charges for your number will be terminated on the 1st of the following month. For example, if you have unrented at number on Jan 15th, billing for this number will stop on Feb 1st.\r\n\r\n\r\n\r\n# Next Steps\r\n\r\n\r\n\r\nFor more info on managing numbers or billing posts, please see:\r\n\r\n\r\n\r\n[Managing Numbers](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','release-numbers'),(7,'2023-03-03 03:57:20','2023-03-27 22:04:30','Porting Numbers','','creating port in or port out requests','',5,'port numbers, port in, port out, lineblocs',1,'# Porting Numbers\r\n\r\n\r\n\r\nLineblocs currently supports port-in requests in various funded rate centres.\r\n\r\n\r\n\r\nFor a complete list of assisted regions, please see [Supported Rate Centers](https://lineblocs.com/resources/other-topics/supported-rate-centers).\r\n\r\n\r\n\r\n## Port-In Request Requirements\r\n\r\n\r\n\r\nIf you are trying to port in a number to Lineblocs, please keep in mind the following requirements:\r\n\r\n\r\n\r\n1. The number you are trying port should not have been disconnected by the provider\r\n\r\n2. No dispute should be open with the porting number\r\n\r\n3. Porting number should not be scheduled for disconnection\r\n\r\n3. The porting number cannot have a contract\r\n\r\n4. The number you port must be available in a rate centre we support\r\n\r\n\r\n\r\n## Start Port Request\r\n\r\n\r\n\r\nTo start a Port-In request, please login to the Lineblocs portal then access the port request page at [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create).\r\n\r\n\r\n\r\nOn the port request page you will need to provide us with the following info:\r\n\r\n\r\n\r\n1. Your First and Last Name\r\n\r\n2. Local Address\r\n\r\n3. Letter of Authorization (LOA) - a letter of authorization from the number owner\r\n\r\n4. Customer Service Record (CSR) - a customer service record\r\n\r\n5. Recent invoice from your provider - an invoice dated no longer than 90 days\r\n\r\n\r\n\r\n## Submitting Port-In Request\r\n\r\n\r\n\r\nTo submit your port-in request, please fill in the fields on the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create), and then click the \"Save\" button.\r\n\r\n\r\n\r\n## Port-In Review Stages\r\n\r\n\r\n\r\nOnce you have submitted your port-in request, you will be sent updates whenever the port-in request status changes. \r\n\r\n\r\n\r\nThe statuses your port-in request will go through can include the following:\r\n\r\n\r\n\r\n1. Pending Review\r\n\r\n\r\n\r\n       This is when we have received your port in request but have not confirmed on our end yet.\r\n\r\n\r\n\r\n2. Received\r\n\r\n\r\n\r\n        Port in request was received and lineblocs has confirmed it will attempt the port-in request.\r\n\r\n\r\n\r\n3. Submitted to Provider\r\n\r\n\r\n\r\n        The port request was sent to your current carrier\r\n\r\n\r\n\r\n3. Confirmed\r\n\r\n\r\n\r\n        Your port-in has been confirmed, and an ETA has been provided.\r\n\r\n\r\n\r\n4. Completed\r\n\r\n\r\n\r\n        Your port-in is now completed\r\n\r\n\r\n\r\nYou will be notified via email whenever the port-in request status and when an ETA for the port is established.\r\n\r\n\r\n\r\nYou can also track the status of your Port-In request by accessing the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create) and checking the Status column in the port numbers list.\r\n\r\n\r\n\r\n![Port Status](/img/frontend/docs/port-numbers/port-status.png)\r\n\r\n\r\n\r\n## Editing Port Request\r\n\r\n\r\n\r\nYou may be required to edit your port-in request depending on whether more personal information is required.\r\n\r\n\r\n\r\nTo update your port-in request please go to the [Port Requests Page](https://app.lineblocs.com/#/dashboard/dids/ports) \r\n\r\n\r\n\r\nthen click the ![](/img/frontend/docs/shared/edit.png) icon on the ported number.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on managing numbers or billing related to numbers, be sure to see articles below:\r\n\r\n\r\n\r\n[Managing Numbers](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','porting-numbers'),(8,'2023-03-03 03:59:38','2023-03-27 22:04:46','Call pricing','','learn about the pricing behind your calls and when you are charged for inbound or outbound calling.','',6,'call pricing, CSVs, inbound, outbound, lineblocs',1,'# Call Pricing\r\n\r\n\r\n\r\nLineblocs currently offers competitive local and toll-free call pricing in select regions.\r\n\r\nAll user calls on Lineblocs are billed by usage and also based on your membership plan.\r\n\r\n\r\n\r\n## Call Rates\r\n\r\n\r\n\r\nTo view an up to date list of our calling rates by country please view [Voice Pricing Page](https://lineblocs.com/rates). \r\n\r\n\r\n\r\n## CSV downloads\r\n\r\n\r\n\r\nYou can also download a CSV sheet that includes our inbound and outbound call rates. \r\n\r\n\r\n\r\nTo download the CSV list please use links below:\r\n\r\n\r\n\r\n[Outbound CSV call rates](https://lineblocs.com/extra/outbound-call-rates.csv)\r\n\r\n\r\n\r\n[Inbound CSV call rates](https://lineblocs.com/extra/inbound-call-rates.csv)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing and pricing please view links below:\r\n\r\n\r\n\r\n[Upgrading Plan](https://lineblocs.com/resources/billing-and-pricing/upgrading-plan)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','call-pricing'),(9,'2023-03-03 04:00:45','2023-03-27 22:04:57','Monthly Invoices','','how to view invoices in your dashboard and manage invoice billing.','',6,'invoices, monthly invoices, billing, lineblocs',1,'# Monthly Invoices\r\n\r\n\r\n\r\n\r\n\r\nMonthly invoices are generated in the Lineblocs dashboard and available at any time for download.\r\n\r\n\r\n\r\nIn this guide we discuss monthly billing, and the resources you are billed for on a monthly basis.\r\n\r\n\r\n\r\n## Billed Resources\r\n\r\n\r\n\r\nWe currently bill based on the dedicated usage of call, fax, and IM based resources. The costs associated with our billing plans are typically based on carrier call toll, server hosting costs, and the usage of third-party API services.\r\n\r\n\r\n\r\n#### Usage Billing\r\n\r\n\r\n\r\n1. Incoming Call Toll\r\n\r\n2. Outgoing Call Toll\r\n\r\n3. Fax related charges\r\n\r\n4. Third-party API services\r\n\r\n\r\n\r\n#### Per month related\r\n\r\n\r\n\r\n1. Recording Storage\r\n\r\n2. PBX hosting expenses\r\n\r\n3. DID number renewal\r\n\r\n\r\n\r\n## Downloading an invoice\r\n\r\n\r\n\r\nTo download a monthly invoice:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click the \"History\" tab\r\n\r\n4. Enter a start and end date range for your invoice\r\n\r\n5. Click \"Download\"\r\n\r\n\r\n\r\n## Receiving Invoices By Email\r\n\r\n\r\n\r\nYou can also choose to receive invoices by email.\r\n\r\n\r\n\r\nTo enable invoices by email:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click the \"Settings\" tab\r\n\r\n4. Check \"Receive monthly invoices by email\"\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing, please see the articles below:\r\n\r\n\r\n\r\n[Upgrading Plan](https://lineblocs.com/resources/billing-and-pricing/upgrading-plan)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','monthly-invoices'),(10,'2023-03-03 04:07:18','2023-03-27 22:12:55','Upgrading Plan','','how to upgrade your Lineblocs membership','',6,'upgrade plan, upgrade, lineblocs, membership, change',1,'# Upgrading Plan \r\n\r\n\r\n\r\nUpgrading your membership type is a straightforward process. \r\n\r\n\r\n\r\nTo learn more about the Lineblocs memberships, please view our [Pricing page](https://lineblocs.com/pricing)\r\n\r\n\r\n\r\n## Changing membership type\r\n\r\n\r\n\r\nTo change your membership plan:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to [Billing](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Next to your membership plan, click     ![upgrade](/img/frontend/docs/upgrade-plan/upgrade.png)\r\n\r\n3. Select your new plan\r\n\r\n4. Select a billing method\r\n\r\n5. Save all changes\r\n\r\n\r\n\r\n## Billing Changes\r\n\r\n\r\n\r\nAfter you have upgraded your billing plan, you should be able to make use of your workspace features instantly.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing matters, please see the articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','upgrading-plan'),(11,'2023-03-03 04:08:10','2023-03-27 22:05:14','Adding Credit (Pay As You Go Only)','','learn about the payment options available to fund your lineblocs account.','',6,'adding credit, billing, types of payment, paypal, credit card, lineblocs, adding credit',1,'# Adding Credit (Pay-as-you-go only)\r\n\r\n\r\n\r\nYou can use the Lineblocs dashboard to add credit to your account at any time.\r\n\r\n\r\n\r\n## Adding Credit using a Card\r\n\r\n\r\n\r\n\r\n\r\n1. In Lineblocs dashboard go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Select a card and the desired credit amount\r\n\r\n3. Click     ![Pay PayPal](/img/frontend/docs/shared/add-credit.png)\r\n\r\n\r\n\r\n## Using PayPal\r\n\r\n\r\n\r\nto use PayPal as a checkout method:\r\n\r\n\r\n\r\n1. in the left sub menu click \"PayPal\"\r\n\r\n2. select your desired credit amount\r\n\r\n3. click     ![Pay PayPal](/img/frontend/docs/shared/pay-paypal.png)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing rela-ed topics, please see articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','adding-credit'),(12,'2023-03-03 04:09:35','2023-03-27 22:05:23','Managing Billing Cards','','how to manage billing cards on Lineblocs','',6,'managing cards, billing, types of payment, paypal, credit card, lineblocs, adding credit',1,'# Managing Billing\r\n\r\n\r\n\r\nLineblocs dashboard can also be used to add a new card, remove a card, or change the primary billing card on your account at any time.\r\n\r\n\r\n\r\n## Adding Credit Card\r\n\r\n\r\n\r\nTo add a credit card to your Lineblocs account:\r\n\r\n\r\n\r\n1. in Lineblocs dashboard go to [Billing](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click \"Add Card\"\r\n\r\n3. Enter your card details\r\n\r\n4. Click \"Submit\"\r\n\r\n\r\n\r\n## Change Primary Card\r\n\r\n\r\n\r\nTo change your primary billing card please click the ![primary](/img/frontend/docs/payment-options/set-primary.png) button next to the card.\r\n\r\n\r\n\r\n## Removing A Card\r\n\r\n\r\n\r\nTo remove a card you can click the ![trash](/img/frontend/docs/shared/trash.png) button next to the card.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing matters, please see the articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','managing-billing-cards'),(13,'2023-03-03 04:21:50','2023-03-27 22:05:41','Learn about trial balance','','learn how does the lineblocs trial work and what are the limits.','',7,'trial info, trial balance, lineblocs',1,'# Trial Balance\r\n\r\n\r\n\r\nLineblocs currently offers trial memberships to all new users. In this guide, we will go over trial account restrictions and how to upgrade from a trial account.\r\n\r\n\r\n\r\n## Restrictions\r\n\r\n\r\n\r\nAt this time, we enforce restrictions on all Lineblocs trial accounts – these restrictions apply to any account regardless of the Lineblocs membership.\r\n\r\n\r\n\r\nTrial Account Restrictions:\r\n\r\n\r\n\r\n1. 1 Local Number only\r\n\r\n2. Max 3 minutes of outbound/inbound call time\r\n\r\n3. Up to 32MB recording space\r\n\r\n\r\n\r\n## Upgrading\r\n\r\n\r\n\r\nYou can upgrade your account to a non-trial account. Please note that depending on the type of account you are registered under (Pay as you go or dedicated), the steps may vary.\r\n\r\n\r\n\r\n#### Dedicated Membership\r\n\r\n\r\n\r\nTo upgrade your account to a dedicated membership, please add a valid billing method.\r\n\r\n\r\n\r\n#### Pay as you go\r\n\r\n\r\n\r\nIf you wish to use pay-as-you-go plan, you will need to add a valid billing method and an amount of credit. \r\n\r\n\r\n\r\nTo learn how to add credit please view [Add Credit](https:///lineblocs.com/resources/billing-and-pricing/add-credit)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to view:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','learn-trial'),(14,'2023-03-03 04:24:46','2023-03-27 22:05:47','Account Settings','','how to update your account\'s settings','',7,'account settings, edit password, edit email, lineblocs',1,'# Managing Account Settings\r\n\r\n\r\n\r\nYou can update your Lineblocs account settings at any time. This includes updating your organization\'s email, password, and personal contact details.\r\n\r\n\r\n\r\n## View Account settings\r\n\r\n\r\n\r\nTo view your account settings on the Lineblocs dashboard, please click the ![User](/img/frontend/docs/shared/user.png) icon then click [Settings](https://lineblocs.com/#/dashboard/settings)\r\n\r\n\r\n\r\n#### Update Password\r\n\r\n\r\n\r\nTo update your password please click the \"Password\" tab.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Managing IP Whitelist](https://lineblocs.com/resources/other-topics/managing-ip-whitelist)','account-settings'),(15,'2023-03-03 04:25:46','2023-03-27 22:05:55','Usage Limits (Pay-as-you-go only)','','all about the Lineblocs plans and their usage limits / constraints','',7,'limits, plans, resource limits, usage triggers, usage limits, lineblocs',1,'# Usage Limits (Pay-as-you-go)\r\n\r\n\r\n\r\nUsage limits define how many calls you can make, how many numbers you can purchase, and the amount of recording space you can use per month. In this guide, we go over the usage limits, which apply only to the Pay as you go membership plan.\r\n\r\n\r\n\r\n## Limits overview\r\n\r\n\r\n\r\nCalls Per Month: 1024\r\n\r\n\r\n\r\nExtensions: 5\r\n\r\n\r\n\r\nRecording Space: 24GB\r\n\r\n\r\n\r\nNumbers: 10\r\n\r\n\r\n\r\n## Viewing Usage History\r\n\r\n\r\n\r\nTo view your current usage history:\r\n\r\n\r\n\r\n1. On Lineblocs Dashboard [Lineblocs Dashboard](https://app.lineblocs.com/#/dashboard/home)\r\n\r\n2. In the left menu, click \"Billing\"\r\n\r\n3. Click tab \"Usage Limits\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Setup Usage Triggers](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','usage-limits'),(16,'2023-03-03 04:26:44','2023-03-27 22:06:05','Setup Usage Triggers','','how to setup usage triggers','',7,'usage, triggers, usage triggers, resource limits, lineblocs',1,'# Setup Usage Triggers\r\n\r\n\r\n\r\nUsage triggers are a very convenient way to monitor the activity associated with your Lineblocs account. \r\n\r\n\r\n\r\nCurrently, usage triggers can be set up on Lineblocs to alert you whenever you reach a set threshold in terms of billing.\r\n\r\n\r\n\r\nIn this guide, we will discuss how to set up a usage trigger on Lineblocs.\r\n\r\n\r\n\r\n## Create Usage Triggers\r\n\r\n\r\n\r\nTo set up a usage trigger:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard, go to the [Billing Page](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click tab \"Limits\"\r\n\r\n3. Under Usage Triggers click \"Create New\"\r\n\r\n4. Select a type of usage trigger\r\n\r\n5. Set the usage trigger percentage \r\n\r\n7. Click \"Submit\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','setup-usage-triggers'),(17,'2023-03-03 04:33:17','2023-03-27 22:06:14','Reporting Call Spam','','learn how to file a spam report on lineblocs','',7,'call spam, unwanted calls, lineblocs',1,'# Reporting Call Spam\r\n\r\n\r\n\r\nLineblocs tries to prevent call spam internally, using an array of methods. However, call spam is still possible and a profound threat to any cloud-related calling service.\r\n\r\n\r\n\r\n## Reporting Calls\r\n\r\n\r\n\r\nTo report spam-related calls, please reach out to us using our [Contact Us](https://lineblocs.com/contact) page.\r\n\r\n\r\n\r\nPlease be sure to provide us the following details:\r\n\r\n\r\n\r\n1. The number that is spamming you\r\n\r\n2. Your number\r\n\r\n3. Your full name\r\n\r\n4. The day and time you have received unwanted calls\r\n\r\n\r\n\r\n### Report Review\r\n\r\n\r\n\r\nOnce you submit your request, our support team will reach out to you in 24-48 hours.\r\n\r\n\r\n\r\nIf we find out this is a case of call spam, we will take immediate action to penalize the user that has been responsible for the call spamming.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','report-spam'),(18,'2023-03-03 04:34:12','2023-03-27 22:06:24','Adding Workspace Users','','how to add workspace users to your lineblocs account','',7,'workspace, users, add user, lineblocs, account settings',1,'# Adding Workspace Users\r\n\r\n\r\n\r\nLineblocs lets you add new team members to your account on demand. You can create new members in your workspace, as well as give them roles to perform actions in your workspace, such as adding extensions, registering DIDs, or creating new call flows. \r\n\r\n\r\n\r\n## Add Workspace Member\r\n\r\n\r\n\r\nTo add a new workspace member to your Lineblocs account:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to  [Settings -> Workspace Users](https://app.lineblocs.com/#/dashboard/settings/workspace-users)\r\n\r\n2. Click \"Add User\"\r\n\r\n3. Enter user details such as email and contact info\r\n\r\n4. Assign user roles\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\nOnce you have created a new user, the user will receive an invite email that includes a registration link.\r\n\r\n\r\n\r\n> Note: All new invitations expire after 7 days.\r\n\r\n\r\n\r\n## Editing Workspace Users\r\n\r\n\r\n\r\nTo edit a user please click the ![Edit](/img/frontend/docs/shared/edit.png) button next to your user.\r\n\r\n\r\n\r\n## Resend Email Invite\r\n\r\n\r\n\r\nTo resend an email invitation you can click the ![Resend Invite](/img/frontend/docs/workspace-users/reinvite.png) button next to your user.\r\n\r\n\r\n\r\n## Remove from workspace\r\n\r\n\r\n\r\nIf you want to remove a user from your workspace please click the ![Trash](/img/frontend/docs/shared/trash.png) button next to your user.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to view:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','adding-workspace-users'),(19,'2023-03-03 04:35:04','2023-03-27 22:06:32','Managing IP Whitelist','','how to add the IPs that can access your lineblocs PBX','',7,'managing, ip whitelist, whitelist, ip, manage, lineblocs',1,'# Managing IP Whitelist\r\n\r\n\r\n\r\nIP whitelists in Lineblocs allow you to control which IPs are allowed to access your SIP extensions.\r\n\r\n\r\n\r\nYou can use IP whitelists to block any unwanted users from trying to access your extensions.\r\n\r\n\r\n\r\n## Enabling IP Whitelist\r\n\r\n\r\n\r\nBy default, the IP Whitelists are disabled. \r\n\r\n\r\n\r\nTo enable the IP Whitelist:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard, go to [Settings -> IP Whitelist](https://app.lineblocs.com/#/settings-ip-whitelist)\r\n\r\n2. Click     ![Enable Whitelist](/img/frontend/docs/ip-whitelists/enable-whitelist.png)\r\n\r\n\r\n\r\n## Adding an IP to the Whitelist\r\n\r\n\r\n\r\nTo add an IP to the whitelist:\r\n\r\n\r\n\r\n1. Click     ![Add IP](/img/frontend/docs/ip-whitelists/add-ip.png)\r\n\r\n2. Set the IP and subnet mask\r\n\r\n4. click \"Submit\"\r\n\r\n\r\n\r\n## Remove an IP\r\n\r\n\r\n\r\nTo remove an IP from the whitelist please click the ![Trash](/img/frontend/docs/shared/trash.png) icon next to the IP then confirm deleting the IP.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, please see the following:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)\r\n\r\n','managing-ip-whitelist'),(20,'2023-03-03 04:35:55','2023-03-27 22:06:39','Blocking a number','','how to block and manage blocked numbers on lineblocs','',7,'blocking, number, blocking numbers, lineblocs',1,'# Managing Blocked Numbers\r\n\r\n\r\n\r\nBlocking numbers is a simple and beneficial way to prevent call spam.\r\n\r\n\r\n\r\nAt any time, you can block a number in Lineblocs.\r\n\r\n\r\n\r\n## Block A Number\r\n\r\n\r\n\r\nTo block a number on Lineblocs:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard go to  [Settings -> Blocked Numbers](https://app.lineblocs.com/#/dashboard/settings/workspace-users)\r\n\r\n2. Click \"Block Number\"\r\n\r\n3. Enter the number you would like to block\r\n\r\n4. Click \"Submit\"\r\n\r\n\r\n\r\n## Removing Blocked Number\r\n\r\n\r\n\r\nTo remove a blocked number please click ![Trash](/img/frontend/docs/shared/trash.png) icon next to the number,\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles please see the following:\r\n\r\n\r\n\r\n[Managing IP Whitelist](https://lineblocs.com/resources/other-topics/managing-ip-whitelist)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)\r\n\r\n','blocking-a-number'),(21,'2023-03-03 04:36:42','2023-03-27 22:06:47','Create Extension Codes','','how to manage and create extension codes on lineblocs','',7,'extension, codes, lineblocs, create, pbx',1,'# Extension Codes\r\n\r\n\r\n\r\nAt a high level, extension codes let you customize the functionality of your phone system. You can use extension codes to add new functionality to your call flows such as cold transfers and voicemail or add complex features such as intercom, custom IVRs, and more.\r\n\r\n\r\n\r\nBy default, extension codes in Lineblocs can be customized using the Lineblocs flow editor. You can also create as many extension codes as you need and assign them to custom workflows using Lineblocs flows.\r\n\r\n\r\n\r\n## Viewing Extension Codes\r\n\r\n\r\n\r\nTo view the extension codes you have setup on your account, please go to [Settings -> Extension Codes](https://app.lineblocs.com/#/settings/extension-codes)\r\n\r\n\r\n\r\n## Adding an Extension Code\r\n\r\n\r\n\r\nTo add a new extension code please click the ![Add Code](/img/frontend/docs/extension-codes/add-code.png) button.\r\n\r\n\r\n\r\nYou will need to give your extension code a name, code and flow. For example:\r\n\r\n\r\n\r\n```\r\n\r\nName: Check Voicemail\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCode: *97\r\n\r\n```\r\n\r\n\r\n\r\nOnce you have added the extension code, please click \"Save.\"\r\n\r\n\r\n\r\n## Removing Extension Code\r\n\r\n\r\n\r\nTo remove an extension code click the ![Remove](/img/frontend/docs/shared/remove.png) button next to the extension code then click save.\r\n\r\n\r\n\r\n## Testing extension codes\r\n\r\n\r\n\r\nTo test an extension code, please login to your extension then dial the extension code.\r\n\r\n\r\n\r\n### Troubleshooting\r\n\r\n\r\n\r\nYou can troubleshoot the code for an extension code by viewing the Lineblocs call monitor. To view the latest error logs generated from your extension code:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard go to [Call Monitor](https://app.lineblocs.com/#/dashboard/call-monitor)\r\n\r\n2. In the \"Flow\" field select, your flow\r\n\r\n3. Type in the extension code in the \"Dialing\" field\r\n\r\n\r\n\r\nIf you need more info on debugging, please have a look at the lineblocs debugging guide. [Debugging Lineblocs flows & Calls](https://linelocs.com/resources/other-topics/debugging-lineblocs)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','create-extension-codes'),(22,'2023-03-03 04:37:31','2023-03-27 22:06:55','Managing Media Files','','learn how to store WAV/MP3 media files on lineblocs as well as use them in lineblocs flows','',7,'managing, media files, media, cloud, google drive, lineblocs',1,'# Managing Media Files\r\n\r\n\r\n\r\nMedia files allow you to import new audio-related content from your personal device or an external source such as Google Drive.\r\n\r\n\r\n\r\nLineblocs media files can be used to host audio files that you may need to use in your call flows for voiceovers and other speech-related prompts.\r\n\r\n\r\n\r\nIn this guide we will discuss how you can upload and manage media files using Lineblocs.\r\n\r\n\r\n\r\n## Adding a Media File\r\n\r\n\r\n\r\nTo add a new media file:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, click \"Media Files\"\r\n\r\n2. Click     ![Add File](/img/frontend/docs/mediafiles/add-file.png) \r\n\r\n3. Select \"Upload File\"\r\n\r\n\r\n\r\n## Using Media File In Lineblocs\r\n\r\n\r\n\r\nTo use a media file in your Lineblocs flow, please click the the ![Copy URL](/img/frontend/docs/mediafiles/copy-url.png) button to get its public URL.\r\n\r\n\r\n\r\nYou can then use that URL in the Lineblocs editor.\r\n\r\n\r\n\r\n## Removing a file\r\n\r\n\r\n\r\nTo remove a media file, please click the ![Trash](/img/frontend/docs/shared/trash.png) icon next to the media file.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, please see the following:\r\n\r\n\r\n\r\n[Blocking A Number](https://lineblocs.com/resources/other-topics/blocking-a-number)\r\n\r\n\r\n\r\n[Create Extension Codes](https://lineblocs.com/resources/other-topics/create-extension-codes)\r\n\r\n','managing-mediafiles'),(23,'2023-03-03 04:38:27','2023-03-27 22:07:06','Debugging config deployment','','learn how to troubleshoot any issues with your Lineblocs configurations','',7,'config, lineblocs, debug',1,'# Debugging configs','debugging-config-deploy'),(24,'2023-03-03 04:39:08','2023-03-27 22:07:14','Extension security','','How to secure your Lineblocs extensions','',7,'lineblocs, extension, security',1,'# Extension Security\r\n\r\n\r\n\r\nComing soon..','extension-security'),(25,'2023-03-05 10:07:10','2023-03-27 22:07:41','Installing on CentOS 8','','learn how to install and setup lineblocs on centos','',8,'install, linux, centos 8, centos, lineblocs, pbx, asterisk, apache',1,'# CentOS install\r\n\r\n\r\n\r\n![lineblocs](/img/frontend/docs/install-centos8/CentOS-logo-vector-01.png)\r\n\r\n\r\n\r\nlineblocs open source is a free and fully featured cloud PBX supporting all the functionality of the lineblocs cloud version in addition to having a configuration suitable for those who prefer to run a PBX on their own servers.\r\n\r\n\r\n\r\nin this tutorial will be going over how to install lineblocs and its minimum requirements on a base CentOS 8 image. we will be going over the installation of asterisk and apache as well as how to configure the lineblocs web app and backend tools.\r\n\r\n\r\n\r\nby the end of this tutorial you should have a working lineblocs instance running as a linux service.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nyou will need to first update the centos 8 package manager (yum), install development tools and also disable SELinux. depending on how you installed centos this may or may not have already been done already. \r\n\r\n\r\n\r\nto update the package manager and disable SELinux please use the following steps below:\r\n\r\n\r\n\r\n1. update yum\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum -y update\r\n\r\n    ```\r\n\r\n\r\n\r\n2. install development tools\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum group install \"Development Tools\"\r\n\r\n    ```\r\n\r\n\r\n\r\n## disabling SELinux\r\n\r\n\r\n\r\n1. run command\r\n\r\n\r\n\r\n```\r\n\r\ncat /etc/selinux/config\r\n\r\n```\r\n\r\n\r\n\r\nif you don\'t see \"SELINUX=disabled\" please run the following command\r\n\r\n\r\n\r\n```\r\n\r\nsed -i \'s/SELINUX=.*/SELINUX=disabled/\' /etc/selinux/config\r\n\r\n```\r\n\r\n\r\n\r\nfollowed by a system reboot\r\n\r\n\r\n\r\n```\r\n\r\nreboot\r\n\r\n```\r\n\r\n\r\n\r\n## installing Lineblocs\r\n\r\n\r\n\r\nbelow we will go over how to install the base dependencies for lineblocs and then how you can run the lineblocs web installer to setup the database and configure lineblocs to work with apache and asterisk.\r\n\r\n\r\n\r\nlineblocs requires some dependencies to work. you will need to at the least install Apache 2.4, PHP 7 as well as Asterisk 16 and its dependencies. we will be installing and configuring Apache and PHP first followed by installing the base of asterisk and then setting up the networking and folder privileges required to make lineblocs run correctly.\r\n\r\n\r\n\r\nto install Apache and PHP you please use the following commands:\r\n\r\n\r\n\r\n1. install Apache HTTPD\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum install httpd\r\n\r\n    ```\r\n\r\n2. install PHP 7\r\n\r\n\r\n\r\n    we will be using the remi CentOS repo so we can install the recommended version of PHP (7.3) on our linux instance. To install PHP 7.3 on the CentOS please use the following steps:\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y update\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo yum -y install http://rpms.remirepo.net/enterprise/remi-release-8.rpm\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y install dnf-plugins-core\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf config-manager --set-enabled remi-php73\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf config-manager --set-enabled remi\r\n\r\n    ```\r\n\r\n    \r\n\r\n    ```\r\n\r\nsudo dnf module install php:remi-7.3\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf update\r\n\r\n    ```\r\n\r\n3. download and unzip lineblocs code in \"/var/www/html\"\r\n\r\n\r\n\r\n    ```\r\n\r\n    cd /var/www/html\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    wget http://get.lineblocs.com/lineblocs-0.0.1.zip\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    unzip lineblocs-0.0.1.zip\r\n\r\n    ```\r\n\r\n4. installing lineblocs base\r\n\r\n\r\n\r\n    ```\r\n\r\n    cd lineblocs\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    ./install_base.sh\r\n\r\n    ```\r\n\r\n\r\n\r\n# configuring MySQL\r\n\r\n\r\n\r\nduring the base installation you will need to setup MySQL. please make sure you leave the password blank and remove all remote logins, as well as reload all privilege tables.\r\n\r\n\r\n\r\n```\r\n\r\nEnter current password for root (enter for none):\r\n\r\n```\r\n\r\n\r\n\r\ndo not enter anything here\r\n\r\n\r\n\r\n```\r\n\r\nChange the root password? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"n\" to this\r\n\r\n\r\n\r\n```\r\n\r\nRemove anonymous users? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nDisallow root login remotely? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nRemove test database and access to it? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nReload privilege tables now? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\nonce the mariadb installation completes you will see some other dependencies being installed. be sure to let the installer run and install all the other dependencies. the asterisk configuration and installation should take 3-5 minutes to complete.\r\n\r\n\r\n\r\nthe installer will show the asterisk menuselect options once asterisk has been successfully configured. please select the default settings here and then use \"Save & Exit\".\r\n\r\n\r\n\r\n![asterisk](/img/frontend/docs/install-centos8/asterisk-menuselect.png)\r\n\r\n\r\n\r\nyou should then see asterisk continuing to build for some time followed by the installation script changing the folder permissions and networking setup according to lineblocs requirements.\r\n\r\n\r\n\r\nonce all of this is completed you should get a confirmation that the lineblocs base installation was completed successfully.\r\n\r\n\r\n\r\nyou can then continue to install lineblocs using the web installer.\r\n\r\n\r\n\r\n## Running the web Installer\r\n\r\n\r\n\r\nthe lineblocs web installer includes a set of steps that help you configure the database, and asterisk for usage with lineblocs. when you downloaded the lineblocs code the installer was also downloaded. to run the web installer please use the following command:\r\n\r\n\r\n\r\n```\r\n\r\n./start_web_installer.sh\r\n\r\n```\r\n\r\n\r\n\r\nyou will be then given an address to use in your browser. please go to the URL in your browser to complete the web installation.\r\n\r\n\r\n\r\n![step-1](/img/frontend/docs/install-centos8/step-1.png)\r\n\r\n\r\n\r\n### step 1 - requirements check\r\n\r\nlineblocs installer will try to check if the requirements for lineblocs are met. you should have a screen as shown below. all the requirements will need to match in order for lineblocs to be installed correctly. \r\n\r\n\r\n\r\n![step-2](/img/frontend/docs/install-centos8/step-2.png)\r\n\r\n\r\n\r\nif the requirements look ok please click \"Start Installation\"\r\n\r\n\r\n\r\n### step 2 - database configuration\r\n\r\nyou will need to setup a database for lineblocs to work correctly. at this point in the tutorial we have already installed mariadb server as well as have setup the root account with no password. you can use the root account to create a new database called \"lineblocs\" with a username/password of your choice. the new database user will be assigned to the lineblocs database and also used in the lineblocs backend.\r\n\r\n\r\n\r\nbelow is an example of how you might want to setup the database.\r\n\r\n![step-3](/img/frontend/docs/install-centos8/step-3.png)\r\n\r\n\r\n\r\n#### root account configuration\r\n\r\nthis sets up the main admin account you will use to login to the Lineblocs portal. this is also the main account or the \"super\" admin account that is given all permissions in the system.\r\n\r\n![step-4](/img/frontend/docs/install-centos8/step-4.png)\r\n\r\n\r\n\r\n### step 5 - Config Setup\r\n\r\nsome steps will be required to update the asterisk and Apache config to work with laravel. please follow steps below to complete Asterisk/Apache setup.\r\n\r\n![step-5](/img/frontend/docs/install-centos8/step-5.png)\r\n\r\n\r\n\r\n### step 6 - install as linux service\r\n\r\nin order to run the lineblocs backend you will need to install lineblocs as a linux service. please continue to follow steps as they are mentioned.\r\n\r\n![step-6](/img/frontend/docs/install-centos8/step-6.png)\r\n\r\n\r\n\r\nonce you have done this lineblocs should be installed and enabled as a systemd process. \r\n\r\n\r\n\r\nif you are having issues you you can verify lineblocs is running on the linux instance by using the command below:\r\n\r\n\r\n\r\n```\r\n\r\nps aux | grep \'lineblocs\'\r\n\r\n```\r\n\r\n\r\n\r\nyou should see output similar to the following:\r\n\r\n\r\n\r\n```\r\n\r\nroot     18665  0.0  5.4 1051036 46128 ?       Ssl  06:45   0:00 /usr/sbin/lineblocs\r\n\r\n```\r\n\r\n\r\n\r\nif you don\'t see this output you can check the combined.log and error.log of lineblocs in \"/var/log/lineblocs\"\r\n\r\n\r\n\r\n```\r\n\r\ncat /var/log/lineblocs/error.log\r\n\r\n```\r\n\r\n\r\n\r\nthis file should include any helpful info into debugging the problem.\r\n\r\n\r\n\r\nyou can also re-run the web installer by using the shell script included in the lineblocs distribution ```prune_installer_data.sh``` followed by running ```start_web_installer.sh``` again\r\n\r\n\r\n\r\n```\r\n\r\n./prune_installer_data.sh\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\n./start_web_installer.sh\r\n\r\n```\r\n\r\n\r\n\r\n### step 7 - completing installation\r\n\r\nonce the installation and configuration is done you should be shown a message as seen below.\r\n\r\n![step-7](/img/frontend/docs/install-centos8/step-8.png)\r\n\r\n\r\n\r\n## logging in the first time\r\n\r\nbe sure to follow the login link given in step 7 to login to lineblocs. you will need to use the account login you setup as the super admin to login.\r\n\r\n![step-7](/img/frontend/docs/install-centos8/logging-in.png)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nthis tutorial went over how to install lineblocs open source edition. for related articles be sure to check out the following.\r\n\r\n\r\n\r\n[Creating Trunks](https://lineblocs.com/resources/open-source/creating-trunks)\r\n\r\n\r\n\r\n[Working with routes](https://lineblocs.com/resources/open-source/working-with-routes)\r\n\r\n\r\n\r\n[Setup Open Source Extension](https://lineblocs.com/resources/open-source/setup-extension)','install-centos8'),(26,'2023-03-05 10:17:47','2023-03-27 22:07:48','Creating Trunks','','how to setup and manage SIP trunks in lineblocs','',8,'trunks, setup trunk, SIP, asterisk, open source, lineblocs',1,'# Coming Soon','creating-trunks'),(27,'2023-03-05 10:18:30','2023-03-27 22:07:56','Working With Routes','','how to create and manage routes in lineblocs open source','',8,'routes, manage routes, SIP, asterisk, open source, lineblocs',1,'# Coming Soon','working-with-routes'),(28,'2023-03-05 11:07:46','2023-03-27 22:08:04','Setup Extension','','how to setup extensions using open source lineblocs edition','',8,'extensions, setup, lineblocs, open source',1,'# Coming Soon','setup-extension'),(29,'2023-03-08 06:03:34','2023-03-27 22:37:19','Create a call forwarding','','learn how to create a simple call forward flow.','',3,'call forward, PBX, lineblocs, drag and drop',1,'# Call Forwarding\r\n\r\n\r\n\r\nLineblocs editors allow you to create call flows for basic and advanced call forwarding needs.\r\n\r\n\r\n\r\nThis guide will show you how to forward a call to a external phone number using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to start forwarding calls using lineblocs:\r\n\r\n\r\n\r\n1. a DID Number\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n## Creating call forward\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Call Forward\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Edit call forwarding number\r\n\r\n\r\n\r\nTo change the number you want to forward to please click the \"ForwardBridge\" then update the \"Number To Call\" option.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/forward/forward-opts.png)\r\n\r\n\r\n\r\n## Change Caller ID\r\n\r\n\r\n\r\nBy default the caller ID will show the caller\'s caller ID. If you want to use a custom caller ID instead you can change the \"Caller ID\" option.\r\n\r\n\r\n\r\n![Caller ID](/img/frontend/docs/forward/caller-id.png)\r\n\r\n\r\n\r\n## Record Forwarded Calls\r\n\r\n\r\n\r\nTo record your forwarded calls please check the \"Do Record\" option.\r\n\r\n\r\n\r\n![do record](/img/frontend/docs/pinless-conference/do-record.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour calls should be now forwarded to the number you specified along with the Caller ID you set.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we discussed setting up a simple call forward. for more advanced configurations please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','call-forward'),(30,'2023-03-08 06:04:23','2023-03-27 22:01:59','Setup a basic 3 option IVR','','get more in depth and learn how to create IVRs','',3,'IVR setup, drag and drop, PBX',1,'# Basic IVR\r\n\r\n\r\n\r\nIVRs are very simple to the provision in Lineblocs. This guide will go over how to create a simple three-option IVR that allows your callers to choose which department they wish to route their call to.\r\n\r\n\r\n\r\n## Requirements\r\n\r\nYou will need the following items to begin creating IVRs:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. Lineblocs account\r\n\r\n3. A non trial membership\r\n\r\n\r\n\r\n## Creating an IVR\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. use template \"Simple IVR\"\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Editing the IVR auto attendant\r\n\r\n\r\n\r\nBy default, the Basic IVR template is configured with an auto-attendant, using the default settings. You may want to customize the auto attendant options based on your needs.\r\n\r\n\r\n\r\nTo update your IVR\'s auto attendant, please click the \"ProcessInput\" widget to bring up its sidebar options.\r\n\r\n\r\n\r\nIn the settings, you have the option to playback text-to-speech or a media file. You can also adjust settings like the maximum digits to gather or the terminating digit. \r\n\r\n\r\n\r\nIf you need more info on any of these settings, you can hover over the info icon to the right of the field.\r\n\r\n\r\n\r\n![process input](/img/frontend/docs/basic-ivr/process-input.png)\r\n\r\n\r\n\r\n## Routing to departments\r\n\r\n\r\n\r\nThe Basic IVR template is set up to route to 3 bridges based on user input. Option 1 routing to Support, 2 routes to Sales, and 3 will route to an operator. \r\n\r\n\r\n\r\nIf you want to change the default setup, you can update the \"Links\" tab in your \"Switch\" cell. To open the \"Links\" settings, please click the \"Switch\" cell then, click the \"Links\" tab.\r\n\r\n\r\n\r\n## Editing the call bridges\r\n\r\n\r\n\r\nIn the Basic IVR example, we have set up 3 bridge widgets \"SupportBridge,\" \"SalesBridge,\" and \"OperatorBridge.\" Each of these widgets forward to its extension.\r\n\r\n\r\n\r\nTo edit the extension these widgets forward to, please click the widget you want to update, then change the \"Extension To Call\" option.\r\n\r\n\r\n\r\n![process input](/img/frontend/docs/basic-ivr/ext-to-call.png)\r\n\r\n\r\n\r\nYour flow should now look similar to the following image:\r\n\r\n![Basic IVR example](/img/frontend/docs/basic-ivr/main.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use the IVR on one of your DIDs:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYou should now be able to hear your IVR in action! When you call your DID number, your calls should be answered by your auto-attendant greeting as well as a route to your departments.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we went over how to set up an IVR. For other related guides, be sure to view the following:\r\n\r\n\r\n\r\n[Recordings and Voicemail](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','basic-ivr'),(31,'2023-03-08 06:05:26','2023-03-27 22:13:43','Integrate Recordings','','stay in touch with your callers by adding voicemail','',3,'voicemail, recordings, manage recordings, lineblocs',1,'# Recordings And Voicemail\r\n\r\n\r\n\r\nRecording voicemail is a simple yet beneficial component of a phone system. \r\n\r\n\r\n\r\nThis guide will go over how to create a workflow that allows your callers to record voicemail messages when you are unavailable and play them when you are available. \r\n\r\n\r\n\r\n\r\n\r\n## Creating a voicemail flow\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Use template \"Voicemail Example\"\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup forwarding\r\n\r\n\r\n\r\nThe sample \"Voicemail Example\" flow is set up to forward to an extension, and based on the receiving side; the call not being answered will redirect it to voicemail.\r\n\r\n\r\n\r\nFor the voicemail recorder to work, you will need to set up the \"ForwardBridge,\" which will let you set the extension to forward to before routing to voicemail. \r\n\r\n\r\n\r\nTo edit your forwarding options, please click the \"ForwardBridge\" widget, then edit the \"Extension To Call\" field.\r\n\r\n\r\n\r\n![Basic IVR example](/img/frontend/docs/voicemail/ext-to-call.png)\r\n\r\n\r\n\r\n## Setup recording options\r\n\r\n\r\n\r\nMost voicemail recorders begin with a prompt and allow the caller to record a message until the caller either presses a terminating key, hangs up, or a noticeable silence condition is met. \r\n\r\n\r\n\r\nTo modify the options for your recording, please click the \"RecordingVoicemail\" cell.\r\n\r\n\r\n\r\n![record options](/img/frontend/docs/voicemail/record-options.png)\r\n\r\n\r\n\r\n## Setup voicemail on a DID\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use the voicemail flow on a DID number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n\r\n\r\n## Viewing Recordings\r\n\r\n\r\n\r\nYou can view a history of voicemail in your dashboard at any time. You can also sort or filter voicemails received in the past, as well as download the MP3 files. \r\n\r\n\r\n\r\nTo view a history of your voicemail recordings, please go to the [Recordings Page](https://app.lineblocs.com/#/recordings).\r\n\r\n\r\n\r\n## Deleting Recordings\r\n\r\n\r\n\r\nTo delete recordings, please click the \"Delete\" button next to the voicemail item in [Recordings Page](https://app.lineblocs.com/#/recordings).\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nThis guide went over recordings and voicemail. For related guides be sure to view the following:\r\n\r\n\r\n\r\n[Call Forward](https://lineblocs.com/resources/quickstarts/call-forward)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','recordings-and-voicemail'),(32,'2023-03-08 06:06:24','2023-03-27 22:02:17','Setup Call Queues','','create call queues to better manage your incoming call flow.','',3,'calls, queues, queue, incoming, lineblocs',1,'# Call Queues\r\n\r\n\r\n\r\nCall queues can allow you receive multiple calls simultaneously. A well-designed call queue can also provide a smooth experience for a long wait time for a call.\r\n\r\n\r\n\r\nIn this guide, we will be creating a primary call queue using the Lineblocs flow editor. The call queue will be assigned to all our extensions and set up with basic options. \r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard), click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select the \"Queue Example\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n\r\n\r\n## Add Extensions\r\n\r\n\r\n\r\nBy default, the call queue will be set up with no extensions. You can add extensions to your queue by adjusting the Queue\'s widget options.\r\n\r\n\r\n\r\nTo update the widget extensions settings for your queue, please click the \"SupportQueue\" to open its options, then select the extensions you would like to include in the \"Select Extensions\" field.\r\n\r\n\r\n\r\n![Call Queues example](/img/frontend/docs/call-queue/extension-select.png)\r\n\r\n\r\n\r\n## Max Queue Wait Time\r\n\r\n\r\n\r\nMaximum queue wait time allows you to adjust how long a caller can wait in the call queue before either terminating the call or going to an alternate destination.\r\n\r\n\r\n\r\nBy default, the maximum queue wait time is set to 60 seconds.\r\n\r\n\r\n\r\nTo change the maximum wait time for the queue, please update the \"Max Wait Time\" option.\r\n\r\n\r\n\r\n![Queue Max Timeout](/img/frontend/docs/call-queue/queue-max-wait.png)\r\n\r\n\r\n\r\n## Max Extension Timeout\r\n\r\n\r\n\r\nTo update how long you want to ring an agent\'s phone, you can update the \"Max Extension Timeout\" option.\r\n\r\n\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/call-queue/queue-max-ext-timeout.png)\r\n\r\n\r\n\r\n## Music On Hold\r\n\r\n\r\n\r\nBy default, all call queues will play music on hold while the caller waits for an agent to answer the call. \r\n\r\n\r\n\r\nMusic On Hold will be played recurringly -- until the caller hangs up, an agent picks up a call, or the maximum queue wait time elapses.\r\n\r\n\r\n\r\nYou can customize the music you play in your queue updating, the \"Music On Hold URL\" setting in the widget settings box. \r\n\r\n\r\n\r\n## End Result\r\n\r\n\r\n\r\nAfter you have made your changes, your flow should now look similar to the following image:\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/call-queue/main.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour callers should now be placed in a queue with music on hold when they call your number. And your extensions will receive calls from the queue in the order they came in.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up call queues on Lineblocs. for other related quickstart posts, be sure to view the following:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','call-queues'),(33,'2023-03-08 06:07:31','2023-03-27 22:02:27','Setup a Pin Conference','','create a basic pin conference using lineblocs','',3,'calls, pin, conferencing, conference, lineblocs',1,'# Create A Pinned Conference\r\n\r\n\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/pinned-conference/pinned-conference.png)\r\n\r\n\r\n\r\nPinned conferences allow you to create discussion rooms you and your team can access on demand.\r\n\r\nA basic pin conference usually includes an assigned number and a set of access pins your team members can use to access the conferencing room.\r\n\r\n\r\n\r\nIn Lineblocs you can fully create basic and advanced pinned conferences as well as customize conferencing workflows as per your needs. \r\n\r\n\r\n\r\nIn this tutorial we will go over how to create a basic pin based conference using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Pin Conference\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Add Pin Numbers\r\n\r\n\r\n\r\nBy default, the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 participants maximum on the call at any given time.\r\n\r\n\r\n\r\nTo update settings for your conference please open the “PinConference” widget.\r\n\r\n\r\n\r\n![Pin Access](/img/frontend/docs/pinned-conference/pin-access.png)\r\n\r\n\r\n\r\n![Pin Access 2](/img/frontend/docs/pinned-conference/pin-access-2.png)\r\n\r\n\r\n\r\n## Conference Settings\r\n\r\n\r\n\r\nBy default the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 max participants on the call at any given time.\r\n\r\n\r\n\r\nTo update settings for your conference please open the PinConference widget.\r\n\r\n\r\n\r\n![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)\r\n\r\n\r\n\r\n#### Moderator Access\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/moderator.png)\r\n\r\n\r\n\r\n#### Notifications\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-1.png)\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-2.png)\r\n\r\n\r\n\r\n#### Speech Detection\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/speech.png)\r\n\r\n\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour team members should now be able to join conference calls using your DID number. To test your conference as a moderator or a user you can call the DID number you setup the conference flow on.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nin this guide we discussed setting up pin-based conference. for other related quickstart posts please see guides below:\r\n\r\n\r\n\r\n[Call Queues](https://lineblocs.com/resources/quickstarts/call-queues)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','pin-conference'),(34,'2023-03-08 06:09:00','2023-03-27 22:02:36','Create a Pinless Conference','','create a basic pinless conference using lineblocs','',3,'calls, pinless, conferencing, conference, linebloc',1,'# Create A Pinless Conference\r\n\r\n\r\n\r\n![Pinless Conference](/img/frontend/docs/pinless-conference/main.png)\r\n\r\n\r\n\r\nPinless conferences allow you to create discussion rooms you and your team can access on demand.\r\n\r\nA basic pinless conference usually includes a dial-in phone number and a set of assigned attendee numbers.\r\n\r\n\r\n\r\nIn Lineblocs you can entirely create basic and advanced pinless conferences as well as customize pinless conferencing workflows as per your needs\r\n\r\n\r\n\r\nThis tutorial will go over how to create a basic pinless conference using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select the \"Pin Conference\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup Attendees\r\n\r\n\r\n\r\nBy default, the conference will be set up with no attendee numbers that can call into the conference.\r\n\r\n\r\n\r\nYou can change the numbers your moderator and users will be using to join your conference by updating the access numbers used for your meeting.\r\n\r\n\r\n\r\nTo view your access numbers, please click the \"SetupAttendees\" to bring up its options.\r\n\r\n\r\n\r\n![Access Numbers](/img/frontend/docs/pinless-conference/access-numbers.png)\r\n\r\n\r\n\r\n## Conference Settings\r\n\r\n\r\n\r\nTo update settings for your conference please open the \"PinlessConference\" widget.\r\n\r\n\r\n\r\n![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)\r\n\r\n\r\n\r\n#### Moderator Access\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/moderator.png)\r\n\r\n\r\n\r\n#### Notifications\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-1.png)\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-2.png)\r\n\r\n\r\n\r\n#### Speech Detection\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/speech.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nto save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing\r\n\r\n\r\n\r\nYour team members should now be able to join conference calls using your DID number. To test your conference, you can call your DID number using a moderator or user caller ID.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up a pinless-based conference. For other related quickstart posts, please see guides below:\r\n\r\n\r\n\r\n[Setup Pin Conference](https://lineblocs.com/resources/quickstarts/pin-conference)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','pinless-conference'),(35,'2023-03-08 06:10:00','2023-03-27 22:02:45','Setup an extension','','learn how to provision an extension for use with a softphone or supported hard phone','',3,'extension setup, microsip, lineblocs, softphone, hardphone',1,'# Setup Extension\r\n\r\n\r\n\r\nA Lineblocs extension allows you to route calls to a softphone or hard phone.\r\n\r\n\r\n\r\nExtensions can be created and managed using the Lineblocs dashboard. You can provide new extensions on-demand, as well as update an Extension\'s default Caller ID and other settings.\r\n\r\n\r\n\r\n## Create Extension\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard click \"Create\" -> \"New Extension\"\r\n\r\n2. Enter a username for your extension\r\n\r\n3. Enter a Caller ID\r\n\r\n4. Enter a Secret\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\n## Connecting\r\n\r\n\r\n\r\nTo get the information to connect to your extension using a softphone or supported hard phone, please go to[Extensions](https://app.lineblocs.com/#/extensions) page, then click the info bubble ![info](/img/frontend/docs/create-extensions/info-bubble.png) next to the extension you want to connect to.\r\n\r\n\r\n\r\n![connect](/img/frontend/docs/create-extensions/connect-2.png)\r\n\r\n\r\n\r\n## Managing Extensions\r\n\r\n\r\n\r\nYou can edit or delete your extension at any time. \r\n\r\n\r\n\r\nTo edit an extension:\r\n\r\n\r\n\r\nClick the \"Edit\" button next to the extension you want to edit.\r\n\r\n\r\n\r\nTo delete an extension:\r\n\r\n\r\n\r\nPlease click the \"Delete\" button next to the Extension you want to remove.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we went over how to create and connect to extensions. For related posts, be sure to view:\r\n\r\n\r\n\r\n[Extension security best practice](https://lineblocs.com/resources/other-topics/extension-security)\r\n\r\n\r\n\r\n[Avoiding call spam](https://lineblocs.com/resources/other-topics/report-spam)','setup-extension'),(36,'2023-03-08 06:11:15','2023-03-27 22:09:37','Call Screening','','learn how to create call screenings using Lineblocs','',3,'call screening, screening, call, lineblocs, voip, call whisper, whisper',1,'# Call Screening\r\n\r\n\r\n\r\nAt a high level, call screenings allow your agents to accept calls based on various call-related details such as a Caller ID, calling department, and more. \r\n\r\n\r\n\r\nBasic call screenings can be used to avoid spam and notify agents of caller details. In more advanced cases you could use call screenings to allow your callers to record a greeting message or allow your agents to listen to a message being recorded on an answering machine.\r\n\r\n\r\n\r\nIn this guide we will setup a basic call screening that tells your agent what Caller ID an incoming call is coming from.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. a Lineblocs DID \r\n\r\n2. Extension\r\n\r\n\r\n\r\n## Creating call whisper\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Call Screening\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Edit screening extension\r\n\r\n\r\n\r\nto change the extension you want to forward call screenings to please click the \"DialAgent\" then update the \"Extension To Call\" option.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/screening/forward-opts.png)\r\n\r\n\r\n\r\n## Change screening message\r\n\r\n\r\n\r\nby default we play back a screening message that includes the Caller ID of the originating call.\r\n\r\n\r\n\r\nif you want to update the default greeting, please click the \"CallScreening\" widget then edit the \"Text To Say\" field.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/screening/screen-opts.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nto save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour agents should now be able to screen calls as per your workflow. To test the call flow please call your DID number.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nin this guide we discussed setting up a simple call screening. for more advanced configurations please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Cold Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)','call-screening'),(37,'2023-03-08 06:12:39','2023-03-27 22:03:01','Using macros to check for business hours','','learn how to use lineblocs macros to customize your call flows using typescript code.','',3,'lineblocs, macros, macro, business hours, hours, business',1,'# Business Hours Check using Macros\r\n\r\n\r\n\r\n![Call Queues example](/img/frontend/docs/macros/business-hours.png)\r\n\r\n\r\n\r\nLineblocs macros allow you to further customize your call flows using the TypeScript language.\r\n\r\n\r\n\r\nUsing Lineblocs macros, you can create high-level integrations that include tasks such as sending a lead to a CRM or sending out an email using an API.\r\n\r\n\r\n\r\nIn this example, we will set up a call flow that uses a macro to check for local business hours before forwarding a call to an agent.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n##  Setup Workspace\r\n\r\n\r\n\r\nWe will first bootstrap our workspace with some timezone values to later route our calls according to the correct timezone.\r\n\r\n\r\n\r\nTo access the workspace params screen; in [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Settings\" -> \"Workspace Params\"\r\n\r\n\r\n\r\nTo add a timezone workspace param, please click \"Add Param.\" In the key field, use \"timezone,\" then use any valid timezone name in the value field. For example, \"America/Toronto.\". \r\n\r\n\r\n\r\nTo see a full list of time zones, please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).\r\n\r\n\r\n\r\n#### Workspace Params\r\n\r\n\r\n\r\nYour workspace params screen should now look like the following image:\r\n\r\n![Workspace Params](/img/frontend/docs/macros/workspace-params.png)\r\n\r\n\r\n\r\n## Create flow\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter name \"Business Hours Check\"\r\n\r\n3. Select \"Call Forward\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Adding a Macro\r\n\r\n\r\n\r\nTo add a new macro please drag the \"Macro\" widget from the right pane into the flow graph.\r\n\r\n\r\n\r\n![Macro](/img/frontend/docs/macros/macro.png)\r\n\r\n\r\n\r\n![Macro Added](/img/frontend/docs/macros/macro-added.png)\r\n\r\n\r\n\r\n## Updating Macro\r\n\r\n\r\n\r\nTo edit your macro\'s function, please click the \"Macro\" widget, and then click![Create Function](/img/frontend/docs/macros/create-function.png) in the right pane.\r\n\r\n\r\n\r\nIn the template selection screen, choose template \"Business Hours Check,\" then click \"Save.\"\r\n\r\n\r\n\r\n## Set Macro Defaults\r\n\r\n\r\n\r\nBy default the macro will be setup to forward calls from 9AM-5PM Monday to Friday. To confirm these defaults, please click \"Save\".\r\n\r\n\r\n\r\n## Saving Macro\r\n\r\n\r\n\r\nLastly, for the macro\'s function, you will be shown a code editor screen with the Macro\'s function. \r\n\r\n\r\n\r\nPlease click \"Save\" on this screen, then give your macro a title such as \"business-hours.\"\r\n\r\n\r\n\r\n![Save Macro](/img/frontend/docs/macros/save-macro.png)\r\n\r\n\r\n\r\n## Add a Playback widget\r\n\r\n\r\n\r\nWe will need to add a playback widget to play a message when our time condition is not satisfied. \r\n\r\n\r\n\r\nTo add a playback widget for when your office is closed, please drag a \"Playback\" widget from the right pane into the flow editor.\r\n\r\n\r\n\r\nIn the Playback widget, please use the following settings:\r\n\r\n\r\n\r\n```\r\n\r\nWidget Name: ClosedMessagePlayback\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nPlayback Type: Say\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nText To Say: Our office is currently closed, please call us again from Monday to Friday 9 AM to 5 PM eastern time.\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nLanguage: en-US\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nGender: FEMALE\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nVoice: en-US-Standard-C\r\n\r\n```\r\n\r\n\r\n\r\n## Add Switch widget\r\n\r\n\r\n\r\nWe will add a \"Switch\" widget to test for our time condition and go to the correct widget. \r\n\r\n\r\n\r\nTo add a \"Switch\" widget, please drag a new \"Switch\" widget into the flow graph. Rename this widget into \"HoursSwitch,\" then change the \"Variable to test\" to Macro.result.\r\n\r\n\r\n\r\n![Select Macro](/img/frontend/docs/macros/switch-widget-options.png)\r\n\r\n\r\n\r\n## Updating Switch Links\r\n\r\n\r\n\r\nPlease go to the \"Links\" tab of the \"HoursSwitch\" widget and add the following 2 links\r\n\r\n\r\n\r\n### Link 1\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: open\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCell to link: ForwardBridge\r\n\r\n```\r\n\r\n\r\n\r\n### Link 2\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: closed\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCell to link: ClosedMessagePlayback\r\n\r\n```\r\n\r\n\r\n\r\nThe \"HoursSwitch\" link section should now look like the following:\r\n\r\n![Select Macro](/img/frontend/docs/macros/switch-links.png)\r\n\r\n\r\n\r\n## Connecting the Links\r\n\r\n\r\n\r\nNext, we will need to update the flow to use our widgets.\r\n\r\n\r\n\r\nTo make adjustments to your flow so that all of the widgets are working correctly. You will need to connect the \"Incoming Call\" port from the Launch widget into the Macro\'s \"In\" port and add a link from widget Macro\'s \"Completed\" port into the HoursSwitch\'s \"In\" port.\r\n\r\n\r\n\r\nBelow is an example of how the final flow should look like:\r\n\r\n![Select Macro](/img/frontend/docs/macros/flow-updated.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYou should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable, and they will be forwarded to you during your business hours.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up macros on lineblocs. For other related quickstart posts, please see the guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','business-hours-with-custom-macros'),(38,'2023-03-08 06:13:26','2023-03-27 22:03:08','Create a cold transfer','','learn how to use extension codes to make on call transfers between extensions','',3,'lineblocs, cold transfer, cold, transfer, pbx, transfers',1,'# Create A Cold Transfer\r\n\r\n\r\n\r\n![Cold Transfer](/img/frontend/docs/cold-transfer/main.jpg)\r\n\r\n\r\n\r\nLineblocs flow editor lets you programmatically create workflows for call transfers. A common type of call transfer is a cold transfer which transfers a call from one endpoint to another.\r\n\r\n\r\n\r\nCold transfers can usually be integrated into a PBX. Most widely used PBX systems can be used to transfer calls between extensions by using dialing codes or feature codes.\r\n\r\n\r\n\r\nIn this tutorial, we will walk you through the setup of a cold transfer using two extensions, one extension code, and a custom Lineblocs flow.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nTo create a new Lineblocs flow for your cold transfer, you need to follow these steps:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select template \"Cold Transfer\" under Extension Codes\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Creating an Extension Code\r\n\r\n\r\n\r\nTo create an extension code for your cold transfers, you need to follow these steps:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Settings\" -> \"Extension Codes\"\r\n\r\n2. click \"Add Code\"\r\n\r\n3. in field \"Name\" use \"Cold Transfer\"\r\n\r\n4. in field \"Code\" use \"*72\"\r\n\r\n5. in field \"Flow\" use the \"Cold Transfer\" flow you created earlier\r\n\r\n\r\n\r\n![Extension Codes Info](/img/frontend/docs/cold-transfer/ext-codes-info.png)\r\n\r\n\r\n\r\n## Creating Extensions\r\n\r\n\r\n\r\nTo do a cold transfer between two extensions, we will need to create new extensions on our account. \r\n\r\n\r\n\r\nPlease follow steps in this post [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension) to create two new extensions.\r\n\r\n\r\n\r\nBelow is an example of how you may want to setup extension 1000 and 1001.\r\n\r\n\r\n\r\n### Extension 1000\r\n\r\n\r\n\r\n```\r\n\r\nUsername: 1000\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSecret: your-strong-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCaller ID: 1000\r\n\r\n```\r\n\r\n\r\n\r\n### Extension 1001\r\n\r\n\r\n\r\n```\r\n\r\nUsername: 1001\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSecret: your-strong-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCaller ID: 1001\r\n\r\n```\r\n\r\n\r\n\r\n## Registering a DID\r\n\r\n\r\n\r\nThe final piece to get our flow, extension code, and inbound call routing work is registering a DID or using an existing one if you have already registered a DID.\r\n\r\n\r\n\r\nOur DID will be used by outside callers that will need to place calls and speak to extension 1000 or 1001. \r\n\r\n\r\n\r\nWe will register a DID and setup a call forward workflow so that extension 1000 can receive calls directly from our DID, and then forward them to 1001 using our newly created extension code.\r\n\r\n\r\n\r\nTo learn more about registering DIDs please refer to [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension)\r\n\r\n\r\n\r\nTo learn how to create a call transfer flow, please read this post: [Call Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)\r\n\r\n\r\n\r\n## Testing Cold Transfer\r\n\r\n\r\n\r\nYou can test the cold transfer by logging into extension \"1000\" and having a peer login to \"1001\". \r\n\r\n\r\n\r\nWhen you receive calls on your DID they should be forwarded to \"1000\" you can press *72, and you will be redirected to an auto-attendant that will ask you the extension number you want to transfer the call to. You can then dial 1001 to complete the call transfer.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we discussed setting up cold transfers on Lineblocs. For other related quickstart posts please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','create-cold-transfer'),(39,'2023-03-08 06:14:57','2023-03-27 22:03:26','Saving widget templates','','learn how to save a widget as a template for later use','',3,'lineblocs, widget, template, save widget, SIP, PBX',1,'# Widget Templates\r\n\r\n\r\n\r\nLineblocs widget templates allow you to save and reuse widget settings across multiple Lineblocs flows. \r\n\r\n\r\n\r\nWidget templates can be used to avoid having to create a widget more than once as well as to tag and customize widgets based on your needs.\r\n\r\n\r\n\r\nIn this tutorial, we will go over how you can save widget templates, to reuse them across new Lineblocs flows.\r\n\r\n\r\n\r\n## Save Widget\r\n\r\n\r\n\r\nTo save a widget as a template:\r\n\r\n\r\n\r\n1. In [Lineblocs Flow Editor](https://app.lineblocs.com/#/flows/new) click a widget\r\n\r\n2. Click the     ![Save widget](/img/frontend/docs/widget-templates/save.png) button.\r\n\r\n3. Enter a widget title\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Using Widget Template\r\n\r\n\r\n\r\n1. To use the widget template, click     ![Library](/img/frontend/docs/widget-templates/library.png) tab in the widget main menu.\r\n\r\n2. Drag library widget into the flow graph                                   \r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed how you could save a widget as a template. For more related articles, please see:\r\n\r\n\r\n\r\n[Create a cold transfer](https://lineblocs.com/resources/quickstarts/setup-cold-transfers)\r\n\r\n\r\n\r\n[Setup Macro for Business Hours](https://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)','saving-widget-templates'),(40,'2023-03-08 06:15:48','2023-03-27 22:03:35','Provisioning A GXP2160','','learn how to use Lineblocs to provision Grandstream GXP21XX series phones','',3,'lineblocs, grandstream, gxp21xx, gxp2160, GXP, pbx, cloud, sip',1,'# Provision Grandstream GXP2160\r\n\r\n\r\n\r\nLineblocs Phone Provisioner allows you to manage global and individual phone configurations fully.\r\n\r\n\r\n\r\nThis guide will go over how to use the Lineblocs provisioning server to manage and update a Grandstream GXP2160\'s SIP configuration.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nTo complete this guide, you will need the following items:\r\n\r\n\r\n\r\n1. Grandstream GXP2160\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n## Configuring GXP2160\r\n\r\n\r\n\r\nWe will first need to update our Grandstream GXP2160\'s \"Config Server Path\" to configure our phones with Lineblocs. This can be done in one of the following ways:\r\n\r\n\r\n\r\n1. Use DHCP option 66\r\n\r\n2. Update the \"Config Server Path\" in the Grandstream web GUI\r\n\r\n\r\n\r\nIn this guide, we will be updating the URL directly in the phone\'s web GUI.\r\n\r\n\r\n\r\nTo update your Config Server Path URL:\r\n\r\n\r\n\r\n1. Boot on your GXP2160\r\n\r\n2. On your phone LCD screen, go to Status -> Network Status\r\n\r\n3. Open the \"IPv4 Address\" value in a browser\r\n\r\n\r\n\r\nYou will then need to login to your Grandstream control panel. \r\n\r\n\r\n\r\nIf this is a new phone, you can login to your Grandstream Admin with username: admin and password: admin.\r\n\r\n\r\n\r\n## Changing Provisioning Path\r\n\r\n\r\n\r\nTo change your Provisioning Path, please go to the \"Maintenance -> Upgrade and Provisioning\" section, then please set your \"Config Server Path\" to:\r\n\r\n\r\n\r\n```\r\n\r\nprv.lineblocs.com\r\n\r\n```\r\n\r\n\r\n\r\nOnce you are done, please save all changes. \r\n\r\n\r\n\r\nYour Grandstream GXP2160 should now be setup to fetch its configuration from the Lineblocs provisioning server.\r\n\r\n\r\n\r\n## Creating a Phone in Lineblocs\r\n\r\n\r\n\r\nTo create a new phone in Lineblocs:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Provisioning\" -> \"Phones\"\r\n\r\n2. In the top right, click \"Create New\"\r\n\r\n\r\n\r\nOn the create screen, you will need to provide a name for your phone, a MAC address, and optionally a group.\r\n\r\n\r\n\r\nBelow is an example of how you may want to set up your phone:\r\n\r\n\r\n\r\n```\r\n\r\nName: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nMAC Address: 0A:0B:0C:0D:0E:0F\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nModel: Grandstream GXP2160\r\n\r\n```\r\n\r\n\r\n\r\n## Creating a Global Template\r\n\r\n\r\n\r\nFor our phone to register and fetch its configuration details such as its Extension #, SIP Server URL, and other GXP21XX related settings, we will need to create a \"Global Template.\". \r\n\r\n\r\n\r\nTo setup a global template, please go to the [Provisioning -> Global Templates](https://app.lineblocs.com/#/provision/global-settings) section in Lineblocs dashboard.\r\n\r\n\r\n\r\nOn the Global Templates page please click \"Add Global Settings.\"\r\n\r\n\r\n\r\nPlease create a template with the following details:\r\n\r\n\r\n\r\n```\r\n\r\nModel: Grandstream GXP2160\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nGroup: (None)\r\n\r\n```\r\n\r\n\r\n\r\n## Updating Account 1\r\n\r\n\r\n\r\nTo edit the global template\'s Account 1 SIP Server and Extension number, click the ![Grandstream Templates](/img/frontend/docs/provision-gxp2160/global-templates-link.png) link.\r\n\r\n\r\n\r\nIn the General Settings page, please add the following settings:\r\n\r\n\r\n\r\n```\r\n\r\nAccount Active?: Yes\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAccount Name: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSIP Server: {your-workspace-lineblocs-username}.lineblocs.com\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSIP User ID: your-ext-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAuth ID: your-ext-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAuth Password: your-ext-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nVoicemail UserID: *98\r\n\r\n```\r\n\r\n\r\n\r\nPlease save all changes once you are complete.\r\n\r\n\r\n\r\n## Deploying Config\r\n\r\n\r\n\r\nYour phone is now ready to fetch its configuration from Lineblocs.\r\n\r\n\r\n\r\nTo check the status of your deployment, please go to [\"Provision\" -> \"Deploy Now\"](https://app.lineblocs.com/#/provision/deploy).\r\n\r\n\r\n\r\nYou should see that there is \"1\" phone pending provision on this page.\r\n\r\n\r\n\r\nTo deploy your config, please click \"Begin Deployment\"\r\n\r\n\r\n\r\n![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy.png)\r\n\r\n\r\n\r\nUpon completion of the settings, the configurations should be deployed and you should get a success message with instructions to complete the deployment process.\r\n\r\n\r\n\r\n![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy-complete.png)\r\n\r\n\r\n\r\n## Testing\r\n\r\n\r\n\r\nOnce your GXP2160 has been restarted, it should be successfully registered to Lineblocs, and you should be able to make/receive calls! \r\n\r\n\r\n\r\nFor tips on troubleshooting, please read article [Debugging Config Deployment](https://lineblocs.com/resources/other-topics/debugging-config-deploy)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed how to provide a Grandstream GXP2160 in Lineblocs phone provisioner. For related articles, be sure to check out the following posts:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','provision-grandstream-gxp2160'),(41,'2023-03-08 06:17:00','2023-03-27 22:12:13','Reference Integration: ExecLine conferencing','','learn how to create a complex small business conferencing workflow using lineblocs','',3,'lineblocs, conference, execline, conferencing, advanced, pbx',1,'# Reference Integration: ExecLine Conferencing\r\n\r\n\r\n\r\nComplex conferencing workflows allow you to communicate with multiple end-users on demand. Advanced conference workflows can be integrated to work with third-party apps, web services, and APIs. Using modern CPaaS, you can design and develop unique conferencing apps that provide your callers with a stellar conferencing experience.\r\n\r\n\r\n\r\nIn this tutorial, we will be looking at an advanced reference integration of a conferencing line for a small business owner.\r\n\r\n\r\n\r\nThe conference will include two user types:\r\n\r\n\r\n\r\n1. Host                                                                                     \r\n\r\nA.K.A our small business owner who will be managing the conference line.\r\n\r\n2. Member                                                                                      \r\n\r\n\r\n\r\nIn our example conference, members will call into our conference line to speak with our host regarding some services. \r\n\r\n\r\n\r\n## How it works\r\n\r\n\r\n\r\n1. The conference member calls into our conferencing line and waits for the host to join the line\r\n\r\n2. Our conference host is sent an SMS telling them a new caller is on his conference line\r\n\r\n3. The host then joins his conferencing line to speak with the caller\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. MessageBird account\r\n\r\n3. Lineblocs account\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nTo create a new blank flow:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Blank\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup Variables\r\n\r\n\r\n\r\nFirst, we will set up variables to keep track of what our host\'s number is when they call in. \r\n\r\n\r\n\r\nOur variables will allow us to switch context in our flow and to ensure we provide moderator access to our host.\r\n\r\n\r\n\r\nTo set up variables, please drag a \"Set Variables\" widget from the right pane into the flow graph, then connect the Launch widget \"Incoming Call\" port into the Set Variables \"In\" port.\r\n\r\n\r\n\r\n![Macro Added](/img/frontend/docs/execline/execline-2.png)\r\n\r\n\r\n\r\n\r\n\r\nNext, please click the \"Set Variables\" widget to bring up its widget options, then click ![Add](/img/frontend/docs/execline/add.png)\r\n\r\n\r\n\r\nPlease add the following variables:\r\n\r\n\r\n\r\n```\r\n\r\nName: host_number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-phone-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: messagebird_access_token\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-messagebird-access-token\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: messagebird_number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-messagebird-number\r\n\r\n```\r\n\r\n\r\n\r\n\r\n\r\n## Adding a Macro\r\n\r\n\r\n\r\nWe will add a macro to allow us to integrate a custom conferencing workflow.\r\n\r\n\r\n\r\nOur macro will be set up to subscribe to conference events as they are triggered.\r\n\r\n\r\n\r\nTo add a new macro, please drag the \"Macro\" widget from the right pane into the flow graph, then rename this widget to \"ConferenceEvents.\".\r\n\r\n\r\n\r\n![Events](/img/frontend/docs/execline/events.png)\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n## Setup Conference Events\r\n\r\n\r\n\r\nOur conference events widget will be set up to track when new members join the conference and make sure our conference always has at most two participants – the host and one member, at any given time.\r\n\r\n\r\n\r\nTo setup the conferencing events, please click the \"ConferenceEvents\" widget, then in the right pane under function click ![create](/img/frontend/docs/execline/create.png)\r\n\r\n\r\n\r\nOn the Macro Template screen, select template \"Blank,\", then click \"Save.\".\r\n\r\n\r\n\r\nIn the Lineblocs function editor, please add the following code:\r\n\r\n        \r\n\r\n        ```\r\n\r\n    function sendSMS(apiKey, apiNumber, number, body) {\r\n\r\n        var messagebird = require(\'messagebird\')(apiKey);\r\n\r\n        messagebird.messages.create({\r\n\r\n            originator: apiNumber,\r\n\r\n            recipients : [ number ],\r\n\r\n            body : body\r\n\r\n        });\r\n\r\n    }\r\n\r\n    module.exports = function(event: LineEvent, context: LineContext) {\r\n\r\n        return new Promise(async function(resolve, reject) {\r\n\r\n\r\n\r\n			var call = context.flow.call;\r\n\r\n            var cell = context.cell;\r\n\r\n            var host = event[\'host_number\'];\r\n\r\n            var sdk = context.getSDK();\r\n\r\n            var conf = sdk.createConference(context.flow, \"Execline\");\r\n\r\n            var number = \"\";\r\n\r\n\r\n\r\n            var isWaiting = true;\r\n\r\n            conf.on(\"MemberJoined\", function(member: LineConferenceMember) {\r\n\r\n                if (member.call.callParams.from === call.callParams.from) {\r\n\r\n				   var body = `${number} is now on your conference line.`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n				}\r\n\r\n			});\r\n\r\n            conf.on(\"MemberLeft\", function(member: LineConferenceMember) {\r\n\r\n                if (isWaiting && conf.totalParticipants() === 0 && member.call.callParams.from !== call.callParams.from) {\r\n\r\n                    // let our next conference member in\r\n\r\n                   var body = `${number} is now on your conference line.`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n                   resolve(); \r\n\r\n                }\r\n\r\n				if (member.call.callParams.from === call.callParams.from) {\r\n\r\n					var body = `${number} has left your conference line`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n				}\r\n\r\n            });\r\n\r\n            if ( conf.totalParticipants() === 0 ) {\r\n\r\n                // let our first conference member in\r\n\r\n                isWaiting = false;\r\n\r\n                resolve();\r\n\r\n            }\r\n\r\n        });\r\n\r\n    }\r\n\r\n        ```\r\n\r\n\r\n\r\n\r\n\r\n## Setup Switch\r\n\r\n\r\n\r\nNext, we will create a \"Switch\" widget to change context depending on whether our host is calling or if a member is calling.\r\n\r\n\r\n\r\nTo set up a switch, please drag a \"Switch\" widget from the right pane into the flow graph, then add the following two links:\r\n\r\n\r\n\r\n### Link 1\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: {{SetupVariables.host_number}}\r\n\r\n```\r\n\r\n\r\n\r\n### Link 2\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Not Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: {{SetupVariables.host_number}}\r\n\r\n```\r\n\r\n\r\n\r\n## Create Conference Routes\r\n\r\n\r\n\r\nOur conference will require at least two conferencing roles, the \"user.\" and the \"moderator.\"\r\n\r\n\r\n\r\nTo set up the call flow routes, please create two \"SetVariable\" widgets: \"ModeratorRoute\" and \"UserRoute.\"\r\n\r\n\r\n\r\nPlease add the following variables under \"ModeratorRoute\":\r\n\r\n\r\n\r\n```\r\n\r\nname: role\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nvalue: moderator\r\n\r\n```\r\n\r\n\r\n\r\nPlease add the following variables under \"UserRoute\":\r\n\r\n\r\n\r\n```\r\n\r\nname: role\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nvalue: user\r\n\r\n```\r\n\r\n\r\n\r\n![execline 3](/img/frontend/docs/execline/execline-3.png)\r\n\r\n\r\n\r\n\r\n\r\n## Create Conference\r\n\r\n\r\n\r\nOur final piece of the flow will be to add a \"Conference\" widget.\r\n\r\n\r\n\r\nTo add a \"Conference\" widget into the flow, please drag a \"Conference\" widget from the right pane into the flow.\r\n\r\n\r\n\r\nIn the \"Conference\" settings, please check \"Wait for Moderator\" and \"End on Moderator leave\" settings.\r\n\r\n\r\n\r\n## Connecting the Flow\r\n\r\n\r\n\r\nTo make our flow all work together, we will need to add links between the widgets created.\r\n\r\n\r\n\r\nPlease add the following links:\r\n\r\n\r\n\r\n1. SetupVariables to ConferenceEvents\r\n\r\n2. ConferenceEvents to Switch\r\n\r\n3. Switch Link 1 to ModeratorRoute\r\n\r\n4. Switch Link 2 to UserRoute\r\n\r\n5. ModeratorRoute to Conference\r\n\r\n6. UserRoute to Conference\r\n\r\n\r\n\r\n![execline 4](/img/frontend/docs/execline/execline-4.png)\r\n\r\n\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nTo test as a caller:\r\n\r\nCall the conferencing line number\r\n\r\n\r\n\r\nTo test as a host: \r\n\r\nUse the host number to call into the conferencing line\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we went over a reference conferencing app integration. For more related articles please see:\r\n\r\nIn this guide, we went over a reference conferencing app integration. For more related articles, please see:\r\n\r\n\r\n\r\n[Create a cold transfer](https://lineblocs.com/resources/quickstarts/setup-cold-transfers)\r\n\r\n\r\n\r\n[Setup Macro for Business Hours](https://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)','execline-conference-reference'),(42,'2023-04-06 18:00:16','2023-04-06 18:46:21','Setting up a Hosted SIP trunk','','Setup a hosted SIP trunk using Lineblocs portal','',3,'hosted, sip, trunk, sip trunking, ip-pbx, media server',1,'# Setting up a SIP trunk\r\n\r\nA Lineblocs SIP trunk allows you to interconnect the Lineblocs system with your external phone system. By utilizing the Lineblocs SIP trunks feature, you can integrate the Lineblocs network with your hosted IP-PBX. You can also link the SIP trunk with one or more of the DID numbers you have purchased.\r\n\r\nNormally, hosted SIP trunks are useful when you need to send your calls to an external phone system. By using hosted SIP trunks, you can create sophisticated SIP routing workflows that work in tandem with your hosted SIP infrastructure. \r\n\r\nIn this guide, we go over how to create a basic SIP trunk and how to connect it a IP-PBX server.\r\n\r\n## Requirements\r\n\r\nYou will need the following to create a hosted SIP trunk on Lineblocs:\r\n\r\n1. Lineblocs account\r\n2. an external IP-PBX\r\n\r\n## Creating SIP trunk\r\n\r\nIn [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Hosted trunks\" -> \"Create New\"\r\n\r\n## Configure routing settings\r\n\r\nOn the create page you will find various settings for updating your SIP trunk.\r\n\r\nIt is recommended that you configure settings optimally.\r\n\r\nIn order to setup a hosted SIP trunk correctly it is recommended that you fill in all the fields and ensure all settings are correct.\r\n\r\n### Updating the origination settings\r\n\r\nTo update the origination settings, please click the \"Origination\" tab.\r\n\r\nIn the origination panel, you can configure a primary and secondary SIP server. These servers will be utilized when Lineblocs needs to send a call to your SIP trunk.\r\n\r\nBoth the main SIP server and recovery SIP server need a valid SIP URI. For example:\r\n\r\n```\r\nsip:mysipserver.example.org\r\n```\r\n\r\n### Termination\r\n\r\nTo access the termination settings, please click the \"Termination\" tab.\r\n\r\nOn the termination tab you will find any relevant settings for SIP termination. You can configure any valid domain name here and use it with your SIP trunk. For example:\r\n\r\n```\r\nmyhostedtrunk.pstn.lineblocs.com\r\n```\r\n\r\n> note the pstn.lineblocs.com domain will be appended to your domain automatically\r\n\r\n### Integrate trunk with DID numbers\r\n\r\nIt is also recommended that you configure atleast one DID number with your SIP trunk. \r\n\r\nTo edit your DID numbers, please click the DID numbers tab.\r\n\r\nOn this page, you can check any DID numbers you want to link with your trunk.\r\n\r\n## Saving settings\r\n\r\nTo save the SIP trunk, please click the \"Save\" button.\r\n\r\n## Connecting Lineblocs SIP trunk to external IP-PBX\r\n\r\nOnce you have saved the SIP trunk you can start configuring it with your IP-PBX.\r\n\r\nNote that each IP-PBX has its own unique settings and you will need to follow best practices.\r\n\r\nFortunately, We have created a list of guides for common IP-PBX. This can be found [here](https://lineblocs.com/resources/other-topics/interconnection-guides) \r\n\r\n## Testing the SIP trunk\r\n\r\nYou can test the SIP trunk by making calls from your hosted IP-PBX.\r\n\r\nIf everything is configured correctly the calls should connect and you should be able to hear audio.\r\n\r\n## Next Steps\r\n\r\nIn this guide we discussed setting up a hosted SIP trunk. For more guides about related topics please refer to the following articles:\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','setup-sip-trunk');
/*!40000 ALTER TABLE `resource_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_articles_sections`
--

DROP TABLE IF EXISTS `resource_articles_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource_articles_sections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_articles_sections`
--

LOCK TABLES `resource_articles_sections` WRITE;
/*!40000 ALTER TABLE `resource_articles_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `resource_articles_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_sections`
--

DROP TABLE IF EXISTS `resource_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource_sections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `size` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'full',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `key_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `image_icon` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_sections`
--

LOCK TABLES `resource_sections` WRITE;
/*!40000 ALTER TABLE `resource_sections` DISABLE KEYS */;
INSERT INTO `resource_sections` VALUES (3,'2023-02-27 22:02:47','2023-03-07 21:05:37','Quickstarts','','Get up and running with the Lineblocs app','full',0,'quickstarts','/tmp/php0Ac4oW','DJZQhhQjzhyVCpGJrTxxEjOLzJUeuV.png'),(5,'2023-03-03 03:46:26','2023-03-03 03:57:56','Managing Numbers','','how to manage lineblocs DIDs on your account','full',0,'managing-numbers','',''),(6,'2023-03-03 03:58:51','2023-03-03 03:58:51','Billing & Pricing','','all about your account\'s billing and pricing.','full',0,'billing-and-pricing','',''),(7,'2023-03-03 04:20:24','2023-03-03 04:20:24','Other Topics','','get more info on topics on managing lineblocs and getting it to work.','full',0,'other-topics','',''),(8,'2023-03-05 10:04:29','2023-03-05 10:04:29','Open Source','','how to install and setup the Lineblocs open source edition.','full',0,'open-source','','');
/*!40000 ALTER TABLE `resource_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources_articles`
--

DROP TABLE IF EXISTS `resources_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources_articles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `section_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resources_articles_section_id_foreign` (`section_id`),
  CONSTRAINT `resources_articles_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `resources_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources_articles`
--

LOCK TABLES `resources_articles` WRITE;
/*!40000 ALTER TABLE `resources_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources_sections`
--

DROP TABLE IF EXISTS `resources_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources_sections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `size` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'full',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources_sections`
--

LOCK TABLES `resources_sections` WRITE;
/*!40000 ALTER TABLE `resources_sections` DISABLE KEYS */;
INSERT INTO `resources_sections` VALUES (1,'2023-02-27 20:42:13','2023-02-27 20:46:16','test1333','','test1','full',0,'');
/*!40000 ALTER TABLE `resources_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `router_flows`
--

DROP TABLE IF EXISTS `router_flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `router_flows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `admin_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `router_flows_admin_id_foreign` (`admin_id`),
  CONSTRAINT `router_flows_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `router_flows`
--

LOCK TABLES `router_flows` WRITE;
/*!40000 ALTER TABLE `router_flows` DISABLE KEYS */;
/*!40000 ALTER TABLE `router_flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `router_flows_templates`
--

DROP TABLE IF EXISTS `router_flows_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `router_flows_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `router_flows_templates`
--

LOCK TABLES `router_flows_templates` WRITE;
/*!40000 ALTER TABLE `router_flows_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `router_flows_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rtpproxy_sockets`
--

DROP TABLE IF EXISTS `rtpproxy_sockets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rtpproxy_sockets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rtpproxy_sock` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `set_id` int NOT NULL,
  `cpu_pct` double(2,2) NOT NULL DEFAULT '0.00',
  `cpu_used` double(8,2) NOT NULL DEFAULT '0.00',
  `mem_pct` double(2,2) NOT NULL DEFAULT '0.00',
  `mem_used` double(8,2) NOT NULL DEFAULT '0.00',
  `active` int NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'unknown',
  `priority` int NOT NULL DEFAULT '0',
  `region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `router_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtpproxy_sockets`
--

LOCK TABLES `rtpproxy_sockets` WRITE;
/*!40000 ALTER TABLE `rtpproxy_sockets` DISABLE KEYS */;
INSERT INTO `rtpproxy_sockets` VALUES (1,'2023-02-20 19:57:23','2023-04-04 23:06:53','udp:127.0.0.1:7722',1,0.00,0.00,0.00,0.00,1,'unknown',0,'',1);
/*!40000 ALTER TABLE `rtpproxy_sockets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_plans`
--

DROP TABLE IF EXISTS `service_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_plans` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `key_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `nice_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `call_duration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `recording_space` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `extensions` tinyint(1) NOT NULL DEFAULT '0',
  `fax` tinyint(1) NOT NULL DEFAULT '0',
  `im_integrations` tinyint(1) NOT NULL DEFAULT '0',
  `productivity_integrations` tinyint(1) NOT NULL DEFAULT '0',
  `voice_analytics` tinyint(1) NOT NULL DEFAULT '0',
  `fraud_protection` tinyint(1) NOT NULL DEFAULT '0',
  `crm_integrations` tinyint(1) NOT NULL DEFAULT '0',
  `programmable_toolkit` tinyint(1) NOT NULL DEFAULT '0',
  `sso` tinyint(1) NOT NULL DEFAULT '0',
  `provisioner` tinyint(1) NOT NULL DEFAULT '0',
  `vpn` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_sip_domains` tinyint(1) NOT NULL DEFAULT '0',
  `bring_carrier` tinyint(1) NOT NULL DEFAULT '0',
  `featured_plan` tinyint(1) NOT NULL DEFAULT '0',
  `benefits` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `monthly_charge_cents` int DEFAULT '0',
  `pay_as_you_go` int DEFAULT '0',
  `registration_plan` smallint DEFAULT '0',
  `include_in_pricing_pages` tinyint(1) NOT NULL DEFAULT '0',
  `rank` int DEFAULT NULL,
  `plan_term` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  `annual_cost_cents` int NOT NULL DEFAULT '0',
  `allows_annual` tinyint(1) NOT NULL DEFAULT '1',
  `allows_monthly` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_plans`
--

LOCK TABLES `service_plans` WRITE;
/*!40000 ALTER TABLE `service_plans` DISABLE KEYS */;
INSERT INTO `service_plans` VALUES (12,'2023-02-20 21:48:49','2023-04-14 16:57:49','pay-as-you-go','Pay as you go','','UNLIMITED','UNLIMITED',0,1,0,0,0,1,1,0,0,0,0,1,0,0,'',5,1,1,1,3,'none',0,1,1),(13,'2023-03-28 19:00:55','2023-04-11 18:29:58','basic','Basic','','UNLIMITED','UNLIMITED',0,1,1,1,0,0,0,0,0,0,0,0,0,1,'',999,0,0,1,2,'none',0,1,1),(14,'2023-03-28 19:31:49','2023-04-11 18:30:08','company','Company','','UNLIMITED','UNLIMITED',0,1,1,1,1,1,1,1,1,1,1,0,0,0,'',2999,0,0,1,1,'none',0,1,1),(15,'2023-04-24 20:26:35','2023-04-24 20:26:35','test1','test1','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',1000,0,0,0,5,'none',10000,1,1);
/*!40000 ALTER TABLE `service_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_countries`
--

DROP TABLE IF EXISTS `sip_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iso` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `country_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `flow_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_countries_flow_id_foreign` (`flow_id`),
  CONSTRAINT `sip_countries_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `router_flows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_countries`
--

LOCK TABLES `sip_countries` WRITE;
/*!40000 ALTER TABLE `sip_countries` DISABLE KEYS */;
INSERT INTO `sip_countries` VALUES (1,'2023-01-03 23:12:28','2023-01-03 23:12:28','CA','Canada',1,'',NULL),(2,'2023-01-03 23:12:29','2023-01-03 23:12:29','US','United States',1,'',NULL);
/*!40000 ALTER TABLE `sip_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers`
--

DROP TABLE IF EXISTS `sip_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `dial_prefix` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `host` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'unknown',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `api_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_of_provider` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `carrier_key` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `active_channels` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers`
--

LOCK TABLES `sip_providers` WRITE;
/*!40000 ALTER TABLE `sip_providers` DISABLE KEYS */;
INSERT INTO `sip_providers` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','VoIPMS','','','',0,'toronto.voip.ms','unknown',0,'VoIPMS','both',NULL,0);
/*!40000 ALTER TABLE `sip_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_call_rates`
--

DROP TABLE IF EXISTS `sip_providers_call_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_call_rates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dial_prefix` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `call_rate` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_id` int unsigned NOT NULL,
  `provider_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_call_rates_country_id_foreign` (`country_id`),
  KEY `sip_providers_call_rates_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_call_rates_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `sip_countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_providers_call_rates_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_call_rates`
--

LOCK TABLES `sip_providers_call_rates` WRITE;
/*!40000 ALTER TABLE `sip_providers_call_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_providers_call_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_countries`
--

DROP TABLE IF EXISTS `sip_providers_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_countries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `country_id` int unsigned NOT NULL,
  `provider_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_countries_country_id_foreign` (`country_id`),
  KEY `sip_providers_countries_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_countries_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `sip_countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_providers_countries_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_countries`
--

LOCK TABLES `sip_providers_countries` WRITE;
/*!40000 ALTER TABLE `sip_providers_countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_providers_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_hosts`
--

DROP TABLE IF EXISTS `sip_providers_hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_hosts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `provider_id` int unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `priority_prefixes` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active_channels` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sip_providers_hosts_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_hosts_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_hosts`
--

LOCK TABLES `sip_providers_hosts` WRITE;
/*!40000 ALTER TABLE `sip_providers_hosts` DISABLE KEYS */;
INSERT INTO `sip_providers_hosts` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26',1,'toronto.voip.ms','Toronto',1,'',0);
/*!40000 ALTER TABLE `sip_providers_hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_metrics`
--

DROP TABLE IF EXISTS `sip_providers_metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_metrics` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `avg_answer_rate` int DEFAULT NULL,
  `avg_call_duration` int DEFAULT NULL,
  `failure_response_pct` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_metrics_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_metrics_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_metrics`
--

LOCK TABLES `sip_providers_metrics` WRITE;
/*!40000 ALTER TABLE `sip_providers_metrics` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_providers_metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_rates`
--

DROP TABLE IF EXISTS `sip_providers_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_rates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `provider_id` int unsigned NOT NULL,
  `rate` decimal(8,8) NOT NULL,
  `priority` int NOT NULL,
  `rate_ref_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_rates_provider_id_foreign` (`provider_id`),
  KEY `sip_providers_rates_rate_ref_id_foreign` (`rate_ref_id`),
  CONSTRAINT `sip_providers_rates_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_providers_rates_rate_ref_id_foreign` FOREIGN KEY (`rate_ref_id`) REFERENCES `call_rates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_rates`
--

LOCK TABLES `sip_providers_rates` WRITE;
/*!40000 ALTER TABLE `sip_providers_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_providers_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_providers_whitelist_ips`
--

DROP TABLE IF EXISTS `sip_providers_whitelist_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_providers_whitelist_ips` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `provider_id` int unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_whitelist_ips_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_whitelist_ips_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_whitelist_ips`
--

LOCK TABLES `sip_providers_whitelist_ips` WRITE;
/*!40000 ALTER TABLE `sip_providers_whitelist_ips` DISABLE KEYS */;
INSERT INTO `sip_providers_whitelist_ips` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26',1,'158.85.70.148','/32');
/*!40000 ALTER TABLE `sip_providers_whitelist_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_rate_centers`
--

DROP TABLE IF EXISTS `sip_rate_centers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_rate_centers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `region_id` int unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `fax_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `fax_data_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `fax_data_2` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_rate_centers_region_id_foreign` (`region_id`),
  CONSTRAINT `sip_rate_centers_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `sip_regions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_rate_centers`
--

LOCK TABLES `sip_rate_centers` WRITE;
/*!40000 ALTER TABLE `sip_rate_centers` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_rate_centers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_rate_centers_providers`
--

DROP TABLE IF EXISTS `sip_rate_centers_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_rate_centers_providers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `center_id` int unsigned NOT NULL,
  `provider_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_rate_centers_providers_center_id_foreign` (`center_id`),
  KEY `sip_rate_centers_providers_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_rate_centers_providers_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `sip_rate_centers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_rate_centers_providers_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_rate_centers_providers`
--

LOCK TABLES `sip_rate_centers_providers` WRITE;
/*!40000 ALTER TABLE `sip_rate_centers_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_rate_centers_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_regions`
--

DROP TABLE IF EXISTS `sip_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_regions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_id` int unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sip_regions_country_id_foreign` (`country_id`),
  CONSTRAINT `sip_regions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `sip_countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_regions`
--

LOCK TABLES `sip_regions` WRITE;
/*!40000 ALTER TABLE `sip_regions` DISABLE KEYS */;
INSERT INTO `sip_regions` VALUES (1,'2023-01-03 23:12:28','2023-01-03 23:12:28','AB','Alberta',1,1),(2,'2023-01-03 23:12:28','2023-01-03 23:12:28','ON','Ontario',1,1),(3,'2023-01-03 23:12:28','2023-01-03 23:12:28','BC','British Columbia',1,1),(4,'2023-01-03 23:12:28','2023-01-03 23:12:28','MB','Manitoba',1,1),(5,'2023-01-03 23:12:28','2023-01-03 23:12:28','QC','Quebec',1,1),(6,'2023-01-03 23:12:28','2023-01-03 23:12:28','NS','Nova Scotia',1,1),(7,'2023-01-03 23:12:29','2023-01-03 23:12:29','CA','California',2,1),(8,'2023-01-03 23:12:29','2023-01-03 23:12:29','FL','Florida',2,1),(9,'2023-01-03 23:12:29','2023-01-03 23:12:29','NY','New York',2,1),(10,'2023-01-03 23:12:29','2023-01-03 23:12:29','NC','North Carolina',2,1),(11,'2023-01-03 23:12:29','2023-01-03 23:12:29','SC','South Carolina',2,1),(12,'2023-01-03 23:12:29','2023-01-03 23:12:29','TX','Texas',2,1),(13,'2023-01-03 23:12:29','2023-01-03 23:12:29','WA','Washington',2,1),(14,'2023-01-03 23:12:30','2023-01-03 23:12:30','MS','Massachusetts',2,1),(15,'2023-01-03 23:12:30','2023-01-03 23:12:30','IL','Illinois',2,1),(16,'2023-01-03 23:12:30','2023-01-03 23:12:30','NV','Nevada',2,1),(17,'2023-01-03 23:12:30','2023-01-03 23:12:30','PA','Pennsylvania',2,1),(18,'2023-01-03 23:12:30','2023-01-03 23:12:30','CO','Colorado',2,1),(19,'2023-01-03 23:12:30','2023-01-03 23:12:30','MN','Minnesota',2,1);
/*!40000 ALTER TABLE `sip_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_routers`
--

DROP TABLE IF EXISTS `sip_routers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_routers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address_range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address_range` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `live_call_count` int NOT NULL DEFAULT '0',
  `live_cpu_pct_used` double(8,2) NOT NULL DEFAULT '0.00',
  `live_status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `k8s_pod_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_routers`
--

LOCK TABLES `sip_routers` WRITE;
/*!40000 ALTER TABLE `sip_routers` DISABLE KEYS */;
INSERT INTO `sip_routers` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','Canada PoP','0.0.0.0','/32','127.0.0.1','','ca-central-1',1,0,0.00,'','');
/*!40000 ALTER TABLE `sip_routers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_routers_media_servers`
--

DROP TABLE IF EXISTS `sip_routers_media_servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_routers_media_servers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `router_id` int unsigned DEFAULT NULL,
  `server_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_routers_media_servers_router_id_foreign` (`router_id`),
  KEY `sip_routers_media_servers_server_id_foreign` (`server_id`),
  CONSTRAINT `sip_routers_media_servers_router_id_foreign` FOREIGN KEY (`router_id`) REFERENCES `sip_routers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_routers_media_servers_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `media_servers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_routers_media_servers`
--

LOCK TABLES `sip_routers_media_servers` WRITE;
/*!40000 ALTER TABLE `sip_routers_media_servers` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_routers_media_servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks`
--

DROP TABLE IF EXISTS `sip_trunks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `record` tinyint(1) NOT NULL,
  `record_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'dual',
  `workspace_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sip_trunks_workspace_id_foreign` (`workspace_id`),
  KEY `sip_trunks_user_id_foreign` (`user_id`),
  CONSTRAINT `sip_trunks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_trunks_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks`
--

LOCK TABLES `sip_trunks` WRITE;
/*!40000 ALTER TABLE `sip_trunks` DISABLE KEYS */;
INSERT INTO `sip_trunks` VALUES (1,'2023-01-20 07:17:11','2023-01-20 07:17:11','user812-hosted','st-ed8f705d-8d62-4539-a160-7b0b338a0bc2',1,'dual',10,10,1),(2,'2023-03-02 16:49:38','2023-03-02 16:49:38','test123','st-10f1ae14-e986-4154-857e-f09144941fad',1,'dual',2,2,1),(3,'2023-04-29 03:58:17','2023-04-29 03:58:17','Tests','st-1a4c0922-f493-4333-9201-4d3726b6e42e',1,'dual',50,54,1),(4,'2023-04-29 03:58:41','2023-04-29 03:58:41','Tests yedhfi','st-a26adeb1-3a43-447d-a39b-d0544fb2fbbf',1,'dual',50,54,1),(5,'2023-05-01 04:03:03','2023-05-01 04:03:03','10203040','st-fd6969f6-a66b-4c0e-b475-06cc4154cd1e',1,'dual',53,57,1);
/*!40000 ALTER TABLE `sip_trunks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks_origination_endpoints`
--

DROP TABLE IF EXISTS `sip_trunks_origination_endpoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks_origination_endpoints` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sip_uri` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  `ipv4` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ipv6` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_origination_endpoints_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_origination_endpoints_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_origination_endpoints`
--

LOCK TABLES `sip_trunks_origination_endpoints` WRITE;
/*!40000 ALTER TABLE `sip_trunks_origination_endpoints` DISABLE KEYS */;
INSERT INTO `sip_trunks_origination_endpoints` VALUES (2,'2023-02-20 20:53:50','2023-02-20 20:53:50','user812.hosted-man.com',1,'',''),(3,'2023-02-20 20:53:50','2023-02-20 20:53:50','',1,'',''),(4,'2023-02-20 20:53:50','2023-02-20 20:53:50','',1,'',''),(5,'2023-03-02 16:49:38','2023-03-02 16:49:38','test123.example.org',2,'test123.example.org','test123.example.org'),(6,'2023-05-01 04:03:03','2023-05-01 04:03:03','10203040.example.org',5,'10203040.example.org','10203040.example.org');
/*!40000 ALTER TABLE `sip_trunks_origination_endpoints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks_origination_settings`
--

DROP TABLE IF EXISTS `sip_trunks_origination_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks_origination_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recovery_sip_uri` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_origination_settings_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_origination_settings_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_origination_settings`
--

LOCK TABLES `sip_trunks_origination_settings` WRITE;
/*!40000 ALTER TABLE `sip_trunks_origination_settings` DISABLE KEYS */;
INSERT INTO `sip_trunks_origination_settings` VALUES (1,'2023-01-20 07:17:11','2023-01-20 07:17:11','user812.hosted-man.com',1),(2,'2023-03-02 16:49:38','2023-03-02 16:49:38','test123.example.org',2),(3,'2023-04-29 03:58:17','2023-04-29 03:58:17','',3),(4,'2023-04-29 03:58:41','2023-04-29 03:58:41','',4),(5,'2023-05-01 04:03:03','2023-05-01 04:03:03','10203040',5);
/*!40000 ALTER TABLE `sip_trunks_origination_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks_termination_acl`
--

DROP TABLE IF EXISTS `sip_trunks_termination_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks_termination_acl` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `identifier` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cidr_addr` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_termination_acl_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_termination_acl_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_termination_acl`
--

LOCK TABLES `sip_trunks_termination_acl` WRITE;
/*!40000 ALTER TABLE `sip_trunks_termination_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_trunks_termination_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks_termination_credentials`
--

DROP TABLE IF EXISTS `sip_trunks_termination_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks_termination_credentials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_termination_credentials_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_termination_credentials_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_termination_credentials`
--

LOCK TABLES `sip_trunks_termination_credentials` WRITE;
/*!40000 ALTER TABLE `sip_trunks_termination_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_trunks_termination_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trunks_termination_settings`
--

DROP TABLE IF EXISTS `sip_trunks_termination_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trunks_termination_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trunk_id` int unsigned DEFAULT NULL,
  `sip_addr` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sip_trunks_termination_settings_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_termination_settings_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_termination_settings`
--

LOCK TABLES `sip_trunks_termination_settings` WRITE;
/*!40000 ALTER TABLE `sip_trunks_termination_settings` DISABLE KEYS */;
INSERT INTO `sip_trunks_termination_settings` VALUES (1,'2023-01-20 07:17:11','2023-01-20 07:17:11',1,'user812'),(2,'2023-03-02 16:49:38','2023-03-02 16:49:38',2,'test123'),(3,'2023-05-01 04:03:03','2023-05-01 04:03:03',5,'10203040');
/*!40000 ALTER TABLE `sip_trunks_termination_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_status_categories`
--

DROP TABLE IF EXISTS `system_status_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_status_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_status_categories`
--

LOCK TABLES `system_status_categories` WRITE;
/*!40000 ALTER TABLE `system_status_categories` DISABLE KEYS */;
INSERT INTO `system_status_categories` VALUES (1,'2023-01-03 23:12:27','2023-01-03 23:12:27','SIP Trunking Networks',''),(2,'2023-01-03 23:12:27','2023-01-03 23:12:27','Media Storage Servers',''),(3,'2023-01-03 23:12:27','2023-01-03 23:12:27','PoP Servers',''),(4,'2023-01-03 23:12:27','2023-01-03 23:12:27','User Portals','');
/*!40000 ALTER TABLE `system_status_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_status_updates`
--

DROP TABLE IF EXISTS `system_status_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_status_updates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system_status_updates_category_id_foreign` (`category_id`),
  CONSTRAINT `system_status_updates_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `system_status_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_status_updates`
--

LOCK TABLES `system_status_updates` WRITE;
/*!40000 ALTER TABLE `system_status_updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_status_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usage_triggers`
--

DROP TABLE IF EXISTS `usage_triggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usage_triggers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `percentage` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usage_triggers_user_id_foreign` (`user_id`),
  CONSTRAINT `usage_triggers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usage_triggers`
--

LOCK TABLES `usage_triggers` WRITE;
/*!40000 ALTER TABLE `usage_triggers` DISABLE KEYS */;
INSERT INTO `usage_triggers` VALUES (1,'2023-01-03 23:13:54','2023-01-03 23:13:54',3,50),(2,'2023-01-03 23:15:08','2023-01-03 23:15:08',4,50),(3,'2023-01-12 02:25:20','2023-01-12 02:25:20',8,50),(4,'2023-01-12 02:27:05','2023-01-12 02:27:05',9,50),(5,'2023-01-20 07:16:26','2023-01-20 07:16:26',10,50),(6,'2023-02-20 18:32:01','2023-02-20 18:32:01',2,50),(7,'2023-03-02 03:19:45','2023-03-02 03:19:45',14,50),(8,'2023-03-02 03:24:25','2023-03-02 03:24:25',15,50),(9,'2023-03-02 03:43:15','2023-03-02 03:43:15',17,50),(10,'2023-03-02 16:11:04','2023-03-02 16:11:04',18,50),(11,'2023-03-16 20:31:49','2023-03-16 20:31:49',20,50),(12,'2023-03-16 20:37:32','2023-03-16 20:37:32',21,50),(13,'2023-03-17 10:46:07','2023-03-17 10:46:07',22,50),(14,'2023-03-17 10:47:54','2023-03-17 10:47:54',23,50),(15,'2023-03-17 10:50:52','2023-03-17 10:50:52',24,50),(16,'2023-03-17 10:57:19','2023-03-17 10:57:19',25,50),(17,'2023-03-17 21:45:01','2023-03-17 21:45:01',26,50),(18,'2023-03-28 18:03:55','2023-03-28 18:03:55',31,50),(19,'2023-03-31 20:45:07','2023-03-31 20:45:07',34,50),(20,'2023-04-02 05:30:02','2023-04-02 05:30:02',35,50),(21,'2023-04-03 16:39:51','2023-04-03 16:39:51',36,50),(22,'2023-04-03 16:43:49','2023-04-03 16:43:49',37,50),(23,'2023-04-03 16:45:50','2023-04-03 16:45:50',38,50),(24,'2023-04-03 16:45:58','2023-04-03 16:45:58',39,50),(25,'2023-04-03 16:50:14','2023-04-03 16:50:14',40,50),(26,'2023-04-04 11:11:42','2023-04-04 11:11:42',41,50),(27,'2023-04-04 17:19:22','2023-04-04 17:19:22',42,50),(28,'2023-04-05 10:47:08','2023-04-05 10:47:08',43,50),(29,'2023-04-12 10:36:15','2023-04-12 10:36:15',45,50),(30,'2023-04-12 12:50:16','2023-04-12 12:50:16',46,50),(31,'2023-04-14 12:19:44','2023-04-14 12:19:44',47,50),(32,'2023-04-18 10:18:14','2023-04-18 10:18:14',48,50),(33,'2023-04-24 05:07:54','2023-04-24 05:07:54',50,50),(34,'2023-04-24 06:08:11','2023-04-24 06:08:11',51,50),(35,'2023-04-25 09:38:15','2023-04-25 09:38:15',52,50),(36,'2023-04-27 21:14:35','2023-04-27 21:14:35',53,50),(37,'2023-04-28 10:34:27','2023-04-28 10:34:27',54,50),(38,'2023-04-29 03:32:08','2023-04-29 03:32:08',55,50),(39,'2023-04-29 03:39:54','2023-04-29 03:39:54',56,50),(40,'2023-05-01 04:01:17','2023-05-01 04:01:17',57,50),(41,'2023-05-01 16:16:55','2023-05-01 16:16:55',58,50),(42,'2023-05-01 16:58:05','2023-05-01 16:58:05',59,50),(43,'2023-05-01 20:51:20','2023-05-01 20:51:20',60,50),(44,'2023-05-02 18:08:29','2023-05-02 18:08:29',61,50),(45,'2023-05-02 18:36:35','2023-05-02 18:36:35',62,50),(46,'2023-05-03 17:10:41','2023-05-03 17:10:41',63,50),(47,'2023-05-04 21:14:03','2023-05-04 21:14:03',64,50),(48,'2023-05-04 21:21:54','2023-05-04 21:21:54',65,50);
/*!40000 ALTER TABLE `usage_triggers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usage_triggers_results`
--

DROP TABLE IF EXISTS `usage_triggers_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usage_triggers_results` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usage_trigger_id` int unsigned NOT NULL,
  `credit_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usage_triggers_results_usage_trigger_id_foreign` (`usage_trigger_id`),
  KEY `usage_triggers_results_credit_id_foreign` (`credit_id`),
  CONSTRAINT `usage_triggers_results_credit_id_foreign` FOREIGN KEY (`credit_id`) REFERENCES `users_credits` (`id`),
  CONSTRAINT `usage_triggers_results_usage_trigger_id_foreign` FOREIGN KEY (`usage_trigger_id`) REFERENCES `usage_triggers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usage_triggers_results`
--

LOCK TABLES `usage_triggers_results` WRITE;
/*!40000 ALTER TABLE `usage_triggers_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `usage_triggers_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb3_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `container_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sip_port` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `rtp_ports` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `trial_mode` tinyint(1) NOT NULL,
  `plan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auto_recharge` tinyint(1) NOT NULL,
  `auto_recharge_top_up` int NOT NULL,
  `call_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reserved_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `network_device` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `reserved_private_ip` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ip_private` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoices_by_email` tinyint(1) NOT NULL,
  `billing_package` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'gold',
  `last_login` datetime DEFAULT NULL,
  `email_verify_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_reminded` datetime DEFAULT NULL,
  `ip_whitelist_disabled` tinyint(1) NOT NULL DEFAULT '1',
  `address_line_1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `linked_paypal` tinyint(1) NOT NULL,
  `free_trial_started` datetime NOT NULL,
  `free_trial_reminder_sent` tinyint(1) NOT NULL DEFAULT '0',
  `office_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `needs_password_set` tinyint(1) NOT NULL DEFAULT '0',
  `needs_set_password_date` datetime NOT NULL,
  `pending_number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `2fa_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `secret_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `recovery_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `2fa_enabled` smallint DEFAULT '0',
  `enable_2fa` smallint DEFAULT '0',
  `type_of_2fa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `secret_code_2fa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `recovery_code_2fa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT '',
  `theme` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'light',
  `external_app_user` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_number_unique` (`mobile_number`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin_user','support@lineblocs.com','$2y$10$.d9XtPvzWhwKzz7gK5iUL.a7xOfi5kRStZyFg0l2Gn61OopMiJemm','7c5dac76517e22541e28f60b3aec0fc6',1,1,'kNLAFUGI6KZvqjlYILfj6RFOyZT2c4KgxXKxLdsqI5K8xzwX41f8ZbLzNgNJ','2023-01-03 23:12:26','2023-03-28 18:09:02',NULL,'','','cus_HPMybdGfNCjbIl','','','','','',0,'ultimate',0,0,'','ADMIN',NULL,'',NULL,NULL,'ca-central-1',0,'gold','2023-03-23 18:11:10','',0,NULL,1,'','','','','','',0,'0000-00-00 00:00:00',0,'ADMIN','',0,'0000-00-00 00:00:00','','','','',0,0,'','VNPPWYDTZFE3KUL2HSQL3QZKCU7ZFCXAX6JQNDS5ZHHSWLRFGHTBJ7RG34SI5APKFRSZG4UJC6RNEUGEU4HXPPKYDBB6VWVXL34Q4KY','','light',0,NULL,NULL),(2,'Test User','test_user','user@lineblocs.com','$2y$10$EwrHWunLa7JPqBdSl7Xk/.XzzB5yYrPUJGpeOKBORByu9LAcDZvdW','26764e1287dfe9f2e0b502c49216d361',1,0,NULL,'2023-01-03 23:12:26','2023-05-02 18:35:57',NULL,'','','cus_HPMybdGfNCjbIl','','','','','',0,'ultimate',0,0,'','USER',NULL,'',NULL,NULL,'ca-central-1',1,'gold','2023-05-02 18:35:57','',0,NULL,1,'','','','','','',0,'0000-00-00 00:00:00',0,'USER','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','OAL7S7PB5AS74523W4CTEZXQE7HN455AXOWMUTA2LXJRHWXA7KCI4YOXQFIOOFAPJT53EIKWOYGB3PF2RQYNUOQWGOVTOT4TVRW7WDY','','light',0,NULL,NULL),(3,'','user408@infinitet3ch.com','user408@infinitet3ch.com','$2y$10$VrslkLkkhevhX9YxMmGAVOQ21MlugT.0Xyt3e7LoqTJEEaetRDy/O','55e8a7a044463cd524accfcc3ef2017f',0,0,NULL,'2023-01-03 23:13:49','2023-01-03 23:13:54',NULL,'user408','user408','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-01-03 23:13:54','aba9ce1a082d3ca77193961914525c47',0,NULL,1,'','','','','','',0,'2023-01-03 23:13:49',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(4,'','user411@infinitet3ch.com','user411@infinitet3ch.com','$2y$10$98jwADTSi4LHAl/Sgw7Mnef27ZHdGj5SAYlMu9Lt4OW2NZ4tFV4m.','e217dcfd42734986e8080100249bd09c',0,0,NULL,'2023-01-03 23:15:02','2023-01-03 23:15:08',NULL,'user411','user411','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-01-03 23:15:08','47868e1af3dba96fe307babfe74540b5',0,NULL,1,'','','','','','',0,'2023-01-03 23:15:02',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(5,'','test881@infinitet3ch.com','test881@infinitet3ch.com','$2y$10$A6H/2YC1jvs5cupAsEBvHOenOcofIOPYnUVWC2p939VucqOBxBflO','824940017fc908efbaa7d37e12e0bbbf',0,0,NULL,'2023-01-12 01:25:28','2023-01-12 01:25:28',NULL,'test881','test881','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'2a7cc13f004048fd007a8fc60c556e78',0,NULL,1,'','','','','','',0,'2023-01-12 01:25:28',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(6,'','user700@infinitet3ch.com','user700@infinitet3ch.com','$2y$10$qcgSBB9cHNDxA3CzGfe1QeO3bw13dg8R0QlZhz.KO9XCURCkFPMGO','0db42b6c1dc93a0271c83ae19b34de52',0,0,NULL,'2023-01-12 01:30:48','2023-01-12 01:30:48',NULL,'user700','user700','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'ad3dda700b107fb167140565b5e34448',0,NULL,1,'','','','','','',0,'2023-01-12 01:30:48',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(7,'','test231@infinitet3ch.com','test231@infinitet3ch.com','$2y$10$6QjlnVa.tTCaOtF3V/4V4.ixnGy5Zw13cuNUoZv3ixJvij6Wg7zd.','5c556c0782fac668cbbfc7843512c39a',0,0,NULL,'2023-01-12 02:18:43','2023-01-12 02:18:43',NULL,'test231','test231','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'24f0ae25b2c95bbfca7104e866f8698f',0,NULL,1,'','','','','','',0,'2023-01-12 02:18:43',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(8,'','user301@infinitet3ch.com','user301@infinitet3ch.com','$2y$10$vH7uK0WjC5t93XCqslrOsuQBvOfWiOWiXk7KvCwnvRLBtpUoaVQ5q','5921840913a85c8a96712f1217fcd704',0,0,NULL,'2023-01-12 02:25:08','2023-01-12 02:25:20',NULL,'user301','user301','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-01-12 02:25:20','303c5e295a549f4874f7f74d3182527e',0,NULL,1,'','','','','','',0,'2023-01-12 02:25:08',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(9,'','user306@infinitet3ch.com','user306@infinitet3ch.com','$2y$10$LXaBIbBaogRG72StZwQ/tuALrehrY0eEOUviknsEwXk9GQukPiQDe','88d2d4f6b5bdb97681076e80e9f3ece5',0,0,NULL,'2023-01-12 02:26:49','2023-01-12 02:27:05',NULL,'user306','user306','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-01-12 02:27:05','540835138697874561de72d96611c3f2',0,NULL,1,'','','','','','',0,'2023-01-12 02:26:49',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(10,'','user812@infinitet3ch.com','user812@infinitet3ch.com','$2y$10$uKL/Usqfrl3Nc6sCcI/3De0eH8aUKLMNIqF08JYy3EyOTxDg.2U..','29b875e85fde8a8eef15aa070d7a0076',0,0,NULL,'2023-01-20 07:16:12','2023-01-20 07:16:26',NULL,'user812','user812','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-01-20 07:16:26','9f565c832ea001d94bb8111a2227713a',0,NULL,1,'','','','','','',0,'2023-01-20 07:16:12',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(11,'','1010@example.com','1010@example.com','$2y$10$zbMA.Z/TNp9mqryjyPJPtOyP72z/jmH7h1uFkSrQ4Zm1BoxMafUPS','42fbad5bb2f1d2b36d266ac398242471',0,0,NULL,'2023-01-20 07:18:52','2023-01-20 07:18:52',NULL,'new_user_123','new_user_123','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'c1e6b132cbc543721e14244e9f35290f',0,NULL,1,'','','','','','',0,'0000-00-00 00:00:00',0,'','',1,'2023-01-20 07:18:52','','','','',0,0,'','','','light',0,NULL,NULL),(12,'','matrix.nad@gmail.com','matrix.nad@gmail.com','$2y$10$qBIRzFC7qvVuKY0Olg3mruLpuum7QZULobpSlsAT5552oNaQ2aRlC','5722d55b06f3c5a45748d9ef65575713',0,0,NULL,'2023-02-13 02:47:58','2023-02-13 02:47:58',NULL,'Nadir','Hamid','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'b71e03c299e654f5052a4db7145a70cd',0,NULL,1,'','','','','','',0,'2023-02-13 02:47:58',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(13,'','ch.singhshekhar@gmail.com','ch.singhshekhar@gmail.com','$2y$10$9GKPg66xHE7gQD8MCHP3xuJL.Pkhw0X1cFEZ0NgE6i06AmjAczLy6','0a664b692e3c1bd62bbf87a434ffd8e6',0,0,NULL,'2023-03-02 03:16:43','2023-03-02 03:16:43',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'5243143fa9c0b2a7c4e893463ff8b20d',0,NULL,1,'','','','','','',0,'2023-03-02 03:16:43',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(14,'','chs.i.n.ghshekhar@gmail.com','chs.i.n.ghshekhar@gmail.com','$2y$10$YhM5dXFeInDRZLFjlrkYhOwUnfCVCqyCiA/WDxbQR00kEYUlEITbG','beeab5177bf770ad2ecdbd0489c6670a',0,0,NULL,'2023-03-02 03:18:49','2023-03-02 03:19:45',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-02 03:19:45','0c4da8899aae9fdda5fa708a5fa26aa3',0,NULL,1,'','','','','','',0,'2023-03-02 03:18:49',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(15,'','chandramimit@gmail.com','chandramimit@gmail.com','$2y$10$skOzUAiD1siSeWtrzuXh7.cbNM5rsrRTDtm7xJ4UkJnUsiam/tOXO','871b2dc761b17d8f49560a1e303041a1',0,0,NULL,'2023-03-02 03:22:57','2023-03-02 03:24:25',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-02 03:24:25','c47df7f5d054feceec98363994b561cf',0,NULL,1,'','','','','','',0,'2023-03-02 03:22:57',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(16,'','chs.i.nghsh.ekhar@gmail.com','chs.i.nghsh.ekhar@gmail.com','$2y$10$0WGWne/Hni1SMTi5iqSPw.z2jvhDW9J6ziYJotFa/iUdgbZsOcleS','24d279e50bd30676758daab9ff571823',0,0,NULL,'2023-03-02 03:29:51','2023-03-02 03:29:51',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'8b3482c12a63d8ac8fc62ed5603eeb2f',0,NULL,1,'','','','','','',0,'2023-03-02 03:29:51',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(17,'','chandsd.ralkh@gmail.com','chandsd.ralkh@gmail.com','$2y$10$CuMp.F3XFTUGTCGuQkeCoO7TiHjoUHJuUCyG5zLAD6.vGJHjx3Sb6','67ae3d59a6cfd80befe6b59e0c208050',0,0,NULL,'2023-03-02 03:42:55','2023-03-02 03:43:15',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-02 03:43:15','56441ad643e49832570128b4477bf5b4',0,NULL,1,'','','','','','',0,'2023-03-02 03:42:55',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(18,'','test909@infinitet3ch.com','test909@infinitet3ch.com','$2y$10$wGaivpQlzfDmi8i6n3f4p.79kVHKFIZE5oyXPC3w4778zgi/WykBO','2170e6ff1016841cf4af71e871ffcdaa',0,0,NULL,'2023-03-02 16:10:54','2023-03-02 16:11:04',NULL,'test909','test909','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-02 16:11:04','7af3e9db5be196c9f0b6a84b18534b03',0,NULL,1,'','','','','','',0,'2023-03-02 16:10:54',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(19,'','gaurav@sunbihar.com','gaurav@sunbihar.com','$2y$10$FlBITXmMqk4/UEwZeSY4Nes1jOq.Jt20dNjxe0jGTmdQgpFjwQBWy','673891ef93b13dfa98604e3eed3d73da',0,0,NULL,'2023-03-07 18:09:31','2023-03-07 18:09:31',NULL,'Gaurav Krishan','','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'90549a8dec7847a51dd0d96eaf791461',0,NULL,1,'','','','','','',0,'2023-03-07 18:09:31',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(20,'','user900@infinitet3ch.com','user900@infinitet3ch.com','$2y$10$cDSbcyVO5RZU4hn7aYnU0.ZjQXBRcX8fFP6f5wdurvktLYO2dFEAC','c42d705220ff1ed0bc924dff7533b331',0,0,NULL,'2023-03-16 20:30:00','2023-03-16 20:31:49',NULL,'user900','user900','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-16 20:31:49','937aa7dc43b196b81142d17e5a54120e',0,NULL,1,'','','','','','',0,'2023-03-16 20:30:00',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(21,'','tryit123@infinitet3ch.com','tryit123@infinitet3ch.com','$2y$10$CGmJfNWC2ncJkyUdPVCDu.cpmlaJ7/KQAZB0UVoB0gC2NFS8FQLPq','c727853394714222ea2fbb9fd5846afd',0,0,NULL,'2023-03-16 20:37:12','2023-03-16 20:37:32',NULL,'tryit123','tryit123','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-16 20:37:32','ce953dac841348a1c91d57b0f7a0628b',0,NULL,1,'','','','','','',0,'2023-03-16 20:37:12',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(22,'','chs.i.nghw.shekhar@gmail.com','chs.i.nghw.shekhar@gmail.com','$2y$10$FEFh6326lilmEaXamTAwfukG8kQD4hpSXk4kjXs6mKXohmlB25t4a','20793a94b1de80833cafb1289ef6d4c8',0,0,NULL,'2023-03-17 10:41:28','2023-03-17 10:46:07',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-17 10:46:07','897b20f82bcdd29e6571669587675268',0,NULL,1,'','','','','','',0,'2023-03-17 10:41:28',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(23,'','chs.i.nghshek.har@gmail.com','chs.i.nghshek.har@gmail.com','$2y$10$THqXd/3hO0osyfbC.v8Rre7d5WtAl95vd8IvPrdLzd6GvYo3U1UgG','c308a212cdd460bb6bccaf2ad51cc5cc',0,0,NULL,'2023-03-17 10:47:40','2023-03-17 10:47:54',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-17 10:47:54','a4468feeb37aa1fecd92dcd8fb99760f',0,NULL,1,'','','','','','',0,'2023-03-17 10:47:40',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(24,'','chs.i.n.ghshek.har@gmail.com','chs.i.n.ghshek.har@gmail.com','$2y$10$sRZTEMWAHvro0B1KENxVMuePCfbEcOulKkzbpHCtMZSXlddZgmkDW','1ef49fc18fce71b3938ded0c1dcdde6b',0,0,NULL,'2023-03-17 10:50:44','2023-03-17 10:50:52',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-17 10:50:52','3928f7f6187e942c5d682b4a0dbf4315',0,NULL,1,'','','','','','',0,'2023-03-17 10:50:44',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(25,'','chandra.lkh@gmail.com','chandra.lkh@gmail.com','$2y$10$hC2BQWf6Z41Yr6NVVYRlnOEgdtqZp.HOKphECfHZ3cdKmST6itPl6','b9c3a7af04732e8c5488058c000afe94',0,0,NULL,'2023-03-17 10:57:09','2023-03-17 10:57:45',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-17 10:57:45','c7227694af4c8d7a2e441df7703ab633',0,NULL,1,'','','','','','',0,'2023-03-17 10:57:09',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(26,'','test230210430@infinitet3ch.com','test230210430@infinitet3ch.com','$2y$10$iDZPNbIrpaV4HYO7d8IZ..aE1ekvKyYFYzv4mrjcOs3VsXPzIctuW','bee27aa7e3e88f89f07a66c310d4613a',0,0,NULL,'2023-03-17 21:44:55','2023-03-17 21:45:53',NULL,'test230210430','test230210430','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-17 21:45:01','582397d33ec077f998e964cc5967ab8b',0,NULL,1,'','','','','','',0,'2023-03-17 21:44:55',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(27,'','chand.ra.lkh@gmail.com','chand.ra.lkh@gmail.com','$2y$10$j7eonEVFNJZjRkgrldcHL.rcte480zA/mdztexiMb8I8GzdGqmmRa','520635765d388c68d5a5383f47f6a787',0,0,NULL,'2023-03-21 04:33:19','2023-03-21 04:33:19',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'fc54ab3cc20b70ce89b66722cd0b4b13',0,NULL,1,'','','','','','',0,'2023-03-21 04:33:19',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(28,'','test109010@infinitet3ch.com','test109010@infinitet3ch.com','$2y$10$7DhrntVjq11KYLeXxyxcdeBRbpiNTt0B1aWQplgwjmjHjDT0jPzpW','44e4b98bd762188eda67bd1c6798973b',0,0,NULL,'2023-03-22 16:19:20','2023-03-22 16:19:20',NULL,'test109010','test109010','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'f24258f04f216fb8a5e52d5c2c880386',0,NULL,1,'','','','','','',0,'2023-03-22 16:19:20',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(29,'','t320103@infinitet3ch.com','t320103@infinitet3ch.com','$2y$10$NDLx6InhnpHDhQsqY7Mq6uZ8CHYESrRXmk/1JO.yaoHnHl5Qz9fAi','a70f7d3270603716b76bbb4cd7ca474e',0,0,NULL,'2023-03-28 18:01:56','2023-03-28 18:01:56',NULL,'t320103','t320103','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'0eb8875254eff2053ef1704db02a7666',0,NULL,1,'','','','','','',0,'2023-03-28 18:01:56',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(30,'','t2040201@infinitet3ch.com','t2040201@infinitet3ch.com','$2y$10$bxVRpBCdLADdQbU/h2HrP.AOU7EN0zo6QYw3kreegG.6O.fph52..','4f7eb2d302f3824c6feb825b27b0f687',0,0,NULL,'2023-03-28 18:03:24','2023-03-28 18:03:24',NULL,'t2040201','t2040201','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'6749aba2b291fb5b42933a6db9af5745',0,NULL,1,'','','','','','',0,'2023-03-28 18:03:24',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(31,'','t2030102@infinitet3ch.com','t2030102@infinitet3ch.com','$2y$10$qbkDoDi3DzjM2b6iDpfWg.92w0IVqXUmhpaTi2yJLwAT0rjMYuJ4C','38bf3c0432207dc5131268c045e103c8',0,0,NULL,'2023-03-28 18:03:49','2023-03-28 18:03:55',NULL,'t2030102','t2030102','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-28 18:03:55','ca6808486cad97dcac78ce03a4b3667b',0,NULL,1,'','','','','','',0,'2023-03-28 18:03:49',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(32,'','test1030302@infinitet3ch.com','test1030302@infinitet3ch.com','$2y$10$j7ZULKYUzWXzWNlrjaGYD.3Ne3ER2hy77S2PIFh2rmzhYAeUd7rWy','d59eabf2bf9204bcc32f04fdfe7010f1',0,0,NULL,'2023-03-31 20:03:43','2023-03-31 20:03:43',NULL,'test1030302','test1030302','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'ec340fae8c2904d8fa63d04eae53d093',0,NULL,1,'','','','','','',0,'2023-03-31 20:03:43',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(33,'','test1010230@infinitet3ch.com','test1010230@infinitet3ch.com','$2y$10$HV3Zn0xPatT8cKKQBjViTumIrqXzhQ481cGGw8sxOwV08Jcns90Ry','8524c3ff312092ba0168a93f8ed0f6c0',0,0,NULL,'2023-03-31 20:44:15','2023-03-31 20:44:15',NULL,'test1010230','test1010230','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'6b1fa4cf9b5427bc6e66f2587150658b',0,NULL,1,'','','','','','',0,'2023-03-31 20:44:15',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(34,'','test10102301@infinitet3ch.com','test10102301@infinitet3ch.com','$2y$10$vRVbhVOqtnF.WP.OzIhQ4OY8lgw1xzImXwaOrYIbjO7aW9UWGU9ee','eadc732c497996f9146de9531d97ba5b',0,0,NULL,'2023-03-31 20:45:00','2023-03-31 20:45:07',NULL,'test10102301','test10102301','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-03-31 20:45:07','5591198e7f3949d20f8f3c226514002c',0,NULL,1,'','','','','','',0,'2023-03-31 20:45:00',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(35,'','dhudhdj@gamilc.om','dhudhdj@gamilc.om','$2y$10$LGQ2AZguz6O7Xhg0qAmiQO/KgdjjpL40nlCK2tp.6hBI4pF0sv6jO','a78c1d48b3d18509ee6d025b55ad708c',0,0,NULL,'2023-04-02 05:29:50','2023-04-14 12:16:19',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-14 12:16:19','f9bc3be1df1b8a65d174ce2802ff601e',0,NULL,1,'','','','','','',0,'2023-04-02 05:29:50',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'sms','FR4IDCGFHQURQCJ2XDEBMC5UJRA45ORIYZLAZ4WTYTZ55RIUZ5GZ4QWZBXP67YRTM6Q2MOQI7O2WUX6U7VQA3H7YZRY4EGAM53APTMQ','','light',0,NULL,NULL),(36,'','test40131@infinitet3ch.com','test40131@infinitet3ch.com','$2y$10$QBaihW67XKk04sHuPbLvGuuEPvhLsRhdI1yNY8MqprC4kF6AXtF6m','e55631438c971b58cebfcf2e4323ae0f',0,0,NULL,'2023-04-03 16:39:42','2023-04-03 16:42:56',NULL,'test40131','test40131','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-03 16:42:56','5a4c3f386d88f9131bb976104fd60fe5',0,NULL,1,'','','','','','',0,'2023-04-03 16:39:42',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','EUOX3VJSQZQBFUBVHRVGCHJ6TPON3HDIG4DXC3GNC4PF3OYOMGYEALXDS6BMCSJTEJMPA6EJGNKR7UFQFBTJCHRYLSNFXTXAIR4HF2A','','light',0,NULL,NULL),(37,'','test401314@infinitet3ch.com','test401314@infinitet3ch.com','$2y$10$KxkMRz5m8J4K40w6AGdiIuanCzeUrZnnAlvqyyFsNsVg7JxLBobxC','72bd0c37782778891b102985ac593097',0,0,NULL,'2023-04-03 16:43:39','2023-04-03 16:44:01',NULL,'test401314','test401314','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-03 16:44:01','89a0fc69f436a540c2c7231c1ed1031e',0,NULL,1,'','','','','','',0,'2023-04-03 16:43:39',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(38,'','testtdtd11@gmail.com','testtdtd11@gmail.com','$2y$10$qMTOnAz8Be8k2rVLLpSqpOePkYQS5bJ89LPdvPXSbjvFRDuZRC.g.','f1731748d6c2fa64284e065970318b96',0,0,NULL,'2023-04-03 16:45:42','2023-04-03 16:46:07',NULL,'testtdtd11','testtdtd11','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-03 16:46:07','edaaec32660decb51cafe37561c570a8',0,NULL,1,'','','','','','',0,'2023-04-03 16:45:42',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(39,'','test-new-1@infinitet3ch.com','test-new-1@infinitet3ch.com','$2y$10$V98THfFgGvz0MEkd97SP4eedBRo0rq8vztOQivqqP0gwmgTIvMKyW','57807f862023a0acb2d114f4e96c0605',0,0,NULL,'2023-04-03 16:45:49','2023-04-03 16:46:16',NULL,'test-new-1','test-new-1','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-03 16:46:16','e38c9e2224bbfab427ac1ff3d6759caf',0,NULL,1,'','','','','','',0,'2023-04-03 16:45:49',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(40,'','teyetyet@gmail.com','teyetyet@gmail.com','$2y$10$emk99KyrONSM7UENo8RNwu.zqraOw21fET0D.ylMDBcYCVBR0752C','cab1ba36b54c2c2b7413cf9bc65ca2a6',0,0,NULL,'2023-04-03 16:50:03','2023-04-14 12:17:24',NULL,'teyetyet','teyetye','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-14 12:17:24','ca04068fd827c8fa28df5106184fa21e',0,NULL,1,'','','','','','',0,'2023-04-03 16:50:03',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','ZL3DUD35XN2LCPONKBNKDTTTAKXOQO5SRC5YD5A6R7S7F5LGYCGDMQAC427WCUOZNGG6VKZLOGUFFDX3UV2L4DKILRR3J4YYY56TUZY','','light',0,NULL,NULL),(41,'','teyetyet1@gmail.com','teyetyet1@gmail.com','$2y$10$2rWwTNa.nF/ODm0tzY1J1.y31n1cTrWMTD4F28KBIAsZwk/AZHePy','95933eea98f9f2e22bfde1f89ce9982d',0,0,NULL,'2023-04-04 11:11:26','2023-04-04 11:16:51',NULL,'teyetyet@gmail.com','teyetyet@gmail.com','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-04 11:11:53','47d67d25daf3088ac2e7887fff3165a5',0,NULL,1,'','','','','','',0,'2023-04-04 11:11:26',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','FISXL5CYX333JBCKZW7OX6LV6H6NIKD5CTZFZLVIFYPAV365ZUIOKNKABXHKDFVD3AU23QI4YXOQQGDUYW4CUKVJECHWJURQFAN7VUI','','light',0,NULL,NULL),(42,'','t10203020@infinitet3ch.com','t10203020@infinitet3ch.com','$2y$10$wB2JqVGmDHoX4C9E4PXMne7dh71dwZSwYmgCwVMfFYQGhQr.QUAji','a967114795858b0e9f27f6d29a1dfb90',0,0,NULL,'2023-04-04 17:19:16','2023-04-04 17:21:14',NULL,'t10203020','t10203020','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-04 17:21:14','2b3df3ac560b468953d7cce633ce7d19',0,NULL,1,'','','','','','',0,'2023-04-04 17:19:16',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','S75HY52WTZFY4UGRZK5WMMPUM2ERDBKGGFP5IU3RU24VSO4RN3YCUSQO7WKQU275BZSRYGIRG7WKPNPJJWRDPZEKTYGSJFXWXPSYE7I','','light',0,NULL,NULL),(43,'','dhudhdssaj@gamil.com','dhudhdssaj@gamil.com','$2y$10$fjN4UDmwjrONa9rgD6jGMecrYENTm0yAQfrGH7IJ.TLPIicwyK/Im','ba97b16f2f183f2b9af2ff07178965ac',0,0,NULL,'2023-04-05 10:46:57','2023-04-12 10:33:45',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-12 10:33:45','e3059532e60bd4e896a4ae0f6e82560c',0,NULL,1,'','','','','','',0,'2023-04-05 10:46:57',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'totp','BV6BQ4SCKVKWSU53ZVTAE36XY7YPYFDY7QVJQQXRYZ7QUME72CPDRYAXCUORGSXF7NTYPY2L5CBPHCKBGJLHWWCY75YC6WRCFBFOACI','','light',0,NULL,NULL),(44,'','dhudhdssaj1@gmail.com','dhudhdssaj1@gmail.com','$2y$10$Fx5VwARQHLPBB8Wweh7yjuqSmSRfTa0A1i6m3M8l.u3BiK.P9CeOK','b900d55552cc855f5528e4397da42a0e',0,0,NULL,'2023-04-07 11:10:11','2023-04-07 11:10:11',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'2e8ad95b5fc5f650e45b1bae537da169',0,NULL,1,'','','','','','',0,'2023-04-07 11:10:11',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(45,'','dhudhdssaj12@gamil.com','dhudhdssaj12@gamil.com','$2y$10$UFjOTuf7v15vUmIHrdWL0.bvrh8MZoarZUj8GctVN.7HJVTUSV/wm','04de59f798ef8fd0f5569f3e4da7555d',0,0,NULL,'2023-04-12 10:35:47','2023-04-18 10:17:16',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-18 10:17:16','2b2a4a000b568ea5798996eff65c7e05',0,NULL,1,'','','','','','',0,'2023-04-12 10:35:47',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'sms','NA4OQAOFW5FLYKO2DREFUHNF7BF5BLCHDRGKVP65ORGAVH2AAUUTTMJUCVNHUV5TTZTFTRLIHBLJDLDWQXU7BFFDN3AZUU3C2DS4Q7Y','','light',0,NULL,NULL),(46,'','dhudhdssaj123@gmail.com','dhudhdssaj123@gmail.com','$2y$10$X66oE7Qj4uBS2LfeES8OLusOOlE7tEXOFUB69C4w.syAyqatMIzeS','0aa46ea49cc19003233625602347d73d',0,0,NULL,'2023-04-12 12:49:07','2023-04-13 09:29:26',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-12 12:50:16','0c51be9d58c0b18304758e363cd1108f',0,NULL,1,'','','','','','',0,'2023-04-12 12:49:07',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'sms','EVUM2S2PPIGFOXHJUND6EUL4J7APSSMTSDMROOSZSI2YY5VJBEE3P6QHQWRN7TIDZNVW3JFOOVVHBF3EUYHTKMZYZOUMSPLA2XUTBFY','','light',0,NULL,NULL),(47,'','dhudhdssaj312@gamil.com','dhudhdssaj312@gamil.com','$2y$10$9xDgNhO3qupV59.gftSUCeG.l.pwqdKJLeW1jcuNL860SD/J0iwpq','0f1b621091370b4dbc45fb0031c61c7f',0,0,NULL,'2023-04-14 12:19:27','2023-04-14 13:35:19',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'','4365656546',NULL,'',NULL,NULL,NULL,0,'gold','2023-04-14 12:19:44','1c1c0b766fbd00e97535515eeac6492b',0,NULL,1,'','','','','','',0,'2023-04-14 12:19:27',0,'','',0,'0000-00-00 00:00:00','','','','',0,1,'sms','JDQV5Q4MM2DTHYYFA24PFNYUMQZGPIZCFKB457VMHX3CX6ESTRGMJFCYR6L5AVDU4SFQER233R65RBVZ6H4WHXOGJ7HGAEKQMMK3ZYQ','','light',0,NULL,NULL),(48,'','dhudhdssaj123@gamil.com','dhudhdssaj123@gamil.com','$2y$10$vOrhAoH7joqas96ZR2h9.OEnYPdgfjCAitIPjnlOwnUcTr3owSX3W','cae9d4b3c9ce074e1ed257800f6b2e9d',0,0,NULL,'2023-04-18 10:17:55','2023-04-21 17:17:09',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-21 17:17:09','dbf5803cf37ca5058437705f03b32e56',0,NULL,1,'','','','','','',0,'2023-04-18 10:17:55',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','CAX6MXZXPAP73IAB6YY2R2JWSJ6ZJ6PGBQOQXVZDKAZUJS3Z2AYTL6S2Z4CRVCCKBDIDVXB4ONB6EEX3XFLNQDABOWD2XYFKBKC7F5I','','light',0,NULL,NULL),(49,'','dhud.h.dssaj123@gamil.com','dhud.h.dssaj123@gamil.com','$2y$10$.dUi0Gtqo66Zr0fbPAey1uiiQc7RzzcsRHk2jFXJtqKweyZfY3X.W','1b20491a79f4d11c9550e20643e54473',0,0,NULL,'2023-04-21 16:55:09','2023-04-21 16:55:09',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold',NULL,'4ee593f68ac0ea4ab94cfc1a91397886',0,NULL,1,'','','','','','',0,'2023-04-21 16:55:09',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(50,'','dhudhdtyussaj123@gamil.com','dhudhdtyussaj123@gamil.com','$2y$10$cdF8Oo6/QQJDS62RkZ2LMOxhSfIFBNgMcVt/PmZ6xXsImT2g.Jkg2','a2fea8d0e0d09359383cfd3cb9d722c4',0,0,NULL,'2023-04-24 05:06:55','2023-04-24 05:08:31',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-24 05:07:54','a768303e6550cac18a30096700d71a44',0,NULL,1,'','','','','','',0,'2023-04-24 05:06:55',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','TBHT72WQVXO27OLB3YXDHOIALFCTZR2NQSTZMUCPCSBBYJ7OOMBILIAVB2X4CO76IQVVUXBACZV34D6ENUDB5S2T4WBCLDRZXF4NBRA','','light',0,NULL,NULL),(51,'','dhudhdtyus23saj123@gamil.com','dhudhdtyus23saj123@gamil.com','$2y$10$1NjGQvPgAq/.d8hpcXDvCOO88R4b4YDE3NPTNnZP6moZl.g7u.tcq','eb60154e6c2164da6c0b72fe4cf23a61',0,0,NULL,'2023-04-24 06:07:23','2023-04-25 09:35:12',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'','+16844365656546',NULL,'',NULL,NULL,NULL,0,'gold','2023-04-24 06:08:11','24ba7d0f80f0ba91bc9aae1e0ee604a0',0,NULL,1,'','','','','','',0,'2023-04-24 06:07:23',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','BYGUNX2NDYVW6NZYPOJPPHZKWFZZMYEWXILX2X67OYRUP4UETNCQF4AZELQYWS7NXVXYUFRVH42OVJCQVM2DBYROD7LY3AYEX7YGQFA','','light',0,NULL,NULL),(52,'','dhudhdtyiorsaj123@gamil.com','dhudhdtyiorsaj123@gamil.com','$2y$10$QzCNjnwRizzT0TPImdIBXOfIvyv0rcwiujROIirSy8h59SeZePWgK','4bf35aa0a88778713ac50e2266e6ee7e',0,0,NULL,'2023-04-25 09:38:02','2023-05-02 10:31:47',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'','+917541064465',NULL,'',NULL,NULL,NULL,0,'gold','2023-05-02 10:31:47','ffe84e6b03f68a2666d7b796e9d09d44',0,NULL,1,'','','','','','',0,'2023-04-25 09:38:02',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','ICMR4RBMI2VBF2QJYGAMIED63J3FGJYFAYHLNWJALUKUJ3SNHWEDGI5KALH54XACRH73PG66HH5KRUA7P3REAFXKX56G7I5Y7KAQOZY','','dark',0,NULL,NULL),(53,'','newuser@infinitet3ch.com','newuser@infinitet3ch.com','$2y$10$Oz6zGm4lwFSO6GK6pau49u8Sp61NxutUEvKdh962ZwNZxnHnobpVK','5c1b425c857179291b68bf277bc5167d',0,0,NULL,'2023-04-27 21:14:25','2023-04-27 21:25:03',NULL,'newuser','newuser','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-27 21:14:35','f635c553f69130335af7e34e948fd0b6',0,NULL,1,'','','','','','',0,'2023-04-27 21:14:25',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','YFU23P4NWWOHTJ7DLBEE6TCBSA3VPRTKEPZLMVK4NRR3OAJ5TALDJC4INAJ4H5QDSM3HEICLOWMC6JS3ISQ56CYQX7YEQ2TB2W7VHCI','','default',0,NULL,NULL),(54,'','dhudhdtyiorsaj1d23@gamil.com','dhudhdtyiorsaj1d23@gamil.com','$2y$10$arXIQD.rGbDB9jxbVaqHb.McwPIEOQX7v7BykQp/l3q7jpnOsGXKa','f09f5e0b61bdca815d872400cc102c90',0,0,NULL,'2023-04-28 10:33:07','2023-05-02 11:31:15',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-02 11:31:15','716572584973adc63f6d4892db557418',0,NULL,0,'','','','','','',0,'2023-04-28 10:33:07',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','5V2ELEWPHMXMSA7TSK6Z5OAROZGIDYCJ42AQDAE7CXNQMA42KZXXSD7IQKDQX7EZ2EERFA2HGKR6OD23D6OLPPZH5YN5EK3RE3UJ65I','','[object Object]',0,NULL,NULL),(55,'','avdbd@gmail.com','avdbd@gmail.com','$2y$10$./WabIgVYMJpvrvG3OCxEu1a3OUJiaaRW4OJfGbH6VAwCzBZFR7kO','af32935a4ae9e7b18c4b5f88c05ae554',0,0,NULL,'2023-04-29 03:31:57','2023-04-29 03:33:39',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-29 03:32:08','26225940aee546058b59e4359cd1e087',0,NULL,1,'','','','','','',0,'2023-04-29 03:31:57',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','6WJRSTSUYAVTOAQ2D3OPMF4IE2WKQOSGRITNL4VWNSCNLQYISGEPADUTFCCCYBVDEESQ6YEU26AKDXQYYQZN5RSB6ZGOY7BIOJOW3CI','','dark',0,NULL,NULL),(56,'','testtdtd1ssss1@gmail.com','testtdtd1ssss1@gmail.com','$2y$10$ql6ZFZ9O4WTCIJWKhOKuNOK/UcQin5pPVZr75RGnRjw3cB9xH.mWe','88ce282e2741ca20afe7b27312748629',0,0,NULL,'2023-04-29 03:39:46','2023-04-29 03:40:14',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-04-29 03:39:54','170af19e12a8ab95f985bc54a7af4764',0,NULL,1,'','','','','','',0,'2023-04-29 03:39:46',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','72FQRESTLT3Z33P7KFEY23VUSENWYKTFH4FD7QCYJZXCRLJB4G7Z6YXNYS7PWBRQJW6KLM6JE47ODFJNGEUMCU4PDSODDBFCDCVO3UY','','default',0,NULL,NULL),(57,'','test103010@infinitet3ch.com','test103010@infinitet3ch.com','$2y$10$Z2Ng1FeCOlRvT0.w3Xlfwee.2AxnwQ7Z9zU0rCkZ9XX9fxa5Qs2Ia','6292093f955e690d78e8241a998697f2',0,0,NULL,'2023-05-01 04:01:04','2023-05-01 04:19:52',NULL,'test103010','test103010','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-01 04:01:17','d5a0c47de81904fa8babf7fed6685bbc',0,NULL,1,'','','','','','',0,'2023-05-01 04:01:04',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','ZEPBW7UBDUBMNIICYMMTLOGQBFJ4FNT5KBN2R63F4J3VLCDFVRKBIJZZ5MJKDLNFTQDS5UOMKC4URKROO4YIRTQ76RKJKCUYV5JPGCY','','dark',0,NULL,NULL),(58,'','erdhudhdtyiorsaj1d23@gamil.com','erdhudhdtyiorsaj1d23@gamil.com','$2y$10$r0UdNfAN6CdMRiarsBlY2eIdFDwTe2Ft7KjJ0qgKulngTKxa6XWeu','8b1884795783fba4a969774b116a2064',0,0,NULL,'2023-05-01 16:16:04','2023-05-04 09:51:08',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-03 17:03:15','ef8c88d62f554f21472d243a9b33ac18',0,NULL,1,'','','','','','',0,'2023-05-01 16:16:04',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','2UUB7UZCANMFWVTL3KWVZHZGBNK2W4B66JVHSAAPBPLCFQ4VS6HVV3ZPYLRWMXP3MQQNQQNXXBWYJLBKPD2KIIMJJ45DHMLI36RUYQA','','default',0,NULL,NULL),(59,'','testtdssssstd11@gmail.com','testtdssssstd11@gmail.com','$2y$10$e6Md6vPeyB0zAMmd1RFDC.n6tQiLIfa3OSLWh/s1eeauIoqiEXBdO','efc8a31dbfacda70c48cc691223b8ec9',0,0,NULL,'2023-05-01 16:56:45','2023-05-01 17:28:49',NULL,'Chandrashekhar','Kumar','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-01 16:58:05','f94812f6855b786a3748256f733b329d',0,NULL,1,'','','','','','',0,'2023-05-01 16:56:45',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','KMRYTAANPUUDI3XW2INWW2PGEMEB533Q4LP2IDNMVVH4UDFJCSJGCDUVFV4ZHJTP3VSLEZ5NMRTXFW32LEN44XQV2Y4RDKQBOXP3X4A','','default',0,NULL,NULL),(60,'','test10130302@infinitet3ch.com','test10130302@infinitet3ch.com','$2y$10$UGuEcwwxYvhYrAUxynX05ehcHf9f2a2MBAE0Cv2hX7fLlAA33LVQq','6d036593712e877cda499011e86c5115',0,0,NULL,'2023-05-01 20:51:13','2023-05-02 02:40:25',NULL,'test10130302','test10130302','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-01 20:51:20','03ee48ae40621e4765629a94c1b61cee',0,NULL,1,'','','','','','',0,'2023-05-01 20:51:13',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','SXVSR4YHZNK74DXSII5GZAWPPTSKYTOIEN3W7UWGUIDPUE4CHRDLDY35X3S4ZMIZYZQJ4NLOTNABEYYK2NZRW3CAPJ5CYNBI6XUSUSY','','dark',0,NULL,NULL),(61,'','testuser10313@infinitet3ch.com','testuser10313@infinitet3ch.com','$2y$10$hLSbwmV2Xi0.1YDjvPPm0uqo56I0If3oatlEEzpwqYdRQthRQKIQ2','53c8db6b23da289fe205e688bdfa8bb8',0,0,NULL,'2023-05-02 18:08:16','2023-05-02 18:08:29',NULL,'testuser10313','testuser10313','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-02 18:08:29','651911a35700fa48814373ac7b2e4821',0,NULL,1,'','','','','','',0,'2023-05-02 18:08:16',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','default',0,NULL,NULL),(62,'','user910103120@infinitet3ch.com','user910103120@infinitet3ch.com','$2y$10$slgMcQXPAaPRyNnz4i4SiecLlicX4nei.GP6cDoC0h5v84YpZjI0.','9a842efc5425d5ad97f3ed44cab7a313',0,0,NULL,'2023-05-02 18:36:28','2023-05-02 18:36:35',NULL,'user910103120','user910103120','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-02 18:36:35','0b2d80b664edcbea764dad26adcb0271',0,NULL,1,'','','','','','',0,'2023-05-02 18:36:28',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','default',0,NULL,NULL),(63,'','test20403323@infinitet3ch.com','test20403323@infinitet3ch.com','$2y$10$TTn84RL94WxAuyWPufy9c.onsJ.ip3g/j3.ZO3Y1matiKnqk513by','2e104bff9ca9e9cda192269d40c3e924',0,0,NULL,'2023-05-03 17:10:30','2023-05-03 17:10:41',NULL,'test20403323','test20403323','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-03 17:10:41','d42c193768c11105e15452a309724eb6',0,NULL,1,'','','','','','',0,'2023-05-03 17:10:30',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','default',0,NULL,NULL),(64,'','user2020101@infinitet3ch.com','user2020101@infinitet3ch.com','$2y$10$nGtCZqgrAAsnTEGJR4HCY.Jif2b2dKqhhrGUSXz4ezgMJOA5p/KMS','1fa5ee21303ad5c5a7f6e5d1cd1e7a41',0,0,NULL,'2023-05-04 21:13:54','2023-05-04 21:14:23',NULL,'user2020101','user2020101','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-04 21:14:03','85a5ab746b9399bc22235089f7331901',0,NULL,1,'','','','','','',0,'2023-05-04 21:13:54',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','756E2JIVXE3YVGMUJRNXGR4VCOO2NV2NL64IJGSPBBPL6V57SU6NOPAPBCQN4W6PFDSJC54LUUDJSHQIBIIZZMF7BCOIE5TPTG2HZ7I','','default',0,NULL,NULL),(65,'','newuser1103012@infinitet3ch.com','newuser1103012@infinitet3ch.com','$2y$10$g4gpVven.iPmKQxM3Ss64echfCWW7ircQg4a46mQALIHgT2BrC1CG','085705f35be167ab52db338d23ab58b6',0,0,NULL,'2023-05-04 21:21:39','2023-05-04 21:22:14',NULL,'newuser1103012','newuser1103012','','','','','5060','',1,'trial',0,0,'',NULL,NULL,'',NULL,NULL,NULL,0,'gold','2023-05-04 21:21:54','acdb1f919aa2fcbce3878c6f4ffb8bcd',0,NULL,1,'','','','','','',0,'2023-05-04 21:21:39',0,'','',0,'0000-00-00 00:00:00','','','','',0,0,'','2A67DID2G34FQ7HMLIHWGHVQJZSQXFTEAQPDUA6D3RLUMOP45POQRQ7ZJTETE3XW3RMIEQ43SOCAKDJVVBFN6EAXBKSNDQNAHHYJY6Y','','default',0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_cards`
--

DROP TABLE IF EXISTS `users_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_cards` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `issuer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_4` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_cards_user_id_foreign` (`user_id`),
  KEY `users_cards_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `users_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_cards_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_cards`
--

LOCK TABLES `users_cards` WRITE;
/*!40000 ALTER TABLE `users_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_credits`
--

DROP TABLE IF EXISTS `users_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_credits` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `cents` double(8,2) NOT NULL,
  `source` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `balance` int NOT NULL,
  `card_id` int unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_credits_user_id_foreign` (`user_id`),
  KEY `users_credits_card_id_foreign` (`card_id`),
  CONSTRAINT `users_credits_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `users_cards` (`id`),
  CONSTRAINT `users_credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_credits`
--

LOCK TABLES `users_credits` WRITE;
/*!40000 ALTER TABLE `users_credits` DISABLE KEYS */;
INSERT INTO `users_credits` VALUES (1,'2023-01-03 23:13:54','2023-01-03 23:13:54',3,500.00,'',0,NULL,'approved'),(2,'2023-01-03 23:15:08','2023-01-03 23:15:08',4,500.00,'',0,NULL,'approved'),(3,'2023-01-12 02:25:20','2023-01-12 02:25:20',8,500.00,'',0,NULL,'approved'),(4,'2023-01-12 02:27:05','2023-01-12 02:27:05',9,500.00,'',0,NULL,'approved'),(5,'2023-01-20 07:16:26','2023-01-20 07:16:26',10,500.00,'',0,NULL,'approved'),(6,'2023-03-02 03:19:45','2023-03-02 03:19:45',14,500.00,'',0,NULL,'approved'),(7,'2023-03-02 03:24:25','2023-03-02 03:24:25',15,500.00,'',0,NULL,'approved'),(8,'2023-03-02 03:43:15','2023-03-02 03:43:15',17,500.00,'',0,NULL,'approved'),(9,'2023-03-02 16:11:04','2023-03-02 16:11:04',18,500.00,'',0,NULL,'approved'),(10,'2023-03-16 20:31:49','2023-03-16 20:31:49',20,500.00,'',0,NULL,'approved'),(11,'2023-03-16 20:37:32','2023-03-16 20:37:32',21,500.00,'',0,NULL,'approved'),(12,'2023-03-17 10:46:07','2023-03-17 10:46:07',22,500.00,'',0,NULL,'approved'),(13,'2023-03-17 10:47:54','2023-03-17 10:47:54',23,500.00,'',0,NULL,'approved'),(14,'2023-03-17 10:50:52','2023-03-17 10:50:52',24,500.00,'',0,NULL,'approved'),(15,'2023-03-17 10:57:19','2023-03-17 10:57:19',25,500.00,'',0,NULL,'approved'),(16,'2023-03-17 21:45:01','2023-03-17 21:45:01',26,500.00,'',0,NULL,'approved'),(17,'2023-03-28 18:03:55','2023-03-28 18:03:55',31,500.00,'',0,NULL,'approved'),(18,'2023-03-31 20:45:07','2023-03-31 20:45:07',34,500.00,'',0,NULL,'approved'),(19,'2023-04-02 05:30:02','2023-04-02 05:30:02',35,500.00,'',0,NULL,'approved'),(20,'2023-04-03 16:39:51','2023-04-03 16:39:51',36,500.00,'',0,NULL,'approved'),(21,'2023-04-03 16:43:49','2023-04-03 16:43:49',37,500.00,'',0,NULL,'approved'),(22,'2023-04-03 16:45:50','2023-04-03 16:45:50',38,500.00,'',0,NULL,'approved'),(23,'2023-04-03 16:45:58','2023-04-03 16:45:58',39,500.00,'',0,NULL,'approved'),(24,'2023-04-03 16:50:14','2023-04-03 16:50:14',40,500.00,'',0,NULL,'approved'),(25,'2023-04-04 11:11:42','2023-04-04 11:11:42',41,500.00,'',0,NULL,'approved'),(26,'2023-04-04 17:19:22','2023-04-04 17:19:22',42,500.00,'',0,NULL,'approved'),(27,'2023-04-05 10:47:07','2023-04-05 10:47:08',43,500.00,'',0,NULL,'approved'),(28,'2023-04-12 10:36:15','2023-04-12 10:36:15',45,500.00,'',0,NULL,'approved'),(29,'2023-04-12 12:50:16','2023-04-12 12:50:16',46,500.00,'',0,NULL,'approved'),(30,'2023-04-14 12:19:44','2023-04-14 12:19:44',47,500.00,'',0,NULL,'approved'),(31,'2023-04-18 10:18:14','2023-04-18 10:18:14',48,500.00,'',0,NULL,'approved'),(32,'2023-04-24 05:07:54','2023-04-24 05:07:54',50,500.00,'',0,NULL,'approved'),(33,'2023-04-24 06:08:11','2023-04-24 06:08:11',51,500.00,'',0,NULL,'approved'),(34,'2023-04-25 09:38:15','2023-04-25 09:38:15',52,500.00,'',0,NULL,'approved'),(35,'2023-04-27 21:14:35','2023-04-27 21:14:35',53,500.00,'',0,NULL,'approved'),(36,'2023-04-28 10:34:27','2023-04-28 10:34:27',54,500.00,'',0,NULL,'approved'),(37,'2023-04-29 03:32:08','2023-04-29 03:32:08',55,500.00,'',0,NULL,'approved'),(38,'2023-04-29 03:39:54','2023-04-29 03:39:54',56,500.00,'',0,NULL,'approved'),(39,'2023-05-01 04:01:17','2023-05-01 04:01:17',57,500.00,'',0,NULL,'approved'),(40,'2023-05-01 16:16:55','2023-05-01 16:16:55',58,500.00,'',0,NULL,'approved'),(41,'2023-05-01 16:58:05','2023-05-01 16:58:05',59,500.00,'',0,NULL,'approved'),(42,'2023-05-01 20:51:20','2023-05-01 20:51:20',60,500.00,'',0,NULL,'approved'),(43,'2023-05-02 18:08:29','2023-05-02 18:08:29',61,500.00,'',0,NULL,'approved'),(44,'2023-05-02 18:36:35','2023-05-02 18:36:35',62,500.00,'',0,NULL,'approved'),(45,'2023-05-03 17:10:41','2023-05-03 17:10:41',63,500.00,'',0,NULL,'approved'),(46,'2023-05-04 21:14:03','2023-05-04 21:14:03',64,500.00,'',0,NULL,'approved'),(47,'2023-05-04 21:21:54','2023-05-04 21:21:54',65,500.00,'',0,NULL,'approved');
/*!40000 ALTER TABLE `users_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_debits`
--

DROP TABLE IF EXISTS `users_debits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_debits` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `cents` double(8,2) NOT NULL,
  `source` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `balance` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `module_id` int DEFAULT NULL,
  `plan_snapshot` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_debits_user_id_foreign` (`user_id`),
  CONSTRAINT `users_debits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_debits`
--

LOCK TABLES `users_debits` WRITE;
/*!40000 ALTER TABLE `users_debits` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_debits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_devices`
--

DROP TABLE IF EXISTS `users_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_devices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_agent` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `trusted` tinyint(1) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `users_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_devices`
--

LOCK TABLES `users_devices` WRITE;
/*!40000 ALTER TABLE `users_devices` DISABLE KEYS */;
INSERT INTO `users_devices` VALUES (1,'2023-01-03 23:13:54','2023-01-03 23:13:54','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',1,3,'2023-01-03 23:13:54'),(2,'2023-01-03 23:15:08','2023-01-03 23:15:08','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',1,4,'2023-01-03 23:15:08'),(3,'2023-01-12 01:22:42','2023-01-12 01:22:42','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',0,2,'2023-01-12 01:22:42'),(4,'2023-01-12 01:23:04','2023-01-12 01:23:04','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',0,1,'2023-01-12 01:23:04'),(5,'2023-01-12 02:25:20','2023-01-12 02:25:20','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36',1,8,'2023-01-12 02:25:20'),(6,'2023-01-12 02:27:05','2023-01-12 02:27:05','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Mobile Safari/537.36',1,9,'2023-01-12 02:27:05'),(7,'2023-01-20 07:16:26','2023-01-20 07:16:26','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',1,10,'2023-01-20 07:16:26'),(8,'2023-01-20 07:16:40','2023-01-20 07:16:40','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',0,2,'2023-01-20 07:16:40'),(9,'2023-02-09 09:52:33','2023-02-09 09:52:33','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',0,2,'2023-02-09 09:52:33'),(10,'2023-02-15 05:39:58','2023-02-15 05:39:58','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',0,2,'2023-02-15 05:39:58'),(11,'2023-02-20 15:31:05','2023-02-20 15:31:05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',0,2,'2023-02-20 15:31:05'),(12,'2023-02-23 02:23:52','2023-02-23 02:23:52','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36',0,2,'2023-02-23 02:23:52'),(13,'2023-02-28 04:31:08','2023-02-28 04:31:08','Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1',0,2,'2023-02-28 04:31:08'),(14,'2023-03-01 21:04:32','2023-03-01 21:04:32','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',0,1,'2023-03-01 21:04:32'),(15,'2023-03-02 03:19:45','2023-03-02 03:19:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',1,14,'2023-03-02 03:19:45'),(16,'2023-03-02 03:24:25','2023-03-02 03:24:25','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',1,15,'2023-03-02 03:24:25'),(17,'2023-03-02 03:43:15','2023-03-02 03:43:15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',1,17,'2023-03-02 03:43:15'),(18,'2023-03-02 16:11:04','2023-03-02 16:11:04','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',1,18,'2023-03-02 16:11:04'),(19,'2023-03-10 14:03:30','2023-03-10 14:03:30','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',0,2,'2023-03-10 14:03:30'),(20,'2023-03-16 20:18:25','2023-03-16 20:18:25','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',0,2,'2023-03-16 20:18:25'),(21,'2023-03-16 20:18:43','2023-03-16 20:18:43','Mozilla/5.0 (iPad; CPU OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/87.0.4280.77 Mobile/15E148 Safari/604.1',0,2,'2023-03-16 20:18:43'),(22,'2023-03-16 20:31:49','2023-03-16 20:31:49','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,20,'2023-03-16 20:31:49'),(23,'2023-03-16 20:37:32','2023-03-16 20:37:32','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,21,'2023-03-16 20:37:32'),(24,'2023-03-17 10:46:07','2023-03-17 10:46:07','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,22,'2023-03-17 10:46:07'),(25,'2023-03-17 10:47:54','2023-03-17 10:47:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,23,'2023-03-17 10:47:54'),(26,'2023-03-17 10:50:52','2023-03-17 10:50:52','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,24,'2023-03-17 10:50:52'),(27,'2023-03-17 10:57:19','2023-03-17 10:57:19','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,25,'2023-03-17 10:57:19'),(28,'2023-03-17 21:45:01','2023-03-17 21:45:01','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,26,'2023-03-17 21:45:01'),(29,'2023-03-23 18:11:10','2023-03-23 18:11:10','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',0,1,'2023-03-23 18:11:10'),(30,'2023-03-28 18:03:55','2023-03-28 18:03:55','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,31,'2023-03-28 18:03:55'),(31,'2023-03-31 20:42:02','2023-03-31 20:42:02','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/111.0',0,2,'2023-03-31 20:42:02'),(32,'2023-03-31 20:45:07','2023-03-31 20:45:07','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,34,'2023-03-31 20:45:07'),(33,'2023-04-02 05:30:02','2023-04-02 05:30:02','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,35,'2023-04-02 05:30:02'),(34,'2023-04-03 16:39:51','2023-04-03 16:39:51','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,36,'2023-04-03 16:39:51'),(35,'2023-04-03 16:43:49','2023-04-03 16:43:49','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,37,'2023-04-03 16:43:49'),(36,'2023-04-03 16:45:50','2023-04-03 16:45:50','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,38,'2023-04-03 16:45:50'),(37,'2023-04-03 16:45:58','2023-04-03 16:45:58','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,39,'2023-04-03 16:45:58'),(38,'2023-04-03 16:50:14','2023-04-03 16:50:14','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,40,'2023-04-03 16:50:14'),(39,'2023-04-04 11:11:42','2023-04-04 11:11:42','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,41,'2023-04-04 11:11:42'),(40,'2023-04-04 17:19:22','2023-04-04 17:19:22','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,42,'2023-04-04 17:19:22'),(41,'2023-04-05 10:47:08','2023-04-05 10:47:08','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36',1,43,'2023-04-05 10:47:08'),(42,'2023-04-07 09:39:16','2023-04-07 09:39:16','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',0,43,'2023-04-07 09:39:16'),(43,'2023-04-12 10:36:15','2023-04-12 10:36:15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,45,'2023-04-12 10:36:15'),(44,'2023-04-12 12:50:16','2023-04-12 12:50:16','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,46,'2023-04-12 12:50:16'),(45,'2023-04-14 12:15:46','2023-04-14 12:15:46','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',0,2,'2023-04-14 12:15:46'),(46,'2023-04-14 12:16:18','2023-04-14 12:16:18','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',0,35,'2023-04-14 12:16:18'),(47,'2023-04-14 12:17:20','2023-04-14 12:17:20','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',0,40,'2023-04-14 12:17:20'),(48,'2023-04-14 12:19:44','2023-04-14 12:19:44','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,47,'2023-04-14 12:19:44'),(49,'2023-04-18 10:18:14','2023-04-18 10:18:14','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,48,'2023-04-18 10:18:14'),(50,'2023-04-24 05:07:54','2023-04-24 05:07:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,50,'2023-04-24 05:07:54'),(51,'2023-04-24 06:08:11','2023-04-24 06:08:11','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,51,'2023-04-24 06:08:11'),(52,'2023-04-25 09:38:15','2023-04-25 09:38:15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,52,'2023-04-25 09:38:15'),(53,'2023-04-27 21:13:52','2023-04-27 21:13:52','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',0,2,'2023-04-27 21:13:52'),(54,'2023-04-27 21:14:35','2023-04-27 21:14:35','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,53,'2023-04-27 21:14:35'),(55,'2023-04-28 10:34:27','2023-04-28 10:34:27','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,54,'2023-04-28 10:34:27'),(56,'2023-04-29 03:32:08','2023-04-29 03:32:08','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,55,'2023-04-29 03:32:08'),(57,'2023-04-29 03:39:54','2023-04-29 03:39:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,56,'2023-04-29 03:39:54'),(58,'2023-05-01 04:01:17','2023-05-01 04:01:17','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,57,'2023-05-01 04:01:17'),(59,'2023-05-01 16:16:55','2023-05-01 16:16:55','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,58,'2023-05-01 16:16:55'),(60,'2023-05-01 16:58:05','2023-05-01 16:58:05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,59,'2023-05-01 16:58:05'),(61,'2023-05-01 20:51:20','2023-05-01 20:51:20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,60,'2023-05-01 20:51:20'),(62,'2023-05-02 18:08:29','2023-05-02 18:08:29','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,61,'2023-05-02 18:08:29'),(63,'2023-05-02 18:36:35','2023-05-02 18:36:35','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,62,'2023-05-02 18:36:35'),(64,'2023-05-03 17:10:41','2023-05-03 17:10:41','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,63,'2023-05-03 17:10:41'),(65,'2023-05-04 21:14:03','2023-05-04 21:14:03','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,64,'2023-05-04 21:14:03'),(66,'2023-05-04 21:21:54','2023-05-04 21:21:54','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',1,65,'2023-05-04 21:21:54');
/*!40000 ALTER TABLE `users_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_invoices`
--

DROP TABLE IF EXISTS `users_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_invoices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `cents` double(8,2) NOT NULL,
  `source` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `balance` int NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `call_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `recording_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `fax_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `membership_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `number_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `cents_collected` double(8,2) NOT NULL DEFAULT '0.00',
  `last_attempted` datetime DEFAULT NULL,
  `num_attempts` int NOT NULL DEFAULT '0',
  `due_date` datetime DEFAULT NULL,
  `complete_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_invoices_user_id_foreign` (`user_id`),
  KEY `users_invoices_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `users_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_invoices_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_invoices`
--

LOCK TABLES `users_invoices` WRITE;
/*!40000 ALTER TABLE `users_invoices` DISABLE KEYS */;
INSERT INTO `users_invoices` VALUES (1,'2023-05-04 22:32:54','2023-05-04 22:32:54',1,100000.00,'','INCOMPLETE',1,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:32:54','0000-00-00 00:00:00'),(2,'2023-05-04 22:33:18','2023-05-04 22:33:18',1,100000.00,'','INCOMPLETE',2,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:33:18','0000-00-00 00:00:00'),(3,'2023-05-04 22:37:57','2023-05-04 22:37:57',1,100000.00,'','INCOMPLETE',3,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:37:57','0000-00-00 00:00:00'),(4,'2023-05-04 22:39:05','2023-05-04 22:39:05',1,100000.00,'','INCOMPLETE',4,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:39:05','0000-00-00 00:00:00'),(5,'2023-05-04 22:39:44','2023-05-04 22:39:44',1,100000.00,'','INCOMPLETE',5,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:39:44','0000-00-00 00:00:00'),(6,'2023-05-04 22:40:15','2023-05-04 22:40:15',1,100000.00,'','INCOMPLETE',6,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:40:15','0000-00-00 00:00:00'),(7,'2023-05-04 22:52:06','2023-05-04 22:52:06',1,100000.00,'','INCOMPLETE',7,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:52:06','0000-00-00 00:00:00'),(8,'2023-05-04 22:52:28','2023-05-04 22:52:28',1,100000.00,'','INCOMPLETE',8,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 22:52:28','0000-00-00 00:00:00'),(9,'2023-05-04 23:01:22','2023-05-04 23:01:22',1,100000.00,'','INCOMPLETE',9,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:01:22','0000-00-00 00:00:00'),(10,'2023-05-04 23:04:48','2023-05-04 23:04:48',1,100000.00,'','INCOMPLETE',10,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:04:48','0000-00-00 00:00:00'),(11,'2023-05-04 23:04:55','2023-05-04 23:04:55',1,100000.00,'','INCOMPLETE',11,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:04:55','0000-00-00 00:00:00'),(12,'2023-05-04 23:05:12','2023-05-04 23:05:12',1,100000.00,'','INCOMPLETE',12,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:05:12','0000-00-00 00:00:00'),(13,'2023-05-04 23:05:23','2023-05-04 23:05:23',1,100000.00,'','INCOMPLETE',13,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:05:23','0000-00-00 00:00:00'),(14,'2023-05-04 23:22:39','2023-05-04 23:22:39',1,100000.00,'','INCOMPLETE',14,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:22:39','0000-00-00 00:00:00'),(15,'2023-05-04 23:23:20','2023-05-04 23:23:20',1,100000.00,'','INCOMPLETE',15,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:23:20','0000-00-00 00:00:00'),(16,'2023-05-04 23:23:22','2023-05-04 23:23:22',1,100000.00,'','INCOMPLETE',16,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:23:22','0000-00-00 00:00:00'),(17,'2023-05-04 23:23:55','2023-05-04 23:23:55',1,100000.00,'','INCOMPLETE',17,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:23:55','0000-00-00 00:00:00'),(18,'2023-05-04 23:23:56','2023-05-04 23:23:56',1,100000.00,'','INCOMPLETE',18,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:23:56','0000-00-00 00:00:00'),(19,'2023-05-04 23:25:04','2023-05-04 23:25:04',1,100000.00,'','INCOMPLETE',19,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:25:04','0000-00-00 00:00:00'),(20,'2023-05-04 23:26:56','2023-05-04 23:26:56',1,100000.00,'','INCOMPLETE',20,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:26:56','0000-00-00 00:00:00'),(21,'2023-05-04 23:28:01','2023-05-04 23:28:01',1,100000.00,'','INCOMPLETE',21,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:28:01','0000-00-00 00:00:00'),(22,'2023-05-04 23:28:16','2023-05-04 23:28:16',1,100000.00,'','INCOMPLETE',22,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:28:16','0000-00-00 00:00:00'),(23,'2023-05-04 23:29:18','2023-05-04 23:29:18',1,100000.00,'','INCOMPLETE',23,1,20000.00,20000.00,20000.00,20000.00,20000.00,0.00,NULL,0,'2023-05-31 23:29:18','0000-00-00 00:00:00'),(24,'2023-05-04 23:31:44','2023-05-04 23:31:44',1,10000.00,'','INCOMPLETE',23,1,2000.00,2000.00,2000.00,2000.00,2000.00,0.00,NULL,0,'2023-05-31 23:31:44','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_invoices_line_items`
--

DROP TABLE IF EXISTS `users_invoices_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_invoices_line_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cents` double(8,2) NOT NULL DEFAULT '0.00',
  `invoice_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_invoices_line_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `users_invoices_line_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `users_invoices` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_invoices_line_items`
--

LOCK TABLES `users_invoices_line_items` WRITE;
/*!40000 ALTER TABLE `users_invoices_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_invoices_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verified_callerids`
--

DROP TABLE IF EXISTS `verified_callerids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verified_callerids` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `verified_callerids_public_id_unique` (`public_id`),
  KEY `verified_callerids_user_id_foreign` (`user_id`),
  KEY `verified_callerids_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `verified_callerids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `verified_callerids_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verified_callerids`
--

LOCK TABLES `verified_callerids` WRITE;
/*!40000 ALTER TABLE `verified_callerids` DISABLE KEYS */;
/*!40000 ALTER TABLE `verified_callerids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_templates`
--

DROP TABLE IF EXISTS `widget_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widget_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_templates_user_id_foreign` (`user_id`),
  KEY `widget_templates_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `widget_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `widget_templates_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_templates`
--

LOCK TABLES `widget_templates` WRITE;
/*!40000 ALTER TABLE `widget_templates` DISABLE KEYS */;
INSERT INTO `widget_templates` VALUES (1,'2023-05-01 21:35:40','2023-05-01 21:35:40','supportq','{\"attributes\":{\"name\":\"Bridge\",\"type\":\"devs.BridgeModel\",\"size\":{\"width\":320,\"height\":100},\"attrs\":{\".body\":{\"stroke\":\"#395373\",\"strokeWidth\":1,\"ref-width\":\"100%\",\"ref-height\":\"100%\"},\"rect\":{\"fill\":\"#395373\"},\"circle\":[],\".label\":{\"text\":\"Bridge\",\"fill\":\"#385374\",\"ref-y\":20,\"ref-x\":0.5,\"font-size\":\"18\",\"text-anchor\":\"middle\"},\".description\":{\"text\":\"Connect this call to an extension\\/phone\",\"fill\":\"#395373\",\"ref-y\":60,\"font-size\":\"12px\",\"ref-x\":0.5,\"text-anchor\":\"middle\"},\".inPorts circle\":{\"fill\":\"#c8c8c8\",\"stroke\":\"#E3E3E3\"},\".base-body\":{\"fill\":\"#FFFFFF\",\"stroke\":\"#385374\",\"strokeMiterlimit\":\"10\",\"overflow\":\"visible\"},\".line\":{\"fill\":\"none\",\"stroke\":\"#ECE5F0\",\"strokeMiterlimit\":\"10\"},\".st5\":{\"fill\":\"#36D576\"},\".st6\":{\"fill\":\"#E88915\"},\".st7\":{\"fill\":\"#E46298\"},\".st9\":{\"fill\":\"#385374\"},\".icon-stroke\":{\"fill\":\"none\",\"stroke\":\"#36D576\",\"strokeMiterlimit\":\"10\"},\".font-Roboto\":{\"fontFamily\":\"\\\"Roboto-Regular\\\", Arial, Helvetica, sans-serif\",\"fill\":\"#385374\"},\".font-16\":{\"fontSize\":\"16px\"},\".font-14\":{\"fontSize\":\"14px\"},\".font-10\":{\"fontSize\":\"10px\"},\".\":{\"magnet\":false,\"fill\":\"#ffffff\",\"stroke\":\"none\"}},\"inPorts\":[\"In\"],\"outPorts\":[\"Connected Call Ended\",\"Caller Hung Uo\"],\"ports\":{\"groups\":{\"in\":{\"position\":\"top\",\"label\":{\"position\":{\"name\":\"manual\",\"args\":{\"y\":-10,\"x\":-140,\"attrs\":{\".\":{\"text-anchor\":\"middle\"}}}}},\"attrs\":{\".port-label\":{\"ref-x\":-140,\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":-140,\"ref-y\":0,\"stroke-width\":2,\"stroke\":\"#36D576\",\"fill\":\"#36D576\",\"padding\":20,\"magnet\":true}}},\"out\":{\"position\":\"bottom\",\"label\":{\"position\":\"outside\"},\"attrs\":{\".port-label\":{\"fill\":\"#385374\"},\".port-body\":{\"r\":5,\"ref-x\":0,\"ref-y\":0,\"stroke-width\":5,\"stroke\":\"#385374\",\"fill\":\"#000878\",\"padding\":2,\"magnet\":true}}}},\"items\":[{\"id\":\"In\",\"group\":\"in\",\"attrs\":{\".port-label\":{\"text\":\"In\"}}},{\"id\":\"Connected Call Ended\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Connected Call Ended\"}}},{\"id\":\"Caller Hung Uo\",\"group\":\"out\",\"attrs\":{\".port-label\":{\"text\":\"Caller Hung Uo\"}}}]},\"position\":{\"x\":595,\"y\":306.1999816894531},\"angle\":0,\"id\":\"5edc9eba-293a-4688-aa05-382fe6001c73\",\"z\":2},\"saved\":[],\"name\":\"Bridge\"}',60,56);
/*!40000 ALTER TABLE `widget_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_templates_tags`
--

DROP TABLE IF EXISTS `widget_templates_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widget_templates_tags` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `template_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_templates_tags_template_id_foreign` (`template_id`),
  CONSTRAINT `widget_templates_tags_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `widget_templates` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_templates_tags`
--

LOCK TABLES `widget_templates_tags` WRITE;
/*!40000 ALTER TABLE `widget_templates_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `widget_templates_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspace_params`
--

DROP TABLE IF EXISTS `workspace_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspace_params` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workspace_params_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `workspace_params_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspace_params`
--

LOCK TABLES `workspace_params` WRITE;
/*!40000 ALTER TABLE `workspace_params` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspace_params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces`
--

DROP TABLE IF EXISTS `workspaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `creator_id` int unsigned NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `api_secret` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `byo_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `outbound_macro_id` int unsigned DEFAULT NULL,
  `ip_whitelist_disabled` tinyint(1) NOT NULL DEFAULT '1',
  `plan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pay-as-you-go',
  `trial_mode` tinyint(1) NOT NULL DEFAULT '0',
  `free_trial_started` datetime NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `default_region` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_term` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  `external_app_workspace` tinyint(1) NOT NULL DEFAULT '0',
  `billing_country_id` int unsigned DEFAULT NULL,
  `billing_region_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workspaces_creator_id_foreign` (`creator_id`),
  KEY `workspaces_outbound_macro_id_foreign` (`outbound_macro_id`),
  KEY `workspaces_flow_id_foreign` (`flow_id`),
  KEY `workspaces_billing_country_id_foreign` (`billing_country_id`),
  KEY `workspaces_billing_region_id_foreign` (`billing_region_id`),
  CONSTRAINT `workspaces_billing_country_id_foreign` FOREIGN KEY (`billing_country_id`) REFERENCES `billing_countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `workspaces_billing_region_id_foreign` FOREIGN KEY (`billing_region_id`) REFERENCES `billing_regions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `workspaces_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `router_flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_outbound_macro_id_foreign` FOREIGN KEY (`outbound_macro_id`) REFERENCES `macro_functions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces`
--

LOCK TABLES `workspaces` WRITE;
/*!40000 ALTER TABLE `workspaces` DISABLE KEYS */;
INSERT INTO `workspaces` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','admin',1,'9055e954fe2e175771f98aee0a7ca73e','75a895056d95ed41efa52b7480165ce24bd9d2a7f5fb0c57348d5ddd1d6d0897',0,NULL,1,'ultimate',0,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','workspace',2,'f7f35bd426dcb9a8780423948245f1ab','411975b75af40d126918c765f0119d1b3c27cbf8f53fc6f504d4b8dbc341a1b1',0,NULL,1,'ultimate',0,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(3,'2023-01-03 23:13:49','2023-01-03 23:13:54','user408',3,'f6af3ff99b174179a45d040214ba63ee','579ac6cda73589f3e5ad72638436e2f19761a491aea5eddcf5077a3107e21e2e',0,NULL,1,'pay-as-you-go',1,'2023-01-03 23:13:52',NULL,'ca-central-1','none',0,NULL,NULL),(4,'2023-01-03 23:15:02','2023-01-03 23:15:08','user411',4,'04d8dd54a4f284bfd1a14fbb9e985fe3','0c2d3f07382ff0242e643fc09bc75898aff420c1181980ca6c0b95a9934164fe',0,NULL,1,'pay-as-you-go',1,'2023-01-03 23:15:05',NULL,'ca-central-1','none',0,NULL,NULL),(5,'2023-01-12 01:25:28','2023-01-12 01:25:28','163bf61883560e',5,'e1032346896123519b03601ec0c2b40a','6531f0cb07c20a86879b10b2a0779d320c3d144101f2420167f82bda644f5e27',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(6,'2023-01-12 01:30:48','2023-01-12 01:30:48','163bf62c82ba0c',6,'02835c6db39e79a3dca1b2de64a5f832','60412f3902e5585c51adabf94a45c7608795d76285d9401a1cdb4cd1c109c605',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(7,'2023-01-12 02:18:43','2023-01-12 02:22:27','test231',7,'8a2c196aae3520aef07798e83ea92886','d720a109a274dbe4f8b25f214924531a50c309ecb676cfa064f0dfbe57a4849b',0,NULL,1,'pay-as-you-go',1,'2023-01-12 02:18:53',NULL,'ca-central-1','none',0,NULL,NULL),(8,'2023-01-12 02:25:08','2023-01-12 02:25:20','user301',8,'975e98a1e5784909e7afaabbd8c8c136','f16b5b3499a970cb132a66b00512cf5a050ecf4af91591e9d2cbeb5351875f90',0,NULL,1,'pay-as-you-go',1,'2023-01-12 02:25:10',NULL,'ca-central-1','none',0,NULL,NULL),(9,'2023-01-12 02:26:49','2023-01-12 02:27:05','user306',9,'6bec52f9c43ecf2fb72bc17c499174a3','5946f226c5a1fcba7322a657b4f4f6eef046411ffdc6fb9a490ec851cb5d8db5',0,NULL,1,'pay-as-you-go',1,'2023-01-12 02:26:53',NULL,'ca-central-1','none',0,NULL,NULL),(10,'2023-01-20 07:16:12','2023-01-20 07:16:26','user812',10,'6cb22c3d1562139dd4f8afcd93f9b570','bdcd53d8513ffeb36c45fd69bc270f2bbd242bf0208a70df3042ff6c95f56296',0,NULL,1,'pay-as-you-go',1,'2023-01-20 07:16:18',NULL,'ca-central-1','none',0,NULL,NULL),(11,'2023-03-02 03:18:49','2023-03-02 03:19:45','test-chandra',14,'fb8658a6bb1b513234166474784cdd9e','970d59758e48153ebedc0d82c5fded1164fad96ef04b1f1a50ce149fcd8df489',0,NULL,1,'pay-as-you-go',1,'2023-03-02 03:19:18',NULL,'ca-central-1','none',0,NULL,NULL),(12,'2023-03-02 03:22:57','2023-03-02 03:24:25','testing-chandra',15,'6f1b8690063f681f86cdc0176f56f5f2','50036f7bad82b0bf318702c86bba2de70efffc4f198261f32d2515f9d74c299c',0,NULL,1,'pay-as-you-go',1,'2023-03-02 03:24:19',NULL,'ca-central-1','none',0,NULL,NULL),(13,'2023-03-02 03:29:51','2023-03-02 03:29:51','16400182f4c6eb',16,'016bf432ced7d5208f0595394c1c4816','98c1be2a50fc07aa13e8d0a2febdd68734bbadc7543051feafbb3c7515eb45f3',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(14,'2023-03-02 03:42:55','2023-03-02 03:43:15','test-activedss',17,'19085423567c3eefac31c531002c69f0','9049bc2cfdeda55023f779be631ee564992b793f1466bdaaed2230172ce2e335',0,NULL,1,'pay-as-you-go',1,'2023-03-02 03:43:06',NULL,'ca-central-1','none',0,NULL,NULL),(15,'2023-03-02 16:10:54','2023-03-02 16:11:04','test909',18,'edc9389aa6df89266dcbd60b1e39ad81','4f08c8f2e6b0c92e5748d110f495c1cf822b6d368b4ecebc37c5343a7d267958',0,NULL,1,'pay-as-you-go',1,'2023-03-02 16:10:58',NULL,'ca-central-1','none',0,NULL,NULL),(16,'2023-03-16 20:30:00','2023-03-16 20:31:49','test10201',20,'7fa44003f69947736db6947e50ed5179','be05abc6c52e149ba6e0a1244fe6ef8c17cf34f9229cb821d88866c1761bf188',0,NULL,1,'pay-as-you-go',1,'2023-03-16 20:31:39',NULL,'ca-central-1','none',0,NULL,NULL),(17,'2023-03-16 20:37:12','2023-03-16 20:37:32','tryit123',21,'43c9ed3b939ef1c13bd835b9b3cedf03','b2574729e5242e6d70a4b703dd1a2093dd08e15356f43bd84f71eb6bc15f9c09',0,NULL,1,'pay-as-you-go',1,'2023-03-16 20:37:18',NULL,'ca-central-1','none',0,NULL,NULL),(18,'2023-03-17 10:41:28','2023-03-17 10:46:07','testing-chandra-78',22,'46898ac8d1a839ed39341bb0f36b16ed','b9d3890c9365fff1856ea31b37d88e517e2437f2757546e6afec50d1f000fa14',0,NULL,1,'pay-as-you-go',1,'2023-03-17 10:44:19',NULL,'ca-central-1','none',0,NULL,NULL),(19,'2023-03-17 10:47:40','2023-03-17 10:47:54','35656353',23,'7fc977c803c2667f844e0b76f5b6d3ba','bd6da7afa738d6646d7bb950ebe6e52dc058d5204ef841f16aace1092d80bbd1',0,NULL,1,'pay-as-you-go',1,'2023-03-17 10:47:50',NULL,'ca-central-1','none',0,NULL,NULL),(20,'2023-03-17 10:50:44','2023-03-17 10:50:52','68768687',24,'0d496faf6deccdac0677a8385f56f36f','0c881197797294283b73984573f6f46a528a235063ffae2f94704eccdd0bca12',0,NULL,1,'pay-as-you-go',1,'2023-03-17 10:50:49',NULL,'ca-central-1','none',0,NULL,NULL),(21,'2023-03-17 10:57:09','2023-03-17 10:57:19','e8787873214',25,'5f6eb785f66776f77f89e545c7eed1ff','f6158f2e21316c0e6e2e14007b2eefe2c0e0cd2f15e4b8b223a726dfde970b98',0,NULL,1,'pay-as-you-go',1,'2023-03-17 10:57:15',NULL,'ca-central-1','none',0,NULL,NULL),(22,'2023-03-17 21:44:55','2023-03-17 21:45:01','test230210430',26,'956309001d15e3d30806493746dba272','89b9edfed3bf7f30e83a8bb30e5fa9d93ea56674689dd86ec36dc275cc9fe177',0,NULL,1,'pay-as-you-go',1,'2023-03-17 21:44:58',NULL,'ca-central-1','none',0,NULL,NULL),(23,'2023-03-21 04:33:19','2023-03-21 04:33:19','16419338f01f3e',27,'62b6c9deb4947db448b67603e22e39a8','c428bdb8b892661e12202cac2b3c439c4ddffdabeb9a9071c40f1e8f1aff6c96',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(24,'2023-03-22 16:19:20','2023-03-22 16:19:20','1641b2a88da185',28,'3004cb123e059117243a6b597b999f79','13fba19c4b6b0b2efadcb71de556a6374ed2503f74f720e67f4e8f3acc51cd3b',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(25,'2023-03-28 18:01:56','2023-03-28 18:01:56','164232b9498d5c',29,'319a366cca964e637dd10288e3dea64b','dd90be3bf4de6cbfd136efeb0befd134a0195529144fc5170f8ad009c08e8aff',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(26,'2023-03-28 18:03:24','2023-03-28 18:03:24','164232becd0920',30,'4c75e1e314ec8c79141003f40f09f823','4a1feb12bd9cbac95b3a01c056c69f2ea2096445896082584a9b54668208dc13',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(27,'2023-03-28 18:03:49','2023-03-28 18:03:55','t2030102',31,'055c5daf15820d7f3886f54088efced4','91cd6ac259f5d0452c838a4991492eb7fb99a841c0119b9485ffdd6f15976b2a',0,NULL,1,'pay-as-you-go',1,'2023-03-28 18:03:52',NULL,'ca-central-1','none',0,NULL,NULL),(28,'2023-03-31 20:03:43','2023-03-31 20:03:43','164273c9fc9cbc',32,'29b0db74d456189d1773480de5caada2','926b9392eb07d132e2618085b33fd35a69bde5909ad4e5ca2f7cf9ee27959270',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(29,'2023-03-31 20:44:15','2023-03-31 20:44:15','16427461fbc4f5',33,'8d40fc07496dd2651774059805dd7bf6','1fde9d1c1790504fe332bd203cb3b93db72da0b82e987ee1fac2673ad0cbf212',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(30,'2023-03-31 20:45:00','2023-03-31 20:45:07','test10102301',34,'2d2e9eb6af065fb1fa9a8178508148e8','36375d9176da75b6d0566ebe474889d031f7ca681338aa6e6e01fbd4a7f5a31c',0,NULL,1,'pay-as-you-go',1,'2023-03-31 20:45:04',NULL,'ca-central-1','none',0,NULL,NULL),(31,'2023-04-02 05:29:50','2023-04-02 05:30:02','we3rwe',35,'9db6e5b5378120334ac0f337c68cfaaf','9a70f7e26e57c56a1dff37a546517dc5f27ac90fccb6b613ce424add1e88be2f',0,NULL,1,'pay-as-you-go',1,'2023-04-02 05:29:55',NULL,'ca-central-1','none',0,NULL,NULL),(32,'2023-04-03 16:39:42','2023-04-03 16:39:51','test40131',36,'ac8dbdab785d6126b1e9b4afd320aadb','00d84bf9f1db198967fad4214e5175e24f3292006fa0d790cbddc8cd64973c5e',0,NULL,1,'pay-as-you-go',1,'2023-04-03 16:39:46',NULL,'ca-central-1','none',0,NULL,NULL),(33,'2023-04-03 16:43:39','2023-04-03 16:43:49','test401314',37,'82b313a8438d46a43b5952f69f7d10e1','54618f13601facfb785f75021d10d4c962181bcaf0097b3eb0785592020fdfd4',0,NULL,1,'pay-as-you-go',1,'2023-04-03 16:43:44',NULL,'ca-central-1','none',0,NULL,NULL),(34,'2023-04-03 16:45:42','2023-04-03 16:45:50','testtdtd11',38,'b08ffe0c9c1db97efcc809378b8c7461','323fcbd6b4a6dfd10c282e867bb4097e4348844adc18e20aa7065c8c5ea29946',0,NULL,1,'pay-as-you-go',1,'2023-04-03 16:45:46',NULL,'ca-central-1','none',0,NULL,NULL),(35,'2023-04-03 16:45:49','2023-04-03 16:45:58','test-new-1',39,'699f31b5a1340c7f4f1930eb4d9bd6f1','baa720fc069f605f606a3d1592f194294a1aa6b67aa506edf5ffc3a3898e927e',0,NULL,1,'pay-as-you-go',1,'2023-04-03 16:45:53',NULL,'ca-central-1','none',0,NULL,NULL),(36,'2023-04-03 16:50:03','2023-04-03 16:50:14','teyetyet',40,'88e6c92183cce4cb41367f61f3072c99','d83cd1299b15872b74a90a51556886fa7e9119aed422782d28b55f1d3851edbb',0,NULL,1,'pay-as-you-go',1,'2023-04-03 16:50:10',NULL,'ca-central-1','none',0,NULL,NULL),(37,'2023-04-04 11:11:26','2023-04-04 11:11:42','teyetyet1',41,'80cee0f87c9ddd1dbb7acf50b1dcb3da','ee3b6e2348943a8653ac909b0a98c87ce36f648d1671ff5b4081f89375232533',0,NULL,1,'pay-as-you-go',1,'2023-04-04 11:11:38',NULL,'ca-central-1','none',0,NULL,NULL),(38,'2023-04-04 17:19:16','2023-04-04 17:19:22','t10203020',42,'6bcffc1c7ccda60a2be91297cacf404d','64e87af9a8c7da81740649f1caef0ec3cb29e5000647011ae9e586170bf982a3',0,NULL,1,'pay-as-you-go',1,'2023-04-04 17:19:19',NULL,'ca-central-1','none',0,NULL,NULL),(39,'2023-04-05 10:46:57','2023-04-05 10:47:07','dhudhdssaj',43,'ed782a7ae1d6a5816c83cba366e8ae66','862692d5a75318b0fcf1eec0342cb332949b212efc7dd17eaea8f165f3ff00c0',0,NULL,1,'pay-as-you-go',1,'2023-04-05 10:47:03',NULL,'ca-central-1','none',0,NULL,NULL),(40,'2023-04-07 11:10:11','2023-04-07 11:10:11','1642ffa13da321',44,'3bf4af647dc83d28c6c0241bdcfc4234','ad80a5cace2d6d3a17e71523c1ba56f769054720cf016c68c3fa76d1d5e81e03',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(41,'2023-04-12 10:35:47','2023-04-12 10:36:15','testing-chandra-12',45,'7361a9dc6a158aa1369cb9a9e010b41d','ad2b543629e5ff0c662de1b120e64178f45a4e63a7ef4d41470452b1842e0bbf',0,NULL,1,'pay-as-you-go',1,'2023-04-12 10:36:02',NULL,'ca-central-1','none',0,NULL,NULL),(42,'2023-04-12 12:49:07','2023-04-12 12:50:16','testing-chandra123',46,'3240a1e9c5c68aff3ba155525d7a2961','6d72c62e6b1ab272d0f32dd900ef4f0e210c4131c77490ea690a563224163075',0,NULL,1,'pay-as-you-go',1,'2023-04-12 12:50:10',NULL,'ca-central-1','none',0,NULL,NULL),(43,'2023-04-14 12:19:27','2023-04-14 12:19:44','testing-chandra-123',47,'d05c3d980568a649f443959e0fefa6d9','5f92e198c0cb40dee6ada067103c263fbb81a6442424e37e6019ed00955fee81',0,NULL,1,'pay-as-you-go',1,'2023-04-14 12:19:40',NULL,'ca-central-1','none',0,NULL,NULL),(44,'2023-04-18 10:17:55','2023-04-18 10:18:14','wewqeqwe',48,'3d63f56145f9a5ffee130828357f2620','a75625fcbb32e5adff687390c3582b338bce9d8d8fd2f8d571824356fa5fbb48',0,NULL,1,'pay-as-you-go',1,'2023-04-18 10:18:01',NULL,'ca-central-1','none',0,NULL,NULL),(45,'2023-04-21 16:55:09','2023-04-21 16:55:09','16442bfedaf658',49,'d06bf15155a42bb94ebea02f2fa101d5','66fff944bb53c94390bfe491c66bff52326c80e77112660c74c00b474218592c',0,NULL,1,'pay-as-you-go',1,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL),(46,'2023-04-24 05:06:55','2023-04-24 05:07:54','6565657',50,'b6f13f662c4f8aef9d52b6f7f84a0886','97e6f43ba436d6d5bf262900f1c7554a3e65d74215e22d7d4b7581fdb6e8aabf',0,NULL,1,'pay-as-you-go',1,'2023-04-24 05:07:09',NULL,'ca-central-1','none',0,NULL,NULL),(47,'2023-04-24 06:07:23','2023-04-24 06:08:11','213241',51,'8c24cbb214c1d2400ad95c287c6f3783','e86f6d318bb5659237224969dfc1796b53c9b5071488021ac0b57890573a6a6a',0,NULL,1,'pay-as-you-go',1,'2023-04-24 06:07:32',NULL,'ca-central-1','none',0,NULL,NULL),(48,'2023-04-25 09:38:02','2023-04-25 09:38:15','324335235',52,'6981839847c6bc060bfcee649f273b11','d4cbfe7670c640f6d4e4753bae94c8320773bd2fe62d3f92509886f9a113ed7e',0,NULL,1,'pay-as-you-go',1,'2023-04-25 09:38:09',NULL,'ca-central-1','none',0,NULL,NULL),(49,'2023-04-27 21:14:25','2023-04-27 21:14:35','newuser',53,'0b7755ec37ded14988b5ab77f370e66c','9d5d6abb3c210ad9ecf49b509d17f11cd07061fb8701b2a3bd976851d5cb29aa',0,NULL,1,'pay-as-you-go',1,'2023-04-27 21:14:32',NULL,'ca-central-1','none',0,NULL,NULL),(50,'2023-04-28 10:33:07','2023-05-01 09:34:00','uhkhkj',54,'dec4ae2694cf0756f00635a77023ca2a','ad7054ef2873e0f52ba638cc7e311365a88f991a620963de38a036983fc3d79e',0,NULL,1,'pay-as-you-go',1,'2023-04-28 10:34:22',NULL,'ca-central-1','none',0,NULL,NULL),(51,'2023-04-29 03:31:57','2023-04-29 03:32:08','76786876869869869',55,'b004ea25daabde22c61d5515e70b8e47','eeab0ae7be11c64778a3654cda40d71d7e3f71d1b3a21ed0a5dfe90e9f9730f5',0,NULL,1,'pay-as-you-go',1,'2023-04-29 03:32:03',NULL,'ca-central-1','none',0,NULL,NULL),(52,'2023-04-29 03:39:46','2023-04-29 03:39:54','sadsfdsfdsf',56,'65234835dd15ed30c47e784b5ff28698','88c73afcf2c6174358d44cee8ee70602134ca92d209a4ed80815719bde2a2ddf',0,NULL,1,'pay-as-you-go',1,'2023-04-29 03:39:50',NULL,'ca-central-1','none',0,NULL,NULL),(53,'2023-05-01 04:01:04','2023-05-01 04:01:17','test103010',57,'bd0001f7d17954f3f4b0d63f55d94f66','fd11644e9a3b7175118ed7b24144bbdc21970368b87727055503e13a07641a23',0,NULL,1,'pay-as-you-go',1,'2023-05-01 04:01:08',NULL,'ca-central-1','none',0,NULL,NULL),(54,'2023-05-01 16:16:04','2023-05-01 16:16:55','eeqwewwe',58,'563db5a2eecbc4db65fca3c7b869bccb','d2e9d9993d7d51b989183becd8dea8393cc904696b9452ec89c22120bc024613',0,NULL,1,'pay-as-you-go',1,'2023-05-01 16:16:50',NULL,'ca-central-1','none',0,NULL,NULL),(55,'2023-05-01 16:56:45','2023-05-01 16:58:05','68768687687687',59,'cf8a1d2b07c067f373f6581ac53fb6ab','350b04544283931769f99913ea07bdaf1ef623dc91161aed47460180b7175f59',0,NULL,1,'pay-as-you-go',1,'2023-05-01 16:56:57',NULL,'ca-central-1','none',0,NULL,NULL),(56,'2023-05-01 20:51:13','2023-05-01 20:51:20','test10130302',60,'f80dfb691d6bd0b6c439ea2f1181e166','309484e7264d8bd9dc5e803635a97acb375d6f5f1caefb937df63da369e4ccdd',0,NULL,1,'pay-as-you-go',1,'2023-05-01 20:51:16',NULL,'ca-central-1','none',0,NULL,NULL),(57,'2023-05-02 18:08:16','2023-05-02 18:08:29','testuser10313',61,'74aa943a46ce486b07db4bfb807ffe4d','dc372350e6d409fbbb3e430725a151461ae64dee845e8180c2cef75ac0cb9893',0,NULL,1,'pay-as-you-go',1,'2023-05-02 18:08:20',NULL,'ca-central-1','none',0,NULL,NULL),(58,'2023-05-02 18:36:28','2023-05-02 18:36:35','user910103120',62,'0293d8a0ef33dcd2c464cf88f27f0bc1','0f6a75e67ad63c8e0de855d49f642b4b29fb5575aac48d976839eada54003e5c',0,NULL,1,'pay-as-you-go',1,'2023-05-02 18:36:32',NULL,'ca-central-1','none',0,NULL,NULL),(59,'2023-05-03 17:10:30','2023-05-03 17:10:41','test20403323',63,'e686fc1fa7961f32bbe0bac120c68ea1','6e32b54859e324135c396a83a7fa3bbe3d76aa13f58ed2ee729bafeefc5aa07b',0,NULL,1,'pay-as-you-go',1,'2023-05-03 17:10:36',NULL,'ca-central-1','none',0,NULL,NULL),(60,'2023-05-04 21:13:54','2023-05-04 21:14:03','user2020101',64,'6a60e4b0c687773ec0702bd6333da230','57de2152f23c0abee1c5d80ee7e024defc3c34d480ae1803f4122d1806a564c4',0,NULL,1,'pay-as-you-go',1,'2023-05-04 21:13:59',NULL,'ca-central-1','none',0,NULL,NULL),(61,'2023-05-04 21:21:39','2023-05-04 21:21:54','newuser1103012',65,'fcb6f938c2db04a1ef121b458ee42722','80a938dffa3f94ad2a2e53513795042c7549b0fbb646f5bd333efc11009b8c11',0,NULL,1,'pay-as-you-go',1,'2023-05-04 21:21:48',NULL,'ca-central-1','none',0,NULL,NULL);
/*!40000 ALTER TABLE `workspaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_events`
--

DROP TABLE IF EXISTS `workspaces_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_events` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `plan_snapshot` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `processed_by_billing` tinyint(1) NOT NULL DEFAULT '0',
  `plan_term` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`),
  KEY `workspaces_events_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `workspaces_events_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_events`
--

LOCK TABLES `workspaces_events` WRITE;
/*!40000 ALTER TABLE `workspaces_events` DISABLE KEYS */;
INSERT INTO `workspaces_events` VALUES (1,'2023-03-16 06:22:50','2023-03-16 06:22:50',1,'WORKSPACE_CREATED','ultimate',0,'none'),(2,'2023-03-16 06:23:04','2023-03-16 06:23:04',1,'WORKSPACE_UPGRADED','ultimate',0,'none'),(3,'2023-03-16 06:23:16','2023-03-16 06:23:16',1,'WORKSPACE_UPGRADED','ultimate',0,'none'),(4,'2023-03-16 20:30:00','2023-03-16 20:30:00',16,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(5,'2023-03-16 20:37:12','2023-03-16 20:37:12',17,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(6,'2023-03-17 10:41:28','2023-03-17 10:41:28',18,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(7,'2023-03-17 10:47:40','2023-03-17 10:47:40',19,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(8,'2023-03-17 10:50:44','2023-03-17 10:50:44',20,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(9,'2023-03-17 10:57:09','2023-03-17 10:57:09',21,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(10,'2023-03-17 21:44:55','2023-03-17 21:44:55',22,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(11,'2023-03-21 04:33:19','2023-03-21 04:33:19',23,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(12,'2023-03-22 16:19:20','2023-03-22 16:19:20',24,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(13,'2023-03-28 18:01:56','2023-03-28 18:01:56',25,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(14,'2023-03-28 18:03:24','2023-03-28 18:03:24',26,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(15,'2023-03-28 18:03:49','2023-03-28 18:03:49',27,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(16,'2023-03-31 20:03:43','2023-03-31 20:03:43',28,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(17,'2023-03-31 20:44:15','2023-03-31 20:44:15',29,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(18,'2023-03-31 20:45:00','2023-03-31 20:45:00',30,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(19,'2023-04-02 05:29:50','2023-04-02 05:29:50',31,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(20,'2023-04-03 16:39:42','2023-04-03 16:39:42',32,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(21,'2023-04-03 16:43:39','2023-04-03 16:43:39',33,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(22,'2023-04-03 16:45:43','2023-04-03 16:45:43',34,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(23,'2023-04-03 16:45:49','2023-04-03 16:45:49',35,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(24,'2023-04-03 16:50:03','2023-04-03 16:50:03',36,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(25,'2023-04-04 11:11:26','2023-04-04 11:11:26',37,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(26,'2023-04-04 17:19:16','2023-04-04 17:19:16',38,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(27,'2023-04-05 10:46:57','2023-04-05 10:46:57',39,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(28,'2023-04-07 11:10:11','2023-04-07 11:10:11',40,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(29,'2023-04-12 10:35:47','2023-04-12 10:35:47',41,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(30,'2023-04-12 12:49:07','2023-04-12 12:49:07',42,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(31,'2023-04-14 12:19:27','2023-04-14 12:19:27',43,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(32,'2023-04-18 10:17:55','2023-04-18 10:17:55',44,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(33,'2023-04-21 16:55:09','2023-04-21 16:55:09',45,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(34,'2023-04-24 05:06:55','2023-04-24 05:06:55',46,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(35,'2023-04-24 06:07:23','2023-04-24 06:07:23',47,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(36,'2023-04-25 09:38:02','2023-04-25 09:38:02',48,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(37,'2023-04-27 21:14:25','2023-04-27 21:14:25',49,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(38,'2023-04-28 10:33:07','2023-04-28 10:33:07',50,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(39,'2023-04-29 03:31:57','2023-04-29 03:31:57',51,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(40,'2023-04-29 03:39:46','2023-04-29 03:39:46',52,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(41,'2023-05-01 04:01:04','2023-05-01 04:01:04',53,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(42,'2023-05-01 16:16:04','2023-05-01 16:16:04',54,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(43,'2023-05-01 16:56:45','2023-05-01 16:56:45',55,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(44,'2023-05-01 20:51:13','2023-05-01 20:51:13',56,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(45,'2023-05-02 18:08:16','2023-05-02 18:08:16',57,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(46,'2023-05-02 18:36:28','2023-05-02 18:36:28',58,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(47,'2023-05-03 17:10:30','2023-05-03 17:10:30',59,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(48,'2023-05-04 21:13:54','2023-05-04 21:13:54',60,'WORKSPACE_CREATED','pay-as-you-go',0,'none'),(49,'2023-05-04 21:21:39','2023-05-04 21:21:39',61,'WORKSPACE_CREATED','pay-as-you-go',0,'none');
/*!40000 ALTER TABLE `workspaces_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_events_properties`
--

DROP TABLE IF EXISTS `workspaces_events_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_events_properties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_id` int unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `workspaces_events_properties_event_id_foreign` (`event_id`),
  CONSTRAINT `workspaces_events_properties_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `workspaces_events` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_events_properties`
--

LOCK TABLES `workspaces_events_properties` WRITE;
/*!40000 ALTER TABLE `workspaces_events_properties` DISABLE KEYS */;
INSERT INTO `workspaces_events_properties` VALUES (1,'2023-03-16 06:23:16','2023-03-16 06:23:16',3,'test','one');
/*!40000 ALTER TABLE `workspaces_events_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_events_props`
--

DROP TABLE IF EXISTS `workspaces_events_props`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_events_props` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_id` int unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `workspaces_events_props_event_id_foreign` (`event_id`),
  CONSTRAINT `workspaces_events_props_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `workspaces_events` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_events_props`
--

LOCK TABLES `workspaces_events_props` WRITE;
/*!40000 ALTER TABLE `workspaces_events_props` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspaces_events_props` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_invites`
--

DROP TABLE IF EXISTS `workspaces_invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_invites` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned DEFAULT NULL,
  `workspace_user_id` int unsigned DEFAULT NULL,
  `expires_on` datetime NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workspaces_invites_workspace_id_foreign` (`workspace_id`),
  KEY `workspaces_invites_workspace_user_id_foreign` (`workspace_user_id`),
  CONSTRAINT `workspaces_invites_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_invites_workspace_user_id_foreign` FOREIGN KEY (`workspace_user_id`) REFERENCES `workspaces_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_invites`
--

LOCK TABLES `workspaces_invites` WRITE;
/*!40000 ALTER TABLE `workspaces_invites` DISABLE KEYS */;
INSERT INTO `workspaces_invites` VALUES (5,'2023-02-23 22:03:42','2023-02-23 22:03:42',2,2,'2023-03-02 00:00:00',1,'f0cc378d6cac0c4d0d2f3f243a71c7b8'),(6,'2023-02-23 22:03:42','2023-02-23 22:03:42',2,2,'2023-03-02 00:00:00',1,'ceabefd259ce077ba30e30c8f94ec825');
/*!40000 ALTER TABLE `workspaces_invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_regions`
--

DROP TABLE IF EXISTS `workspaces_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_regions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `internal_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workspaces_regions_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `workspaces_regions_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_regions`
--

LOCK TABLES `workspaces_regions` WRITE;
/*!40000 ALTER TABLE `workspaces_regions` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspaces_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_routing_flows`
--

DROP TABLE IF EXISTS `workspaces_routing_flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_routing_flows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `origin_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `dest_code` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `flow_id` int unsigned NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `country_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workspaces_routing_flows_flow_id_foreign` (`flow_id`),
  KEY `workspaces_routing_flows_workspace_id_foreign` (`workspace_id`),
  KEY `workspaces_routing_flows_country_id_foreign` (`country_id`),
  CONSTRAINT `workspaces_routing_flows_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `sip_countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_routing_flows_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `router_flows` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_routing_flows_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_routing_flows`
--

LOCK TABLES `workspaces_routing_flows` WRITE;
/*!40000 ALTER TABLE `workspaces_routing_flows` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspaces_routing_flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_sip_webhooks`
--

DROP TABLE IF EXISTS `workspaces_sip_webhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_sip_webhooks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `http_url` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `workspaces_sip_webhooks_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `workspaces_sip_webhooks_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_sip_webhooks`
--

LOCK TABLES `workspaces_sip_webhooks` WRITE;
/*!40000 ALTER TABLE `workspaces_sip_webhooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspaces_sip_webhooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workspaces_users`
--

DROP TABLE IF EXISTS `workspaces_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspaces_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workspace_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `manage_users` tinyint(1) NOT NULL,
  `manage_extensions` tinyint(1) NOT NULL,
  `create_extension` tinyint(1) NOT NULL,
  `manage_billing` tinyint(1) NOT NULL,
  `manage_workspace` tinyint(1) NOT NULL,
  `manage_dids` tinyint(1) NOT NULL,
  `create_did` tinyint(1) NOT NULL,
  `manage_calls` tinyint(1) NOT NULL,
  `manage_recordings` tinyint(1) NOT NULL,
  `manage_blocked_numbers` tinyint(1) NOT NULL,
  `manage_ip_whitelist` tinyint(1) NOT NULL,
  `manage_verified_caller_ids` tinyint(1) NOT NULL,
  `create_flow` tinyint(1) NOT NULL,
  `manage_flows` tinyint(1) NOT NULL,
  `public_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `manage_functions` tinyint(1) NOT NULL,
  `create_function` tinyint(1) NOT NULL,
  `manage_params` tinyint(1) NOT NULL DEFAULT '0',
  `manage_extension_codes` tinyint(1) NOT NULL DEFAULT '0',
  `manage_ports` tinyint(1) NOT NULL DEFAULT '0',
  `manage_phones` tinyint(1) NOT NULL DEFAULT '0',
  `create_phone` tinyint(1) NOT NULL DEFAULT '0',
  `manage_phonegroups` tinyint(1) NOT NULL,
  `create_phonegroup` tinyint(1) NOT NULL,
  `create_phoneglobalsetting` tinyint(1) NOT NULL,
  `manage_phoneglobalsettings` tinyint(1) NOT NULL,
  `create_phoneindividualsetting` tinyint(1) NOT NULL,
  `manage_phoneindividualsettings` tinyint(1) NOT NULL,
  `hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `hash_expired` tinyint(1) NOT NULL DEFAULT '0',
  `manage_byo_carriers` tinyint(1) NOT NULL DEFAULT '0',
  `create_byo_carrier` tinyint(1) NOT NULL DEFAULT '0',
  `manage_byo_did_numbers` tinyint(1) NOT NULL DEFAULT '0',
  `create_byo_did_number` tinyint(1) NOT NULL DEFAULT '0',
  `extension_id` int unsigned DEFAULT NULL,
  `number_id` int unsigned DEFAULT NULL,
  `preferred_pop` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'ca-central-1',
  `create_trunks` tinyint(1) NOT NULL,
  `manage_trunks` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `workspaces_users_public_id_unique` (`public_id`),
  KEY `workspaces_users_workspace_id_foreign` (`workspace_id`),
  KEY `workspaces_users_user_id_foreign` (`user_id`),
  KEY `workspaces_users_extension_id_foreign` (`extension_id`),
  KEY `workspaces_users_number_id_foreign` (`number_id`),
  CONSTRAINT `workspaces_users_extension_id_foreign` FOREIGN KEY (`extension_id`) REFERENCES `extensions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_users_number_id_foreign` FOREIGN KEY (`number_id`) REFERENCES `did_numbers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_users_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_users`
--

LOCK TABLES `workspaces_users` WRITE;
/*!40000 ALTER TABLE `workspaces_users` DISABLE KEYS */;
INSERT INTO `workspaces_users` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-85fc437e-1db5-4551-9de4-bfe7fe62e5d6',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,0,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26',2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-6756e732-5b5d-45fd-8b6a-179abd39a214',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,0,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(3,'2023-01-03 23:13:49','2023-01-03 23:13:49',3,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-712438e1-cc77-42ea-8a4e-4eb0ca19e48c',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(4,'2023-01-03 23:15:02','2023-01-03 23:15:02',4,4,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-8efd3bf8-3ecd-4cb5-956a-0b33c65060de',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(5,'2023-01-12 01:25:28','2023-01-12 01:25:28',5,5,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-87ee4f4b-9a22-48c3-8c3d-8a292c0206e5',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(6,'2023-01-12 01:30:48','2023-01-12 01:30:48',6,6,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-93061e22-5ddb-4c86-b567-e11451bbbd60',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(7,'2023-01-12 02:18:43','2023-01-12 02:18:43',7,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-85f03cd4-1b94-4af2-a702-b0c07f112ee0',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(8,'2023-01-12 02:25:08','2023-01-12 02:25:08',8,8,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-036c6bd9-899b-4d8d-b3bc-689aaad8fa67',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(9,'2023-01-12 02:26:49','2023-01-12 02:26:49',9,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-2ed89b77-9d23-430e-95f5-210a169d04da',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(10,'2023-01-20 07:16:12','2023-01-20 07:16:12',10,10,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-5e9a4342-fea2-47c6-9c11-890444f377f6',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(12,'2023-03-02 03:18:49','2023-03-02 03:18:49',11,14,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-55e36810-2702-4d8c-ae72-652171a46446',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(13,'2023-03-02 03:22:57','2023-03-02 03:22:57',12,15,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-f89c1fbc-5ec9-4759-8fcb-cf2ab229dfcb',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(14,'2023-03-02 03:29:51','2023-03-02 03:29:51',13,16,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-e5b25dac-fe9d-4503-b16d-070549f51c88',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(15,'2023-03-02 03:42:55','2023-03-02 03:42:55',14,17,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-2171e4a5-706e-4cbc-83a7-f67bb4ba5f6b',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(16,'2023-03-02 16:10:54','2023-03-02 16:10:54',15,18,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-5d9b3676-14d7-4ab6-878b-444c21bcf4f7',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(17,'2023-03-16 20:30:00','2023-03-16 20:30:00',16,20,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-0399cc4f-b2a9-4415-b709-3e6ddd95868d',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(18,'2023-03-16 20:37:12','2023-03-16 20:37:12',17,21,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-3f45e22a-7fba-4a09-ad21-89b9ad037953',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(19,'2023-03-17 10:41:28','2023-03-17 10:41:28',18,22,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-1aadf4c8-8b41-4b36-85b4-8ab85056d7dd',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(20,'2023-03-17 10:47:40','2023-03-17 10:47:40',19,23,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-acebb6ae-9a99-424a-a710-901da31394c6',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(21,'2023-03-17 10:50:44','2023-03-17 10:50:44',20,24,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-ad2e3cb9-2245-499a-8f7d-60ab13134f6b',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(22,'2023-03-17 10:57:09','2023-03-17 10:57:09',21,25,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-8f462192-74ad-4906-82b3-2a4613ca61f0',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(23,'2023-03-17 21:44:55','2023-03-17 21:44:55',22,26,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-b49db92e-4f43-41ed-b9b6-dc505eea007d',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(24,'2023-03-21 04:33:19','2023-03-21 04:33:19',23,27,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-4a4bd93d-2636-4abe-96d2-2addfce2d5fa',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(25,'2023-03-22 16:19:20','2023-03-22 16:19:20',24,28,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-0e9cfb92-aded-4642-95d6-bebaed5fb858',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(26,'2023-03-28 18:01:56','2023-03-28 18:01:56',25,29,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-6d5ec82d-100e-4da4-9cf0-6761eaba5c22',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(27,'2023-03-28 18:03:24','2023-03-28 18:03:24',26,30,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-e9e59373-6831-4cde-9068-e5141e2f820c',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(28,'2023-03-28 18:03:49','2023-03-28 18:03:49',27,31,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-1e9b6268-9a21-45eb-9885-d106f30663f4',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(29,'2023-03-31 20:03:43','2023-03-31 20:03:43',28,32,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-97e1172a-02f8-4cdc-9a9f-dca011283549',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(30,'2023-03-31 20:44:15','2023-03-31 20:44:15',29,33,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-3ea7b7aa-0c1e-4a54-a97c-748979a4e998',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(31,'2023-03-31 20:45:00','2023-03-31 20:45:00',30,34,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-faa54d82-6bb2-453a-b83f-ba1b898a1032',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(32,'2023-04-02 05:29:50','2023-04-02 05:29:50',31,35,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-a8be55ff-5b8e-4221-9ac8-c9b323838088',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(33,'2023-04-03 16:39:42','2023-04-03 16:39:42',32,36,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-ee7da381-7264-4abf-ba1c-b54ed63f8116',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(34,'2023-04-03 16:43:39','2023-04-03 16:43:39',33,37,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-077d87e3-60ae-4396-9f9a-edd7c6203e64',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(35,'2023-04-03 16:45:43','2023-04-03 16:45:43',34,38,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-f3325dcc-c69b-4057-aba7-ef3c0b5639f6',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(36,'2023-04-03 16:45:49','2023-04-03 16:45:49',35,39,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-89c93ea4-3085-464d-97d1-a5d9d49328d5',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(37,'2023-04-03 16:50:03','2023-04-03 16:50:03',36,40,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-abb7c1bf-328a-4d47-b3c5-a9386e518b11',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(38,'2023-04-04 11:11:26','2023-04-04 11:11:26',37,41,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-76aa4901-8e88-4021-ba9f-dce09a2b536c',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(39,'2023-04-04 17:19:16','2023-04-04 17:19:16',38,42,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-525d398f-3748-4c60-91e3-1ecc8eab3932',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(40,'2023-04-05 10:46:57','2023-04-05 10:46:57',39,43,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-a26ec8c9-6875-470d-83e2-42c3d4881e61',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(41,'2023-04-07 11:10:11','2023-04-07 11:10:11',40,44,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-44ecf142-2fe9-4ea1-9909-231ff1331ea5',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(42,'2023-04-12 10:35:47','2023-04-12 10:35:47',41,45,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-c1ff8989-f3eb-401a-87d8-d1e876e580ea',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(43,'2023-04-12 12:49:07','2023-04-12 12:49:07',42,46,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-cba95729-9a55-402b-8bd2-eb042c44d17b',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(44,'2023-04-14 12:19:27','2023-04-14 12:19:27',43,47,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-7c16b3e5-817d-4df8-9f5d-7f79726f58e2',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(45,'2023-04-18 10:17:55','2023-04-18 10:17:55',44,48,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-6b484abd-6a0e-46cf-83ce-1fe8d05c0eed',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(46,'2023-04-21 16:55:09','2023-04-21 16:55:09',45,49,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-de80640d-ce63-4026-9636-7b3182a029a3',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(47,'2023-04-24 05:06:55','2023-04-24 05:06:55',46,50,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-f1c3c55f-ea38-4dc6-aedb-c87e95ea0821',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(48,'2023-04-24 06:07:23','2023-04-24 06:07:23',47,51,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-f54ccaa5-a6a8-4583-829e-29cf950403f7',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(49,'2023-04-25 09:38:02','2023-04-25 09:38:02',48,52,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-a3d06b76-058d-41e4-a0fb-30bc734559f4',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(50,'2023-04-27 21:14:25','2023-04-27 21:14:25',49,53,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-59dab187-5f0d-4f21-a788-bad3baba0245',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(51,'2023-04-28 10:33:07','2023-04-28 10:33:07',50,54,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-9a39d322-607e-44c5-b34a-d8901877e658',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(52,'2023-04-29 03:31:57','2023-04-29 03:31:57',51,55,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-39a69142-e80b-46ec-9d50-75566cf44116',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(53,'2023-04-29 03:39:46','2023-04-29 03:39:46',52,56,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-e5898b62-3573-4e12-b24b-fa683f5c4c0d',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(54,'2023-05-01 04:01:04','2023-05-01 04:01:04',53,57,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-37bb296b-e2be-4151-a2e7-59c77b2d708a',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(55,'2023-05-01 16:16:04','2023-05-01 16:16:04',54,58,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-a636ded1-5ad9-49c2-af5f-17ad32b4d9d5',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(56,'2023-05-01 16:56:45','2023-05-01 16:56:45',55,59,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-da745331-fae3-4b02-ae8f-98515b40d552',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(57,'2023-05-01 20:51:13','2023-05-01 20:51:13',56,60,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-e167be46-9ee0-4c77-86a5-83496b3f96f5',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(58,'2023-05-02 18:08:16','2023-05-02 18:08:16',57,61,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-332d4e5c-7172-4f9d-a5a4-b73fa50982df',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(59,'2023-05-02 18:36:28','2023-05-02 18:36:28',58,62,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-de790539-cbf9-4560-a3e2-a3471ef93fc2',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(60,'2023-05-03 17:10:30','2023-05-03 17:10:30',59,63,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-a310601a-ce67-4afa-8b3a-d6a42a2c2b65',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(61,'2023-05-04 21:13:54','2023-05-04 21:13:54',60,64,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-7ecdcb2a-32b4-402a-b043-5c5d11bd6ef3',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1),(62,'2023-05-04 21:21:39','2023-05-04 21:21:39',61,65,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-f23650b5-5573-43cb-97b2-feecdf6b2b03',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,1,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1);
/*!40000 ALTER TABLE `workspaces_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-04 23:33:08