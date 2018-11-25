CREATE DATABASE CADPALE;
USE CADPALE;

CREATE TABLE `palestra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `palestrante` varchar(100) NOT NULL,
  `del` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE `participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `idpalestra` int(11) NOT NULL,
  `del` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `fk-palestra_idx` (`idpalestra`),
  CONSTRAINT `fk-palestra` FOREIGN KEY (`idpalestra`) REFERENCES `palestra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
