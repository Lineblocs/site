-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: lineblocs
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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
CREATE Database IF NOT EXISTS lineblocs;
USE lineblocs;

GRANT ALL ON `lineblocs`.* TO 'root_lineblocs'@'%';

DROP TABLE IF EXISTS `api_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_credentials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aws_access_key_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `aws_secret_access_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `aws_region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'us-east-1',
  `stripe_pub_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_private_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_test_pub_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_test_private_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `stripe_mode` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_host` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_port` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `smtp_tls` tinyint(1) NOT NULL DEFAULT '0',
  `google_service_account_json` varchar(8192) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `storage_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `tts_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `api_user_rpm` int NOT NULL DEFAULT '100',
  `api_carrier_rpm` int NOT NULL DEFAULT '100',
  `setup_complete` tinyint(1) NOT NULL DEFAULT '0',
  `namecheap_api_user` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `namecheap_api_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `namecheap_api_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `google_signin_key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `msft_signin_key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `apple_signin_key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `google_signin_developer_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_client_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_client_secret` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `msft_signin_client_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `msft_signin_client_secret` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `apple_signin_client_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `apple_signin_client_secret` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_signin_app_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `google_analytics_script_tag` varchar(2048) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `matomo_script_tag` varchar(2048) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_credentials`
--

LOCK TABLES `api_credentials` WRITE;
/*!40000 ALTER TABLE `api_credentials` DISABLE KEYS */;
INSERT INTO `api_credentials` VALUES (32,'2023-06-06 18:29:48','2023-06-06 18:29:48','','','us-east-1','','','','','','','','','',0,'','','',100,100,0,'','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `api_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_logins`
--

DROP TABLE IF EXISTS `app_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned DEFAULT NULL,
  `app_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `core_app` tinyint(1) NOT NULL DEFAULT '0',
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `app_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_logins`
--

LOCK TABLES `app_logins` WRITE;
/*!40000 ALTER TABLE `app_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_logins` ENABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `iso` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_countries`
--

LOCK TABLES `billing_countries` WRITE;
/*!40000 ALTER TABLE `billing_countries` DISABLE KEYS */;
INSERT INTO `billing_countries` VALUES (4,'2023-05-08 17:27:21','2023-05-08 17:27:21','United States','us'),(5,'2023-05-08 17:27:21','2023-05-08 17:27:21','Canada','ca');
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `billing_country_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `billing_regions_billing_country_id_foreign` (`billing_country_id`),
  CONSTRAINT `billing_regions_billing_country_id_foreign` FOREIGN KEY (`billing_country_id`) REFERENCES `billing_countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_regions`
--

LOCK TABLES `billing_regions` WRITE;
/*!40000 ALTER TABLE `billing_regions` DISABLE KEYS */;
INSERT INTO `billing_regions` VALUES (67,'2023-05-08 17:27:21','2023-05-08 17:27:21','Alabama','Alabama',4),(68,'2023-05-08 17:27:21','2023-05-08 17:27:21','Alaska','Alaska',4),(69,'2023-05-08 17:27:21','2023-05-08 17:27:21','Arizona','Arizona',4),(70,'2023-05-08 17:27:21','2023-05-08 17:27:21','Arkansas','Arkansas',4),(71,'2023-05-08 17:27:21','2023-05-08 17:27:21','California','California',4),(72,'2023-05-08 17:27:21','2023-05-08 17:27:21','Colorado','Colorado',4),(73,'2023-05-08 17:27:21','2023-05-08 17:27:21','Connecticut','Connecticut',4),(74,'2023-05-08 17:27:21','2023-05-08 17:27:21','Delaware','Delaware',4),(75,'2023-05-08 17:27:21','2023-05-08 17:27:21','District of Columbia','District of Columbia',4),(76,'2023-05-08 17:27:21','2023-05-08 17:27:21','Florida','Florida',4),(77,'2023-05-08 17:27:21','2023-05-08 17:27:21','Georgia','Georgia',4),(78,'2023-05-08 17:27:21','2023-05-08 17:27:21','Hawaii','Hawaii',4),(79,'2023-05-08 17:27:21','2023-05-08 17:27:21','Idaho','Idaho',4),(80,'2023-05-08 17:27:21','2023-05-08 17:27:21','Illinois','Illinois',4),(81,'2023-05-08 17:27:21','2023-05-08 17:27:21','Indiana','Indiana',4),(82,'2023-05-08 17:27:21','2023-05-08 17:27:21','Iowa','Iowa',4),(83,'2023-05-08 17:27:21','2023-05-08 17:27:21','Kansas','Kansas',4),(84,'2023-05-08 17:27:21','2023-05-08 17:27:21','Kentucky','Kentucky',4),(85,'2023-05-08 17:27:21','2023-05-08 17:27:21','Louisiana','Louisiana',4),(86,'2023-05-08 17:27:21','2023-05-08 17:27:21','Maine','Maine',4),(87,'2023-05-08 17:27:21','2023-05-08 17:27:21','Maryland','Maryland',4),(88,'2023-05-08 17:27:21','2023-05-08 17:27:21','Massachusetts','Massachusetts',4),(89,'2023-05-08 17:27:21','2023-05-08 17:27:21','Michigan','Michigan',4),(90,'2023-05-08 17:27:21','2023-05-08 17:27:21','Minnesota','Minnesota',4),(91,'2023-05-08 17:27:21','2023-05-08 17:27:21','Mississippi','Mississippi',4),(92,'2023-05-08 17:27:21','2023-05-08 17:27:21','Missouri','Missouri',4),(93,'2023-05-08 17:27:21','2023-05-08 17:27:21','Montana','Montana',4),(94,'2023-05-08 17:27:21','2023-05-08 17:27:21','Nebraska','Nebraska',4),(95,'2023-05-08 17:27:21','2023-05-08 17:27:21','Nevada','Nevada',4),(96,'2023-05-08 17:27:21','2023-05-08 17:27:21','New Hampshire','New Hampshire',4),(97,'2023-05-08 17:27:21','2023-05-08 17:27:21','New Jersey','New Jersey',4),(98,'2023-05-08 17:27:21','2023-05-08 17:27:21','New Mexico','New Mexico',4),(99,'2023-05-08 17:27:21','2023-05-08 17:27:21','New York','New York',4),(100,'2023-05-08 17:27:21','2023-05-08 17:27:21','North Carolina','North Carolina',4),(101,'2023-05-08 17:27:21','2023-05-08 17:27:21','North Dakota','North Dakota',4),(102,'2023-05-08 17:27:21','2023-05-08 17:27:21','Ohio','Ohio',4),(103,'2023-05-08 17:27:21','2023-05-08 17:27:21','Oklahoma','Oklahoma',4),(104,'2023-05-08 17:27:21','2023-05-08 17:27:21','Oregon','Oregon',4),(105,'2023-05-08 17:27:21','2023-05-08 17:27:21','Pennsylvania','Pennsylvania',4),(106,'2023-05-08 17:27:21','2023-05-08 17:27:21','Rhode Island','Rhode Island',4),(107,'2023-05-08 17:27:21','2023-05-08 17:27:21','South Carolina','South Carolina',4),(108,'2023-05-08 17:27:21','2023-05-08 17:27:21','South Dakota','South Dakota',4),(109,'2023-05-08 17:27:21','2023-05-08 17:27:21','Tennessee','Tennessee',4),(110,'2023-05-08 17:27:21','2023-05-08 17:27:21','Texas','Texas',4),(111,'2023-05-08 17:27:21','2023-05-08 17:27:21','Utah','Utah',4),(112,'2023-05-08 17:27:21','2023-05-08 17:27:21','Vermont','Vermont',4),(113,'2023-05-08 17:27:21','2023-05-08 17:27:21','Virginia','Virginia',4),(114,'2023-05-08 17:27:21','2023-05-08 17:27:21','Washington','Washington',4),(115,'2023-05-08 17:27:21','2023-05-08 17:27:21','West Virginia','West Virginia',4),(116,'2023-05-08 17:27:21','2023-05-08 17:27:21','Wisconsin','Wisconsin',4),(117,'2023-05-08 17:27:21','2023-05-08 17:27:21','Wyoming','Wyoming',4),(118,'2023-05-08 17:27:21','2023-05-08 17:27:21','Alberta','Alberta',5),(119,'2023-05-08 17:27:21','2023-05-08 17:27:21','British Columbia','British Columbia',5),(120,'2023-05-08 17:27:21','2023-05-08 17:27:21','Manitoba','Manitoba',5),(121,'2023-05-08 17:27:21','2023-05-08 17:27:21','New Brunswick','New Brunswick',5),(122,'2023-05-08 17:27:21','2023-05-08 17:27:21','Newfoundland and Labrador','Newfoundland and Labrador',5),(123,'2023-05-08 17:27:21','2023-05-08 17:27:21','Northwest Territories','Northwest Territories',5),(124,'2023-05-08 17:27:21','2023-05-08 17:27:21','Nova Scotia','Nova Scotia',5),(125,'2023-05-08 17:27:21','2023-05-08 17:27:21','Nunavut','Nunavut',5),(126,'2023-05-08 17:27:21','2023-05-08 17:27:21','Ontario','Ontario',5),(127,'2023-05-08 17:27:21','2023-05-08 17:27:21','Prince Edward Island','Prince Edward Island',5),(128,'2023-05-08 17:27:21','2023-05-08 17:27:21','Quebec','Quebec',5),(129,'2023-05-08 17:27:21','2023-05-08 17:27:21','Saskatchewan','Saskatchewan',5),(130,'2023-05-08 17:27:21','2023-05-08 17:27:21','Yukon Territory','Yukon Territory',5);
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `tax_rate` double(8,2) DEFAULT '0.00',
  `tax_percentage` double(8,2) DEFAULT '0.00',
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
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `prepend` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `match` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `did_action` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'accept-call',
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `outbound` decimal(8,8) NOT NULL,
  `inbound` decimal(8,8) NOT NULL,
  `dial_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `call_rate` decimal(8,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rates`
--

LOCK TABLES `call_rates` WRITE;
/*!40000 ALTER TABLE `call_rates` DISABLE KEYS */;
INSERT INTO `call_rates` VALUES (169,'2023-06-06 18:29:49','2023-06-06 18:29:49','United States Outbound',0.00000000,0.00000000,'','outbound',0.01300000),(170,'2023-06-06 18:29:51','2023-06-06 18:29:51','United States & Canada Outbound - Toll Free',0.00000000,0.00000000,'','outbound',0.00850000),(171,'2023-06-06 18:29:51','2023-06-06 18:29:51','United States - Alaska Outbound',0.00000000,0.00000000,'','outbound',0.09000000),(172,'2023-06-06 18:29:51','2023-06-06 18:29:51','United States - Hawaii Outbound',0.00000000,0.00000000,'','outbound',0.13000000),(173,'2023-06-06 18:29:51','2023-06-06 18:29:51','Canada Outbound',0.00000000,0.00000000,'','outbound',0.01300000),(174,'2023-06-06 18:29:51','2023-06-06 18:29:51','Canada - Yukon Territory Outbound',0.00000000,0.00000000,'','outbound',0.14500000),(175,'2023-06-06 18:29:51','2023-06-06 18:29:51','United States Inbound',0.00000000,0.00000000,'','inbound',0.00085000),(176,'2023-06-06 18:29:51','2023-06-06 18:29:51','Canada Inbound',0.00000000,0.00000000,'','inbound',0.00085000);
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
  `dial_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `call_rates_dial_prefixes_call_rate_id_foreign` (`call_rate_id`),
  CONSTRAINT `call_rates_dial_prefixes_call_rate_id_foreign` FOREIGN KEY (`call_rate_id`) REFERENCES `call_rates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8405 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_rates_dial_prefixes`
--

LOCK TABLES `call_rates_dial_prefixes` WRITE;
/*!40000 ALTER TABLE `call_rates_dial_prefixes` DISABLE KEYS */;
INSERT INTO `call_rates_dial_prefixes` VALUES (8023,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1403'),(8024,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1205'),(8025,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1256'),(8026,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1334'),(8027,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1251'),(8028,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1870'),(8029,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1501'),(8030,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1479'),(8031,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1480'),(8032,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1623'),(8033,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1928'),(8034,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1602'),(8035,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1520'),(8036,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1628'),(8037,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1341'),(8038,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1764'),(8039,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1925'),(8040,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1909'),(8041,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1562'),(8042,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1661'),(8043,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1657'),(8044,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1510'),(8045,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1650'),(8046,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1949'),(8047,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1760'),(8048,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1415'),(8049,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1951'),(8050,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1752'),(8051,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1831'),(8052,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1209'),(8053,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1669'),(8054,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1408'),(8055,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1559'),(8056,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1626'),(8057,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1442'),(8058,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1530'),(8059,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1916'),(8060,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1707'),(8061,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1627'),(8062,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1714'),(8063,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1310'),(8064,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1323'),(8065,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1213'),(8066,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1424'),(8067,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1747'),(8068,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1818'),(8069,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1858'),(8070,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1935'),(8071,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1619'),(8072,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1805'),(8073,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1369'),(8074,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1720'),(8075,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1303'),(8076,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1970'),(8077,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1719'),(8078,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1203'),(8079,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1959'),(8080,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1475'),(8081,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1860'),(8082,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1202'),(8083,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1302'),(8084,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1689'),(8085,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1407'),(8086,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1239'),(8087,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1836'),(8088,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1727'),(8089,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1321'),(8090,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1754'),(8091,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1954'),(8092,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1352'),(8093,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1863'),(8094,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1904'),(8095,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1386'),(8096,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1561'),(8097,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1772'),(8098,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1786'),(8099,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1305'),(8100,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1861'),(8101,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1941'),(8102,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1813'),(8103,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1850'),(8104,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1478'),(8105,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1770'),(8106,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1470'),(8107,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1404'),(8108,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1706'),(8109,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1678'),(8110,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1912'),(8111,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1229'),(8112,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1671'),(8113,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1515'),(8114,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1319'),(8115,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1563'),(8116,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1641'),(8117,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1712'),(8118,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1208'),(8119,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1217'),(8120,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1282'),(8121,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1872'),(8122,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1312'),(8123,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1773'),(8124,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1464'),(8125,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1708'),(8126,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1815'),(8127,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1224'),(8128,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1847'),(8129,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1618'),(8130,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1309'),(8131,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1331'),(8132,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1630'),(8133,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1765'),(8134,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1574'),(8135,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1260'),(8136,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1219'),(8137,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1317'),(8138,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1812'),(8139,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1913'),(8140,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1785'),(8141,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1316'),(8142,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1620'),(8143,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1327'),(8144,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1502'),(8145,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1859'),(8146,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1606'),(8147,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1270'),(8148,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1504'),(8149,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1985'),(8150,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1225'),(8151,'2023-06-06 18:29:49','2023-06-06 18:29:49',169,'1318'),(8152,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1337'),(8153,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1774'),(8154,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1508'),(8155,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1781'),(8156,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1339'),(8157,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1857'),(8158,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1617'),(8159,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1978'),(8160,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1351'),(8161,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1413'),(8162,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1443'),(8163,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1410'),(8164,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1280'),(8165,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1249'),(8166,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1969'),(8167,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1240'),(8168,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1301'),(8169,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1207'),(8170,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1383'),(8171,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1517'),(8172,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1546'),(8173,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1810'),(8174,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1278'),(8175,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1313'),(8176,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1586'),(8177,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1248'),(8178,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1734'),(8179,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1269'),(8180,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1906'),(8181,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1989'),(8182,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1616'),(8183,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1231'),(8184,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1679'),(8185,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1947'),(8186,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1612'),(8187,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1320'),(8188,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1651'),(8189,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1763'),(8190,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1952'),(8191,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1218'),(8192,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1507'),(8193,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1636'),(8194,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1660'),(8195,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1975'),(8196,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1816'),(8197,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1314'),(8198,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1557'),(8199,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1573'),(8200,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1417'),(8201,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1670'),(8202,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1601'),(8203,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1662'),(8204,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1228'),(8205,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1406'),(8206,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1336'),(8207,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1252'),(8208,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1984'),(8209,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1919'),(8210,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1980'),(8211,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1910'),(8212,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1828'),(8213,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1704'),(8214,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1701'),(8215,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1402'),(8216,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1308'),(8217,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1603'),(8218,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1908'),(8219,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1848'),(8220,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1732'),(8221,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1551'),(8222,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1201'),(8223,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1862'),(8224,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1973'),(8225,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1609'),(8226,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1856'),(8227,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1505'),(8228,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1957'),(8229,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1702'),(8230,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1775'),(8231,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1315'),(8232,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1518'),(8233,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1716'),(8234,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1585'),(8235,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1646'),(8236,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1347'),(8237,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1718'),(8238,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1212'),(8239,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1516'),(8240,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1917'),(8241,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1845'),(8242,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1631'),(8243,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1607'),(8244,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1914'),(8245,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1216'),(8246,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1330'),(8247,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1234'),(8248,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1567'),(8249,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1419'),(8250,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1380'),(8251,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1440'),(8252,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1740'),(8253,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1614'),(8254,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1283'),(8255,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1513'),(8256,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1937'),(8257,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1918'),(8258,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1580'),(8259,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1405'),(8260,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1503'),(8261,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1971'),(8262,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1541'),(8263,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1814'),(8264,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1717'),(8265,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1570'),(8266,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1358'),(8267,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1878'),(8268,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1835'),(8269,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1484'),(8270,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1610'),(8271,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1445'),(8272,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1267'),(8273,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1215'),(8274,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1724'),(8275,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1412'),(8276,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1939'),(8277,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1787'),(8278,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1401'),(8279,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1843'),(8280,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1864'),(8281,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1803'),(8282,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1605'),(8283,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1423'),(8284,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1865'),(8285,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1931'),(8286,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1615'),(8287,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1901'),(8288,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1731'),(8289,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1254'),(8290,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1325'),(8291,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1713'),(8292,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1940'),(8293,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1817'),(8294,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1430'),(8295,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1903'),(8296,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1806'),(8297,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1737'),(8298,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1512'),(8299,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1361'),(8300,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1210'),(8301,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1936'),(8302,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1409'),(8303,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1979'),(8304,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1972'),(8305,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1469'),(8306,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1214'),(8307,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1682'),(8308,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1832'),(8309,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1281'),(8310,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1830'),(8311,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1956'),(8312,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1432'),(8313,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1915'),(8314,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1435'),(8315,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1801'),(8316,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1385'),(8317,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1434'),(8318,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1804'),(8319,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1757'),(8320,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1703'),(8321,'2023-06-06 18:29:50','2023-06-06 18:29:50',169,'1571'),(8322,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1540'),(8323,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1276'),(8324,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1381'),(8325,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1236'),(8326,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1802'),(8327,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1509'),(8328,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1360'),(8329,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1564'),(8330,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1206'),(8331,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1425'),(8332,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1253'),(8333,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1715'),(8334,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1920'),(8335,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1414'),(8336,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1262'),(8337,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1608'),(8338,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1353'),(8339,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1420'),(8340,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1304'),(8341,'2023-06-06 18:29:51','2023-06-06 18:29:51',169,'1307'),(8342,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1800'),(8343,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1833'),(8344,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1844'),(8345,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1855'),(8346,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1866'),(8347,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1877'),(8348,'2023-06-06 18:29:51','2023-06-06 18:29:51',170,'1888'),(8349,'2023-06-06 18:29:51','2023-06-06 18:29:51',171,'1907'),(8350,'2023-06-06 18:29:51','2023-06-06 18:29:51',172,'1808'),(8351,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1368'),(8352,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1403'),(8353,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1587'),(8354,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1780'),(8355,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1825'),(8356,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1236'),(8357,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1250'),(8358,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1604'),(8359,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1672'),(8360,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1778'),(8361,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1204'),(8362,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1431'),(8363,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1428'),(8364,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1506'),(8365,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1709'),(8366,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1879'),(8367,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1867'),(8368,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1782'),(8369,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1902'),(8370,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1867'),(8371,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1226'),(8372,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1249'),(8373,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1289'),(8374,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1343'),(8375,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1365'),(8376,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1416'),(8377,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1437'),(8378,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1519'),(8379,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1548'),(8380,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1613'),(8381,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1647'),(8382,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1705'),(8383,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1807'),(8384,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1905'),(8385,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1782'),(8386,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1902'),(8387,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1354'),(8388,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1367'),(8389,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1418'),(8390,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1438'),(8391,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1450'),(8392,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1514'),(8393,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1579'),(8394,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1581'),(8395,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1819'),(8396,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1873'),(8397,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1306'),(8398,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1474'),(8399,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1639'),(8400,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1600'),(8401,'2023-06-06 18:29:51','2023-06-06 18:29:51',173,'1622'),(8402,'2023-06-06 18:29:51','2023-06-06 18:29:51',174,'1867'),(8403,'2023-06-06 18:29:51','2023-06-06 18:29:51',175,'1'),(8404,'2023-06-06 18:29:51','2023-06-06 18:29:51',176,'1');
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_system_templates`
--

LOCK TABLES `call_system_templates` WRITE;
/*!40000 ALTER TABLE `call_system_templates` DISABLE KEYS */;
INSERT INTO `call_system_templates` VALUES (22,'2023-06-06 18:29:49','2023-06-06 18:29:49','Basic Call System','Includes 2 extensions, call forwarding and a simple IVR setup','{\"extensions\":[{\"username\":\"1000\",\"caller_id\":\"1000\",\"flow_name\":\"Call Forward\"},{\"username\":\"2000\",\"caller_id\":\"2000\",\"flow_name\":\"Call Forward\"}],\"extension_codes\":[],\"flows\":[]}');
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
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `from` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `plan_snapshot` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `channel_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `billed` tinyint(1) NOT NULL DEFAULT '0',
  `provider_id` int unsigned DEFAULT NULL,
  `sip_call_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (43,'call-f6dc7933-6f66-4604-9acc-be2b603d334d','15878557657','','completed','inbound',3600,'2023-06-06 18:29:49','2023-06-06 18:29:49',215,'2019-07-01 09:00:00','2019-07-01 09:01:00',202,'','','',0,NULL,'',NULL,NULL,NULL),(44,'call-4e8ec891-9f42-467e-a89e-ab6f1bfd04bb','15878557657','','completed','inbound',3600,'2023-06-06 18:29:49','2023-06-06 18:29:49',215,'2019-07-01 12:00:00','2019-07-01 12:05:00',202,'','','',0,NULL,'',NULL,NULL,NULL);
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `app_logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `app_icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `alt_app_logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `admin_portal_logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `color_scheme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `layout_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `grid_size` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `primary_font` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `secondary_font` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `site_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `verification_workflow` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'sms',
  `verification_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'stripe',
  `payment_gateway_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `custom_code_containers_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `mail_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'smtp-gateway',
  `dns_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'self-managed',
  `aws_route53_zone_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `facebook_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `facebook_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `instagram_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `intagram_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `twitter_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `twitter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `tiktok_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tiktok_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `linkedin_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `linkedin_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `privacy_policy` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `terms_of_service` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `enable_google_signin` tinyint(1) NOT NULL DEFAULT '0',
  `enable_msft_signin` tinyint(1) NOT NULL DEFAULT '0',
  `enable_apple_signin` tinyint(1) NOT NULL DEFAULT '0',
  `search_include_resources` tinyint(1) NOT NULL,
  `search_include_portal_views` tinyint(1) NOT NULL,
  `search_include_blog_views` tinyint(1) NOT NULL,
  `signup_requires_payment_detail` tinyint(1) NOT NULL DEFAULT '0',
  `portal_analytics_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `site_analytics_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `analytics_sdk` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `billing_num_retries` int NOT NULL DEFAULT '0',
  `billing_retry_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `contact_phone_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `contact_email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `register_credits_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `register_credits` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customizations`
--

LOCK TABLES `customizations` WRITE;
/*!40000 ALTER TABLE `customizations` DISABLE KEYS */;
INSERT INTO `customizations` VALUES (32,'2023-06-06 18:29:48','2023-06-06 18:29:48','','','','','','','','','','','sms','','stripe',0,0,'smtp-gateway','self-managed','','',0,'',0,'',0,'',0,'',0,'','',0,0,0,0,0,0,0,0,0,'',0,0,'','','',0,0.00);
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
  `from` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `report` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'info',
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
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `monthly_cost` int NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trial_number` tinyint(1) NOT NULL,
  `api_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `did_action` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'accept-call',
  `features` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `availability` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `host` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'A',
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `ttl` int NOT NULL DEFAULT '300',
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `0` (`host`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dns_records`
--

LOCK TABLES `dns_records` WRITE;
/*!40000 ALTER TABLE `dns_records` DISABLE KEYS */;
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
  `message` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `full_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secret` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `caller_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extensions`
--

LOCK TABLES `extensions` WRITE;
/*!40000 ALTER TABLE `extensions` DISABLE KEYS */;
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
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `question` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
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
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `size` int NOT NULL DEFAULT '0',
  `call_id` int unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_snapshot` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `var_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `screen_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `variable_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extras` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lookup_table` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lookup_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `depends_on_field` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `depends_on_value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `default` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `placeholder` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `widget` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `widget_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int unsigned NOT NULL,
  `started` tinyint(1) NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flows_public_id_unique` (`public_id`),
  KEY `flows_user_id_foreign` (`user_id`),
  KEY `flows_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `flows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `flows_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flows`
--

LOCK TABLES `flows` WRITE;
/*!40000 ALTER TABLE `flows` DISABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extra_data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `workspace_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `compiled_code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `changeable_params` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `macro_templates_public_id_unique` (`public_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macro_templates`
--

LOCK TABLES `macro_templates` WRITE;
/*!40000 ALTER TABLE `macro_templates` DISABLE KEYS */;
INSERT INTO `macro_templates` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','','Business Hours Check','mt-f7d943a5-cdc7-4482-8383-3d27d802ac93','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','','Send Voicemail To Email','mt-bc83d861-5c83-4a1b-aec5-fff62da270e6','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(3,'2023-01-03 23:12:26','2023-01-03 23:12:26','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-986d7724-efab-4d50-88f9-c0d26317aac2',''),(4,'2023-06-05 20:28:24','2023-06-05 20:28:24','','Business Hours Check','mt-35bb2576-f7ba-489c-bfd8-666e0d217e4a','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(5,'2023-06-05 20:28:24','2023-06-05 20:28:24','','Send Voicemail To Email','mt-b8d482ff-b6ec-4caf-9560-a3bab3334a26','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(6,'2023-06-05 20:28:24','2023-06-05 20:28:24','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-5708ca13-c183-4fe3-9fa6-a731fc7fb185',''),(7,'2023-06-05 20:42:06','2023-06-05 20:42:06','','Business Hours Check','mt-dea5a556-e112-4488-88e7-fc6f3122234c','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(8,'2023-06-05 20:42:06','2023-06-05 20:42:06','','Send Voicemail To Email','mt-01381553-8076-4bdf-bce2-4f3b93756190','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(9,'2023-06-05 20:42:06','2023-06-05 20:42:06','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-aa592c6e-7a21-4415-9776-65a356fc95a3',''),(10,'2023-06-05 20:46:58','2023-06-05 20:46:58','','Business Hours Check','mt-5dfb2d38-a21f-4588-8db2-f6c2fa05e132','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(11,'2023-06-05 20:46:58','2023-06-05 20:46:58','','Send Voicemail To Email','mt-ff85875c-827c-4bd0-9703-d94167a3f29d','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(12,'2023-06-05 20:46:58','2023-06-05 20:46:58','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-d202cb2b-6d9c-4da0-9ac7-5519b0441dcf',''),(13,'2023-06-05 20:47:21','2023-06-05 20:47:21','','Business Hours Check','mt-dff62a45-a0ac-4062-be5f-443ec1bffb1c','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(14,'2023-06-05 20:47:21','2023-06-05 20:47:21','','Send Voicemail To Email','mt-b9fb99b3-cf89-425c-b65c-f30d210f77bb','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(15,'2023-06-05 20:47:21','2023-06-05 20:47:21','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-6fd653ed-08a6-4e0a-b902-ab5df823eb6b',''),(16,'2023-06-05 20:47:40','2023-06-05 20:47:40','','Business Hours Check','mt-abb06657-df3a-47f3-8dca-b255fd634ba2','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(17,'2023-06-05 20:47:40','2023-06-05 20:47:40','','Send Voicemail To Email','mt-a7065098-1bd8-432e-b262-6d67e2ddae76','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(18,'2023-06-05 20:47:40','2023-06-05 20:47:40','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-15a90983-fcd7-4768-b60a-bc484c19e129',''),(19,'2023-06-05 20:47:51','2023-06-05 20:47:51','','Business Hours Check','mt-2032c31c-0096-4134-9f2b-869a54f77456','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(20,'2023-06-05 20:47:51','2023-06-05 20:47:51','','Send Voicemail To Email','mt-88cf1cc4-5607-4fe6-ae42-f73d4e348e8b','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(21,'2023-06-05 20:47:51','2023-06-05 20:47:51','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-9e58dd55-f327-4dd6-8cd8-04036057baaf',''),(22,'2023-06-05 20:59:49','2023-06-05 20:59:49','','Business Hours Check','mt-1f373416-6014-4a83-b44b-d19527fcf09a','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(23,'2023-06-05 20:59:49','2023-06-05 20:59:49','','Send Voicemail To Email','mt-7ec67172-ad71-47cf-bc41-2e5a6c9772a2','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(24,'2023-06-05 20:59:49','2023-06-05 20:59:49','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-7072a976-841b-4cdb-b881-3f49d1968398',''),(25,'2023-06-05 21:02:12','2023-06-05 21:02:12','','Business Hours Check','mt-63805d47-ec06-4b23-90db-c4e2cb38e413','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(26,'2023-06-05 21:02:12','2023-06-05 21:02:12','','Send Voicemail To Email','mt-e07267bd-e125-4631-bf5e-16efc9b036bf','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(27,'2023-06-05 21:02:12','2023-06-05 21:02:12','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-d8a8adb3-b0cc-4f0b-9dde-30c2c2144e8c',''),(28,'2023-06-05 21:06:42','2023-06-05 21:06:42','','Business Hours Check','mt-f01f0dc1-ad40-4802-b451-279b1740b55c','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(29,'2023-06-05 21:06:42','2023-06-05 21:06:42','','Send Voicemail To Email','mt-bcfe6dbb-9ef7-4323-96b8-1ea87b35cbef','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(30,'2023-06-05 21:06:42','2023-06-05 21:06:42','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-eb5190fe-a741-4608-ac67-5a9ab112d013',''),(31,'2023-06-05 21:46:07','2023-06-05 21:46:07','','Business Hours Check','mt-c0e9d75e-315c-4e5f-b4d4-7e60c3246045','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(32,'2023-06-05 21:46:07','2023-06-05 21:46:07','','Send Voicemail To Email','mt-8f7a0f11-3dc5-41bf-8bf0-0d579509ce00','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(33,'2023-06-05 21:46:07','2023-06-05 21:46:07','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-4efd74a7-98b3-4e54-920b-1b5a3ac92d9f',''),(34,'2023-06-05 21:48:22','2023-06-05 21:48:22','','Business Hours Check','mt-e30b60f1-b8a9-4826-8f8d-738080e8304f','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(35,'2023-06-05 21:48:22','2023-06-05 21:48:22','','Send Voicemail To Email','mt-a92d8813-f8da-487f-b0f7-a76478662110','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(36,'2023-06-05 21:48:22','2023-06-05 21:48:22','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-31fd565a-c354-41e5-9219-fd5fb8c840c0',''),(37,'2023-06-05 21:52:53','2023-06-05 21:52:53','','Business Hours Check','mt-cdbe01b3-d96d-4fb2-84b8-42cec4337bf1','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(38,'2023-06-05 21:52:53','2023-06-05 21:52:53','','Send Voicemail To Email','mt-8f75a0b8-5447-4b48-816c-8a719496db21','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(39,'2023-06-05 21:52:53','2023-06-05 21:52:53','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-0d19f091-c3e8-46d9-a881-6a6dda039c52',''),(40,'2023-06-05 21:56:05','2023-06-05 21:56:05','','Business Hours Check','mt-44ff5e36-f446-4244-9b31-3fb9b40d46d3','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(41,'2023-06-05 21:56:05','2023-06-05 21:56:05','','Send Voicemail To Email','mt-5a9bb9f6-3b40-4629-83be-3b27b57ce50a','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(42,'2023-06-05 21:56:05','2023-06-05 21:56:05','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-bedf37ad-d259-4068-908a-68b70fd7c171',''),(43,'2023-06-05 21:57:38','2023-06-05 21:57:38','','Business Hours Check','mt-08cfa7f9-7e23-4aa2-a792-67fed258e069','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(44,'2023-06-05 21:57:38','2023-06-05 21:57:38','','Send Voicemail To Email','mt-cc8469f9-5475-4f95-8a52-6625070b0652','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(45,'2023-06-05 21:57:38','2023-06-05 21:57:38','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-108268a6-082d-4578-babb-3516a6505d68',''),(46,'2023-06-05 23:11:06','2023-06-05 23:11:06','','Business Hours Check','mt-d20d03ca-52f0-477a-95f2-af50f5b9faa3','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(47,'2023-06-05 23:11:06','2023-06-05 23:11:06','','Send Voicemail To Email','mt-ded08ef2-a1a3-40dc-bd7d-23b8eeed016a','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(48,'2023-06-05 23:11:06','2023-06-05 23:11:06','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-d27d3dc4-6610-4458-b9ce-87abf4204893',''),(49,'2023-06-05 23:12:07','2023-06-05 23:12:07','','Business Hours Check','mt-24327c5e-8450-4efb-b4de-ab37d1356bfb','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(50,'2023-06-05 23:12:07','2023-06-05 23:12:07','','Send Voicemail To Email','mt-3201daba-ae7d-4df1-8804-9e92c5fc504e','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(51,'2023-06-05 23:12:07','2023-06-05 23:12:07','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-d28c1b6f-aad0-4fb9-a956-cba54eff49f7',''),(52,'2023-06-05 23:12:33','2023-06-05 23:12:33','','Business Hours Check','mt-d569b05c-24a7-43c5-86de-e3f8bcc7ab1a','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(53,'2023-06-05 23:12:33','2023-06-05 23:12:33','','Send Voicemail To Email','mt-16e2dda2-f5e0-489d-af9a-6eca5ba3deac','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(54,'2023-06-05 23:12:33','2023-06-05 23:12:33','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-69f75b3d-ac76-4a27-9ff9-9c3658a6d8b4',''),(55,'2023-06-05 23:12:45','2023-06-05 23:12:45','','Business Hours Check','mt-c4ca8019-2617-4c59-9241-71c980cf6a71','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(56,'2023-06-05 23:12:45','2023-06-05 23:12:45','','Send Voicemail To Email','mt-e9986554-ccb8-4a58-b26a-366b998cb7c7','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(57,'2023-06-05 23:12:45','2023-06-05 23:12:45','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-c7cea3fd-a7f8-400d-ba71-ebf90131f200',''),(58,'2023-06-05 23:13:24','2023-06-05 23:13:24','','Business Hours Check','mt-c37e3669-4237-4c08-b938-815dc7bc878a','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(59,'2023-06-05 23:13:24','2023-06-05 23:13:24','','Send Voicemail To Email','mt-479c7c78-32ca-4f11-b21c-e88370dda340','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(60,'2023-06-05 23:13:24','2023-06-05 23:13:24','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-6643558c-2275-4c00-bb2e-edba58601a2d',''),(61,'2023-06-06 16:59:24','2023-06-06 16:59:24','','Business Hours Check','mt-e0a38022-d626-41b0-85d4-bda8bfbe70df','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(62,'2023-06-06 16:59:24','2023-06-06 16:59:24','','Send Voicemail To Email','mt-ebc049e6-9273-45a3-9bc1-02a300bcebd2','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(63,'2023-06-06 16:59:24','2023-06-06 16:59:24','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-f8723ea2-6d37-44b3-98bd-268b0fc00375',''),(64,'2023-06-06 18:29:49','2023-06-06 18:29:49','','Business Hours Check','mt-dc0d864b-c49d-4e62-8b91-79ce0a4a284b','[{\"type\":\"text\",\"name\":\"timezone\",\"placeholder\":\"America\\/Toronto\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Monday\"},{\"type\":\"text\",\"name\":\"start day of week\",\"placeholder\":\"Friday\"},{\"type\":\"text\",\"name\":\"start hour of day\",\"placeholder\":\"09\"},{\"type\":\"text\",\"name\":\"end hour of day\",\"placeholder\":\"17\"}]'),(65,'2023-06-06 18:29:49','2023-06-06 18:29:49','','Send Voicemail To Email','mt-4c20707c-469b-4887-be1d-d89a81cb2b07','[{\"type\":\"text\",\"name\":\"destination email\",\"placeholder\":\"you@example.org\"}]'),(66,'2023-06-06 18:29:49','2023-06-06 18:29:49','module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {\n    return new Promise(async function(resolve, reject) {\n    });\n}','Blank','mt-0161da45-a526-4edc-a4fe-6cfd0ac7ef57','');
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address_range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address_range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `webrtc_optimized` tinyint(1) NOT NULL DEFAULT '0',
  `live_call_count` int NOT NULL DEFAULT '0',
  `live_cpu_pct_used` double(8,2) NOT NULL DEFAULT '0.00',
  `live_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `k8s_pod_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_servers`
--

LOCK TABLES `media_servers` WRITE;
/*!40000 ALTER TABLE `media_servers` DISABLE KEYS */;
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
  `api_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rotated_at` datetime DEFAULT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
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
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2019_07_26_190119_create_did_numbers_table',1),('2019_07_26_190123_create_flows_table',1),('2019_07_26_190909_add_flow_to_did_numbers',1),('2019_07_29_165444_change_flows_json_to_nullable',1),('2019_07_29_212722_create_calls_table',1),('2019_07_29_212744_create_recordings_table',1),('2019_08_06_151105_create_extensions_table',1),('2019_08_08_193636_add_call_id_to_recordings',1),('2019_08_08_195213_add_precise_datetime_fields_to_calls',1),('2019_08_08_222630_add_recording_tag_field',1),('2019_08_10_222023_add_name_fields_to_users',1),('2019_08_11_030346_add_provider_id_to_numbers',1),('2019_08_19_235424_create_user_credits',1),('2019_08_19_235435_create_user_debits',1),('2019_08_19_235838_create_user_cards',1),('2019_08_19_235905_add_stripe_customer_id',1),('2019_08_20_005942_add_balance_to_credits',1),('2019_08_20_005957_add_balance_to_debits',1),('2019_08_20_012943_add_user_id_to_cards',1),('2019_08_20_034057_add_card_id_to_credits',1),('2019_08_21_012206_add_status_to_credits',1),('2019_08_21_012217_add_status_to_debits',1),('2019_08_21_013700_create_user_invoices',1),('2019_08_23_021540_add_container_name',1),('2019_08_23_022450_add_sip_and_rtp_info_to_user',1),('2019_08_23_221925_create_flows_templates',1),('2019_08_25_030157_add_started_to_flows',1),('2019_09_01_234154_add_trial_field_to_phone_numbers',1),('2019_09_01_234217_add_trial_mode_users',1),('2019_09_04_034909_add_plan_to_users',1),('2019_09_04_040224_add_caller_id_to_extensions',1),('2019_09_05_014921_add_auto_charge_to_users',1),('2019_09_10_000017_add_call_verification_Code',1),('2019_09_10_000219_add_mobile_number',1),('2019_09_10_020803_change_card_id_to_null',1),('2019_09_11_212227_add_api_number_to_dids',1),('2019_09_22_211335_add_reserved_fields_to_user',1),('2019_09_22_222624_make_reserved_ip_nullable',1),('2019_09_23_174133_add_reserved_private_ip',1),('2019_09_23_174818_add_ip_private',1),('2019_10_17_020822_add_region_to_user',1),('2019_10_17_021327_change_region',1),('2019_11_02_225244_add_module_id_to_debits',1),('2019_11_05_035642_add_name_to_rec',1),('2019_11_22_022833_flows_add_pub_id',1),('2019_11_22_022849_did_numbers_add_pub_id',1),('2019_11_22_022902_extensions_add_pub_id',1),('2019_11_26_044330_add_duration_to_recordings',1),('2019_11_27_042803_add_invoices_by_email',1),('2019_11_27_044950_add_billing_package',1),('2019_11_28_012255_add_verified_callerids',1),('2019_11_28_012315_blocked_numbers',1),('2019_11_28_022032_add_code_to_verified',1),('2019_11_28_022555_add_public_id',1),('2019_11_28_022613_add_public_id_to_blocked_numbers',1),('2019_11_28_023459_add_confirmed_to_verified',1),('2019_11_29_023727_add_last_login_users',1),('2019_11_29_025428_add_user_devices_table',1),('2019_11_29_030648_add_last_login_to_devices',1),('2019_11_29_034138_add_email_verified_fields',1),('2019_11_29_041451_create_usage_triggers',1),('2019_11_29_042901_create_usage_trigger_results',1),('2019_11_29_044609_add_last_login_reminded',1),('2019_11_29_050110_add_credit_id_to_usage_triggers',1),('2019_12_01_234439_add_size_to_recordings',1),('2019_12_02_013217_add_whitelist_setting_to_self',1),('2019_12_02_013259_add_ip_whitelist',1),('2019_12_08_171656_create_workspaces_table',1),('2019_12_08_171751_create_workspaces_users_table',1),('2019_12_08_201942_add_workspace_fields',1),('2019_12_08_202304_add_workspace_fields_2',1),('2019_12_08_203425_add_workspace_id_to_blocked_numbers',1),('2019_12_08_203425_add_workspace_id_to_calls',1),('2019_12_08_203425_add_workspace_id_to_dids',1),('2019_12_08_203425_add_workspace_id_to_extensions',1),('2019_12_08_203425_add_workspace_id_to_flows',1),('2019_12_08_203425_add_workspace_id_to_ip_whitelist',1),('2019_12_08_203425_add_workspace_id_to_recordings',1),('2019_12_08_203425_add_workspace_id_to_verified_caller_ids',1),('2019_12_08_211721_add_public_id_to_workspace_users',1),('2019_12_10_003037_add_personal_fields',1),('2019_12_10_003552_add_linked_paypal',1),('2020_01_06_175437_make_macro_functions',1),('2020_01_06_223411_add_workspace_perms',1),('2020_01_06_224515_create_macro_templates',1),('2020_01_06_233145_add_public_id_to_macro_templates',1),('2020_01_07_020818_add_compiled_code_to_macros',1),('2020_01_08_204250_create_workspace_params',1),('2020_01_08_222415_add_manage_params_perm',1),('2020_01_12_191325_add_flow_id_to_extensions',1),('2020_01_13_001016_create_extension_codes_new',1),('2020_01_13_013305_manage_extension_codes_priv',1),('2020_01_13_183249_add_category_to_flow_templates',1),('2020_01_14_210429_create_call_system_templates',1),('2020_01_16_012121_create_debugger_table',1),('2020_01_16_013126_add_api_id_to_logs',1),('2020_01_16_030929_create_recording_tags',1),('2020_01_16_032459_add_tag_to_recording_tags',1),('2020_01_16_181813_create_port_numbers',1),('2020_01_16_182010_create_port_numbers_documents',1),('2020_01_16_185250_add_manage_ports',1),('2020_01_16_212014_add_fields_to_ports',1),('2020_01_16_214752_add_estimated_completion_date_to_ports',1),('2020_01_16_224331_add_type_to_port_docs',1),('2020_01_21_041158_add_api_fields',1),('2020_01_22_023942_add_extra_data_to_flow_templates',1),('2020_01_22_035726_add_user_id_to_ext_codes',1),('2020_01_28_040920_change_foreign_for_dids',1),('2020_01_28_040930_change_foreign_for_extensions',1),('2020_01_28_042638_add_level_to_debugger',1),('2020_02_04_233222_create_widget_templates',1),('2020_02_04_233438_create_widget_templates_tags',1),('2020_02_12_021051_add_free_started',1),('2020_02_18_053321_add_did_action',1),('2020_02_19_020015_create_fax_table',1),('2020_02_19_031239_add_sz_to_faxes',1),('2020_02_19_031556_add_call_id_to_faxes',1),('2020_02_19_031914_add_name_to_faxes',1),('2020_02_19_051706_free_trial_reminder',1),('2020_02_20_051924_add_features_to_dids',1),('2020_02_25_042156_add_did_number_tags',1),('2020_02_25_233808_create_files_table',1),('2020_02_27_015551_add_changable_params_to_macro_templates',1),('2020_03_01_030103_add_eta_to_ports',1),('2020_03_01_030427_info_needed_to_ports',1),('2020_03_01_064209_sip_providers',1),('2020_03_01_070530_add_active_to_providers',1),('2020_03_01_073539_create_call_rates',1),('2020_03_04_023551_create_sip_countries',1),('2020_03_04_023608_create_sip_regions',1),('2020_03_04_023621_create_sip_rate_centers',1),('2020_03_04_032810_add_active_to_countries',1),('2020_03_04_032825_add_active_to_regions',1),('2020_03_04_040156_add_active_to_rate_centers',1),('2020_03_04_052317_add_sip_rate_center_providers',1),('2020_03_04_061115_add_api_name_to_sip_providers',1),('2020_03_09_025513_create_phones_table',1),('2020_03_09_025537_create_phones_groups_table',1),('2020_03_09_025549_create_phones_global_settings_table',1),('2020_03_09_025605_create_phones_individual_settings_table',1),('2020_03_09_030714_create_phones_definitions_table',1),('2020_03_09_031440_add_group_id_to_phones',1),('2020_03_09_032614_create_phone_defaults',1),('2020_03_09_200636_add_phone_settings_to_workspace',1),('2020_03_09_204502_add_phone_grps_to_workspace',1),('2020_03_09_221633_add_workspace_prov_settings_params',1),('2020_03_11_041842_create_phones_global_settings_values',1),('2020_03_11_205622_create_phones_individual_settings_values',1),('2020_03_19_032609_add_xml_attrs_to_phone_defaults',1),('2020_03_23_021121_add_extensions_tags',1),('2020_03_23_021236_add_phones_tags',1),('2020_03_23_053501_add_type_to_dids',1),('2020_03_23_065938_add_fax_args_to_ratecenters',1),('2020_03_24_233714_add_availability_to_did_numbers',1),('2020_03_31_193531_add_category_to_flows',1),('2020_03_31_202628_add_office_number_to_users',1),('2020_03_31_220721_call_rate_dial_prefix',1),('2020_04_01_025332_add_type_to_call_rate',1),('2020_04_01_025447_call_rate_to_call_rate',1),('2020_04_07_011337_create_system_status_categories_table',1),('2020_04_07_011505_create_system_status_updates_table',1),('2020_04_07_015347_add_status_to_sys_updates',1),('2020_04_14_190351_add_hash_to_workspace_users',1),('2020_04_14_194525_add_job_title_to_users',1),('2020_04_17_032730_add_needs_password_set',1),('2020_04_17_041637_add_accepted_workspace',1),('2020_04_17_044206_add_hash_expired_to_workspace_users',1),('2020_04_17_044615_needs_set_password_date',1),('2020_05_03_194429_create_conferences_table',1),('2020_05_03_194502_create_conferences_members_table',1),('2020_05_06_000215_create_error_user_trace',1),('2020_05_06_032418_create_sip_providers_hosts',1),('2020_05_06_041334_add_type_of_provider',1),('2020_05_11_021831_create_byo_carriers',1),('2020_05_11_021851_create_byo_dids',1),('2020_05_11_022031_create_byo_carriers_routes',1),('2020_05_11_041708_add_byo_roles',1),('2020_05_11_054648_add_byo_settings',1),('2020_05_11_210048_add_flow_id_to_byo_dids',1),('2020_05_22_061003_create_byo_carriers_ips',1),('2020_05_24_223501_create_sip_providers_whitelist_ips',1),('2020_05_25_030825_create_media_servers',1),('2020_05_29_191452_add_api_id_to_conf',1),('2020_06_01_030814_add_transcription_text',1),('2020_06_02_001019_add_outbound_verifier_macro',1),('2020_06_02_051240_add_provision_error',1),('2020_06_03_222452_ip_whitelist_disabled',1),('2020_06_03_222521_byo_did_action',1),('2020_06_05_040154_create_sip_routers',1),('2020_06_05_040222_create_sip_routers_media_servers',1),('2020_06_18_034824_add_call_fields',1),('2020_06_18_034944_create_call_tags',1),('2020_06_18_054015_add_active_to_dids',1),('2020_07_02_205621_move_plan_to_workspaces',1),('2020_07_02_211150_create_plan_usage_period',1),('2020_07_02_211217_add_plan_to_calls',1),('2020_07_02_211226_add_plan_to_recordings',1),('2020_07_02_211237_add_plan_to_faxes',1),('2020_07_02_212948_add_plan_to_users_debits',1),('2020_07_07_025134_add_primary_to_cards',1),('2020_07_07_025427_add_workspace_to_cards',1),('2020_07_12_064116_add_workspace_to_invoices',1),('2020_07_13_000500_add_setup_cost',1),('2020_07_17_012659_add_breakdown_of_costs_to_invoices',1),('2020_07_17_014656_add_cents_collected_to_invoices',1),('2020_07_25_062322_create_sip_providers_rates',1),('2020_07_25_062512_add_rate_ref_to_rates',1),('2020_07_25_083648_add_prefix_priority_to_sip_hosts',1),('2020_07_27_134704_add_register_info_to_exts',1),('2020_07_28_071822_add_webrtc_optimized_to_servers',1),('2020_09_24_205620_add_pending_number',1),('2020_09_25_020516_create_template_presets',1),('2020_09_25_042350_add_widget_key_to_presets',1),('2020_09_30_030600_add_workspace_user_assigned_data',1),('2020_10_06_033659_add_live_media_Server_data',1),('2020_10_14_040750_add_live_stats_to_routers',1),('2020_10_15_060038_add_pop_workspace_users',1),('2020_10_15_212843_create_workspaces_invites',1),('2020_10_15_213435_add_hash_to_invites',1),('2021_10_20_224404_add_channel_id_to_calls',1),('2021_11_16_213509_add_recordings_for_storage',1),('2021_11_16_221046_add_recordings_s3_url',1),('2021_11_17_001924_add_recordings_relocation_attempts',1),('2021_11_17_010259_add_calls_billed',1),('2021_11_19_032551_add_k8s_ids_sip_routers',1),('2021_11_19_032808_add_k8s_ids_media_servers',1),('2021_11_22_222046_add_region_to_media_servers',1),('2021_11_26_194222_create_api_credentials',1),('2021_11_26_230215_add_google_service_acc',1),('2021_12_02_012416_add_settings_cols',1),('2021_12_10_013151_add_rate_limit_settings',1),('2021_12_10_014025_add_sip_provider_metrics',1),('2021_12_10_015743_add_sip_provider_to_calls',1),('2021_12_10_030306_add_sipcallid',1),('2021_12_14_211701_add_setup_complete',1),('2021_12_15_004333_add_customizations_table',1),('2021_12_16_013225_create_number_inventory',1),('2021_12_20_211043_create_router_flows',1),('2021_12_20_211240_create_router_flows_templates',1),('2021_12_26_222102_create_rtpproxy_tbl',1),('2021_12_27_000342_add_carrier_key',1),('2022_01_09_205944_add_sip_country_fields',1),('2022_01_09_210308_add_routing_flow_id',1),('2022_01_09_214321_workspaces_routing_flows',1),('2022_01_09_220106_sip_providers_countries',1),('2022_01_09_220138_sip_providers_call_rates',1),('2022_01_09_234559_add_active_channels',1),('2022_01_09_234631_add_active_channels_hosts',1),('2022_02_10_221404_add_recording_trim',1),('2022_03_24_024322_add_sip_trunks',1),('2022_03_24_024647_add_sip_trunks_origination',1),('2022_03_24_024706_add_sip_trunks_termination',1),('2022_03_24_024955_add_sip_trunks_termination_acl',1),('2022_03_24_025005_add_sip_trunks_termination_creds',1),('2022_03_24_025528_add_sip_trunks_origination_endpoints',1),('2022_07_29_060310_add_trunk_id_to_dids',1),('2022_10_20_014232_add_ip_variables_to_sip_trunk_tables',1),('2022_12_01_213043_add_trunk_perms_workspaces',1),('2023_01_03_195656_add_customization_fields_for_verification_workflow',1),('2023_01_03_203146_add_customization_fields_for_preferences',1),('2023_01_03_215047_add_region_to_workspace',1),('2023_01_03_224005_add_customization_dns_provider',1),('2023_01_10_222013_create_microservice_api_key',2),('2023_01_11_233636_create_dns_records',3),('2023_01_11_234919_create_workspaces_regions',4),('2023_01_12_001513_add_route53_zone_id',4),('2023_01_12_003523_add_namecheap_api_settings',5),('2023_02_01_010310_create_service_plans',6),('2023_02_07_201921_create_workspaces_sip_webhooks',7),('2023_02_07_222033_add_new_fields_to_customizations',8),('2023_02_07_222519_add_resource_article_sections',9),('2023_02_07_222520_add_resource_articles',10),('2023_02_07_223303_create_faqs',11),('2023_02_27_185455_create_resource_sections',12),('2023_02_27_185512_create_resource_articles',12),('2023_03_10_014730_add_admin_sso_options',13),('2023_03_10_014822_add_admin_sso_keys',13),('2023_03_13_225748_add_search_opts_to_customizations_table',14),('2023_03_16_055819_create_workspace_events',15),('2023_03_16_060751_create_workspace_events_props',15),('2023_03_16_062133_create_workspace_events_properties',16),('2023_03_20_214208_add_req_payment_field',17),('2023_03_27_200633_add_2fa_fields',18),('2023_03_27_210259_analytics_columns',19),('2023_03_27_211743_add_analytis_creds',20),('2023_03_28_182516_add_service_plan_fields',21),('2023_04_04_202950_add_cols_to_users_invoices',22),('2023_04_04_223233_add_billing_settings_to_admin_prefs',23),('2023_04_11_175441_add_rank_to_service_plans',24),('2023_04_12_235623_create_company_representatives',25),('2023_04_13_003006_add_main_rep_column',26),('2023_04_13_005140_add_contact_details_to_custs',27),('2023_04_24_201522_add_service_plan_term',28),('2023_04_24_201845_add_service_plan_term',29),('2023_04_24_201852_add_service_plan_term_to_ws',29),('2023_04_24_202032_add_service_annual_options',30),('2023_04_25_041938_add_theme_to_users_table',31),('2023_04_26_193801_add_extension_fields_to_calls',32),('2023_04_27_213201_add_port_type',33),('2023_05_01_185459_external_app_fields',34),('2023_05_01_185604_external_app_fields_workspace',34),('2023_05_01_200957_external_app_fields_dids',35),('2023_05_04_211531_add_company_name_to_users',36),('2023_05_04_212723_add_tax_number_to_users',37),('2023_05_04_213109_make_billing_countries',38),('2023_05_04_213136_make_billing_regions',38),('2023_05_04_213444_make_billing_taxes',39),('2023_05_04_214300_add_workspace_billing',40),('2023_05_04_215409_add_invoices_due_date',40),('2023_05_04_220602_add_invoices_complete_date',40),('2023_05_04_224222_create_invoices_line_items',41),('2023_05_05_005507_add_cents_including_taxes',42),('2023_05_05_014604_add_invoice_no',43),('2023_05_05_014735_add_account_no',44),('2023_05_05_015742_add_invoice_no',45),('2023_05_08_202841_app_logins',46),('2023_05_16_210138_add_register_credits_settings',47),('2023_05_16_211500_create_sip_routing_acl',48),('2023_05_16_220528_create_workspace_routing_acl',49),('2023_05_16_223549_add_acl_country_code_field',50),('2023_05_19_191342_add_workspace_active_field',51),('2023_05_19_193615_add_joined_at_workspace_users',52);
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
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `api_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `features` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mac_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `manufacturer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `category_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_2_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_3_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_4_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_5` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_5_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_6_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_7` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_7_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_8` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_8_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_9` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_9_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_10` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_10_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_11` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_11_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_12` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_12_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_13` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_13_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_14` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_14_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_15` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_15_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_16` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_16_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_17` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_17_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_18` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_18_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_19` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_19_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_20` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_20_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `xml_attrs` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `manufacturer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_type` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones_definitions`
--

LOCK TABLES `phones_definitions` WRITE;
/*!40000 ALTER TABLE `phones_definitions` DISABLE KEYS */;
INSERT INTO `phones_definitions` VALUES (1,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2130','','',1),(2,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2140','','',2),(3,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXP2160','','',3),(4,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4248','','',4),(5,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4224','','',5),(6,'2023-01-03 23:12:26','2023-01-03 23:12:26','Grandstream','GXW4216','','',6),(7,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA303G','','',7),(8,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA504G','','',8),(9,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA508G','','',9),(10,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA509G','','',9),(11,'2023-01-03 23:12:26','2023-01-03 23:12:26','Cisco','SPA514G','','',10),(12,'2023-01-03 23:12:26','2023-01-03 23:12:26','Polycom','IP330','','',11),(13,'2023-01-03 23:12:26','2023-01-03 23:12:26','Polycom','IP331','','',12),(14,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXP2130','','',1),(15,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXP2140','','',2),(16,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXP2160','','',3),(17,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXW4248','','',4),(18,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXW4224','','',5),(19,'2023-06-05 20:28:23','2023-06-05 20:28:23','Grandstream','GXW4216','','',6),(20,'2023-06-05 20:28:23','2023-06-05 20:28:23','Cisco','SPA303G','','',7),(21,'2023-06-05 20:28:23','2023-06-05 20:28:23','Cisco','SPA504G','','',8),(22,'2023-06-05 20:28:23','2023-06-05 20:28:23','Cisco','SPA508G','','',9),(23,'2023-06-05 20:28:23','2023-06-05 20:28:23','Cisco','SPA509G','','',9),(24,'2023-06-05 20:28:23','2023-06-05 20:28:23','Cisco','SPA514G','','',10),(25,'2023-06-05 20:28:23','2023-06-05 20:28:23','Polycom','IP330','','',11),(26,'2023-06-05 20:28:23','2023-06-05 20:28:23','Polycom','IP331','','',12),(27,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXP2130','','',1),(28,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXP2140','','',2),(29,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXP2160','','',3),(30,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXW4248','','',4),(31,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXW4224','','',5),(32,'2023-06-05 20:42:06','2023-06-05 20:42:06','Grandstream','GXW4216','','',6),(33,'2023-06-05 20:42:06','2023-06-05 20:42:06','Cisco','SPA303G','','',7),(34,'2023-06-05 20:42:06','2023-06-05 20:42:06','Cisco','SPA504G','','',8),(35,'2023-06-05 20:42:06','2023-06-05 20:42:06','Cisco','SPA508G','','',9),(36,'2023-06-05 20:42:06','2023-06-05 20:42:06','Cisco','SPA509G','','',9),(37,'2023-06-05 20:42:06','2023-06-05 20:42:06','Cisco','SPA514G','','',10),(38,'2023-06-05 20:42:06','2023-06-05 20:42:06','Polycom','IP330','','',11),(39,'2023-06-05 20:42:06','2023-06-05 20:42:06','Polycom','IP331','','',12),(40,'2023-06-05 20:46:57','2023-06-05 20:46:57','Grandstream','GXP2130','','',1),(41,'2023-06-05 20:46:57','2023-06-05 20:46:57','Grandstream','GXP2140','','',2),(42,'2023-06-05 20:46:57','2023-06-05 20:46:57','Grandstream','GXP2160','','',3),(43,'2023-06-05 20:46:57','2023-06-05 20:46:57','Grandstream','GXW4248','','',4),(44,'2023-06-05 20:46:58','2023-06-05 20:46:58','Grandstream','GXW4224','','',5),(45,'2023-06-05 20:46:58','2023-06-05 20:46:58','Grandstream','GXW4216','','',6),(46,'2023-06-05 20:46:58','2023-06-05 20:46:58','Cisco','SPA303G','','',7),(47,'2023-06-05 20:46:58','2023-06-05 20:46:58','Cisco','SPA504G','','',8),(48,'2023-06-05 20:46:58','2023-06-05 20:46:58','Cisco','SPA508G','','',9),(49,'2023-06-05 20:46:58','2023-06-05 20:46:58','Cisco','SPA509G','','',9),(50,'2023-06-05 20:46:58','2023-06-05 20:46:58','Cisco','SPA514G','','',10),(51,'2023-06-05 20:46:58','2023-06-05 20:46:58','Polycom','IP330','','',11),(52,'2023-06-05 20:46:58','2023-06-05 20:46:58','Polycom','IP331','','',12),(53,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXP2130','','',1),(54,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXP2140','','',2),(55,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXP2160','','',3),(56,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXW4248','','',4),(57,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXW4224','','',5),(58,'2023-06-05 20:47:21','2023-06-05 20:47:21','Grandstream','GXW4216','','',6),(59,'2023-06-05 20:47:21','2023-06-05 20:47:21','Cisco','SPA303G','','',7),(60,'2023-06-05 20:47:21','2023-06-05 20:47:21','Cisco','SPA504G','','',8),(61,'2023-06-05 20:47:21','2023-06-05 20:47:21','Cisco','SPA508G','','',9),(62,'2023-06-05 20:47:21','2023-06-05 20:47:21','Cisco','SPA509G','','',9),(63,'2023-06-05 20:47:21','2023-06-05 20:47:21','Cisco','SPA514G','','',10),(64,'2023-06-05 20:47:21','2023-06-05 20:47:21','Polycom','IP330','','',11),(65,'2023-06-05 20:47:21','2023-06-05 20:47:21','Polycom','IP331','','',12),(66,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXP2130','','',1),(67,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXP2140','','',2),(68,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXP2160','','',3),(69,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXW4248','','',4),(70,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXW4224','','',5),(71,'2023-06-05 20:47:40','2023-06-05 20:47:40','Grandstream','GXW4216','','',6),(72,'2023-06-05 20:47:40','2023-06-05 20:47:40','Cisco','SPA303G','','',7),(73,'2023-06-05 20:47:40','2023-06-05 20:47:40','Cisco','SPA504G','','',8),(74,'2023-06-05 20:47:40','2023-06-05 20:47:40','Cisco','SPA508G','','',9),(75,'2023-06-05 20:47:40','2023-06-05 20:47:40','Cisco','SPA509G','','',9),(76,'2023-06-05 20:47:40','2023-06-05 20:47:40','Cisco','SPA514G','','',10),(77,'2023-06-05 20:47:40','2023-06-05 20:47:40','Polycom','IP330','','',11),(78,'2023-06-05 20:47:40','2023-06-05 20:47:40','Polycom','IP331','','',12),(79,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXP2130','','',1),(80,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXP2140','','',2),(81,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXP2160','','',3),(82,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXW4248','','',4),(83,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXW4224','','',5),(84,'2023-06-05 20:47:51','2023-06-05 20:47:51','Grandstream','GXW4216','','',6),(85,'2023-06-05 20:47:51','2023-06-05 20:47:51','Cisco','SPA303G','','',7),(86,'2023-06-05 20:47:51','2023-06-05 20:47:51','Cisco','SPA504G','','',8),(87,'2023-06-05 20:47:51','2023-06-05 20:47:51','Cisco','SPA508G','','',9),(88,'2023-06-05 20:47:51','2023-06-05 20:47:51','Cisco','SPA509G','','',9),(89,'2023-06-05 20:47:51','2023-06-05 20:47:51','Cisco','SPA514G','','',10),(90,'2023-06-05 20:47:51','2023-06-05 20:47:51','Polycom','IP330','','',11),(91,'2023-06-05 20:47:51','2023-06-05 20:47:51','Polycom','IP331','','',12),(92,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXP2130','','',1),(93,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXP2140','','',2),(94,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXP2160','','',3),(95,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXW4248','','',4),(96,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXW4224','','',5),(97,'2023-06-05 20:59:49','2023-06-05 20:59:49','Grandstream','GXW4216','','',6),(98,'2023-06-05 20:59:49','2023-06-05 20:59:49','Cisco','SPA303G','','',7),(99,'2023-06-05 20:59:49','2023-06-05 20:59:49','Cisco','SPA504G','','',8),(100,'2023-06-05 20:59:49','2023-06-05 20:59:49','Cisco','SPA508G','','',9),(101,'2023-06-05 20:59:49','2023-06-05 20:59:49','Cisco','SPA509G','','',9),(102,'2023-06-05 20:59:49','2023-06-05 20:59:49','Cisco','SPA514G','','',10),(103,'2023-06-05 20:59:49','2023-06-05 20:59:49','Polycom','IP330','','',11),(104,'2023-06-05 20:59:49','2023-06-05 20:59:49','Polycom','IP331','','',12),(105,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXP2130','','',1),(106,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXP2140','','',2),(107,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXP2160','','',3),(108,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXW4248','','',4),(109,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXW4224','','',5),(110,'2023-06-05 21:02:12','2023-06-05 21:02:12','Grandstream','GXW4216','','',6),(111,'2023-06-05 21:02:12','2023-06-05 21:02:12','Cisco','SPA303G','','',7),(112,'2023-06-05 21:02:12','2023-06-05 21:02:12','Cisco','SPA504G','','',8),(113,'2023-06-05 21:02:12','2023-06-05 21:02:12','Cisco','SPA508G','','',9),(114,'2023-06-05 21:02:12','2023-06-05 21:02:12','Cisco','SPA509G','','',9),(115,'2023-06-05 21:02:12','2023-06-05 21:02:12','Cisco','SPA514G','','',10),(116,'2023-06-05 21:02:12','2023-06-05 21:02:12','Polycom','IP330','','',11),(117,'2023-06-05 21:02:12','2023-06-05 21:02:12','Polycom','IP331','','',12),(118,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXP2130','','',1),(119,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXP2140','','',2),(120,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXP2160','','',3),(121,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXW4248','','',4),(122,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXW4224','','',5),(123,'2023-06-05 21:06:42','2023-06-05 21:06:42','Grandstream','GXW4216','','',6),(124,'2023-06-05 21:06:42','2023-06-05 21:06:42','Cisco','SPA303G','','',7),(125,'2023-06-05 21:06:42','2023-06-05 21:06:42','Cisco','SPA504G','','',8),(126,'2023-06-05 21:06:42','2023-06-05 21:06:42','Cisco','SPA508G','','',9),(127,'2023-06-05 21:06:42','2023-06-05 21:06:42','Cisco','SPA509G','','',9),(128,'2023-06-05 21:06:42','2023-06-05 21:06:42','Cisco','SPA514G','','',10),(129,'2023-06-05 21:06:42','2023-06-05 21:06:42','Polycom','IP330','','',11),(130,'2023-06-05 21:06:42','2023-06-05 21:06:42','Polycom','IP331','','',12),(131,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXP2130','','',1),(132,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXP2140','','',2),(133,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXP2160','','',3),(134,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXW4248','','',4),(135,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXW4224','','',5),(136,'2023-06-05 21:46:07','2023-06-05 21:46:07','Grandstream','GXW4216','','',6),(137,'2023-06-05 21:46:07','2023-06-05 21:46:07','Cisco','SPA303G','','',7),(138,'2023-06-05 21:46:07','2023-06-05 21:46:07','Cisco','SPA504G','','',8),(139,'2023-06-05 21:46:07','2023-06-05 21:46:07','Cisco','SPA508G','','',9),(140,'2023-06-05 21:46:07','2023-06-05 21:46:07','Cisco','SPA509G','','',9),(141,'2023-06-05 21:46:07','2023-06-05 21:46:07','Cisco','SPA514G','','',10),(142,'2023-06-05 21:46:07','2023-06-05 21:46:07','Polycom','IP330','','',11),(143,'2023-06-05 21:46:07','2023-06-05 21:46:07','Polycom','IP331','','',12),(144,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXP2130','','',1),(145,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXP2140','','',2),(146,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXP2160','','',3),(147,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXW4248','','',4),(148,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXW4224','','',5),(149,'2023-06-05 21:48:22','2023-06-05 21:48:22','Grandstream','GXW4216','','',6),(150,'2023-06-05 21:48:22','2023-06-05 21:48:22','Cisco','SPA303G','','',7),(151,'2023-06-05 21:48:22','2023-06-05 21:48:22','Cisco','SPA504G','','',8),(152,'2023-06-05 21:48:22','2023-06-05 21:48:22','Cisco','SPA508G','','',9),(153,'2023-06-05 21:48:22','2023-06-05 21:48:22','Cisco','SPA509G','','',9),(154,'2023-06-05 21:48:22','2023-06-05 21:48:22','Cisco','SPA514G','','',10),(155,'2023-06-05 21:48:22','2023-06-05 21:48:22','Polycom','IP330','','',11),(156,'2023-06-05 21:48:22','2023-06-05 21:48:22','Polycom','IP331','','',12),(157,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXP2130','','',1),(158,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXP2140','','',2),(159,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXP2160','','',3),(160,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXW4248','','',4),(161,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXW4224','','',5),(162,'2023-06-05 21:52:53','2023-06-05 21:52:53','Grandstream','GXW4216','','',6),(163,'2023-06-05 21:52:53','2023-06-05 21:52:53','Cisco','SPA303G','','',7),(164,'2023-06-05 21:52:53','2023-06-05 21:52:53','Cisco','SPA504G','','',8),(165,'2023-06-05 21:52:53','2023-06-05 21:52:53','Cisco','SPA508G','','',9),(166,'2023-06-05 21:52:53','2023-06-05 21:52:53','Cisco','SPA509G','','',9),(167,'2023-06-05 21:52:53','2023-06-05 21:52:53','Cisco','SPA514G','','',10),(168,'2023-06-05 21:52:53','2023-06-05 21:52:53','Polycom','IP330','','',11),(169,'2023-06-05 21:52:53','2023-06-05 21:52:53','Polycom','IP331','','',12),(170,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXP2130','','',1),(171,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXP2140','','',2),(172,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXP2160','','',3),(173,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXW4248','','',4),(174,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXW4224','','',5),(175,'2023-06-05 21:56:05','2023-06-05 21:56:05','Grandstream','GXW4216','','',6),(176,'2023-06-05 21:56:05','2023-06-05 21:56:05','Cisco','SPA303G','','',7),(177,'2023-06-05 21:56:05','2023-06-05 21:56:05','Cisco','SPA504G','','',8),(178,'2023-06-05 21:56:05','2023-06-05 21:56:05','Cisco','SPA508G','','',9),(179,'2023-06-05 21:56:05','2023-06-05 21:56:05','Cisco','SPA509G','','',9),(180,'2023-06-05 21:56:05','2023-06-05 21:56:05','Cisco','SPA514G','','',10),(181,'2023-06-05 21:56:05','2023-06-05 21:56:05','Polycom','IP330','','',11),(182,'2023-06-05 21:56:05','2023-06-05 21:56:05','Polycom','IP331','','',12),(183,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXP2130','','',1),(184,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXP2140','','',2),(185,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXP2160','','',3),(186,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXW4248','','',4),(187,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXW4224','','',5),(188,'2023-06-05 21:57:38','2023-06-05 21:57:38','Grandstream','GXW4216','','',6),(189,'2023-06-05 21:57:38','2023-06-05 21:57:38','Cisco','SPA303G','','',7),(190,'2023-06-05 21:57:38','2023-06-05 21:57:38','Cisco','SPA504G','','',8),(191,'2023-06-05 21:57:38','2023-06-05 21:57:38','Cisco','SPA508G','','',9),(192,'2023-06-05 21:57:38','2023-06-05 21:57:38','Cisco','SPA509G','','',9),(193,'2023-06-05 21:57:38','2023-06-05 21:57:38','Cisco','SPA514G','','',10),(194,'2023-06-05 21:57:38','2023-06-05 21:57:38','Polycom','IP330','','',11),(195,'2023-06-05 21:57:38','2023-06-05 21:57:38','Polycom','IP331','','',12),(196,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXP2130','','',1),(197,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXP2140','','',2),(198,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXP2160','','',3),(199,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXW4248','','',4),(200,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXW4224','','',5),(201,'2023-06-05 23:11:06','2023-06-05 23:11:06','Grandstream','GXW4216','','',6),(202,'2023-06-05 23:11:06','2023-06-05 23:11:06','Cisco','SPA303G','','',7),(203,'2023-06-05 23:11:06','2023-06-05 23:11:06','Cisco','SPA504G','','',8),(204,'2023-06-05 23:11:06','2023-06-05 23:11:06','Cisco','SPA508G','','',9),(205,'2023-06-05 23:11:06','2023-06-05 23:11:06','Cisco','SPA509G','','',9),(206,'2023-06-05 23:11:06','2023-06-05 23:11:06','Cisco','SPA514G','','',10),(207,'2023-06-05 23:11:06','2023-06-05 23:11:06','Polycom','IP330','','',11),(208,'2023-06-05 23:11:06','2023-06-05 23:11:06','Polycom','IP331','','',12),(209,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXP2130','','',1),(210,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXP2140','','',2),(211,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXP2160','','',3),(212,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXW4248','','',4),(213,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXW4224','','',5),(214,'2023-06-05 23:12:07','2023-06-05 23:12:07','Grandstream','GXW4216','','',6),(215,'2023-06-05 23:12:07','2023-06-05 23:12:07','Cisco','SPA303G','','',7),(216,'2023-06-05 23:12:07','2023-06-05 23:12:07','Cisco','SPA504G','','',8),(217,'2023-06-05 23:12:07','2023-06-05 23:12:07','Cisco','SPA508G','','',9),(218,'2023-06-05 23:12:07','2023-06-05 23:12:07','Cisco','SPA509G','','',9),(219,'2023-06-05 23:12:07','2023-06-05 23:12:07','Cisco','SPA514G','','',10),(220,'2023-06-05 23:12:07','2023-06-05 23:12:07','Polycom','IP330','','',11),(221,'2023-06-05 23:12:07','2023-06-05 23:12:07','Polycom','IP331','','',12),(222,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXP2130','','',1),(223,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXP2140','','',2),(224,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXP2160','','',3),(225,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXW4248','','',4),(226,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXW4224','','',5),(227,'2023-06-05 23:12:33','2023-06-05 23:12:33','Grandstream','GXW4216','','',6),(228,'2023-06-05 23:12:33','2023-06-05 23:12:33','Cisco','SPA303G','','',7),(229,'2023-06-05 23:12:33','2023-06-05 23:12:33','Cisco','SPA504G','','',8),(230,'2023-06-05 23:12:33','2023-06-05 23:12:33','Cisco','SPA508G','','',9),(231,'2023-06-05 23:12:33','2023-06-05 23:12:33','Cisco','SPA509G','','',9),(232,'2023-06-05 23:12:33','2023-06-05 23:12:33','Cisco','SPA514G','','',10),(233,'2023-06-05 23:12:33','2023-06-05 23:12:33','Polycom','IP330','','',11),(234,'2023-06-05 23:12:33','2023-06-05 23:12:33','Polycom','IP331','','',12),(235,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXP2130','','',1),(236,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXP2140','','',2),(237,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXP2160','','',3),(238,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXW4248','','',4),(239,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXW4224','','',5),(240,'2023-06-05 23:12:45','2023-06-05 23:12:45','Grandstream','GXW4216','','',6),(241,'2023-06-05 23:12:45','2023-06-05 23:12:45','Cisco','SPA303G','','',7),(242,'2023-06-05 23:12:45','2023-06-05 23:12:45','Cisco','SPA504G','','',8),(243,'2023-06-05 23:12:45','2023-06-05 23:12:45','Cisco','SPA508G','','',9),(244,'2023-06-05 23:12:45','2023-06-05 23:12:45','Cisco','SPA509G','','',9),(245,'2023-06-05 23:12:45','2023-06-05 23:12:45','Cisco','SPA514G','','',10),(246,'2023-06-05 23:12:45','2023-06-05 23:12:45','Polycom','IP330','','',11),(247,'2023-06-05 23:12:45','2023-06-05 23:12:45','Polycom','IP331','','',12),(248,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXP2130','','',1),(249,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXP2140','','',2),(250,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXP2160','','',3),(251,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXW4248','','',4),(252,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXW4224','','',5),(253,'2023-06-05 23:13:24','2023-06-05 23:13:24','Grandstream','GXW4216','','',6),(254,'2023-06-05 23:13:24','2023-06-05 23:13:24','Cisco','SPA303G','','',7),(255,'2023-06-05 23:13:24','2023-06-05 23:13:24','Cisco','SPA504G','','',8),(256,'2023-06-05 23:13:24','2023-06-05 23:13:24','Cisco','SPA508G','','',9),(257,'2023-06-05 23:13:24','2023-06-05 23:13:24','Cisco','SPA509G','','',9),(258,'2023-06-05 23:13:24','2023-06-05 23:13:24','Cisco','SPA514G','','',10),(259,'2023-06-05 23:13:24','2023-06-05 23:13:24','Polycom','IP330','','',11),(260,'2023-06-05 23:13:24','2023-06-05 23:13:24','Polycom','IP331','','',12),(261,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXP2130','','',1),(262,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXP2140','','',2),(263,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXP2160','','',3),(264,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXW4248','','',4),(265,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXW4224','','',5),(266,'2023-06-06 16:59:24','2023-06-06 16:59:24','Grandstream','GXW4216','','',6),(267,'2023-06-06 16:59:24','2023-06-06 16:59:24','Cisco','SPA303G','','',7),(268,'2023-06-06 16:59:24','2023-06-06 16:59:24','Cisco','SPA504G','','',8),(269,'2023-06-06 16:59:24','2023-06-06 16:59:24','Cisco','SPA508G','','',9),(270,'2023-06-06 16:59:24','2023-06-06 16:59:24','Cisco','SPA509G','','',9),(271,'2023-06-06 16:59:24','2023-06-06 16:59:24','Cisco','SPA514G','','',10),(272,'2023-06-06 16:59:24','2023-06-06 16:59:24','Polycom','IP330','','',11),(273,'2023-06-06 16:59:24','2023-06-06 16:59:24','Polycom','IP331','','',12),(274,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXP2130','','',1),(275,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXP2140','','',2),(276,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXP2160','','',3),(277,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXW4248','','',4),(278,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXW4224','','',5),(279,'2023-06-06 18:29:49','2023-06-06 18:29:49','Grandstream','GXW4216','','',6),(280,'2023-06-06 18:29:49','2023-06-06 18:29:49','Cisco','SPA303G','','',7),(281,'2023-06-06 18:29:49','2023-06-06 18:29:49','Cisco','SPA504G','','',8),(282,'2023-06-06 18:29:49','2023-06-06 18:29:49','Cisco','SPA508G','','',9),(283,'2023-06-06 18:29:49','2023-06-06 18:29:49','Cisco','SPA509G','','',9),(284,'2023-06-06 18:29:49','2023-06-06 18:29:49','Cisco','SPA514G','','',10),(285,'2023-06-06 18:29:49','2023-06-06 18:29:49','Polycom','IP330','','',11),(286,'2023-06-06 18:29:49','2023-06-06 18:29:49','Polycom','IP331','','',12);
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
  `setting_variable_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `setting_variable_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `mac_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_variable_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `setting_variable_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `setting_option_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `plan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `started_at` datetime NOT NULL,
  `renews_at` datetime DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `plan_usage_period_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `plan_usage_period_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_usage_period`
--

LOCK TABLES `plan_usage_period` WRITE;
/*!40000 ALTER TABLE `plan_usage_period` DISABLE KEYS */;
INSERT INTO `plan_usage_period` VALUES (143,'2023-06-06 18:29:48','2023-06-06 18:29:48',202,'','2023-06-06 18:29:48',NULL,NULL,1);
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
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `estimated_completion_date` date NOT NULL,
  `eta` date DEFAULT NULL,
  `info_needed` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_of_port` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'single',
  `numbers` varchar(2048) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `filename` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `api_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  `call_id` int unsigned DEFAULT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `size` double(8,2) NOT NULL DEFAULT '0.00',
  `workspace_id` int unsigned NOT NULL,
  `transcription_ready` tinyint(1) NOT NULL DEFAULT '0',
  `transcription_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_snapshot` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `storage_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `storage_server_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `s3_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recordings`
--

LOCK TABLES `recordings` WRITE;
/*!40000 ALTER TABLE `recordings` DISABLE KEYS */;
INSERT INTO `recordings` VALUES (64,'2023-06-06 18:29:49','2023-06-06 18:29:49','recording-fc17e155-38b1-4421-8cf4-cbd5fda49938','completed','http://recordings.onelinepbx.com/user-id/test.wav',215,43,'','',0,0.00,202,0,'','','','','',0,0),(65,'2023-06-06 18:29:49','2023-06-06 18:29:49','recording-0b87046e-7a25-44e0-bc8e-353b34629643','completed','http://recordings.onelinepbx.com/user-id/test.wav',215,43,'','',0,0.00,202,0,'','','','','',0,0),(66,'2023-06-06 18:29:49','2023-06-06 18:29:49','recording-d84368df-2ac1-46c6-a969-ce879278b5c5','completed','http://recordings.onelinepbx.com/user-id/test.wav',215,44,'','',0,0.00,202,0,'','','','','',0,0);
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
  `seo_tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `active` smallint DEFAULT '0',
  `content` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `key_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `resource_articles_section_id_foreign` (`section_id`),
  CONSTRAINT `resource_articles_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `resource_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_articles`
--

LOCK TABLES `resource_articles` WRITE;
/*!40000 ALTER TABLE `resource_articles` DISABLE KEYS */;
INSERT INTO `resource_articles` VALUES (4,'2023-03-03 03:54:19','2023-03-27 22:04:04','Purchasing New Numbers','','learn how to buy numbers in your web portal.','',5,'did numbers, dids, purchase, buy, lineblocs',1,'# Purchase Numbers\r\n\r\n\r\n\r\nLineblocs currently offers voice numbers that are toll-free, local or vanity based. You can use the Lineblocs user dashboard to buy new DID numbers in a supported rate centre and region.\r\n\r\n\r\n\r\n## Searching for numbers\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click [\"DID Numbers\" -> \"Buy Numbers\"](https://app.lineblocs.com/#/dashboard/dids/buy-numbers)\r\n\r\n2. Select Voice Numbers\r\n\r\n3. Search for numbers based on the filters provided. Click \"More Options\" for advanced filters\r\n\r\n![info](/img/frontend/docs/purchase-numbers/filter-1.png) \r\n\r\n4. Click Search\r\n\r\n\r\n\r\n## Buying a number\r\n\r\n\r\n\r\nTo purchase a number, click the ![info](/img/frontend/docs/purchase-numbers/buy.png) button next to the number.\r\n\r\n\r\n\r\n## Setup Number\r\n\r\n\r\n\r\nOnce you have purchased a new number, you can change the number\'s settings according to your needs – including changing its label, call flow, and more. For more info on managing numbers please [click here](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related guides, please see the following:\r\n\r\n\r\n\r\n- [Porting Numbers](https://lineblocs.com/resources/managing-numbers/porting-numbers)\r\n\r\n- [Releasing Numbers](https://lineblocs.com/resources/managing-numbers/release-numbers)','purchase-numbers'),(5,'2023-03-03 03:55:36','2023-03-27 22:04:12','Managing number tags and flows','','add number tags and flows to your number','',5,'did numbers, manage dids, edit, delete',1,'# Manage Numbers\r\n\r\n\r\n\r\nYou can use the Lineblocs dashboard to manage number settings – including number tags and flows. Managing numbers is a simple yet very useful feature.\r\n\r\n\r\n\r\n## Editing a number\r\n\r\n\r\n\r\n1. Go to [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n\r\n\r\n#### Change Number Name\r\n\r\n\r\n\r\nYour number name is used as a label for your number. For example, you may want to make use of \"Sales Number\" if your number is related to sales. Or you may want to associate an appropriate name for your number based on its use case.\r\n\r\n\r\n\r\nThe number name is also used throughout Lineblocs – in call flow editor and other sections. Keeping your number name unique helps you search for the number when needed.\r\n\r\n\r\n\r\n#### Add Number Tags\r\n\r\n\r\n\r\nYou can add one or more tags to your number. Number tags can be used to add additional filters to your number.\r\n\r\n\r\n\r\nNumber tags help you find groups of numbers based on common attributes. For example, you may want to use the number tag \"West\" if you know it will only be used by agents in a Western region.\r\n\r\n\r\n\r\n#### Number Call Flow\r\n\r\n\r\n\r\nTo change your number\'s inbound Lineblocs flow you can update the \"Attached Flow\" setting. \r\n\r\n\r\n\r\n## Update Number\r\n\r\n\r\n\r\nTo save your number settings, click \"Save\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor other related guides be sure to check out the following:\r\n\r\n\r\n\r\n[Porting Numbers](https://lineblocs.com/resources/managing-numbers/porting-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','manage-numbers'),(6,'2023-03-03 03:56:31','2023-03-27 22:04:20','Releasing numbers','','a guide on unrenting numbers','',5,'release numbers, unrent, lineblocs',1,'# Release Numbers\r\n\r\n\r\n\r\nYou can unrent a Lineblocs number at any time – regardless of your membership plan or account status. Please note that once you unrent a number, all of its call records and associated data will also be removed from your account. \r\n\r\n\r\n\r\n## Unrent A Number\r\n\r\n\r\n\r\n1. Go to [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the     ![](/img/frontend/docs/shared/trash.png) icon on the number you wish to unrent\r\n\r\n3. Confirm unrenting the number by typing in the number\r\n\r\n4. Click \"Confirm\"\r\n\r\n\r\n\r\n## Discontinued Number Billing Charge\r\n\r\n\r\n\r\nBilling charges for your number will be terminated on the 1st of the following month. For example, if you have unrented at number on Jan 15th, billing for this number will stop on Feb 1st.\r\n\r\n\r\n\r\n# Next Steps\r\n\r\n\r\n\r\nFor more info on managing numbers or billing posts, please see:\r\n\r\n\r\n\r\n[Managing Numbers](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','release-numbers'),(7,'2023-03-03 03:57:20','2023-03-27 22:04:30','Porting Numbers','','creating port in or port out requests','',5,'port numbers, port in, port out, lineblocs',1,'# Porting Numbers\r\n\r\n\r\n\r\nLineblocs currently supports port-in requests in various funded rate centres.\r\n\r\n\r\n\r\nFor a complete list of assisted regions, please see [Supported Rate Centers](https://lineblocs.com/resources/other-topics/supported-rate-centers).\r\n\r\n\r\n\r\n## Port-In Request Requirements\r\n\r\n\r\n\r\nIf you are trying to port in a number to Lineblocs, please keep in mind the following requirements:\r\n\r\n\r\n\r\n1. The number you are trying port should not have been disconnected by the provider\r\n\r\n2. No dispute should be open with the porting number\r\n\r\n3. Porting number should not be scheduled for disconnection\r\n\r\n3. The porting number cannot have a contract\r\n\r\n4. The number you port must be available in a rate centre we support\r\n\r\n\r\n\r\n## Start Port Request\r\n\r\n\r\n\r\nTo start a Port-In request, please login to the Lineblocs portal then access the port request page at [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create).\r\n\r\n\r\n\r\nOn the port request page you will need to provide us with the following info:\r\n\r\n\r\n\r\n1. Your First and Last Name\r\n\r\n2. Local Address\r\n\r\n3. Letter of Authorization (LOA) - a letter of authorization from the number owner\r\n\r\n4. Customer Service Record (CSR) - a customer service record\r\n\r\n5. Recent invoice from your provider - an invoice dated no longer than 90 days\r\n\r\n\r\n\r\n## Submitting Port-In Request\r\n\r\n\r\n\r\nTo submit your port-in request, please fill in the fields on the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create), and then click the \"Save\" button.\r\n\r\n\r\n\r\n## Port-In Review Stages\r\n\r\n\r\n\r\nOnce you have submitted your port-in request, you will be sent updates whenever the port-in request status changes. \r\n\r\n\r\n\r\nThe statuses your port-in request will go through can include the following:\r\n\r\n\r\n\r\n1. Pending Review\r\n\r\n\r\n\r\n       This is when we have received your port in request but have not confirmed on our end yet.\r\n\r\n\r\n\r\n2. Received\r\n\r\n\r\n\r\n        Port in request was received and lineblocs has confirmed it will attempt the port-in request.\r\n\r\n\r\n\r\n3. Submitted to Provider\r\n\r\n\r\n\r\n        The port request was sent to your current carrier\r\n\r\n\r\n\r\n3. Confirmed\r\n\r\n\r\n\r\n        Your port-in has been confirmed, and an ETA has been provided.\r\n\r\n\r\n\r\n4. Completed\r\n\r\n\r\n\r\n        Your port-in is now completed\r\n\r\n\r\n\r\nYou will be notified via email whenever the port-in request status and when an ETA for the port is established.\r\n\r\n\r\n\r\nYou can also track the status of your Port-In request by accessing the [Create Port Request](https://app.lineblocs.com/#/dashboard/dids/ports/create) and checking the Status column in the port numbers list.\r\n\r\n\r\n\r\n![Port Status](/img/frontend/docs/port-numbers/port-status.png)\r\n\r\n\r\n\r\n## Editing Port Request\r\n\r\n\r\n\r\nYou may be required to edit your port-in request depending on whether more personal information is required.\r\n\r\n\r\n\r\nTo update your port-in request please go to the [Port Requests Page](https://app.lineblocs.com/#/dashboard/dids/ports) \r\n\r\n\r\n\r\nthen click the ![](/img/frontend/docs/shared/edit.png) icon on the ported number.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on managing numbers or billing related to numbers, be sure to see articles below:\r\n\r\n\r\n\r\n[Managing Numbers](https://lineblocs.com/resources/managing-numbers/manage-numbers)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','porting-numbers'),(8,'2023-03-03 03:59:38','2023-03-27 22:04:46','Call pricing','','learn about the pricing behind your calls and when you are charged for inbound or outbound calling.','',6,'call pricing, CSVs, inbound, outbound, lineblocs',1,'# Call Pricing\r\n\r\n\r\n\r\nLineblocs currently offers competitive local and toll-free call pricing in select regions.\r\n\r\nAll user calls on Lineblocs are billed by usage and also based on your membership plan.\r\n\r\n\r\n\r\n## Call Rates\r\n\r\n\r\n\r\nTo view an up to date list of our calling rates by country please view [Voice Pricing Page](https://lineblocs.com/rates). \r\n\r\n\r\n\r\n## CSV downloads\r\n\r\n\r\n\r\nYou can also download a CSV sheet that includes our inbound and outbound call rates. \r\n\r\n\r\n\r\nTo download the CSV list please use links below:\r\n\r\n\r\n\r\n[Outbound CSV call rates](https://lineblocs.com/extra/outbound-call-rates.csv)\r\n\r\n\r\n\r\n[Inbound CSV call rates](https://lineblocs.com/extra/inbound-call-rates.csv)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing and pricing please view links below:\r\n\r\n\r\n\r\n[Upgrading Plan](https://lineblocs.com/resources/billing-and-pricing/upgrading-plan)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','call-pricing'),(9,'2023-03-03 04:00:45','2023-03-27 22:04:57','Monthly Invoices','','how to view invoices in your dashboard and manage invoice billing.','',6,'invoices, monthly invoices, billing, lineblocs',1,'# Monthly Invoices\r\n\r\n\r\n\r\n\r\n\r\nMonthly invoices are generated in the Lineblocs dashboard and available at any time for download.\r\n\r\n\r\n\r\nIn this guide we discuss monthly billing, and the resources you are billed for on a monthly basis.\r\n\r\n\r\n\r\n## Billed Resources\r\n\r\n\r\n\r\nWe currently bill based on the dedicated usage of call, fax, and IM based resources. The costs associated with our billing plans are typically based on carrier call toll, server hosting costs, and the usage of third-party API services.\r\n\r\n\r\n\r\n#### Usage Billing\r\n\r\n\r\n\r\n1. Incoming Call Toll\r\n\r\n2. Outgoing Call Toll\r\n\r\n3. Fax related charges\r\n\r\n4. Third-party API services\r\n\r\n\r\n\r\n#### Per month related\r\n\r\n\r\n\r\n1. Recording Storage\r\n\r\n2. PBX hosting expenses\r\n\r\n3. DID number renewal\r\n\r\n\r\n\r\n## Downloading an invoice\r\n\r\n\r\n\r\nTo download a monthly invoice:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click the \"History\" tab\r\n\r\n4. Enter a start and end date range for your invoice\r\n\r\n5. Click \"Download\"\r\n\r\n\r\n\r\n## Receiving Invoices By Email\r\n\r\n\r\n\r\nYou can also choose to receive invoices by email.\r\n\r\n\r\n\r\nTo enable invoices by email:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click the \"Settings\" tab\r\n\r\n4. Check \"Receive monthly invoices by email\"\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing, please see the articles below:\r\n\r\n\r\n\r\n[Upgrading Plan](https://lineblocs.com/resources/billing-and-pricing/upgrading-plan)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','monthly-invoices'),(10,'2023-03-03 04:07:18','2023-03-27 22:12:55','Upgrading Plan','','how to upgrade your Lineblocs membership','',6,'upgrade plan, upgrade, lineblocs, membership, change',1,'# Upgrading Plan \r\n\r\n\r\n\r\nUpgrading your membership type is a straightforward process. \r\n\r\n\r\n\r\nTo learn more about the Lineblocs memberships, please view our [Pricing page](https://lineblocs.com/pricing)\r\n\r\n\r\n\r\n## Changing membership type\r\n\r\n\r\n\r\nTo change your membership plan:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to [Billing](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Next to your membership plan, click     ![upgrade](/img/frontend/docs/upgrade-plan/upgrade.png)\r\n\r\n3. Select your new plan\r\n\r\n4. Select a billing method\r\n\r\n5. Save all changes\r\n\r\n\r\n\r\n## Billing Changes\r\n\r\n\r\n\r\nAfter you have upgraded your billing plan, you should be able to make use of your workspace features instantly.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing matters, please see the articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','upgrading-plan'),(11,'2023-03-03 04:08:10','2023-03-27 22:05:14','Adding Credit (Pay As You Go Only)','','learn about the payment options available to fund your lineblocs account.','',6,'adding credit, billing, types of payment, paypal, credit card, lineblocs, adding credit',1,'# Adding Credit (Pay-as-you-go only)\r\n\r\n\r\n\r\nYou can use the Lineblocs dashboard to add credit to your account at any time.\r\n\r\n\r\n\r\n## Adding Credit using a Card\r\n\r\n\r\n\r\n\r\n\r\n1. In Lineblocs dashboard go to the [Billing Section](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Select a card and the desired credit amount\r\n\r\n3. Click     ![Pay PayPal](/img/frontend/docs/shared/add-credit.png)\r\n\r\n\r\n\r\n## Using PayPal\r\n\r\n\r\n\r\nto use PayPal as a checkout method:\r\n\r\n\r\n\r\n1. in the left sub menu click \"PayPal\"\r\n\r\n2. select your desired credit amount\r\n\r\n3. click     ![Pay PayPal](/img/frontend/docs/shared/pay-paypal.png)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing rela-ed topics, please see articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','adding-credit'),(12,'2023-03-03 04:09:35','2023-03-27 22:05:23','Managing Billing Cards','','how to manage billing cards on Lineblocs','',6,'managing cards, billing, types of payment, paypal, credit card, lineblocs, adding credit',1,'# Managing Billing\r\n\r\n\r\n\r\nLineblocs dashboard can also be used to add a new card, remove a card, or change the primary billing card on your account at any time.\r\n\r\n\r\n\r\n## Adding Credit Card\r\n\r\n\r\n\r\nTo add a credit card to your Lineblocs account:\r\n\r\n\r\n\r\n1. in Lineblocs dashboard go to [Billing](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click \"Add Card\"\r\n\r\n3. Enter your card details\r\n\r\n4. Click \"Submit\"\r\n\r\n\r\n\r\n## Change Primary Card\r\n\r\n\r\n\r\nTo change your primary billing card please click the ![primary](/img/frontend/docs/payment-options/set-primary.png) button next to the card.\r\n\r\n\r\n\r\n## Removing A Card\r\n\r\n\r\n\r\nTo remove a card you can click the ![trash](/img/frontend/docs/shared/trash.png) button next to the card.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor more info on billing matters, please see the articles below:\r\n\r\n\r\n\r\n[Call Pricing](https://lineblocs.com/resources/billing-and-pricing/call-pricing)\r\n\r\n\r\n\r\n[Monthly Invoices](https://lineblocs.com/resources/billing-and-pricing/monthly-invoices)','managing-billing-cards'),(13,'2023-03-03 04:21:50','2023-03-27 22:05:41','Learn about trial balance','','learn how does the lineblocs trial work and what are the limits.','',7,'trial info, trial balance, lineblocs',1,'# Trial Balance\r\n\r\n\r\n\r\nLineblocs currently offers trial memberships to all new users. In this guide, we will go over trial account restrictions and how to upgrade from a trial account.\r\n\r\n\r\n\r\n## Restrictions\r\n\r\n\r\n\r\nAt this time, we enforce restrictions on all Lineblocs trial accounts – these restrictions apply to any account regardless of the Lineblocs membership.\r\n\r\n\r\n\r\nTrial Account Restrictions:\r\n\r\n\r\n\r\n1. 1 Local Number only\r\n\r\n2. Max 3 minutes of outbound/inbound call time\r\n\r\n3. Up to 32MB recording space\r\n\r\n\r\n\r\n## Upgrading\r\n\r\n\r\n\r\nYou can upgrade your account to a non-trial account. Please note that depending on the type of account you are registered under (Pay as you go or dedicated), the steps may vary.\r\n\r\n\r\n\r\n#### Dedicated Membership\r\n\r\n\r\n\r\nTo upgrade your account to a dedicated membership, please add a valid billing method.\r\n\r\n\r\n\r\n#### Pay as you go\r\n\r\n\r\n\r\nIf you wish to use pay-as-you-go plan, you will need to add a valid billing method and an amount of credit. \r\n\r\n\r\n\r\nTo learn how to add credit please view [Add Credit](https:///lineblocs.com/resources/billing-and-pricing/add-credit)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to view:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','learn-trial'),(14,'2023-03-03 04:24:46','2023-03-27 22:05:47','Account Settings','','how to update your account\'s settings','',7,'account settings, edit password, edit email, lineblocs',1,'# Managing Account Settings\r\n\r\n\r\n\r\nYou can update your Lineblocs account settings at any time. This includes updating your organization\'s email, password, and personal contact details.\r\n\r\n\r\n\r\n## View Account settings\r\n\r\n\r\n\r\nTo view your account settings on the Lineblocs dashboard, please click the ![User](/img/frontend/docs/shared/user.png) icon then click [Settings](https://lineblocs.com/#/dashboard/settings)\r\n\r\n\r\n\r\n#### Update Password\r\n\r\n\r\n\r\nTo update your password please click the \"Password\" tab.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Managing IP Whitelist](https://lineblocs.com/resources/other-topics/managing-ip-whitelist)','account-settings'),(15,'2023-03-03 04:25:46','2023-03-27 22:05:55','Usage Limits (Pay-as-you-go only)','','all about the Lineblocs plans and their usage limits / constraints','',7,'limits, plans, resource limits, usage triggers, usage limits, lineblocs',1,'# Usage Limits (Pay-as-you-go)\r\n\r\n\r\n\r\nUsage limits define how many calls you can make, how many numbers you can purchase, and the amount of recording space you can use per month. In this guide, we go over the usage limits, which apply only to the Pay as you go membership plan.\r\n\r\n\r\n\r\n## Limits overview\r\n\r\n\r\n\r\nCalls Per Month: 1024\r\n\r\n\r\n\r\nExtensions: 5\r\n\r\n\r\n\r\nRecording Space: 24GB\r\n\r\n\r\n\r\nNumbers: 10\r\n\r\n\r\n\r\n## Viewing Usage History\r\n\r\n\r\n\r\nTo view your current usage history:\r\n\r\n\r\n\r\n1. On Lineblocs Dashboard [Lineblocs Dashboard](https://app.lineblocs.com/#/dashboard/home)\r\n\r\n2. In the left menu, click \"Billing\"\r\n\r\n3. Click tab \"Usage Limits\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Setup Usage Triggers](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','usage-limits'),(16,'2023-03-03 04:26:44','2023-03-27 22:06:05','Setup Usage Triggers','','how to setup usage triggers','',7,'usage, triggers, usage triggers, resource limits, lineblocs',1,'# Setup Usage Triggers\r\n\r\n\r\n\r\nUsage triggers are a very convenient way to monitor the activity associated with your Lineblocs account. \r\n\r\n\r\n\r\nCurrently, usage triggers can be set up on Lineblocs to alert you whenever you reach a set threshold in terms of billing.\r\n\r\n\r\n\r\nIn this guide, we will discuss how to set up a usage trigger on Lineblocs.\r\n\r\n\r\n\r\n## Create Usage Triggers\r\n\r\n\r\n\r\nTo set up a usage trigger:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard, go to the [Billing Page](https://app.lineblocs.com/#/dashboard/billing)\r\n\r\n2. Click tab \"Limits\"\r\n\r\n3. Under Usage Triggers click \"Create New\"\r\n\r\n4. Select a type of usage trigger\r\n\r\n5. Set the usage trigger percentage \r\n\r\n7. Click \"Submit\"\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','setup-usage-triggers'),(17,'2023-03-03 04:33:17','2023-03-27 22:06:14','Reporting Call Spam','','learn how to file a spam report on lineblocs','',7,'call spam, unwanted calls, lineblocs',1,'# Reporting Call Spam\r\n\r\n\r\n\r\nLineblocs tries to prevent call spam internally, using an array of methods. However, call spam is still possible and a profound threat to any cloud-related calling service.\r\n\r\n\r\n\r\n## Reporting Calls\r\n\r\n\r\n\r\nTo report spam-related calls, please reach out to us using our [Contact Us](https://lineblocs.com/contact) page.\r\n\r\n\r\n\r\nPlease be sure to provide us the following details:\r\n\r\n\r\n\r\n1. The number that is spamming you\r\n\r\n2. Your number\r\n\r\n3. Your full name\r\n\r\n4. The day and time you have received unwanted calls\r\n\r\n\r\n\r\n### Report Review\r\n\r\n\r\n\r\nOnce you submit your request, our support team will reach out to you in 24-48 hours.\r\n\r\n\r\n\r\nIf we find out this is a case of call spam, we will take immediate action to penalize the user that has been responsible for the call spamming.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','report-spam'),(18,'2023-03-03 04:34:12','2023-03-27 22:06:24','Adding Workspace Users','','how to add workspace users to your lineblocs account','',7,'workspace, users, add user, lineblocs, account settings',1,'# Adding Workspace Users\r\n\r\n\r\n\r\nLineblocs lets you add new team members to your account on demand. You can create new members in your workspace, as well as give them roles to perform actions in your workspace, such as adding extensions, registering DIDs, or creating new call flows. \r\n\r\n\r\n\r\n## Add Workspace Member\r\n\r\n\r\n\r\nTo add a new workspace member to your Lineblocs account:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, go to  [Settings -> Workspace Users](https://app.lineblocs.com/#/dashboard/settings/workspace-users)\r\n\r\n2. Click \"Add User\"\r\n\r\n3. Enter user details such as email and contact info\r\n\r\n4. Assign user roles\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\nOnce you have created a new user, the user will receive an invite email that includes a registration link.\r\n\r\n\r\n\r\n> Note: All new invitations expire after 7 days.\r\n\r\n\r\n\r\n## Editing Workspace Users\r\n\r\n\r\n\r\nTo edit a user please click the ![Edit](/img/frontend/docs/shared/edit.png) button next to your user.\r\n\r\n\r\n\r\n## Resend Email Invite\r\n\r\n\r\n\r\nTo resend an email invitation you can click the ![Resend Invite](/img/frontend/docs/workspace-users/reinvite.png) button next to your user.\r\n\r\n\r\n\r\n## Remove from workspace\r\n\r\n\r\n\r\nIf you want to remove a user from your workspace please click the ![Trash](/img/frontend/docs/shared/trash.png) button next to your user.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to view:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','adding-workspace-users'),(19,'2023-03-03 04:35:04','2023-03-27 22:06:32','Managing IP Whitelist','','how to add the IPs that can access your lineblocs PBX','',7,'managing, ip whitelist, whitelist, ip, manage, lineblocs',1,'# Managing IP Whitelist\r\n\r\n\r\n\r\nIP whitelists in Lineblocs allow you to control which IPs are allowed to access your SIP extensions.\r\n\r\n\r\n\r\nYou can use IP whitelists to block any unwanted users from trying to access your extensions.\r\n\r\n\r\n\r\n## Enabling IP Whitelist\r\n\r\n\r\n\r\nBy default, the IP Whitelists are disabled. \r\n\r\n\r\n\r\nTo enable the IP Whitelist:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard, go to [Settings -> IP Whitelist](https://app.lineblocs.com/#/settings-ip-whitelist)\r\n\r\n2. Click     ![Enable Whitelist](/img/frontend/docs/ip-whitelists/enable-whitelist.png)\r\n\r\n\r\n\r\n## Adding an IP to the Whitelist\r\n\r\n\r\n\r\nTo add an IP to the whitelist:\r\n\r\n\r\n\r\n1. Click     ![Add IP](/img/frontend/docs/ip-whitelists/add-ip.png)\r\n\r\n2. Set the IP and subnet mask\r\n\r\n4. click \"Submit\"\r\n\r\n\r\n\r\n## Remove an IP\r\n\r\n\r\n\r\nTo remove an IP from the whitelist please click the ![Trash](/img/frontend/docs/shared/trash.png) icon next to the IP then confirm deleting the IP.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, please see the following:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)\r\n\r\n','managing-ip-whitelist'),(20,'2023-03-03 04:35:55','2023-03-27 22:06:39','Blocking a number','','how to block and manage blocked numbers on lineblocs','',7,'blocking, number, blocking numbers, lineblocs',1,'# Managing Blocked Numbers\r\n\r\n\r\n\r\nBlocking numbers is a simple and beneficial way to prevent call spam.\r\n\r\n\r\n\r\nAt any time, you can block a number in Lineblocs.\r\n\r\n\r\n\r\n## Block A Number\r\n\r\n\r\n\r\nTo block a number on Lineblocs:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard go to  [Settings -> Blocked Numbers](https://app.lineblocs.com/#/dashboard/settings/workspace-users)\r\n\r\n2. Click \"Block Number\"\r\n\r\n3. Enter the number you would like to block\r\n\r\n4. Click \"Submit\"\r\n\r\n\r\n\r\n## Removing Blocked Number\r\n\r\n\r\n\r\nTo remove a blocked number please click ![Trash](/img/frontend/docs/shared/trash.png) icon next to the number,\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles please see the following:\r\n\r\n\r\n\r\n[Managing IP Whitelist](https://lineblocs.com/resources/other-topics/managing-ip-whitelist)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)\r\n\r\n','blocking-a-number'),(21,'2023-03-03 04:36:42','2023-03-27 22:06:47','Create Extension Codes','','how to manage and create extension codes on lineblocs','',7,'extension, codes, lineblocs, create, pbx',1,'# Extension Codes\r\n\r\n\r\n\r\nAt a high level, extension codes let you customize the functionality of your phone system. You can use extension codes to add new functionality to your call flows such as cold transfers and voicemail or add complex features such as intercom, custom IVRs, and more.\r\n\r\n\r\n\r\nBy default, extension codes in Lineblocs can be customized using the Lineblocs flow editor. You can also create as many extension codes as you need and assign them to custom workflows using Lineblocs flows.\r\n\r\n\r\n\r\n## Viewing Extension Codes\r\n\r\n\r\n\r\nTo view the extension codes you have setup on your account, please go to [Settings -> Extension Codes](https://app.lineblocs.com/#/settings/extension-codes)\r\n\r\n\r\n\r\n## Adding an Extension Code\r\n\r\n\r\n\r\nTo add a new extension code please click the ![Add Code](/img/frontend/docs/extension-codes/add-code.png) button.\r\n\r\n\r\n\r\nYou will need to give your extension code a name, code and flow. For example:\r\n\r\n\r\n\r\n```\r\n\r\nName: Check Voicemail\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCode: *97\r\n\r\n```\r\n\r\n\r\n\r\nOnce you have added the extension code, please click \"Save.\"\r\n\r\n\r\n\r\n## Removing Extension Code\r\n\r\n\r\n\r\nTo remove an extension code click the ![Remove](/img/frontend/docs/shared/remove.png) button next to the extension code then click save.\r\n\r\n\r\n\r\n## Testing extension codes\r\n\r\n\r\n\r\nTo test an extension code, please login to your extension then dial the extension code.\r\n\r\n\r\n\r\n### Troubleshooting\r\n\r\n\r\n\r\nYou can troubleshoot the code for an extension code by viewing the Lineblocs call monitor. To view the latest error logs generated from your extension code:\r\n\r\n\r\n\r\n1. On Lineblocs dashboard go to [Call Monitor](https://app.lineblocs.com/#/dashboard/call-monitor)\r\n\r\n2. In the \"Flow\" field select, your flow\r\n\r\n3. Type in the extension code in the \"Dialing\" field\r\n\r\n\r\n\r\nIf you need more info on debugging, please have a look at the lineblocs debugging guide. [Debugging Lineblocs flows & Calls](https://linelocs.com/resources/other-topics/debugging-lineblocs)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, be sure to check out:\r\n\r\n\r\n\r\n[Usage Limits](https://lineblocs.com/resources/other-topics/usage-limits)\r\n\r\n\r\n\r\n[Account Settings](https://lineblocs.com/resources/other-topics/account-settings)','create-extension-codes'),(22,'2023-03-03 04:37:31','2023-03-27 22:06:55','Managing Media Files','','learn how to store WAV/MP3 media files on lineblocs as well as use them in lineblocs flows','',7,'managing, media files, media, cloud, google drive, lineblocs',1,'# Managing Media Files\r\n\r\n\r\n\r\nMedia files allow you to import new audio-related content from your personal device or an external source such as Google Drive.\r\n\r\n\r\n\r\nLineblocs media files can be used to host audio files that you may need to use in your call flows for voiceovers and other speech-related prompts.\r\n\r\n\r\n\r\nIn this guide we will discuss how you can upload and manage media files using Lineblocs.\r\n\r\n\r\n\r\n## Adding a Media File\r\n\r\n\r\n\r\nTo add a new media file:\r\n\r\n\r\n\r\n1. In Lineblocs dashboard, click \"Media Files\"\r\n\r\n2. Click     ![Add File](/img/frontend/docs/mediafiles/add-file.png) \r\n\r\n3. Select \"Upload File\"\r\n\r\n\r\n\r\n## Using Media File In Lineblocs\r\n\r\n\r\n\r\nTo use a media file in your Lineblocs flow, please click the the ![Copy URL](/img/frontend/docs/mediafiles/copy-url.png) button to get its public URL.\r\n\r\n\r\n\r\nYou can then use that URL in the Lineblocs editor.\r\n\r\n\r\n\r\n## Removing a file\r\n\r\n\r\n\r\nTo remove a media file, please click the ![Trash](/img/frontend/docs/shared/trash.png) icon next to the media file.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nFor related articles, please see the following:\r\n\r\n\r\n\r\n[Blocking A Number](https://lineblocs.com/resources/other-topics/blocking-a-number)\r\n\r\n\r\n\r\n[Create Extension Codes](https://lineblocs.com/resources/other-topics/create-extension-codes)\r\n\r\n','managing-mediafiles'),(23,'2023-03-03 04:38:27','2023-03-27 22:07:06','Debugging config deployment','','learn how to troubleshoot any issues with your Lineblocs configurations','',7,'config, lineblocs, debug',1,'# Debugging configs','debugging-config-deploy'),(24,'2023-03-03 04:39:08','2023-03-27 22:07:14','Extension security','','How to secure your Lineblocs extensions','',7,'lineblocs, extension, security',1,'# Extension Security\r\n\r\n\r\n\r\nComing soon..','extension-security'),(25,'2023-03-05 10:07:10','2023-03-27 22:07:41','Installing on CentOS 8','','learn how to install and setup lineblocs on centos','',8,'install, linux, centos 8, centos, lineblocs, pbx, asterisk, apache',1,'# CentOS install\r\n\r\n\r\n\r\n![lineblocs](/img/frontend/docs/install-centos8/CentOS-logo-vector-01.png)\r\n\r\n\r\n\r\nlineblocs open source is a free and fully featured cloud PBX supporting all the functionality of the lineblocs cloud version in addition to having a configuration suitable for those who prefer to run a PBX on their own servers.\r\n\r\n\r\n\r\nin this tutorial will be going over how to install lineblocs and its minimum requirements on a base CentOS 8 image. we will be going over the installation of asterisk and apache as well as how to configure the lineblocs web app and backend tools.\r\n\r\n\r\n\r\nby the end of this tutorial you should have a working lineblocs instance running as a linux service.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nyou will need to first update the centos 8 package manager (yum), install development tools and also disable SELinux. depending on how you installed centos this may or may not have already been done already. \r\n\r\n\r\n\r\nto update the package manager and disable SELinux please use the following steps below:\r\n\r\n\r\n\r\n1. update yum\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum -y update\r\n\r\n    ```\r\n\r\n\r\n\r\n2. install development tools\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum group install \"Development Tools\"\r\n\r\n    ```\r\n\r\n\r\n\r\n## disabling SELinux\r\n\r\n\r\n\r\n1. run command\r\n\r\n\r\n\r\n```\r\n\r\ncat /etc/selinux/config\r\n\r\n```\r\n\r\n\r\n\r\nif you don\'t see \"SELINUX=disabled\" please run the following command\r\n\r\n\r\n\r\n```\r\n\r\nsed -i \'s/SELINUX=.*/SELINUX=disabled/\' /etc/selinux/config\r\n\r\n```\r\n\r\n\r\n\r\nfollowed by a system reboot\r\n\r\n\r\n\r\n```\r\n\r\nreboot\r\n\r\n```\r\n\r\n\r\n\r\n## installing Lineblocs\r\n\r\n\r\n\r\nbelow we will go over how to install the base dependencies for lineblocs and then how you can run the lineblocs web installer to setup the database and configure lineblocs to work with apache and asterisk.\r\n\r\n\r\n\r\nlineblocs requires some dependencies to work. you will need to at the least install Apache 2.4, PHP 7 as well as Asterisk 16 and its dependencies. we will be installing and configuring Apache and PHP first followed by installing the base of asterisk and then setting up the networking and folder privileges required to make lineblocs run correctly.\r\n\r\n\r\n\r\nto install Apache and PHP you please use the following commands:\r\n\r\n\r\n\r\n1. install Apache HTTPD\r\n\r\n\r\n\r\n    ```\r\n\r\n    yum install httpd\r\n\r\n    ```\r\n\r\n2. install PHP 7\r\n\r\n\r\n\r\n    we will be using the remi CentOS repo so we can install the recommended version of PHP (7.3) on our linux instance. To install PHP 7.3 on the CentOS please use the following steps:\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y update\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo yum -y install http://rpms.remirepo.net/enterprise/remi-release-8.rpm\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf -y install dnf-plugins-core\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf config-manager --set-enabled remi-php73\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf config-manager --set-enabled remi\r\n\r\n    ```\r\n\r\n    \r\n\r\n    ```\r\n\r\nsudo dnf module install php:remi-7.3\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\nsudo dnf update\r\n\r\n    ```\r\n\r\n3. download and unzip lineblocs code in \"/var/www/html\"\r\n\r\n\r\n\r\n    ```\r\n\r\n    cd /var/www/html\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    wget http://get.lineblocs.com/lineblocs-0.0.1.zip\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    unzip lineblocs-0.0.1.zip\r\n\r\n    ```\r\n\r\n4. installing lineblocs base\r\n\r\n\r\n\r\n    ```\r\n\r\n    cd lineblocs\r\n\r\n    ```\r\n\r\n\r\n\r\n    ```\r\n\r\n    ./install_base.sh\r\n\r\n    ```\r\n\r\n\r\n\r\n# configuring MySQL\r\n\r\n\r\n\r\nduring the base installation you will need to setup MySQL. please make sure you leave the password blank and remove all remote logins, as well as reload all privilege tables.\r\n\r\n\r\n\r\n```\r\n\r\nEnter current password for root (enter for none):\r\n\r\n```\r\n\r\n\r\n\r\ndo not enter anything here\r\n\r\n\r\n\r\n```\r\n\r\nChange the root password? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"n\" to this\r\n\r\n\r\n\r\n```\r\n\r\nRemove anonymous users? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nDisallow root login remotely? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nRemove test database and access to it? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\n```\r\n\r\nReload privilege tables now? [Y/n]\r\n\r\n```\r\n\r\n\r\n\r\npress \"Y\" here\r\n\r\n\r\n\r\nonce the mariadb installation completes you will see some other dependencies being installed. be sure to let the installer run and install all the other dependencies. the asterisk configuration and installation should take 3-5 minutes to complete.\r\n\r\n\r\n\r\nthe installer will show the asterisk menuselect options once asterisk has been successfully configured. please select the default settings here and then use \"Save & Exit\".\r\n\r\n\r\n\r\n![asterisk](/img/frontend/docs/install-centos8/asterisk-menuselect.png)\r\n\r\n\r\n\r\nyou should then see asterisk continuing to build for some time followed by the installation script changing the folder permissions and networking setup according to lineblocs requirements.\r\n\r\n\r\n\r\nonce all of this is completed you should get a confirmation that the lineblocs base installation was completed successfully.\r\n\r\n\r\n\r\nyou can then continue to install lineblocs using the web installer.\r\n\r\n\r\n\r\n## Running the web Installer\r\n\r\n\r\n\r\nthe lineblocs web installer includes a set of steps that help you configure the database, and asterisk for usage with lineblocs. when you downloaded the lineblocs code the installer was also downloaded. to run the web installer please use the following command:\r\n\r\n\r\n\r\n```\r\n\r\n./start_web_installer.sh\r\n\r\n```\r\n\r\n\r\n\r\nyou will be then given an address to use in your browser. please go to the URL in your browser to complete the web installation.\r\n\r\n\r\n\r\n![step-1](/img/frontend/docs/install-centos8/step-1.png)\r\n\r\n\r\n\r\n### step 1 - requirements check\r\n\r\nlineblocs installer will try to check if the requirements for lineblocs are met. you should have a screen as shown below. all the requirements will need to match in order for lineblocs to be installed correctly. \r\n\r\n\r\n\r\n![step-2](/img/frontend/docs/install-centos8/step-2.png)\r\n\r\n\r\n\r\nif the requirements look ok please click \"Start Installation\"\r\n\r\n\r\n\r\n### step 2 - database configuration\r\n\r\nyou will need to setup a database for lineblocs to work correctly. at this point in the tutorial we have already installed mariadb server as well as have setup the root account with no password. you can use the root account to create a new database called \"lineblocs\" with a username/password of your choice. the new database user will be assigned to the lineblocs database and also used in the lineblocs backend.\r\n\r\n\r\n\r\nbelow is an example of how you might want to setup the database.\r\n\r\n![step-3](/img/frontend/docs/install-centos8/step-3.png)\r\n\r\n\r\n\r\n#### root account configuration\r\n\r\nthis sets up the main admin account you will use to login to the Lineblocs portal. this is also the main account or the \"super\" admin account that is given all permissions in the system.\r\n\r\n![step-4](/img/frontend/docs/install-centos8/step-4.png)\r\n\r\n\r\n\r\n### step 5 - Config Setup\r\n\r\nsome steps will be required to update the asterisk and Apache config to work with laravel. please follow steps below to complete Asterisk/Apache setup.\r\n\r\n![step-5](/img/frontend/docs/install-centos8/step-5.png)\r\n\r\n\r\n\r\n### step 6 - install as linux service\r\n\r\nin order to run the lineblocs backend you will need to install lineblocs as a linux service. please continue to follow steps as they are mentioned.\r\n\r\n![step-6](/img/frontend/docs/install-centos8/step-6.png)\r\n\r\n\r\n\r\nonce you have done this lineblocs should be installed and enabled as a systemd process. \r\n\r\n\r\n\r\nif you are having issues you you can verify lineblocs is running on the linux instance by using the command below:\r\n\r\n\r\n\r\n```\r\n\r\nps aux | grep \'lineblocs\'\r\n\r\n```\r\n\r\n\r\n\r\nyou should see output similar to the following:\r\n\r\n\r\n\r\n```\r\n\r\nroot     18665  0.0  5.4 1051036 46128 ?       Ssl  06:45   0:00 /usr/sbin/lineblocs\r\n\r\n```\r\n\r\n\r\n\r\nif you don\'t see this output you can check the combined.log and error.log of lineblocs in \"/var/log/lineblocs\"\r\n\r\n\r\n\r\n```\r\n\r\ncat /var/log/lineblocs/error.log\r\n\r\n```\r\n\r\n\r\n\r\nthis file should include any helpful info into debugging the problem.\r\n\r\n\r\n\r\nyou can also re-run the web installer by using the shell script included in the lineblocs distribution ```prune_installer_data.sh``` followed by running ```start_web_installer.sh``` again\r\n\r\n\r\n\r\n```\r\n\r\n./prune_installer_data.sh\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\n./start_web_installer.sh\r\n\r\n```\r\n\r\n\r\n\r\n### step 7 - completing installation\r\n\r\nonce the installation and configuration is done you should be shown a message as seen below.\r\n\r\n![step-7](/img/frontend/docs/install-centos8/step-8.png)\r\n\r\n\r\n\r\n## logging in the first time\r\n\r\nbe sure to follow the login link given in step 7 to login to lineblocs. you will need to use the account login you setup as the super admin to login.\r\n\r\n![step-7](/img/frontend/docs/install-centos8/logging-in.png)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nthis tutorial went over how to install lineblocs open source edition. for related articles be sure to check out the following.\r\n\r\n\r\n\r\n[Creating Trunks](https://lineblocs.com/resources/open-source/creating-trunks)\r\n\r\n\r\n\r\n[Working with routes](https://lineblocs.com/resources/open-source/working-with-routes)\r\n\r\n\r\n\r\n[Setup Open Source Extension](https://lineblocs.com/resources/open-source/setup-extension)','install-centos8'),(26,'2023-03-05 10:17:47','2023-03-27 22:07:48','Creating Trunks','','how to setup and manage SIP trunks in lineblocs','',8,'trunks, setup trunk, SIP, asterisk, open source, lineblocs',1,'# Coming Soon','creating-trunks'),(27,'2023-03-05 10:18:30','2023-03-27 22:07:56','Working With Routes','','how to create and manage routes in lineblocs open source','',8,'routes, manage routes, SIP, asterisk, open source, lineblocs',1,'# Coming Soon','working-with-routes'),(28,'2023-03-05 11:07:46','2023-03-27 22:08:04','Setup Extension','','how to setup extensions using open source lineblocs edition','',8,'extensions, setup, lineblocs, open source',1,'# Coming Soon','setup-extension'),(29,'2023-03-08 06:03:34','2023-03-27 22:37:19','Create a call forwarding','','learn how to create a simple call forward flow.','',3,'call forward, PBX, lineblocs, drag and drop',1,'# Call Forwarding\r\n\r\n\r\n\r\nLineblocs editors allow you to create call flows for basic and advanced call forwarding needs.\r\n\r\n\r\n\r\nThis guide will show you how to forward a call to a external phone number using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to start forwarding calls using lineblocs:\r\n\r\n\r\n\r\n1. a DID Number\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n## Creating call forward\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Call Forward\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Edit call forwarding number\r\n\r\n\r\n\r\nTo change the number you want to forward to please click the \"ForwardBridge\" then update the \"Number To Call\" option.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/forward/forward-opts.png)\r\n\r\n\r\n\r\n## Change Caller ID\r\n\r\n\r\n\r\nBy default the caller ID will show the caller\'s caller ID. If you want to use a custom caller ID instead you can change the \"Caller ID\" option.\r\n\r\n\r\n\r\n![Caller ID](/img/frontend/docs/forward/caller-id.png)\r\n\r\n\r\n\r\n## Record Forwarded Calls\r\n\r\n\r\n\r\nTo record your forwarded calls please check the \"Do Record\" option.\r\n\r\n\r\n\r\n![do record](/img/frontend/docs/pinless-conference/do-record.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour calls should be now forwarded to the number you specified along with the Caller ID you set.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we discussed setting up a simple call forward. for more advanced configurations please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','call-forward'),(30,'2023-03-08 06:04:23','2023-03-27 22:01:59','Setup a basic 3 option IVR','','get more in depth and learn how to create IVRs','',3,'IVR setup, drag and drop, PBX',1,'# Basic IVR\r\n\r\n\r\n\r\nIVRs are very simple to the provision in Lineblocs. This guide will go over how to create a simple three-option IVR that allows your callers to choose which department they wish to route their call to.\r\n\r\n\r\n\r\n## Requirements\r\n\r\nYou will need the following items to begin creating IVRs:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. Lineblocs account\r\n\r\n3. A non trial membership\r\n\r\n\r\n\r\n## Creating an IVR\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. use template \"Simple IVR\"\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Editing the IVR auto attendant\r\n\r\n\r\n\r\nBy default, the Basic IVR template is configured with an auto-attendant, using the default settings. You may want to customize the auto attendant options based on your needs.\r\n\r\n\r\n\r\nTo update your IVR\'s auto attendant, please click the \"ProcessInput\" widget to bring up its sidebar options.\r\n\r\n\r\n\r\nIn the settings, you have the option to playback text-to-speech or a media file. You can also adjust settings like the maximum digits to gather or the terminating digit. \r\n\r\n\r\n\r\nIf you need more info on any of these settings, you can hover over the info icon to the right of the field.\r\n\r\n\r\n\r\n![process input](/img/frontend/docs/basic-ivr/process-input.png)\r\n\r\n\r\n\r\n## Routing to departments\r\n\r\n\r\n\r\nThe Basic IVR template is set up to route to 3 bridges based on user input. Option 1 routing to Support, 2 routes to Sales, and 3 will route to an operator. \r\n\r\n\r\n\r\nIf you want to change the default setup, you can update the \"Links\" tab in your \"Switch\" cell. To open the \"Links\" settings, please click the \"Switch\" cell then, click the \"Links\" tab.\r\n\r\n\r\n\r\n## Editing the call bridges\r\n\r\n\r\n\r\nIn the Basic IVR example, we have set up 3 bridge widgets \"SupportBridge,\" \"SalesBridge,\" and \"OperatorBridge.\" Each of these widgets forward to its extension.\r\n\r\n\r\n\r\nTo edit the extension these widgets forward to, please click the widget you want to update, then change the \"Extension To Call\" option.\r\n\r\n\r\n\r\n![process input](/img/frontend/docs/basic-ivr/ext-to-call.png)\r\n\r\n\r\n\r\nYour flow should now look similar to the following image:\r\n\r\n![Basic IVR example](/img/frontend/docs/basic-ivr/main.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use the IVR on one of your DIDs:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYou should now be able to hear your IVR in action! When you call your DID number, your calls should be answered by your auto-attendant greeting as well as a route to your departments.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we went over how to set up an IVR. For other related guides, be sure to view the following:\r\n\r\n\r\n\r\n[Recordings and Voicemail](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','basic-ivr'),(31,'2023-03-08 06:05:26','2023-03-27 22:13:43','Integrate Recordings','','stay in touch with your callers by adding voicemail','',3,'voicemail, recordings, manage recordings, lineblocs',1,'# Recordings And Voicemail\r\n\r\n\r\n\r\nRecording voicemail is a simple yet beneficial component of a phone system. \r\n\r\n\r\n\r\nThis guide will go over how to create a workflow that allows your callers to record voicemail messages when you are unavailable and play them when you are available. \r\n\r\n\r\n\r\n\r\n\r\n## Creating a voicemail flow\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Use template \"Voicemail Example\"\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup forwarding\r\n\r\n\r\n\r\nThe sample \"Voicemail Example\" flow is set up to forward to an extension, and based on the receiving side; the call not being answered will redirect it to voicemail.\r\n\r\n\r\n\r\nFor the voicemail recorder to work, you will need to set up the \"ForwardBridge,\" which will let you set the extension to forward to before routing to voicemail. \r\n\r\n\r\n\r\nTo edit your forwarding options, please click the \"ForwardBridge\" widget, then edit the \"Extension To Call\" field.\r\n\r\n\r\n\r\n![Basic IVR example](/img/frontend/docs/voicemail/ext-to-call.png)\r\n\r\n\r\n\r\n## Setup recording options\r\n\r\n\r\n\r\nMost voicemail recorders begin with a prompt and allow the caller to record a message until the caller either presses a terminating key, hangs up, or a noticeable silence condition is met. \r\n\r\n\r\n\r\nTo modify the options for your recording, please click the \"RecordingVoicemail\" cell.\r\n\r\n\r\n\r\n![record options](/img/frontend/docs/voicemail/record-options.png)\r\n\r\n\r\n\r\n## Setup voicemail on a DID\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use the voicemail flow on a DID number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n\r\n\r\n## Viewing Recordings\r\n\r\n\r\n\r\nYou can view a history of voicemail in your dashboard at any time. You can also sort or filter voicemails received in the past, as well as download the MP3 files. \r\n\r\n\r\n\r\nTo view a history of your voicemail recordings, please go to the [Recordings Page](https://app.lineblocs.com/#/recordings).\r\n\r\n\r\n\r\n## Deleting Recordings\r\n\r\n\r\n\r\nTo delete recordings, please click the \"Delete\" button next to the voicemail item in [Recordings Page](https://app.lineblocs.com/#/recordings).\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nThis guide went over recordings and voicemail. For related guides be sure to view the following:\r\n\r\n\r\n\r\n[Call Forward](https://lineblocs.com/resources/quickstarts/call-forward)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','recordings-and-voicemail'),(32,'2023-03-08 06:06:24','2023-03-27 22:02:17','Setup Call Queues','','create call queues to better manage your incoming call flow.','',3,'calls, queues, queue, incoming, lineblocs',1,'# Call Queues\r\n\r\n\r\n\r\nCall queues can allow you receive multiple calls simultaneously. A well-designed call queue can also provide a smooth experience for a long wait time for a call.\r\n\r\n\r\n\r\nIn this guide, we will be creating a primary call queue using the Lineblocs flow editor. The call queue will be assigned to all our extensions and set up with basic options. \r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard), click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select the \"Queue Example\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n\r\n\r\n## Add Extensions\r\n\r\n\r\n\r\nBy default, the call queue will be set up with no extensions. You can add extensions to your queue by adjusting the Queue\'s widget options.\r\n\r\n\r\n\r\nTo update the widget extensions settings for your queue, please click the \"SupportQueue\" to open its options, then select the extensions you would like to include in the \"Select Extensions\" field.\r\n\r\n\r\n\r\n![Call Queues example](/img/frontend/docs/call-queue/extension-select.png)\r\n\r\n\r\n\r\n## Max Queue Wait Time\r\n\r\n\r\n\r\nMaximum queue wait time allows you to adjust how long a caller can wait in the call queue before either terminating the call or going to an alternate destination.\r\n\r\n\r\n\r\nBy default, the maximum queue wait time is set to 60 seconds.\r\n\r\n\r\n\r\nTo change the maximum wait time for the queue, please update the \"Max Wait Time\" option.\r\n\r\n\r\n\r\n![Queue Max Timeout](/img/frontend/docs/call-queue/queue-max-wait.png)\r\n\r\n\r\n\r\n## Max Extension Timeout\r\n\r\n\r\n\r\nTo update how long you want to ring an agent\'s phone, you can update the \"Max Extension Timeout\" option.\r\n\r\n\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/call-queue/queue-max-ext-timeout.png)\r\n\r\n\r\n\r\n## Music On Hold\r\n\r\n\r\n\r\nBy default, all call queues will play music on hold while the caller waits for an agent to answer the call. \r\n\r\n\r\n\r\nMusic On Hold will be played recurringly -- until the caller hangs up, an agent picks up a call, or the maximum queue wait time elapses.\r\n\r\n\r\n\r\nYou can customize the music you play in your queue updating, the \"Music On Hold URL\" setting in the widget settings box. \r\n\r\n\r\n\r\n## End Result\r\n\r\n\r\n\r\nAfter you have made your changes, your flow should now look similar to the following image:\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/call-queue/main.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour callers should now be placed in a queue with music on hold when they call your number. And your extensions will receive calls from the queue in the order they came in.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up call queues on Lineblocs. for other related quickstart posts, be sure to view the following:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','call-queues'),(33,'2023-03-08 06:07:31','2023-03-27 22:02:27','Setup a Pin Conference','','create a basic pin conference using lineblocs','',3,'calls, pin, conferencing, conference, lineblocs',1,'# Create A Pinned Conference\r\n\r\n\r\n\r\n![Queue Max Ext Timeout](/img/frontend/docs/pinned-conference/pinned-conference.png)\r\n\r\n\r\n\r\nPinned conferences allow you to create discussion rooms you and your team can access on demand.\r\n\r\nA basic pin conference usually includes an assigned number and a set of access pins your team members can use to access the conferencing room.\r\n\r\n\r\n\r\nIn Lineblocs you can fully create basic and advanced pinned conferences as well as customize conferencing workflows as per your needs. \r\n\r\n\r\n\r\nIn this tutorial we will go over how to create a basic pin based conference using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Pin Conference\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Add Pin Numbers\r\n\r\n\r\n\r\nBy default, the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 participants maximum on the call at any given time.\r\n\r\n\r\n\r\nTo update settings for your conference please open the “PinConference” widget.\r\n\r\n\r\n\r\n![Pin Access](/img/frontend/docs/pinned-conference/pin-access.png)\r\n\r\n\r\n\r\n![Pin Access 2](/img/frontend/docs/pinned-conference/pin-access-2.png)\r\n\r\n\r\n\r\n## Conference Settings\r\n\r\n\r\n\r\nBy default the pinned conference will wait for a moderator to join, end when the moderator leaves as well as only allow up to 10 max participants on the call at any given time.\r\n\r\n\r\n\r\nTo update settings for your conference please open the PinConference widget.\r\n\r\n\r\n\r\n![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)\r\n\r\n\r\n\r\n#### Moderator Access\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/moderator.png)\r\n\r\n\r\n\r\n#### Notifications\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-1.png)\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-2.png)\r\n\r\n\r\n\r\n#### Speech Detection\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/speech.png)\r\n\r\n\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour team members should now be able to join conference calls using your DID number. To test your conference as a moderator or a user you can call the DID number you setup the conference flow on.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nin this guide we discussed setting up pin-based conference. for other related quickstart posts please see guides below:\r\n\r\n\r\n\r\n[Call Queues](https://lineblocs.com/resources/quickstarts/call-queues)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','pin-conference'),(34,'2023-03-08 06:09:00','2023-03-27 22:02:36','Create a Pinless Conference','','create a basic pinless conference using lineblocs','',3,'calls, pinless, conferencing, conference, linebloc',1,'# Create A Pinless Conference\r\n\r\n\r\n\r\n![Pinless Conference](/img/frontend/docs/pinless-conference/main.png)\r\n\r\n\r\n\r\nPinless conferences allow you to create discussion rooms you and your team can access on demand.\r\n\r\nA basic pinless conference usually includes a dial-in phone number and a set of assigned attendee numbers.\r\n\r\n\r\n\r\nIn Lineblocs you can entirely create basic and advanced pinless conferences as well as customize pinless conferencing workflows as per your needs\r\n\r\n\r\n\r\nThis tutorial will go over how to create a basic pinless conference using the Lineblocs flow editor.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select the \"Pin Conference\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup Attendees\r\n\r\n\r\n\r\nBy default, the conference will be set up with no attendee numbers that can call into the conference.\r\n\r\n\r\n\r\nYou can change the numbers your moderator and users will be using to join your conference by updating the access numbers used for your meeting.\r\n\r\n\r\n\r\nTo view your access numbers, please click the \"SetupAttendees\" to bring up its options.\r\n\r\n\r\n\r\n![Access Numbers](/img/frontend/docs/pinless-conference/access-numbers.png)\r\n\r\n\r\n\r\n## Conference Settings\r\n\r\n\r\n\r\nTo update settings for your conference please open the \"PinlessConference\" widget.\r\n\r\n\r\n\r\n![Conference Max](/img/frontend/docs/pinned-conference/conference-max.png)\r\n\r\n\r\n\r\n#### Moderator Access\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/moderator.png)\r\n\r\n\r\n\r\n#### Notifications\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-1.png)\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/beep-2.png)\r\n\r\n\r\n\r\n#### Speech Detection\r\n\r\n\r\n\r\n![moderator](/img/frontend/docs/pinned-conference/speech.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nto save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing\r\n\r\n\r\n\r\nYour team members should now be able to join conference calls using your DID number. To test your conference, you can call your DID number using a moderator or user caller ID.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up a pinless-based conference. For other related quickstart posts, please see guides below:\r\n\r\n\r\n\r\n[Setup Pin Conference](https://lineblocs.com/resources/quickstarts/pin-conference)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','pinless-conference'),(35,'2023-03-08 06:10:00','2023-03-27 22:02:45','Setup an extension','','learn how to provision an extension for use with a softphone or supported hard phone','',3,'extension setup, microsip, lineblocs, softphone, hardphone',1,'# Setup Extension\r\n\r\n\r\n\r\nA Lineblocs extension allows you to route calls to a softphone or hard phone.\r\n\r\n\r\n\r\nExtensions can be created and managed using the Lineblocs dashboard. You can provide new extensions on-demand, as well as update an Extension\'s default Caller ID and other settings.\r\n\r\n\r\n\r\n## Create Extension\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard click \"Create\" -> \"New Extension\"\r\n\r\n2. Enter a username for your extension\r\n\r\n3. Enter a Caller ID\r\n\r\n4. Enter a Secret\r\n\r\n5. Click \"Save\"\r\n\r\n\r\n\r\n## Connecting\r\n\r\n\r\n\r\nTo get the information to connect to your extension using a softphone or supported hard phone, please go to[Extensions](https://app.lineblocs.com/#/extensions) page, then click the info bubble ![info](/img/frontend/docs/create-extensions/info-bubble.png) next to the extension you want to connect to.\r\n\r\n\r\n\r\n![connect](/img/frontend/docs/create-extensions/connect-2.png)\r\n\r\n\r\n\r\n## Managing Extensions\r\n\r\n\r\n\r\nYou can edit or delete your extension at any time. \r\n\r\n\r\n\r\nTo edit an extension:\r\n\r\n\r\n\r\nClick the \"Edit\" button next to the extension you want to edit.\r\n\r\n\r\n\r\nTo delete an extension:\r\n\r\n\r\n\r\nPlease click the \"Delete\" button next to the Extension you want to remove.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we went over how to create and connect to extensions. For related posts, be sure to view:\r\n\r\n\r\n\r\n[Extension security best practice](https://lineblocs.com/resources/other-topics/extension-security)\r\n\r\n\r\n\r\n[Avoiding call spam](https://lineblocs.com/resources/other-topics/report-spam)','setup-extension'),(36,'2023-03-08 06:11:15','2023-03-27 22:09:37','Call Screening','','learn how to create call screenings using Lineblocs','',3,'call screening, screening, call, lineblocs, voip, call whisper, whisper',1,'# Call Screening\r\n\r\n\r\n\r\nAt a high level, call screenings allow your agents to accept calls based on various call-related details such as a Caller ID, calling department, and more. \r\n\r\n\r\n\r\nBasic call screenings can be used to avoid spam and notify agents of caller details. In more advanced cases you could use call screenings to allow your callers to record a greeting message or allow your agents to listen to a message being recorded on an answering machine.\r\n\r\n\r\n\r\nIn this guide we will setup a basic call screening that tells your agent what Caller ID an incoming call is coming from.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. a Lineblocs DID \r\n\r\n2. Extension\r\n\r\n\r\n\r\n## Creating call whisper\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Call Screening\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Edit screening extension\r\n\r\n\r\n\r\nto change the extension you want to forward call screenings to please click the \"DialAgent\" then update the \"Extension To Call\" option.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/screening/forward-opts.png)\r\n\r\n\r\n\r\n## Change screening message\r\n\r\n\r\n\r\nby default we play back a screening message that includes the Caller ID of the originating call.\r\n\r\n\r\n\r\nif you want to update the default greeting, please click the \"CallScreening\" widget then edit the \"Text To Say\" field.\r\n\r\n\r\n\r\n![Forward](/img/frontend/docs/screening/screen-opts.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nto save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYour agents should now be able to screen calls as per your workflow. To test the call flow please call your DID number.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nin this guide we discussed setting up a simple call screening. for more advanced configurations please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Cold Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)','call-screening'),(37,'2023-03-08 06:12:39','2023-03-27 22:03:01','Using macros to check for business hours','','learn how to use lineblocs macros to customize your call flows using typescript code.','',3,'lineblocs, macros, macro, business hours, hours, business',1,'# Business Hours Check using Macros\r\n\r\n\r\n\r\n![Call Queues example](/img/frontend/docs/macros/business-hours.png)\r\n\r\n\r\n\r\nLineblocs macros allow you to further customize your call flows using the TypeScript language.\r\n\r\n\r\n\r\nUsing Lineblocs macros, you can create high-level integrations that include tasks such as sending a lead to a CRM or sending out an email using an API.\r\n\r\n\r\n\r\nIn this example, we will set up a call flow that uses a macro to check for local business hours before forwarding a call to an agent.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n##  Setup Workspace\r\n\r\n\r\n\r\nWe will first bootstrap our workspace with some timezone values to later route our calls according to the correct timezone.\r\n\r\n\r\n\r\nTo access the workspace params screen; in [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Settings\" -> \"Workspace Params\"\r\n\r\n\r\n\r\nTo add a timezone workspace param, please click \"Add Param.\" In the key field, use \"timezone,\" then use any valid timezone name in the value field. For example, \"America/Toronto.\". \r\n\r\n\r\n\r\nTo see a full list of time zones, please use [this link](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones).\r\n\r\n\r\n\r\n#### Workspace Params\r\n\r\n\r\n\r\nYour workspace params screen should now look like the following image:\r\n\r\n![Workspace Params](/img/frontend/docs/macros/workspace-params.png)\r\n\r\n\r\n\r\n## Create flow\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter name \"Business Hours Check\"\r\n\r\n3. Select \"Call Forward\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Adding a Macro\r\n\r\n\r\n\r\nTo add a new macro please drag the \"Macro\" widget from the right pane into the flow graph.\r\n\r\n\r\n\r\n![Macro](/img/frontend/docs/macros/macro.png)\r\n\r\n\r\n\r\n![Macro Added](/img/frontend/docs/macros/macro-added.png)\r\n\r\n\r\n\r\n## Updating Macro\r\n\r\n\r\n\r\nTo edit your macro\'s function, please click the \"Macro\" widget, and then click![Create Function](/img/frontend/docs/macros/create-function.png) in the right pane.\r\n\r\n\r\n\r\nIn the template selection screen, choose template \"Business Hours Check,\" then click \"Save.\"\r\n\r\n\r\n\r\n## Set Macro Defaults\r\n\r\n\r\n\r\nBy default the macro will be setup to forward calls from 9AM-5PM Monday to Friday. To confirm these defaults, please click \"Save\".\r\n\r\n\r\n\r\n## Saving Macro\r\n\r\n\r\n\r\nLastly, for the macro\'s function, you will be shown a code editor screen with the Macro\'s function. \r\n\r\n\r\n\r\nPlease click \"Save\" on this screen, then give your macro a title such as \"business-hours.\"\r\n\r\n\r\n\r\n![Save Macro](/img/frontend/docs/macros/save-macro.png)\r\n\r\n\r\n\r\n## Add a Playback widget\r\n\r\n\r\n\r\nWe will need to add a playback widget to play a message when our time condition is not satisfied. \r\n\r\n\r\n\r\nTo add a playback widget for when your office is closed, please drag a \"Playback\" widget from the right pane into the flow editor.\r\n\r\n\r\n\r\nIn the Playback widget, please use the following settings:\r\n\r\n\r\n\r\n```\r\n\r\nWidget Name: ClosedMessagePlayback\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nPlayback Type: Say\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nText To Say: Our office is currently closed, please call us again from Monday to Friday 9 AM to 5 PM eastern time.\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nLanguage: en-US\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nGender: FEMALE\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nVoice: en-US-Standard-C\r\n\r\n```\r\n\r\n\r\n\r\n## Add Switch widget\r\n\r\n\r\n\r\nWe will add a \"Switch\" widget to test for our time condition and go to the correct widget. \r\n\r\n\r\n\r\nTo add a \"Switch\" widget, please drag a new \"Switch\" widget into the flow graph. Rename this widget into \"HoursSwitch,\" then change the \"Variable to test\" to Macro.result.\r\n\r\n\r\n\r\n![Select Macro](/img/frontend/docs/macros/switch-widget-options.png)\r\n\r\n\r\n\r\n## Updating Switch Links\r\n\r\n\r\n\r\nPlease go to the \"Links\" tab of the \"HoursSwitch\" widget and add the following 2 links\r\n\r\n\r\n\r\n### Link 1\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: open\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCell to link: ForwardBridge\r\n\r\n```\r\n\r\n\r\n\r\n### Link 2\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: closed\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCell to link: ClosedMessagePlayback\r\n\r\n```\r\n\r\n\r\n\r\nThe \"HoursSwitch\" link section should now look like the following:\r\n\r\n![Select Macro](/img/frontend/docs/macros/switch-links.png)\r\n\r\n\r\n\r\n## Connecting the Links\r\n\r\n\r\n\r\nNext, we will need to update the flow to use our widgets.\r\n\r\n\r\n\r\nTo make adjustments to your flow so that all of the widgets are working correctly. You will need to connect the \"Incoming Call\" port from the Launch widget into the Macro\'s \"In\" port and add a link from widget Macro\'s \"Completed\" port into the HoursSwitch\'s \"In\" port.\r\n\r\n\r\n\r\nBelow is an example of how the final flow should look like:\r\n\r\n![Select Macro](/img/frontend/docs/macros/flow-updated.png)\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the Lineblocs dashboard, please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nYou should be able to call your number and see your business hours check working. Your callers will hear a message when you are unavailable, and they will be forwarded to you during your business hours.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed setting up macros on lineblocs. For other related quickstart posts, please see the guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','business-hours-with-custom-macros'),(38,'2023-03-08 06:13:26','2023-03-27 22:03:08','Create a cold transfer','','learn how to use extension codes to make on call transfers between extensions','',3,'lineblocs, cold transfer, cold, transfer, pbx, transfers',1,'# Create A Cold Transfer\r\n\r\n\r\n\r\n![Cold Transfer](/img/frontend/docs/cold-transfer/main.jpg)\r\n\r\n\r\n\r\nLineblocs flow editor lets you programmatically create workflows for call transfers. A common type of call transfer is a cold transfer which transfers a call from one endpoint to another.\r\n\r\n\r\n\r\nCold transfers can usually be integrated into a PBX. Most widely used PBX systems can be used to transfer calls between extensions by using dialing codes or feature codes.\r\n\r\n\r\n\r\nIn this tutorial, we will walk you through the setup of a cold transfer using two extensions, one extension code, and a custom Lineblocs flow.\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nTo create a new Lineblocs flow for your cold transfer, you need to follow these steps:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select template \"Cold Transfer\" under Extension Codes\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Creating an Extension Code\r\n\r\n\r\n\r\nTo create an extension code for your cold transfers, you need to follow these steps:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Settings\" -> \"Extension Codes\"\r\n\r\n2. click \"Add Code\"\r\n\r\n3. in field \"Name\" use \"Cold Transfer\"\r\n\r\n4. in field \"Code\" use \"*72\"\r\n\r\n5. in field \"Flow\" use the \"Cold Transfer\" flow you created earlier\r\n\r\n\r\n\r\n![Extension Codes Info](/img/frontend/docs/cold-transfer/ext-codes-info.png)\r\n\r\n\r\n\r\n## Creating Extensions\r\n\r\n\r\n\r\nTo do a cold transfer between two extensions, we will need to create new extensions on our account. \r\n\r\n\r\n\r\nPlease follow steps in this post [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension) to create two new extensions.\r\n\r\n\r\n\r\nBelow is an example of how you may want to setup extension 1000 and 1001.\r\n\r\n\r\n\r\n### Extension 1000\r\n\r\n\r\n\r\n```\r\n\r\nUsername: 1000\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSecret: your-strong-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCaller ID: 1000\r\n\r\n```\r\n\r\n\r\n\r\n### Extension 1001\r\n\r\n\r\n\r\n```\r\n\r\nUsername: 1001\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSecret: your-strong-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nCaller ID: 1001\r\n\r\n```\r\n\r\n\r\n\r\n## Registering a DID\r\n\r\n\r\n\r\nThe final piece to get our flow, extension code, and inbound call routing work is registering a DID or using an existing one if you have already registered a DID.\r\n\r\n\r\n\r\nOur DID will be used by outside callers that will need to place calls and speak to extension 1000 or 1001. \r\n\r\n\r\n\r\nWe will register a DID and setup a call forward workflow so that extension 1000 can receive calls directly from our DID, and then forward them to 1001 using our newly created extension code.\r\n\r\n\r\n\r\nTo learn more about registering DIDs please refer to [Creating Extensions](https://lineblocs.com/resources/quickstarts/setup-extension)\r\n\r\n\r\n\r\nTo learn how to create a call transfer flow, please read this post: [Call Transfer](https://lineblocs.com/resources/quickstarts/create-cold-transfer)\r\n\r\n\r\n\r\n## Testing Cold Transfer\r\n\r\n\r\n\r\nYou can test the cold transfer by logging into extension \"1000\" and having a peer login to \"1001\". \r\n\r\n\r\n\r\nWhen you receive calls on your DID they should be forwarded to \"1000\" you can press *72, and you will be redirected to an auto-attendant that will ask you the extension number you want to transfer the call to. You can then dial 1001 to complete the call transfer.\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we discussed setting up cold transfers on Lineblocs. For other related quickstart posts please see guides below:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Voicemail and Recordings](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)','create-cold-transfer'),(39,'2023-03-08 06:14:57','2023-03-27 22:03:26','Saving widget templates','','learn how to save a widget as a template for later use','',3,'lineblocs, widget, template, save widget, SIP, PBX',1,'# Widget Templates\r\n\r\n\r\n\r\nLineblocs widget templates allow you to save and reuse widget settings across multiple Lineblocs flows. \r\n\r\n\r\n\r\nWidget templates can be used to avoid having to create a widget more than once as well as to tag and customize widgets based on your needs.\r\n\r\n\r\n\r\nIn this tutorial, we will go over how you can save widget templates, to reuse them across new Lineblocs flows.\r\n\r\n\r\n\r\n## Save Widget\r\n\r\n\r\n\r\nTo save a widget as a template:\r\n\r\n\r\n\r\n1. In [Lineblocs Flow Editor](https://app.lineblocs.com/#/flows/new) click a widget\r\n\r\n2. Click the     ![Save widget](/img/frontend/docs/widget-templates/save.png) button.\r\n\r\n3. Enter a widget title\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Using Widget Template\r\n\r\n\r\n\r\n1. To use the widget template, click     ![Library](/img/frontend/docs/widget-templates/library.png) tab in the widget main menu.\r\n\r\n2. Drag library widget into the flow graph                                   \r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed how you could save a widget as a template. For more related articles, please see:\r\n\r\n\r\n\r\n[Create a cold transfer](https://lineblocs.com/resources/quickstarts/setup-cold-transfers)\r\n\r\n\r\n\r\n[Setup Macro for Business Hours](https://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)','saving-widget-templates'),(40,'2023-03-08 06:15:48','2023-03-27 22:03:35','Provisioning A GXP2160','','learn how to use Lineblocs to provision Grandstream GXP21XX series phones','',3,'lineblocs, grandstream, gxp21xx, gxp2160, GXP, pbx, cloud, sip',1,'# Provision Grandstream GXP2160\r\n\r\n\r\n\r\nLineblocs Phone Provisioner allows you to manage global and individual phone configurations fully.\r\n\r\n\r\n\r\nThis guide will go over how to use the Lineblocs provisioning server to manage and update a Grandstream GXP2160\'s SIP configuration.\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nTo complete this guide, you will need the following items:\r\n\r\n\r\n\r\n1. Grandstream GXP2160\r\n\r\n2. Lineblocs account\r\n\r\n\r\n\r\n## Configuring GXP2160\r\n\r\n\r\n\r\nWe will first need to update our Grandstream GXP2160\'s \"Config Server Path\" to configure our phones with Lineblocs. This can be done in one of the following ways:\r\n\r\n\r\n\r\n1. Use DHCP option 66\r\n\r\n2. Update the \"Config Server Path\" in the Grandstream web GUI\r\n\r\n\r\n\r\nIn this guide, we will be updating the URL directly in the phone\'s web GUI.\r\n\r\n\r\n\r\nTo update your Config Server Path URL:\r\n\r\n\r\n\r\n1. Boot on your GXP2160\r\n\r\n2. On your phone LCD screen, go to Status -> Network Status\r\n\r\n3. Open the \"IPv4 Address\" value in a browser\r\n\r\n\r\n\r\nYou will then need to login to your Grandstream control panel. \r\n\r\n\r\n\r\nIf this is a new phone, you can login to your Grandstream Admin with username: admin and password: admin.\r\n\r\n\r\n\r\n## Changing Provisioning Path\r\n\r\n\r\n\r\nTo change your Provisioning Path, please go to the \"Maintenance -> Upgrade and Provisioning\" section, then please set your \"Config Server Path\" to:\r\n\r\n\r\n\r\n```\r\n\r\nprv.lineblocs.com\r\n\r\n```\r\n\r\n\r\n\r\nOnce you are done, please save all changes. \r\n\r\n\r\n\r\nYour Grandstream GXP2160 should now be setup to fetch its configuration from the Lineblocs provisioning server.\r\n\r\n\r\n\r\n## Creating a Phone in Lineblocs\r\n\r\n\r\n\r\nTo create a new phone in Lineblocs:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Provisioning\" -> \"Phones\"\r\n\r\n2. In the top right, click \"Create New\"\r\n\r\n\r\n\r\nOn the create screen, you will need to provide a name for your phone, a MAC address, and optionally a group.\r\n\r\n\r\n\r\nBelow is an example of how you may want to set up your phone:\r\n\r\n\r\n\r\n```\r\n\r\nName: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nMAC Address: 0A:0B:0C:0D:0E:0F\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nModel: Grandstream GXP2160\r\n\r\n```\r\n\r\n\r\n\r\n## Creating a Global Template\r\n\r\n\r\n\r\nFor our phone to register and fetch its configuration details such as its Extension #, SIP Server URL, and other GXP21XX related settings, we will need to create a \"Global Template.\". \r\n\r\n\r\n\r\nTo setup a global template, please go to the [Provisioning -> Global Templates](https://app.lineblocs.com/#/provision/global-settings) section in Lineblocs dashboard.\r\n\r\n\r\n\r\nOn the Global Templates page please click \"Add Global Settings.\"\r\n\r\n\r\n\r\nPlease create a template with the following details:\r\n\r\n\r\n\r\n```\r\n\r\nModel: Grandstream GXP2160\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nGroup: (None)\r\n\r\n```\r\n\r\n\r\n\r\n## Updating Account 1\r\n\r\n\r\n\r\nTo edit the global template\'s Account 1 SIP Server and Extension number, click the ![Grandstream Templates](/img/frontend/docs/provision-gxp2160/global-templates-link.png) link.\r\n\r\n\r\n\r\nIn the General Settings page, please add the following settings:\r\n\r\n\r\n\r\n```\r\n\r\nAccount Active?: Yes\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAccount Name: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSIP Server: {your-workspace-lineblocs-username}.lineblocs.com\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nSIP User ID: your-ext-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAuth ID: your-ext-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nAuth Password: your-ext-password\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: Desk Phone\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nVoicemail UserID: *98\r\n\r\n```\r\n\r\n\r\n\r\nPlease save all changes once you are complete.\r\n\r\n\r\n\r\n## Deploying Config\r\n\r\n\r\n\r\nYour phone is now ready to fetch its configuration from Lineblocs.\r\n\r\n\r\n\r\nTo check the status of your deployment, please go to [\"Provision\" -> \"Deploy Now\"](https://app.lineblocs.com/#/provision/deploy).\r\n\r\n\r\n\r\nYou should see that there is \"1\" phone pending provision on this page.\r\n\r\n\r\n\r\nTo deploy your config, please click \"Begin Deployment\"\r\n\r\n\r\n\r\n![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy.png)\r\n\r\n\r\n\r\nUpon completion of the settings, the configurations should be deployed and you should get a success message with instructions to complete the deployment process.\r\n\r\n\r\n\r\n![Grandstream GXP2160](/img/frontend/docs/provision-gxp2160/deploy-complete.png)\r\n\r\n\r\n\r\n## Testing\r\n\r\n\r\n\r\nOnce your GXP2160 has been restarted, it should be successfully registered to Lineblocs, and you should be able to make/receive calls! \r\n\r\n\r\n\r\nFor tips on troubleshooting, please read article [Debugging Config Deployment](https://lineblocs.com/resources/other-topics/debugging-config-deploy)\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide, we discussed how to provide a Grandstream GXP2160 in Lineblocs phone provisioner. For related articles, be sure to check out the following posts:\r\n\r\n\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','provision-grandstream-gxp2160'),(41,'2023-03-08 06:17:00','2023-03-27 22:12:13','Reference Integration: ExecLine conferencing','','learn how to create a complex small business conferencing workflow using lineblocs','',3,'lineblocs, conference, execline, conferencing, advanced, pbx',1,'# Reference Integration: ExecLine Conferencing\r\n\r\n\r\n\r\nComplex conferencing workflows allow you to communicate with multiple end-users on demand. Advanced conference workflows can be integrated to work with third-party apps, web services, and APIs. Using modern CPaaS, you can design and develop unique conferencing apps that provide your callers with a stellar conferencing experience.\r\n\r\n\r\n\r\nIn this tutorial, we will be looking at an advanced reference integration of a conferencing line for a small business owner.\r\n\r\n\r\n\r\nThe conference will include two user types:\r\n\r\n\r\n\r\n1. Host                                                                                     \r\n\r\nA.K.A our small business owner who will be managing the conference line.\r\n\r\n2. Member                                                                                      \r\n\r\n\r\n\r\nIn our example conference, members will call into our conference line to speak with our host regarding some services. \r\n\r\n\r\n\r\n## How it works\r\n\r\n\r\n\r\n1. The conference member calls into our conferencing line and waits for the host to join the line\r\n\r\n2. Our conference host is sent an SMS telling them a new caller is on his conference line\r\n\r\n3. The host then joins his conferencing line to speak with the caller\r\n\r\n\r\n\r\n## Requirements\r\n\r\n\r\n\r\nYou will need the following to complete this tutorial:\r\n\r\n\r\n\r\n1. A DID Number\r\n\r\n2. MessageBird account\r\n\r\n3. Lineblocs account\r\n\r\n\r\n\r\n## Getting Started\r\n\r\n\r\n\r\nTo create a new blank flow:\r\n\r\n\r\n\r\n1. In [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Create\" -> \"New Flow\"\r\n\r\n2. Enter a name for your flow\r\n\r\n3. Select \"Blank\" template\r\n\r\n4. Click \"Create\"\r\n\r\n\r\n\r\n## Setup Variables\r\n\r\n\r\n\r\nFirst, we will set up variables to keep track of what our host\'s number is when they call in. \r\n\r\n\r\n\r\nOur variables will allow us to switch context in our flow and to ensure we provide moderator access to our host.\r\n\r\n\r\n\r\nTo set up variables, please drag a \"Set Variables\" widget from the right pane into the flow graph, then connect the Launch widget \"Incoming Call\" port into the Set Variables \"In\" port.\r\n\r\n\r\n\r\n![Macro Added](/img/frontend/docs/execline/execline-2.png)\r\n\r\n\r\n\r\n\r\n\r\nNext, please click the \"Set Variables\" widget to bring up its widget options, then click ![Add](/img/frontend/docs/execline/add.png)\r\n\r\n\r\n\r\nPlease add the following variables:\r\n\r\n\r\n\r\n```\r\n\r\nName: host_number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-phone-number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: messagebird_access_token\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-messagebird-access-token\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nName: messagebird_number\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: your-messagebird-number\r\n\r\n```\r\n\r\n\r\n\r\n\r\n\r\n## Adding a Macro\r\n\r\n\r\n\r\nWe will add a macro to allow us to integrate a custom conferencing workflow.\r\n\r\n\r\n\r\nOur macro will be set up to subscribe to conference events as they are triggered.\r\n\r\n\r\n\r\nTo add a new macro, please drag the \"Macro\" widget from the right pane into the flow graph, then rename this widget to \"ConferenceEvents.\".\r\n\r\n\r\n\r\n![Events](/img/frontend/docs/execline/events.png)\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n## Setup Conference Events\r\n\r\n\r\n\r\nOur conference events widget will be set up to track when new members join the conference and make sure our conference always has at most two participants – the host and one member, at any given time.\r\n\r\n\r\n\r\nTo setup the conferencing events, please click the \"ConferenceEvents\" widget, then in the right pane under function click ![create](/img/frontend/docs/execline/create.png)\r\n\r\n\r\n\r\nOn the Macro Template screen, select template \"Blank,\", then click \"Save.\".\r\n\r\n\r\n\r\nIn the Lineblocs function editor, please add the following code:\r\n\r\n        \r\n\r\n        ```\r\n\r\n    function sendSMS(apiKey, apiNumber, number, body) {\r\n\r\n        var messagebird = require(\'messagebird\')(apiKey);\r\n\r\n        messagebird.messages.create({\r\n\r\n            originator: apiNumber,\r\n\r\n            recipients : [ number ],\r\n\r\n            body : body\r\n\r\n        });\r\n\r\n    }\r\n\r\n    module.exports = function(event: LineEvent, context: LineContext) {\r\n\r\n        return new Promise(async function(resolve, reject) {\r\n\r\n\r\n\r\n			var call = context.flow.call;\r\n\r\n            var cell = context.cell;\r\n\r\n            var host = event[\'host_number\'];\r\n\r\n            var sdk = context.getSDK();\r\n\r\n            var conf = sdk.createConference(context.flow, \"Execline\");\r\n\r\n            var number = \"\";\r\n\r\n\r\n\r\n            var isWaiting = true;\r\n\r\n            conf.on(\"MemberJoined\", function(member: LineConferenceMember) {\r\n\r\n                if (member.call.callParams.from === call.callParams.from) {\r\n\r\n				   var body = `${number} is now on your conference line.`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n				}\r\n\r\n			});\r\n\r\n            conf.on(\"MemberLeft\", function(member: LineConferenceMember) {\r\n\r\n                if (isWaiting && conf.totalParticipants() === 0 && member.call.callParams.from !== call.callParams.from) {\r\n\r\n                    // let our next conference member in\r\n\r\n                   var body = `${number} is now on your conference line.`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n                   resolve(); \r\n\r\n                }\r\n\r\n				if (member.call.callParams.from === call.callParams.from) {\r\n\r\n					var body = `${number} has left your conference line`;\r\n\r\n                   sendSMS(event[\'messagebird_api_key\'], event[\'messagebird_number\'], host, body);\r\n\r\n				}\r\n\r\n            });\r\n\r\n            if ( conf.totalParticipants() === 0 ) {\r\n\r\n                // let our first conference member in\r\n\r\n                isWaiting = false;\r\n\r\n                resolve();\r\n\r\n            }\r\n\r\n        });\r\n\r\n    }\r\n\r\n        ```\r\n\r\n\r\n\r\n\r\n\r\n## Setup Switch\r\n\r\n\r\n\r\nNext, we will create a \"Switch\" widget to change context depending on whether our host is calling or if a member is calling.\r\n\r\n\r\n\r\nTo set up a switch, please drag a \"Switch\" widget from the right pane into the flow graph, then add the following two links:\r\n\r\n\r\n\r\n### Link 1\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: {{SetupVariables.host_number}}\r\n\r\n```\r\n\r\n\r\n\r\n### Link 2\r\n\r\n\r\n\r\n```\r\n\r\nCondition: Not Equals\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nValue: {{SetupVariables.host_number}}\r\n\r\n```\r\n\r\n\r\n\r\n## Create Conference Routes\r\n\r\n\r\n\r\nOur conference will require at least two conferencing roles, the \"user.\" and the \"moderator.\"\r\n\r\n\r\n\r\nTo set up the call flow routes, please create two \"SetVariable\" widgets: \"ModeratorRoute\" and \"UserRoute.\"\r\n\r\n\r\n\r\nPlease add the following variables under \"ModeratorRoute\":\r\n\r\n\r\n\r\n```\r\n\r\nname: role\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nvalue: moderator\r\n\r\n```\r\n\r\n\r\n\r\nPlease add the following variables under \"UserRoute\":\r\n\r\n\r\n\r\n```\r\n\r\nname: role\r\n\r\n```\r\n\r\n\r\n\r\n```\r\n\r\nvalue: user\r\n\r\n```\r\n\r\n\r\n\r\n![execline 3](/img/frontend/docs/execline/execline-3.png)\r\n\r\n\r\n\r\n\r\n\r\n## Create Conference\r\n\r\n\r\n\r\nOur final piece of the flow will be to add a \"Conference\" widget.\r\n\r\n\r\n\r\nTo add a \"Conference\" widget into the flow, please drag a \"Conference\" widget from the right pane into the flow.\r\n\r\n\r\n\r\nIn the \"Conference\" settings, please check \"Wait for Moderator\" and \"End on Moderator leave\" settings.\r\n\r\n\r\n\r\n## Connecting the Flow\r\n\r\n\r\n\r\nTo make our flow all work together, we will need to add links between the widgets created.\r\n\r\n\r\n\r\nPlease add the following links:\r\n\r\n\r\n\r\n1. SetupVariables to ConferenceEvents\r\n\r\n2. ConferenceEvents to Switch\r\n\r\n3. Switch Link 1 to ModeratorRoute\r\n\r\n4. Switch Link 2 to UserRoute\r\n\r\n5. ModeratorRoute to Conference\r\n\r\n6. UserRoute to Conference\r\n\r\n\r\n\r\n![execline 4](/img/frontend/docs/execline/execline-4.png)\r\n\r\n\r\n\r\n\r\n\r\n## Using the flow on a DID number\r\n\r\n\r\n\r\nTo save all your changes please click ![Save](/img/frontend/docs/shared/save.png) in the flow editor.\r\n\r\n\r\n\r\nTo use your call flow on a DID Number:\r\n\r\n\r\n\r\n1. In the lineblocs dashboard please click [DID Numbers -> My Numbers](https://app.lineblocs.com/#/dashboard/dids/my-numbers)\r\n\r\n2. Click the \"Edit\" button next to your number\r\n\r\n3. Update the \"Attached Flow\" field\r\n\r\n4. Click \"Save\"\r\n\r\n\r\n\r\n## Testing the flow\r\n\r\n\r\n\r\nTo test as a caller:\r\n\r\nCall the conferencing line number\r\n\r\n\r\n\r\nTo test as a host: \r\n\r\nUse the host number to call into the conferencing line\r\n\r\n\r\n\r\n## Next Steps\r\n\r\n\r\n\r\nIn this guide we went over a reference conferencing app integration. For more related articles please see:\r\n\r\nIn this guide, we went over a reference conferencing app integration. For more related articles, please see:\r\n\r\n\r\n\r\n[Create a cold transfer](https://lineblocs.com/resources/quickstarts/setup-cold-transfers)\r\n\r\n\r\n\r\n[Setup Macro for Business Hours](https://lineblocs.com/resources/quickstarts/business-hours-with-custom-macros)','execline-conference-reference'),(42,'2023-04-06 18:00:16','2023-04-06 18:46:21','Setting up a Hosted SIP trunk','','Setup a hosted SIP trunk using Lineblocs portal','',3,'hosted, sip, trunk, sip trunking, ip-pbx, media server',1,'# Setting up a SIP trunk\r\n\r\nA Lineblocs SIP trunk allows you to interconnect the Lineblocs system with your external phone system. By utilizing the Lineblocs SIP trunks feature, you can integrate the Lineblocs network with your hosted IP-PBX. You can also link the SIP trunk with one or more of the DID numbers you have purchased.\r\n\r\nNormally, hosted SIP trunks are useful when you need to send your calls to an external phone system. By using hosted SIP trunks, you can create sophisticated SIP routing workflows that work in tandem with your hosted SIP infrastructure. \r\n\r\nIn this guide, we go over how to create a basic SIP trunk and how to connect it a IP-PBX server.\r\n\r\n## Requirements\r\n\r\nYou will need the following to create a hosted SIP trunk on Lineblocs:\r\n\r\n1. Lineblocs account\r\n2. an external IP-PBX\r\n\r\n## Creating SIP trunk\r\n\r\nIn [Lineblocs dashboard](https://app.lineblocs.com/#/dashboard) click \"Hosted trunks\" -> \"Create New\"\r\n\r\n## Configure routing settings\r\n\r\nOn the create page you will find various settings for updating your SIP trunk.\r\n\r\nIt is recommended that you configure settings optimally.\r\n\r\nIn order to setup a hosted SIP trunk correctly it is recommended that you fill in all the fields and ensure all settings are correct.\r\n\r\n### Updating the origination settings\r\n\r\nTo update the origination settings, please click the \"Origination\" tab.\r\n\r\nIn the origination panel, you can configure a primary and secondary SIP server. These servers will be utilized when Lineblocs needs to send a call to your SIP trunk.\r\n\r\nBoth the main SIP server and recovery SIP server need a valid SIP URI. For example:\r\n\r\n```\r\nsip:mysipserver.example.org\r\n```\r\n\r\n### Termination\r\n\r\nTo access the termination settings, please click the \"Termination\" tab.\r\n\r\nOn the termination tab you will find any relevant settings for SIP termination. You can configure any valid domain name here and use it with your SIP trunk. For example:\r\n\r\n```\r\nmyhostedtrunk.pstn.lineblocs.com\r\n```\r\n\r\n> note the pstn.lineblocs.com domain will be appended to your domain automatically\r\n\r\n### Integrate trunk with DID numbers\r\n\r\nIt is also recommended that you configure atleast one DID number with your SIP trunk. \r\n\r\nTo edit your DID numbers, please click the DID numbers tab.\r\n\r\nOn this page, you can check any DID numbers you want to link with your trunk.\r\n\r\n## Saving settings\r\n\r\nTo save the SIP trunk, please click the \"Save\" button.\r\n\r\n## Connecting Lineblocs SIP trunk to external IP-PBX\r\n\r\nOnce you have saved the SIP trunk you can start configuring it with your IP-PBX.\r\n\r\nNote that each IP-PBX has its own unique settings and you will need to follow best practices.\r\n\r\nFortunately, We have created a list of guides for common IP-PBX. This can be found [here](https://lineblocs.com/resources/other-topics/interconnection-guides) \r\n\r\n## Testing the SIP trunk\r\n\r\nYou can test the SIP trunk by making calls from your hosted IP-PBX.\r\n\r\nIf everything is configured correctly the calls should connect and you should be able to hear audio.\r\n\r\n## Next Steps\r\n\r\nIn this guide we discussed setting up a hosted SIP trunk. For more guides about related topics please refer to the following articles:\r\n\r\n[Simple IVR](https://lineblocs.com/resources/quickstarts/basic-ivr)\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','setup-sip-trunk'),(43,'2023-05-15 22:25:52','2023-05-15 22:25:52','How to configure 2FA for your account','','How to configure 2FA for Lineblocs','',7,'2fa,configure,security,authentication,mfa,sms,totp,authenticator app',1,'# Enabling Two-Factor Authentication (2FA) for Your Account\r\n\r\n## Introduction\r\n\r\nEnhancing the security of your web app account is crucial in today\'s digital landscape. One highly effective method to bolster your account\'s security is by enabling Two-Factor Authentication (2FA). This user guide will walk you through the step-by-step process of enabling 2FA for your account, ensuring an additional layer of protection for your sensitive information.\r\n\r\n## Step 1: Accessing Account Settings\r\n\r\n1. Log in to your Lineblocs account using your credentials.\r\n2. Once logged in, click your the profile icon ![user](/img/frontend/docs/shared/user.png) then click [settings](https://lineblocs.com/#/dashboard/settings)\r\n3. On the account settings page click the Security tab\r\n\r\n## Step 2: Enabling 2FA\r\n\r\nIn the security section, click on the \"Enable Two-Factor Authentication (2FA)\" button to begin the setup process.\r\n\r\n## Step 3: Choose Authentication Method\r\n\r\nCurrently there are two available options for 2FA logins:\r\n\r\n- SMS\r\n- Authenticator app\r\n\r\nTo start configuring 2FA please select your preferred option.\r\n\r\n## Step 4: Confirm Authentication Method\r\n\r\n1. Depending on the chosen method, follow the on-screen instructions to set it up.\r\n   - SMS-based codes: Enter your mobile phone number and verify it by entering the code received.\r\n   - Authenticator app: Download and install the preferred authenticator app from your device\'s app store. Follow the app\'s instructions to scan the QR code or manually enter the provided code.\r\n\r\n## Step 5: Completing the Setup\r\n\r\n1. Once you have set up your chosen authentication method, click on the \"Submit\" button.\r\n2. Congratulations! Your 2FA is now enabled for your Lineblocs account.\r\n\r\n## Step 6: Testing 2FA\r\n1. Log out of your account and then log back in.\r\n2. After entering your username and password, you will be prompted to enter a verification code.\r\n3. Retrieve the code from your chosen authentication method (SMS, or authenticator app) and enter it in the provided field.\r\n4. Upon successful verification, you will gain access to your account.\r\n\r\n## Step 7: Managing 2FA Settings\r\n\r\nIn case you need to modify or update your 2FA settings, you can return to the \"Security\" section. From there, you can update any of the 2FA settings or disable it if need be.\r\n\r\n## Conclusion:\r\nBy following this user guide, you have successfully enabled Two-Factor Authentication (2FA) for your Lineblocs account. This additional layer of security significantly reduces the risk of unauthorized access and enhances the protection of your sensitive data. Enjoy the peace of mind that comes with knowing your account is more secure than ever before.','configure-2fa'),(44,'2023-05-26 19:11:18','2023-06-06 17:54:08','Deploy Lineblocs to Kubernetes','','Deploy Lineblocs to Kubernetes using Helm','',3,'kubernetes, k8s, gke, eks, aks, k8s',1,'# Deploy Lineblocs to Kubernetes\r\n\r\nKubernetes is a highly scalable platform and very versatile for container deployments. It is also the preferred platform for Lineblocs deployments. The Lineblocs service can easily be deployed to Kubernetes using the Helm package manager. Moreover, the deployment can easily be customized using the chart values file. \r\n\r\nThis guide goes over a basic Lineblocs deployment. It mentions how the service can be configured and how you can perform basic management tasks.\r\n\r\n## Requirements\r\n\r\nIn order to deploy Lineblocs to Kubernetes, you will to have the Helm command line tool. This can be downloaded here [Download latest Helm version](https://helm.sh/docs/intro/install/)\r\n\r\n### Minimum requirements for compute resources:\r\n\r\nAlthough, you can provision more compute capacity, it is recommended that you at least configure Kubernetes with the following node groups:\r\n\r\nNode group 1 - web services\r\n\r\n	nodes: 2\r\n	cpus: 4 vCPUs\r\n	memory: 16gib\r\n\r\nNode group 2 - voip and batch processing\r\n\r\n	nodes: 4\r\n	cpus: 8 vCPUs\r\n	memory: 32gib\r\n\r\nThis will ensure that the deployment process runs smooth and also ensure that you don’t run into issues related to Kubernetes scheduling.\r\n\r\n# Downloading and configuring the Helm chart\r\n\r\nIf you have the Helm command line tool, you can easily deploy Lineblocs into your Kubernetes cluster.\r\n\r\nTo get started, please clone the Helm chart code from the official Github repository:\r\n\r\n	git clone https://github.com/Lineblocs/helm-chart.git\r\n\r\nThe Github project currently includes two Helm charts:\r\n\r\n1. web\r\n2. voip\r\n\r\nYou can configure the Helm chart by customizing the chart values file. For example, if you want to change the default deployment for the web services you can update the web/values.yaml.\r\n\r\n# Configuring the database\r\n\r\nPrior to deploying the Helm chart, it is required that you create the necessary databases and import the required table definitions. This will ensure that the service runs properly.\r\n\r\nCurrently, there are database dump files for the database schemas and they should be used for importing the required data.\r\n\r\nThe .sql files are located in the Github repository.\r\n\r\nYou can find them in the database/ folder. At present there is one schema definition for the Lineblocs backend and another for the OpenSIPs service. They are named lineblocs.sql and opensips.sql respectively.\r\n\r\nYou will need to import the dump files using MySQL command line tool or a graphical editor such as MySQL workbench.\r\n\r\nFor example, if you are using the MySQL command line you can create the database and import the schemas using the following commands:\r\n\r\n	mysql -u {username} -p -e \"create database lineblocs\";\r\n	mysql -u {username} -p lineblocs < database/lineblocs.sql\r\n\r\n	mysql -u {username} -p -e \"create database opensips\";\r\n	mysql -u {username} -p opensips < database/opensips.sql\r\n\r\n\r\n## Configuring Kubernetes secret for database\r\n\r\nNext, you will need to create a few secrets to fully configure the service.  These secrets are used internally, and they mainly consist of database credentials, in addition to networking configuration. The database credentials are used to connect to the database, which is external to the service by default.\r\n\r\nIt is simple to deploy the secrets. The Github project currently includes reference files, which serve as a good starting point. Currently there are two secret files, both of which can be found inside the secrets directory.\r\n\r\nYou can create copies of these files and modify them according to your needs.\r\n\r\nFor example, to copy the files to another path, you can remove the .example suffix from the reference file name:\r\n\r\n	mv ./secrets/web.example.yml  ./secrets/web.yml   \r\n	mv ./secrets/voip.example.yml  ./secrets/voip.yml   \r\n\r\nAfterwards, you will need to update the database credentials in each file.\r\n\r\n> **Note:** you can also update the other secret values, but it is not required.\r\n\r\nOnce you have updated the secret files, you can deploy them using the ‘kuberctl create secret’ command. For example:\r\n\r\n	kubectl create -n lb-web -f ./secrets/web.yml\r\n	kubectl create -n lb-voip -f ./secrets/voip.yml\r\n\r\nTo verify if the secrets were created successfully, you can use the following command:\r\n\r\n	kubectl get secret —all-namespaces\r\n\r\nYou should see the following secrets under the voip namespace:\r\n\r\n	ami-secret\r\n	ari-secret\r\n	lineblocs-secret\r\n\r\nYou should also see one secret under the web space:\r\n\r\n	db-secret\r\n\r\n# Deploying the Helm charts\r\n\r\nIf the secrets were created successfully, you are now ready to deploy the Helm charts.\r\n\r\nTo deploy the charts, you will need to install the required helm dependencies and then run the ‘helm install\' command.\r\n\r\nFor example, assuming you have cloned the project correctly, you could run the following commands:\r\n\r\n	# deploy the web chart\r\n	cd web/\r\n	helm dependency build\r\n	helm dependency update \r\n	helm install lb-web-chart -n lb-web  -f values.yaml .\r\n	# deploy VoIP\r\n	cd voip/ \r\n	helm dependency build\r\n	helm dependency update \r\n	helm install lb-voip-chart -n lb-voip -f values.yaml .\r\n\r\n# Testing deployments\r\n\r\nIt may take time for all the services to fully deploy; however you can verify that the deployments were successful by using the kubectl tool.\r\n\r\nThe pods are deployed into two namespaces:\r\n\r\n1. lb-web\r\n2. lb-voip\r\n\r\nTo verify the status please run: \r\n\r\n	kubectl get pods -n {namespace}\r\n\r\nIf the deployment was successful the container status should read \'Running\'. \r\n\r\nFor example, the following screenshot shows a succesful deployment:\r\n\r\n![Helm deployment example](/img/frontend/docs/deploy-kubernetes/successful-deployment-example.png)\r\n\r\n# Getting the Ingress DNS\r\n\r\nTo access your Lineblocs deployment, you can use the Ingress DNS. This should automatically be configured.\r\n\r\nTo obtain the URL for your Ingress load balancer, please run the following command:\r\n\r\n```\r\nkubectl get svc -n lb-web\r\n```\r\n\r\nThe load balancer DNS should be listed next to the ingress-controller service. For example:\r\n\r\n![Ingress service DNS](/img/frontend/docs/deploy-kubernetes/ingress-dns-output.png)\r\n\r\nYou can use this ingress IP to finalize the Lineblocs setup process.\r\n\r\nFor example, assuming your ingress value is 1.2.3.4, you would use the following URL:\r\n\r\n```\r\nhttp://1.2.3.4/setup\r\n```\r\n\r\nCongratulations! you have successfully deployed the Lineblocs Helm chart.\r\n\r\n# Troubleshooting deployments\r\n\r\nWe have created a list of solutions for the most common problems encountered during a deployment. You may find these helpful if you run into issues or need more info. \r\n\r\n## 1. Scheduling/resource issues\r\n\r\nIf you encountered scheduling issues, it is recommended that you rescale your node groups to meet the minimum requirements. For more info, please refer to the requirements section.\r\n\r\n## 2. Ingress IP not available\r\n\r\nIf the ingress IP is not visible, it may be due to your cloud provider. It is recommended that you verify whether a load balancer was created using your cloud providers management dashboard. If you don\'t see anything, it is recommended that you look into an alternative approach for deploying the ingress. \r\n\r\nYou can also deploy the ingress manually in case you run into issues. For full details, please refer to the following guide: [Deploy Lineblocs ingress](/resources/open-source/deploy-lineblocs-ingress)\r\n\r\n## 3. Database timeouts and connectivity issues\r\n\r\nAny issues related to databases are external to the Helm chart deployment. It is recommended that you check the networking configuration for your cloud provider to ensure that the Kubernetes cluster can access the database instance(s).\r\n\r\n# Conclusion\r\n\r\nIn this guide we discussed the Lineblocs Helm chart and went over a typical deployment. For more related guides, be sure to view the following:\r\n\r\n[Recordings and Voicemail](https://lineblocs.com/resources/quickstarts/recordings-and-voicemail)\r\n\r\n[Setup Extension](https://lineblocs.com/resources/quickstarts/setup-extension)','deploy-kubernetes');
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
  `key_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `image_icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `size` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'full',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flow_json` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
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
  `rtpproxy_sock` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `set_id` int NOT NULL,
  `cpu_pct` double(2,2) NOT NULL DEFAULT '0.00',
  `cpu_used` double(8,2) NOT NULL DEFAULT '0.00',
  `mem_pct` double(2,2) NOT NULL DEFAULT '0.00',
  `mem_used` double(8,2) NOT NULL DEFAULT '0.00',
  `active` int NOT NULL DEFAULT '1',
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'unknown',
  `priority` int NOT NULL DEFAULT '0',
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `router_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtpproxy_sockets`
--

LOCK TABLES `rtpproxy_sockets` WRITE;
/*!40000 ALTER TABLE `rtpproxy_sockets` DISABLE KEYS */;
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
  `key_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `nice_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `call_duration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `recording_space` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `benefits` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `monthly_charge_cents` int DEFAULT '0',
  `pay_as_you_go` int DEFAULT '0',
  `registration_plan` smallint DEFAULT '0',
  `include_in_pricing_pages` tinyint(1) NOT NULL DEFAULT '0',
  `rank` int DEFAULT NULL,
  `plan_term` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  `annual_cost_cents` int NOT NULL DEFAULT '0',
  `allows_annual` tinyint(1) NOT NULL DEFAULT '1',
  `allows_monthly` tinyint(1) NOT NULL DEFAULT '1',
  `base_costs` int DEFAULT '0',
  `minutes_per_month` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_plans`
--

LOCK TABLES `service_plans` WRITE;
/*!40000 ALTER TABLE `service_plans` DISABLE KEYS */;
INSERT INTO `service_plans` VALUES (43,'2023-06-06 18:29:48','2023-06-06 18:29:48','pay-as-you-go','Pay as you go','On demand subscription','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'',0,1,0,1,0,'none',0,0,0,0,0),(44,'2023-06-06 18:29:49','2023-06-06 18:29:49','basic','Basic','Basic package with all base level features.','Unlimited','2048',0,1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,0,1,1,1,'none',0,1,1,2499,200);
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
  `iso` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `country_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `flow_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_countries_flow_id_foreign` (`flow_id`),
  CONSTRAINT `sip_countries_flow_id_foreign` FOREIGN KEY (`flow_id`) REFERENCES `router_flows` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_countries`
--

LOCK TABLES `sip_countries` WRITE;
/*!40000 ALTER TABLE `sip_countries` DISABLE KEYS */;
INSERT INTO `sip_countries` VALUES (43,'2023-06-06 18:29:51','2023-06-06 18:29:51','CA','Canada',1,'',NULL),(44,'2023-06-06 18:29:52','2023-06-06 18:29:52','US','United States',1,'',NULL);
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dial_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `host` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'unknown',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `api_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_of_provider` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `carrier_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `active_channels` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers`
--

LOCK TABLES `sip_providers` WRITE;
/*!40000 ALTER TABLE `sip_providers` DISABLE KEYS */;
INSERT INTO `sip_providers` VALUES (22,'2023-06-06 18:29:49','2023-06-06 18:29:49','VoIPMS','','','',0,'toronto.voip.ms','unknown',0,'VoIPMS','both',NULL,0);
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
  `dial_prefix` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `call_rate` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority` int NOT NULL,
  `priority_prefixes` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active_channels` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sip_providers_hosts_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_hosts_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_hosts`
--

LOCK TABLES `sip_providers_hosts` WRITE;
/*!40000 ALTER TABLE `sip_providers_hosts` DISABLE KEYS */;
INSERT INTO `sip_providers_hosts` VALUES (22,'2023-06-06 18:29:49','2023-06-06 18:29:49',22,'toronto.voip.ms','Toronto',1,'',0);
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
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_providers_whitelist_ips_provider_id_foreign` (`provider_id`),
  CONSTRAINT `sip_providers_whitelist_ips_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `sip_providers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_providers_whitelist_ips`
--

LOCK TABLES `sip_providers_whitelist_ips` WRITE;
/*!40000 ALTER TABLE `sip_providers_whitelist_ips` DISABLE KEYS */;
INSERT INTO `sip_providers_whitelist_ips` VALUES (22,'2023-06-06 18:29:49','2023-06-06 18:29:49',22,'158.85.70.148','/32');
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `region_id` int unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `fax_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `fax_data_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fax_data_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_id` int unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sip_regions_country_id_foreign` (`country_id`),
  CONSTRAINT `sip_regions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `sip_countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_regions`
--

LOCK TABLES `sip_regions` WRITE;
/*!40000 ALTER TABLE `sip_regions` DISABLE KEYS */;
INSERT INTO `sip_regions` VALUES (400,'2023-06-06 18:29:51','2023-06-06 18:29:51','AB','Alberta',43,1),(401,'2023-06-06 18:29:51','2023-06-06 18:29:51','ON','Ontario',43,1),(402,'2023-06-06 18:29:51','2023-06-06 18:29:51','BC','British Columbia',43,1),(403,'2023-06-06 18:29:51','2023-06-06 18:29:51','MB','Manitoba',43,1),(404,'2023-06-06 18:29:52','2023-06-06 18:29:52','QC','Quebec',43,1),(405,'2023-06-06 18:29:52','2023-06-06 18:29:52','NS','Nova Scotia',43,1),(406,'2023-06-06 18:29:52','2023-06-06 18:29:52','CA','California',44,1),(407,'2023-06-06 18:29:52','2023-06-06 18:29:52','FL','Florida',44,1),(408,'2023-06-06 18:29:52','2023-06-06 18:29:52','NY','New York',44,1),(409,'2023-06-06 18:29:52','2023-06-06 18:29:52','NC','North Carolina',44,1),(410,'2023-06-06 18:29:53','2023-06-06 18:29:53','SC','South Carolina',44,1),(411,'2023-06-06 18:29:53','2023-06-06 18:29:53','TX','Texas',44,1),(412,'2023-06-06 18:29:53','2023-06-06 18:29:53','WA','Washington',44,1),(413,'2023-06-06 18:29:53','2023-06-06 18:29:53','MS','Massachusetts',44,1),(414,'2023-06-06 18:29:53','2023-06-06 18:29:53','IL','Illinois',44,1),(415,'2023-06-06 18:29:53','2023-06-06 18:29:53','NV','Nevada',44,1),(416,'2023-06-06 18:29:53','2023-06-06 18:29:53','PA','Pennsylvania',44,1),(417,'2023-06-06 18:29:54','2023-06-06 18:29:54','CO','Colorado',44,1),(418,'2023-06-06 18:29:54','2023-06-06 18:29:54','MN','Minnesota',44,1);
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address_range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `private_ip_address_range` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `live_call_count` int NOT NULL DEFAULT '0',
  `live_cpu_pct_used` double(8,2) NOT NULL DEFAULT '0.00',
  `live_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `k8s_pod_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_routers`
--

LOCK TABLES `sip_routers` WRITE;
/*!40000 ALTER TABLE `sip_routers` DISABLE KEYS */;
INSERT INTO `sip_routers` VALUES (22,'2023-06-06 18:29:49','2023-06-06 18:29:49','Canada PoP','0.0.0.0','/32','127.0.0.1','','ca-central-1',1,0,0.00,'','');
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
-- Table structure for table `sip_routing_acl`
--

DROP TABLE IF EXISTS `sip_routing_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_routing_acl` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iso` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `risk_level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `country_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_routing_acl`
--

LOCK TABLES `sip_routing_acl` WRITE;
/*!40000 ALTER TABLE `sip_routing_acl` DISABLE KEYS */;
INSERT INTO `sip_routing_acl` VALUES (45,'2023-06-06 18:29:54','2023-06-06 18:29:54','us','United States','low',1,''),(46,'2023-06-06 18:29:54','2023-06-06 18:29:54','ca','Canada','low',1,'');
/*!40000 ALTER TABLE `sip_routing_acl` ENABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `record` tinyint(1) NOT NULL,
  `record_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'dual',
  `workspace_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sip_trunks_workspace_id_foreign` (`workspace_id`),
  KEY `sip_trunks_user_id_foreign` (`user_id`),
  CONSTRAINT `sip_trunks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sip_trunks_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks`
--

LOCK TABLES `sip_trunks` WRITE;
/*!40000 ALTER TABLE `sip_trunks` DISABLE KEYS */;
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
  `sip_uri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  `ipv4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ipv6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_origination_endpoints_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_origination_endpoints_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_origination_endpoints`
--

LOCK TABLES `sip_trunks_origination_endpoints` WRITE;
/*!40000 ALTER TABLE `sip_trunks_origination_endpoints` DISABLE KEYS */;
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
  `recovery_sip_uri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trunk_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sip_trunks_origination_settings_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_origination_settings_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_origination_settings`
--

LOCK TABLES `sip_trunks_origination_settings` WRITE;
/*!40000 ALTER TABLE `sip_trunks_origination_settings` DISABLE KEYS */;
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
  `identifier` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cidr_addr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `sip_addr` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sip_trunks_termination_settings_trunk_id_foreign` (`trunk_id`),
  CONSTRAINT `sip_trunks_termination_settings_trunk_id_foreign` FOREIGN KEY (`trunk_id`) REFERENCES `sip_trunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trunks_termination_settings`
--

LOCK TABLES `sip_trunks_termination_settings` WRITE;
/*!40000 ALTER TABLE `sip_trunks_termination_settings` DISABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_status_categories`
--

LOCK TABLES `system_status_categories` WRITE;
/*!40000 ALTER TABLE `system_status_categories` DISABLE KEYS */;
INSERT INTO `system_status_categories` VALUES (1,'2023-01-03 23:12:27','2023-01-03 23:12:27','SIP Trunking Networks',''),(2,'2023-01-03 23:12:27','2023-01-03 23:12:27','Media Storage Servers',''),(3,'2023-01-03 23:12:27','2023-01-03 23:12:27','PoP Servers',''),(4,'2023-01-03 23:12:27','2023-01-03 23:12:27','User Portals',''),(5,'2023-06-05 20:28:24','2023-06-05 20:28:24','SIP Trunking Networks',''),(6,'2023-06-05 20:28:24','2023-06-05 20:28:24','Media Storage Servers',''),(7,'2023-06-05 20:28:24','2023-06-05 20:28:24','PoP Servers',''),(8,'2023-06-05 20:28:24','2023-06-05 20:28:24','User Portals',''),(9,'2023-06-05 20:42:06','2023-06-05 20:42:06','SIP Trunking Networks',''),(10,'2023-06-05 20:42:06','2023-06-05 20:42:06','Media Storage Servers',''),(11,'2023-06-05 20:42:06','2023-06-05 20:42:06','PoP Servers',''),(12,'2023-06-05 20:42:06','2023-06-05 20:42:06','User Portals',''),(13,'2023-06-05 20:46:58','2023-06-05 20:46:58','SIP Trunking Networks',''),(14,'2023-06-05 20:46:58','2023-06-05 20:46:58','Media Storage Servers',''),(15,'2023-06-05 20:46:58','2023-06-05 20:46:58','PoP Servers',''),(16,'2023-06-05 20:46:58','2023-06-05 20:46:58','User Portals',''),(17,'2023-06-05 20:47:21','2023-06-05 20:47:21','SIP Trunking Networks',''),(18,'2023-06-05 20:47:21','2023-06-05 20:47:21','Media Storage Servers',''),(19,'2023-06-05 20:47:21','2023-06-05 20:47:21','PoP Servers',''),(20,'2023-06-05 20:47:21','2023-06-05 20:47:21','User Portals',''),(21,'2023-06-05 20:47:40','2023-06-05 20:47:40','SIP Trunking Networks',''),(22,'2023-06-05 20:47:40','2023-06-05 20:47:40','Media Storage Servers',''),(23,'2023-06-05 20:47:40','2023-06-05 20:47:40','PoP Servers',''),(24,'2023-06-05 20:47:40','2023-06-05 20:47:40','User Portals',''),(25,'2023-06-05 20:47:51','2023-06-05 20:47:51','SIP Trunking Networks',''),(26,'2023-06-05 20:47:51','2023-06-05 20:47:51','Media Storage Servers',''),(27,'2023-06-05 20:47:51','2023-06-05 20:47:51','PoP Servers',''),(28,'2023-06-05 20:47:51','2023-06-05 20:47:51','User Portals',''),(29,'2023-06-05 20:59:49','2023-06-05 20:59:49','SIP Trunking Networks',''),(30,'2023-06-05 20:59:49','2023-06-05 20:59:49','Media Storage Servers',''),(31,'2023-06-05 20:59:49','2023-06-05 20:59:49','PoP Servers',''),(32,'2023-06-05 20:59:49','2023-06-05 20:59:49','User Portals',''),(33,'2023-06-05 21:02:12','2023-06-05 21:02:12','SIP Trunking Networks',''),(34,'2023-06-05 21:02:12','2023-06-05 21:02:12','Media Storage Servers',''),(35,'2023-06-05 21:02:12','2023-06-05 21:02:12','PoP Servers',''),(36,'2023-06-05 21:02:12','2023-06-05 21:02:12','User Portals',''),(37,'2023-06-05 21:06:42','2023-06-05 21:06:42','SIP Trunking Networks',''),(38,'2023-06-05 21:06:42','2023-06-05 21:06:42','Media Storage Servers',''),(39,'2023-06-05 21:06:42','2023-06-05 21:06:42','PoP Servers',''),(40,'2023-06-05 21:06:42','2023-06-05 21:06:42','User Portals',''),(41,'2023-06-05 21:46:07','2023-06-05 21:46:07','SIP Trunking Networks',''),(42,'2023-06-05 21:46:07','2023-06-05 21:46:07','Media Storage Servers',''),(43,'2023-06-05 21:46:07','2023-06-05 21:46:07','PoP Servers',''),(44,'2023-06-05 21:46:07','2023-06-05 21:46:07','User Portals',''),(45,'2023-06-05 21:48:22','2023-06-05 21:48:22','SIP Trunking Networks',''),(46,'2023-06-05 21:48:22','2023-06-05 21:48:22','Media Storage Servers',''),(47,'2023-06-05 21:48:22','2023-06-05 21:48:22','PoP Servers',''),(48,'2023-06-05 21:48:22','2023-06-05 21:48:22','User Portals',''),(49,'2023-06-05 21:52:53','2023-06-05 21:52:53','SIP Trunking Networks',''),(50,'2023-06-05 21:52:53','2023-06-05 21:52:53','Media Storage Servers',''),(51,'2023-06-05 21:52:53','2023-06-05 21:52:53','PoP Servers',''),(52,'2023-06-05 21:52:53','2023-06-05 21:52:53','User Portals',''),(53,'2023-06-05 21:56:05','2023-06-05 21:56:05','SIP Trunking Networks',''),(54,'2023-06-05 21:56:05','2023-06-05 21:56:05','Media Storage Servers',''),(55,'2023-06-05 21:56:05','2023-06-05 21:56:05','PoP Servers',''),(56,'2023-06-05 21:56:05','2023-06-05 21:56:05','User Portals',''),(57,'2023-06-05 21:57:38','2023-06-05 21:57:38','SIP Trunking Networks',''),(58,'2023-06-05 21:57:38','2023-06-05 21:57:38','Media Storage Servers',''),(59,'2023-06-05 21:57:38','2023-06-05 21:57:38','PoP Servers',''),(60,'2023-06-05 21:57:38','2023-06-05 21:57:38','User Portals',''),(61,'2023-06-05 23:11:06','2023-06-05 23:11:06','SIP Trunking Networks',''),(62,'2023-06-05 23:11:06','2023-06-05 23:11:06','Media Storage Servers',''),(63,'2023-06-05 23:11:06','2023-06-05 23:11:06','PoP Servers',''),(64,'2023-06-05 23:11:06','2023-06-05 23:11:06','User Portals',''),(65,'2023-06-05 23:12:07','2023-06-05 23:12:07','SIP Trunking Networks',''),(66,'2023-06-05 23:12:07','2023-06-05 23:12:07','Media Storage Servers',''),(67,'2023-06-05 23:12:07','2023-06-05 23:12:07','PoP Servers',''),(68,'2023-06-05 23:12:07','2023-06-05 23:12:07','User Portals',''),(69,'2023-06-05 23:12:33','2023-06-05 23:12:33','SIP Trunking Networks',''),(70,'2023-06-05 23:12:33','2023-06-05 23:12:33','Media Storage Servers',''),(71,'2023-06-05 23:12:33','2023-06-05 23:12:33','PoP Servers',''),(72,'2023-06-05 23:12:33','2023-06-05 23:12:33','User Portals',''),(73,'2023-06-05 23:12:45','2023-06-05 23:12:45','SIP Trunking Networks',''),(74,'2023-06-05 23:12:45','2023-06-05 23:12:45','Media Storage Servers',''),(75,'2023-06-05 23:12:45','2023-06-05 23:12:45','PoP Servers',''),(76,'2023-06-05 23:12:45','2023-06-05 23:12:45','User Portals',''),(77,'2023-06-05 23:13:24','2023-06-05 23:13:24','SIP Trunking Networks',''),(78,'2023-06-05 23:13:24','2023-06-05 23:13:24','Media Storage Servers',''),(79,'2023-06-05 23:13:24','2023-06-05 23:13:24','PoP Servers',''),(80,'2023-06-05 23:13:24','2023-06-05 23:13:24','User Portals',''),(81,'2023-06-06 16:59:24','2023-06-06 16:59:24','SIP Trunking Networks',''),(82,'2023-06-06 16:59:24','2023-06-06 16:59:24','Media Storage Servers',''),(83,'2023-06-06 16:59:24','2023-06-06 16:59:24','PoP Servers',''),(84,'2023-06-06 16:59:24','2023-06-06 16:59:24','User Portals',''),(85,'2023-06-06 18:29:49','2023-06-06 18:29:49','SIP Trunking Networks',''),(86,'2023-06-06 18:29:49','2023-06-06 18:29:49','Media Storage Servers',''),(87,'2023-06-06 18:29:49','2023-06-06 18:29:49','PoP Servers',''),(88,'2023-06-06 18:29:49','2023-06-06 18:29:49','User Portals','');
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
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usage_triggers`
--

LOCK TABLES `usage_triggers` WRITE;
/*!40000 ALTER TABLE `usage_triggers` DISABLE KEYS */;
INSERT INTO `usage_triggers` VALUES (1,'2023-01-03 23:13:54','2023-01-03 23:13:54',NULL,50),(2,'2023-01-03 23:15:08','2023-01-03 23:15:08',NULL,50),(3,'2023-01-12 02:25:20','2023-01-12 02:25:20',NULL,50),(4,'2023-01-12 02:27:05','2023-01-12 02:27:05',NULL,50),(5,'2023-01-20 07:16:26','2023-01-20 07:16:26',NULL,50),(6,'2023-02-20 18:32:01','2023-02-20 18:32:01',NULL,50),(7,'2023-03-02 03:19:45','2023-03-02 03:19:45',NULL,50),(8,'2023-03-02 03:24:25','2023-03-02 03:24:25',NULL,50),(9,'2023-03-02 03:43:15','2023-03-02 03:43:15',NULL,50),(10,'2023-03-02 16:11:04','2023-03-02 16:11:04',NULL,50),(11,'2023-03-16 20:31:49','2023-03-16 20:31:49',NULL,50),(12,'2023-03-16 20:37:32','2023-03-16 20:37:32',NULL,50),(13,'2023-03-17 10:46:07','2023-03-17 10:46:07',NULL,50),(14,'2023-03-17 10:47:54','2023-03-17 10:47:54',NULL,50),(15,'2023-03-17 10:50:52','2023-03-17 10:50:52',NULL,50),(16,'2023-03-17 10:57:19','2023-03-17 10:57:19',NULL,50),(17,'2023-03-17 21:45:01','2023-03-17 21:45:01',NULL,50),(18,'2023-03-28 18:03:55','2023-03-28 18:03:55',NULL,50),(19,'2023-03-31 20:45:07','2023-03-31 20:45:07',NULL,50),(20,'2023-04-02 05:30:02','2023-04-02 05:30:02',NULL,50),(21,'2023-04-03 16:39:51','2023-04-03 16:39:51',NULL,50),(22,'2023-04-03 16:43:49','2023-04-03 16:43:49',NULL,50),(23,'2023-04-03 16:45:50','2023-04-03 16:45:50',NULL,50),(24,'2023-04-03 16:45:58','2023-04-03 16:45:58',NULL,50),(25,'2023-04-03 16:50:14','2023-04-03 16:50:14',NULL,50),(26,'2023-04-04 11:11:42','2023-04-04 11:11:42',NULL,50),(27,'2023-04-04 17:19:22','2023-04-04 17:19:22',NULL,50),(28,'2023-04-05 10:47:08','2023-04-05 10:47:08',NULL,50),(29,'2023-04-12 10:36:15','2023-04-12 10:36:15',NULL,50),(30,'2023-04-12 12:50:16','2023-04-12 12:50:16',NULL,50),(31,'2023-04-14 12:19:44','2023-04-14 12:19:44',NULL,50),(32,'2023-04-18 10:18:14','2023-04-18 10:18:14',NULL,50),(33,'2023-04-24 05:07:54','2023-04-24 05:07:54',NULL,50),(34,'2023-04-24 06:08:11','2023-04-24 06:08:11',NULL,50),(35,'2023-04-25 09:38:15','2023-04-25 09:38:15',NULL,50),(36,'2023-04-27 21:14:35','2023-04-27 21:14:35',NULL,50),(37,'2023-04-28 10:34:27','2023-04-28 10:34:27',NULL,50),(38,'2023-04-29 03:32:08','2023-04-29 03:32:08',NULL,50),(39,'2023-04-29 03:39:54','2023-04-29 03:39:54',NULL,50),(40,'2023-05-01 04:01:17','2023-05-01 04:01:17',NULL,50),(41,'2023-05-01 16:16:55','2023-05-01 16:16:55',NULL,50),(42,'2023-05-01 16:58:05','2023-05-01 16:58:05',NULL,50),(43,'2023-05-01 20:51:20','2023-05-01 20:51:20',NULL,50),(44,'2023-05-02 18:08:29','2023-05-02 18:08:29',NULL,50),(45,'2023-05-02 18:36:35','2023-05-02 18:36:35',NULL,50),(46,'2023-05-03 17:10:41','2023-05-03 17:10:41',NULL,50),(47,'2023-05-04 21:14:03','2023-05-04 21:14:03',NULL,50),(48,'2023-05-04 21:21:54','2023-05-04 21:21:54',NULL,50),(49,'2023-05-09 09:20:01','2023-05-09 09:20:01',NULL,50),(50,'2023-05-10 16:36:34','2023-05-10 16:36:34',NULL,50),(51,'2023-05-12 17:12:38','2023-05-12 17:12:38',NULL,50),(52,'2023-05-15 09:42:41','2023-05-15 09:42:41',NULL,50),(53,'2023-05-15 11:44:59','2023-05-15 11:44:59',NULL,50),(54,'2023-05-15 12:20:53','2023-05-15 12:20:53',NULL,50),(55,'2023-05-15 21:43:46','2023-05-15 21:43:46',NULL,50),(56,'2023-05-16 09:23:23','2023-05-16 09:23:23',NULL,50),(57,'2023-05-16 09:25:08','2023-05-16 09:25:08',NULL,50),(58,'2023-05-16 09:27:13','2023-05-16 09:27:13',NULL,50),(59,'2023-05-16 11:58:16','2023-05-16 11:58:16',NULL,50),(60,'2023-05-16 12:02:26','2023-05-16 12:02:26',NULL,50),(61,'2023-05-16 12:08:28','2023-05-16 12:08:28',NULL,50),(62,'2023-05-16 17:48:11','2023-05-16 17:48:11',NULL,50),(63,'2023-05-16 19:11:28','2023-05-16 19:11:28',NULL,50),(64,'2023-05-19 11:36:51','2023-05-19 11:36:51',NULL,50),(65,'2023-05-21 03:31:08','2023-05-21 03:31:08',NULL,50),(66,'2023-05-21 03:31:59','2023-05-21 03:31:59',NULL,50),(67,'2023-05-21 03:33:48','2023-05-21 03:33:48',NULL,50),(68,'2023-05-21 03:37:51','2023-05-21 03:37:51',NULL,50),(69,'2023-05-22 09:08:18','2023-05-22 09:08:18',NULL,50),(70,'2023-05-24 17:10:31','2023-05-24 17:10:31',NULL,50),(71,'2023-05-26 01:37:01','2023-05-26 01:37:01',NULL,50),(72,'2023-05-26 01:40:12','2023-05-26 01:40:12',NULL,50),(73,'2023-05-26 01:48:44','2023-05-26 01:48:44',NULL,50),(74,'2023-05-29 17:19:10','2023-05-29 17:19:10',NULL,50),(75,'2023-05-30 02:19:16','2023-05-30 02:19:16',NULL,50),(76,'2023-05-30 04:25:00','2023-05-30 04:25:00',NULL,50),(77,'2023-05-30 09:24:01','2023-05-30 09:24:01',NULL,50),(78,'2023-05-30 17:43:14','2023-05-30 17:43:14',NULL,50),(79,'2023-05-31 09:05:53','2023-05-31 09:05:53',NULL,50),(80,'2023-06-02 18:14:47','2023-06-02 18:14:47',NULL,50),(81,'2023-06-06 16:41:25','2023-06-06 16:41:25',NULL,50),(82,'2023-06-06 17:06:54','2023-06-06 17:06:54',NULL,50);
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `container_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sip_port` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rtp_ports` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trial_mode` tinyint(1) NOT NULL,
  `plan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auto_recharge` tinyint(1) NOT NULL,
  `auto_recharge_top_up` int NOT NULL,
  `call_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reserved_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `network_device` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `reserved_private_ip` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ip_private` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `invoices_by_email` tinyint(1) NOT NULL,
  `billing_package` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'gold',
  `last_login` datetime DEFAULT NULL,
  `email_verify_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_reminded` datetime DEFAULT NULL,
  `ip_whitelist_disabled` tinyint(1) NOT NULL DEFAULT '1',
  `address_line_1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `linked_paypal` tinyint(1) NOT NULL,
  `free_trial_started` datetime NOT NULL,
  `free_trial_reminder_sent` tinyint(1) NOT NULL DEFAULT '0',
  `office_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `job_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `needs_password_set` tinyint(1) NOT NULL DEFAULT '0',
  `needs_set_password_date` datetime NOT NULL,
  `pending_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `2fa_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `secret_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `recovery_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `2fa_enabled` smallint DEFAULT '0',
  `enable_2fa` smallint DEFAULT '0',
  `type_of_2fa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `secret_code_2fa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `recovery_code_2fa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `theme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'light',
  `external_app_user` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_number_unique` (`mobile_number`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (214,'Admin User','admin_user','support@lineblocs.com','$2y$10$6LNYI99DCqT1VsPJ8/Stwe/lKlGQ1hcyr4TuIw/DYxmBIE71G0M7m','ecf4cbd9a8c9c75c4b872060075fe36f',1,1,NULL,'2023-06-06 18:29:48','2023-06-06 18:29:48',NULL,'','','cus_HPMybdGfNCjbIl','','','','','',0,'ultimate',0,0,'','ADMIN',NULL,'',NULL,NULL,'ca-central-1',0,'gold',NULL,'',0,NULL,1,'','','','','','',0,'0000-00-00 00:00:00',0,'ADMIN','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL),(215,'Test User','test_user','user@lineblocs.com','$2y$10$hWK/igtpe6rxilxrVGyn1uUAGTItmECCvM65xIXZy.73h4.pnJbNC','af19ce3f9394347b9895244bd045d5b3',1,0,NULL,'2023-06-06 18:29:48','2023-06-06 18:29:48',NULL,'','','cus_HPMybdGfNCjbIl','','','','','',0,'ultimate',0,0,'','USER',NULL,'',NULL,NULL,'ca-central-1',0,'gold',NULL,'',0,NULL,1,'','','','','','',0,'0000-00-00 00:00:00',0,'USER','',0,'0000-00-00 00:00:00','','','','',0,0,'','','','light',0,NULL,NULL);
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
  `issuer` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `source` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `balance` int NOT NULL,
  `card_id` int unsigned DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_credits_user_id_foreign` (`user_id`),
  KEY `users_credits_card_id_foreign` (`card_id`),
  CONSTRAINT `users_credits_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `users_cards` (`id`),
  CONSTRAINT `users_credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_credits`
--

LOCK TABLES `users_credits` WRITE;
/*!40000 ALTER TABLE `users_credits` DISABLE KEYS */;
INSERT INTO `users_credits` VALUES (1,'2023-01-03 23:13:54','2023-01-03 23:13:54',NULL,500.00,'',0,NULL,'approved'),(2,'2023-01-03 23:15:08','2023-01-03 23:15:08',NULL,500.00,'',0,NULL,'approved'),(3,'2023-01-12 02:25:20','2023-01-12 02:25:20',NULL,500.00,'',0,NULL,'approved'),(4,'2023-01-12 02:27:05','2023-01-12 02:27:05',NULL,500.00,'',0,NULL,'approved'),(5,'2023-01-20 07:16:26','2023-01-20 07:16:26',NULL,500.00,'',0,NULL,'approved'),(6,'2023-03-02 03:19:45','2023-03-02 03:19:45',NULL,500.00,'',0,NULL,'approved'),(7,'2023-03-02 03:24:25','2023-03-02 03:24:25',NULL,500.00,'',0,NULL,'approved'),(8,'2023-03-02 03:43:15','2023-03-02 03:43:15',NULL,500.00,'',0,NULL,'approved'),(9,'2023-03-02 16:11:04','2023-03-02 16:11:04',NULL,500.00,'',0,NULL,'approved'),(10,'2023-03-16 20:31:49','2023-03-16 20:31:49',NULL,500.00,'',0,NULL,'approved'),(11,'2023-03-16 20:37:32','2023-03-16 20:37:32',NULL,500.00,'',0,NULL,'approved'),(12,'2023-03-17 10:46:07','2023-03-17 10:46:07',NULL,500.00,'',0,NULL,'approved'),(13,'2023-03-17 10:47:54','2023-03-17 10:47:54',NULL,500.00,'',0,NULL,'approved'),(14,'2023-03-17 10:50:52','2023-03-17 10:50:52',NULL,500.00,'',0,NULL,'approved'),(15,'2023-03-17 10:57:19','2023-03-17 10:57:19',NULL,500.00,'',0,NULL,'approved'),(16,'2023-03-17 21:45:01','2023-03-17 21:45:01',NULL,500.00,'',0,NULL,'approved'),(17,'2023-03-28 18:03:55','2023-03-28 18:03:55',NULL,500.00,'',0,NULL,'approved'),(18,'2023-03-31 20:45:07','2023-03-31 20:45:07',NULL,500.00,'',0,NULL,'approved'),(19,'2023-04-02 05:30:02','2023-04-02 05:30:02',NULL,500.00,'',0,NULL,'approved'),(20,'2023-04-03 16:39:51','2023-04-03 16:39:51',NULL,500.00,'',0,NULL,'approved'),(21,'2023-04-03 16:43:49','2023-04-03 16:43:49',NULL,500.00,'',0,NULL,'approved'),(22,'2023-04-03 16:45:50','2023-04-03 16:45:50',NULL,500.00,'',0,NULL,'approved'),(23,'2023-04-03 16:45:58','2023-04-03 16:45:58',NULL,500.00,'',0,NULL,'approved'),(24,'2023-04-03 16:50:14','2023-04-03 16:50:14',NULL,500.00,'',0,NULL,'approved'),(25,'2023-04-04 11:11:42','2023-04-04 11:11:42',NULL,500.00,'',0,NULL,'approved'),(26,'2023-04-04 17:19:22','2023-04-04 17:19:22',NULL,500.00,'',0,NULL,'approved'),(27,'2023-04-05 10:47:07','2023-04-05 10:47:08',NULL,500.00,'',0,NULL,'approved'),(28,'2023-04-12 10:36:15','2023-04-12 10:36:15',NULL,500.00,'',0,NULL,'approved'),(29,'2023-04-12 12:50:16','2023-04-12 12:50:16',NULL,500.00,'',0,NULL,'approved'),(30,'2023-04-14 12:19:44','2023-04-14 12:19:44',NULL,500.00,'',0,NULL,'approved'),(31,'2023-04-18 10:18:14','2023-04-18 10:18:14',NULL,500.00,'',0,NULL,'approved'),(32,'2023-04-24 05:07:54','2023-04-24 05:07:54',NULL,500.00,'',0,NULL,'approved'),(33,'2023-04-24 06:08:11','2023-04-24 06:08:11',NULL,500.00,'',0,NULL,'approved'),(34,'2023-04-25 09:38:15','2023-04-25 09:38:15',NULL,500.00,'',0,NULL,'approved'),(35,'2023-04-27 21:14:35','2023-04-27 21:14:35',NULL,500.00,'',0,NULL,'approved'),(36,'2023-04-28 10:34:27','2023-04-28 10:34:27',NULL,500.00,'',0,NULL,'approved'),(37,'2023-04-29 03:32:08','2023-04-29 03:32:08',NULL,500.00,'',0,NULL,'approved'),(38,'2023-04-29 03:39:54','2023-04-29 03:39:54',NULL,500.00,'',0,NULL,'approved'),(39,'2023-05-01 04:01:17','2023-05-01 04:01:17',NULL,500.00,'',0,NULL,'approved'),(40,'2023-05-01 16:16:55','2023-05-01 16:16:55',NULL,500.00,'',0,NULL,'approved'),(41,'2023-05-01 16:58:05','2023-05-01 16:58:05',NULL,500.00,'',0,NULL,'approved'),(42,'2023-05-01 20:51:20','2023-05-01 20:51:20',NULL,500.00,'',0,NULL,'approved'),(43,'2023-05-02 18:08:29','2023-05-02 18:08:29',NULL,500.00,'',0,NULL,'approved'),(44,'2023-05-02 18:36:35','2023-05-02 18:36:35',NULL,500.00,'',0,NULL,'approved'),(45,'2023-05-03 17:10:41','2023-05-03 17:10:41',NULL,500.00,'',0,NULL,'approved'),(46,'2023-05-04 21:14:03','2023-05-04 21:14:03',NULL,500.00,'',0,NULL,'approved'),(47,'2023-05-04 21:21:54','2023-05-04 21:21:54',NULL,500.00,'',0,NULL,'approved'),(48,'2023-05-09 09:20:01','2023-05-09 09:20:01',NULL,500.00,'',0,NULL,'approved'),(49,'2023-05-10 16:36:34','2023-05-10 16:36:34',NULL,500.00,'',0,NULL,'approved'),(50,'2023-05-12 17:12:38','2023-05-12 17:12:38',NULL,500.00,'',0,NULL,'approved'),(51,'2023-05-15 09:42:41','2023-05-15 09:42:41',NULL,500.00,'',0,NULL,'approved'),(52,'2023-05-15 11:44:59','2023-05-15 11:44:59',NULL,500.00,'',0,NULL,'approved'),(53,'2023-05-15 12:20:53','2023-05-15 12:20:53',NULL,500.00,'',0,NULL,'approved'),(54,'2023-05-15 21:43:46','2023-05-15 21:43:46',NULL,500.00,'',0,NULL,'approved'),(55,'2023-05-16 09:23:23','2023-05-16 09:23:23',NULL,500.00,'',0,NULL,'approved'),(56,'2023-05-16 09:25:08','2023-05-16 09:25:08',NULL,500.00,'',0,NULL,'approved'),(57,'2023-05-16 09:27:13','2023-05-16 09:27:13',NULL,500.00,'',0,NULL,'approved'),(58,'2023-05-16 11:58:16','2023-05-16 11:58:16',NULL,500.00,'',0,NULL,'approved'),(59,'2023-05-16 12:02:26','2023-05-16 12:02:26',NULL,500.00,'',0,NULL,'approved'),(60,'2023-05-16 12:08:28','2023-05-16 12:08:28',NULL,500.00,'',0,NULL,'approved'),(61,'2023-05-16 17:33:30','2023-05-16 17:33:30',NULL,500.00,'',0,NULL,'approved'),(62,'2023-05-16 17:34:18','2023-05-16 17:34:18',NULL,500.00,'',0,NULL,'approved'),(63,'2023-05-16 17:37:17','2023-05-16 17:37:17',NULL,500.00,'',0,NULL,'approved'),(64,'2023-05-16 17:40:35','2023-05-16 17:40:35',NULL,500.00,'',0,NULL,'approved'),(65,'2023-05-16 17:48:11','2023-05-16 17:48:11',NULL,500.00,'',0,NULL,'approved'),(66,'2023-05-16 19:11:28','2023-05-16 19:11:28',NULL,500.00,'',0,NULL,'approved'),(67,'2023-05-19 11:36:51','2023-05-19 11:36:51',NULL,1000.00,'',0,NULL,'approved'),(68,'2023-05-21 03:31:08','2023-05-21 03:31:08',NULL,1000.00,'',0,NULL,'approved'),(69,'2023-05-21 03:31:59','2023-05-21 03:31:59',NULL,1000.00,'',0,NULL,'approved'),(70,'2023-05-21 03:33:48','2023-05-21 03:33:48',NULL,1000.00,'',0,NULL,'approved'),(71,'2023-05-21 03:37:51','2023-05-21 03:37:51',NULL,1000.00,'',0,NULL,'approved'),(72,'2023-05-22 09:08:18','2023-05-22 09:08:18',NULL,1000.00,'',0,NULL,'approved'),(73,'2023-05-24 17:10:31','2023-05-24 17:10:31',NULL,1000.00,'',0,NULL,'approved'),(74,'2023-05-26 01:37:01','2023-05-26 01:37:01',NULL,1000.00,'',0,NULL,'approved'),(75,'2023-05-26 01:40:12','2023-05-26 01:40:12',NULL,1000.00,'',0,NULL,'approved'),(76,'2023-05-26 01:48:44','2023-05-26 01:48:44',NULL,1000.00,'',0,NULL,'approved'),(77,'2023-05-29 17:19:10','2023-05-29 17:19:10',NULL,1000.00,'',0,NULL,'approved'),(78,'2023-05-30 02:19:16','2023-05-30 02:19:16',NULL,1000.00,'',0,NULL,'approved'),(79,'2023-05-30 04:25:00','2023-05-30 04:25:00',NULL,1000.00,'',0,NULL,'approved'),(80,'2023-05-30 09:24:01','2023-05-30 09:24:01',NULL,1000.00,'',0,NULL,'approved'),(81,'2023-05-30 17:43:14','2023-05-30 17:43:14',NULL,1000.00,'',0,NULL,'approved'),(82,'2023-05-31 09:05:53','2023-05-31 09:05:53',NULL,1000.00,'',0,NULL,'approved'),(83,'2023-06-02 18:14:47','2023-06-02 18:14:47',NULL,1000.00,'',0,NULL,'approved'),(84,'2023-06-06 16:41:25','2023-06-06 16:41:25',NULL,0.00,'',0,NULL,'approved'),(85,'2023-06-06 17:06:54','2023-06-06 17:06:54',NULL,0.00,'',0,NULL,'approved');
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
  `source` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `balance` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `module_id` int DEFAULT NULL,
  `plan_snapshot` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `user_agent` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trusted` tinyint(1) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `users_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_devices`
--

LOCK TABLES `users_devices` WRITE;
/*!40000 ALTER TABLE `users_devices` DISABLE KEYS */;
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
  `source` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `cents_including_taxes` double(8,2) NOT NULL,
  `tax_metadata` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `cents_taxes` double(8,2) DEFAULT '0.00',
  `invoice_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `users_invoices_user_id_foreign` (`user_id`),
  KEY `users_invoices_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `users_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_invoices_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_invoices`
--

LOCK TABLES `users_invoices` WRITE;
/*!40000 ALTER TABLE `users_invoices` DISABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cents` double(8,2) NOT NULL DEFAULT '0.00',
  `invoice_id` int unsigned DEFAULT NULL,
  `key_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `users_invoices_line_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `users_invoices_line_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `users_invoices` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_invoices_line_items`
--

LOCK TABLES `users_invoices_line_items` WRITE;
/*!40000 ALTER TABLE `users_invoices_line_items` DISABLE KEYS */;
INSERT INTO `users_invoices_line_items` VALUES (1,'2023-05-04 23:38:11','2023-05-04 23:38:11',0,'Call costs',2000.00,NULL,'call_costs'),(2,'2023-05-04 23:38:11','2023-05-04 23:38:11',0,'Recording costs',2000.00,NULL,'recording_costs'),(3,'2023-05-04 23:38:11','2023-05-04 23:38:11',0,'Fax costs',2000.00,NULL,'fax_costs'),(4,'2023-05-04 23:38:11','2023-05-04 23:38:11',1,'Membership costs',2000.00,NULL,'membership_costs'),(5,'2023-05-04 23:38:11','2023-05-04 23:38:11',1,'Number costs',2000.00,NULL,'number_costs'),(6,'2023-05-04 23:39:01','2023-05-04 23:39:01',0,'Call costs',2000.00,NULL,'call_costs'),(7,'2023-05-04 23:39:01','2023-05-04 23:39:01',0,'Recording costs',2000.00,NULL,'recording_costs'),(8,'2023-05-04 23:39:01','2023-05-04 23:39:01',0,'Fax costs',2000.00,NULL,'fax_costs'),(9,'2023-05-04 23:39:01','2023-05-04 23:39:01',1,'Membership costs',2000.00,NULL,'membership_costs'),(10,'2023-05-04 23:39:01','2023-05-04 23:39:01',1,'Number costs',2000.00,NULL,'number_costs'),(11,'2023-05-04 23:39:14','2023-05-04 23:39:14',0,'Call costs',2000.00,NULL,'call_costs'),(12,'2023-05-04 23:39:14','2023-05-04 23:39:14',0,'Recording costs',2000.00,NULL,'recording_costs'),(13,'2023-05-04 23:39:14','2023-05-04 23:39:14',0,'Fax costs',2000.00,NULL,'fax_costs'),(14,'2023-05-04 23:39:14','2023-05-04 23:39:14',1,'Membership costs',2000.00,NULL,'membership_costs'),(15,'2023-05-04 23:39:14','2023-05-04 23:39:14',1,'Number costs',2000.00,NULL,'number_costs'),(16,'2023-05-04 23:39:37','2023-05-04 23:39:37',0,'Call costs',2000.00,NULL,'call_costs'),(17,'2023-05-04 23:39:37','2023-05-04 23:39:37',0,'Recording costs',2000.00,NULL,'recording_costs'),(18,'2023-05-04 23:39:37','2023-05-04 23:39:37',0,'Fax costs',2000.00,NULL,'fax_costs'),(19,'2023-05-04 23:39:37','2023-05-04 23:39:37',1,'Membership costs',2000.00,NULL,'membership_costs'),(20,'2023-05-04 23:39:37','2023-05-04 23:39:37',1,'Number costs',2000.00,NULL,'number_costs'),(21,'2023-05-04 23:40:00','2023-05-04 23:40:00',0,'Call costs',2000.00,NULL,'call_costs'),(22,'2023-05-04 23:40:00','2023-05-04 23:40:00',0,'Recording costs',2000.00,NULL,'recording_costs'),(23,'2023-05-04 23:40:00','2023-05-04 23:40:00',0,'Fax costs',2000.00,NULL,'fax_costs'),(24,'2023-05-04 23:40:00','2023-05-04 23:40:00',1,'Membership costs',2000.00,NULL,'membership_costs'),(25,'2023-05-04 23:40:00','2023-05-04 23:40:00',1,'Number costs',2000.00,NULL,'number_costs'),(26,'2023-05-05 00:24:37','2023-05-05 00:24:37',0,'Call costs',2000.00,NULL,'call_costs'),(27,'2023-05-05 00:24:37','2023-05-05 00:24:37',0,'Recording costs',2000.00,NULL,'recording_costs'),(28,'2023-05-05 00:24:37','2023-05-05 00:24:37',0,'Fax costs',2000.00,NULL,'fax_costs'),(29,'2023-05-05 00:24:37','2023-05-05 00:24:37',1,'Membership costs',2000.00,NULL,'membership_costs'),(30,'2023-05-05 00:24:37','2023-05-05 00:24:37',1,'Number costs',2000.00,NULL,'number_costs'),(31,'2023-05-05 00:25:05','2023-05-05 00:25:05',0,'Call costs',2000.00,NULL,'call_costs'),(32,'2023-05-05 00:25:05','2023-05-05 00:25:05',0,'Recording costs',2000.00,NULL,'recording_costs'),(33,'2023-05-05 00:25:05','2023-05-05 00:25:05',0,'Fax costs',2000.00,NULL,'fax_costs'),(34,'2023-05-05 00:25:05','2023-05-05 00:25:05',1,'Membership costs',2000.00,NULL,'membership_costs'),(35,'2023-05-05 00:25:05','2023-05-05 00:25:05',1,'Number costs',2000.00,NULL,'number_costs'),(36,'2023-05-05 00:28:09','2023-05-05 00:28:09',0,'Call costs',2000.00,NULL,'call_costs'),(37,'2023-05-05 00:28:09','2023-05-05 00:28:09',0,'Recording costs',2000.00,NULL,'recording_costs'),(38,'2023-05-05 00:28:09','2023-05-05 00:28:09',0,'Fax costs',2000.00,NULL,'fax_costs'),(39,'2023-05-05 00:28:09','2023-05-05 00:28:09',1,'Membership costs',2000.00,NULL,'membership_costs'),(40,'2023-05-05 00:28:09','2023-05-05 00:28:09',1,'Number costs',2000.00,NULL,'number_costs'),(41,'2023-05-05 00:29:23','2023-05-05 00:29:23',0,'Call costs',2000.00,NULL,'call_costs'),(42,'2023-05-05 00:29:23','2023-05-05 00:29:23',0,'Recording costs',2000.00,NULL,'recording_costs'),(43,'2023-05-05 00:29:23','2023-05-05 00:29:23',0,'Fax costs',2000.00,NULL,'fax_costs'),(44,'2023-05-05 00:29:23','2023-05-05 00:29:23',1,'Membership costs',2000.00,NULL,'membership_costs'),(45,'2023-05-05 00:29:23','2023-05-05 00:29:23',1,'Number costs',2000.00,NULL,'number_costs'),(46,'2023-05-05 00:30:24','2023-05-05 00:30:24',0,'Call costs',2000.00,NULL,'call_costs'),(47,'2023-05-05 00:30:24','2023-05-05 00:30:24',0,'Recording costs',2000.00,NULL,'recording_costs'),(48,'2023-05-05 00:30:24','2023-05-05 00:30:24',0,'Fax costs',2000.00,NULL,'fax_costs'),(49,'2023-05-05 00:30:24','2023-05-05 00:30:24',1,'Membership costs',2000.00,NULL,'membership_costs'),(50,'2023-05-05 00:30:24','2023-05-05 00:30:24',1,'Number costs',2000.00,NULL,'number_costs'),(51,'2023-05-05 00:30:52','2023-05-05 00:30:52',0,'Call costs',2000.00,NULL,'call_costs'),(52,'2023-05-05 00:30:52','2023-05-05 00:30:52',0,'Recording costs',2000.00,NULL,'recording_costs'),(53,'2023-05-05 00:30:52','2023-05-05 00:30:52',0,'Fax costs',2000.00,NULL,'fax_costs'),(54,'2023-05-05 00:30:52','2023-05-05 00:30:52',1,'Membership costs',2000.00,NULL,'membership_costs'),(55,'2023-05-05 00:30:52','2023-05-05 00:30:52',1,'Number costs',2000.00,NULL,'number_costs'),(56,'2023-05-05 00:32:36','2023-05-05 00:32:36',0,'Call costs',2000.00,NULL,'call_costs'),(57,'2023-05-05 00:32:36','2023-05-05 00:32:36',0,'Recording costs',2000.00,NULL,'recording_costs'),(58,'2023-05-05 00:32:36','2023-05-05 00:32:36',0,'Fax costs',2000.00,NULL,'fax_costs'),(59,'2023-05-05 00:32:36','2023-05-05 00:32:36',1,'Membership costs',2000.00,NULL,'membership_costs'),(60,'2023-05-05 00:32:36','2023-05-05 00:32:36',1,'Number costs',2000.00,NULL,'number_costs'),(61,'2023-05-05 00:35:51','2023-05-05 00:35:51',0,'Call costs',2000.00,NULL,'call_costs'),(62,'2023-05-05 00:35:51','2023-05-05 00:35:51',0,'Recording costs',2000.00,NULL,'recording_costs'),(63,'2023-05-05 00:35:51','2023-05-05 00:35:51',0,'Fax costs',2000.00,NULL,'fax_costs'),(64,'2023-05-05 00:35:51','2023-05-05 00:35:51',1,'Membership costs',2000.00,NULL,'membership_costs'),(65,'2023-05-05 00:35:51','2023-05-05 00:35:51',1,'Number costs',2000.00,NULL,'number_costs'),(66,'2023-05-05 00:38:53','2023-05-05 00:38:53',0,'Call costs',2000.00,NULL,'call_costs'),(67,'2023-05-05 00:38:53','2023-05-05 00:38:53',0,'Recording costs',2000.00,NULL,'recording_costs'),(68,'2023-05-05 00:38:53','2023-05-05 00:38:53',0,'Fax costs',2000.00,NULL,'fax_costs'),(69,'2023-05-05 00:38:53','2023-05-05 00:38:53',1,'Membership costs',2000.00,NULL,'membership_costs'),(70,'2023-05-05 00:38:53','2023-05-05 00:38:53',1,'Number costs',2000.00,NULL,'number_costs'),(71,'2023-05-05 00:42:14','2023-05-05 00:42:14',0,'Call costs',2000.00,NULL,'call_costs'),(72,'2023-05-05 00:42:14','2023-05-05 00:42:14',0,'Recording costs',2000.00,NULL,'recording_costs'),(73,'2023-05-05 00:42:14','2023-05-05 00:42:14',0,'Fax costs',2000.00,NULL,'fax_costs'),(74,'2023-05-05 00:42:14','2023-05-05 00:42:14',1,'Membership costs',2000.00,NULL,'membership_costs'),(75,'2023-05-05 00:42:14','2023-05-05 00:42:14',1,'Number costs',2000.00,NULL,'number_costs'),(76,'2023-05-05 00:42:25','2023-05-05 00:42:25',0,'Call costs',2000.00,NULL,'call_costs'),(77,'2023-05-05 00:42:25','2023-05-05 00:42:25',0,'Recording costs',2000.00,NULL,'recording_costs'),(78,'2023-05-05 00:42:25','2023-05-05 00:42:25',0,'Fax costs',2000.00,NULL,'fax_costs'),(79,'2023-05-05 00:42:25','2023-05-05 00:42:25',1,'Membership costs',2000.00,NULL,'membership_costs'),(80,'2023-05-05 00:42:25','2023-05-05 00:42:25',1,'Number costs',2000.00,NULL,'number_costs'),(81,'2023-05-05 00:42:32','2023-05-05 00:42:32',0,'Call costs',2000.00,NULL,'call_costs'),(82,'2023-05-05 00:42:32','2023-05-05 00:42:32',0,'Recording costs',2000.00,NULL,'recording_costs'),(83,'2023-05-05 00:42:32','2023-05-05 00:42:32',0,'Fax costs',2000.00,NULL,'fax_costs'),(84,'2023-05-05 00:42:32','2023-05-05 00:42:32',1,'Membership costs',2000.00,NULL,'membership_costs'),(85,'2023-05-05 00:42:32','2023-05-05 00:42:32',1,'Number costs',2000.00,NULL,'number_costs'),(86,'2023-05-05 00:43:12','2023-05-05 00:43:12',0,'Call costs',2000.00,NULL,'call_costs'),(87,'2023-05-05 00:43:12','2023-05-05 00:43:12',0,'Recording costs',2000.00,NULL,'recording_costs'),(88,'2023-05-05 00:43:12','2023-05-05 00:43:12',0,'Fax costs',2000.00,NULL,'fax_costs'),(89,'2023-05-05 00:43:12','2023-05-05 00:43:12',1,'Membership costs',2000.00,NULL,'membership_costs'),(90,'2023-05-05 00:43:12','2023-05-05 00:43:12',1,'Number costs',2000.00,NULL,'number_costs'),(91,'2023-05-05 00:47:53','2023-05-05 00:47:53',0,'Call costs',2000.00,NULL,'call_costs'),(92,'2023-05-05 00:47:53','2023-05-05 00:47:53',0,'Recording costs',2000.00,NULL,'recording_costs'),(93,'2023-05-05 00:47:53','2023-05-05 00:47:53',0,'Fax costs',2000.00,NULL,'fax_costs'),(94,'2023-05-05 00:47:53','2023-05-05 00:47:53',1,'Membership costs',2000.00,NULL,'membership_costs'),(95,'2023-05-05 00:47:53','2023-05-05 00:47:53',1,'Number costs',2000.00,NULL,'number_costs'),(96,'2023-05-05 00:48:08','2023-05-05 00:48:08',0,'Call costs',2000.00,NULL,'call_costs'),(97,'2023-05-05 00:48:08','2023-05-05 00:48:08',0,'Recording costs',2000.00,NULL,'recording_costs'),(98,'2023-05-05 00:48:08','2023-05-05 00:48:08',0,'Fax costs',2000.00,NULL,'fax_costs'),(99,'2023-05-05 00:48:08','2023-05-05 00:48:08',1,'Membership costs',2000.00,NULL,'membership_costs'),(100,'2023-05-05 00:48:08','2023-05-05 00:48:08',1,'Number costs',2000.00,NULL,'number_costs'),(101,'2023-05-05 00:51:23','2023-05-05 00:51:23',0,'Call costs',2000.00,NULL,'call_costs'),(102,'2023-05-05 00:51:23','2023-05-05 00:51:23',0,'Recording costs',2000.00,NULL,'recording_costs'),(103,'2023-05-05 00:51:23','2023-05-05 00:51:23',0,'Fax costs',2000.00,NULL,'fax_costs'),(104,'2023-05-05 00:51:23','2023-05-05 00:51:23',1,'Membership costs',2000.00,NULL,'membership_costs'),(105,'2023-05-05 00:51:23','2023-05-05 00:51:23',1,'Number costs',2000.00,NULL,'number_costs'),(106,'2023-05-05 01:10:58','2023-05-05 01:10:58',0,'Call costs',2000.00,NULL,'call_costs'),(107,'2023-05-05 01:10:58','2023-05-05 01:10:58',0,'Recording costs',2000.00,NULL,'recording_costs'),(108,'2023-05-05 01:10:58','2023-05-05 01:10:58',0,'Fax costs',2000.00,NULL,'fax_costs'),(109,'2023-05-05 01:10:58','2023-05-05 01:10:58',1,'Membership costs',2000.00,NULL,'membership_costs'),(110,'2023-05-05 01:10:58','2023-05-05 01:10:58',1,'Number costs',2000.00,NULL,'number_costs'),(111,'2023-05-05 01:12:16','2023-05-05 01:12:16',0,'Call costs',2000.00,NULL,'call_costs'),(112,'2023-05-05 01:12:16','2023-05-05 01:12:16',0,'Recording costs',2000.00,NULL,'recording_costs'),(113,'2023-05-05 01:12:16','2023-05-05 01:12:16',0,'Fax costs',2000.00,NULL,'fax_costs'),(114,'2023-05-05 01:12:16','2023-05-05 01:12:16',1,'Membership costs',2000.00,NULL,'membership_costs'),(115,'2023-05-05 01:12:16','2023-05-05 01:12:16',1,'Number costs',2000.00,NULL,'number_costs'),(116,'2023-05-05 01:12:25','2023-05-05 01:12:25',0,'Call costs',2000.00,NULL,'call_costs'),(117,'2023-05-05 01:12:25','2023-05-05 01:12:25',0,'Recording costs',2000.00,NULL,'recording_costs'),(118,'2023-05-05 01:12:25','2023-05-05 01:12:25',0,'Fax costs',2000.00,NULL,'fax_costs'),(119,'2023-05-05 01:12:25','2023-05-05 01:12:25',1,'Membership costs',2000.00,NULL,'membership_costs'),(120,'2023-05-05 01:12:25','2023-05-05 01:12:25',1,'Number costs',2000.00,NULL,'number_costs'),(121,'2023-05-05 01:13:56','2023-05-05 01:13:56',0,'Call costs',2000.00,NULL,'call_costs'),(122,'2023-05-05 01:13:56','2023-05-05 01:13:56',0,'Recording costs',2000.00,NULL,'recording_costs'),(123,'2023-05-05 01:13:56','2023-05-05 01:13:56',0,'Fax costs',2000.00,NULL,'fax_costs'),(124,'2023-05-05 01:13:56','2023-05-05 01:13:56',1,'Membership costs',2000.00,NULL,'membership_costs'),(125,'2023-05-05 01:13:56','2023-05-05 01:13:56',1,'Number costs',2000.00,NULL,'number_costs'),(126,'2023-05-05 01:14:38','2023-05-05 01:14:38',0,'Call costs',2000.00,NULL,'call_costs'),(127,'2023-05-05 01:14:38','2023-05-05 01:14:38',0,'Recording costs',2000.00,NULL,'recording_costs'),(128,'2023-05-05 01:14:38','2023-05-05 01:14:38',0,'Fax costs',2000.00,NULL,'fax_costs'),(129,'2023-05-05 01:14:38','2023-05-05 01:14:38',1,'Membership costs',2000.00,NULL,'membership_costs'),(130,'2023-05-05 01:14:38','2023-05-05 01:14:38',1,'Number costs',2000.00,NULL,'number_costs'),(131,'2023-05-05 01:15:59','2023-05-05 01:15:59',0,'Call costs',2000.00,NULL,'call_costs'),(132,'2023-05-05 01:15:59','2023-05-05 01:15:59',0,'Recording costs',2000.00,NULL,'recording_costs'),(133,'2023-05-05 01:15:59','2023-05-05 01:15:59',0,'Fax costs',2000.00,NULL,'fax_costs'),(134,'2023-05-05 01:15:59','2023-05-05 01:15:59',1,'Membership costs',2000.00,NULL,'membership_costs'),(135,'2023-05-05 01:15:59','2023-05-05 01:15:59',1,'Number costs',2000.00,NULL,'number_costs'),(136,'2023-05-05 01:51:06','2023-05-05 01:51:06',0,'Call costs',2000.00,NULL,'call_costs'),(137,'2023-05-05 01:51:06','2023-05-05 01:51:06',0,'Recording costs',2000.00,NULL,'recording_costs'),(138,'2023-05-05 01:51:06','2023-05-05 01:51:06',0,'Fax costs',2000.00,NULL,'fax_costs'),(139,'2023-05-05 01:51:06','2023-05-05 01:51:06',1,'Membership costs',2000.00,NULL,'membership_costs'),(140,'2023-05-05 01:51:06','2023-05-05 01:51:06',1,'Number costs',2000.00,NULL,'number_costs'),(141,'2023-05-05 01:51:23','2023-05-05 01:51:23',0,'Call costs',2000.00,NULL,'call_costs'),(142,'2023-05-05 01:51:23','2023-05-05 01:51:23',0,'Recording costs',2000.00,NULL,'recording_costs'),(143,'2023-05-05 01:51:23','2023-05-05 01:51:23',0,'Fax costs',2000.00,NULL,'fax_costs'),(144,'2023-05-05 01:51:23','2023-05-05 01:51:23',1,'Membership costs',2000.00,NULL,'membership_costs'),(145,'2023-05-05 01:51:23','2023-05-05 01:51:23',1,'Number costs',2000.00,NULL,'number_costs'),(146,'2023-05-05 01:54:05','2023-05-05 01:54:05',0,'Call costs',2000.00,NULL,'call_costs'),(147,'2023-05-05 01:54:05','2023-05-05 01:54:05',0,'Recording costs',2000.00,NULL,'recording_costs'),(148,'2023-05-05 01:54:05','2023-05-05 01:54:05',0,'Fax costs',2000.00,NULL,'fax_costs'),(149,'2023-05-05 01:54:05','2023-05-05 01:54:05',1,'Membership costs',2000.00,NULL,'membership_costs'),(150,'2023-05-05 01:54:05','2023-05-05 01:54:05',1,'Number costs',2000.00,NULL,'number_costs'),(151,'2023-05-05 01:55:48','2023-05-05 01:55:48',0,'Call costs',2000.00,NULL,'call_costs'),(152,'2023-05-05 01:55:48','2023-05-05 01:55:48',0,'Recording costs',2000.00,NULL,'recording_costs'),(153,'2023-05-05 01:55:48','2023-05-05 01:55:48',0,'Fax costs',2000.00,NULL,'fax_costs'),(154,'2023-05-05 01:55:48','2023-05-05 01:55:48',1,'Membership costs',2000.00,NULL,'membership_costs'),(155,'2023-05-05 01:55:48','2023-05-05 01:55:48',1,'Number costs',2000.00,NULL,'number_costs'),(156,'2023-05-05 01:56:49','2023-05-05 01:56:49',0,'Call costs',2000.00,NULL,'call_costs'),(157,'2023-05-05 01:58:42','2023-05-05 01:58:42',0,'Call costs',2000.00,NULL,'call_costs'),(158,'2023-05-05 01:59:07','2023-05-05 01:59:07',0,'Call costs',2000.00,NULL,'call_costs'),(159,'2023-05-05 01:59:07','2023-05-05 01:59:07',0,'Recording costs',2000.00,NULL,'recording_costs'),(160,'2023-05-05 01:59:07','2023-05-05 01:59:07',0,'Fax costs',2000.00,NULL,'fax_costs'),(161,'2023-05-05 01:59:07','2023-05-05 01:59:07',1,'Membership costs',2000.00,NULL,'membership_costs'),(162,'2023-05-05 01:59:07','2023-05-05 01:59:07',1,'Number costs',2000.00,NULL,'number_costs'),(163,'2023-05-05 01:59:58','2023-05-05 01:59:58',0,'Call costs',2000.00,NULL,'call_costs'),(164,'2023-05-05 01:59:58','2023-05-05 01:59:58',0,'Recording costs',2000.00,NULL,'recording_costs'),(165,'2023-05-05 01:59:58','2023-05-05 01:59:58',0,'Fax costs',2000.00,NULL,'fax_costs'),(166,'2023-05-05 01:59:58','2023-05-05 01:59:58',1,'Membership costs',2000.00,NULL,'membership_costs'),(167,'2023-05-05 01:59:58','2023-05-05 01:59:58',1,'Number costs',2000.00,NULL,'number_costs'),(168,'2023-05-05 02:03:03','2023-05-05 02:03:03',0,'Call costs',2000.00,NULL,'call_costs'),(169,'2023-05-05 02:03:03','2023-05-05 02:03:03',0,'Recording costs',2000.00,NULL,'recording_costs'),(170,'2023-05-05 02:03:03','2023-05-05 02:03:03',0,'Fax costs',2000.00,NULL,'fax_costs'),(171,'2023-05-05 02:03:03','2023-05-05 02:03:03',1,'Membership costs',2000.00,NULL,'membership_costs'),(172,'2023-05-05 02:03:03','2023-05-05 02:03:03',1,'Number costs',2000.00,NULL,'number_costs'),(173,'2023-05-05 02:03:31','2023-05-05 02:03:31',0,'Call costs',2000.00,NULL,'call_costs'),(174,'2023-05-05 02:03:31','2023-05-05 02:03:31',0,'Recording costs',2000.00,NULL,'recording_costs'),(175,'2023-05-05 02:03:31','2023-05-05 02:03:31',0,'Fax costs',2000.00,NULL,'fax_costs'),(176,'2023-05-05 02:03:31','2023-05-05 02:03:31',1,'Membership costs',2000.00,NULL,'membership_costs'),(177,'2023-05-05 02:03:31','2023-05-05 02:03:31',1,'Number costs',2000.00,NULL,'number_costs'),(178,'2023-05-05 02:04:18','2023-05-05 02:04:18',0,'Call costs',2000.00,NULL,'call_costs'),(179,'2023-05-05 02:04:18','2023-05-05 02:04:18',0,'Recording costs',2000.00,NULL,'recording_costs'),(180,'2023-05-05 02:04:18','2023-05-05 02:04:18',0,'Fax costs',2000.00,NULL,'fax_costs'),(181,'2023-05-05 02:04:18','2023-05-05 02:04:18',1,'Membership costs',2000.00,NULL,'membership_costs'),(182,'2023-05-05 02:04:18','2023-05-05 02:04:18',1,'Number costs',2000.00,NULL,'number_costs'),(183,'2023-05-05 02:07:05','2023-05-05 02:07:05',0,'Call costs',2000.00,NULL,'call_costs'),(184,'2023-05-05 02:07:05','2023-05-05 02:07:05',0,'Recording costs',2000.00,NULL,'recording_costs'),(185,'2023-05-05 02:07:05','2023-05-05 02:07:05',0,'Fax costs',2000.00,NULL,'fax_costs'),(186,'2023-05-05 02:07:05','2023-05-05 02:07:05',1,'Membership costs',2000.00,NULL,'membership_costs'),(187,'2023-05-05 02:07:05','2023-05-05 02:07:05',1,'Number costs',2000.00,NULL,'number_costs'),(188,'2023-05-05 02:07:42','2023-05-05 02:07:42',0,'Call costs',2000.00,NULL,'call_costs'),(189,'2023-05-05 02:07:42','2023-05-05 02:07:42',0,'Recording costs',2000.00,NULL,'recording_costs'),(190,'2023-05-05 02:07:42','2023-05-05 02:07:42',0,'Fax costs',2000.00,NULL,'fax_costs'),(191,'2023-05-05 02:07:42','2023-05-05 02:07:42',1,'Membership costs',2000.00,NULL,'membership_costs'),(192,'2023-05-05 02:07:42','2023-05-05 02:07:42',1,'Number costs',2000.00,NULL,'number_costs');
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
  `number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `workspace_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_templates_user_id_foreign` (`user_id`),
  KEY `widget_templates_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `widget_templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `widget_templates_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_templates`
--

LOCK TABLES `widget_templates` WRITE;
/*!40000 ALTER TABLE `widget_templates` DISABLE KEYS */;
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
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `template_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `widget_templates_tags_template_id_foreign` (`template_id`),
  CONSTRAINT `widget_templates_tags_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `widget_templates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
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
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
-- Table structure for table `workspace_routing_acl`
--

DROP TABLE IF EXISTS `workspace_routing_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workspace_routing_acl` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `routing_acl_id` int unsigned DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `workspace_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workspace_routing_acl_routing_acl_id_foreign` (`routing_acl_id`),
  CONSTRAINT `workspace_routing_acl_routing_acl_id_foreign` FOREIGN KEY (`routing_acl_id`) REFERENCES `sip_routing_acl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspace_routing_acl`
--

LOCK TABLES `workspace_routing_acl` WRITE;
/*!40000 ALTER TABLE `workspace_routing_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `workspace_routing_acl` ENABLE KEYS */;
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
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `creator_id` int unsigned NOT NULL,
  `api_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `api_secret` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `byo_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `outbound_macro_id` int unsigned DEFAULT NULL,
  `ip_whitelist_disabled` tinyint(1) NOT NULL DEFAULT '1',
  `plan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pay-as-you-go',
  `trial_mode` tinyint(1) NOT NULL DEFAULT '0',
  `free_trial_started` datetime NOT NULL,
  `flow_id` int unsigned DEFAULT NULL,
  `default_region` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `plan_term` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  `external_app_workspace` tinyint(1) NOT NULL DEFAULT '0',
  `billing_country_id` int unsigned DEFAULT NULL,
  `billing_region_id` int unsigned DEFAULT NULL,
  `account_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `active` smallint DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces`
--

LOCK TABLES `workspaces` WRITE;
/*!40000 ALTER TABLE `workspaces` DISABLE KEYS */;
INSERT INTO `workspaces` VALUES (201,'2023-06-06 18:29:48','2023-06-06 18:29:48','admin',214,'b3a68cd952053f5a9303f4eefa5b1654','89bea73adacfa0becbefcdbc2be0a7271b0f48ff4093ca74a638533c1b500600',0,NULL,1,'ultimate',0,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL,'0',1),(202,'2023-06-06 18:29:48','2023-06-06 18:29:48','workspace',215,'7b4b75e6e8a090897d15439ea886ec2f','bfab970c0e1ab18df31bc77f132a6db1b766f0f775935d53c0be1fc07f913800',0,NULL,1,'ultimate',0,'0000-00-00 00:00:00',NULL,'','none',0,NULL,NULL,'0',1);
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
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `plan_snapshot` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `processed_by_billing` tinyint(1) NOT NULL DEFAULT '0',
  `plan_term` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`),
  KEY `workspaces_events_workspace_id_foreign` (`workspace_id`),
  CONSTRAINT `workspaces_events_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_events`
--

LOCK TABLES `workspaces_events` WRITE;
/*!40000 ALTER TABLE `workspaces_events` DISABLE KEYS */;
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
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workspaces_invites_workspace_id_foreign` (`workspace_id`),
  KEY `workspaces_invites_workspace_user_id_foreign` (`workspace_user_id`),
  CONSTRAINT `workspaces_invites_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workspaces_invites_workspace_user_id_foreign` FOREIGN KEY (`workspace_user_id`) REFERENCES `workspaces_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_invites`
--

LOCK TABLES `workspaces_invites` WRITE;
/*!40000 ALTER TABLE `workspaces_invites` DISABLE KEYS */;
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
  `internal_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `origin_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `dest_code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `http_url` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
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
  `public_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
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
  `hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `hash_expired` tinyint(1) NOT NULL DEFAULT '0',
  `manage_byo_carriers` tinyint(1) NOT NULL DEFAULT '0',
  `create_byo_carrier` tinyint(1) NOT NULL DEFAULT '0',
  `manage_byo_did_numbers` tinyint(1) NOT NULL DEFAULT '0',
  `create_byo_did_number` tinyint(1) NOT NULL DEFAULT '0',
  `extension_id` int unsigned DEFAULT NULL,
  `number_id` int unsigned DEFAULT NULL,
  `preferred_pop` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'ca-central-1',
  `create_trunks` tinyint(1) NOT NULL,
  `manage_trunks` tinyint(1) NOT NULL,
  `joined_at` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workspaces_users`
--

LOCK TABLES `workspaces_users` WRITE;
/*!40000 ALTER TABLE `workspaces_users` DISABLE KEYS */;
INSERT INTO `workspaces_users` VALUES (204,'2023-06-06 18:29:48','2023-06-06 18:29:48',201,214,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-c1272343-60da-4c3e-9818-f74632d9511b',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,0,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1,NULL),(205,'2023-06-06 18:29:48','2023-06-06 18:29:48',202,215,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'wu-1dcf367f-aa87-4d64-8d99-a9b18b1fddcd',1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,0,0,1,1,1,1,NULL,NULL,'ca-central-1',1,1,NULL);
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

-- Dump completed on 2023-06-06 18:29:56
