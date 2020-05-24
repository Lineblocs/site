-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: opensips
-- ------------------------------------------------------
-- Server version	5.5.64-MariaDB

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
-- Table structure for table `acc`
--

DROP TABLE IF EXISTS `acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method` char(16) NOT NULL DEFAULT '',
  `from_tag` char(64) NOT NULL DEFAULT '',
  `to_tag` char(64) NOT NULL DEFAULT '',
  `callid` char(64) NOT NULL DEFAULT '',
  `sip_code` char(3) NOT NULL DEFAULT '',
  `sip_reason` char(32) NOT NULL DEFAULT '',
  `time` datetime NOT NULL,
  `duration` int(11) unsigned NOT NULL DEFAULT '0',
  `ms_duration` int(11) unsigned NOT NULL DEFAULT '0',
  `setuptime` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_watchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `local_cseq` int(11) NOT NULL,
  `remote_cseq` int(11) NOT NULL,
  `contact` char(255) NOT NULL,
  `record_route` text,
  `expires` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `reason` char(64) DEFAULT NULL,
  `version` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grp` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ip` char(50) NOT NULL,
  `mask` tinyint(4) NOT NULL DEFAULT '32',
  `port` smallint(5) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b2b_entities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL,
  `state` int(2) NOT NULL,
  `ruri` char(255) DEFAULT NULL,
  `from_uri` char(255) NOT NULL,
  `to_uri` char(255) NOT NULL,
  `from_dname` char(64) DEFAULT NULL,
  `to_dname` char(64) DEFAULT NULL,
  `tag0` char(64) NOT NULL,
  `tag1` char(64) DEFAULT NULL,
  `callid` char(64) NOT NULL,
  `cseq0` int(11) NOT NULL,
  `cseq1` int(11) DEFAULT NULL,
  `contact0` char(255) NOT NULL,
  `contact1` char(255) DEFAULT NULL,
  `route0` text,
  `route1` text,
  `sockinfo_srv` char(64) DEFAULT NULL,
  `param` char(255) NOT NULL,
  `lm` int(11) NOT NULL,
  `lrc` int(11) DEFAULT NULL,
  `lic` int(11) DEFAULT NULL,
  `leg_cseq` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b2b_logic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `si_key` char(64) NOT NULL,
  `scenario` char(64) DEFAULT NULL,
  `sstate` int(2) NOT NULL,
  `next_sstate` int(2) NOT NULL,
  `sparam0` char(64) DEFAULT NULL,
  `sparam1` char(64) DEFAULT NULL,
  `sparam2` char(64) DEFAULT NULL,
  `sparam3` char(64) DEFAULT NULL,
  `sparam4` char(64) DEFAULT NULL,
  `sdp` tinytext,
  `lifetime` int(10) NOT NULL DEFAULT '0',
  `e1_type` int(2) NOT NULL,
  `e1_sid` char(64) DEFAULT NULL,
  `e1_from` char(255) NOT NULL,
  `e1_to` char(255) NOT NULL,
  `e1_key` char(64) NOT NULL,
  `e2_type` int(2) NOT NULL,
  `e2_sid` char(64) DEFAULT NULL,
  `e2_from` char(255) NOT NULL,
  `e2_to` char(255) NOT NULL,
  `e2_key` char(64) NOT NULL,
  `e3_type` int(2) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b2b_sca` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shared_line` char(64) NOT NULL,
  `watchers` char(255) NOT NULL,
  `app1_shared_entity` int(1) unsigned DEFAULT NULL,
  `app1_call_state` int(1) unsigned DEFAULT NULL,
  `app1_call_info_uri` char(255) DEFAULT NULL,
  `app1_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app1_b2bl_key` char(64) DEFAULT NULL,
  `app2_shared_entity` int(1) unsigned DEFAULT NULL,
  `app2_call_state` int(1) unsigned DEFAULT NULL,
  `app2_call_info_uri` char(255) DEFAULT NULL,
  `app2_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app2_b2bl_key` char(64) DEFAULT NULL,
  `app3_shared_entity` int(1) unsigned DEFAULT NULL,
  `app3_call_state` int(1) unsigned DEFAULT NULL,
  `app3_call_info_uri` char(255) DEFAULT NULL,
  `app3_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app3_b2bl_key` char(64) DEFAULT NULL,
  `app4_shared_entity` int(1) unsigned DEFAULT NULL,
  `app4_call_state` int(1) unsigned DEFAULT NULL,
  `app4_call_info_uri` char(255) DEFAULT NULL,
  `app4_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app4_b2bl_key` char(64) DEFAULT NULL,
  `app5_shared_entity` int(1) unsigned DEFAULT NULL,
  `app5_call_state` int(1) unsigned DEFAULT NULL,
  `app5_call_info_uri` char(255) DEFAULT NULL,
  `app5_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app5_b2bl_key` char(64) DEFAULT NULL,
  `app6_shared_entity` int(1) unsigned DEFAULT NULL,
  `app6_call_state` int(1) unsigned DEFAULT NULL,
  `app6_call_info_uri` char(255) DEFAULT NULL,
  `app6_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app6_b2bl_key` char(64) DEFAULT NULL,
  `app7_shared_entity` int(1) unsigned DEFAULT NULL,
  `app7_call_state` int(1) unsigned DEFAULT NULL,
  `app7_call_info_uri` char(255) DEFAULT NULL,
  `app7_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app7_b2bl_key` char(64) DEFAULT NULL,
  `app8_shared_entity` int(1) unsigned DEFAULT NULL,
  `app8_call_state` int(1) unsigned DEFAULT NULL,
  `app8_call_info_uri` char(255) DEFAULT NULL,
  `app8_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app8_b2bl_key` char(64) DEFAULT NULL,
  `app9_shared_entity` int(1) unsigned DEFAULT NULL,
  `app9_call_state` int(1) unsigned DEFAULT NULL,
  `app9_call_info_uri` char(255) DEFAULT NULL,
  `app9_call_info_appearance_uri` char(255) DEFAULT NULL,
  `app9_b2bl_key` char(64) DEFAULT NULL,
  `app10_shared_entity` int(1) unsigned DEFAULT NULL,
  `app10_call_state` int(1) unsigned DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cachedb` (
  `keyname` char(255) NOT NULL,
  `value` text NOT NULL,
  `counter` int(10) NOT NULL DEFAULT '0',
  `expires` int(10) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrierfailureroute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrier` int(10) unsigned NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `scan_prefix` char(64) NOT NULL DEFAULT '',
  `host_name` char(255) NOT NULL DEFAULT '',
  `reply_code` char(3) NOT NULL DEFAULT '',
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrierroute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrier` int(10) unsigned NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `scan_prefix` char(64) NOT NULL DEFAULT '',
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `prob` float NOT NULL DEFAULT '0',
  `strip` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cc_agents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agentid` char(128) NOT NULL,
  `location` char(128) NOT NULL,
  `logstate` int(10) unsigned NOT NULL DEFAULT '0',
  `skills` char(255) NOT NULL,
  `last_call_end` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cc_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL,
  `ig_cback` int(11) NOT NULL,
  `no_rej` int(11) NOT NULL,
  `setup_time` int(11) NOT NULL,
  `eta` int(11) NOT NULL,
  `last_start` int(11) NOT NULL,
  `recv_time` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cc_cdrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caller` char(64) NOT NULL,
  `received_timestamp` datetime NOT NULL,
  `wait_time` int(11) unsigned NOT NULL DEFAULT '0',
  `pickup_time` int(11) unsigned NOT NULL DEFAULT '0',
  `talk_time` int(11) unsigned NOT NULL DEFAULT '0',
  `flow_id` char(128) NOT NULL,
  `agent_id` char(128) DEFAULT NULL,
  `call_type` int(11) NOT NULL DEFAULT '-1',
  `rejected` int(11) unsigned NOT NULL DEFAULT '0',
  `fstats` int(11) unsigned NOT NULL DEFAULT '0',
  `cid` int(11) unsigned DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cc_flows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flowid` char(64) NOT NULL,
  `priority` int(11) unsigned NOT NULL DEFAULT '256',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `closeddial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clusterer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cluster_id` int(10) NOT NULL,
  `node_id` int(10) NOT NULL,
  `url` char(64) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '1',
  `no_ping_retries` int(10) NOT NULL DEFAULT '3',
  `priority` int(10) NOT NULL DEFAULT '50',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cpl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dbaliases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dialog` (
  `dlg_id` bigint(10) unsigned NOT NULL,
  `callid` char(255) NOT NULL,
  `from_uri` char(255) NOT NULL,
  `from_tag` char(64) NOT NULL,
  `to_uri` char(255) NOT NULL,
  `to_tag` char(64) NOT NULL,
  `mangled_from_uri` char(64) DEFAULT NULL,
  `mangled_to_uri` char(64) DEFAULT NULL,
  `caller_cseq` char(11) NOT NULL,
  `callee_cseq` char(11) NOT NULL,
  `caller_ping_cseq` int(11) unsigned NOT NULL,
  `callee_ping_cseq` int(11) unsigned NOT NULL,
  `caller_route_set` text,
  `callee_route_set` text,
  `caller_contact` char(255) DEFAULT NULL,
  `callee_contact` char(255) DEFAULT NULL,
  `caller_sock` char(64) NOT NULL,
  `callee_sock` char(64) NOT NULL,
  `state` int(10) unsigned NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `timeout` int(10) unsigned NOT NULL,
  `vars` blob,
  `profiles` text,
  `script_flags` int(10) unsigned NOT NULL DEFAULT '0',
  `module_flags` int(10) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dialplan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dpid` int(11) NOT NULL,
  `pr` int(11) NOT NULL DEFAULT '0',
  `match_op` int(11) NOT NULL,
  `match_exp` char(64) NOT NULL,
  `match_flags` int(11) NOT NULL DEFAULT '0',
  `subst_exp` char(64) DEFAULT NULL,
  `repl_exp` char(32) DEFAULT NULL,
  `timerec` char(255) DEFAULT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispatcher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setid` int(11) NOT NULL DEFAULT '0',
  `destination` char(192) NOT NULL DEFAULT '',
  `socket` char(128) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `weight` char(64) NOT NULL DEFAULT '1',
  `priority` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` char(64) NOT NULL DEFAULT '',
  `attrs` char(255) DEFAULT NULL,
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_idx` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (1,'52.60.126.237',NULL,'1900-01-01 00:00:01'),(34,'undefined',NULL,'1900-01-01 00:00:01'),(39,'hello2.lineblocs.com',NULL,'1900-01-01 00:00:01'),(40,'hello3.lineblocs.com',NULL,'1900-01-01 00:00:01'),(41,'hello6.lineblocs.com',NULL,'1900-01-01 00:00:01'),(42,'hello7.lineblocs.com',NULL,'1900-01-01 00:00:01'),(43,'hello8.lineblocs.com',NULL,'1900-01-01 00:00:01'),(44,'test15.lineblocs.com',NULL,'1900-01-01 00:00:01'),(45,'matrix-nad.lineblocs.com',NULL,'1900-01-01 00:00:01'),(46,'matrix102030.lineblocs.com',NULL,'1900-01-01 00:00:01'),(47,'test1000.lineblocs.com',NULL,'1900-01-01 00:00:01'),(49,'hello10.lineblocs.com',NULL,'1900-01-01 00:00:01'),(50,'new-1020304.lineblocs.com',NULL,'1900-01-01 00:00:01'),(51,'test-new.lineblocs.com',NULL,'1900-01-01 00:00:01'),(52,'hithere.lineblocs.com',NULL,'1900-01-01 00:00:01'),(53,'test-yup.lineblocs.com',NULL,'1900-01-01 00:00:01'),(54,'test-03-03.lineblocs.com',NULL,'1900-01-01 00:00:01'),(55,'test678909-90.lineblocs.com',NULL,'1900-01-01 00:00:01'),(56,'pbxmaster.lineblocs.com',NULL,'1900-01-01 00:00:01'),(57,'test-upper-1.lineblocs.com',NULL,'1900-01-01 00:00:01'),(58,'test-upper-2.lineblocs.com',NULL,'1900-01-01 00:00:01'),(59,'a-user-1020340.lineblocs.com',NULL,'1900-01-01 00:00:01'),(60,'hello1.lineblocs.com',NULL,'1900-01-01 00:00:01'),(61,'tester.lineblocs.com',NULL,'1900-01-01 00:00:01'),(62,'qatest.lineblocs.com',NULL,'1900-01-01 00:00:01'),(63,'test2.lineblocs.com',NULL,'1900-01-01 00:00:01'),(64,'test11.lineblocs.com',NULL,'1900-01-01 00:00:01'),(65,'test20.lineblocs.com',NULL,'1900-01-01 00:00:01'),(66,'test-project.lineblocs.com',NULL,'1900-01-01 00:00:01'),(67,'test1010.lineblocs.com',NULL,'1900-01-01 00:00:01'),(68,'test2020.lineblocs.com',NULL,'1900-01-01 00:00:01'),(69,'test2030.lineblocs.com',NULL,'1900-01-01 00:00:01'),(70,'test4040.lineblocs.com',NULL,'1900-01-01 00:00:01'),(71,'test9090.lineblocs.com',NULL,'1900-01-01 00:00:01'),(72,'yup1000.lineblocs.com',NULL,'1900-01-01 00:00:01'),(73,'april2.lineblocs.com',NULL,'1900-01-01 00:00:01'),(74,'april6.lineblocs.com',NULL,'1900-01-01 00:00:01'),(75,'test.lineblocs.com',NULL,'1900-01-01 00:00:01'),(76,'john.smith.lineblocs.com',NULL,'1900-01-01 00:00:01'),(77,'john.black.lineblocs.com',NULL,'1900-01-01 00:00:01'),(78,'john.corey.lineblocs.com',NULL,'1900-01-01 00:00:01'),(79,'Testtwo.lineblocs.com',NULL,'1900-01-01 00:00:01'),(80,'Testthree.lineblocs.com',NULL,'1900-01-01 00:00:01'),(81,'ronjohn.lineblocs.com',NULL,'1900-01-01 00:00:01'),(82,'thatstrong91.lineblocs.com',NULL,'1900-01-01 00:00:01'),(83,'newguy2.lineblocs.com',NULL,'1900-01-01 00:00:01'),(84,'test5.lineblocs.com',NULL,'1900-01-01 00:00:01'),(85,'test60.lineblocs.com',NULL,'1900-01-01 00:00:01'),(86,'new10.lineblocs.com',NULL,'1900-01-01 00:00:01'),(87,'new20.lineblocs.com',NULL,'1900-01-01 00:00:01'),(88,'test101010.lineblocs.com',NULL,'1900-01-01 00:00:01'),(89,'john-doe.lineblocs.com',NULL,'1900-01-01 00:00:01'),(90,'edwin.lineblocs.com',NULL,'1900-01-01 00:00:01'),(91,'voipsecurity.lineblocs.com',NULL,'1900-01-01 00:00:01'),(92,'xavier.lineblocs.com',NULL,'1900-01-01 00:00:01'),(93,'super.lineblocs.com',NULL,'1900-01-01 00:00:01'),(94,'mega.lineblocs.com',NULL,'1900-01-01 00:00:01'),(95,'user.lineblocs.com',NULL,'1900-01-01 00:00:01');
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domainpolicy`
--

