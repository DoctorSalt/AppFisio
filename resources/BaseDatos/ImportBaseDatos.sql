/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `empresa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `empresa`;

CREATE TABLE IF NOT EXISTS `citas` (
  `idCita` int(11) NOT NULL AUTO_INCREMENT,
  `horaCita` time DEFAULT NULL,
  `diaCita` date DEFAULT NULL,
  `tiempoCita` int(11) DEFAULT NULL,
  `direccionCita` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `confirmadaCita` int(11) DEFAULT NULL,
  `realizadoCita` int(11) DEFAULT NULL,
  `descripcionCita` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioCita` decimal(10,2) DEFAULT NULL,
  `idClienteFK5` int(11) DEFAULT NULL,
  `IdFisioterapeutaFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCita`),
  KEY `idClienteFK5` (`idClienteFK5`),
  KEY `idFisioterapeutaFK` (`IdFisioterapeutaFK`),
  CONSTRAINT `idClienteFK5` FOREIGN KEY (`idClienteFK5`) REFERENCES `clientes` (`idCliente`),
  CONSTRAINT `idFisioterapeutaFK` FOREIGN KEY (`IdFisioterapeutaFK`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidoCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dniCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `passwordCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `apellidoCliente`, `dniCliente`, `correoCliente`, `passwordCliente`) VALUES
	(1, 'Menito', 'Perez', '52117793T', 'lulennakam-7490@yopmail.com', 'f688ae26e9cfa3ba6235477831d5122e'),
	(2, 'sdds', 'sadsdasd', '11111111H', 'example@emial.com', 'd41d8cd98f00b204e9800998ecf8427e');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `disponibles` (
  `idDisponible` int(11) NOT NULL AUTO_INCREMENT,
  `diaDisponible` date DEFAULT NULL,
  `horaDisponible` time DEFAULT NULL,
  `idFisioFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDisponible`),
  KEY `idFisioFK9` (`idFisioFK`),
  CONSTRAINT `idFisioFK9` FOREIGN KEY (`idFisioFK`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40000 ALTER TABLE `disponibles` DISABLE KEYS */;
/*!40000 ALTER TABLE `disponibles` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `fisioterapeutas` (
  `idFisioterapeuta` int(11) NOT NULL AUTO_INCREMENT,
  `nombreFisioterapeuta` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidoFisioterapeuta` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `especialidadFisioterapeuta` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tiempoFisioterapeuta` int(11) DEFAULT NULL,
  `correoFisioterapeuta` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `passwordFisioterapeuta` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioFisioterapeuta` decimal(10,2) DEFAULT NULL,
  `descripcionFisioterapeuta` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40000 ALTER TABLE `fisioterapeutas` DISABLE KEYS */;
INSERT INTO `fisioterapeutas` (`idFisioterapeuta`, `nombreFisioterapeuta`, `apellidoFisioterapeuta`, `especialidadFisioterapeuta`, `tiempoFisioterapeuta`, `correoFisioterapeuta`, `passwordFisioterapeuta`, `precioFisioterapeuta`, `descripcionFisioterapeuta`) VALUES
	(1, 'Julio', 'Mendiguez', 'Personas de anciana edad', 20, 'rodappana-2862@yopmail.com', 'f688ae26e9cfa3ba6235477831d5122e', 10.00, 'Uno'),
	(2, 'Juan Diego', 'Rodriguez', 'Deportistas', 30, 'ocixunno-9054@yopmail.com', '0d8d5177c7313357c9c8919e1c3c2f99', 15.00, 'dfsdfaadfs');
/*!40000 ALTER TABLE `fisioterapeutas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `horarios` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `diaSemanaHorario` int(11) DEFAULT '0',
  `hora1Horario` time DEFAULT NULL,
  `hora2Horario` time DEFAULT NULL,
  `hora3Horario` time DEFAULT NULL,
  `hora4Horario` time DEFAULT NULL,
  `fechaInicioHorario` date DEFAULT NULL,
  `fechaFinHorario` date DEFAULT NULL,
  `idFisioterpeutaFK` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idHorario`),
  KEY `idFisioterpeutaFK5` (`idFisioterpeutaFK`),
  CONSTRAINT `idFisioterpeutaFK5` FOREIGN KEY (`idFisioterpeutaFK`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;