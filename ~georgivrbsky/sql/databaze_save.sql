-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB-0+deb12u1

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
  KEY `fk_CVIKY_Role1_idx` (`role_idrole`),
  CONSTRAINT `fk_CVIKY_Role1` FOREIGN KEY (`role_idrole`) REFERENCES `ROLE` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CVIKY`
--

LOCK TABLES `CVIKY` WRITE;
/*!40000 ALTER TABLE `CVIKY` DISABLE KEYS */;
INSERT INTO `CVIKY` VALUES
(1,'Bench Press','Nabirani_Svalu','Posilovna','Prsa',1),
(2,'Deadlift','Nabirani_Svalu','Posilovna','Záda',1),
(3,'Squat','Nabirani_Svalu','Posilovna','Stehna',1),
(4,'Overhead Press','Nabirani_Svalu','Posilovna','Ramena',1),
(5,'Barbell Row','Nabirani_Svalu','Posilovna','Záda',1),
(6,'Pull-up','Nabirani_Svalu','Posilovna','Záda',1),
(7,'Dip','Nabirani_Svalu','Posilovna','Triceps',1),
(8,'Leg Press','Nabirani_Svalu','Posilovna','Stehna',1),
(9,'Leg Curl','Nabirani_Svalu','Posilovna','Stehna',1),
(10,'Leg Extension','Nabirani_Svalu','Posilovna','Stehna',1),
(11,'Calf Raise','Nabirani_Svalu','Posilovna','Lýtka',1),
(12,'Lat Pulldown','Nabirani_Svalu','Posilovna','Záda',1),
(13,'Seated Row','Nabirani_Svalu','Posilovna','Záda',1),
(14,'Incline Bench','Nabirani_Svalu','Posilovna','Prsa',1),
(15,'Decline Bench','Nabirani_Svalu','Posilovna','Prsa',1),
(16,'Dumbbell Fly','Nabirani_Svalu','Posilovna','Prsa',1),
(17,'Lateral Raise','Nabirani_Svalu','Posilovna','Ramena',1),
(18,'Front Raise','Nabirani_Svalu','Posilovna','Ramena',1),
(19,'Rear Delt Fly','Nabirani_Svalu','Posilovna','Ramena',1),
(20,'Shrug','Nabirani_Svalu','Posilovna','Trapézy',1),
(21,'Barbell Curl','Nabirani_Svalu','Posilovna','Biceps',1),
(22,'Hammer Curl','Nabirani_Svalu','Posilovna','Biceps',1),
(23,'Preacher Curl','Nabirani_Svalu','Posilovna','Biceps',1),
(24,'Triceps Pushdown','Nabirani_Svalu','Posilovna','Triceps',1),
(25,'Skullcrusher','Nabirani_Svalu','Posilovna','Triceps',1),
(26,'Close Grip Bench','Nabirani_Svalu','Posilovna','Triceps',1),
(27,'Hanging Leg Raise','Nabirani_Svalu','Posilovna','Břicho',1),
(28,'Cable Crunch','Nabirani_Svalu','Posilovna','Břicho',1),
(29,'Russian Twist','Nabirani_Svalu','Posilovna','Břicho',1),
(30,'Hyperextension','Nabirani_Svalu','Posilovna','Záda',1),
(31,'Farmers Walk','Nabirani_Svalu','Posilovna','Celé tělo',1),
(32,'Clean and Press','Nabirani_Svalu','Posilovna','Celé tělo',1),
(33,'Snatch','Nabirani_Svalu','Posilovna','Celé tělo',1),
(34,'Box Jump','Nabirani_Svalu','Posilovna','Celé tělo',1),
(35,'Bulgarian Split Squat','Nabirani_Svalu','Posilovna','Stehna',1),
(36,'Push-up','Nabirani_Svalu','Doma','Prsa',2),
(37,'Chair Dip','Nabirani_Svalu','Doma','Triceps',2),
(38,'Pike Push-up','Nabirani_Svalu','Doma','Ramena',2),
(39,'Incline Push-up','Nabirani_Svalu','Doma','Prsa',2),
(40,'Decline Push-up','Nabirani_Svalu','Doma','Prsa',2),
(41,'Pull-up (door bar)','Nabirani_Svalu','Doma','Záda',2),
(42,'Bodyweight Row','Nabirani_Svalu','Doma','Záda',2),
(43,'Superman','Nabirani_Svalu','Doma','Záda',2),
(44,'Squat','Nabirani_Svalu','Doma','Stehna',2),
(45,'Lunge','Nabirani_Svalu','Doma','Stehna',2),
(46,'Step-up','Nabirani_Svalu','Doma','Stehna',2),
(47,'Wall Sit','Nabirani_Svalu','Doma','Stehna',2),
(48,'Single-leg Deadlift','Nabirani_Svalu','Doma','Stehna',2),
(49,'Calf Raise','Nabirani_Svalu','Doma','Lýtka',2),
(50,'Glute Bridge','Nabirani_Svalu','Doma','Hýždě',2),
(51,'Single-leg Glute Bridge','Nabirani_Svalu','Doma','Hýždě',2),
(52,'Plank','Nabirani_Svalu','Doma','Jádro',2),
(53,'Side Plank','Nabirani_Svalu','Doma','Jádro',2),
(54,'Reverse Plank','Nabirani_Svalu','Doma','Jádro',2),
(55,'Crunch','Nabirani_Svalu','Doma','Břicho',2),
(56,'Leg Raise','Nabirani_Svalu','Doma','Břicho',2),
(57,'Bicycle Crunch','Nabirani_Svalu','Doma','Břicho',2),
(58,'Russian Twist','Nabirani_Svalu','Doma','Břicho',2),
(59,'Mountain Climber','Nabirani_Svalu','Doma','Celé tělo',2),
(60,'Burpee','Nabirani_Svalu','Doma','Celé tělo',2),
(61,'Jump Squat','Nabirani_Svalu','Doma','Celé tělo',2),
(62,'Tuck Jump','Nabirani_Svalu','Doma','Celé tělo',2),
(63,'Handstand Push-up','Nabirani_Svalu','Doma','Ramena',2),
(64,'Pistol Squat','Nabirani_Svalu','Doma','Stehna',2),
(65,'Diamond Push-up','Nabirani_Svalu','Doma','Triceps',2),
(66,'Wide Push-up','Nabirani_Svalu','Doma','Prsa',2),
(67,'Hindu Push-up','Nabirani_Svalu','Doma','Celé tělo',2),
(68,'Bear Crawl','Nabirani_Svalu','Doma','Celé tělo',2),
(69,'Spider Crawl','Nabirani_Svalu','Doma','Celé tělo',2),
(70,'Dragon Flag','Nabirani_Svalu','Doma','Břicho',2),
(71,'Pull-up (hrazda)','Nabirani_Svalu','Venku','Záda',3),
(72,'Chin-up','Nabirani_Svalu','Venku','Biceps',3),
(73,'Muscle-up','Nabirani_Svalu','Venku','Celé tělo',3),
(74,'Dip (bradla)','Nabirani_Svalu','Venku','Triceps',3),
(75,'Push-up','Nabirani_Svalu','Venku','Prsa',3),
(76,'Inverted Row','Nabirani_Svalu','Venku','Záda',3),
(77,'Plyometric Push-up','Nabirani_Svalu','Venku','Prsa',3),
(78,'Sprint','Nabirani_Svalu','Venku','Celé tělo',3),
(79,'Hill Sprint','Nabirani_Svalu','Venku','Celé tělo',3),
(80,'Stair Running','Nabirani_Svalu','Venku','Celé tělo',3),
(81,'Box Jump (park bench)','Nabirani_Svalu','Venku','Celé tělo',3),
(82,'Step-up (park bench)','Nabirani_Svalu','Venku','Stehna',3),
(83,'Lunge Walk','Nabirani_Svalu','Venku','Stehna',3),
(84,'Bulgarian Split Squat (park bench)','Nabirani_Svalu','Venku','Stehna',3),
(85,'Jumping Lunge','Nabirani_Svalu','Venku','Celé tělo',3),
(86,'Squat Jump','Nabirani_Svalu','Venku','Celé tělo',3),
(87,'Broad Jump','Nabirani_Svalu','Venku','Celé tělo',3),
(88,'Calf Raise (stairs)','Nabirani_Svalu','Venku','Lýtka',3),
(89,'Hanging Leg Raise','Nabirani_Svalu','Venku','Břicho',3),
(90,'Hanging Knee Raise','Nabirani_Svalu','Venku','Břicho',3),
(91,'Hanging Windshield Wiper','Nabirani_Svalu','Venku','Břicho',3),
(92,'Plank','Nabirani_Svalu','Venku','Jádro',3),
(93,'Side Plank','Nabirani_Svalu','Venku','Jádro',3),
(94,'Human Flag','Nabirani_Svalu','Venku','Celé tělo',3),
(95,'Parkour Vault','Nabirani_Svalu','Venku','Celé tělo',3),
(96,'Tree Climb','Nabirani_Svalu','Venku','Celé tělo',3),
(97,'Rope Climb','Nabirani_Svalu','Venku','Celé tělo',3),
(98,'Farmer Walk (with rocks)','Nabirani_Svalu','Venku','Celé tělo',3),
(99,'Sled Pull (tire)','Nabirani_Svalu','Venku','Celé tělo',3),
(100,'Tire Flip','Nabirani_Svalu','Venku','Celé tělo',3),
(101,'Log Lift','Nabirani_Svalu','Venku','Celé tělo',3),
(102,'Stone Carry','Nabirani_Svalu','Venku','Celé tělo',3),
(103,'Monkey Bars','Nabirani_Svalu','Venku','Celé tělo',3),
(104,'Parallel Bar Dips','Nabirani_Svalu','Venku','Triceps',3),
(105,'Handstand Push-up (against wall)','Nabirani_Svalu','Venku','Ramena',3),
(106,'Treadmill Running','Hubnuti','Posilovna','Celé tělo',4),
(107,'Elliptical Trainer','Hubnuti','Posilovna','Celé tělo',4),
(108,'Stationary Bike','Hubnuti','Posilovna','Celé tělo',4),
(109,'Rowing Machine','Hubnuti','Posilovna','Celé tělo',4),
(110,'Stair Climber','Hubnuti','Posilovna','Celé tělo',4),
(111,'Jump Rope','Hubnuti','Posilovna','Celé tělo',4),
(112,'Circuit Training','Hubnuti','Posilovna','Celé tělo',4),
(113,'Kettlebell Swing','Hubnuti','Posilovna','Celé tělo',4),
(114,'Battle Ropes','Hubnuti','Posilovna','Celé tělo',4),
(115,'Box Jump','Hubnuti','Posilovna','Celé tělo',4),
(116,'Burpee','Hubnuti','Posilovna','Celé tělo',4),
(117,'Mountain Climber','Hubnuti','Posilovna','Celé tělo',4),
(118,'Sled Push','Hubnuti','Posilovna','Celé tělo',4),
(119,'Medicine Ball Slam','Hubnuti','Posilovna','Celé tělo',4),
(120,'TRX Row','Hubnuti','Posilovna','Záda',4),
(121,'TRX Push-up','Hubnuti','Posilovna','Prsa',4),
(122,'TRX Squat','Hubnuti','Posilovna','Stehna',4),
(123,'TRX Lunge','Hubnuti','Posilovna','Stehna',4),
(124,'TRX Pike','Hubnuti','Posilovna','Ramena',4),
(125,'TRX Atomic Push-up','Hubnuti','Posilovna','Celé tělo',4),
(126,'Barbell Complex','Hubnuti','Posilovna','Celé tělo',4),
(127,'Dumbbell Complex','Hubnuti','Posilovna','Celé tělo',4),
(128,'Sandbag Carry','Hubnuti','Posilovna','Celé tělo',4),
(129,'Farmer Walk','Hubnuti','Posilovna','Celé tělo',4),
(130,'Suitcase Carry','Hubnuti','Posilovna','Celé tělo',4),
(131,'Overhead Carry','Hubnuti','Posilovna','Celé tělo',4),
(132,'Interval Training','Hubnuti','Posilovna','Celé tělo',4),
(133,'Tabata','Hubnuti','Posilovna','Celé tělo',4),
(134,'HIIT','Hubnuti','Posilovna','Celé tělo',4),
(135,'CrossFit WOD','Hubnuti','Posilovna','Celé tělo',4),
(136,'Spin Class','Hubnuti','Posilovna','Celé tělo',4),
(137,'Zumba','Hubnuti','Posilovna','Celé tělo',4),
(138,'Aerobics','Hubnuti','Posilovna','Celé tělo',4),
(139,'Step Aerobics','Hubnuti','Posilovna','Celé tělo',4),
(140,'Kickboxing','Hubnuti','Posilovna','Celé tělo',4),
(141,'Jumping Jacks','Hubnuti','Doma','Celé tělo',5),
(142,'High Knees','Hubnuti','Doma','Celé tělo',5),
(143,'Butt Kicks','Hubnuti','Doma','Celé tělo',5),
(144,'Jump Rope','Hubnuti','Doma','Celé tělo',5),
(145,'Burpee','Hubnuti','Doma','Celé tělo',5),
(146,'Mountain Climber','Hubnuti','Doma','Celé tělo',5),
(147,'Squat Jump','Hubnuti','Doma','Celé tělo',5),
(148,'Lunge Jump','Hubnuti','Doma','Celé tělo',5),
(149,'Tuck Jump','Hubnuti','Doma','Celé tělo',5),
(150,'Star Jump','Hubnuti','Doma','Celé tělo',5),
(151,'Skater Jump','Hubnuti','Doma','Celé tělo',5),
(152,'Box Jump (chair)','Hubnuti','Doma','Celé tělo',5),
(153,'Step-up (stairs)','Hubnuti','Doma','Celé tělo',5),
(154,'Stair Running','Hubnuti','Doma','Celé tělo',5),
(155,'Shadow Boxing','Hubnuti','Doma','Celé tělo',5),
(156,'Dancing','Hubnuti','Doma','Celé tělo',5),
(157,'Yoga Flow','Hubnuti','Doma','Celé tělo',5),
(158,'Pilates','Hubnuti','Doma','Celé tělo',5),
(159,'Bodyweight Circuit','Hubnuti','Doma','Celé tělo',5),
(160,'Tabata','Hubnuti','Doma','Celé tělo',5),
(161,'HIIT','Hubnuti','Doma','Celé tělo',5),
(162,'Plank Jacks','Hubnuti','Doma','Celé tělo',5),
(163,'Spider Crawl','Hubnuti','Doma','Celé tělo',5),
(164,'Bear Crawl','Hubnuti','Doma','Celé tělo',5),
(165,'Crab Walk','Hubnuti','Doma','Celé tělo',5),
(166,'Frog Jump','Hubnuti','Doma','Celé tělo',5),
(167,'Russian Twist','Hubnuti','Doma','Břicho',5),
(168,'Bicycle Crunch','Hubnuti','Doma','Břicho',5),
(169,'Leg Raise','Hubnuti','Doma','Břicho',5),
(170,'Flutter Kick','Hubnuti','Doma','Břicho',5),
(171,'Scissor Kick','Hubnuti','Doma','Břicho',5),
(172,'V-up','Hubnuti','Doma','Břicho',5),
(173,'Superman','Hubnuti','Doma','Záda',5),
(174,'Bird Dog','Hubnuti','Doma','Záda',5),
(175,'Glute Bridge','Hubnuti','Doma','Hýždě',5),
(176,'Running','Hubnuti','Venku','Celé tělo',6),
(177,'Jogging','Hubnuti','Venku','Celé tělo',6),
(178,'Sprinting','Hubnuti','Venku','Celé tělo',6),
(179,'Interval Running','Hubnuti','Venku','Celé tělo',6),
(180,'Hill Running','Hubnuti','Venku','Celé tělo',6),
(181,'Trail Running','Hubnuti','Venku','Celé tělo',6),
(182,'Stair Running','Hubnuti','Venku','Celé tělo',6),
(183,'Fartlek Training','Hubnuti','Venku','Celé tělo',6),
(184,'Cycling','Hubnuti','Venku','Celé tělo',6),
(185,'Mountain Biking','Hubnuti','Venku','Celé tělo',6),
(186,'Swimming','Hubnuti','Venku','Celé tělo',6),
(187,'Open Water Swimming','Hubnuti','Venku','Celé tělo',6),
(188,'Hiking','Hubnuti','Venku','Celé tělo',6),
(189,'Rucking','Hubnuti','Venku','Celé tělo',6),
(190,'Nordic Walking','Hubnuti','Venku','Celé tělo',6),
(191,'Cross-country Skiing','Hubnuti','Venku','Celé tělo',6),
(192,'Snowshoeing','Hubnuti','Venku','Celé tělo',6),
(193,'Kayaking','Hubnuti','Venku','Celé tělo',6),
(194,'Canoeing','Hubnuti','Venku','Celé tělo',6),
(195,'Rowing','Hubnuti','Venku','Celé tělo',6),
(196,'Stand-up Paddleboarding','Hubnuti','Venku','Celé tělo',6),
(197,'Surfing','Hubnuti','Venku','Celé tělo',6),
(198,'Beach Running','Hubnuti','Venku','Celé tělo',6),
(199,'Sand Dune Running','Hubnuti','Venku','Celé tělo',6),
(200,'Parkour','Hubnuti','Venku','Celé tělo',6),
(201,'Calisthenics','Hubnuti','Venku','Celé tělo',6),
(202,'Bootcamp','Hubnuti','Venku','Celé tělo',6),
(203,'Outdoor Yoga','Hubnuti','Venku','Celé tělo',6),
(204,'Tai Chi','Hubnuti','Venku','Celé tělo',6),
(205,'Frisbee','Hubnuti','Venku','Celé tělo',6),
(206,'Soccer','Hubnuti','Venku','Celé tělo',6),
(207,'Basketball','Hubnuti','Venku','Celé tělo',6),
(208,'Tennis','Hubnuti','Venku','Celé tělo',6),
(209,'Beach Volleyball','Hubnuti','Venku','Celé tělo',6),
(210,'Ultimate Frisbee','Hubnuti','Venku','Celé tělo',6),
(211,'Dynamic Warm-up','Kondice','Posilovna','Celé tělo',7),
(212,'Foam Rolling','Kondice','Posilovna','Celé tělo',7),
(213,'Mobility Drills','Kondice','Posilovna','Celé tělo',7),
(214,'Yoga','Kondice','Posilovna','Celé tělo',7),
(215,'Pilates','Kondice','Posilovna','Celé tělo',7),
(216,'TRX Suspension Training','Kondice','Posilovna','Celé tělo',7),
(217,'Kettlebell Flow','Kondice','Posilovna','Celé tělo',7),
(218,'Medicine Ball Circuit','Kondice','Posilovna','Celé tělo',7),
(219,'Agility Ladder','Kondice','Posilovna','Celé tělo',7),
(220,'Plyometric Box Drills','Kondice','Posilovna','Celé tělo',7),
(221,'Balance Board Exercises','Kondice','Posilovna','Celé tělo',7),
(222,'Bosu Ball Training','Kondice','Posilovna','Celé tělo',7),
(223,'Resistance Band Workout','Kondice','Posilovna','Celé tělo',7),
(224,'Stability Ball Exercises','Kondice','Posilovna','Celé tělo',7),
(225,'Core Stability Training','Kondice','Posilovna','Jádro',7),
(226,'Rotational Core Work','Kondice','Posilovna','Jádro',7),
(227,'Anti-Rotation Exercises','Kondice','Posilovna','Jádro',7),
(228,'Flexibility Routine','Kondice','Posilovna','Celé tělo',7),
(229,'Dynamic Stretching','Kondice','Posilovna','Celé tělo',7),
(230,'PNF Stretching','Kondice','Posilovna','Celé tělo',7),
(231,'Active Isolated Stretching','Kondice','Posilovna','Celé tělo',7),
(232,'Fascial Stretch','Kondice','Posilovna','Celé tělo',7),
(233,'Joint Mobility Exercises','Kondice','Posilovna','Celé tělo',7),
(234,'Coordination Drills','Kondice','Posilovna','Celé tělo',7),
(235,'Reaction Training','Kondice','Posilovna','Celé tělo',7),
(236,'Speed Drills','Kondice','Posilovna','Celé tělo',7),
(237,'Power Training','Kondice','Posilovna','Celé tělo',7),
(238,'Endurance Circuit','Kondice','Posilovna','Celé tělo',7),
(239,'Cross-training','Kondice','Posilovna','Celé tělo',7),
(240,'Functional Movement Screen','Kondice','Posilovna','Celé tělo',7),
(241,'Corrective Exercises','Kondice','Posilovna','Celé tělo',7),
(242,'Postural Training','Kondice','Posilovna','Celé tělo',7),
(243,'Breathing Exercises','Kondice','Posilovna','Celé tělo',7),
(244,'Recovery Workout','Kondice','Posilovna','Celé tělo',7),
(245,'Regeneration Session','Kondice','Posilovna','Celé tělo',7),
(246,'Morning Mobility Routine','Kondice','Doma','Celé tělo',8),
(247,'Evening Stretch Sequence','Kondice','Doma','Celé tělo',8),
(248,'Yoga Flow','Kondice','Doma','Celé tělo',8),
(249,'Sun Salutation','Kondice','Doma','Celé tělo',8),
(250,'Pilates Mat Work','Kondice','Doma','Celé tělo',8),
(251,'Tai Chi','Kondice','Doma','Celé tělo',8),
(252,'Qigong','Kondice','Doma','Celé tělo',8),
(253,'Bodyweight Mobility','Kondice','Doma','Celé tělo',8),
(254,'Resistance Band Mobility','Kondice','Doma','Celé tělo',8),
(255,'Foam Rolling','Kondice','Doma','Celé tělo',8),
(256,'Self Myofascial Release','Kondice','Doma','Celé tělo',8),
(257,'Dynamic Stretching','Kondice','Doma','Celé tělo',8),
(258,'Static Stretching','Kondice','Doma','Celé tělo',8),
(259,'PNF Stretching','Kondice','Doma','Celé tělo',8),
(260,'Active Isolated Stretching','Kondice','Doma','Celé tělo',8),
(261,'Joint Circles','Kondice','Doma','Celé tělo',8),
(262,'Spinal Mobility','Kondice','Doma','Páteř',8),
(263,'Hip Mobility','Kondice','Doma','Kyčle',8),
(264,'Shoulder Mobility','Kondice','Doma','Ramena',8),
(265,'Ankle Mobility','Kondice','Doma','Kotníky',8),
(266,'Wrist Mobility','Kondice','Doma','Zápěstí',8),
(267,'Neck Mobility','Kondice','Doma','Krk',8),
(268,'Breathing Exercises','Kondice','Doma','Celé tělo',8),
(269,'Postural Correction','Kondice','Doma','Celé tělo',8),
(270,'Core Activation','Kondice','Doma','Jádro',8),
(271,'Balance Exercises','Kondice','Doma','Celé tělo',8),
(272,'Proprioception Drills','Kondice','Doma','Celé tělo',8),
(273,'Coordination Training','Kondice','Doma','Celé tělo',8),
(274,'Relaxation Techniques','Kondice','Doma','Celé tělo',8),
(275,'Mindfulness Meditation','Kondice','Doma','Celé tělo',8),
(276,'Stress Relief Routine','Kondice','Doma','Celé tělo',8),
(277,'Sleep Preparation','Kondice','Doma','Celé tělo',8),
(278,'Recovery Yoga','Kondice','Doma','Celé tělo',8),
(279,'Restorative Stretching','Kondice','Doma','Celé tělo',8),
(280,'Regeneration Sequence','Kondice','Doma','Celé tělo',8),
(281,'Outdoor Yoga','Kondice','Venku','Celé tělo',9),
(282,'Park Workout','Kondice','Venku','Celé tělo',9),
(283,'Beach Workout','Kondice','Venku','Celé tělo',9),
(284,'Trail Mobility','Kondice','Venku','Celé tělo',9),
(285,'Forest Bathing Walk','Kondice','Venku','Celé tělo',9),
(286,'Nature Meditation','Kondice','Venku','Celé tělo',9),
(287,'Tai Chi in Park','Kondice','Venku','Celé tělo',9),
(288,'Qigong in Nature','Kondice','Venku','Celé tělo',9),
(289,'Outdoor Stretching','Kondice','Venku','Celé tělo',9),
(290,'Sunrise Mobility','Kondice','Venku','Celé tělo',9),
(291,'Sunset Stretch','Kondice','Venku','Celé tělo',9),
(292,'Rock Balancing','Kondice','Venku','Celé tělo',9),
(293,'Tree Climbing','Kondice','Venku','Celé tělo',9),
(294,'Log Carrying','Kondice','Venku','Celé tělo',9),
(295,'Stone Lifting','Kondice','Venku','Celé tělo',9),
(296,'Natural Obstacle Course','Kondice','Venku','Celé tělo',9),
(297,'Parkour Basics','Kondice','Venku','Celé tělo',9),
(298,'Animal Movement','Kondice','Venku','Celé tělo',9),
(299,'Barefoot Running','Kondice','Venku','Celé tělo',9),
(300,'Sand Walking','Kondice','Venku','Celé tělo',9),
(301,'Water Wading','Kondice','Venku','Celé tělo',9),
(302,'Hill Rolling','Kondice','Venku','Celé tělo',9),
(303,'Snow Play','Kondice','Venku','Celé tělo',9),
(304,'Ice Walking','Kondice','Venku','Celé tělo',9),
(305,'Outdoor Swimming','Kondice','Venku','Celé tělo',9),
(306,'Cold Exposure','Kondice','Venku','Celé tělo',9),
(307,'Heat Adaptation','Kondice','Venku','Celé tělo',9),
(308,'Altitude Training','Kondice','Venku','Celé tělo',9),
(309,'Breathwork in Nature','Kondice','Venku','Celé tělo',9),
(310,'Mindful Walking','Kondice','Venku','Celé tělo',9),
(311,'Sensory Awareness','Kondice','Venku','Celé tělo',9),
(312,'Nature Observation','Kondice','Venku','Celé tělo',9),
(313,'Outdoor Meditation','Kondice','Venku','Celé tělo',9),
(314,'Forest Yoga','Kondice','Venku','Celé tělo',9),
(315,'Beach Stretching','Kondice','Venku','Celé tělo',9);
/*!40000 ALTER TABLE `CVIKY` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARAMETRY`
--

