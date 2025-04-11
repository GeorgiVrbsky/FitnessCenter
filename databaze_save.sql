-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: georgivrbsky
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CVIKY`
--

DROP TABLE IF EXISTS `CVIKY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CVIKY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) NOT NULL,
  `zamereni` varchar(45) DEFAULT NULL,
  `misto` varchar(45) DEFAULT NULL,
  `typ_svalu` varchar(45) DEFAULT NULL,
  `role_idrole` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nazev_UNIQUE` (`nazev`),
  KEY `fk_CVIKY_Role1_idx` (`role_idrole`),
  CONSTRAINT `fk_CVIKY_Role1` FOREIGN KEY (`role_idrole`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cviky`
--

LOCK TABLES `CVIKY` WRITE;
/*!40000 ALTER TABLE `cviky` DISABLE KEYS */;
INSERT INTO `CVIKY` VALUES (6,'Bench Press','Nabirani_Svalu','Posilovna','Hrudník',1),(7,'Drepy','Nabirani_Svalu','Posilovna','Nohy',2),(8,'Mrtvy tah','Nabirani_Svalu','Posilovna','Záda',1),(9,'Kliky','Kondice','Doma','Paze',4),(10,'Bicepsovy zdvih','Nabirani_Svalu','Doma','Paze',7),(11,'Shyby','Nabirani_Svalu','Venku','Záda',8),(12,'Anglicáky','Kondice','Doma','Celé telo',13),(13,'Vypady','Nabirani_Svalu','Posilovna','Nohy',2),(14,'Tlaky s jednoruckami','Nabirani_Svalu','Posilovna','Ramena',12),(15,'Sed-lehy','Kondice','Doma','Bricho',13),(16,'Skákání pres svihadlo','Kondice','Venku','Celé telo',14),(17,'Stahování kladky','Nabirani_Svalu','Posilovna','Záda',1),(18,'Tlaky na ramena','Nabirani_Svalu','Posilovna','Ramena',12),(19,'Vypony na lytka','Nabirani_Svalu','Doma','Lytka',3),(20,'Farmárská chuze','Nabirani_Svalu','Venku','Paze',11),(21,'Skoky na bednu','Kondice','Posilovna','Nohy',5),(22,'Superman','Kondice','Doma','Záda',22),(23,'Zkracovacky','Kondice','Doma','Bricho',4),(24,'Dipy na zidli','Nabirani_Svalu','Doma','Triceps',17),(25,'Tlaky na prsa na stroji','Nabirani_Svalu','Posilovna','Hrudník',2),(26,'Vypady dozadu','Kondice','Venku','Nohy',20),(27,'Hrazda','Nabirani_Svalu','Venku','Záda',11),(28,'Tlaky na nohy','Nabirani_Svalu','Posilovna','Nohy',12),(29,'Bricho s medicinbalem','Kondice','Doma','Core',4),(30,'Leh-sedy s rotací','Kondice','Doma','Bricho',4),(31,'Rotace trupu','Kondice','Doma','Core',22),(32,'Tlaky na ramena jednoruckami','Nabirani_Svalu','Doma','Ramena',13),(33,'Strídavé vypady','Kondice','Doma','Nohy',22),(34,'Bocní prkno','Kondice','Doma','Core',4),(35,'Kliky na úzko','Nabirani_Svalu','Doma','Triceps',3),(36,'Biceps na kladce','Nabirani_Svalu','Posilovna','Paze',1),(37,'Vypady do stran','Kondice','Doma','Nohy',22),(38,'Step-up','Kondice','Doma','Nohy',22),(39,'Skákací panák','Kondice','Venku','Celé telo',14),(40,'Kliky na bradlech','Nabirani_Svalu','Posilovna','Triceps',12),(41,'Kettlebell swing','Nabirani_Svalu','Doma','Záda',7),(42,'Sedy-lehy','Kondice','Doma','Bricho',4),(43,'Prítahy v predklonu','Nabirani_Svalu','Posilovna','Záda',1),(44,'Celní drepy','Nabirani_Svalu','Posilovna','Nohy',2),(45,'Rotace s kotoucem','Kondice','Doma','Core',4),(46,'Tlaky nohama na stroji','Nabirani_Svalu','Posilovna','Nohy',5),(47,'Kliky s tlesknutím','Nabirani_Svalu','Doma','Paze',17),(48,'Podrepy','Kondice','Doma','Nohy',22),(49,'Stoj na rukou u zdi','Nabirani_Svalu','Doma','Ramena',13),(50,'Drepy s vyskokem','Kondice','Doma','Nohy',4),(51,'Kliky na jedné ruce','Nabirani_Svalu','Doma','Paze',7),(52,'Prítahy s expandérem','Nabirani_Svalu','Doma','Záda',13),(53,'Zdvihy nohou vleze','Kondice','Doma','Bricho',4),(54,'Zanozování','Nabirani_Svalu','Doma','Hyzde',3),(55,'Svihy lanem','Kondice','Posilovna','Paze',5),(56,'Tlaky nad hlavu','Nabirani_Svalu','Posilovna','Ramena',12),(57,'Zvedání pánve','Kondice','Doma','Hyzde',4),(58,'Kliky s nohama na lavicce','Nabirani_Svalu','Posilovna','Hrudník',1),(59,'Chuze po rukou','Kondice','Doma','Ramena',4),(60,'Skákací vypady','Kondice','Venku','Nohy',14),(61,'Preskoky pres lavicku','Kondice','Venku','Nohy',23),(62,'Kliky na pestech','Nabirani_Svalu','Doma','Paze',7),(63,'Pistol squat','Nabirani_Svalu','Doma','Nohy',13),(64,'Tlaky za hlavou','Nabirani_Svalu','Posilovna','Ramena',12),(65,'Prkno na míci','Kondice','Doma','Core',4),(66,'Prsní rozpazky','Nabirani_Svalu','Posilovna','Hrudník',2),(67,'Shyby podhmatem','Nabirani_Svalu','Posilovna','Záda',1),(68,'Anglicáky s vyskokem','Kondice','Venku','Celé telo',14),(69,'Zvedání kolen ve visu','Nabirani_Svalu','Posilovna','Bricho',1),(70,'Kliky na TRX','Nabirani_Svalu','Doma','Paze',3),(71,'Tlaky na ramena s expandérem','Nabirani_Svalu','Doma','Ramena',13),(72,'Boxování do pytle','Kondice','Posilovna','Paze',5),(73,'Zanozování na ctyrech','Kondice','Doma','Hyzde',22),(74,'Krabí chuze','Kondice','Doma','Celé telo',22),(75,'Zvedání ramen','Nabirani_Svalu','Posilovna','Ramena',1),(76,'Skákání na trampolíne','Kondice','Doma','Nohy',22),(77,'Prítahy na TRX','Nabirani_Svalu','Doma','Záda',3),(78,'Leh-sedy na sikmé lavici','Kondice','Posilovna','Bricho',5),(79,'Zvedání nohou na hrazde','Nabirani_Svalu','Posilovna','Bricho',2),(80,'Zvedání kettlebellu','Nabirani_Svalu','Posilovna','Celé telo',1),(81,'Drepy s cinkou nad hlavou','Nabirani_Svalu','Posilovna','Nohy',12);
/*!40000 ALTER TABLE `cviky` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARAMETRY`
--

DROP TABLE IF EXISTS `PARAMETRY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARAMETRY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cislo_tydne` int(11) DEFAULT NULL,
  `vyska` decimal(10,2) DEFAULT NULL,
  `hmotnost` decimal(10,2) DEFAULT NULL,
  `obvod_pasu` decimal(10,2) DEFAULT NULL,
  `obvod_hrudniku` decimal(10,2) DEFAULT NULL,
  `user_idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PARAMETRY_USER1_idx` (`user_idUser`),
  CONSTRAINT `fk_PARAMETRY_USER1` FOREIGN KEY (`user_idUser`) REFERENCES `USER` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARAMETRY`
--

--
-- Table structure for table `ROLE`
--

DROP TABLE IF EXISTS `ROLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROLE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) DEFAULT NULL,
  `zamereni` varchar(45) DEFAULT NULL,
  `misto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `ROLE` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `ROLE` VALUES (1,'Trener','Nabirani_Svalu','Posilovna'),(2,'Klient','Nabirani_Svalu','Posilovna'),(3,'Trener','Hubnuti','Doma'),(4,'Klient','Hubnuti','Doma'),(5,'Klient','Kondice','Posilovna'),(7,'Trener','Nabirani_Svalu','Doma'),(8,'Trener','Nabirani_Svalu','Venku'),(9,'Trener','Hubnuti','Posilovna'),(11,'Trener','Hubnuti','Venku'),(12,'Trener','Kondice','Posilovna'),(13,'Trener','Kondice','Doma'),(14,'Trener','Kondice','Venku'),(16,'Klient','Nabirani_Svalu','Doma'),(17,'Klient','Nabirani_Svalu','Venku'),(18,'Klient','Hubnuti','Posilovna'),(20,'Klient','Hubnuti','Venku'),(22,'Klient','Kondice','Doma'),(23,'Klient','Kondice','Venku');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USER`
--

DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` varchar(50) DEFAULT NULL,
  `prijmeni` varchar(50) DEFAULT NULL,
  `heslo` varchar(300) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `telefon` varchar(25) NOT NULL,
  `datum_narozeni` date DEFAULT NULL,
  `pohlavi` enum('Muz','Zena','Jine') DEFAULT NULL,
  `role_idRole` int(11) DEFAULT NULL,
  `user_idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email_UNIQUE` (`email`),
  KEY `fk_USER_Role_idx` (`role_idRole`),
  KEY `fk_USER_USER1_idx` (`user_idUser`),
  CONSTRAINT `fk_USER_Role` FOREIGN KEY (`role_idRole`) REFERENCES `ROLE` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_USER_USER1` FOREIGN KEY (`user_idUser`) REFERENCES `USER` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-11  9:07:18
