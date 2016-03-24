-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: user108
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_country` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyers`
--

LOCK TABLES `buyers` WRITE;
/*!40000 ALTER TABLE `buyers` DISABLE KEYS */;
INSERT INTO `buyers` VALUES (1,1,'549 Willow Street Monsey, NY 10952'),(2,2,'142 Lincoln Street Saint Johns, FL 32259'),(3,3,'298 Valley Road Braintree, MA 02184'),(4,4,'635 Creekside Drive Vineland, NJ 08360'),(5,5,'908 Elizabeth Street Powhatan, VA 23139'),(6,1,'775 Jefferson Street Voorhees, NJ 08043'),(7,2,'616 Ridge Road Murfreesboro, TN 37128'),(8,3,'422 John Street Edison, NJ 08817'),(9,4,'470 Lexington Court East Northport, NY 11731'),(10,5,'149 Devon Court Chelsea, MA 02150'),(11,1,'867 B Street Hope Mills, NC 28348'),(12,2,'335 Morris Street West Chicago, IL 60185'),(13,3,'522 Summit Street Wyoming, MI 49509'),(14,4,'707 Franklin Court Harrisonburg, VA 22801'),(15,5,'89 Lake Avenue Fuquay Varina, NC 27526'),(16,1,'697 Highland Avenue Desoto, TX 75115'),(17,2,'500 Ann Street Norcross, GA 30092'),(18,3,'108 Union Street Osseo, MN 55311'),(19,4,'855 Hudson Street Valparaiso, IN 46383'),(20,5,'575 Highland Drive Grovetown, GA 30813');
/*!40000 ALTER TABLE `buyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Action'),(2,'RTS'),(3,'MOBA'),(4,'RPG / ActionRPG'),(5,'MMORPG'),(6,'Shooter'),(7,'Sandbox'),(8,'Other');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'USA'),(2,'Russia'),(3,'UK'),(4,'China'),(5,'Korea');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_country` (`id_country`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,8,1,'Gears of War 2'),(2,3,3,'Borderlands 2'),(3,1,3,'Tomboy'),(4,1,4,'Meteos'),(5,2,1,'Resident Evil Code: Veronica'),(6,2,4,'World of Goo'),(7,8,3,'System Shock 2'),(8,9,2,'Pokemon Silver Version'),(9,6,5,'Crysis'),(10,3,5,'Rayman 2: The Great Escape'),(11,5,2,'Shin Megami Tensei: Persona 3 FES'),(12,9,3,'The Elder Scrolls IV: Oblivion'),(13,4,4,'NCAA Football 2004'),(14,5,2,'The Elder Scrolls V: Skyrim'),(15,4,4,'Gears of War 3'),(16,2,4,'Teenage Mutant Ninja Turtles: Turtles in Time Re-Shelled'),(17,5,4,'WCW Backstage Assault'),(18,5,4,'New Super Mario Bros.'),(19,1,3,'The ICO & Shadow of the Colossus Collection'),(20,8,2,'ECW Hardcore Revolution'),(21,4,2,'Journey'),(22,6,5,'Unreal Tournament 2004'),(23,7,4,'WCW Nitro'),(24,4,5,'Metroid Fusion'),(25,1,1,'Geometry Wars: Retro Evolved 2'),(26,8,5,'World of Warcraft: Cataclysm'),(27,7,5,'Grand Theft Auto III'),(28,1,1,'Minecraft'),(29,9,2,'Trials Evolution'),(30,1,1,'WWF In Your House'),(31,2,5,'Ninja Gaiden Black'),(32,2,5,'Super Mario Bros.'),(33,4,1,'WWF War Zone'),(34,8,5,'MLB 10: The Show'),(35,1,5,'The Legend of Zelda: Twilight Princess'),(36,3,2,'Mass Effect 2'),(37,3,4,'Total War: Shogun 2'),(38,2,5,'Donkey Kong Country Returns'),(39,4,5,'Super Paper Mario'),(40,7,1,'Superbrothers: Sword & Sworcery EP'),(41,9,4,'Rome: Total War'),(42,3,2,'Super Smash Bros. Melee'),(43,6,1,'Resident Evil 2'),(44,5,3,'Half-Life'),(45,4,2,'SSX'),(46,2,1,'Spyro: Year of the Dragon'),(47,5,5,'Super Mario 3D World'),(48,3,2,'The Legend of Zelda: Ocarina of Time'),(49,1,3,'BioShock');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_model` int(11) DEFAULT NULL,
  `id_buyer` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_buyer` (`id_buyer`),
  KEY `id_model` (`id_model`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (1,33,11,1,'2006-01-20'),(2,40,20,1,'2028-07-20'),(3,24,16,1,'2004-04-20'),(4,63,15,1,'2018-11-20'),(5,70,18,1,'2010-06-20'),(6,60,20,1,'2025-10-20'),(7,69,17,1,'2003-09-20'),(8,49,5,2,'2010-01-20'),(9,57,9,1,'2002-10-20'),(10,17,3,1,'2005-11-20'),(11,37,16,1,'2024-06-20'),(12,26,17,1,'2002-10-20'),(13,92,4,1,'2003-12-20'),(14,44,11,2,'2029-12-20'),(15,96,6,1,'2008-09-20'),(16,40,7,1,'2026-04-20'),(17,74,16,1,'2001-09-20'),(18,29,3,1,'2024-02-20'),(19,40,14,1,'2015-11-20'),(20,66,11,1,'2030-12-20'),(21,60,2,2,'2013-10-20'),(22,99,5,1,'2008-10-20'),(23,16,11,1,'2027-02-20'),(24,56,8,1,'2010-09-20'),(25,68,5,1,'2025-06-20'),(26,47,14,2,'2001-03-20'),(27,55,5,1,'2018-08-20'),(28,46,7,1,'2028-03-20'),(29,26,9,1,'2003-03-20'),(30,45,3,1,'2004-06-20');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_model` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_model` (`id_model`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage`
--

LOCK TABLES `storage` WRITE;
/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
INSERT INTO `storage` VALUES (1,1,0,1072.86),(2,2,10,562.08),(3,3,8,765.98),(4,4,8,1627.72),(5,5,6,1599.64),(6,6,5,285.03),(7,7,10,739.59),(8,8,5,544.25),(9,9,2,296.01),(10,10,10,1810.81),(11,11,1,1475.22),(12,12,7,435.52),(13,13,1,934.4),(14,14,1,1165.06),(15,15,9,278.63),(16,16,3,614.72),(17,17,8,1739),(18,18,1,861.85),(19,19,2,1709.32),(20,20,0,285.94),(21,21,1,551.98),(22,22,6,1243.92),(23,23,9,1328.02),(24,24,2,387.07),(25,25,1,610.67),(26,26,1,365.29),(27,27,6,1145.43),(28,28,9,1454.46),(29,29,8,1431.77),(30,30,9,1047.57),(31,31,9,1122.95),(32,32,5,1036.78),(33,33,7,1340.04),(34,34,5,1301.78),(35,35,3,1336.66),(36,36,6,983.78),(37,37,7,1679.73),(38,38,4,1274.86),(39,39,6,1938.89),(40,40,7,1869),(41,41,4,340.5),(42,42,4,924.45),(43,43,8,609.57),(44,44,10,1840.84),(45,45,9,931.55),(46,46,3,998.58),(47,47,7,1221.64),(48,48,3,751.43),(49,49,1,1547.45),(50,50,1,1127.97),(51,51,5,1740.01),(52,52,1,422.36),(53,53,5,1628.08),(54,54,10,790.97),(55,55,4,599.71),(56,56,10,1141.22),(57,57,1,1498.36),(58,58,9,1456.25),(59,59,4,340.47),(60,60,1,926.63),(61,61,5,536.67),(62,62,8,392.32),(63,63,4,1189.22),(64,64,5,1151.07),(65,65,6,1824.8),(66,66,7,392.16),(67,67,10,1319.76),(68,68,5,1825.42),(69,69,10,738.16),(70,70,1,421.74),(71,71,3,1740.92),(72,72,8,305.64),(73,73,5,1603.91),(74,74,9,1692.52),(75,75,8,381.55),(76,76,3,1498.91),(77,77,10,213.49),(78,78,10,948.49),(79,79,2,1449.68),(80,80,8,1882),(81,81,7,1204.17),(82,82,4,721.84),(83,83,2,1750.16),(84,84,5,919.3),(85,85,0,318.56),(86,86,4,889.17),(87,87,0,1770.37),(88,88,9,540.41),(89,89,4,1457.02),(90,90,8,880.16),(91,91,6,1746.54),(92,92,4,242.18),(93,93,0,700.1),(94,94,3,1889.62),(95,95,10,1140.26),(96,96,10,874.65),(97,97,9,241.15),(98,98,6,1051.2),(99,99,1,444.65),(100,100,7,767.76);
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-17 18:10:29