DROP TABLE IF EXISTS `domainpolicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domainpolicy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dr_carriers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrierid` char(64) NOT NULL,
  `gwlist` char(255) NOT NULL,
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `state` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dr_gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gwid` char(64) NOT NULL,
  `type` int(11) unsigned NOT NULL DEFAULT '0',
  `address` char(128) NOT NULL,
  `strip` int(11) unsigned NOT NULL DEFAULT '0',
  `pri_prefix` char(16) DEFAULT NULL,
  `attrs` char(255) DEFAULT NULL,
  `probe_mode` int(11) unsigned NOT NULL DEFAULT '0',
  `state` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dr_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(128) DEFAULT NULL,
  `groupid` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dr_partitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dr_rules` (
  `ruleid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` char(255) NOT NULL,
  `prefix` char(64) NOT NULL,
  `timerec` char(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `callid` char(25) NOT NULL,
  `selectiveRoutingID` char(11) NOT NULL,
  `routingESN` int(5) unsigned NOT NULL DEFAULT '0',
  `npa` int(3) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_routing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `selectiveRoutingID` char(11) NOT NULL,
  `routingESN` int(5) unsigned NOT NULL DEFAULT '0',
  `npa` int(3) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_service_provider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organizationName` char(50) NOT NULL,
  `hostId` char(30) NOT NULL,
  `nenaId` char(50) NOT NULL,
  `contact` char(20) NOT NULL,
  `certUri` char(50) NOT NULL,
  `nodeIP` char(20) NOT NULL,
  `attribution` int(2) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fraud_detection` (
  `ruleid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profileid` int(10) unsigned NOT NULL,
  `prefix` char(64) NOT NULL,
  `start_hour` char(5) NOT NULL,
  `end_hour` char(5) NOT NULL,
  `daysoftheweek` char(64) NOT NULL,
  `cpm_warning` int(5) unsigned NOT NULL,
  `cpm_critical` int(5) unsigned NOT NULL,
  `call_duration_warning` int(5) unsigned NOT NULL,
  `call_duration_critical` int(5) unsigned NOT NULL,
  `total_calls_warning` int(5) unsigned NOT NULL,
  `total_calls_critical` int(5) unsigned NOT NULL,
  `concurrent_calls_warning` int(5) unsigned NOT NULL,
  `concurrent_calls_critical` int(5) unsigned NOT NULL,
  `sequential_calls_warning` int(5) unsigned NOT NULL,
  `sequential_calls_critical` int(5) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freeswitch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) DEFAULT NULL,
  `password` char(64) NOT NULL,
  `ip` char(20) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '8021',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `globalblacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imc_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `room` char(64) NOT NULL,
  `flag` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imc_rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `flag` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `load_balancer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `dst_uri` char(128) NOT NULL,
  `resources` char(255) NOT NULL,
  `probe_mode` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `contact_id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) DEFAULT NULL,
  `contact` char(255) NOT NULL DEFAULT '',
  `received` char(255) DEFAULT NULL,
  `path` char(255) DEFAULT NULL,
  `expires` int(10) unsigned NOT NULL,
  `q` float(10,2) NOT NULL DEFAULT '1.00',
  `callid` char(255) NOT NULL DEFAULT 'Default-Call-ID',
  `cseq` int(11) NOT NULL DEFAULT '13',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  `flags` int(11) NOT NULL DEFAULT '0',
  `cflags` char(255) DEFAULT NULL,
  `user_agent` char(255) NOT NULL DEFAULT '',
  `socket` char(64) DEFAULT NULL,
  `methods` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missed_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method` char(16) NOT NULL DEFAULT '',
  `from_tag` char(64) NOT NULL DEFAULT '',
  `to_tag` char(64) NOT NULL DEFAULT '',
  `callid` char(64) NOT NULL DEFAULT '',
  `sip_code` char(3) NOT NULL DEFAULT '',
  `sip_reason` char(32) NOT NULL DEFAULT '',
  `time` datetime NOT NULL,
  `setuptime` int(11) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `event` char(64) NOT NULL,
  `etag` char(64) NOT NULL,
  `expires` int(11) NOT NULL,
  `received_time` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pua` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pres_uri` char(255) NOT NULL,
  `pres_id` char(255) NOT NULL,
  `event` int(11) NOT NULL,
  `expires` int(11) NOT NULL,
  `desired_expires` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `etag` char(64) DEFAULT NULL,
  `tuple_id` char(64) DEFAULT NULL,
  `watcher_uri` char(255) DEFAULT NULL,
  `to_uri` char(255) DEFAULT NULL,
  `call_id` char(64) DEFAULT NULL,
  `to_tag` char(64) DEFAULT NULL,
  `from_tag` char(64) DEFAULT NULL,
  `cseq` int(11) DEFAULT NULL,
  `record_route` text,
  `contact` char(255) DEFAULT NULL,
  `remote_contact` char(255) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `re_grp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reg_exp` char(128) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registrar` char(255) NOT NULL DEFAULT '',
  `proxy` char(255) DEFAULT NULL,
  `aor` char(255) NOT NULL DEFAULT '',
  `third_party_registrant` char(255) DEFAULT NULL,
  `username` char(64) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `binding_URI` char(255) NOT NULL DEFAULT '',
  `binding_params` char(64) DEFAULT NULL,
  `expiry` int(1) unsigned DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rls_presentity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rlsubs_did` char(255) NOT NULL,
  `resource_uri` char(255) NOT NULL,
  `content_type` char(255) NOT NULL,
  `presence_state` blob NOT NULL,
  `expires` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `auth_state` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rls_watchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `local_cseq` int(11) NOT NULL,
  `remote_cseq` int(11) NOT NULL,
  `contact` char(64) NOT NULL,
  `record_route` text,
  `expires` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `reason` char(64) NOT NULL,
  `version` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route_tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rtpengine` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `socket` text NOT NULL,
  `set_id` int(10) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rtpproxy_sockets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rtpproxy_sock` text NOT NULL,
  `set_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `silo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src_addr` char(255) NOT NULL DEFAULT '',
  `dst_addr` char(255) NOT NULL DEFAULT '',
  `username` char(64) NOT NULL DEFAULT '',
  `domain` char(64) NOT NULL DEFAULT '',
  `inc_time` int(11) NOT NULL DEFAULT '0',
  `exp_time` int(11) NOT NULL DEFAULT '0',
  `snd_time` int(11) NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sip_trace` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_stamp` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  `callid` char(255) NOT NULL DEFAULT '',
  `trace_attrs` char(255) DEFAULT NULL,
  `msg` text NOT NULL,
  `method` char(32) NOT NULL DEFAULT '',
  `status` char(255) DEFAULT NULL,
  `from_proto` char(5) NOT NULL,
  `from_ip` char(50) NOT NULL DEFAULT '',
  `from_port` int(5) unsigned NOT NULL,
  `to_proto` char(5) NOT NULL,
  `to_ip` char(50) NOT NULL DEFAULT '',
  `to_port` int(5) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smpp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `ip` char(50) NOT NULL,
  `port` int(5) unsigned NOT NULL,
  `system_id` char(16) NOT NULL,
  `password` char(9) NOT NULL,
  `system_type` char(13) NOT NULL DEFAULT '',
  `src_ton` int(10) unsigned NOT NULL DEFAULT '0',
  `src_npi` int(10) unsigned NOT NULL DEFAULT '0',
  `dst_ton` int(10) unsigned NOT NULL DEFAULT '0',
  `dst_npi` int(10) unsigned NOT NULL DEFAULT '0',
  `session_type` int(10) unsigned NOT NULL DEFAULT '1',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speed_dial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriber` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriber`
--

LOCK TABLES `subscriber` WRITE;
/*!40000 ALTER TABLE `subscriber` DISABLE KEYS */;
INSERT INTO `subscriber` VALUES (2,'1000','52.60.126.237','1000','','9d3e7715bc88200f1a75be9f7457fcf7','063f6ac72885ee3e250528f1998fdab7',NULL),(3,'2000','52.60.126.237','ZYBdw3YC','','89b9b6df96201a290d132bb31c43a437','c42431d24cd22b43f39aed07160dcde8',NULL),(4,'7611','52.60.126.237','hello-world','','0de7a3241cb2f735c83b707f34c9f978','b3d0a080638c1c4d2604544a656479d3',NULL),(13,'10000','new-user-111.lineblocs.com','QvK3AcD4IXdDu1JOhINOAVFcNnn5wPR0','','b403221bcacb3287e9a73eb94b3d1fc4','978c8ea52f5083669d601b7de1c9eb7b',NULL),(14,'100','yum789.lineblocs.com','Hx5wslphOmM3dPCrlSZF9rF4Tm6G7BHW','','c3d37de76cc6476af819ddf38869cd08','de099dada8582fa0cfb3fc232ca52c0d',NULL),(15,'105','yum789.lineblocs.com','eHZO4zHTt5PwMLhZi9urHiJcTmyQm9Qh','','bed39fb15e4bcfa7faa1bc949abb4bef','9841480afd5051c1a96190c73583afd9',NULL),(16,'100','hello505.lineblocs.com','08CwRcYxpwEv321q8rwQSdBZjEpd3GQg','','e1b98f292bd7ffc74f23d88a026479a5','f4d14838e861f09c3c0bbaee911ffd4c',NULL),(19,'1000','test5.lineblocs.com','pPE2HVXSWYEZuTWxnZsAl0uLb4DxiSxb','','6e2089c852870c105da474df7f1185aa','c33dd4dac93d108bd59d622e4a031343',NULL),(20,'1001','test5.lineblocs.com','hello123','','15aee9fe349f62cc2879c293b787e552','92274800a7e035dbb8a46e728ec42d45',NULL),(21,'1000','yes-new-7.lineblocs.com','cVm0zpaK32vzrXK9w78hj8cfVDf1JVww','','14ea467c644a16081c0cc2c15d5c130a','78c22d544d86d1aedb7d4a25bebd9bf9',NULL),(23,'1002','yes-new-7.lineblocs.com','wuCGZjtbZWNPt94MB4URrbC450oS6NZ9','','f849c30159d4ac2c52960c81898f53f7','eeed7fa74ff6615f0937f20e2cdcfa07',NULL),(24,'1000','hello2.lineblocs.com','nt8k3BsLOoR1mHWMdhW8XgEyyRkubiwy','','02590abc5e10caff103f0fe7851b3e79','320c42da71654f2ea445e3218e79e8fb',NULL),(25,'1001','hello2.lineblocs.com','xczCFnjSSHtk4OIuNcNUo6FoTwvMbFle','','bf366c4fe10adf425b5cf3f2db64c567','e41fc7bcaae6ae44179cd016b96091c0',NULL),(26,'1000','hello3.lineblocs.com','rqaJYkyoisZGUKBIdokX4ezmz1WI3mxG','','68a5014d6e24241af49714c93ca6cea9','d0e5eb92bdc50513ab7d2d0633f03a17',NULL),(27,'1001','hello3.lineblocs.com','3Gs1El8cxVLxUeJh62USM18NmhC1xSbq','','5e8577081c8e61e891d8d189d4c62727','d625fa6e12c8f6334da461339b5d3007',NULL),(28,'1002','hello3.lineblocs.com','6sbzSlMfrFlLFSDOsgdTjpSE1V4U24NM','','5fe3ef23249456b3f64ef13f1ce73302','b5dc63015957479de96cfae153e2c21b',NULL),(29,'1003','hello3.lineblocs.com','Dv8ojo4yXTUXGY4nHGJ9vCLqCEy5jciV','','e6eef1fe5d67fe02abde016fcc39b365','85631f96f301178f7aa6c425f11a7a3a',NULL),(30,'1004','hello3.lineblocs.com','LvVGrGDRYC9tXCbieFkU7Vhpe3tvtCzZ','','48929a85ca0f31bf093dae1227523c18','0c284ef5afc74bda41748ada44f5a0c2',NULL),(31,'1005','hello3.lineblocs.com','BguHJoGoi9l2jqxToxHRSsIeS0N9Fb5W','','62698f7ea7557df4e3aa8074821eedb3','db60551599c71610d020acb7d51d1150',NULL),(32,'1006','hello3.lineblocs.com','G5uwd6uImLwZauX6XdLEENnCwWHRTJIl','','ec128fc82f6f26ff7377567a81ff4aec','4497a3bc09e1760ff6820ce0e5cb17c7',NULL),(33,'1007','hello3.lineblocs.com','TI19VjDnFQ3MeyyMpKAnCnnoxOgxyI1e','','84d62cbe422d1157ef929f369ab562b2','932f41fa63d3e393ff7cca3c96ff1207',NULL),(34,'1000','test15.lineblocs.com','KufWegm6','','d067ce8856253f70c5a391c1fea6e521','7a4dcc976b62999f9e38b99b5959795c',NULL),(35,'2000','test15.lineblocs.com','Mx1pNtXh','','9c38dbc465ce6f09481b2ba4eb4fa5a4','b8bcfdc956136b575822c711c66ebbbb',NULL),(36,'3000','test15.lineblocs.com','ITeBkPuuIQLv0kwrIheZJjpM0YUz6UA9','','c5866df5f7a1feeebfd3a6ffe197c371','b1c7cea14f7ddde0bbe7bcdafa882ef1',NULL),(43,'1000','hello-yes.lineblocs.com','njXQeVUntt7ixAIKUC2MyMuelKI3Kt6o','','724ccbb5dec3221c286baa8d7d793c86','1e419d9f1e66c9280c5f1da69fc23119',NULL),(45,'1000','test1000.lineblocs.com','qrJOwTTT','','d4661dfe0d80327cb42d71aa25bbed1f','8c37d9b020877023d5548b9cb3048f64',NULL),(46,'2000','test1000.lineblocs.com','yrUxo4zC','','9882cc5b82cb788ba776aff06a2379e2','0efd2f2c45caec5a7cbd850963693f0f',NULL),(52,'1000','new-1020304.lineblocs.com','NEAX0V3i','','6f3bd28b877c28542a1bf5d13e4f25c8','970dd7332a1707b25f119213663c4d2f',NULL),(53,'2000','new-1020304.lineblocs.com','yGqC685U','','f7cdacf206cbe1cfd1098fb5efde72d4','a32b7c9e1c7b0c094430a654e1d99eca',NULL),(54,'500','new-1020304.lineblocs.com','eodBjIpxJYICFRbUsSM5YhmpZn6I00ji','','644804e7b9e03ac163bc5835da66b410','f50cea551d6029958b8c7fbdd4d89275',NULL),(57,'1000','test678909-90.lineblocs.com','IQKZumzlcOAZDJRcRoSywzznZLHxSISr','','94e955fe7726afd40d38f504904ffb57','a7ef72f77c634d65c280a07e34b53461',NULL),(58,'2000','test678909-90.lineblocs.com','MFZjCaav','','bd8d000e9e158e08fccce0f6431bf07d','d4a0739c074b25f0cbc24409bb7d114f',NULL),(60,'1001','test678909-90.lineblocs.com','WyRICvrg39RxReBSNlCJZgU7KjLIdFRl','','5c0fba3dd649c00545abb42e71f526dc','dd974f8b4b9f1b91bb33ceac0c9847e1',NULL),(61,'1000','a-user-1020340.lineblocs.com','fnzPgnEz','','acc5b8528fb9c63262229e59f67ac008','97c8b210c898c58ce77fd119e39e5037',NULL),(62,'2000','a-user-1020340.lineblocs.com','kXfQbvKP','','549424a6b81ec89ca9a1eb1d35d8c1e2','f53b3caf9a7b31b2e029db932212a359',NULL),(63,'8000','a-user-1020340.lineblocs.com','x3KvzUDxDSC4pfXAthNv8uv5QlQQnUjH','','0487e8cfbfd118aa633db167014fa138','3ab80c94dc9b9a13ca9d490ca6573455',NULL),(66,'3000','hello10.lineblocs.com','0000000','','914a02813aae245515f635966d0df1e9','ad12b6e437f3435b8710b79aed443258',NULL),(71,'1000','test-project.lineblocs.com','u5ctHgSt','','acc2d04fa6257f39cf98f604603eee8a','ffffe8dd023269b14af2934ff4a1ff69',NULL),(72,'2000','test-project.lineblocs.com','UknpkE7I','','f22be163dbf57ee1442f2c89bbe08e0e','7d0af2b80d861faf29b5fd6e2b7aff31',NULL),(74,'TestUser02','test-project.lineblocs.com','1234tsh@76','','ae754bb936e23e3eafbae3c57b49b589','7498c8d9da7119e430e90c477b7601c1',NULL),(76,'Test User01 Updated','test-project.lineblocs.com','eDE2KJSvi5apvPl4DeogxkuEQS9i0uto','','4a62db3de6f93da687a6a865b810b8aa','6a1e39370838a16485878233d2763079',NULL),(77,'1000','test.lineblocs.com','DOfA6LdsqNW4FDJWlBRYEu8EuUiZwqYh','','91c681dbaddaf7ea257b69618575c2ea','9bbffa603f906a8fb18f368e48787a85',NULL),(78,'2000','test.lineblocs.com','eQvv6Ghm','','a7c8906d65727f8328958caed92646b0','422576aa5dd69025c992a698121a3d99',NULL),(81,'1000','john.corey.lineblocs.com','RmYIStkl','','fe36148878cf8e8bd4aa4069296cc0b9','c89ec3d14a228eff6d45c74ace366a7c',NULL),(84,'2000','john.corey.lineblocs.com','D7JvU4LZpolY1ERUam1nb3gydtA7LeGA','','e0d78522b22557caea53a67d01bcc51d','eef5ca3f5942d6ff8ae78afb2bc5897d',NULL),(85,'3000','john.corey.lineblocs.com','EfRdg8FuDJkmBXDec5q6j3vesHIlnLAG','','c29f40a1c8387e639f4e72833022d0ee','859acc3ee4821705e899fe0132fd8bbd',NULL),(86,'4000','john.corey.lineblocs.com','1zNEe5scL409BP6I5hMb5HVmjfU4I9Jy','','31ec3cfa3fe3215e5576df729ebb48f2','dbd488fb9856f695d6cd63e51b5e8de6',NULL),(87,'5000','john.corey.lineblocs.com','CMr5s6t09Sr4ftffX2YYtsUHamepLXEj','','b7f9c7253e356837e7ecc98898d6e7fa','f48bf04c2a9c9ad6869c86d6d2725c17',NULL),(88,'6000','john.corey.lineblocs.com','eudf1qEvvvCCyHRSa9nPxVuJE79jX5Fd','','a8e8963e2cbf930ef9d93593df45040b','d44608436bf9f55c99cdb020f0da004c',NULL),(89,'9000','john.corey.lineblocs.com','O0dcy7Ierz94JQJ6xyX0yiJXiecbWNTB','','4b45489a237dd3c181beda9cbaa44d5b','c8bfe8613990482d8ed4609d1afa823a',NULL),(90,'1000','thatstrong91.lineblocs.com','2vg7yfPJ','','170f0c4e990a4a9111c253e844d89eaa','90d2590643f214672c13b533a97a06e6',NULL),(91,'2000','thatstrong91.lineblocs.com','lyun4qTz','','8c45982108320c071b160414d670567c','ecef7876668b1585f88a48196e6e47ed',NULL),(92,'1337','thatstrong91.lineblocs.com','FSAtPBG96OCsCExVQfUjHNafpi3M5j86','','29aeb1a85bacb6bedbc69b0208a59f59','686a2963d4231ec7fc76b909c87a31f2',NULL),(93,'34000','hello10.lineblocs.com','ewfw222','','efa57eab1bcdd718fc2130ba92312f8e','086d6a2e4af3260131d145b30d35d9c0',NULL),(94,'6000','hello10.lineblocs.com','eczFaiiMaQuBb83HNKYzEMUT2ogmdbog','','850c6db0642ddb80dff25c083c948308','c508f6b0d897b2ae2760e1300f2e9ff5',NULL),(97,'1000','test60.lineblocs.com','EOkWqn1b','','756bf265cc2f22674e48d966c88835eb','c145cdac369f36f55cfd30ab6ca11ee1',NULL),(98,'2000','test60.lineblocs.com','j9J5bab3','','8020be3f6f4f7994f209a4fce0132397','1b7b95be67477deaf4e12091ed0d2fd8',NULL),(99,'4000','test60.lineblocs.com','MLETJLZzmMhuxTIoqdtVjSw83aqHuX3k','','2e34719cf42af9485e3d66dad10907e9','10fa70d3f4e3834cb37071acbe51be6c',NULL),(101,'5000','hello10.lineblocs.com','HjzlVzUWpRu5VIjiKVfpTDF7GYTXUI2C','','ec464a310d35b4c9bfaaf199f001dfa7','25d40543a5baa39d16d7e337e62be13b',NULL),(102,'1000','hello10.lineblocs.com','E4bZJEdP5r2uIghcGWDIlsBj2zjsIrvO','','6a23e1aac05befbacf5dde5e3f52886f','22b43f35d39aaa3dfdae702c75a28d37',NULL),(112,'1000','edwin.lineblocs.com','Opawid1m','','ec898d12a5c6e4bd293bb84615f62373','2c9082685c8b0cc520107c8a312690a8',NULL),(113,'2000','edwin.lineblocs.com','8SpGhTMA','','931ed6497838cf645e3b3913273fe22a','476338f994698eca7912b02e66e56ee1',NULL),(114,'5000','edwin.lineblocs.com','testLine','','91c34ce027f629cf297c3d7420849193','3f519da70bae49be3d8a05cac4a84917',NULL),(115,'6000','edwin.lineblocs.com','testLine','','db408227b87074732649dd40c7562f51','a383d248d9ac1c8ac477ae6df0f32ae0',NULL),(116,'1000','voipsecurity.lineblocs.com','1E3sXf78','','3b940fc3de98139fef3b55ac71de603e','5edb0a54994b956c76421c2d1f3f0398',NULL),(117,'2000','voipsecurity.lineblocs.com','MvU1UbVZ','','24086da79292f5dcf60f81a32560cdbf','735c09f925e565ad7cd6ee544ad3d7a5',NULL),(118,'999','voipsecurity.lineblocs.com','test2020','','7fb06abf2ad9ef56f5b0b1a40327c355','93a5d051217007ed765c4e5239533e0e',NULL),(119,'900','voipsecurity.lineblocs.com','testLine','','08bf104d81a2b346cd96308c02e663c3','c727af7f0f94705e85ecbf4d0067feb6',NULL),(120,'1000','xavier.lineblocs.com','9ehUaZog','','21876de73d7b92d6d719b0a71f00d704','600b5305772880a635d9a861331f7e3a',NULL),(121,'2000','xavier.lineblocs.com','mvrDFews','','9b955928d8f967e8eba9d60ca34576c3','815be8d424ae933047175dc96f842ec9',NULL),(122,'1000','super.lineblocs.com','FYP1471T','','a73dbbc0fc59e7918601396fc7d587d3','bcc33c6dff732b87ba9ffba57b4bc4d1',NULL),(123,'2000','super.lineblocs.com','KChETG0D','','f6e57a5b0d69d848bd906765752126ea','311d5f3a2313be16f2dfe7daea7dd273',NULL),(124,'1000','mega.lineblocs.com','bx37kcvT','','e3f7b3aa4a9a2f8ccc2316b9acae1b0a','77bcd0e25dcbd3bfe0bb504e5005a8ae',NULL),(125,'2000','mega.lineblocs.com','XYztQKJB','','6d9a21c90e2fda88935d8a7924ca68d7','98d905304f2fb075596f64ce84afb81c',NULL),(126,'1000','user.lineblocs.com','6mifssCw','','2e75dc3867ff66af7687d29014aab36f','dac08f94d81722e0f3ef71f0d6457dc3',NULL),(127,'2000','user.lineblocs.com','VcTiRWbh','','b76122bc87091de2b4c775f3af59c4bb','7686bdafe9a777b5bf93914ef8534279',NULL),(128,'10000','user.lineblocs.com','7MuflTP4SIlYwLC2xzbt375EuDj21Yab','','65a8dec63f27a4a432732fe3f5c1a6a4','2b37888a88ebb809db0fa770e1d075b8',NULL),(129,'2','hello-yes.lineblocs.com','b5fQbMqXsxyN3TRZn5YtU7iksdviYBKR','','abea12b6487e917da8bbde411e0395a0','baff0d9eb6faf5ea1699a9bc33313bb4',NULL);
/*!40000 ALTER TABLE `subscriber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tls_mgm`
--

DROP TABLE IF EXISTS `tls_mgm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tls_mgm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` char(64) NOT NULL,
  `match_ip_address` char(255) DEFAULT NULL,
  `match_sip_domain` char(255) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `method` char(16) DEFAULT 'SSLv23',
  `verify_cert` int(1) DEFAULT '1',
  `require_cert` int(1) DEFAULT '1',
  `certificate` blob,
  `private_key` blob,
  `crl_check_all` int(1) DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uri` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userblacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr_preferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(64) NOT NULL DEFAULT '',
  `username` char(64) NOT NULL DEFAULT '0',
  `domain` char(64) NOT NULL DEFAULT '',
  `attribute` char(32) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0',
  `value` char(128) NOT NULL DEFAULT '',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  KEY `ua_idx` (`uuid`,`attribute`),
  KEY `uda_idx` (`username`,`domain`,`attribute`),
  KEY `value_idx` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_preferences`
--

LOCK TABLES `usr_preferences` WRITE;
/*!40000 ALTER TABLE `usr_preferences` DISABLE KEYS */;
INSERT INTO `usr_preferences` VALUES (1,'','7611','52.60.126.237','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(2,'','7611','52.60.126.237','dest_domain',0,'172.31.24.67:5062','1900-01-01 00:00:01'),(17,'','10000','new-user-111.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(18,'','10000','new-user-111.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(19,'','100','yum789.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(20,'','100','yum789.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(21,'','105','yum789.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(22,'','105','yum789.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(23,'','100','hello505.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(24,'','100','hello505.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(29,'','1000','test5.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(30,'','1000','test5.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(31,'','1001','test5.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(32,'','1001','test5.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(33,'','1000','yes-new-7.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(34,'','1000','yes-new-7.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(35,'','1002','yes-new-7.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(36,'','1002','yes-new-7.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(37,'','1000','hello2.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(38,'','1000','hello2.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(39,'','1001','hello2.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(40,'','1001','hello2.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(41,'','1000','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(42,'','1000','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(43,'','1001','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(44,'','1001','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(45,'','1002','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(46,'','1003','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(47,'','1004','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(48,'','1005','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(49,'','1006','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(50,'','1007','hello3.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(51,'','1002','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(52,'','1003','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(53,'','1004','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(54,'','1005','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(55,'','1006','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(56,'','1007','hello3.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(57,'','1000','test15.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(58,'','2000','test15.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(59,'','3000','test15.lineblocs.com','dest_domain',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(60,'','1000','test15.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(61,'','2000','test15.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(62,'','3000','test15.lineblocs.com','main_ip',0,'172.31.18.26','1900-01-01 00:00:01'),(63,'','1000','hello-yes.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(65,'','1000','hello-yes.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(67,'','1000','hello-yes.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(69,'','1000','test1000.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(70,'','2000','test1000.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(76,'','1000','new-1020304.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(77,'','2000','new-1020304.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(78,'','500','new-1020304.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(81,'','1000','test678909-90.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(82,'','2000','test678909-90.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(83,'','1001','test678909-90.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(84,'','1000','a-user-1020340.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(85,'','2000','a-user-1020340.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(86,'','8000','a-user-1020340.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(89,'','3000','hello10.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(94,'','1000','test-project.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(95,'','2000','test-project.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(97,'','TestUser02','test-project.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(99,'','Test User01 Updated','test-project.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(100,'','1000','test.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(101,'','2000','test.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(104,'','1000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(106,'','2000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(107,'','3000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(108,'','4000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(109,'','5000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(110,'','6000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(111,'','9000','john.corey.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(112,'','1000','thatstrong91.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(113,'','2000','thatstrong91.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(114,'','1337','thatstrong91.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(115,'','34000','hello10.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(116,'','6000','hello10.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(119,'','1000','test60.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(120,'','2000','test60.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(121,'','4000','test60.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(123,'','5000','hello10.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(124,'','1000','hello10.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(134,'','1000','edwin.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(135,'','2000','edwin.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(136,'','5000','edwin.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(137,'','6000','edwin.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(138,'','1000','voipsecurity.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(139,'','2000','voipsecurity.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(140,'','999','voipsecurity.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(141,'','900','voipsecurity.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(142,'','1000','xavier.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(143,'','2000','xavier.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(144,'','1000','super.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(145,'','2000','super.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(146,'','1000','mega.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(147,'','2000','mega.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(148,'','1000','user.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(149,'','2000','user.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01'),(150,'','10000','user.lineblocs.com','main_ip',0,'172.31.24.67:5060','1900-01-01 00:00:01'),(151,'','2','hello-yes.lineblocs.com','main_ip',0,':5060','1900-01-01 00:00:01');
/*!40000 ALTER TABLE `usr_preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `version` (
  `table_name` char(32) NOT NULL,
  `table_version` int(10) unsigned NOT NULL DEFAULT '0',
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `watchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` char(255) NOT NULL,
  `watcher_username` char(64) NOT NULL,
  `watcher_domain` char(64) NOT NULL,
  `event` char(64) NOT NULL DEFAULT 'presence',
  `status` int(11) NOT NULL,
  `reason` char(64) DEFAULT NULL,
  `inserted_time` int(11) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xcap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `domain` char(64) NOT NULL,
  `doc` longblob NOT NULL,
  `doc_type` int(11) NOT NULL,
  `etag` char(64) NOT NULL,
  `source` int(11) NOT NULL,
  `doc_uri` char(255) NOT NULL,
  `port` int(11) NOT NULL,
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

-- Dump completed on 2020-05-24  2:58:35
