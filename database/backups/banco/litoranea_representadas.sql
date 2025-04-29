-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: litoranea
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `representadas`
--

DROP TABLE IF EXISTS `representadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `representadas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipo_pessoa` int NOT NULL COMMENT '1 - Juridica, 2 - Física',
  `cpf_cnpj` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inscricao_estadual` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razao_social` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_fantasia` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsavel` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_nfe` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rua` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representadas`
--

LOCK TABLES `representadas` WRITE;
/*!40000 ALTER TABLE `representadas` DISABLE KEYS */;
INSERT INTO `representadas` VALUES (1,2,'100.197.659-24',NULL,'William','Farias Vargas',NULL,'wf.vargas@hotmail.com','wf.vargas@hotmail.com','(48) 9842-7755',NULL,'88.122-490','Servidão Pedro Schmitt','45',NULL,'Sertão do Maruim','São José','SC','2025-04-29 06:10:53','2025-04-29 06:10:53'),(2,1,'24.795.753/0001-07',NULL,'outra empresa','djfy',NULL,'wf.vardjgas@hotmail.com','wf.vardjgas@hotmail.com','(48) 9842-7755',NULL,'88.122-490','Servidão Pedro Schmitt','45',NULL,'Sertão do Maruim','São José','SC','2025-04-29 06:45:34','2025-04-29 06:45:46');
/*!40000 ALTER TABLE `representadas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-29  1:26:58
