-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema televia
--

CREATE DATABASE IF NOT EXISTS televia;
USE televia;

--
-- Definition of table `sm_fa_conf`
--

DROP TABLE IF EXISTS `sm_fa_conf`;
CREATE TABLE `sm_fa_conf` (
  `idOpt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `api_key` text NOT NULL,
  `api_secret` text NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `idAccount` int(10) unsigned NOT NULL,
  `username_company` varchar(45) NOT NULL,
  PRIMARY KEY (`idOpt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_fa_conf`
--

/*!40000 ALTER TABLE `sm_fa_conf` DISABLE KEYS */;
INSERT INTO `sm_fa_conf` (`idOpt`,`api_key`,`api_secret`,`username`,`password`,`idAccount`,`username_company`) VALUES 
 (1,'182035988617376','58098ca808958f31f1f62dfef9089e72','cmarrero01@gmail.com','book2012$',1,'marreroclaudio');
/*!40000 ALTER TABLE `sm_fa_conf` ENABLE KEYS */;


--
-- Definition of table `sm_filtro`
--

DROP TABLE IF EXISTS `sm_filtro`;
CREATE TABLE `sm_filtro` (
  `idFiltro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `words` text NOT NULL,
  `isAutomatic` tinyint(3) unsigned NOT NULL,
  `twMessage` text NOT NULL,
  `faceMessage` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `idAccount` int(10) unsigned NOT NULL,
  `showInHome` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idFiltro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_filtro`
--

/*!40000 ALTER TABLE `sm_filtro` DISABLE KEYS */;
INSERT INTO `sm_filtro` (`idFiltro`,`name`,`words`,`isAutomatic`,`twMessage`,`faceMessage`,`status`,`idAccount`,`showInHome`) VALUES 
 (2,'Autopistas','autopista',1,'Mensaje para twitter','Mensaje para facebook',1,1,1),
 (3,'Muertes','Muertos',1,'Test','Test',1,1,1),
 (4,'Tetas','martes%20de%20tetas',1,'asdf','asdf',1,1,1);
/*!40000 ALTER TABLE `sm_filtro` ENABLE KEYS */;


--
-- Definition of table `sm_sessions`
--

DROP TABLE IF EXISTS `sm_sessions`;
CREATE TABLE `sm_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sm_sessions`
--

/*!40000 ALTER TABLE `sm_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sm_sessions` ENABLE KEYS */;


--
-- Definition of table `sm_tw_conf`
--

DROP TABLE IF EXISTS `sm_tw_conf`;
CREATE TABLE `sm_tw_conf` (
  `idOpt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `consumer_key` text NOT NULL,
  `consumer_secret` text NOT NULL,
  `access_token` text NOT NULL,
  `access_token_secret` text NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `idAccount` int(10) unsigned NOT NULL,
  `username_company` varchar(45) NOT NULL,
  PRIMARY KEY (`idOpt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_tw_conf`
--

/*!40000 ALTER TABLE `sm_tw_conf` DISABLE KEYS */;
INSERT INTO `sm_tw_conf` (`idOpt`,`consumer_key`,`consumer_secret`,`access_token`,`access_token_secret`,`username`,`password`,`idAccount`,`username_company`) VALUES 
 (1,'RPwAUxWS99r8YBnIIGiKRg','SIvP2kxXSo5HuuveindgvoXafMRk9DjbqAusqbCCM','62429679-TPP9O6rDYasNd2kL349OjxxdgoprZG6KE2SX8rUXh','VKmfRiiK20QZ1GpjSLJaPY2Q2Fkjr7NE01SQHKYraw','cmarrero01','RPwAUxWS99r8YBnIIGiKRg',1,'cmarrero01');
/*!40000 ALTER TABLE `sm_tw_conf` ENABLE KEYS */;


--
-- Definition of table `sm_tw_fa_not`
--

DROP TABLE IF EXISTS `sm_tw_fa_not`;
CREATE TABLE `sm_tw_fa_not` (
  `idPost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastIdTwPost` text NOT NULL,
  `lastIdFaPost` text NOT NULL,
  `countMessages` int(10) unsigned NOT NULL,
  `flag` tinyint(3) unsigned NOT NULL,
  `idFiltro` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPost`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_tw_fa_not`
--

/*!40000 ALTER TABLE `sm_tw_fa_not` DISABLE KEYS */;
INSERT INTO `sm_tw_fa_not` (`idPost`,`lastIdTwPost`,`lastIdFaPost`,`countMessages`,`flag`,`idFiltro`) VALUES 
 (1,'326806601593925632','search?q=autopista&limit=10&type=post&center=24.086589,-102.502441&distance=1796&until=1365944145',1125,1,2),
 (4,'326806671471017984','search?q=Muertos&limit=10&type=post&center=24.086589,-102.502441&distance=1796&until=1366732609',2416,1,3),
 (5,'326766319003398144','',0,0,4);
/*!40000 ALTER TABLE `sm_tw_fa_not` ENABLE KEYS */;


--
-- Definition of table `sm_tw_fa_posts`
--

DROP TABLE IF EXISTS `sm_tw_fa_posts`;
CREATE TABLE `sm_tw_fa_posts` (
  `idPost` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastIdTwPost` text NOT NULL,
  `lastIdFaPost` text NOT NULL,
  `idFiltro` int(10) unsigned NOT NULL,
  `flag` tinyint(3) unsigned NOT NULL,
  `countMessages` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPost`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_tw_fa_posts`
--

/*!40000 ALTER TABLE `sm_tw_fa_posts` DISABLE KEYS */;
INSERT INTO `sm_tw_fa_posts` (`idPost`,`lastIdTwPost`,`lastIdFaPost`,`idFiltro`,`flag`,`countMessages`) VALUES 
 (1,'326806601593925632','search?q=autopista&limit=10&type=post&center=24.086589,-102.502441&distance=1796&until=1365944145',2,1,1125),
 (2,'326792708683333634','search?q=Muertos&limit=10&type=post&center=24.086589,-102.502441&distance=1796&until=1366742259',3,0,0),
 (3,'326766319003398144','',4,0,0);
/*!40000 ALTER TABLE `sm_tw_fa_posts` ENABLE KEYS */;


--
-- Definition of table `sm_user`
--

DROP TABLE IF EXISTS `sm_user`;
CREATE TABLE `sm_user` (
  `idUser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `idAccount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sm_user`
--

/*!40000 ALTER TABLE `sm_user` DISABLE KEYS */;
INSERT INTO `sm_user` (`idUser`,`email`,`password`,`full_name`,`idAccount`) VALUES 
 (1,'cmarrero01@gmail.com','c893bad68927b457dbed39460e6afd62','Claudio A. Marrero',1);
/*!40000 ALTER TABLE `sm_user` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
