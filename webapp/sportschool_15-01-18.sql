# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.29)
# Database: sportschool
# Generation Time: 2018-01-15 13:09:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activiteit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activiteit`;

CREATE TABLE `activiteit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `automaat_id` int(11) DEFAULT NULL,
  `begin_datum` datetime NOT NULL,
  `eind_datum` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `automaat_idx` (`automaat_id`),
  KEY `user_idx` (`user_id`),
  CONSTRAINT `automaat` FOREIGN KEY (`automaat_id`) REFERENCES `automaat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table automaat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `automaat`;

CREATE TABLE `automaat` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `bedrag_per_minuut` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transacties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transacties`;

CREATE TABLE `transacties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transactieType_id` int(11) NOT NULL,
  `bedrag` double DEFAULT NULL,
  `datum` date NOT NULL,
  `activiteit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  KEY `type_idx` (`transactieType_id`),
  KEY `activiteit_idx` (`activiteit_id`),
  CONSTRAINT `activiteit123` FOREIGN KEY (`activiteit_id`) REFERENCES `activiteit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `type123` FOREIGN KEY (`transactieType_id`) REFERENCES `transactietype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user123` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transactietype
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactietype`;

CREATE TABLE `transactietype` (
  `id` int(11) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) NOT NULL,
  `wachtwoord` varchar(188) NOT NULL,
  `geboortedatum` date NOT NULL,
  `pasnummer` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
