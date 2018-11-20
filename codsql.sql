CREATE DATABASE CADPALE;
USE CADPALE;

CREATE TABLE `palestra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `palestrante` varchar(100) NOT NULL,
  `del` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `palestra` (`id`, `nome`, `data`, `palestrante`, `del`) VALUES
(9, 'BRAIN STORM', '2019-01-09 00:00:00', 'Luis Cunha Alves', b'0'),
(10, 'PALESTRA MOTIVACIONAL', '2020-02-02 00:00:00', 'Diogo Pereira Azevedo', b'0');
INSERT INTO `participante` (`id`, `nome`, `email`, `celular`, `idpalestra`, `del`) VALUES
(1, 'Fábio Lima Araujo', 'fabio@live.com', '99999999999', 9, b'0'),
(2, 'Luís Gomes Almeida', 'luis@live.com', '99999999999', 9, b'0'),
(3, 'Thiago Souza Costa', 'thiago@hotmail.com', '99999999999', 10, b'0'),
(4, 'Júlio Fernandes Ferreira', 'julio@outlook.com', '99999999999', 10, b'0');