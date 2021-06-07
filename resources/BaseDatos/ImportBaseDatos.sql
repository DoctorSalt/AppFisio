-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para empresa
CREATE DATABASE IF NOT EXISTS `empresa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `empresa`;

-- Volcando estructura para tabla empresa.citas
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
  `idClienteFK` int(11) DEFAULT NULL,
  `IdFisioterapeutaFK2` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCita`),
  KEY `idClienteFK5` (`idClienteFK`),
  KEY `idFisioterapeutaFK` (`IdFisioterapeutaFK2`),
  CONSTRAINT `idClienteFK5` FOREIGN KEY (`idClienteFK`) REFERENCES `clientes` (`idCliente`),
  CONSTRAINT `idFisioterapeutaFK` FOREIGN KEY (`IdFisioterapeutaFK2`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla empresa.citas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` (`idCita`, `horaCita`, `diaCita`, `tiempoCita`, `direccionCita`, `confirmadaCita`, `realizadoCita`, `descripcionCita`, `precioCita`, `idClienteFK`, `IdFisioterapeutaFK2`) VALUES
	(2, '12:00:00', '2021-05-27', 20, 'C/Burdeos, 24', 1, 0, 'dsds', 20.00, 1, 1),
	(3, '11:00:00', '2021-06-02', 20, 'C/Burdeos, 24', 0, 0, 'asdfaffdfsdfasddfsfadsdfassdf', 30.00, 1, 1);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

-- Volcando estructura para tabla empresa.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidoCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dniCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `passwordCliente` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla empresa.clientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `apellidoCliente`, `dniCliente`, `correoCliente`, `passwordCliente`) VALUES
	(1, 'Menito', 'Perez', '52117793T', 'lulennakam-7490@yopmail.com', 'f688ae26e9cfa3ba6235477831d5122e'),
	(2, 'sdds', 'sadsdasd', '11111111H', 'example@emial.com', 'd41d8cd98f00b204e9800998ecf8427e');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla empresa.disponibles
CREATE TABLE IF NOT EXISTS `disponibles` (
  `idDisponible` int(11) NOT NULL AUTO_INCREMENT,
  `diaDisponible` date DEFAULT NULL,
  `horaDisponible` time DEFAULT NULL,
  `idFisioterapeutaFK3` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDisponible`),
  KEY `idFisioFK` (`idFisioterapeutaFK3`),
  CONSTRAINT `idFisioFK` FOREIGN KEY (`idFisioterapeutaFK3`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla empresa.disponibles: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `disponibles` DISABLE KEYS */;
INSERT INTO `disponibles` (`idDisponible`, `diaDisponible`, `horaDisponible`, `idFisioterapeutaFK3`) VALUES
	(94, '2021-06-01', '11:00:00', 1),
	(95, '2021-06-01', '11:20:00', 1),
	(96, '2021-06-01', '11:40:00', 1),
	(98, '2021-06-02', '11:20:00', 1),
	(99, '2021-06-02', '11:40:00', 1),
	(100, '2021-06-03', '10:00:00', 1),
	(101, '2021-06-03', '10:20:00', 1),
	(102, '2021-06-03', '10:40:00', 1),
	(103, '2021-06-04', '11:00:00', 1),
	(104, '2021-06-04', '11:20:00', 1),
	(105, '2021-06-04', '11:40:00', 1),
	(106, '2021-06-07', '11:00:00', 1),
	(107, '2021-06-07', '11:20:00', 1),
	(108, '2021-06-07', '11:40:00', 1),
	(109, '2021-06-08', '11:00:00', 1),
	(110, '2021-06-08', '11:20:00', 1),
	(111, '2021-06-08', '11:40:00', 1),
	(112, '2021-06-01', '09:00:00', 2),
	(113, '2021-06-01', '09:30:00', 2),
	(114, '2021-06-01', '19:00:00', 2),
	(115, '2021-06-01', '19:30:00', 2),
	(116, '2021-06-07', '10:00:00', 2),
	(117, '2021-06-07', '10:30:00', 2),
	(118, '2021-06-07', '11:00:00', 2),
	(119, '2021-06-07', '11:30:00', 2),
	(120, '2021-06-08', '09:00:00', 2),
	(121, '2021-06-08', '09:30:00', 2),
	(122, '2021-06-08', '19:00:00', 2),
	(123, '2021-06-08', '19:30:00', 2);
/*!40000 ALTER TABLE `disponibles` ENABLE KEYS */;

-- Volcando estructura para tabla empresa.fisioterapeutas
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
  `provinciaFisioterapeuta` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla empresa.fisioterapeutas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `fisioterapeutas` DISABLE KEYS */;
INSERT INTO `fisioterapeutas` (`idFisioterapeuta`, `nombreFisioterapeuta`, `apellidoFisioterapeuta`, `especialidadFisioterapeuta`, `tiempoFisioterapeuta`, `correoFisioterapeuta`, `passwordFisioterapeuta`, `precioFisioterapeuta`, `descripcionFisioterapeuta`, `provinciaFisioterapeuta`) VALUES
	(1, 'Julio', 'Mendiguez', 'Personas de anciana edad', 20, 'rodappana-2862@yopmail.com', 'f688ae26e9cfa3ba6235477831d5122e', 1.50, 'Uno', 'Sevilla'),
	(2, 'Juan Diego', 'Rodriguez', 'Deportistas', 30, 'ocixunno-9054@yopmail.com', '0d8d5177c7313357c9c8919e1c3c2f99', 3.00, 'dfsdfaadfs', 'Sevilla');
/*!40000 ALTER TABLE `fisioterapeutas` ENABLE KEYS */;

-- Volcando estructura para tabla empresa.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `diaSemanaHorario` int(11) DEFAULT '0',
  `hora1Horario` time DEFAULT NULL,
  `hora2Horario` time DEFAULT NULL,
  `hora3Horario` time DEFAULT NULL,
  `hora4Horario` time DEFAULT NULL,
  `fechaInicioHorario` date DEFAULT NULL,
  `fechaFinHorario` date DEFAULT NULL,
  `idFisioterpeutaFK1` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idHorario`),
  KEY `idFisioterpeutaFK5` (`idFisioterpeutaFK1`),
  CONSTRAINT `idFisioterpeutaFK5` FOREIGN KEY (`idFisioterpeutaFK1`) REFERENCES `fisioterapeutas` (`idFisioterapeuta`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla empresa.horarios: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` (`idHorario`, `diaSemanaHorario`, `hora1Horario`, `hora2Horario`, `hora3Horario`, `hora4Horario`, `fechaInicioHorario`, `fechaFinHorario`, `idFisioterpeutaFK1`) VALUES
	(101, 1, '11:00:00', '12:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 1),
	(102, 2, '11:00:00', '12:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 1),
	(103, 3, '11:00:00', '12:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 1),
	(104, 4, '10:00:00', '11:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 1),
	(105, 5, '11:00:00', '12:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 1),
	(106, 1, '10:00:00', '12:00:00', NULL, NULL, '2021-06-01', '2021-06-08', 2),
	(107, 2, '09:00:00', '10:00:00', '19:00:00', '20:00:00', '2021-06-01', '2021-06-08', 2);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
