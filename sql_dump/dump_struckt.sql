-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: fanDOK
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `OeeIpTable`
--

DROP TABLE IF EXISTS `OeeIpTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OeeIpTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(120) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='table for java connection to plc and owen ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SystemLog`
--

DROP TABLE IF EXISTS `SystemLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SystemLog` (
  `logMessage` text,
  `timeStamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `agregats`
--

DROP TABLE IF EXISTS `agregats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agregats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `oborid` int(11) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob1_podsh_m`
--

DROP TABLE IF EXISTS `drob1_podsh_m`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob1_podsh_m` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6123608 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_1`
--

DROP TABLE IF EXISTS `drob_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_1_oee`
--

DROP TABLE IF EXISTS `drob_1_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_1_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_1_p1`
--

DROP TABLE IF EXISTS `drob_1_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_1_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6327291 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_1_p2`
--

DROP TABLE IF EXISTS `drob_1_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_1_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6327194 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_2`
--

DROP TABLE IF EXISTS `drob_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_2_oee`
--

DROP TABLE IF EXISTS `drob_2_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_2_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_2_p1`
--

DROP TABLE IF EXISTS `drob_2_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_2_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6327242 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_2_p2`
--

DROP TABLE IF EXISTS `drob_2_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_2_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6327244 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_2_pdshM`
--

DROP TABLE IF EXISTS `drob_2_pdshM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_2_pdshM` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6123726 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_3`
--

DROP TABLE IF EXISTS `drob_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_3_oee`
--

DROP TABLE IF EXISTS `drob_3_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_3_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_3_p1`
--

DROP TABLE IF EXISTS `drob_3_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_3_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6619719 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_3_p2`
--

DROP TABLE IF EXISTS `drob_3_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_3_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6619615 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `drob_3_pod_motor`
--

DROP TABLE IF EXISTS `drob_3_pod_motor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drob_3_pod_motor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6376655 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `err_message`
--

DROP TABLE IF EXISTS `err_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `err_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `acknowledgment` int(11) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1694843 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gidro`
--

DROP TABLE IF EXISTS `gidro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gidro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_o`
--

DROP TABLE IF EXISTS `group_o`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_o` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_1_p1`
--

DROP TABLE IF EXISTS `lu_1_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_1_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2667919 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_1_p2`
--

DROP TABLE IF EXISTS `lu_1_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_1_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2666650 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_1_p3`
--

DROP TABLE IF EXISTS `lu_1_p3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_1_p3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2666645 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_1_p4`
--

DROP TABLE IF EXISTS `lu_1_p4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_1_p4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2667301 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_1_p5`
--

DROP TABLE IF EXISTS `lu_1_p5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_1_p5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2671638 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_3_p1`
--

DROP TABLE IF EXISTS `lu_3_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_3_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6473590 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_3_p2`
--

DROP TABLE IF EXISTS `lu_3_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_3_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6473506 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_3_p3`
--

DROP TABLE IF EXISTS `lu_3_p3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_3_p3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6473501 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_3_p4`
--

DROP TABLE IF EXISTS `lu_3_p4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_3_p4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6473488 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_3_p5`
--

DROP TABLE IF EXISTS `lu_3_p5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_3_p5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6473639 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_1`
--

DROP TABLE IF EXISTS `lu_N_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1434767 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_1_Data`
--

DROP TABLE IF EXISTS `lu_N_1_Data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_1_Data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `shift` int(11) DEFAULT NULL,
  `timeStamp` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=620652 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_1_oee`
--

DROP TABLE IF EXISTS `lu_N_1_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_1_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80540 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_2`
--

DROP TABLE IF EXISTS `lu_N_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1360031 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_2_Data`
--

DROP TABLE IF EXISTS `lu_N_2_Data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_2_Data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `shift` int(11) DEFAULT NULL,
  `timeStamp` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=565626 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_2_oee`
--

DROP TABLE IF EXISTS `lu_N_2_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_2_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80537 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3`
--

DROP TABLE IF EXISTS `lu_N_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1338432 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_Data`
--

DROP TABLE IF EXISTS `lu_N_3_Data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_Data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `shift` int(11) DEFAULT NULL,
  `timeStamp` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=543704 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_oee`
--

DROP TABLE IF EXISTS `lu_N_3_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80537 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_p1`
--

DROP TABLE IF EXISTS `lu_N_3_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5596381 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_p2`
--

DROP TABLE IF EXISTS `lu_N_3_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5596304 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_p3`
--

DROP TABLE IF EXISTS `lu_N_3_p3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_p3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5596337 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_p4`
--

DROP TABLE IF EXISTS `lu_N_3_p4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_p4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5596384 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lu_N_3_p5`
--

DROP TABLE IF EXISTS `lu_N_3_p5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lu_N_3_p5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5596760 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `luschilki_plan`
--

DROP TABLE IF EXISTS `luschilki_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `luschilki_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` float(15,2) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `smena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `parentid_o` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oborudovanie`
--

DROP TABLE IF EXISTS `oborudovanie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oborudovanie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `sr_oee_day` int(11) DEFAULT NULL,
  `sr_oee_weak` int(11) DEFAULT NULL,
  `sr_oee_mounth` int(11) DEFAULT NULL,
  `sr_oee_year` int(11) DEFAULT NULL,
  `tablename` varchar(510) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `oee` tinyint(1) DEFAULT NULL,
  `length` varchar(20) DEFAULT NULL,
  `vibro` tinyint(1) DEFAULT NULL,
  `plain` int(11) DEFAULT NULL,
  `groupObor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `obreznoy`
--

DROP TABLE IF EXISTS `obreznoy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obreznoy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197820 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `obreznoy_oee`
--

DROP TABLE IF EXISTS `obreznoy_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obreznoy_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p12`
--

DROP TABLE IF EXISTS `p12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p12` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point123`
--

DROP TABLE IF EXISTS `point123`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point123` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point22`
--

DROP TABLE IF EXISTS `point22`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point22` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point_control`
--

DROP TABLE IF EXISTS `point_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `sr_vibro_day` double(5,2) DEFAULT NULL,
  `sr_vibro_week` double(5,2) DEFAULT NULL,
  `sr_vibro_mounth` double(5,2) DEFAULT NULL,
  `sr_vibro_year` double(5,2) DEFAULT NULL,
  `tablename` varchar(90) DEFAULT NULL,
  `granica_mess` int(11) DEFAULT NULL,
  `granica_alarm` int(11) DEFAULT NULL,
  `idchange` int(11) DEFAULT NULL,
  `timechange` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `adress` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point_drobilka`
--

DROP TABLE IF EXISTS `point_drobilka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_drobilka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `point_motor`
--

DROP TABLE IF EXISTS `point_motor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_motor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press1`
--

DROP TABLE IF EXISTS `press1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72764 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press1_oee`
--

DROP TABLE IF EXISTS `press1_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press1_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press2`
--

DROP TABLE IF EXISTS `press2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73189 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press2_oee`
--

DROP TABLE IF EXISTS `press2_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press2_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press3`
--

DROP TABLE IF EXISTS `press3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49832 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press3_oee`
--

DROP TABLE IF EXISTS `press3_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press3_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press4`
--

DROP TABLE IF EXISTS `press4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82443 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `press4_oee`
--

DROP TABLE IF EXISTS `press4_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `press4_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `repairs`
--

DROP TABLE IF EXISTS `repairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repairs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_obor` int(11) DEFAULT NULL,
  `typeOfRepair` int(11) DEFAULT NULL,
  `uzel` varchar(255) DEFAULT NULL,
  `prichina` text,
  `detailNameDestroy` varchar(255) DEFAULT NULL,
  `codeDetailDestroy` varchar(255) DEFAULT NULL,
  `datailNameNew` varchar(255) DEFAULT NULL,
  `codeDetailNew` varchar(255) DEFAULT NULL,
  `colMan` int(11) DEFAULT NULL,
  `startTime` int(11) DEFAULT NULL,
  `endTime` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `opisanie` text,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_left`
--

DROP TABLE IF EXISTS `saw_left`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_left` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1585285 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_left_oee`
--

DROP TABLE IF EXISTS `saw_left_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_left_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80511 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_left_v_p1`
--

DROP TABLE IF EXISTS `saw_left_v_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_left_v_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7052930 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_right`
--

DROP TABLE IF EXISTS `saw_right`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=780261 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_right_oee`
--

DROP TABLE IF EXISTS `saw_right_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_right_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saw_right_p2`
--

DROP TABLE IF EXISTS `saw_right_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saw_right_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6880123 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `scaner`
--

DROP TABLE IF EXISTS `scaner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scaner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `D_in` double(8,2) DEFAULT NULL,
  `D_out` double(8,2) DEFAULT NULL,
  `D_av` double(8,2) DEFAULT NULL,
  `length` double(8,2) DEFAULT NULL,
  `V_com` double(10,4) DEFAULT NULL,
  `V_all` double(10,4) DEFAULT NULL,
  `Q` double(8,2) DEFAULT NULL,
  `pairentobor` int(11) DEFAULT NULL,
  `D_start` double(10,4) DEFAULT NULL,
  `D_remain` double(10,4) DEFAULT NULL,
  `H_veneer` double(10,4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `timeoperation` int(11) DEFAULT NULL,
  `S_veneer` double(10,2) DEFAULT NULL,
  `L_veneer` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p1`
--

DROP TABLE IF EXISTS `shlif_p1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5550789 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p10`
--

DROP TABLE IF EXISTS `shlif_p10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p10` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552478 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p11`
--

DROP TABLE IF EXISTS `shlif_p11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p11` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552533 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p12`
--

DROP TABLE IF EXISTS `shlif_p12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p12` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552507 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p13`
--

DROP TABLE IF EXISTS `shlif_p13`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p13` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552503 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p14`
--

DROP TABLE IF EXISTS `shlif_p14`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p14` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552531 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p15`
--

DROP TABLE IF EXISTS `shlif_p15`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p15` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552550 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p16`
--

DROP TABLE IF EXISTS `shlif_p16`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p16` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552761 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p2`
--

DROP TABLE IF EXISTS `shlif_p2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548879 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p3`
--

DROP TABLE IF EXISTS `shlif_p3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548513 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p4`
--

DROP TABLE IF EXISTS `shlif_p4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548288 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p5`
--

DROP TABLE IF EXISTS `shlif_p5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548313 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p6`
--

DROP TABLE IF EXISTS `shlif_p6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548384 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p7`
--

DROP TABLE IF EXISTS `shlif_p7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p7` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5548451 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p8`
--

DROP TABLE IF EXISTS `shlif_p8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p8` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5551783 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlif_p9`
--

DROP TABLE IF EXISTS `shlif_p9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlif_p9` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5552577 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlifstanok`
--

DROP TABLE IF EXISTS `shlifstanok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlifstanok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143677 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shlifstanok_oee`
--

DROP TABLE IF EXISTS `shlifstanok_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shlifstanok_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80511 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status_connection`
--

DROP TABLE IF EXISTS `status_connection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_connection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sushilka`
--

DROP TABLE IF EXISTS `sushilka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sushilka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `coment` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=597132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sushilka_oee`
--

DROP TABLE IF EXISTS `sushilka_oee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sushilka_oee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `A` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `OEE` int(11) DEFAULT NULL,
  `prichina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startperiod` int(11) DEFAULT NULL,
  `endperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(25) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `lastInsert` int(150) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `nikname` varchar(120) DEFAULT NULL,
  `levelAccess` int(10) DEFAULT NULL,
  `token` text,
  `token_push` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vibroIndication`
--

DROP TABLE IF EXISTS `vibroIndication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vibroIndication` (
  `hl_1` tinyint(1) DEFAULT NULL,
  `hl_2` tinyint(1) DEFAULT NULL,
  `hl_3` tinyint(1) DEFAULT NULL,
  `hl_4` tinyint(1) DEFAULT NULL,
  `hl_5` tinyint(1) DEFAULT NULL,
  `hl_6` tinyint(1) DEFAULT NULL,
  `hl_7` tinyint(1) DEFAULT NULL,
  `hl_8` tinyint(1) DEFAULT NULL,
  `hl_9` tinyint(1) DEFAULT NULL,
  `hl_10` tinyint(1) DEFAULT NULL,
  `hl_11` tinyint(1) DEFAULT NULL,
  `hl_12` tinyint(1) DEFAULT NULL,
  `hl_13` tinyint(1) DEFAULT NULL,
  `hl_14` tinyint(1) DEFAULT NULL,
  `hl_15` tinyint(1) DEFAULT NULL,
  `hl_16` tinyint(1) DEFAULT NULL,
  `hl_17` tinyint(1) DEFAULT NULL,
  `hl_18` tinyint(1) DEFAULT NULL,
  `hl_19` tinyint(1) DEFAULT NULL,
  `hl_20` tinyint(1) DEFAULT NULL,
  `hl_21` tinyint(1) DEFAULT NULL,
  `hl_22` tinyint(1) DEFAULT NULL,
  `hl_23` tinyint(1) DEFAULT NULL,
  `hl_24` tinyint(1) DEFAULT NULL,
  `hl_25` tinyint(1) DEFAULT NULL,
  `hl_26` tinyint(1) DEFAULT NULL,
  `hl_27` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `woodData`
--

DROP TABLE IF EXISTS `woodData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woodData` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xData` text,
  `yData` text,
  `stringKey` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `woodData_2`
--

DROP TABLE IF EXISTS `woodData_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woodData_2` (
  `id` int(11) DEFAULT NULL,
  `xData` text,
  `yData` text,
  `stringKey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `woodData_3`
--

DROP TABLE IF EXISTS `woodData_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woodData_3` (
  `id` int(11) NOT NULL,
  `xCentre` double DEFAULT NULL,
  `yCentre` double DEFAULT NULL,
  `radius` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `woodParams`
--

DROP TABLE IF EXISTS `woodParams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `woodParams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inputRad` double DEFAULT NULL,
  `outputRad` double DEFAULT NULL,
  `avrRad` double DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `usefulVolume` double DEFAULT NULL,
  `timeStamp` int(11) DEFAULT NULL,
  `curvature` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40927 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-01 18:49:39
