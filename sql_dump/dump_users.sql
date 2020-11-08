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
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Aleksandr','Valenchits','man',27,1604246703,'engeneer of automation',298940113,'chitsalex@gmail.com','123','user',10,'dkaSaMdB5Olcg9Guser','fxLYt19CeL4:APA91bGA1WphFTDtvwvnbO8V5uxJf33OIW8IP964qzQhRSNaIuFyyU_3tOnwuJVJCN27K81Jx-RXrhsmszzQQyNUrZqnWZpIPN69RirBOeSS0dU-p3PcGK0gQlIImdqlNMjLIhmkF5Zv'),(9,'Roman','Belyackiy','man',NULL,1595924193,'engeneer',NULL,'roama@tut.by','z1x2c3v4','roman',10,'3nVWoYX8TJ7muqZGroman',NULL),(10,'test','test','--',0,1556107448,'test',NULL,'--','12345678','test',5,'iJH6MUcKffvDjT73Test','cdi5ISex9Bw:APA91bESPTig8apoyJED3yqxr0kBSR2Kj-pJawXnOPj_CYRjLLdjRG4cqf1k7hF0MV1RcQqrEUPaLkkNep_xlcbGik3K5gPxk1NaE5TrWbZvMprlnTWCgmM_F7t607wuhuHLTj0vxj4n'),(11,'Ð’Ð¸ÐºÑ‚Ð¾Ñ€','Ð“Ð°Ñ†ÐºÐ¾','--',NULL,1554288293,'Ð“Ð»Ð°Ð²Ð½Ñ‹Ð¹ Ð¸Ð½Ð¶ÐµÐ½ÐµÑ€',NULL,'--','z1x2c3v4','CheifEngineer',10,NULL,NULL),(12,'Ð Ð¾Ð¼Ð°Ð½','ÐšÑƒÑ€Ð¼Ð°Ð·','--',NULL,1594043207,'Ð²ÐµÐ´ÑƒÑ‰Ð¸Ð¹ Ð¼ÐµÑ…Ð°Ð½Ð¸Ðº ',NULL,'--','103103','kurmaz',10,'DPmGdbLbuyFIKv47bmKurmaz',NULL),(13,'Planshet1','Pl','--',0,NULL,'Planshet',NULL,'--','qwert','planshet1',5,NULL,NULL),(15,'ÐÐ½Ð´Ñ€ÐµÐ¹','ÐŸÐ°Ñ€Ñ‚ÑÐ½ÐºÐ¾Ð²','--',0,1558514437,'Ð“ÐµÐ½ÐµÑ€Ð°Ð»ÑŒÐ½Ñ‹Ð¹ Ð´Ð¸Ñ€ÐµÐºÑ‚Ð¾Ñ€',NULL,'--','Qwerty123','director',10,'DWOIQFxIWcUxuzM3VDTddirector',NULL),(16,'ÐŸÐ°Ð²ÐµÐ»','ÐÐ¾Ð²Ð¸ÐºÐ¾Ð²','--',NULL,1603874986,'ÑÐ½ÐµÑ€Ð³ÐµÑ‚Ð¸Ðº',NULL,'--','587672','novikovenergy',9,'vLWC9AdXORuQyl8u85AFHZgVwnovikovenergy',NULL),(17,'ÐœÐ°ÑÑ‚ÐµÑ€','Ð›ÑƒÑ‰Ð¸Ð»ÑŒÐ½Ð¾Ð³Ð¾','--',0,1558357251,'ÐœÐ°ÑÑ‚ÐµÑ€',NULL,'--','1194','vdv94',9,'SXtnYy5jNXRbAMO5VVDV94',NULL),(18,'ÐŸÐ°Ð²ÐµÐ»','ÐÐ¾Ð²Ð¸ÐºÐ¾Ð²','--',0,NULL,'Ð˜Ð½Ð¶ÐµÐ½ÐµÑ€-ÑÐ½ÐµÑ€Ð³ÐµÑ‚Ð¸Ðº',NULL,'--','12345678','novikov',9,NULL,NULL),(19,'Ð˜Ñ€Ð¸Ð½Ð°','Ð¡Ð¾ÐºÐ¾Ð»Ð¾Ð²ÑÐºÐ°Ñ','--',NULL,1583312281,'Ð¸Ð½Ð¶ÐµÐ½ÐµÑ€-Ñ‚ÐµÑ…Ð½Ð¾Ð»Ð¾Ð³',NULL,'--','4648093399555554165bhf','mirochka23',9,'lyxeRQm9H9eYrRez10WKcImirochka23',NULL),(20,'ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€','Ð¡Ñ‚Ð°Ñ‚ÐºÐµÐ²Ð¸Ñ‡','--',0,1594223024,'Ð·Ð°Ð¼ Ð³Ð» Ð¸Ð½Ð¶ÐµÐ½ÐµÑ€Ð°',NULL,'--','statkevich','statkevich',10,'iEqNdPHO7dMBCKUQiHIzxkstatkevich',NULL),(21,'Ð’Ð¸Ñ‚Ð°Ð»Ð¸Ð¹ ','ÐœÐµÐ»ÑŒÐ½Ð¸ÐºÐ¾Ð² ','--',NULL,1603804291,'Ð’ÐµÐ´ÑƒÑ‰Ð¸Ð¹ Ð¼ÐµÑ…Ð°Ð½Ð¸Ðº ',NULL,'--','Aezakmi1204','Jiner',10,'QIraiaVr07Hpb36o3Jiner',NULL),(22,'Ð•Ð²Ð³ÐµÐ½Ð¸Ð¹','Ð•Ð²ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ð²','--',NULL,1579672801,'Ð¼ÐµÑ…Ð°Ð½Ð¸Ðº',NULL,'--','qwertyuiop','EEA88',9,'rDcCmr6JxT2TBoFDBEEA88','fqVt6lxloG8:APA91bFX4__eiffANmymwk4eyTr4YknPVpNpAcU_Q6CpvjmQ9YWAuKfYFBtPKqZsFRlahAsv_rGHyta0I4j5pvjq7eggpY8rk48xGyHQAIxO7PkwQ_n2lvnM7pypedJI3pzSv0NjD07v'),(23,'Ð”Ð¼Ð¸Ñ‚Ñ€Ð¸Ð¹','Ð Ð°Ð¿Ð¸Ð½Ñ‡ÑƒÐº','--',NULL,1580267288,'--',NULL,'--','rapinchuk','rapinchuk',10,'UNgv9NJBXf3oR1kVAH4vhrapinchuk',NULL),(24,'ÐšÐ°Ñ‚Ñ','ÐšÑƒÐ·ÑŒÐ¼ÐµÐ½ÐºÐ¾','--',NULL,1604057891,'Ð˜Ð½Ð¶ÐµÐ½ÐµÑ€ ÐŸÐŸ',NULL,'--','kuzmenko','kuzmenko',9,'g9yeLrpvupxe5hLLIN3Jkuzmenko',NULL),(25,'ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€','ÐšÑƒÐ»Ð¸Ðº','--',0,1593492492,'Ð­Ð½ÐµÑ€Ð³ÐµÑ‚Ð¸Ðº',NULL,'--','12345678','Energy',10,'gPM7BJfIOR1W11NvuoEnergy',NULL),(26,'ÐÐ½Ñ‚Ð¾Ð½','ÐšÐ¸Ñ‚Ð¾Ð²','--',NULL,1585661224,'Ð¼ÐµÑ…Ð°Ð½Ð¸Ðº',NULL,'--','anton20041996','criket',10,'tG2lArt4WYMmfGdALXcriket',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-01 19:27:23