LOCK TABLES `PARAMETRY` WRITE;
/*!40000 ALTER TABLE `PARAMETRY` DISABLE KEYS */;
INSERT INTO `PARAMETRY` VALUES
(41,1,180.00,75.00,85.00,100.00,65),
(42,2,180.00,75.50,84.00,102.00,65);
/*!40000 ALTER TABLE `PARAMETRY` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `ROLE`
--

LOCK TABLES `ROLE` WRITE;
/*!40000 ALTER TABLE `ROLE` DISABLE KEYS */;
INSERT INTO `ROLE` VALUES
(1,'Klient','Nabirani_Svalu','Posilovna'),
(2,'Klient','Nabirani_Svalu','Doma'),
(3,'Klient','Nabirani_Svalu','Venku'),
(4,'Klient','Hubnuti','Posilovna'),
(5,'Klient','Hubnuti','Doma'),
(6,'Klient','Hubnuti','Venku'),
(7,'Klient','Kondice','Posilovna'),
(8,'Klient','Kondice','Doma'),
(9,'Klient','Kondice','Venku'),
(10,'Trener','Nabirani_Svalu','Posilovna'),
(11,'Trener','Nabirani_Svalu','Doma'),
(12,'Trener','Nabirani_Svalu','Venku'),
(13,'Trener','Hubnuti','Posilovna'),
(14,'Trener','Hubnuti','Doma'),
(15,'Trener','Hubnuti','Venku'),
(16,'Trener','Kondice','Posilovna'),
(17,'Trener','Kondice','Doma'),
(18,'Trener','Kondice','Venku');
/*!40000 ALTER TABLE `ROLE` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USER`
--

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES
(37,'Petr','Novák','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','petr.novak@fitapp.cz','777123001','1985-05-10','Muz',10,NULL),
(38,'Lucie','Kovářová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','lucie.kovarova@fitapp.cz','777123002','1992-08-15','Zena',11,NULL),
(39,'Martin','Dvořák','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','martin.dvorak@fitapp.cz','777123003','1988-11-30','Muz',12,NULL),
(40,'Eva','Svobodová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','eva.svobodova@fitapp.cz','777123004','1990-04-22','Zena',13,NULL),
(41,'Jan','Král','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','jan.kral@fitapp.cz','777123005','1983-02-17','Muz',14,NULL),
(42,'Tereza','Benešová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','tereza.benesova@fitapp.cz','777123006','1995-06-05','Zena',15,NULL),
(43,'Roman','Vlček','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','roman.vlcek@fitapp.cz','777123007','1987-09-19','Muz',16,NULL),
(44,'Alena','Urbanová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','alena.urbanova@fitapp.cz','777123008','1993-12-12','Zena',17,NULL),
(45,'David','Pokorný','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','david.pokorny@fitapp.cz','777123009','1986-03-27','Muz',18,NULL),
(46,'Simona','Hrubá','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','simona.hruba@fitapp.cz','777123010','1991-07-11','Zena',10,NULL),
(47,'Tomáš','Sedlák','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','tomas.sedlak@fitapp.cz','777123011','1984-01-25','Muz',11,NULL),
(48,'Klára','Zelená','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','klara.zelena@fitapp.cz','777123012','1996-09-14','Zena',12,NULL),
(49,'Radek','Jelínek','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','radek.jelinek@fitapp.cz','777123013','1982-12-03','Muz',13,NULL),
(50,'Veronika','Marešová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','veronika.maresova@fitapp.cz','777123014','1994-03-09','Zena',14,NULL),
(51,'Jakub','Holý','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','jakub.holy@fitapp.cz','777123015','1990-10-10','Muz',15,NULL),
(52,'Barbora','Němcová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','barbora.nemcova@fitapp.cz','777123016','1989-05-30','Zena',16,NULL),
(53,'Michal','Procházka','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','michal.prochazka@fitapp.cz','777123017','1981-08-08','Muz',17,NULL),
(54,'Kateřina','Bláhová','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','katerina.blahova@fitapp.cz','777123018','1997-01-18','Zena',18,NULL),
(55,'Ondřej','Malý','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','ondrej.maly@fitapp.cz','777123019','1986-06-22','Muz',10,NULL),
(56,'Nikola','Vítková','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','nikola.vitkova@fitapp.cz','777123020','1991-04-03','Zena',11,NULL),
(57,'Adam','Burian','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','adam.burian@fitapp.cz','777123021','1985-02-28','Muz',12,NULL),
(58,'Irena','Vaňková','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','irena.vankova@fitapp.cz','777123022','1993-11-11','Zena',13,NULL),
(59,'Milan','Šimek','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','milan.simek@fitapp.cz','777123023','1980-07-17','Muz',14,NULL),
(60,'Lenka','Kořínková','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','lenka.korinkova@fitapp.cz','777123024','1998-02-05','Zena',15,NULL),
(61,'Filip','Bartoš','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','filip.bartos@fitapp.cz','777123025','1990-09-01','Muz',16,NULL),
(62,'Hana','Růžičková','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','hana.ruzickova@fitapp.cz','777123026','1989-10-21','Zena',17,NULL),
(63,'Václav','Navrátil','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','vaclav.navratil@fitapp.cz','777123027','1982-04-16','Muz',18,NULL),
(64,'Zuzana','Janoušková','$2y$10$2wgsYHDZI2BzPrS8eqFBgO5bxM6PiCbLGHR8YGY2OH.lekRAhk9EK','zuzana.janouskova@fitapp.cz','777123028','1996-12-27','Zena',10,NULL),
(65,'test','test','$2y$10$i4QBbA.Lh8F9dWC3wTu9u.eBVuggTjUhA/GBYM1O0k604NUqcuPI2','test@test.cz','123456789','2000-12-03','Jine',8,53);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-22 11:09:22
