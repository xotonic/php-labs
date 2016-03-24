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
  `count` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_country` (`id_country`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM AUTO_INCREMENT=292 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (192,3,3,'Borderlands 2',10,562.08),(193,1,3,'Tomboy',8,765.98),(194,1,4,'Meteos',8,1627.72),(196,2,4,'World of Goo',5,285.03),(197,8,3,'System Shock 2',10,739.59),(198,9,2,'Pokemon Silver Version',5,544.25),(199,6,5,'Crysis',2,296.01),(200,3,5,'Rayman 2: The Great Escape',10,1810.81),(201,5,2,'Shin Megami Tensei: Persona 3 FES',1,1475.22),(202,9,3,'The Elder Scrolls IV: Oblivion',7,435.52),(203,4,4,'NCAA Football 2004',1,934.4),(204,5,2,'The Elder Scrolls V: Skyrim',1,1165.06),(205,4,5,'Tony Hawks Pro Skater 4',9,278.63),(206,2,5,'Infamous 2',3,614.72),(207,6,4,'Halo 3: ODST',8,1739),(208,5,5,'Pharaoh Man',1,861.85),(209,5,2,'Grand Theft Auto V',2,1709.32),(210,9,5,'Rock Band 2',0,285.94),(211,2,4,'World of Warcraft: The Burning Crusade',1,551.98),(212,4,3,'Battlefield: Bad Company 2',6,1243.92),(213,8,1,'Mirrors Edge',9,1328.02),(214,4,4,'Gears of War 3',2,387.07),(215,2,4,'Teenage Mutant Ninja Turtles: Turtles in Time Re-Shelled',1,610.67),(216,5,4,'WCW Backstage Assault',1,365.29),(217,5,4,'New Super Mario Bros.',6,1145.43),(218,1,3,'The ICO & Shadow of the Colossus Collection',9,1454.46),(219,8,2,'ECW Hardcore Revolution',8,1431.77),(220,4,2,'Journey',9,1047.57),(221,6,5,'Unreal Tournament 2004',9,1122.95),(222,7,4,'WCW Nitro',5,1036.78),(223,4,5,'Metroid Fusion',7,1340.04),(224,1,1,'Geometry Wars: Retro Evolved 2',5,1301.78),(225,8,5,'World of Warcraft: Cataclysm',3,1336.66),(226,7,5,'Grand Theft Auto III',6,983.78),(227,1,1,'Minecraft',7,1679.73),(228,9,2,'Trials Evolution',4,1274.86),(229,1,1,'WWF In Your House',6,1938.89),(230,2,5,'Ninja Gaiden Black',7,1869),(231,2,5,'Super Mario Bros.',4,340.5),(232,4,1,'WWF War Zone',4,924.45),(233,8,5,'MLB 10: The Show',8,609.57),(234,1,5,'The Legend of Zelda: Twilight Princess',10,1840.84),(235,3,2,'Mass Effect 2',9,931.55),(236,9,4,'Tom Clancys Splinter Cell',3,998.58),(237,6,5,'Planescape: Torment',7,1221.64),(238,2,4,'Gears of War',3,751.43),(239,1,2,'Demons Souls',1,1547.45),(240,5,2,'MegaMan.EXE',1,1127.97),(241,3,4,'Total War: Shogun 2',5,1740.01),(242,2,3,'Tomb Raider',1,422.36),(244,2,5,'Donkey Kong Country Returns',10,790.97),(245,9,5,'Castlevania: Dawn of Sorrow',4,599.71),(246,2,4,'Tony Hawks Pro Skater',10,1141.22),(248,7,1,'Superbrothers: Sword & Sworcery EP',9,1456.25),(249,1,5,'Eternal Darkness: Sanitys Requiem',4,340.47),(250,1,1,'World Soccer Winning Eleven 6 International',1,926.63),(251,5,1,'New Xbox Experience',5,536.67),(253,8,4,'Virtua Fighter 4: Evolution',4,1189.22),(254,6,4,'Valkyria Chronicles II',5,1151.07),(257,4,4,'NBA 2K11',10,1319.76),(258,1,4,'Professor Layton and the Unwound Future',5,1825.42),(259,7,3,'God of War: Chains of Olympus',10,738.16),(260,1,2,'Shadow Complex',1,421.74),(261,3,4,'Far Cry 2',3,1740.92),(262,9,1,'WCW/nWo Thunder',8,305.64),(263,4,5,'Call of Duty',5,1603.91),(264,6,5,'Metroid Prime 3: Corruption',9,1692.52),(265,5,5,'Super Stardust HD',8,381.55),(266,9,5,'Lumines',3,1498.91),(267,9,4,'Metroid Prime 2: Echoes',10,213.49),(268,5,5,'Super Mario Bros. 3',10,948.49),(270,6,5,'Metal Gear Solid: Peace Walker',8,1882),(271,9,5,'The Orange Box',7,1204.17),(272,4,2,'Mega Man',4,721.84),(273,9,4,'Rome: Total War',2,1750.16),(274,3,2,'Super Smash Bros. Melee',5,919.3),(276,5,4,'Tekken 3',4,889.17),(277,3,3,'Viva PiÃ±ata: Trouble in Paradise',0,1770.37),(278,8,4,'Dead or Alive 2',9,540.41),(279,8,3,'The World Ends With You',4,1457.02),(280,9,2,'Elder Scrolls IV: Oblivion',8,880.16),(281,9,1,'Tomba!',6,1746.54),(282,6,1,'Resident Evil 2',4,242.18),(283,1,1,'Half-Life 3',345,700.1),(284,4,2,'SSX',3,1889.62),(285,2,1,'Spyro: Year of the Dragon',10,1140.26),(286,9,1,'NCAA Football 2003',10,874.65),(287,3,2,'Super Mario Sunshine',9,241.15),(289,3,2,'The Legend of Zelda: Ocarina of Time',1,444.65),(290,1,3,'BioShock',7,767.76);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-26  1:46:28
