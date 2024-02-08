-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: opensips
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
-- Table structure for table `acc`
--
CREATE Database IF NOT EXISTS opensips;
USE opensips;
GRANT ALL ON `opensips`.* TO 'root_lineblocs'@'%';


DROP TABLE IF EXISTS `acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `method` char(16) NOT NULL DEFAULT '',
  `from_tag` char(64) NOT NULL DEFAULT '',
  `to_tag` char(64) NOT NULL DEFAULT '',
  `callid` char(64) NOT NULL DEFAULT '',
  `sip_code` char(3) NOT NULL DEFAULT '',
  `sip_reason` char(32) NOT NULL DEFAULT '',
  `time` datetime NOT NULL,
  `duration` int unsigned NOT NULL DEFAULT '0',
  `ms_duration` int unsigned NOT NULL DEFAULT '0',
  `setuptime` int unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc`
--

LOCK TABLES `acc` WRITE;
/*!40000 ALTER TABLE `acc` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `active_watchers`
--

DROP TABLE IF EXISTS `active_watchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `active_watchers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` char(255) NOT NULL,
  `watcher_username` char(64) NOT NULL,
  `watcher_domain` char(64) NOT NULL,
  `to_user` char(64) NOT NULL,
  `to_domain` char(64) NOT NULL,
  `event` char(64) NOT NULL DEFAULT 'presence',
  `event_id` char(64) DEFAULT NULL,
  `to_tag` char(64) NOT NULL,
  `from_tag` char(64) NOT NULL,
  `callid` char(64) NOT NULL,
  `local_cseq` int NOT NULL,
  `remote_cseq` int NOT NULL,
  `contact` char(255) NOT NULL,
  `record_route` text,
  `expires` int NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  `reason` char(64) DEFAULT NULL,
  `version` int NOT NULL DEFAULT '0',
  `socket_info` char(64) NOT NULL,
  `local_contact` char(255) NOT NULL,
  `sharing_tag` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `active_watchers_idx` (`presentity_uri`,`callid`,`to_tag`,`from_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_watchers`
--

LOCK TABLES `active_watchers` WRITE;
/*!40000 ALTER TABLE `active_watchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `active_watchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `grp` smallint unsigned NOT NULL DEFAULT '0',
  `ip` char(50) NOT NULL,
  `mask` tinyint NOT NULL DEFAULT '32',
  `port` smallint unsigned NOT NULL DEFAULT '0',
  `proto` char(4) NOT NULL DEFAULT 'any',
  `pattern` char(64) DEFAULT NULL,
  `context_info` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b2b_entities`
--

DROP TABLE IF EXISTS `b2b_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `b2b_entities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `state` int NOT NULL,
  `ruri` char(255) DEFAULT NULL,
  `from_uri` char(255) NOT NULL,
  `to_uri` char(255) NOT NULL,
  `from_dname` char(64) DEFAULT NULL,
  `to_dname` char(64) DEFAULT NULL,
  `tag0` char(64) NOT NULL,
  `tag1` char(64) DEFAULT NULL,
  `callid` char(64) NOT NULL,
  `cseq0` int NOT NULL,
  `cseq1` int DEFAULT NULL,
  `contact0` char(255) NOT NULL,
  `contact1` char(255) DEFAULT NULL,
  `route0` text,
  `route1` text,
  `sockinfo_srv` char(64) DEFAULT NULL,
  `param` char(255) NOT NULL,
  `lm` int NOT NULL,
  `lrc` int DEFAULT NULL,
  `lic` int DEFAULT NULL,
  `leg_cseq` int DEFAULT NULL,
  `leg_route` text,
  `leg_tag` char(64) DEFAULT NULL,
  `leg_contact` char(255) DEFAULT NULL,
  `leg_sockinfo` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `b2b_entities_idx` (`type`,`tag0`,`tag1`,`callid`),
  KEY `b2b_entities_param` (`param`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b2b_entities`
--

LOCK TABLES `b2b_entities` WRITE;
/*!40000 ALTER TABLE `b2b_entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2b_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b2b_logic`
--

DROP TABLE IF EXISTS `b2b_logic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `b2b_logic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `si_key` char(64) NOT NULL,
  `scenario` char(64) DEFAULT NULL,
  `sstate` int NOT NULL,
  `next_sstate` int NOT NULL,
  `sparam0` char(64) DEFAULT NULL,
  `sparam1` char(64) DEFAULT NULL,
  `sparam2` char(64) DEFAULT NULL,
  `sparam3` char(64) DEFAULT NULL,
  `sparam4` char(64) DEFAULT NULL,
  `sdp` tinytext,
  `lifetime` int NOT NULL DEFAULT '0',
  `e1_type` int NOT NULL,
  `e1_sid` char(64) DEFAULT NULL,
  `e1_from` char(255) NOT NULL,
  `e1_to` char(255) NOT NULL,
  `e1_key` char(64) NOT NULL,
  `e2_type` int NOT NULL,
  `e2_sid` char(64) DEFAULT NULL,
  `e2_from` char(255) NOT NULL,
  `e2_to` char(255) NOT NULL,
  `e2_key` char(64) NOT NULL,
  `e3_type` int DEFAULT NULL,
  `e3_sid` char(64) DEFAULT NULL,
  `e3_from` char(255) DEFAULT NULL,
  `e3_to` char(255) DEFAULT NULL,
  `e3_key` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `b2b_logic_idx` (`si_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b2b_logic`
--

LOCK TABLES `b2b_logic` WRITE;
/*!40000 ALTER TABLE `b2b_logic` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2b_logic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b2b_sca`
--

DROP TABLE IF EXISTS `b2b_sca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `b2b_sca` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `shared_line` char(64) NOT NULL,
  `watchers` char(255) NOT NULL,
  `app1_shared_entity` int unsigned DEFAULT NULL,
  `app1_call_state` int unsigned DEFAULT NULL,
  `app1_call_info_uri` char(255) DEFAULT NULL,
  `app1_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app1_b2bl_key` char(64) DEFAULT NULL,
  `app2_shared_entity` int unsigned DEFAULT NULL,
  `app2_call_state` int unsigned DEFAULT NULL,
  `app2_call_info_uri` char(255) DEFAULT NULL,
  `app2_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app2_b2bl_key` char(64) DEFAULT NULL,
  `app3_shared_entity` int unsigned DEFAULT NULL,
  `app3_call_state` int unsigned DEFAULT NULL,
  `app3_call_info_uri` char(255) DEFAULT NULL,
  `app3_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app3_b2bl_key` char(64) DEFAULT NULL,
  `app4_shared_entity` int unsigned DEFAULT NULL,
  `app4_call_state` int unsigned DEFAULT NULL,
  `app4_call_info_uri` char(255) DEFAULT NULL,
  `app4_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app4_b2bl_key` char(64) DEFAULT NULL,
  `app5_shared_entity` int unsigned DEFAULT NULL,
  `app5_call_state` int unsigned DEFAULT NULL,
  `app5_call_info_uri` char(255) DEFAULT NULL,
  `app5_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app5_b2bl_key` char(64) DEFAULT NULL,
  `app6_shared_entity` int unsigned DEFAULT NULL,
  `app6_call_state` int unsigned DEFAULT NULL,
  `app6_call_info_uri` char(255) DEFAULT NULL,
  `app6_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app6_b2bl_key` char(64) DEFAULT NULL,
  `app7_shared_entity` int unsigned DEFAULT NULL,
  `app7_call_state` int unsigned DEFAULT NULL,
  `app7_call_info_uri` char(255) DEFAULT NULL,
  `app7_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app7_b2bl_key` char(64) DEFAULT NULL,
  `app8_shared_entity` int unsigned DEFAULT NULL,
  `app8_call_state` int unsigned DEFAULT NULL,
  `app8_call_info_uri` char(255) DEFAULT NULL,
  `app8_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app8_b2bl_key` char(64) DEFAULT NULL,
  `app9_shared_entity` int unsigned DEFAULT NULL,
  `app9_call_state` int unsigned DEFAULT NULL,
  `app9_call_info_uri` char(255) DEFAULT NULL,
  `app9_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app9_b2bl_key` char(64) DEFAULT NULL,
  `app10_shared_entity` int unsigned DEFAULT NULL,
  `app10_call_state` int unsigned DEFAULT NULL,
  `app10_call_info_uri` char(255) DEFAULT NULL,
  `app10_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app10_b2bl_key` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sca_idx` (`shared_line`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b2b_sca`
--

LOCK TABLES `b2b_sca` WRITE;
/*!40000 ALTER TABLE `b2b_sca` DISABLE KEYS */;
/*!40000 ALTER TABLE `b2b_sca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cachedb`
--

DROP TABLE IF EXISTS `cachedb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cachedb` (
  `keyname` char(255) NOT NULL,
  `value` text NOT NULL,
  `counter` int NOT NULL DEFAULT '0',
  `expires` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`keyname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cachedb`
--

LOCK TABLES `cachedb` WRITE;
/*!40000 ALTER TABLE `cachedb` DISABLE KEYS */;
/*!40000 ALTER TABLE `cachedb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrierfailureroute`
--

DROP TABLE IF EXISTS `carrierfailureroute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrierfailureroute` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `carrier` int unsigned NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `scan_prefix` char(64) NOT NULL DEFAULT '',
  `host_name` char(255) NOT NULL DEFAULT '',
  `reply_code` char(3) NOT NULL DEFAULT '',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `mask` int unsigned NOT NULL DEFAULT '0',
  `next_domain` char(64) NOT NULL DEFAULT '',
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrierfailureroute`
--

LOCK TABLES `carrierfailureroute` WRITE;
/*!40000 ALTER TABLE `carrierfailureroute` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrierfailureroute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrierroute`
--

DROP TABLE IF EXISTS `carrierroute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrierroute` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `carrier` int unsigned NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `scan_prefix` char(64) NOT NULL DEFAULT '',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `mask` int unsigned NOT NULL DEFAULT '0',
  `prob` float NOT NULL DEFAULT '0',
  `strip` int unsigned NOT NULL DEFAULT '0',
  `rewrite_host` char(255) NOT NULL DEFAULT '',
  `rewrite_prefix` char(64) NOT NULL DEFAULT '',
  `rewrite_suffix` char(64) NOT NULL DEFAULT '',
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrierroute`
--

LOCK TABLES `carrierroute` WRITE;
/*!40000 ALTER TABLE `carrierroute` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrierroute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cc_agents`
--

DROP TABLE IF EXISTS `cc_agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cc_agents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `agentid` char(128) NOT NULL,
  `location` char(128) NOT NULL,
  `logstate` int unsigned NOT NULL DEFAULT '0',
  `skills` char(255) NOT NULL,
  `last_call_end` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_agentid` (`agentid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cc_agents`
--

LOCK TABLES `cc_agents` WRITE;
/*!40000 ALTER TABLE `cc_agents` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cc_calls`
--

DROP TABLE IF EXISTS `cc_calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cc_calls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `state` int NOT NULL,
  `ig_cback` int NOT NULL,
  `no_rej` int NOT NULL,
  `setup_time` int NOT NULL,
  `eta` int NOT NULL,
  `last_start` int NOT NULL,
  `recv_time` int NOT NULL,
  `caller_dn` char(128) NOT NULL,
  `caller_un` char(128) NOT NULL,
  `b2buaid` char(128) NOT NULL DEFAULT '',
  `flow` char(128) NOT NULL,
  `agent` char(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`b2buaid`),
  KEY `b2buaid_idx` (`b2buaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cc_calls`
--

LOCK TABLES `cc_calls` WRITE;
/*!40000 ALTER TABLE `cc_calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cc_cdrs`
--

DROP TABLE IF EXISTS `cc_cdrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cc_cdrs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `caller` char(64) NOT NULL,
  `received_timestamp` datetime NOT NULL,
  `wait_time` int unsigned NOT NULL DEFAULT '0',
  `pickup_time` int unsigned NOT NULL DEFAULT '0',
  `talk_time` int unsigned NOT NULL DEFAULT '0',
  `flow_id` char(128) NOT NULL,
  `agent_id` char(128) DEFAULT NULL,
  `call_type` int NOT NULL DEFAULT '-1',
  `rejected` int unsigned NOT NULL DEFAULT '0',
  `fstats` int unsigned NOT NULL DEFAULT '0',
  `cid` int unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cc_cdrs`
--

LOCK TABLES `cc_cdrs` WRITE;
/*!40000 ALTER TABLE `cc_cdrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_cdrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cc_flows`
--

DROP TABLE IF EXISTS `cc_flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cc_flows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `flowid` char(64) NOT NULL,
  `priority` int unsigned NOT NULL DEFAULT '256',
  `skill` char(64) NOT NULL,
  `prependcid` char(32) NOT NULL,
  `message_welcome` char(128) DEFAULT NULL,
  `message_queue` char(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_flowid` (`flowid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cc_flows`
--

LOCK TABLES `cc_flows` WRITE;
/*!40000 ALTER TABLE `cc_flows` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `closeddial`
--

DROP TABLE IF EXISTS `closeddial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `closeddial` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `cd_username` char(64) NOT NULL DEFAULT '',
  `cd_domain` char(64) NOT NULL DEFAULT '',
  `group_id` char(64) NOT NULL DEFAULT '',
  `new_uri` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd_idx1` (`username`,`domain`,`cd_domain`,`cd_username`,`group_id`),
  KEY `cd_idx2` (`group_id`),
  KEY `cd_idx3` (`cd_username`),
  KEY `cd_idx4` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `closeddial`
--

LOCK TABLES `closeddial` WRITE;
/*!40000 ALTER TABLE `closeddial` DISABLE KEYS */;
/*!40000 ALTER TABLE `closeddial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clusterer`
--

DROP TABLE IF EXISTS `clusterer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clusterer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cluster_id` int NOT NULL,
  `node_id` int NOT NULL,
  `url` char(64) NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `no_ping_retries` int NOT NULL DEFAULT '3',
  `priority` int NOT NULL DEFAULT '50',
  `sip_addr` char(64) DEFAULT NULL,
  `flags` char(64) DEFAULT NULL,
  `description` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clusterer_idx` (`cluster_id`,`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clusterer`
--

LOCK TABLES `clusterer` WRITE;
/*!40000 ALTER TABLE `clusterer` DISABLE KEYS */;
/*!40000 ALTER TABLE `clusterer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpl`
--

DROP TABLE IF EXISTS `cpl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cpl` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL DEFAULT '',
  `cpl_xml` text,
  `cpl_bin` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_idx` (`username`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cpl`
--

LOCK TABLES `cpl` WRITE;
/*!40000 ALTER TABLE `cpl` DISABLE KEYS */;
/*!40000 ALTER TABLE `cpl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbaliases`
--

DROP TABLE IF EXISTS `dbaliases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dbaliases` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `alias_username` char(64) NOT NULL DEFAULT '',
  `alias_domain` char(64) NOT NULL DEFAULT '',
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias_idx` (`alias_username`,`alias_domain`),
  KEY `target_idx` (`username`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbaliases`
--

LOCK TABLES `dbaliases` WRITE;
/*!40000 ALTER TABLE `dbaliases` DISABLE KEYS */;
/*!40000 ALTER TABLE `dbaliases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dialog`
--

DROP TABLE IF EXISTS `dialog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dialog` (
  `dlg_id` bigint unsigned NOT NULL,
  `callid` char(255) NOT NULL,
  `from_uri` char(255) NOT NULL,
  `from_tag` char(64) NOT NULL,
  `to_uri` char(255) NOT NULL,
  `to_tag` char(64) NOT NULL,
  `mangled_from_uri` char(64) DEFAULT NULL,
  `mangled_to_uri` char(64) DEFAULT NULL,
  `caller_cseq` char(11) NOT NULL,
  `callee_cseq` char(11) NOT NULL,
  `caller_ping_cseq` int unsigned NOT NULL,
  `callee_ping_cseq` int unsigned NOT NULL,
  `caller_route_set` text,
  `callee_route_set` text,
  `caller_contact` char(255) DEFAULT NULL,
  `callee_contact` char(255) DEFAULT NULL,
  `caller_sock` char(64) NOT NULL,
  `callee_sock` char(64) NOT NULL,
  `state` int unsigned NOT NULL,
  `start_time` int unsigned NOT NULL,
  `timeout` int unsigned NOT NULL,
  `vars` blob,
  `profiles` text,
  `script_flags` int unsigned NOT NULL DEFAULT '0',
  `module_flags` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dlg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dialog`
--

LOCK TABLES `dialog` WRITE;
/*!40000 ALTER TABLE `dialog` DISABLE KEYS */;
/*!40000 ALTER TABLE `dialog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dialplan`
--

DROP TABLE IF EXISTS `dialplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dialplan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dpid` int NOT NULL,
  `pr` int NOT NULL DEFAULT '0',
  `match_op` int NOT NULL,
  `match_exp` char(64) NOT NULL,
  `match_flags` int NOT NULL DEFAULT '0',
  `subst_exp` char(64) DEFAULT NULL,
  `repl_exp` char(32) DEFAULT NULL,
  `timerec` char(255) DEFAULT NULL,
  `disabled` int NOT NULL DEFAULT '0',
  `attrs` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dialplan`
--

LOCK TABLES `dialplan` WRITE;
/*!40000 ALTER TABLE `dialplan` DISABLE KEYS */;
/*!40000 ALTER TABLE `dialplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatcher`
--

DROP TABLE IF EXISTS `dispatcher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dispatcher` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `setid` int NOT NULL DEFAULT '0',
  `destination` char(192) NOT NULL DEFAULT '',
  `socket` char(128) DEFAULT NULL,
  `state` int NOT NULL DEFAULT '0',
  `weight` char(64) NOT NULL DEFAULT '1',
  `priority` int NOT NULL DEFAULT '0',
  `attrs` char(128) NOT NULL DEFAULT '',
  `description` char(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispatcher`
--

LOCK TABLES `dispatcher` WRITE;
/*!40000 ALTER TABLE `dispatcher` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispatcher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domain` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `domain` char(64) NOT NULL DEFAULT '',
  `attrs` char(255) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_idx` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (93,'admin.lineblocs.com',NULL,'1900-01-01 00:00:01'),(94,'workspace.lineblocs.com',NULL,'1900-01-01 00:00:01');
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domainpolicy`
--

DROP TABLE IF EXISTS `domainpolicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainpolicy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rule` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `att` char(255) DEFAULT NULL,
  `val` char(128) DEFAULT NULL,
  `description` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rav_idx` (`rule`,`att`,`val`),
  KEY `rule_idx` (`rule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domainpolicy`
--

LOCK TABLES `domainpolicy` WRITE;
/*!40000 ALTER TABLE `domainpolicy` DISABLE KEYS */;
/*!40000 ALTER TABLE `domainpolicy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr_carriers`
--

DROP TABLE IF EXISTS `dr_carriers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr_carriers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `carrierid` char(64) NOT NULL,
  `gwlist` char(255) NOT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `state` int unsigned NOT NULL DEFAULT '0',
  `attrs` char(255) DEFAULT NULL,
  `description` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dr_carrier_idx` (`carrierid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr_carriers`
--

LOCK TABLES `dr_carriers` WRITE;
/*!40000 ALTER TABLE `dr_carriers` DISABLE KEYS */;
/*!40000 ALTER TABLE `dr_carriers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr_gateways`
--

DROP TABLE IF EXISTS `dr_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr_gateways` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `gwid` char(64) NOT NULL,
  `type` int unsigned NOT NULL DEFAULT '0',
  `address` char(128) NOT NULL,
  `strip` int unsigned NOT NULL DEFAULT '0',
  `pri_prefix` char(16) DEFAULT NULL,
  `attrs` char(255) DEFAULT NULL,
  `probe_mode` int unsigned NOT NULL DEFAULT '0',
  `state` int unsigned NOT NULL DEFAULT '0',
  `socket` char(128) DEFAULT NULL,
  `description` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dr_gw_idx` (`gwid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr_gateways`
--

LOCK TABLES `dr_gateways` WRITE;
/*!40000 ALTER TABLE `dr_gateways` DISABLE KEYS */;
/*!40000 ALTER TABLE `dr_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr_groups`
--

DROP TABLE IF EXISTS `dr_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(128) DEFAULT NULL,
  `groupid` int unsigned NOT NULL DEFAULT '0',
  `description` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr_groups`
--

LOCK TABLES `dr_groups` WRITE;
/*!40000 ALTER TABLE `dr_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `dr_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr_partitions`
--

DROP TABLE IF EXISTS `dr_partitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr_partitions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `partition_name` char(255) NOT NULL,
  `db_url` char(255) NOT NULL,
  `drd_table` char(255) DEFAULT NULL,
  `drr_table` char(255) DEFAULT NULL,
  `drg_table` char(255) DEFAULT NULL,
  `drc_table` char(255) DEFAULT NULL,
  `ruri_avp` char(255) DEFAULT NULL,
  `gw_id_avp` char(255) DEFAULT NULL,
  `gw_priprefix_avp` char(255) DEFAULT NULL,
  `gw_sock_avp` char(255) DEFAULT NULL,
  `rule_id_avp` char(255) DEFAULT NULL,
  `rule_prefix_avp` char(255) DEFAULT NULL,
  `carrier_id_avp` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr_partitions`
--

LOCK TABLES `dr_partitions` WRITE;
/*!40000 ALTER TABLE `dr_partitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `dr_partitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dr_rules`
--

DROP TABLE IF EXISTS `dr_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dr_rules` (
  `ruleid` int unsigned NOT NULL AUTO_INCREMENT,
  `groupid` char(255) NOT NULL,
  `prefix` char(64) NOT NULL,
  `timerec` char(255) DEFAULT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `routeid` char(255) DEFAULT NULL,
  `gwlist` char(255) NOT NULL,
  `attrs` char(255) DEFAULT NULL,
  `description` char(128) DEFAULT NULL,
  PRIMARY KEY (`ruleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dr_rules`
--

LOCK TABLES `dr_rules` WRITE;
/*!40000 ALTER TABLE `dr_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `dr_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_report`
--

DROP TABLE IF EXISTS `emergency_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergency_report` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `callid` char(25) NOT NULL,
  `selectiveRoutingID` char(11) NOT NULL,
  `routingESN` int unsigned NOT NULL DEFAULT '0',
  `npa` int unsigned NOT NULL DEFAULT '0',
  `esgwri` char(50) NOT NULL,
  `lro` char(20) NOT NULL,
  `VPC_organizationName` char(50) NOT NULL,
  `VPC_hostname` char(50) NOT NULL,
  `VPC_timestamp` char(30) NOT NULL,
  `result` char(4) NOT NULL,
  `disposition` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_report`
--

LOCK TABLES `emergency_report` WRITE;
/*!40000 ALTER TABLE `emergency_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergency_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_routing`
--

DROP TABLE IF EXISTS `emergency_routing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergency_routing` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selectiveRoutingID` char(11) NOT NULL,
  `routingESN` int unsigned NOT NULL DEFAULT '0',
  `npa` int unsigned NOT NULL DEFAULT '0',
  `esgwri` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_routing`
--

LOCK TABLES `emergency_routing` WRITE;
/*!40000 ALTER TABLE `emergency_routing` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergency_routing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_service_provider`
--

DROP TABLE IF EXISTS `emergency_service_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergency_service_provider` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `organizationName` char(50) NOT NULL,
  `hostId` char(30) NOT NULL,
  `nenaId` char(50) NOT NULL,
  `contact` char(20) NOT NULL,
  `certUri` char(50) NOT NULL,
  `nodeIP` char(20) NOT NULL,
  `attribution` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_service_provider`
--

LOCK TABLES `emergency_service_provider` WRITE;
/*!40000 ALTER TABLE `emergency_service_provider` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergency_service_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fraud_detection`
--

DROP TABLE IF EXISTS `fraud_detection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fraud_detection` (
  `ruleid` int unsigned NOT NULL AUTO_INCREMENT,
  `profileid` int unsigned NOT NULL,
  `prefix` char(64) NOT NULL,
  `start_hour` char(5) NOT NULL,
  `end_hour` char(5) NOT NULL,
  `daysoftheweek` char(64) NOT NULL,
  `cpm_warning` int unsigned NOT NULL,
  `cpm_critical` int unsigned NOT NULL,
  `call_duration_warning` int unsigned NOT NULL,
  `call_duration_critical` int unsigned NOT NULL,
  `total_calls_warning` int unsigned NOT NULL,
  `total_calls_critical` int unsigned NOT NULL,
  `concurrent_calls_warning` int unsigned NOT NULL,
  `concurrent_calls_critical` int unsigned NOT NULL,
  `sequential_calls_warning` int unsigned NOT NULL,
  `sequential_calls_critical` int unsigned NOT NULL,
  PRIMARY KEY (`ruleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fraud_detection`
--

LOCK TABLES `fraud_detection` WRITE;
/*!40000 ALTER TABLE `fraud_detection` DISABLE KEYS */;
/*!40000 ALTER TABLE `fraud_detection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freeswitch`
--

DROP TABLE IF EXISTS `freeswitch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `freeswitch` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) DEFAULT NULL,
  `password` char(64) NOT NULL,
  `ip` char(20) NOT NULL,
  `port` int NOT NULL DEFAULT '8021',
  `events_csv` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freeswitch`
--

LOCK TABLES `freeswitch` WRITE;
/*!40000 ALTER TABLE `freeswitch` DISABLE KEYS */;
/*!40000 ALTER TABLE `freeswitch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `globalblacklist`
--

DROP TABLE IF EXISTS `globalblacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `globalblacklist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `prefix` char(64) NOT NULL DEFAULT '',
  `whitelist` tinyint(1) NOT NULL DEFAULT '0',
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `globalblacklist_idx` (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `globalblacklist`
--

LOCK TABLES `globalblacklist` WRITE;
/*!40000 ALTER TABLE `globalblacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `globalblacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grp`
--

DROP TABLE IF EXISTS `grp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `grp` char(64) NOT NULL DEFAULT '',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_group_idx` (`username`,`domain`,`grp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grp`
--

LOCK TABLES `grp` WRITE;
/*!40000 ALTER TABLE `grp` DISABLE KEYS */;
/*!40000 ALTER TABLE `grp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imc_members`
--

DROP TABLE IF EXISTS `imc_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imc_members` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `room` char(64) NOT NULL,
  `flag` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_room_idx` (`username`,`domain`,`room`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imc_members`
--

LOCK TABLES `imc_members` WRITE;
/*!40000 ALTER TABLE `imc_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `imc_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imc_rooms`
--

DROP TABLE IF EXISTS `imc_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imc_rooms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `flag` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_domain_idx` (`name`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imc_rooms`
--

LOCK TABLES `imc_rooms` WRITE;
/*!40000 ALTER TABLE `imc_rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `imc_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `load_balancer`
--

DROP TABLE IF EXISTS `load_balancer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `load_balancer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `dst_uri` char(128) NOT NULL,
  `resources` char(255) NOT NULL,
  `probe_mode` int unsigned NOT NULL DEFAULT '0',
  `description` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dsturi_idx` (`dst_uri`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `load_balancer`
--

LOCK TABLES `load_balancer` WRITE;
/*!40000 ALTER TABLE `load_balancer` DISABLE KEYS */;
/*!40000 ALTER TABLE `load_balancer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `contact_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) DEFAULT NULL,
  `contact` char(255) NOT NULL DEFAULT '',
  `received` char(255) DEFAULT NULL,
  `path` char(255) DEFAULT NULL,
  `expires` int unsigned NOT NULL,
  `q` float(10,2) NOT NULL DEFAULT '1.00',
  `callid` char(255) NOT NULL DEFAULT 'Default-Call-ID',
  `cseq` int NOT NULL DEFAULT '13',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  `flags` int NOT NULL DEFAULT '0',
  `cflags` char(255) DEFAULT NULL,
  `user_agent` char(255) NOT NULL DEFAULT '',
  `socket` char(64) DEFAULT NULL,
  `methods` int DEFAULT NULL,
  `sip_instance` char(255) DEFAULT NULL,
  `kv_store` text,
  `attr` char(255) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missed_calls`
--

DROP TABLE IF EXISTS `missed_calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `missed_calls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `method` char(16) NOT NULL DEFAULT '',
  `from_tag` char(64) NOT NULL DEFAULT '',
  `to_tag` char(64) NOT NULL DEFAULT '',
  `callid` char(64) NOT NULL DEFAULT '',
  `sip_code` char(3) NOT NULL DEFAULT '',
  `sip_reason` char(32) NOT NULL DEFAULT '',
  `time` datetime NOT NULL,
  `setuptime` int unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missed_calls`
--

LOCK TABLES `missed_calls` WRITE;
/*!40000 ALTER TABLE `missed_calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `missed_calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentity`
--

DROP TABLE IF EXISTS `presentity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presentity` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `event` char(64) NOT NULL,
  `etag` char(64) NOT NULL,
  `expires` int NOT NULL,
  `received_time` int NOT NULL,
  `body` blob,
  `extra_hdrs` blob,
  `sender` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `presentity_idx` (`username`,`domain`,`event`,`etag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentity`
--

LOCK TABLES `presentity` WRITE;
/*!40000 ALTER TABLE `presentity` DISABLE KEYS */;
/*!40000 ALTER TABLE `presentity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pua`
--

DROP TABLE IF EXISTS `pua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pua` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pres_uri` char(255) NOT NULL,
  `pres_id` char(255) NOT NULL,
  `event` int NOT NULL,
  `expires` int NOT NULL,
  `desired_expires` int NOT NULL,
  `flag` int NOT NULL,
  `etag` char(64) DEFAULT NULL,
  `tuple_id` char(64) DEFAULT NULL,
  `watcher_uri` char(255) DEFAULT NULL,
  `to_uri` char(255) DEFAULT NULL,
  `call_id` char(64) DEFAULT NULL,
  `to_tag` char(64) DEFAULT NULL,
  `from_tag` char(64) DEFAULT NULL,
  `cseq` int DEFAULT NULL,
  `record_route` text,
  `contact` char(255) DEFAULT NULL,
  `remote_contact` char(255) DEFAULT NULL,
  `version` int DEFAULT NULL,
  `extra_headers` text,
  PRIMARY KEY (`id`),
  KEY `del1_idx` (`pres_uri`,`event`),
  KEY `del2_idx` (`expires`),
  KEY `update_idx` (`pres_uri`,`pres_id`,`flag`,`event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pua`
--

LOCK TABLES `pua` WRITE;
/*!40000 ALTER TABLE `pua` DISABLE KEYS */;
/*!40000 ALTER TABLE `pua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_grp`
--

DROP TABLE IF EXISTS `re_grp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_grp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reg_exp` char(128) NOT NULL DEFAULT '',
  `group_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_grp`
--

LOCK TABLES `re_grp` WRITE;
/*!40000 ALTER TABLE `re_grp` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_grp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrant`
--

DROP TABLE IF EXISTS `registrant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrant` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `registrar` char(255) NOT NULL DEFAULT '',
  `proxy` char(255) DEFAULT NULL,
  `aor` char(255) NOT NULL DEFAULT '',
  `third_party_registrant` char(255) DEFAULT NULL,
  `username` char(64) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `binding_URI` char(255) NOT NULL DEFAULT '',
  `binding_params` char(64) DEFAULT NULL,
  `expiry` int unsigned DEFAULT NULL,
  `forced_socket` char(64) DEFAULT NULL,
  `cluster_shtag` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aor_idx` (`aor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrant`
--

LOCK TABLES `registrant` WRITE;
/*!40000 ALTER TABLE `registrant` DISABLE KEYS */;
/*!40000 ALTER TABLE `registrant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rls_presentity`
--

DROP TABLE IF EXISTS `rls_presentity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rls_presentity` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rlsubs_did` char(255) NOT NULL,
  `resource_uri` char(255) NOT NULL,
  `content_type` char(255) NOT NULL,
  `presence_state` blob NOT NULL,
  `expires` int NOT NULL,
  `updated` int NOT NULL,
  `auth_state` int NOT NULL,
  `reason` char(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rls_presentity_idx` (`rlsubs_did`,`resource_uri`),
  KEY `updated_idx` (`updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rls_presentity`
--

LOCK TABLES `rls_presentity` WRITE;
/*!40000 ALTER TABLE `rls_presentity` DISABLE KEYS */;
/*!40000 ALTER TABLE `rls_presentity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rls_watchers`
--

DROP TABLE IF EXISTS `rls_watchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rls_watchers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` char(255) NOT NULL,
  `to_user` char(64) NOT NULL,
  `to_domain` char(64) NOT NULL,
  `watcher_username` char(64) NOT NULL,
  `watcher_domain` char(64) NOT NULL,
  `event` char(64) NOT NULL DEFAULT 'presence',
  `event_id` char(64) DEFAULT NULL,
  `to_tag` char(64) NOT NULL,
  `from_tag` char(64) NOT NULL,
  `callid` char(64) NOT NULL,
  `local_cseq` int NOT NULL,
  `remote_cseq` int NOT NULL,
  `contact` char(64) NOT NULL,
  `record_route` text,
  `expires` int NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  `reason` char(64) NOT NULL,
  `version` int NOT NULL DEFAULT '0',
  `socket_info` char(64) NOT NULL,
  `local_contact` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rls_watcher_idx` (`presentity_uri`,`callid`,`to_tag`,`from_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rls_watchers`
--

LOCK TABLES `rls_watchers` WRITE;
/*!40000 ALTER TABLE `rls_watchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `rls_watchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route_tree`
--

DROP TABLE IF EXISTS `route_tree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `route_tree` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `carrier` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route_tree`
--

LOCK TABLES `route_tree` WRITE;
/*!40000 ALTER TABLE `route_tree` DISABLE KEYS */;
/*!40000 ALTER TABLE `route_tree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rtpengine`
--

DROP TABLE IF EXISTS `rtpengine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rtpengine` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `socket` text NOT NULL,
  `set_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtpengine`
--

LOCK TABLES `rtpengine` WRITE;
/*!40000 ALTER TABLE `rtpengine` DISABLE KEYS */;
/*!40000 ALTER TABLE `rtpengine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rtpproxy_sockets`
--

DROP TABLE IF EXISTS `rtpproxy_sockets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rtpproxy_sockets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `rtpproxy_sock` text NOT NULL,
  `set_id` int unsigned NOT NULL,
  `lineblocs_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtpproxy_sockets`
--

LOCK TABLES `rtpproxy_sockets` WRITE;
/*!40000 ALTER TABLE `rtpproxy_sockets` DISABLE KEYS */;
/*!40000 ALTER TABLE `rtpproxy_sockets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `silo`
--

DROP TABLE IF EXISTS `silo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `silo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `src_addr` char(255) NOT NULL DEFAULT '',
  `dst_addr` char(255) NOT NULL DEFAULT '',
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `inc_time` int NOT NULL DEFAULT '0',
  `exp_time` int NOT NULL DEFAULT '0',
  `snd_time` int NOT NULL DEFAULT '0',
  `ctype` char(255) DEFAULT NULL,
  `body` blob,
  PRIMARY KEY (`id`),
  KEY `account_idx` (`username`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `silo`
--

LOCK TABLES `silo` WRITE;
/*!40000 ALTER TABLE `silo` DISABLE KEYS */;
/*!40000 ALTER TABLE `silo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sip_trace`
--

DROP TABLE IF EXISTS `sip_trace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_trace` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `time_stamp` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  `callid` char(255) NOT NULL DEFAULT '',
  `trace_attrs` char(255) DEFAULT NULL,
  `msg` text NOT NULL,
  `method` char(32) NOT NULL DEFAULT '',
  `status` char(255) DEFAULT NULL,
  `from_proto` char(5) NOT NULL,
  `from_ip` char(50) NOT NULL DEFAULT '',
  `from_port` int unsigned NOT NULL,
  `to_proto` char(5) NOT NULL,
  `to_ip` char(50) NOT NULL DEFAULT '',
  `to_port` int unsigned NOT NULL,
  `fromtag` char(64) NOT NULL DEFAULT '',
  `direction` char(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `trace_attrs_idx` (`trace_attrs`),
  KEY `date_idx` (`time_stamp`),
  KEY `fromip_idx` (`from_ip`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sip_trace`
--

LOCK TABLES `sip_trace` WRITE;
/*!40000 ALTER TABLE `sip_trace` DISABLE KEYS */;
/*!40000 ALTER TABLE `sip_trace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smpp`
--

DROP TABLE IF EXISTS `smpp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smpp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `ip` char(50) NOT NULL,
  `port` int unsigned NOT NULL,
  `system_id` char(16) NOT NULL,
  `password` char(9) NOT NULL,
  `system_type` char(13) NOT NULL DEFAULT '',
  `src_ton` int unsigned NOT NULL DEFAULT '0',
  `src_npi` int unsigned NOT NULL DEFAULT '0',
  `dst_ton` int unsigned NOT NULL DEFAULT '0',
  `dst_npi` int unsigned NOT NULL DEFAULT '0',
  `session_type` int unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smpp`
--

LOCK TABLES `smpp` WRITE;
/*!40000 ALTER TABLE `smpp` DISABLE KEYS */;
/*!40000 ALTER TABLE `smpp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speed_dial`
--

DROP TABLE IF EXISTS `speed_dial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `speed_dial` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `sd_username` char(64) NOT NULL DEFAULT '',
  `sd_domain` char(64) NOT NULL DEFAULT '',
  `new_uri` char(255) NOT NULL DEFAULT '',
  `fname` char(64) NOT NULL DEFAULT '',
  `lname` char(64) NOT NULL DEFAULT '',
  `description` char(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `speed_dial_idx` (`username`,`domain`,`sd_domain`,`sd_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speed_dial`
--

LOCK TABLES `speed_dial` WRITE;
/*!40000 ALTER TABLE `speed_dial` DISABLE KEYS */;
/*!40000 ALTER TABLE `speed_dial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriber`
--

DROP TABLE IF EXISTS `subscriber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriber` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `password` char(64) NOT NULL,
  `email_address` char(64) NOT NULL DEFAULT '',
  `ha1` char(64) NOT NULL DEFAULT '',
  `ha1b` char(64) NOT NULL DEFAULT '',
  `rpid` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_idx` (`username`,`domain`),
  KEY `username_idx` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriber`
--

LOCK TABLES `subscriber` WRITE;
/*!40000 ALTER TABLE `subscriber` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tls_mgm`
--

DROP TABLE IF EXISTS `tls_mgm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tls_mgm` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `domain` char(64) NOT NULL,
  `match_ip_address` char(255) DEFAULT NULL,
  `match_sip_domain` char(255) DEFAULT NULL,
  `type` int NOT NULL DEFAULT '1',
  `method` char(16) DEFAULT 'SSLv23',
  `verify_cert` int DEFAULT '1',
  `require_cert` int DEFAULT '1',
  `certificate` blob,
  `private_key` blob,
  `crl_check_all` int DEFAULT '0',
  `crl_dir` char(255) DEFAULT NULL,
  `ca_list` mediumblob,
  `ca_dir` char(255) DEFAULT NULL,
  `cipher_list` char(255) DEFAULT NULL,
  `dh_params` blob,
  `ec_curve` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_type_idx` (`domain`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tls_mgm`
--

LOCK TABLES `tls_mgm` WRITE;
/*!40000 ALTER TABLE `tls_mgm` DISABLE KEYS */;
/*!40000 ALTER TABLE `tls_mgm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uri`
--

DROP TABLE IF EXISTS `uri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uri` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `uri_user` char(64) NOT NULL DEFAULT '',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_idx` (`username`,`domain`,`uri_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uri`
--

LOCK TABLES `uri` WRITE;
/*!40000 ALTER TABLE `uri` DISABLE KEYS */;
/*!40000 ALTER TABLE `uri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userblacklist`
--

DROP TABLE IF EXISTS `userblacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userblacklist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `prefix` char(64) NOT NULL DEFAULT '',
  `whitelist` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userblacklist_idx` (`username`,`domain`,`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userblacklist`
--

LOCK TABLES `userblacklist` WRITE;
/*!40000 ALTER TABLE `userblacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `userblacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr_preferences`
--

DROP TABLE IF EXISTS `usr_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usr_preferences` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(64) NOT NULL DEFAULT '',
  `username` char(64) NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `attribute` char(32) NOT NULL DEFAULT '',
  `type` int NOT NULL DEFAULT '0',
  `value` char(128) NOT NULL DEFAULT '',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  KEY `ua_idx` (`uuid`,`attribute`),
  KEY `uda_idx` (`username`,`domain`,`attribute`),
  KEY `value_idx` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_preferences`
--

LOCK TABLES `usr_preferences` WRITE;
/*!40000 ALTER TABLE `usr_preferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `usr_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `version` (
  `table_name` char(32) NOT NULL,
  `table_version` int unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `t_name_idx` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `version`
--

LOCK TABLES `version` WRITE;
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` VALUES ('acc',7),('active_watchers',12),('address',5),('b2b_entities',1),('b2b_logic',3),('b2b_sca',1),('cachedb',2),('carrierfailureroute',2),('carrierroute',3),('cc_agents',1),('cc_cdrs',1),('cc_flows',1),('closeddial',1),('clusterer',4),('cpl',2),('dbaliases',2),('dialog',10),('dialplan',5),('dispatcher',8),('domain',3),('domainpolicy',3),('dr_carriers',2),('dr_gateways',6),('dr_groups',2),('dr_partitions',1),('dr_rules',3),('emergency_report',1),('emergency_routing',1),('emergency_service_provider',1),('fraud_detection',1),('freeswitch',1),('globalblacklist',2),('grp',3),('imc_members',2),('imc_rooms',2),('load_balancer',2),('location',1013),('missed_calls',5),('presentity',5),('pua',8),('registrant',2),('re_grp',2),('rls_presentity',1),('rls_watchers',2),('route_tree',2),('rtpengine',1),('rtpproxy_sockets',0),('silo',6),('sip_trace',5),('smpp',1),('speed_dial',3),('subscriber',7),('tls_mgm',3),('uri',2),('userblacklist',2),('usr_preferences',3),('watchers',4),('xcap',4);
/*!40000 ALTER TABLE `version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchers`
--

DROP TABLE IF EXISTS `watchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` char(255) NOT NULL,
  `watcher_username` char(64) NOT NULL,
  `watcher_domain` char(64) NOT NULL,
  `event` char(64) NOT NULL DEFAULT 'presence',
  `status` int NOT NULL,
  `reason` char(64) DEFAULT NULL,
  `inserted_time` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `watcher_idx` (`presentity_uri`,`watcher_username`,`watcher_domain`,`event`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchers`
--

LOCK TABLES `watchers` WRITE;
/*!40000 ALTER TABLE `watchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `watchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xcap`
--

DROP TABLE IF EXISTS `xcap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `xcap` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `doc` longblob NOT NULL,
  `doc_type` int NOT NULL,
  `etag` char(64) NOT NULL,
  `source` int NOT NULL,
  `doc_uri` char(255) NOT NULL,
  `port` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_doc_type_idx` (`username`,`domain`,`doc_type`,`doc_uri`),
  KEY `source_idx` (`source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xcap`
--

LOCK TABLES `xcap` WRITE;
/*!40000 ALTER TABLE `xcap` DISABLE KEYS */;
/*!40000 ALTER TABLE `xcap` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06 18:29:57
