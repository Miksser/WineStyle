-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: winestyle
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workers_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `january` int(11) DEFAULT NULL,
  `february` int(11) DEFAULT NULL,
  `march` int(11) DEFAULT NULL,
  `april` int(11) DEFAULT NULL,
  `may` int(11) DEFAULT NULL,
  `june` int(11) DEFAULT NULL,
  `july` int(11) DEFAULT NULL,
  `august` int(11) DEFAULT NULL,
  `september` int(11) DEFAULT NULL,
  `october` int(11) DEFAULT NULL,
  `november` int(11) DEFAULT NULL,
  `december` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment` (`workers_id`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1,2017,201553,74763,71990,63754,64479,99669,78504,199696,64097,79190,79886,83208),(2,2,2017,66222,81153,72156,96177,85066,76953,63176,165655,97538,78406,72331,70680),(3,3,2017,70817,81473,80808,69624,91892,65756,60367,165626,75399,94459,61996,83776),(4,4,2017,91777,63908,93571,79591,64261,77920,92309,207506,64380,97076,72989,66841),(5,5,2017,91984,95119,85432,89080,65631,92332,60442,143642,75703,62005,78954,62878),(6,6,2017,73432,63872,88447,66630,75372,87899,85282,137690,85376,78797,75803,93868),(7,7,2017,87689,94002,77939,85909,79968,62501,65087,216526,99771,67968,82155,60703),(8,8,2017,67887,98393,62352,89656,73724,68808,89588,185560,62728,83448,83366,81914),(9,9,2017,65566,69961,95946,90550,68716,96538,72677,146220,74327,73338,70364,87459),(10,10,2017,87666,74626,70673,83785,62406,96264,74622,218422,83450,96346,81723,91553),(11,11,2017,98766,63248,83526,87274,85884,91709,95080,173567,94268,81714,97521,95389),(12,12,2017,45634,72361,63612,85016,62202,69750,71534,152121,80992,99531,62437,62287),(13,13,2017,45644,72061,85483,63259,73359,93624,92431,191791,62154,72515,79621,85267),(14,14,2017,75654,83223,94578,81245,80188,78870,67551,190485,87796,83982,70797,99475),(15,15,2017,64564,99932,72443,76448,80864,93476,80465,67649,72515,62367,95120,61573),(19,31,2017,97776,111000,123412,77567,99877,44578,99976,56788,78997,89777,78675,87789);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professions`
--

DROP TABLE IF EXISTS `professions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
INSERT INTO `professions` VALUES (1,'бухгалтер'),(2,'курьер'),(3,'менеджер');
/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `second_name` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_ico` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers`
--

LOCK TABLES `workers` WRITE;
/*!40000 ALTER TABLE `workers` DISABLE KEYS */;
INSERT INTO `workers` VALUES (1,'Джон','Сноу',1,90000,'2017081559328.jpg','2017081559328-ico.jpg'),(2,'Билл','Хадсон',3,95000,'2017081578533.jpg','2017081578533-ico.jpg'),(3,'Мэдисон','Дэвидсон',2,70000,'2017081515592.jpg','2017081515592-ico.jpg'),(4,'Элизабет','Бриггс',2,75000,'2017081538513.jpg','2017081538513-ico.jpg'),(5,'Кори','Андерсон',2,65000,'2017081534463.jpg','2017081534463-ico.jpg'),(6,'Джоан','Харпер',1,90000,'2017081537888.jpg','2017081537888-ico.jpg'),(7,'Марджори','Лайонс',1,100000,'2017081581144.jpg','2017081581144-ico.jpg'),(8,'Эделия','Кларк',1,70000,'2017081575442.jpg','2017081575442-ico.jpg'),(9,'Мэри','Эллис',1,80000,'2017081514113.jpg','2017081514113-ico.jpg'),(10,'Дорис','Вуд',1,85000,'2017081558453.jpg','2017081558453-ico.jpg'),(11,'Джошуа','Оуэн',3,94000,'2017081524222.jpg','2017081524222-ico.jpg'),(12,'Стивен','Эванс',3,87000,'2017081582500.jpg','2017081582500-ico.jpg'),(13,'Кристофер','Морган',3,69000,'2017081561619.jpg','2017081561619-ico.jpg'),(14,'Эндрю','Кук',3,76000,'2017081598309.jpg','2017081598309-ico.jpg'),(31,'Джейми','Ланнистер',3,1000000,'2017081562917.jpg','2017081562917-ico.jpg');
/*!40000 ALTER TABLE `workers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-15 22:27:25
