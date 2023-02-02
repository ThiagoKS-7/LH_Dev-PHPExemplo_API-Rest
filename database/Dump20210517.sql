-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bee_dev
-- ------------------------------------------------------
-- Server version	5.7.34

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
-- Table structure for table `bee_flowers`
--

DROP TABLE IF EXISTS `bee_flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bee_flowers` (
  `idbee_type` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  KEY `fk_bee_flowers_bee_type1_idx` (`idbee_type`),
  KEY `fk_bee_flowers_flower1_idx` (`flower_id`),
  CONSTRAINT `fk_bee_flowers_bee_type1` FOREIGN KEY (`idbee_type`) REFERENCES `bee_type` (`idbee_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bee_flowers_flower1` FOREIGN KEY (`flower_id`) REFERENCES `flower` (`idflower`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bee_flowers`
--

LOCK TABLES `bee_flowers` WRITE;
/*!40000 ALTER TABLE `bee_flowers` DISABLE KEYS */;
INSERT INTO `bee_flowers` VALUES (1,2),(1,3),(2,2),(3,4),(3,5),(2,13),(4,13),(2,14),(4,14),(2,15),(4,15);
/*!40000 ALTER TABLE `bee_flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bee_type`
--

DROP TABLE IF EXISTS `bee_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bee_type` (
  `idbee_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `specie` varchar(120) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`idbee_type`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bee_type`
--

LOCK TABLES `bee_type` WRITE;
/*!40000 ALTER TABLE `bee_type` DISABLE KEYS */;
INSERT INTO `bee_type` VALUES (1,'Uruçu (Melipona scutellaris)',NULL,'2021-05-14 00:00:00','2021-05-14 00:00:00'),(2,'Uruçu-Amarela (Melipona rufiventris)',NULL,'2021-05-14 00:00:00','2021-05-14 00:00:00'),(3,'Guarupu (Melipona bicolor)',NULL,'2021-05-14 00:00:00','2021-05-14 00:00:00'),(4,'Iraí (Nannotrigona testaceicornes)',NULL,'2021-05-14 00:00:00','2021-05-14 00:00:00');
/*!40000 ALTER TABLE `bee_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blooming_flowers`
--

DROP TABLE IF EXISTS `blooming_flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blooming_flowers` (
  `flower_id` int(11) NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blooming_flowers`
--

LOCK TABLES `blooming_flowers` WRITE;
/*!40000 ALTER TABLE `blooming_flowers` DISABLE KEYS */;
INSERT INTO `blooming_flowers` VALUES (1,3),(1,4),(1,5),(2,1),(2,2),(3,6),(4,7),(4,8),(14,1),(14,2),(14,3),(14,4),(14,5),(14,6),(15,1),(15,2),(15,3),(15,4),(15,5),(15,6);
/*!40000 ALTER TABLE `blooming_flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flower`
--

DROP TABLE IF EXISTS `flower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flower` (
  `idflower` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(120) NOT NULL,
  `species` varchar(45) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`idflower`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flower`
--

LOCK TABLES `flower` WRITE;
/*!40000 ALTER TABLE `flower` DISABLE KEYS */;
INSERT INTO `flower` VALUES (2,'Azaléia Rosa','Azaléia Rosa Descrição','Azaléia Rosa Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(3,'Laranjeira','Laranjeira Descrição','Laranjeira Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(4,'Mangueira','Mangueira Descrição','Mangueira Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(5,'Manjericão','Manjericão Descrição','Manjericão Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(6,'Orégano','Orégano Descrição','Orégano Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(7,'Pessegueiro','Pessegueiro Descrição','Pessegueiro Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(8,'Pitanga','Pitanga Descrição','Pitanga Escpécie','2021-05-14 00:00:00','2021-05-14 00:00:00'),(9,'asdf','asdf','asdf','2021-05-17 00:00:00','2021-05-17 00:00:00'),(10,'asdf','asdf','asdf','2021-05-17 00:00:00','2021-05-17 00:00:00'),(11,'asdf','asdf','asdf','2021-05-17 00:00:00','2021-05-17 00:00:00'),(12,'asdf','asdf','asdf','2021-05-17 00:00:00','2021-05-17 00:00:00'),(13,'asdf','asdf','asdf','2021-05-17 00:00:00','2021-05-17 00:00:00'),(14,'asdf','asdf','asdf','2021-05-17 03:05:03','2021-05-17 03:05:03'),(15,'asdf','asdf','asdf','2021-05-17 03:05:14','2021-05-17 03:05:14');
/*!40000 ALTER TABLE `flower` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-17 15:15:41
