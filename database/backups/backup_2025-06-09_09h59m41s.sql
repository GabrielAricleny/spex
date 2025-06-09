/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_spex
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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `id_usuario` int(11) NOT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_administrador_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES
(1,'000-000-000','2025-06-07 23:21:00','2025-06-07 23:21:00');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_administrador_no_duplicate_insert
BEFORE INSERT ON administrador
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM administrador WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de administrador já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_administrador_no_duplicate_update
BEFORE UPDATE ON administrador
FOR EACH ROW
BEGIN
    IF NEW.telefone <> OLD.telefone AND EXISTS (SELECT 1 FROM administrador WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de administrador já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(150) NOT NULL,
  `nivel_curso` enum('medio','superior') DEFAULT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_curso`),
  UNIQUE KEY `nome_curso` (`nome_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES
(1,'MED Ciências Físicas e Biológicas','medio','2025-06-07 23:21:00','2025-06-08 08:23:50'),
(2,'MED Ciências Económicas e Jurídicas','medio','2025-06-07 23:21:00','2025-06-08 08:23:56'),
(3,'MED Ciências Humanas','medio','2025-06-07 23:21:00','2025-06-08 08:24:09'),
(4,'MED Enfermagem','medio','2025-06-07 23:21:00','2025-06-08 08:24:14'),
(5,'MED Análises Clínicas','medio','2025-06-07 23:21:00','2025-06-08 08:24:18'),
(6,'MED Fisioterapia','medio','2025-06-07 23:21:00','2025-06-08 08:24:24'),
(7,'MED Farmácia','medio','2025-06-07 23:21:00','2025-06-08 08:24:29'),
(8,'MED Informática','medio','2025-06-07 23:21:00','2025-06-08 08:24:47'),
(9,'Gestão de Sistemas Informáticos','medio','2025-06-07 23:21:00','2025-06-08 08:24:52'),
(10,'MED Electricidade','medio','2025-06-07 23:21:00','2025-06-08 08:24:58'),
(11,'MED Desenho Técnico','medio','2025-06-07 23:21:00','2025-06-08 08:25:03'),
(12,'MED Mecânica','medio','2025-06-07 23:21:00','2025-06-08 08:25:08'),
(13,'MED Informática de Gestão','medio','2025-06-07 23:21:00','2025-06-08 08:25:14'),
(14,'MED Contabilidade','medio','2025-06-07 23:21:00','2025-06-08 08:25:19'),
(15,'MED Gestão de Recursos Humanos','medio','2025-06-07 23:21:00','2025-06-08 08:25:24'),
(16,'MED Gestão Empresarial','medio','2025-06-07 23:21:00','2025-06-08 08:25:30'),
(17,'MED Finanças','medio','2025-06-07 23:21:00','2025-06-08 08:25:36'),
(18,'MED Ensino de Língua Portuguesa','medio','2025-06-07 23:21:00','2025-06-08 08:25:42'),
(19,'MED Ensino de Matemática e Física','medio','2025-06-07 23:21:00','2025-06-08 08:25:51'),
(20,'MED Ensino de Inglês e EMC','medio','2025-06-07 23:21:00','2025-06-08 08:26:00'),
(21,'MED Ensino de Biologia e Química','medio','2025-06-07 23:21:00','2025-06-08 08:26:09'),
(22,'MED Instrução Primária','medio','2025-06-07 23:21:00','2025-06-08 08:26:15'),
(23,'MED Ensino de Educação Física','medio','2025-06-07 23:21:00','2025-06-08 08:26:21'),
(24,'MESCTI Ensino da Língua Portuguesa','superior','2025-06-07 23:21:00','2025-06-08 08:27:12'),
(25,'MESCTI Ensino da Matemática','superior','2025-06-07 23:21:00','2025-06-08 08:27:22'),
(26,'MESCTI Ensino da Informática','superior','2025-06-07 23:21:00','2025-06-08 08:27:34'),
(27,'MESCTI Ensino de História','superior','2025-06-07 23:21:00','2025-06-08 08:27:42'),
(28,'MESCTI Ensino da Língua Inglesa','superior','2025-06-07 23:21:00','2025-06-08 08:27:57'),
(29,'MESCTI Ensino Primário','superior','2025-06-07 23:21:00','2025-06-08 08:27:00'),
(30,'MESCTI Educação de Infância','superior','2025-06-07 23:21:00','2025-06-08 08:28:14'),
(31,'MESCTI Engenharia Informática','superior','2025-06-07 23:21:00','2025-06-08 08:28:25'),
(32,'MESCTI Engenharia de Telecomunicações','superior','2025-06-07 23:21:00','2025-06-08 08:28:33'),
(33,'MESCTI Engenharia Electrónica','superior','2025-06-07 23:21:00','2025-06-08 08:28:41'),
(34,'MESCTI Engenharia Electrotécnica','superior','2025-06-07 23:21:00','2025-06-08 08:28:49'),
(35,'MESCTI Engenharia Eléctrica','superior','2025-06-07 23:21:00','2025-06-08 08:28:56'),
(36,'MESCTI Engenharia de Construção Civil','superior','2025-06-07 23:21:00','2025-06-08 08:29:03'),
(37,'MESCTI Engenharia Mecânica','superior','2025-06-07 23:21:00','2025-06-08 08:29:12'),
(38,'MESCTI Ciência da Computação','superior','2025-06-07 23:21:00','2025-06-08 08:29:20'),
(39,'MESCTI Física','superior','2025-06-07 23:21:00','2025-06-08 08:29:29'),
(40,'MESCTI Química','superior','2025-06-07 23:21:00','2025-06-08 08:29:36'),
(41,'MESCTI Matemática','superior','2025-06-07 23:21:00','2025-06-08 08:29:46'),
(42,'MESCTI Economia','superior','2025-06-07 23:21:00','2025-06-08 08:29:54'),
(43,'MESCTI Gestão e Administração Pública','superior','2025-06-07 23:21:00','2025-06-08 08:30:02'),
(44,'MESCTI Gestão Empresarial','superior','2025-06-07 23:21:00','2025-06-08 08:30:10'),
(45,'MESCTI Contabilidade e Gestão','superior','2025-06-07 23:21:00','2025-06-08 08:30:16'),
(46,'MESCTI Gestão de Recursos Humanos','superior','2025-06-07 23:21:00','2025-06-08 08:30:26'),
(47,'MESCTI Contabilidade e Auditoria','superior','2025-06-07 23:21:00','2025-06-08 08:30:34'),
(48,'MESCTI Gestão de Finanças','superior','2025-06-07 23:21:00','2025-06-08 08:30:40'),
(49,'MESCTI Medicina','superior','2025-06-07 23:21:00','2025-06-08 08:30:47'),
(50,'MESCTI Medicina Geral','superior','2025-06-07 23:21:00','2025-06-08 08:30:53'),
(51,'MESCTI Enfermagem','superior','2025-06-07 23:21:00','2025-06-08 08:31:01'),
(52,'MESCTI Análises Clínicas e Saúde Pública','superior','2025-06-07 23:21:00','2025-06-08 08:31:15'),
(53,'MESCTI Fisioterapia','superior','2025-06-07 23:21:00','2025-06-08 08:31:08'),
(54,'MESCTI Nutrição','superior','2025-06-07 23:21:00','2025-06-08 08:31:22'),
(55,'MESCTI Farmacologia','superior','2025-06-07 23:21:00','2025-06-08 08:31:27'),
(56,'MESCTI Medicina Dentária','superior','2025-06-07 23:21:00','2025-06-08 08:31:33'),
(57,'MESCTI Oftamologia','superior','2025-06-07 23:21:00','2025-06-08 08:31:38');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(150) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_disciplina`),
  UNIQUE KEY `nome_disciplina` (`nome_disciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina`
--

LOCK TABLES `disciplina` WRITE;
/*!40000 ALTER TABLE `disciplina` DISABLE KEYS */;
INSERT INTO `disciplina` VALUES
(1,'Matemática','2025-06-08 13:25:48','2025-06-08 13:25:48'),
(2,'Língua Portuguesa','2025-06-08 13:26:06','2025-06-08 13:26:06'),
(3,'Biologia','2025-06-08 13:26:15','2025-06-08 13:26:15'),
(4,'Física','2025-06-08 13:26:21','2025-06-08 13:26:21'),
(5,'Química','2025-06-08 13:26:28','2025-06-08 13:26:28'),
(6,'História','2025-06-08 13:26:34','2025-06-08 13:26:34'),
(7,'Língua Inglesa','2025-06-08 13:26:43','2025-06-08 13:26:43'),
(8,'Língua Francesa','2025-06-08 13:26:55','2025-06-08 13:26:55'),
(10,'Álgebra Linear','2025-06-08 21:08:38','2025-06-08 21:08:38'),
(11,'Geometria Analítica','2025-06-08 21:08:49','2025-06-08 21:08:49'),
(12,'Análise Matemática 1','2025-06-08 21:09:01','2025-06-08 21:09:01'),
(13,'Análise Matemática 2','2025-06-08 21:09:20','2025-06-08 21:09:20'),
(14,'Análise Matemática 3','2025-06-08 21:09:29','2025-06-08 21:09:29'),
(15,'História da Informática','2025-06-08 21:11:44','2025-06-08 21:11:44'),
(16,'Lógica de Programação','2025-06-08 21:11:54','2025-06-08 21:11:54'),
(17,'Pedagogia Geral','2025-06-08 21:12:42','2025-06-08 21:12:42'),
(18,'Didáctica Geral','2025-06-08 21:12:52','2025-06-08 21:12:52'),
(19,'Psicologia Geral','2025-06-08 21:13:05','2025-06-08 21:13:05');
/*!40000 ALTER TABLE `disciplina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplina_curso`
--

DROP TABLE IF EXISTS `disciplina_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `disciplina_curso` (
  `id_disciplina` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_disciplina`,`id_curso`),
  KEY `fk_disciplina_curso_curso` (`id_curso`),
  CONSTRAINT `fk_disciplina_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplina_curso_disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplina_curso`
--

LOCK TABLES `disciplina_curso` WRITE;
/*!40000 ALTER TABLE `disciplina_curso` DISABLE KEYS */;
INSERT INTO `disciplina_curso` VALUES
(2,26,'2025-06-08 21:27:21','2025-06-08 21:27:21'),
(8,26,'2025-06-08 21:28:43','2025-06-08 21:28:52'),
(10,26,'2025-06-08 21:25:33','2025-06-08 21:25:33'),
(11,26,'2025-06-08 21:26:53','2025-06-08 21:26:53'),
(12,26,'2025-06-08 21:25:58','2025-06-08 21:25:58'),
(13,26,'2025-06-08 21:26:09','2025-06-08 21:26:09'),
(14,26,'2025-06-08 21:26:15','2025-06-08 21:26:15'),
(15,26,'2025-06-08 21:27:03','2025-06-08 21:27:03'),
(16,26,'2025-06-08 21:27:41','2025-06-08 21:27:41'),
(17,26,'2025-06-08 21:27:58','2025-06-08 21:27:58'),
(18,26,'2025-06-08 21:26:36','2025-06-08 21:26:36'),
(19,26,'2025-06-08 21:28:21','2025-06-08 21:28:21');
/*!40000 ALTER TABLE `disciplina_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudante`
--

DROP TABLE IF EXISTS `estudante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `estudante` (
  `id_usuario` int(11) NOT NULL,
  `data_nasc` date NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `area_formacao` int(11) NOT NULL,
  `curso_pretendido` int(11) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `telefone` (`telefone`),
  KEY `fk_area_formacao` (`area_formacao`),
  KEY `fk_curso_pretendido` (`curso_pretendido`),
  CONSTRAINT `fk_area_formacao` FOREIGN KEY (`area_formacao`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_curso_pretendido` FOREIGN KEY (`curso_pretendido`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_estudante_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudante`
--

LOCK TABLES `estudante` WRITE;
/*!40000 ALTER TABLE `estudante` DISABLE KEYS */;
INSERT INTO `estudante` VALUES
(6,'1977-06-16','222-222-222',8,31,'2025-06-08 10:41:44','2025-06-08 10:41:44');
/*!40000 ALTER TABLE `estudante` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_estudante_no_duplicate_insert
BEFORE INSERT ON estudante
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM estudante WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de estudante já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_estudante_no_duplicate_update
BEFORE UPDATE ON estudante
FOR EACH ROW
BEGIN
    IF NEW.telefone <> OLD.telefone AND EXISTS (SELECT 1 FROM estudante WHERE telefone = NEW.telefone) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Telefone de estudante já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `exame_sistema`
--

DROP TABLE IF EXISTS `exame_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_sistema` (
  `id_exame` int(11) NOT NULL AUTO_INCREMENT,
  `duracao` time NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_sistema`
--

LOCK TABLES `exame_sistema` WRITE;
/*!40000 ALTER TABLE `exame_sistema` DISABLE KEYS */;
INSERT INTO `exame_sistema` VALUES
(1,'01:00:00','2025-06-09 05:19:42','2025-06-09 05:19:42');
/*!40000 ALTER TABLE `exame_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame_sistema_realizado`
--

DROP TABLE IF EXISTS `exame_sistema_realizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_sistema_realizado` (
  `id_exame_realizado` int(11) NOT NULL AUTO_INCREMENT,
  `id_exame_sistema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_realizacao` datetime NOT NULL,
  `nota_obtida` float NOT NULL,
  `tempo_decorrido` time NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame_realizado`),
  KEY `fk_exame_sistema_realizado_exame_sistema` (`id_exame_sistema`),
  KEY `fk_exame_sistema_realizado_usuario` (`id_usuario`),
  CONSTRAINT `fk_exame_sistema_realizado_exame_sistema` FOREIGN KEY (`id_exame_sistema`) REFERENCES `exame_sistema` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exame_sistema_realizado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_sistema_realizado`
--

LOCK TABLES `exame_sistema_realizado` WRITE;
/*!40000 ALTER TABLE `exame_sistema_realizado` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame_sistema_realizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame_universidade`
--

DROP TABLE IF EXISTS `exame_universidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_universidade` (
  `id_exame` int(11) NOT NULL AUTO_INCREMENT,
  `duracao` time NOT NULL,
  `id_universidade` int(11) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame`),
  KEY `fk_exame_universidade_universidade` (`id_universidade`),
  CONSTRAINT `fk_exame_universidade_universidade` FOREIGN KEY (`id_universidade`) REFERENCES `universidade` (`id_universidade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_universidade`
--

LOCK TABLES `exame_universidade` WRITE;
/*!40000 ALTER TABLE `exame_universidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame_universidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame_universidade_realizado`
--

DROP TABLE IF EXISTS `exame_universidade_realizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_universidade_realizado` (
  `id_exame_realizado` int(11) NOT NULL AUTO_INCREMENT,
  `id_exame_universidade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_realizacao` datetime NOT NULL,
  `nota_obtida` float NOT NULL,
  `tempo_decorrido` time NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame_realizado`),
  KEY `fk_exame_universidade_realizado_exame` (`id_exame_universidade`),
  KEY `fk_exame_universidade_realizado_usuario` (`id_usuario`),
  CONSTRAINT `fk_exame_universidade_realizado_exame` FOREIGN KEY (`id_exame_universidade`) REFERENCES `exame_universidade` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_exame_universidade_realizado_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_universidade_realizado`
--

LOCK TABLES `exame_universidade_realizado` WRITE;
/*!40000 ALTER TABLE `exame_universidade_realizado` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame_universidade_realizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_aluno`
--

DROP TABLE IF EXISTS `historico_aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historico_aluno` (
  `id_historico_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `tipo_exame` enum('sistema','universidade') NOT NULL,
  `id_exame_realizado` int(11) NOT NULL,
  `nota_obtida` float NOT NULL,
  `data_realizacao` datetime NOT NULL,
  `tempo_decorrido` time NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_historico_aluno`),
  KEY `fk_historico_usuario` (`id_usuario`),
  CONSTRAINT `fk_historico_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_aluno`
--

LOCK TABLES `historico_aluno` WRITE;
/*!40000 ALTER TABLE `historico_aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_aluno` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_historico_aluno_before_insert
BEFORE INSERT ON historico_aluno
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_historico_aluno_before_update
BEFORE UPDATE ON historico_aluno
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `lista_perguntas_exame_sistema`
--

DROP TABLE IF EXISTS `lista_perguntas_exame_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_perguntas_exame_sistema` (
  `id_exame_sistema` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame_sistema`,`id_pergunta`),
  KEY `fk_lista_perguntas_exame_sistema_pergunta` (`id_pergunta`),
  CONSTRAINT `fk_lista_perguntas_exame_sistema_exame` FOREIGN KEY (`id_exame_sistema`) REFERENCES `exame_sistema` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_sistema_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_perguntas_exame_sistema`
--

LOCK TABLES `lista_perguntas_exame_sistema` WRITE;
/*!40000 ALTER TABLE `lista_perguntas_exame_sistema` DISABLE KEYS */;
INSERT INTO `lista_perguntas_exame_sistema` VALUES
(1,1,'2025-06-09 05:47:39','2025-06-09 05:47:39'),
(1,2,'2025-06-09 05:26:56','2025-06-09 05:26:56'),
(1,3,'2025-06-09 05:58:45','2025-06-09 05:58:45'),
(1,4,'2025-06-09 06:15:13','2025-06-09 06:15:13');
/*!40000 ALTER TABLE `lista_perguntas_exame_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_perguntas_exame_universidade`
--

DROP TABLE IF EXISTS `lista_perguntas_exame_universidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_perguntas_exame_universidade` (
  `id_exame_universidade` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame_universidade`,`id_pergunta`),
  KEY `fk_lista_perguntas_exame_universidade_pergunta` (`id_pergunta`),
  CONSTRAINT `fk_lista_perguntas_exame_universidade_exame` FOREIGN KEY (`id_exame_universidade`) REFERENCES `exame_universidade` (`id_exame`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lista_perguntas_exame_universidade_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_perguntas_exame_universidade`
--

LOCK TABLES `lista_perguntas_exame_universidade` WRITE;
/*!40000 ALTER TABLE `lista_perguntas_exame_universidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_perguntas_exame_universidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_acesso`
--

DROP TABLE IF EXISTS `nivel_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel_acesso` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_nivel`),
  UNIQUE KEY `descricao` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_acesso`
--

LOCK TABLES `nivel_acesso` WRITE;
/*!40000 ALTER TABLE `nivel_acesso` DISABLE KEYS */;
INSERT INTO `nivel_acesso` VALUES
(1,'Administrador','2025-06-07 23:21:00','2025-06-09 08:45:26'),
(2,'Estudante','2025-06-07 23:21:00','2025-06-07 23:21:00');
/*!40000 ALTER TABLE `nivel_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pergunta` (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` varchar(1000) NOT NULL,
  `resposta` varchar(1000) NOT NULL,
  `curso` int(11) NOT NULL,
  `disciplina` int(11) NOT NULL,
  `tema` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pergunta`),
  KEY `fk_pergunta_curso_pergunta` (`curso`),
  KEY `fk_pergunta_disciplina_pergunta` (`disciplina`),
  KEY `fk_pergunta_tema_pergunta` (`tema`),
  KEY `fk_pergunta_status_pergunta` (`status`),
  CONSTRAINT `fk_pergunta_curso_pergunta` FOREIGN KEY (`curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_disciplina_pergunta` FOREIGN KEY (`disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_status_pergunta` FOREIGN KEY (`status`) REFERENCES `status_pergunta` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pergunta_tema_pergunta` FOREIGN KEY (`tema`) REFERENCES `tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pergunta`
--

LOCK TABLES `pergunta` WRITE;
/*!40000 ALTER TABLE `pergunta` DISABLE KEYS */;
INSERT INTO `pergunta` VALUES
(1,'O que são substantivos?','Substantivos são palavras que designam os seres, estados, sentimentos e acções em geral.',24,2,7,1,'2025-06-08 19:09:11','2025-06-08 19:24:07'),
(2,'O que são adjectivos?','Adjectivos são palavras que caracterizam e qualificam os substantivos.',24,2,6,1,'2025-06-08 19:22:02','2025-06-08 19:22:02'),
(3,'Quais são os elementos essenciais da oração?','Os elementos essenciais da oração são: sujeito, predicado e complementos.',24,2,8,1,'2025-06-08 19:23:56','2025-06-08 19:23:56'),
(4,'O que são pronomes?','Pronomes são palavras que acompanham ou subtituem sintágmas nominais.',24,2,6,1,'2025-06-09 05:53:38','2025-06-09 05:53:38');
/*!40000 ALTER TABLE `pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pergunta_acertada_exame_sistema`
--

DROP TABLE IF EXISTS `pergunta_acertada_exame_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pergunta_acertada_exame_sistema` (
  `id_exame_sistema_realizado` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_exame_sistema_realizado`,`id_pergunta`),
  KEY `fk_acerto_pergunta` (`id_pergunta`),
  CONSTRAINT `fk_acerto_exame_realizado` FOREIGN KEY (`id_exame_sistema_realizado`) REFERENCES `exame_sistema_realizado` (`id_exame_realizado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_acerto_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pergunta_acertada_exame_sistema`
--

LOCK TABLES `pergunta_acertada_exame_sistema` WRITE;
/*!40000 ALTER TABLE `pergunta_acertada_exame_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `pergunta_acertada_exame_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultado_exame`
--

DROP TABLE IF EXISTS `resultado_exame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `resultado_exame` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `tipo_exame` enum('sistema','universidade') NOT NULL,
  `id_exame_realizado` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `resposta_dada` varchar(1000) NOT NULL,
  `correta` tinyint(1) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_resposta`),
  KEY `fk_resposta_usuario` (`id_usuario`),
  KEY `fk_resposta_pergunta` (`id_pergunta`),
  CONSTRAINT `fk_resposta_pergunta` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_resposta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultado_exame`
--

LOCK TABLES `resultado_exame` WRITE;
/*!40000 ALTER TABLE `resultado_exame` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado_exame` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_resultado_exame_before_insert
BEFORE INSERT ON resultado_exame
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_resultado_exame_before_update
BEFORE UPDATE ON resultado_exame
FOR EACH ROW
BEGIN
  IF NEW.tipo_exame = 'sistema' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_sistema_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_sistema_realizado para tipo_exame sistema.';
    END IF;
  ELSEIF NEW.tipo_exame = 'universidade' THEN
    IF NOT EXISTS (SELECT 1 FROM exame_universidade_realizado WHERE id_exame_realizado = NEW.id_exame_realizado) THEN
      SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: id_exame_realizado não existe em exame_universidade_realizado para tipo_exame universidade.';
    END IF;
  ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: tipo_exame inválido.';
  END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `status_pergunta`
--

DROP TABLE IF EXISTS `status_pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_pergunta` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_status` varchar(100) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_status`),
  UNIQUE KEY `descricao_status` (`descricao_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_pergunta`
--

LOCK TABLES `status_pergunta` WRITE;
/*!40000 ALTER TABLE `status_pergunta` DISABLE KEYS */;
INSERT INTO `status_pergunta` VALUES
(1,'Pergunta Fácil','2025-06-08 15:07:07','2025-06-08 15:07:07'),
(2,'Pergunta Mediana','2025-06-08 15:09:15','2025-06-08 15:09:15'),
(3,'Pergunta Difícil','2025-06-08 15:09:41','2025-06-08 15:09:41');
/*!40000 ALTER TABLE `status_pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tema` varchar(200) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_tema`),
  UNIQUE KEY `nome_tema` (`nome_tema`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema`
--

LOCK TABLES `tema` WRITE;
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
INSERT INTO `tema` VALUES
(1,'Conjuntos','2025-06-08 15:20:01','2025-06-08 15:20:01'),
(2,'Funções','2025-06-08 15:20:10','2025-06-08 15:20:10'),
(3,'Limites','2025-06-08 15:20:17','2025-06-08 15:20:17'),
(4,'Derivadas','2025-06-08 15:20:54','2025-06-08 15:20:54'),
(5,'Integrais','2025-06-08 15:21:03','2025-06-08 15:21:03'),
(6,'Morfologia','2025-06-08 15:21:14','2025-06-08 15:21:14'),
(7,'Sintaxe','2025-06-08 15:21:25','2025-06-08 15:21:25'),
(8,'Fonética','2025-06-08 15:21:48','2025-06-08 15:21:48');
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `universidade`
--

DROP TABLE IF EXISTS `universidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `universidade` (
  `id_universidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_universidade` varchar(150) NOT NULL,
  `nome_abreviado` varchar(30) NOT NULL,
  `criada_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizada_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_universidade`),
  UNIQUE KEY `nome_universidade` (`nome_universidade`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `universidade`
--

LOCK TABLES `universidade` WRITE;
/*!40000 ALTER TABLE `universidade` DISABLE KEYS */;
INSERT INTO `universidade` VALUES
(1,'Escola Superior Pedagógica do Bengo','ESPB','2025-06-08 13:46:25','2025-06-08 13:46:25'),
(2,'Universidade Agostinho Neto','UAN','2025-06-08 13:46:45','2025-06-08 13:46:45'),
(3,'Instituto Superior de Tecnologias de Informação e Comunicação','INSTIC','2025-06-08 13:47:20','2025-06-08 13:47:20'),
(4,'Instituto Superior Politécnico do Bengo','ISPB','2025-06-08 13:47:55','2025-06-08 13:47:55'),
(5,'Universidade Católica de Angola','UCAN','2025-06-08 13:48:20','2025-06-08 13:48:20'),
(6,'Universidade Metodista de Angola','UMA','2025-06-08 13:48:37','2025-06-08 13:48:37'),
(7,'Instituto Superior Politécnico Internacional de Luanda','ISPIL','2025-06-08 13:49:14','2025-06-08 13:49:14');
/*!40000 ALTER TABLE `universidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `nome_completo` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `id_nivel_acesso` int(11) NOT NULL,
  `criado_em` datetime NOT NULL DEFAULT current_timestamp(),
  `actualizado_em` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nome_usuario` (`nome_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_usuario_nivel_acesso_idx` (`id_nivel_acesso`),
  CONSTRAINT `fk_usuario_nivel_acesso` FOREIGN KEY (`id_nivel_acesso`) REFERENCES `nivel_acesso` (`id_nivel`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES
(1,'MrSomebody','Mr. Somebody Admin','mr.somebody@spex.edu.ao','$2y$10$YSpDV9FgoNVXG0oGnhWyuu7qms9tMTuIxewJOwkV5Bw9u.KFz8v7C',1,'2025-06-07 23:21:00','2025-06-08 08:18:27'),
(6,'MrTech','Mr. TechMan','mr.tech@spex.edu.ao','$2y$10$ii4QOZKEhjFvkYwezvYIOOz9OhqSOSt5Ei9FSonp1wUcduDp8CkH.',2,'2025-06-08 10:37:36','2025-06-08 10:41:44');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_usuario_no_duplicate_insert
BEFORE INSERT ON usuario
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM usuario WHERE nome_usuario = NEW.nome_usuario) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Nome de utilizador já existe.';
    END IF;

    IF EXISTS (SELECT 1 FROM usuario WHERE email = NEW.email) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Email já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER trg_usuario_no_duplicate_update
BEFORE UPDATE ON usuario
FOR EACH ROW
BEGIN
    IF NEW.nome_usuario <> OLD.nome_usuario AND EXISTS (SELECT 1 FROM usuario WHERE nome_usuario = NEW.nome_usuario) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Nome de utilizador já existe.';
    END IF;

    IF NEW.email <> OLD.email AND EXISTS (SELECT 1 FROM usuario WHERE email = NEW.email) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Email já existe.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-09  9:59:41
