-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 06:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `documentos`
--

-- --------------------------------------------------------

--
-- Table structure for table `DOC_DOCUMENTO`
--

CREATE TABLE `DOC_DOCUMENTO` (
  `DOC_ID` int(11) NOT NULL,
  `DOC_NOMBRE` varchar(60) DEFAULT NULL,
  `DOC_CODIGO` varchar(50) DEFAULT NULL,
  `DOC_CONTENIDO` varchar(400) DEFAULT NULL,
  `DOC_ID_TIPO` int(11) NOT NULL,
  `DOC_ID_PROCESO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `DOC_DOCUMENTO`
--

INSERT INTO `DOC_DOCUMENTO` (`DOC_ID`, `DOC_NOMBRE`, `DOC_CODIGO`, `DOC_CONTENIDO`, `DOC_ID_TIPO`, `DOC_ID_PROCESO`) VALUES
(1, 'Documento de Auditoira', 'DEM-SOL-1', 'Se hace auditoria de los proceso', 2, 2),
(2, 'Apoyo Demandas', 'DEM-APO-2', 'Apoyo a demandas pendientes', 2, 1),
(3, 'Instructivo Planeación', 'INS-APO-3', 'Instructivo de Planeación', 1, 1),
(4, 'Apoyo Abogados', 'DEM-APO-4', 'apoyo a procesos penidente', 2, 1),
(5, 'Instructivo Escuelas', 'INS-APO-5', 'instructivo para escuelas', 1, 1),
(6, 'Demandas Resueltas', 'DEM-APO-6', 'Detalle de las demandas', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PRO_PROCESO`
--

CREATE TABLE `PRO_PROCESO` (
  `PRO_ID` int(11) NOT NULL,
  `PRO_NOMBRE` varchar(60) NOT NULL,
  `PRO_PREFIJO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PRO_PROCESO`
--

INSERT INTO `PRO_PROCESO` (`PRO_ID`, `PRO_NOMBRE`, `PRO_PREFIJO`) VALUES
(1, 'Apoyo', 'APO'),
(2, 'Solicitudes', 'SOL');

-- --------------------------------------------------------

--
-- Table structure for table `TIP_TIPO_DOC`
--

CREATE TABLE `TIP_TIPO_DOC` (
  `TIP_ID` int(11) NOT NULL,
  `TIP_NOMBRE` varchar(60) DEFAULT NULL,
  `TIP_PREFIJO` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TIP_TIPO_DOC`
--

INSERT INTO `TIP_TIPO_DOC` (`TIP_ID`, `TIP_NOMBRE`, `TIP_PREFIJO`) VALUES
(1, 'Instructivo', 'INS'),
(2, 'Demandas', 'DEM');

-- --------------------------------------------------------

--
-- Table structure for table `USU_USUARIO`
--

CREATE TABLE `USU_USUARIO` (
  `USU_ID` int(11) NOT NULL,
  `USU_NOMBRE` varchar(30) DEFAULT NULL,
  `USU_APELLIDO` varchar(30) DEFAULT NULL,
  `USU_EMAIL` varchar(50) DEFAULT NULL,
  `USU_CLAVE` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USU_USUARIO`
--

INSERT INTO `USU_USUARIO` (`USU_ID`, `USU_NOMBRE`, `USU_APELLIDO`, `USU_EMAIL`, `USU_CLAVE`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$1LhpjQnnEsLECWOsykjj4uq7B4Huu5dbpPjZ6H0IYtfIaGapXctKi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DOC_DOCUMENTO`
--
ALTER TABLE `DOC_DOCUMENTO`
  ADD PRIMARY KEY (`DOC_ID`),
  ADD UNIQUE KEY `CODIGO_UNICO` (`DOC_CODIGO`),
  ADD KEY `DOC_ID_PROCESO` (`DOC_ID_PROCESO`),
  ADD KEY `DOC_ID_TIPO` (`DOC_ID_TIPO`);

--
-- Indexes for table `PRO_PROCESO`
--
ALTER TABLE `PRO_PROCESO`
  ADD PRIMARY KEY (`PRO_ID`);

--
-- Indexes for table `TIP_TIPO_DOC`
--
ALTER TABLE `TIP_TIPO_DOC`
  ADD PRIMARY KEY (`TIP_ID`);

--
-- Indexes for table `USU_USUARIO`
--
ALTER TABLE `USU_USUARIO`
  ADD PRIMARY KEY (`USU_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DOC_DOCUMENTO`
--
ALTER TABLE `DOC_DOCUMENTO`
  MODIFY `DOC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `PRO_PROCESO`
--
ALTER TABLE `PRO_PROCESO`
  MODIFY `PRO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TIP_TIPO_DOC`
--
ALTER TABLE `TIP_TIPO_DOC`
  MODIFY `TIP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `USU_USUARIO`
--
ALTER TABLE `USU_USUARIO`
  MODIFY `USU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DOC_DOCUMENTO`
--
ALTER TABLE `DOC_DOCUMENTO`
  ADD CONSTRAINT `doc_documento_ibfk_1` FOREIGN KEY (`DOC_ID_PROCESO`) REFERENCES `PRO_PROCESO` (`PRO_ID`),
  ADD CONSTRAINT `doc_documento_ibfk_2` FOREIGN KEY (`DOC_ID_TIPO`) REFERENCES `TIP_TIPO_DOC` (`TIP_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
