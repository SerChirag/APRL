-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: june
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `interest` text,
  `approval` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicant`
--

LOCK TABLES `applicant` WRITE;
/*!40000 ALTER TABLE `applicant` DISABLE KEYS */;
INSERT INTO `applicant` VALUES (9,'2',2,'I want to.',NULL),(11,'mohan',2,'I love ML','no'),(12,'mohan',4,'I would love to work with u.\r\n','yes'),(13,'mohan',6,'I want to learn mysql.',NULL),(14,'hello',2,'ML is my favourite topic.','yes'),(15,'hello',4,'Thunderbird makes me crazy.','no');
/*!40000 ALTER TABLE `applicant` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_applicant_update` BEFORE UPDATE ON `applicant` FOR EACH ROW BEGIN
    INSERT INTO studentinfo
    SET action = 'update',
     username = OLD.username;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `offeredby` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_url` text,
  `spam` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `reads` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` text,
  `video_url` text,
  PRIMARY KEY (`blog_id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keywords` (`keywords`),
  FULLTEXT KEY `offeredby` (`offeredby`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'2','This will call the normal command found in our path, without using the aliased version.\r\n\r\nAssuming you did not unset it, the ll alias will be available throughout the current shell session, but when you open a new terminal window, this will not be available.\r\n\r\nTo make this persistent, we need to add this into one of the various files that is read when a shell session begins. Popular choices are ~/.bashrc and ~/.bash_profile. We just need to open the file and add the alias there:','2018-05-29 12:00:39','no url',3,1946,7166,'Journey To End Of Earth','',''),(2,'',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu eros risus. Cras feugiat interdum magna, vulputate venenatis eros bibendum quis. Integer nisl lectus, tincidunt nec aliquam eget, blandit et arcu. Quisque dignissim quam risus, eu tincidunt diam varius et. Proin sollicitudin lacus leo, ut iaculis neque viverra eu. Cras sit amet mauris eget sem mollis sagittis id sed eros. Praesent eu nulla tortor. Curabitur efficitur feugiat massa id elementum. Integer at diam lectus. Integer tincidunt orci at magna dictum, vel gravida ex vulputate. Nullam congue molestie velit quis tincidunt.\r\n\r\nMorbi blandit blandit ultricies. Aliquam erat volutpat. Proin pulvinar orci et posuere maximus. Aliquam et efficitur purus, quis consectetur justo. Fusce non ex lacus. Etiam scelerisque, est quis feugiat luctus, enim felis tincidunt lectus, et imperdiet justo nunc sit amet dolor. Phasellus vestibulum in enim ut tristique. ','2017-11-06 01:57:12','http://www.google.com',45,1200,7004,'The Dawn Of The World','',''),(3,'',' Praesent sagittis arcu non justo mattis, ut rutrum odio sagittis. Donec nisl risus, tempus eget rutrum sit amet, ultrices nec ex. Suspendisse suscipit lectus in libero lobortis semper. Aenean a scelerisque justo, eget tempus lorem. Aliquam rhoncus nulla massa, nec fringilla est consequat nec. Duis vel est consectetur, bibendum erat ut, sagittis diam. In risus ante, pulvinar at malesuada vitae, interdum ac purus. Duis gravida commodo lectus, nec sagittis urna. Vestibulum condimentum nisl dolor, non maximus mauris tempus ut. Aenean sit amet lectus tempus, luctus mauris quis, vulputate orci. Mauris imperdiet nisl lacus, id interdum lectus imperdiet ut. Morbi accumsan sodales ex. Fusce eu mauris vel magna finibus consectetur. Morbi vel mauris eget augue consequat eleifend. Curabitur eleifend, arcu ut pulvinar interdum, nunc ex molestie sapien, eu convallis magna lectus eu eros. Nulla gravida lacinia blandit.\r\n\r\nVestibulum libero sapien, tempus eu suscipit et, placerat id diam. Donec bibendum eget mi ac lobortis. Nullam nisi urna, vestibulum quis felis ac, hendrerit aliquam urna. In hac habitasse platea dictumst. Pellentesque sed fringilla libero. Mauris varius mi non turpis rhoncus porttitor. Sed nec lectus tempus, mattis nulla ut, egestas justo. Nulla nec bibendum elit. ','2017-11-06 01:58:12','http://www.yahoo.com',6,456,9002,'This is London Baby','',''),(4,'','Proin suscipit pharetra nisl, et bibendum lorem malesuada a. Cras vel quam et lectus tincidunt feugiat vitae eget arcu. Vestibulum sed diam in metus ultricies eleifend ut ut elit. Nunc placerat dui at laoreet tincidunt. Quisque non vestibulum justo. Pellentesque blandit laoreet volutpat. Nulla vestibulum sollicitudin accumsan. Phasellus quis urna dolor. Integer et hendrerit nulla. Fusce eget urna ante. Praesent ac nibh eu mi vestibulum ultrices vitae eu diam. Quisque luctus, quam ullamcorper posuere sagittis, justo nisl posuere lectus, in imperdiet leo elit eget augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin dignissim facilisis mauris sed sagittis. Fusce posuere at ipsum eget tempus. Quisque sem lectus, pharetra quis urna quis, pellentesque feugiat est. ','2017-11-06 02:00:06','http://www.ask.me',1,520,6423,'Welcome To The Jungle','',''),(5,'','The Greek War of Independence, also known as the Greek Revolution (Greek: ???????? ??????????, Elliniki Epanastasi; Ottoman: ????? ?????? Yunan ?syan? Greek Uprising), was a successful war of independence waged by the Greek revolutionaries between 1821 and 1832 against the Ottoman Empire. The Greeks were later assisted by the Russian Empire, Great Britain, the Kingdom of France, and several other European powers, while the Ottomans were aided by their vassals, the eyalets of Egypt, Algeria, and Tripolitania, and the Beylik of Tunis.\r\n\r\nEven several decades before the fall of Constantinople to the Ottoman Empire in 1453, most of Greece had come under Ottoman rule.[3] During this time, there were several revolt attempts by Greeks to gain independence from Ottoman control.[4] In 1814, a secret organization called the Filiki Eteria was founded with the aim of liberating Greece. The Filiki Eteria planned to launch revolts in the Peloponnese, the Danubian Principalities, and in Constantinople and its surrounding areas. By late 1820, the insurrection had been planned for March 25 (Julian Calendar) 1821, on the Feast of the Annunciation for the Orthodox Christians. However, as the plans of Filiki Eteria had been discovered by the Ottoman authorities, the revolutionary action started earlier. The first of these revolts began on March 6/February 22, 1821 in the Danubian Principalities, but it was soon put down by the Ottomans.','2017-11-06 02:02:09','http://www.wikipedia.com',0,458,8500,'The Greek War Of Independence','',''),(53,'2','<p>Game of thrones ia na epic love story between a beautiful princess and an average lokking man.</p>','2018-05-29 11:07:18',NULL,0,0,2,'Game of thrones','story love thrones na ia epic ',NULL),(54,'2','<p>We are all victims, Answlmo. Our destinies are decided by a cosmic roll of the dice, the winds of the stars, the vagrant breezes of fortune that blow from the windmills of the gods.</p>','2018-05-29 11:14:48','',0,0,12,'Hell to the world.','windmills vagrant breezes cosmic winds roll ',''),(55,'2','<p>This is a simple testing blog for the project. It is an interacting platform for researchers and learners.</p>','2018-05-29 11:13:02','',0,0,5,'Blog number 1','simple blog testing ',''),(56,'2','<p><span class=\"st\"><em>Redmine</em> is a free and open source, web-based project management and issue tracking tool. It allows users to manage multiple projects and associated&nbsp;...</span></p>','2018-05-29 12:02:37','',0,0,1,'pool','tracking multiple tool manage project management based issue projects ','');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogimage`
--

DROP TABLE IF EXISTS `blogimage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogimage`
--

LOCK TABLES `blogimage` WRITE;
/*!40000 ALTER TABLE `blogimage` DISABLE KEYS */;
INSERT INTO `blogimage` VALUES (1,9,'');
/*!40000 ALTER TABLE `blogimage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogtag`
--

DROP TABLE IF EXISTS `blogtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogtag`
--

LOCK TABLES `blogtag` WRITE;
/*!40000 ALTER TABLE `blogtag` DISABLE KEYS */;
INSERT INTO `blogtag` VALUES (1,1,1),(2,3,1),(3,5,1),(4,2,2),(5,3,3),(6,8,2),(7,2,3),(8,5,3),(9,3,2),(10,3,4),(12,5,2),(14,5,4),(15,2,4),(48,8,54),(49,7,55),(50,3,53),(51,3,54),(52,3,38),(53,3,55),(54,0,42),(55,3,43),(56,0,43),(57,8,44),(58,7,44),(59,3,0),(60,0,0),(61,8,45),(62,7,48),(63,7,49),(64,7,50),(65,7,50),(66,7,50),(67,7,50),(68,4,54),(69,8,54),(70,7,55),(71,7,56);
/*!40000 ALTER TABLE `blogtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facultyinfo`
--

DROP TABLE IF EXISTS `facultyinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultyinfo` (
  `username` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `image_url` text NOT NULL,
  `credential` varchar(255) DEFAULT NULL,
  `description` text,
  `lastblog` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  FULLTEXT KEY `firstname` (`firstname`),
  FULLTEXT KEY `lastname` (`lastname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultyinfo`
--

LOCK TABLES `facultyinfo` WRITE;
/*!40000 ALTER TABLE `facultyinfo` DISABLE KEYS */;
INSERT INTO `facultyinfo` VALUES ('2','Aditya','Nigam','aditya@iitmandi.ac.in','2.jpg','Web-Developer','I am interested in ML.',2147483647),('Arti Kashyap','Arti','Kashyap','','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `facultyinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `offeredby` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `addedon` date NOT NULL,
  `incentive` text NOT NULL,
  `lastdate` date NOT NULL,
  `status` varchar(25) NOT NULL,
  `fame_fund` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`project_id`),
  FULLTEXT KEY `offeredby` (`offeredby`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Narendra Karmarkar','Linear Programming','Linear programming plays a very important role in optimization models. We can use our resources fully if we can optimize its use and this model can be formed with linear programming.','2017-11-03','0','2018-05-31','current',100),(2,'2','Machine Learning','hello world','2017-11-03','Rs.1500 per week.','2018-05-31','available',2),(3,'Aditya Nigam','Deep Learning','This project is intended to introduce you to basic deep learning reinforcement techniques.','2017-11-02','0','2018-05-31','finished',0),(4,'2','Thunderbird mail service','This project aim to introduce to open source contribution.We will create a plugin for open source thunderbird mail client.','2017-11-01','Rs.2000-/','2018-05-31','available',0),(6,'Arti Kashyap','Mysql Basics','MySQL (officially pronounced as \"My S-Q-L\",[6]) is an open-source relational database management system (RDBMS).[7] Its name is a combination of \"My\", the name of co-founder Michael Widenius\'s daughter,[8] and \"SQL\", the abbreviation for Structured Query Language. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation.[9] For proprietary use, several paid editions are available, and offer additional functionality.\r\nMySQL is a central component of the LAMP open-source web application software stack (and other \"AMP\" stacks). LAMP is an acronym for \"Linux, Apache, MySQL, Perl/PHP/Python\". Applications that use the MySQL database include: TYPO3, MODx, Joomla, WordPress, phpBB, MyBB, and Drupal. MySQL is also used in many high-profile, large-scale websites, including Google[10][11] (though not for searches), Facebook,[12][13][14] Twitter,[15] Flickr,[16] and YouTube.[17]','2017-11-06','0','2018-05-31','available',0),(8,'2','New Projet','','2018-05-29','5656','2017-04-28','available',0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projectimage`
--

DROP TABLE IF EXISTS `projectimage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projectimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `imageurl` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projectimage`
--

LOCK TABLES `projectimage` WRITE;
/*!40000 ALTER TABLE `projectimage` DISABLE KEYS */;
INSERT INTO `projectimage` VALUES (1,8,'2.jpg');
/*!40000 ALTER TABLE `projectimage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projecttag`
--

DROP TABLE IF EXISTS `projecttag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projecttag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projecttag`
--

LOCK TABLES `projecttag` WRITE;
/*!40000 ALTER TABLE `projecttag` DISABLE KEYS */;
INSERT INTO `projecttag` VALUES (1,2,1),(2,6,1),(3,7,2),(4,8,3);
/*!40000 ALTER TABLE `projecttag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentinfo`
--

DROP TABLE IF EXISTS `studentinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentinfo` (
  `username` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `image_url` text NOT NULL,
  `credential` varchar(255) DEFAULT NULL,
  `description` text,
  `lastblog` text,
  `cgpa` decimal(10,0) NOT NULL,
  PRIMARY KEY (`username`),
  FULLTEXT KEY `firstname` (`firstname`),
  FULLTEXT KEY `lastname` (`lastname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentinfo`
--

LOCK TABLES `studentinfo` WRITE;
/*!40000 ALTER TABLE `studentinfo` DISABLE KEYS */;
INSERT INTO `studentinfo` VALUES ('1','Prabhakar','Prasad','prabhakarpd7284@gmail.com','','1',NULL,NULL,0),('bigboss','Big','Boss','bigboss7284@gmail.com','WIN_20170915_17_18_36_Pro.jpg','B.tech IIT Mandi','I am Big Boss. No one cross my path.',NULL,9),('hello','Hello','World','','fb_avatar_male.jpg','','','0',0),('mohan','mohan','bhagwat','','fb_avatar_male.jpg','','',NULL,0),('pd','pd','pd','','pd.jpg','','','',0);
/*!40000 ALTER TABLE `studentinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` text NOT NULL,
  PRIMARY KEY (`tag_id`),
  FULLTEXT KEY `tagname` (`tagname`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Competitive Coding'),(2,'C++'),(3,'Python'),(4,'Android Development'),(5,'Data Structures'),(6,'Linear Programming'),(7,'Machine Learning'),(8,'Deep Learning');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlogin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `fame` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlogin`
--

LOCK TABLES `userlogin` WRITE;
/*!40000 ALTER TABLE `userlogin` DISABLE KEYS */;
INSERT INTO `userlogin` VALUES ('2','da4b9237bacccdf19c0760cab7aec4a8359010b0','faculty',98),('Arti Kashyap','arti','faculty',100),('hello','aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d','student',100),('mohan','abee2cb38f12d53e4682bab140e8f4b568816eee','student',100),('pd','e9efe2aea5ad46614d39e809e89207fa6f915ffe','student',100),('prabhakarpd7284','prabhakarpd7284','student',100);
/*!40000 ALTER TABLE `userlogin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29 14:26:01
